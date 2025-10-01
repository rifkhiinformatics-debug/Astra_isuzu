<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    public $timestamps = false; // ⬅️ tambahkan ini kalau tidak ada kolom created_at & updated_at

    protected $fillable = [
        'nama',
        'nomor_customer',
        'email',
        'tanggal_bayar',
        'status',
        'reminder_sent',
        'reminder_sent_at',
    ];
}
