<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PengajuanMakalahMail extends Mailable
{
      use Queueable, SerializesModels;

    public $user;
    public $judul;
    public $status;
    public $catatan;

    public function __construct($user, $judul, $status, $catatan = null)
    {
        $this->user = $user;
        $this->judul = $judul;
        $this->status = $status;
        $this->catatan = $catatan;
    }

    public function build()
    {
        return $this->subject('Pemberitahuan Status Proposal')
                    ->view('email.status_proposal');
    }
}
