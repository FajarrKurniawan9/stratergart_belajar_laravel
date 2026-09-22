<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        return response()->json(Siswa::with(['kelas', 'kartuPelajar'])->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'id_kelas' => 'required|exists:kelas,id',
        ]);

        $siswa = Siswa::create($validated);
        $siswa->load(['kelas', 'kartuPelajar']);

        return response()->json($siswa, 201);
    }

    public function show(string $id)
    {
        $siswa = Siswa::with(['kelas', 'kartuPelajar'])->findOrFail($id);

        return response()->json($siswa);
    }

    public function update(Request $request, string $id)
    {
        $siswa = Siswa::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'id_kelas' => 'sometimes|required|exists:kelas,id',
        ]);

        $siswa->update($validated);
        $siswa->load(['kelas', 'kartuPelajar']);

        return response()->json($siswa);
    }

    public function destroy(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return response()->json(['message' => 'Siswa dihapus']);
    }
}
