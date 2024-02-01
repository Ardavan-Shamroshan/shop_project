<?php

namespace App\Jobs\Email;

use App\Http\Services\Message\Email\EmailService;
use App\Http\Services\Message\MessageService;
use App\Models\Notify\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailToUsersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private $users, private Email $email) {}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->users->map(function ($user) {
            $emailService = new EmailService();
            $emailService->setDetails([
                'title' => $this->email->subject,
                'body'  => $this->email->body
            ]);
            $emailService->setFrom('noreply@example.com', 'example');
            $emailService->setSubject($this->email->subject);
            $emailService->setTo($user->email);

            $messagesService = new MessageService($emailService);
            $messagesService->send();
        });
    }
}
