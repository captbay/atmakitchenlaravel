<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $jabatan = Jabatan::all();

            return response()->json([
                'success' => true,
                'message' => 'Data Jabatan berhasil diambil!',
                'data' => $jabatan
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validationData = Validator::make(
                [
                    'name' => $request->name,
                ],
                [
                    'name' => 'required',
                ],
                [
                    'name.required' => 'Nama penitip wajib diisi!',
                ]
            );

            if ($validationData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validationData->errors()
                ], 400);
            }

            $jabatan = Jabatan::create([
                'name' => $request->name,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Jabatan berhasil ditambahkan!',
                'data' => $jabatan
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $jabatan = Jabatan::find($id);

            if ($jabatan == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Jabatan tidak ditemukan',
                    'data' => null
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data penitip berhasil diambil!',
                'data' => $jabatan
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        try {
            $validationData = Validator::make(
                [
                    'name' => $request->name,
                ],
                [
                    'name' => 'required',
                ],
                [
                    'name.required' => 'Jabatan wajib diisi!',
                ]
            );

            if ($validationData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validationData->errors()
                ], 400);
            }

            $jabatan = Jabatan::find($id);

            if ($jabatan == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Jabatan tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            $jabatan->update([
                'name' => $request->name,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Jabatan berhasil diperbarui!',
                'data' => $jabatan
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $jabatan = Jabatan::find($id);

            if ($jabatan == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data penitip tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            $jabatan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data penitip berhasil dihapus!',
                'data' => $jabatan
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
