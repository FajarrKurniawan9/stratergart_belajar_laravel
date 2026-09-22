<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KartuPelajar;
use Illuminate\Http\Request;

class KartuPelajarController extends Controller
{
    public function index()
    {
        return response()->json(KartuPelajar::with('siswa.kelas')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_kartu' => 'required|string|max:255|unique:kartu_pelajars,nomor_kartu',
            'id_siswa' => 'required|exists:siswas,id|unique:kartu_pelajars,id_siswa',
        ]);

        $kartu = KartuPelajar::create($validated);
        $kartu->load('siswa.kelas');

        return response()->json($kartu, 201);
    }

    public function show(string $id)
    {
        $kartu = KartuPelajar::with('siswa.kelas')->findOrFail($id);

        return response()->json($kartu);
    }

    public function update(Request $request, string $id)
    {
        $kartu = KartuPelajar::findOrFail($id);

        $validated = $request->validate([
            'nomor_kartu' => 'sometimes|required|string|max:255|unique:kartu_pelajars,nomor_kartu,'.$kartu->id,
            'id_siswa' => 'sometimes|required|exists:siswas,id|unique:kartu_pelajars,id_siswa,'.$kartu->id,
        ]);

        $kartu->update($validated);
        $kartu->load('siswa.kelas');

        return response()->json($kartu);
    }

    public function destroy(string $id)
    {
        $kartu = KartuPelajar::findOrFail($id);
        $kartu->delete();

        return response()->json(['message' => 'Kartu pelajar dihapus']);
    }
}
