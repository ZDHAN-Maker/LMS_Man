<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kelas') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('kelas.store') }}">
                        @csrf

                        <!-- Nama Kelas -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Kelas</label>
                            <input type="text" name="name" id="name"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                placeholder="Masukkan nama kelas" required>
                        </div>

                        <!-- Kode Kelas -->
                        <div class="mb-4">
                            <label for="kode_kelas" class="block text-sm font-medium text-gray-700">Kode Kelas</label>
                            <input type="text" name="kode_kelas" id="kode_kelas"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                placeholder="Misal: XIPA1" required>
                        </div>

                        <!-- Guru -->
                        <div class="mb-4">
                            <label for="guru_id" class="block text-sm font-medium text-gray-700">Guru</label>
                            <select name="guru_id" id="guru_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">-- Pilih Guru --</option>
                                @foreach ($gurus as $guru)
                                    <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Jadwal -->
                        <div class="mb-4">
                            <label for="jadwal" class="block text-sm font-medium text-gray-700">Jadwal</label>
                            <input type="datetime-local" name="jadwal" id="jadwal"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <!-- Tombol -->
                        <div class="flex justify-end">
                            <a href="{{ route('kelas.index') }}"
                                class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Batal</a>
                            <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
