<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::has('kelas')->get();
        $kelas = Kelas::all();
        return view('siswa.index', compact('siswa', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'nis' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'id_kelas' => 'required|exists:kelas,id_kelas',
        ]);

        Siswa::create($request->all());
        return redirect()->route('siswa.index')->with('success', 'Siswa created successfully.');
    }

    public function edit(Siswa $siswa)
    {
        return response()->json($siswa);
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'nis' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'id_kelas' => 'required|exists:kelas,id_kelas',
        ]);

        $siswa->update($request->all());
        return redirect()->route('siswa.index')->with('success', 'Siswa updated successfully.');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Siswa deleted successfully.');
    }
}
