<?php

namespace App\Jobs;

use App\Mail\ForgotPasswordMail;
use App\Models\Client;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail implements ShouldQueue
{
    use Queueable;

    protected $client;

    /**
     * Create a new job instance.
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->client->email)->send(new ForgotPasswordMail([
            'code'=>'Welcome',
            'name'=>$this->client->name,
        ]));
    }
}
