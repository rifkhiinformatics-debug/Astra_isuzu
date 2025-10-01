<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Transaksi;

class ReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $transaksi;

    public function __construct(Transaksi $transaksi)
    {
        $this->transaksi = $transaksi;
    }

    public function build()
    {
        return $this->subject('Pengingat Pembayaran - ' . config('app.name'))
                    ->markdown('emails.reminder')
                    ->with(['transaksi' => $this->transaksi]);
    }
}
