<?php

namespace App\Mail;

use App\Models\Posts;
use App\Models\Images;
use App\Models\Users;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Weeklysubscription extends Mailable
{
    use Queueable, SerializesModels;

    protected $posts;
    protected $users;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->posts = Posts::all();
        $this->users = Users::all();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.WeeklySubscription')
                    ->with([
                        'posts' => $this->posts,
                        'users' => $this->users
                    ]);
    }
}
