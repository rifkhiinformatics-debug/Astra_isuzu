<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaksi;
use App\Mail\ReminderMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendReminderEmails extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Kirim email pengingat sesuai tanggal bayar yang diinput';

    public function handle()
    {
        $today = Carbon::today()->toDateString();

        $transaksis = Transaksi::whereDate('tanggal_bayar', $today)
            ->where('status', 'Belum Bayar')
            ->where(function($q) {
                $q->where('reminder_sent', false)->orWhereNull('reminder_sent_at');
            })
            ->get();

        foreach ($transaksis as $t) {
            if (!empty($t->email)) {
                Mail::to($t->email)->send(new ReminderMail($t));

                // tandai sudah dikirim
                $t->update([
                    'reminder_sent' => true,
                    'reminder_sent_at' => now()
                ]);

                $this->info("Reminder sent to: {$t->email}");
            } else {
                $this->warn("No email for: {$t->nama}");
            }
        }

        $this->info('Done sending reminders.');
    }
}
