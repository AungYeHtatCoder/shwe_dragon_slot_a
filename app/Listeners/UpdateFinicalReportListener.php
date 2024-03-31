<?php

namespace App\Listeners;

use App\Jobs\UpdateFinicalReportJob;
use Bavix\Wallet\Internal\Events\TransactionCreatedEvent;

class UpdateFinicalReportListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TransactionCreatedEvent $event): void
    {
        UpdateFinicalReportJob::dispatch()->delay(30);
    }
}
