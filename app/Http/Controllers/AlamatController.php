<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AlamatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Alamat::where('user_id', Auth::user()->id)->get();

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
                'alamat' => 'required',
            ], [
                'alamat.required' => 'Alamat wajib diisi!',
            ]);

            // if validation fails
            if ($validatedData->fails()) {
                return response()->json(['message' => $validatedData->errors()], 422);
            }

            $data = Alamat::create([
                'user_id' => Auth::user()->id,
                'alamat' => $request->alamat,
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
            $data = Alamat::find($id);

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
                'alamat' => 'required',
            ], [
                'alamat.required' => 'Alamat wajib diisi!',
            ]);

            // if validation fails
            if ($validatedData->fails()) {
                return response()->json(['message' => $validatedData->errors()], 422);
            }

            $data = Alamat::find($id);

            $data->update([
                'user_id' => Auth::user()->id,
                'alamat' => $request->alamat,
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
            $data = Alamat::find($id);

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
