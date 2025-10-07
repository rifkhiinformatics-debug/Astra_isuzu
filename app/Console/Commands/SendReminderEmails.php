<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaksi;
use App\Mail\ReminderMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class SendReminderEmails extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Kirim email pengingat sesuai tanggal bayar yang diinput';

    public function handle()
    {
        $today = Carbon::today()->toDateString();
        Log::info("Cron started: reminders:send running for date {$today}");

        $transaksis = Transaksi::whereDate('tanggal_bayar', $today)
            ->where('status', 'Belum Bayar')
            ->where(function($q) {
                $q->where('reminder_sent', false)->orWhereNull('reminder_sent_at');
            })
            ->get();

        Log::info("Found {$transaksis->count()} transaksi for reminders.");

        foreach ($transaksis as $t) {
            if (!empty($t->email)) {
                try {
                    Mail::to($t->email)->send(new ReminderMail($t));

                    $t->update([
                        'reminder_sent' => true,
                        'reminder_sent_at' => now()
                    ]);

                    Log::info("Reminder sent to: {$t->email}");
                    $this->info("Reminder sent to: {$t->email}");
                } catch (\Exception $e) {
                    Log::error("Failed to send reminder to {$t->email}: " . $e->getMessage());
                }
            } else {
                Log::warning("No email for transaksi ID {$t->id} ({$t->nama})");
                $this->warn("No email for: {$t->nama}");
            }
        }

        Log::info('Cron done: reminders:send finished.');
        $this->info('Done sending reminders.');
    }
}
