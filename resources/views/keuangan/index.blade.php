<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Manajemen Keuangan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg shadow-sm border border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-10">
                    <h3 class="text-lg font-medium text-gray-900 mb-4 text-center">Tambah Transaksi Baru</h3>
                    <form action="{{ route('keuangan.store') }}" method="POST" class="bg-gray-50 p-6 rounded-xl border border-gray-200 shadow-sm">
                        @csrf
                        <div class="grid grid-cols-1 gap-4">
                            <label class="block text-sm font-bold text-gray-700">Pilih Tanggal:</label>
                            <input type="date" name="tanggal" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>

                            <label class="block text-sm font-bold text-gray-700">Keterangan:</label>
                            <input type="text" name="keterangan" placeholder="Contoh: Bayar Listrik" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>

                            <label class="block text-sm font-bold text-gray-700">Nominal (Angka Saja):</label>
                            <input type="number" name="nominal" placeholder="Contoh: 100000" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>

                            <label class="block text-sm font-bold text-gray-700">Jenis Transaksi:</label>
                            <select name="jenis" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="pemasukan">Pemasukan</option>
                                <option value="pengeluaran">Pengeluaran</option>
                            </select>

                            <button type="submit" class="mt-4 w-full inline-flex justify-center rounded-md bg-indigo-600 py-3 px-4 text-sm font-bold text-white shadow hover:bg-indigo-700 transition-all">
                                SIMPAN TRANSAKSI
                            </button>
                        </div>
                    </form>
                </div>

                <hr class="my-10 border-gray-200">

                <div class="overflow-x-auto shadow-sm border rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider border-b">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider border-b">Keterangan</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider border-b">Jenis</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider border-b">Nominal</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider border-b">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($data_keuangan as $k)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-b">
                                    {{ \Carbon\Carbon::parse($k->tanggal)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-b">
                                    {{ $k->keterangan }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-b">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $k->jenis == 'pemasukan' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($k->jenis) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-b font-medium">
                                    Rp {{ number_format($k->nominal, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium border-b">
                                    <div class="flex justify-center space-x-3">
                                        <a href="{{ route('keuangan.edit', $k->id) }}" class="text-white rounded px-3 py-1 bg-green-500">Edit</a>
                                        <form action="{{ route('keuangan.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-white rounded px-3 py-1 bg-red-500">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-500 italic">
                                    Belum ada data transaksi. Silakan tambah data di atas.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>