<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Users;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send the weekly subscription email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $subscribers = Users::where('subscribed', 1)->get();
        foreach($subscribers as $subscriber) {
            
            
            echo 'email send to ' . $subscriber->username . ".\r\n";
        }
    }
}
