<?php

namespace App\Http\Controllers;

use App\Models\PembelianBahanBaku;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PembelianBahanBakuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $pembelian_bahan_baku = PembelianBahanBaku::with('bahan_baku')->get();

            return response()->json([
                'success' => true,
                'message' => 'Data Pembelian Bahan Baku berhasil diambil!',
                'data' => $pembelian_bahan_baku
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
                    'bahan_baku_id' => $request->bahan_baku_id,
                    'jumlah' => $request->jumlah,
                    'total_harga' => $request->total_harga,
                ],
                [
                    'bahan_baku_id' => 'required',
                    'jumlah' => 'required',
                    'total_harga' => 'required',
                ],
                [
                    'bahan_baku_id.required' => 'Bahan baku wajib dipilih!',
                    'jumlah.required' => 'Jumlah pembelian bahan baku wajib diisi!',
                    'total_harga.required' => 'Total harga pembelian bahan baku wajib diisi!',
                ]
            );

            if ($validationData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validationData->errors()
                ], 400);
            }

            $pembelian_bahan_baku = PembelianBahanBaku::create([
                'bahan_baku_id' => $request->bahan_baku_id,
                'jumlah' => $request->jumlah,
                'total_harga' => $request->total_harga,
                'waktu' => Carbon::now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pembelian bahan baku berhasil ditambahkan!',
                'data' => $pembelian_bahan_baku
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
            $pembelian_bahan_baku = PembelianBahanBaku::with('bahan_baku')->find($id);

            if ($pembelian_bahan_baku == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Pembelian Bahan Baku tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data Pembelian Bahan Baku berhasil diambil!',
                'data' => $pembelian_bahan_baku
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
                    'bahan_baku_id' => $request->bahan_baku_id,
                    'jumlah' => $request->jumlah,
                    'total_harga' => $request->total_harga,
                ],
                [
                    'bahan_baku_id' => 'required',
                    'jumlah' => 'required',
                    'total_harga' => 'required',
                ],
                [
                    'bahan_baku_id.required' => 'Bahan baku wajib dipilih!',
                    'jumlah.required' => 'Jumlah pembelian bahan baku wajib diisi!',
                    'total_harga.required' => 'Total harga pembelian bahan baku wajib diisi!',
                ]
            );

            if ($validationData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validationData->errors()
                ], 400);
            }

            $pembelian_bahan_baku = PembelianBahanBaku::with('bahan_baku')->find($id);

            $pembelian_bahan_baku->update([
                'bahan_baku_id' => $request->bahan_baku_id,
                'jumlah' => $request->jumlah,
                'total_harga' => $request->total_harga,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pembelian bahan baku berhasil diperbarui!',
                'data' => $pembelian_bahan_baku
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
            $pembelian_bahan_baku = PembelianBahanBaku::find($id);

            if ($pembelian_bahan_baku == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Pembelian Bahan Baku tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            $pembelian_bahan_baku->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Pembelian Bahan Baku berhasil dihapus!',
                'data' => $pembelian_bahan_baku
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
