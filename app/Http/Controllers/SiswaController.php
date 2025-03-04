<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    //menampilkan halaman data siswa
    public function index(Request $request)
{
    $query = Siswa::query();

    //query search
    if ($request->has('search') && $request->has('column')) {
        $column = $request->column;
        $search = $request->search;
        $query->where($column, 'LIKE', "%{$search}%");
    }

    $siswa = $query->get();
    return view('siswa.index', compact('siswa'));
}

    //menampilkan halaman tambah siswa
    public function create()
    {
        return view('siswa.tambah_siswa'); 
    }

    // Menyimpan data siswa ke database
    public function store(Request $request)
    {
        $request->validate([
            'NISN' => 'required|unique:siswa,NISN',
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
        ]);

        Siswa::create([
            'NISN' => $request->NISN,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'dibuat_pada' => now(),
            'diperbarui_pada' => now(),
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan');
    }

    // Menampilkan halaman edit siswa
    public function edit($NISN)
    {
        $siswa = Siswa::where('NISN', $NISN)->first();
    
        if (!$siswa) {
            return redirect()->route('siswa.index')->with('error', 'Siswa tidak ditemukan.');
        }

        return view('siswa.edit', compact('siswa')); 
    }

    // Menyimpan data siswa yang sudah diedit
    public function update(Request $request, $NISN)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:10',
            'jurusan' => 'required|string|max:100',
        ]);

        $siswa = Siswa::findOrFail($NISN);
        $siswa->update([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    //menghapus data siswa
    public function destroy($NISN)
    {
        $siswa = Siswa::where('NISN', $NISN)->first();
        $siswa->delete();
        return redirect()->route('siswa.index');
    
    }

}