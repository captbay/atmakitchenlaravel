<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $resep = Resep::with('produk', 'bahan_baku')->get();

            return response()->json([
                'success' => true,
                'message' => 'Data resep berhasil diambil!',
                'data' => $resep
            ], 200);
        }catch(\Exception $e){
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
                    'produk_id' => $request->produk_id,
                    'bahan_baku_id' => $request->stok,
                    'jumlah' => $request->satuan,
                ],
                [
                    'produk_id' => 'required',
                    'bahan_baku_id' => 'required',
                    'jumlah' => 'required',
                ],
                [
                    'produk_id.required' => 'Produk wajib dipilih!',
                    'bahan_baku_id.required' => 'Bahan baku wajib dipilih!',
                    'jumlah.required' => 'Jumlah wajib diisi!'
                ]
            );

            if ($validationData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validationData->errors()
                ], 400);
            }

            $resep = Resep::create([
                'produk_id' => $request->produk_id,
                'bahan_baku' => $request->bahan_baku,
                'jumlah' => $request->jumlah,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Resep berhasil ditambahkan!',
                'data' => $resep
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
        try{
            $resep = Resep::with('produk', 'bahan_baku')->find($id);

            if($resep == null){
                return response()->json([
                    'success' => false,
                    'message' => 'Data resep tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data resep berhasil diambil!',
                'data' => $resep
            ], 200);

        }catch(\Exception $e){
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
                    'produk_id' => $request->produk_id,
                    'bahan_baku_id' => $request->stok,
                    'jumlah' => $request->satuan,
                ],
                [
                    'produk_id' => 'required',
                    'bahan_baku_id' => 'required',
                    'jumlah' => 'required',
                ],
                [
                    'produk_id.required' => 'Produk wajib dipilih!',
                    'bahan_baku_id.required' => 'Bahan baku wajib dipilih!',
                    'jumlah.required' => 'Jumlah wajib diisi!'
                ]
            );

            if ($validationData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validationData->errors()
                ], 400);
            }

            $resep = Resep::with('produk', 'bahan_baku')->find($id);

            if ($resep == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data resep tidak ditemukan',
                    'data' => null
                ], 404);
            }

            $resep->update([
                'produk_id' => $request->produk_id,
                'bahan_baku' => $request->bahan_baku,
                'jumlah' => $request->jumlah,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Resep berhasil diperbarui!',
                'data' => $resep
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $resep = Resep::find($id);

            if ($resep == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data resep tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            $resep->delete();

            return response()->json([
                'success' => true,
                'message' => 'Resep berhasil dihapus!',
                'data' => $resep
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
