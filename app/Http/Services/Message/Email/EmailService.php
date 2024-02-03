<?php

namespace App\Http\Services\Message\Email;

use App\Http\Interfaces\MessageInterface;
use Illuminate\Support\Facades\Mail;


class EmailService implements MessageInterface
{

    private array      $details;
    private string     $subject;
    private array      $from = [
        ['address' => null, 'name' => null,]
    ];
    private string|int $to;
    private mixed      $files;

    public function fire(): bool
    {
        Mail::to($this->to)->send(new MailViewProvider($this->details, $this->subject, $this->from, $this->files));
        return true;
    }

    public function getDetails(): array
    {
        return $this->details;
    }

    public function setDetails($details): void
    {
        $this->details = $details;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject($subject): void
    {
        $this->subject = $subject;
    }


    public function getFrom(): array
    {
        return $this->from;
    }

    public function setFrom($address, $name): void
    {
        $this->from = [
            ['address' => $address, 'name' => $name]
        ];
    }

    public function getTo(): int|string
    {
        return $this->to;
    }

    public function setTo($to): void
    {
        $this->to = $to;
    }

    public function getFiles(): mixed
    {
        return $this->files;
    }

    public function setFiles(mixed $files): void
    {
        $this->files = $files;
    }
}
