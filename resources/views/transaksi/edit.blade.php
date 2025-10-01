<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <div class="bg-white p-6 rounded shadow">
            <form method="POST" action="{{ route('transaksis.update', $transaksi->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama', $transaksi->nama) }}" class="border rounded w-full p-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">Nomor Customer</label>
                    <input type="text" name="nomor_customer" value="{{ old('nomor_customer', $transaksi->nomor_customer) }}" class="border rounded w-full p-2">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">Email</label>
                    <input type="email" name="email" value="{{ old('email', $transaksi->email) }}" class="border rounded w-full p-2">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">Tanggal Bayar</label>
                    <input type="date" name="tanggal_bayar" value="{{ old('tanggal_bayar', $transaksi->tanggal_bayar) }}" class="border rounded w-full p-2">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">Status</label>
                    <select name="status" class="border rounded w-full p-2" required>
                        <option value="Belum Bayar" {{ $transaksi->status == 'Belum Bayar' ? 'selected' : '' }}>Belum Bayar</option>
                        <option value="Sudah Bayar" {{ $transaksi->status == 'Sudah Bayar' ? 'selected' : '' }}>Sudah Bayar</option>
                    </select>
                </div>

               <div class="flex gap-4">
    <button type="submit" class="bg-green-600 hover:bg-green-700 text-black font-semibold px-4 py-2 rounded shadow">
        Simpan
    </button>
    
    <a href="{{ route('dashboard') }}" class="white hover:white  text-black font-semibold px-4 py-2 rounded shadow">
        Kembali
    </a>
</div>

            </form>
        </div>
    </div>
</x-app-layout>
