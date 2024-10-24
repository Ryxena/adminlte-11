<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $kelas = Kelas::doesntHave('siswa')->get();
            return response()->json([
                'data' => $kelas
            ]);
        }

        $kelas = Kelas::withCount('siswa')->get();
        return view('kelas.index', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
                'nama' => 'required|string|regex:/^Kelas\s+\d+[A-Z]?$/']
        );
        Kelas::create($request->all());
        return redirect()->route('kelas.index')->with('success', 'Kelas created successfully.');

    }

    public function show(Kelas $kelas)
    {
        //
    }

    public function edit(Kelas $kela)
    {
        return response()->json($kela);
    }

    public function update(Request $request, Kelas $kela)
    {
        $request->validate([
                'nama' => 'required|string|regex:/^Kelas\s+\d+[A-Z]?$/']
        );
        $kela->update($request->all());
        return redirect()->route('kelas.index')->with('success', 'Kelas updated successfully.');
    }

    public function destroy(Kelas $kela)
    {
        $kela->delete();
        return redirect()->route('kelas.index')->with('success', 'Kelas deleted successfully.');

    }
}
