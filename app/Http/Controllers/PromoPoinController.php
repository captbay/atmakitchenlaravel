<?php

namespace App\Http\Controllers;

use App\Models\PromoPoin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class PromoPoinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $promoPoin = PromoPoin::all();

            return response()->json([
                'success' => true,
                'message' => 'Data Promo Poin berhasil diambil!',
                'data' => $promoPoin
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
                    'kelipatan' => $request->kelipatan,
                    'bonus_poin' => $request->bonus_poin
                ],
                [
                    'kelipatan' => 'required',
                    'bonus_poin' => 'required'
                ],
                [
                    'kelipatan.required' => 'Kelipatan wajib diisi!',
                    'bonus_poin.required' => 'Bonus poin wajib diisi!'
                ]
            );

            if ($validationData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validationData->errors()
                ], 400);
            }

            $promoPoin = PromoPoin::create([
                'kelipatan' => $request->kelipatan,
                'bonus_poin' => $request->bonus_poin
            ]);

            if ($promoPoin) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data Promo Poin berhasil disimpan!',
                    'data' => $promoPoin
                ], 200);
            }
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
            $promoPoin = PromoPoin::find($id);

            if ($promoPoin == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Promo Poin tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data Promo Poin berhasil diambil!',
                'data' => $promoPoin
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
                    'kelipatan' => $request->kelipatan,
                    'bonus_poin' => $request->bonus_poin
                ],
                [
                    'kelipatan' => 'required',
                    'bonus_poin' => 'required'
                ],
                [
                    'kelipatan.required' => 'Kelipatan wajib diisi!',
                    'bonus_poin.required' => 'Bonus poin wajib diisi!'
                ]
            );

            if ($validationData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validationData->errors()
                ], 400);
            }

            $promoPoin = PromoPoin::find($id);

            if ($promoPoin == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Promo Poin tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            $promoPoin->update([
                'kelipatan' => $request->kelipatan,
                'bonus_poin' => $request->bonus_poin
            ]);

            if ($promoPoin) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data Promo Poin berhasil diubah!',
                    'data' => $promoPoin
                ], 200);
            }
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
            $promoPoin = PromoPoin::find($id);

            if ($promoPoin == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Promo Poin tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            $promoPoin->delete();

            if ($promoPoin) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data Promo Poin berhasil dihapus!',
                    'data' => $promoPoin
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
