<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <form method="POST" action="{{ route('transaksis.store') }}">
                    @csrf

                    <div>
                        <label class="block font-medium">Nama Customer</label>
                        <input type="text" name="nama" class="border rounded w-full" required>
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium">Nomor Customer</label>
                        <input type="text" name="nomor_customer" class="border rounded w-full">
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium">Email</label>
                        <input type="email" name="email" class="border rounded w-full">
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium">Tanggal Bayar</label>
                        <input type="date" name="tanggal_bayar" class="border rounded w-full">
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium">Status</label>
                        <select name="status" class="border rounded w-full" required>
                            <option value="Belum Bayar">Belum Bayar</option>
                            <option value="Sudah Bayar">Sudah Bayar</option>
                        </select>
                    </div>

                    <div class="mt-6 flex space-x-4">
    <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded shadow hover:bg-blue-700">
        Simpan
    </button>

    <a href="{{ route('transaksis.index') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded shadow hover:bg-gray-300 inline-flex items-center justify-center">
        Kembali
    </a>
</div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
