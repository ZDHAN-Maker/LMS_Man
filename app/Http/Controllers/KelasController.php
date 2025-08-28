<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class KelasController extends BaseController
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        // Kalau role guru -> hanya kelas yang dia ajar
        if ($user->role === 'guru') {
            $kelas = Kelas::with('guru')
                        ->where('guru_id', $user->id)
                        ->get();
        }
        // Kalau role siswa -> semua kelas (atau nanti bisa filter berdasarkan relasi siswa)
        elseif ($user->role === 'siswa') {
            $kelas = Kelas::with('guru')->get();
        }
        // Kalau admin -> semua kelas
        else {
            $kelas = Kelas::with('guru')->get();
        }

        return response()->json($kelas);
    }

    /**
     * Store a newly created resource in storage.
     * Hanya admin yang boleh tambah kelas
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $request->validate([
            'name' => 'required|string',
            'guru_id' => 'required|exists:users,id',
        ]);

        $kelas = Kelas::create([
            'name' => $request->name,
            'guru_id' => $request->guru_id,
            'kode_kelas' => strtoupper(Str::slug($request->name . '-' . date('Y')))
        ]);

        $kelas->load('guru');

        return response()->json([
            'message' => 'Kelas created',
            'kelas' => $kelas
        ], 201);
    }

    /**
     * Show detail kelas
     */
    public function show($id)
    {
        $kelas = Kelas::with('guru')->findOrFail($id);
        return response()->json($kelas);
    }

    /**
     * Update kelas (hanya admin)
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();

        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|string',
            'guru_id' => 'sometimes|exists:users,id',
        ]);

        $data = $request->only(['name', 'guru_id']);

        if ($request->has('name')) {
            $data['kode_kelas'] = strtoupper(Str::slug($request->name . '-' . date('Y')));
        }

        $kelas->update($data);
        $kelas->load('guru');

        return response()->json([
            'message' => 'Kelas updated',
            'kelas' => $kelas
        ]);
    }

    /**
     * Delete kelas (hanya admin)
     */
    public function destroy($id)
    {
        $user = auth()->user();

        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return response()->json([
            'message' => 'Kelas deleted'
        ]);
    }
}
