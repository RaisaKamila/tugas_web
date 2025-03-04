<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\siswa;
use App\Models\barang;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    //menampilkan halaman data transaksi
    public function index()
    {
        $transaksis = Transaksi::with(['barang', 'siswa'])->get();
        return view('transaksi.index', compact('transaksis'));
    }

    //menampilkan halaman tambah transaksi
    public function create()
    {
        $siswas = Siswa::all();
        $barangs = Barang::all();
        return view('transaksi.create', compact('siswas', 'barangs'));
    }

    //menyimpan data transaksi ke database
    public function store(Request $request)
    {
        $request->validate([
            'siswa_nisn' => 'required', 
            'barang_id' => 'required',
            'jumlah' => 'required|integer',
            'status' => 'required|string',
            'tanggal_transaksi' => 'required|date',
        ]);

        // Menangani pengurangan stok saat peminjaman
        $barang = Barang::findOrFail($request->barang_id);
        if ($request->status == 'Dipinjam') {
            // Pastikan stok barang ada
            if ($barang->stok < $request->jumlah) {
                return redirect()->back()->with('error', 'Stok barang tidak mencukupi untuk dipinjam!');
            }

            // Kurangi stok barang
            $barang->stok -= $request->jumlah;
            $barang->save();
        }

        // Menyimpan transaksi
        Transaksi::create([
            'siswa_nisn' => $request->siswa_nisn,
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'status' => $request->status,
            'tanggal_transaksi' => $request->tanggal_transaksi,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    //menampilkan halaman edit transaksi
    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $siswas = Siswa::all();
        $barangs = Barang::all();
        return view('transaksi.edit', compact('transaksi', 'siswas', 'barangs'));
    }

    //menyimpan data transaksi yang sudah diedit
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $request->validate([
            'barang_id' => 'required|exists:barang,id_barang',
            'jumlah' => 'required|integer|min:1',
            'status' => 'required|in:Dipinjam,Dikembalikan',
            'tanggal_kembali' => 'nullable|date',
        ]);

        // Menangani pengembalian barang
        $barang = Barang::findOrFail($transaksi->barang_id);
        if ($request->status === 'Dikembalikan') {
            if (empty($request->tanggal_kembali)) {
            $request->merge(['tanggal_kembali' => now()->toDateString()]);
        }

        // Menambah stok barang saat dikembalikan
        $barang->stok += $transaksi->jumlah;
        $barang->save();
    }

    // Memperbarui transaksi
    $transaksi->update($request->all());

    // Jika status berubah dari dipinjam menjadi dikembalikan, stok akan ditambah.
    return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
}

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
