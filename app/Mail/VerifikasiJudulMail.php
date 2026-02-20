<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifikasiJudulMail extends Mailable
{
    use Queueable, SerializesModels;

    public $status;
    public $judul;
    public $catatan;

    public function __construct($status, $judul,$catatan = null)
    {
        $this->status = $status;
        $this->judul = $judul;
        $this->catatan = $catatan;
        
    }

    public function build()
    {
        return $this->subject('Status Verifikasi Judul')
                    ->view('email.verifikasi-judul');
    }
}
