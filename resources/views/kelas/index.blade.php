<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Kelas') }}
        </h2>
    </x-slot>
    <div class="py-4 px-4 text-black border-rounded-md mx-left-4 bg-white">
        <p>Managemen Kelas</p>
    </div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border">ID</th>
                                <th class="px-4 py-2 border">Nama Kelas</th>
                                <th class="px-4 py-2 border">Kode Kelas</th>
                                <th class="px-4 py-2 border">Guru</th>
                                <th class="px-4 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="kelas-table">
                            <!-- Data kelas akan dimuat dengan fetch JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        async function loadKelas() {
            const res = await fetch('/kelas-api');
            const data = await res.json();
            const tbody = document.getElementById('kelas-table');
            tbody.innerHTML = '';

            data.forEach(kelas => {
                tbody.innerHTML += `
                    <tr>
                        <td class="border px-4 py-2">${kelas.id}</td>
                        <td class="border px-4 py-2">${kelas.name}</td>
                        <td class="border px-4 py-2">${kelas.kode_kelas}</td>
                        <td class="border px-4 py-2">${kelas.guru?.name ?? '-'}</td>
                        <td class="border px-4 py-2">
                            <button class="bg-blue-500 text-white px-3 py-1 rounded">Edit</button>
                            <button class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
                        </td>
                    </tr>
                `;
            });
        }

        loadKelas();
    </script>
</x-app-layout>
