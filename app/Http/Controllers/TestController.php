<?php

namespace App\Http\Controllers;

use App\Enums\TransactionName;
use App\Enums\UserType;
use App\Jobs\UpdateFinicalReportJob;
use App\Models\FinicalReport;
use App\Models\SeamlessTransaction;
use App\Models\User;
use App\Services\UserTreeService;
use Bavix\Wallet\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function __invoke(Request $request)
    {
        // $user = User::where("type", UserType::Admin)->first();

        // $child_user = UserType::childUserType($user->type);

        $now = now();

        $users = User::where("type", UserType::Player)->get();

        for ($x = 0; $x <= 31; $x++) {
            foreach ($users as $user) {
                $bet_count = rand(0, 20);

                for ($i = 0; $i < $bet_count; $i++) {
                    $user_tree = UserTreeService::getUserTree($user);

                    $report_date = $this->reportDate($now->clone()->addDays($x));

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
                            ];
                        }

                        $amount = (rand(1, 9) * 1000) * 100;

                        if ($bet_count == 0) {
                            $items[$key]['turnover'] += $amount;
                        } else {
                            $luck = rand(1, 10);

                            if ($luck >= 9) {
                                $items[$key]['payout'] -= $amount;
                            } else if ($luck >= 7) {
                                $items[$key]['payout'] += $amount;
                            } else {
                                $items[$key]['turnover'] += $amount;
                            }
                        }

                        $items[$key]["win_lose"] = $items[$key]["payout"] - $items[$key]["turnover"];
                    }
                }
            }

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
        }
    }

    private function reportDate($date)
    {
        $date->setTimezone('Asia/Yangon');

        return $date->format('Y-m-d');
    }
}
