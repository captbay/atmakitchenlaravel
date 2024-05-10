<?php

namespace App\Http\Controllers;

use App\Models\BonusGaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BonusGajiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $bonus_gaji = BonusGaji::with('jabatan')->get();

            return response()->json([
                'success' => true,
                'message' => 'Data Bonus Gaji berhasil diambil!',
                'data' => $bonus_gaji
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
                    'jabatan_id' => $request->jabatan_id,
                    'gaji' => $request->gaji,
                    'bonus' => $request->bonus
                ],
                [
                    'jabatan_id' => 'required',
                    'gaji' => 'required',
                    'bonus' => 'required',
                ],
                [
                    'jabatan_id.required' => 'Jabatan wajib dipilih!',
                    'gaji.required' => 'Gaji wajib diisi!',
                    'bonus.required' => 'Bonus wajib diisi!'
                ]
            );

            if ($validationData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validationData->errors()
                ], 400);
            }

            $bonus_gaji = BonusGaji::create([
                'jabatan_id' => $request->jabatan_id,
                'gaji' => $request->gaji,
                'bonus' => $request->bonus,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Bonus Gaji berhasil ditambahkan!',
                'data' => $bonus_gaji
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
            $bonus_gaji = BonusGaji::with('jabatan')->find($id);

            if ($bonus_gaji == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Bonus Gaji tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data Bonus Gaji berhasil diambil!',
                'data' => $bonus_gaji
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
                    'jabatan_id' => $request->jabatan_id,
                    'gaji' => $request->gaji,
                    'bonus' => $request->bonus
                ],
                [
                    'jabatan_id' => 'required',
                    'gaji' => 'required',
                    'bonus' => 'required',
                ],
                [
                    'jabatan_id.required' => 'Jabatan wajib dipilih!',
                    'gaji.required' => 'Gaji wajib diisi!',
                    'bonus.required' => 'Bonus wajib diisi!'
                ]
            );

            if ($validationData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validationData->errors()
                ], 400);
            }

            $bonus_gaji = BonusGaji::with('jabatan')->find($id);

            if ($bonus_gaji == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Bonus Gaji tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            $bonus_gaji->update([
                'jabatan_id' => $request->jabatan_id,
                'gaji' => $request->gaji,
                'bonus' => $request->bonus,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Bonus Gaji berhasil diperbarui!',
                'data' => $bonus_gaji
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
            $bonus_gaji = BonusGaji::find($id);

            if ($bonus_gaji == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Bonus Gaji tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            $bonus_gaji->delete();

            return response()->json([
                'success' => true,
                'message' => 'Bonus Gaji berhasil dihapus!',
                'data' => $bonus_gaji
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
