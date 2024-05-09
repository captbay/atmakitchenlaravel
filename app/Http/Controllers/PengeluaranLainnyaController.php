<?php

namespace App\Http\Controllers;

use App\Models\PengeluaranLainnya;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PengeluaranLainnyaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = PengeluaranLainnya::with('user')->get();

            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Success Get Data',
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
            $validatedData = Validator::make($request->all(), [
                'name' => 'required',
                'total_harga' => 'required',
            ], [
                'name.required' => 'Nama wajib diisi!',
                'total_harga.required' => 'Total Harga wajib diisi!',
            ]);

            // if validation fails
            if ($validatedData->fails()) {
                return response()->json(['message' => $validatedData->errors()], 422);
            }

            $data = PengeluaranLainnya::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'total_harga' => $request->total_harga,
                'waktu' => Carbon::now(),
            ]);

            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Berhasil menambahkan data',
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
            $data = PengeluaranLainnya::with('user')->find($id);

            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Success Get Data',
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
            $validatedData = Validator::make($request->all(), [
                'name' => 'required',
                'total_harga' => 'required',
            ], [
                'name.required' => 'Nama wajib diisi!',
                'total_harga.required' => 'Total Harga wajib diisi!',
            ]);

            // if validation fails
            if ($validatedData->fails()) {
                return response()->json(['message' => $validatedData->errors()], 422);
            }

            $data = PengeluaranLainnya::find($id);

            $data->update([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'total_harga' => $request->total_harga,
                'waktu' => Carbon::now(),
            ]);

            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Success Get Data',
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
            $data = PengeluaranLainnya::find($id);

            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan',
                ], 404);
            }

            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus data',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
