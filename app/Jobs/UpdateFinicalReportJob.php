<?php

namespace App\Jobs;

use App\Enums\TransactionName;
use App\Enums\UserType;
use App\Enums\WagerStatus;
use App\Models\FinicalReport;
use App\Models\Transaction;
use App\Services\UserTreeService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class UpdateFinicalReportJob implements ShouldBeUnique, ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Transaction::has('wager')->with(['payable', 'wager'])
            ->where('is_report_generated', false)
            ->whereIn('name', [
                TransactionName::Stake,
                TransactionName::Payout,
                TransactionName::Bonus,
                TransactionName::JackPot,
                TransactionName::Cancel,
                TransactionName::Rollback,
                TransactionName::BuyIn,
                TransactionName::BuyOut,
            ])
            // ->where("id", 34)
            ->orderBy('payable_id')
            ->chunkById(1000, function ($transactions) {
                $items = [];
                $ids = [];

                foreach ($transactions as $transaction) {
                    $wager = $transaction->wager;

                    if ($wager->status == WagerStatus::Ongoing) {
                        continue;
                    }

                    if ($transaction->payable->type == UserType::Admin) {
                        continue;
                    }

                    $user_tree = UserTreeService::getUserTree($transaction->payable);

                    $ids[] = $transaction->id;

                    $report_date = $this->reportDate($wager->created_at);

                    foreach ($user_tree as $user_tree_item) {
                        if (!$user_tree_item) {
                            continue;
                        }

                        $key = $report_date . '_' . $user_tree_item->parent_id;
                        if (!isset($items[$key])) {
                            $items[$key] = [
                                'date' => $report_date,
                                'user_id' => $user_tree_item->parent_id,
                                'turnover' => 0,
                                'payout' => 0,
                                'win_lose' => 0,
                                'commission' => 0,
                                'parent_commission' => 0,
                            ];
                        }

                        $amount = abs($transaction->amount);

                        // TODO: check commission amount

                        if (
                            $transaction->name == TransactionName::Stake
                        ) {
                            $items[$key]['turnover'] += $amount;
                        }
                        if (
                            in_array($transaction->name, [
                                TransactionName::Payout,
                                TransactionName::Bonus,
                                TransactionName::JackPot,
                                TransactionName::Cancel,
                                TransactionName::BuyOut
                            ])
                        ) {
                            $items[$key]['payout'] += $amount;
                        }

                        if (
                            in_array($transaction->name, [
                                TransactionName::BuyIn,
                                TransactionName::Rollback
                            ])
                        ) {
                            $items[$key]['payout'] -= $amount;
                        }

                        $items[$key]["win_lose"] = $items[$key]["payout"] - $items[$key]["turnover"];
                    }
                }

                // dd($ids);

                $report_dates = collect($items)->pluck('date');

                $existing_report_keys = FinicalReport::whereIn('date', $report_dates)->select(DB::raw('CONCAT(date, "_", user_id) as unique_report_key'))->pluck('unique_report_key')->toArray();

                $new_reports = collect($items)->filter(function ($item) use ($existing_report_keys) {
                    return !in_array($item['date'] . '_' . $item['user_id'], $existing_report_keys);
                })->values();

                if ($new_reports->count() > 0) {
                    FinicalReport::insert($new_reports->toArray());
                }

                $update_reports = collect($items)->filter(function ($item) use ($existing_report_keys) {
                    return in_array($item['date'] . '_' . $item['user_id'], $existing_report_keys);
                })->values();

                foreach ($update_reports as $update_report) {
                    $date = $update_report['date'];
                    $user_id = $update_report['user_id'];

                    unset($update_report['date']);
                    unset($update_report['user_id']);

                    FinicalReport::where('date', $date)->where('user_id', $user_id)->incrementEach($update_report);
                }

                Transaction::whereIn('id', $ids)->update([
                    'is_report_generated' => true,
                ]);
            });
    }

    private function reportDate($date)
    {
        $date->setTimezone('Asia/Yangon');

        return $date->format('Y-m-d');
    }
}
