<?php

namespace App\Console\Commands;

use App\Jobs\Email\SendEmailToUsersJob;
use App\Models\Notify\Email;
use App\Models\User;
use Illuminate\Console\Command;

class AutoEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:send-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send scheduling mail automatically';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $emailsToSend = Email::query()->where('published_at', '<', now())->get();
        $emailsToSend->map(function ($email) {
            SendEmailToUsersJob::dispatch(
                User::whereNotNull('email')->get(),
                $email
            );
        });
    }
}
