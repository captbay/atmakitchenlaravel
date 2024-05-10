<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BahanBakuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $bahan_baku = BahanBaku::all();

            return response()->json([
                'success' => true,
                'message' => 'Data Bahan Baku berhasil diambil!',
                'data' => $bahan_baku
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
                    'stok' => $request->stok,
                    'satuan' => $request->satuan,
                ],
                [
                    'name' => 'required',
                    'stok' => 'required',
                    'satuan' => 'required',
                ],
                [
                    'name.required' => 'Nama bahan baku wajib diisi!',
                    'stok.required' => 'Stok bahan baku wajib diisi!',
                    'satuan.required' => 'Satuan bahan baku wajib diisi!',
                    'harga.required' => 'Harga produk wajib diisi!'
                ]
            );

            if ($validationData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validationData->errors()
                ], 400);
            }

            $bahan_baku = BahanBaku::create([
                'name' => $request->name,
                'stok' => $request->stok,
                'satuan' => $request->satuan,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Bahan Baku berhasil ditambahkan!',
                'data' => $bahan_baku
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $bahan_baku = BahanBaku::find($id);

            if ($bahan_baku == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Bahan Baku tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data Bahan Baku berhasil diambil!',
                'data' => $bahan_baku
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
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
                    'stok' => $request->stok,
                    'satuan' => $request->satuan,
                ],
                [
                    'name' => 'required',
                    'stok' => 'required',
                    'satuan' => 'required',
                ],
                [
                    'name.required' => 'Nama bahan baku wajib diisi!',
                    'stok.required' => 'Stok bahan baku wajib diisi!',
                    'satuan.required' => 'Satuan bahan baku wajib diisi!',
                    'harga.required' => 'Harga produk wajib diisi!'
                ]
            );

            if ($validationData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validationData->errors()
                ], 400);
            }

            $bahan_baku = BahanBaku::find($id);

            if ($bahan_baku == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Bahan Baku tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            $bahan_baku->update([
                'name' => $request->name,
                'stok' => $request->stok,
                'satuan' => $request->satuan,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Bahan Baku berhasil diperbarui!',
                'data' => $bahan_baku
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $bahan_baku = BahanBaku::find($id);

            if ($bahan_baku == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Bahan Baku tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            $bahan_baku->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Bahan Baku berhasil dihapus!',
                'data' => $bahan_baku
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
