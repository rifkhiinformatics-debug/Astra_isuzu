@component('mail::message')
# Pengingat Pembayaran

Halo **{{ $transaksi->nama }}**,

Ini pengingat bahwa tanggal pembayaran anda tercatat pada **{{ $transaksi->tanggal_bayar->format('Y-m-d') }}**.

Mohon untuk melakukan pembayaran tepat waktu.  
Nomor Customer: {{ $transaksi->nomor_customer ?? '-' }}

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
