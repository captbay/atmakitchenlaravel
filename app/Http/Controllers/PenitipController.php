<?php

namespace App\Http\Controllers;

use App\Models\Penitip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDO;

class PenitipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $penitip = Penitip::all();

            return response()->json([
                'success' => true,
                'message' => 'Data Penitip berhasil diambil!',
                'data' => $penitip
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

            $penitip = Penitip::create([
                'name' => $request->bahan_baku_id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Penitip berhasil ditambahkan!',
                'data' => $penitip
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
            $penitip = Penitip::find($id);

            if ($penitip == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Penitip tidak ditemukan',
                    'data' => null
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data penitip berhasil diambil!',
                'data' => $penitip
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
                    'name.required' => 'Nama penitip wajib diisi!',
                ]
            );

            if ($validationData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validationData->errors()
                ], 400);
            }

            $penitip = Penitip::find($id);

            if ($penitip == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Penitip tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            $penitip->update([
                'name' => $request->name,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Penitip berhasil diperbarui!',
                'data' => $penitip
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
            $penitip = Penitip::find($id);

            if ($penitip == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data penitip tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            $penitip->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data penitip berhasil dihapus!',
                'data' => $penitip
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
