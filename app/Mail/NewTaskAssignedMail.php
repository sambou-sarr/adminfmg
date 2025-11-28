<?php

namespace App\Mail;

use App\Models\Tache;
use Illuminate\Mail\Mailable;

class NewTaskAssignedMail extends Mailable
{
    public $tache;

    public function __construct(Tache $tache)
    {
        $this->tache = $tache;
    }

    public function build()
    {
        return $this->subject("Nouvelle tâche : " . $this->tache->titre)
                    ->view('email.new_task_assigned');
    }
}
