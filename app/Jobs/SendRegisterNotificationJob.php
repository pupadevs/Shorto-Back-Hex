<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Source\User\Domain\Entity\User\User;
use App\Mail\RegisterNotification;
use Exception;
use Illuminate\Support\Facades\Log;

class SendRegisterNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected User $user;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
      try{
        Mail::to($this->user->getEmail()->ToString())->send(new RegisterNotification($this->user));
      }catch(Exception $e){
        Log::error($e->getMessage());
      }
      }
    
    
}
