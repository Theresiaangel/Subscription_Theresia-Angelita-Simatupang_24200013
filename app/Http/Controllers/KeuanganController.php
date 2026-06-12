<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function index()
    {
        // Mengambil semua data keuangan
        $data_keuangan = Keuangan::orderBy('created_at', 'desc')->get();
        return view('keuangan.index', compact('data_keuangan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal'    => 'required|date', // Tambahkan ini
            'keterangan' => 'required|string|max:255',
            'nominal'    => 'required|numeric',
            'jenis'      => 'required|in:pemasukan,pengeluaran',
        ]);

        \App\Models\Keuangan::create($request->all());

        return redirect()->route('keuangan.index')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $keuangan = Keuangan::findOrFail($id);
        return view('keuangan.edit', compact('keuangan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required|string|max:255',
            'nominal'    => 'required|numeric',
            'jenis'      => 'required|in:pemasukan,pengeluaran',
        ]);

        $keuangan = Keuangan::findOrFail($id);
        $keuangan->update($request->all());

        return redirect()->route('keuangan.index')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        Keuangan::findOrFail($id)->delete();
        return redirect()->route('keuangan.index')->with('success', 'Data berhasil dihapus!');
    }
}