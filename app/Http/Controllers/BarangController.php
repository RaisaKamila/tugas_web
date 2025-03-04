<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // Menampilkan data barang
    public function index()
    {
        $barang = Barang::all();  // Ambil semua barang dari database
        return view('barang.index', compact('barang'));
    }

    // Menampilkan halaman tambah barang
    public function create()
    {
        return view('barang.create');
    }

    // Menyimpan data barang ke database
    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|unique:barang,id_barang',
            'nama_barang' => 'required',
            'deskripsi' => 'required',
            'stok' => 'required|integer',
        ]);

        Barang::create([
            'id_barang' => $request->id_barang,
            'nama_barang' => $request->nama_barang,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'diperbarui_pada' => now(),
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    // Menampilkan halaman edit barang
    public function edit($id_barang)
    {
        $barang = Barang::findOrFail($id_barang);  
        return view('barang.edit', compact('barang'));
    }

    // Menyimpan data barang yang sudah diedit
    public function update(Request $request, $id_barang)
    {
        $request->validate([
            'nama_barang' => 'required',
            'deskripsi' => 'required',
            'stok' => 'required|integer',
        ]);

        $barang = Barang::findOrFail($id_barang);
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'diperbarui_pada' => now(),
        ]);

        return redirect()->route('barang.index')->with('success', 'Data Barang berhasil diperbarui!');
    }

    // Menghapus data barang
    public function destroy($id_barang)
    {
        $barang = Barang::findOrFail($id_barang);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }
}
