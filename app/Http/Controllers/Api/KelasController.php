<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        return response()->json(Kelas::with('siswas.kartuPelajar')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:255',
        ]);

        $kelas = Kelas::create($validated);

        return response()->json($kelas, 201);
    }

    public function show(string $id)
    {
        $kelas = Kelas::with('siswas.kartuPelajar')->findOrFail($id);

        return response()->json($kelas);
    }

    public function update(Request $request, string $id)
    {
        $kelas = Kelas::findOrFail($id);

        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:255',
        ]);

        $kelas->update($validated);

        return response()->json($kelas);
    }

    public function destroy(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return response()->json(['message' => 'Kelas dihapus']);
    }
}
