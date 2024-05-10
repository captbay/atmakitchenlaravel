<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Karyawan::with('jabatan')->get();

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
            $validationData = Validator::make(
                [
                    'jabatan_id' => $request->jabatan_id,
                    'name' => $request->name
                ],
                [
                    'jabatan_id' => 'required',
                    'name' => 'required'
                ],
                [
                    'jabatan_id' => 'Jabatan wajib dipilih',
                    'name.required' => 'Nama penitip wajib diisi!',
                ]
            );

            if ($validationData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validationData->errors()
                ], 400);
            }

            $karyawan = Karyawan::create([
                'jabatan_id' => $request->jabatan_id,
                'name' => $request->name,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Karyawan berhasil ditambahkan!',
                'data' => $karyawan
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
            $karyawan = Karyawan::with('jabatan')->find($id);

            if ($karyawan == null) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data Karyawan tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data Karyawan berhasil ditemukan!',
                'data' => $karyawan
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
                    'name' => $request->name
                ],
                [
                    'jabatan_id' => 'required',
                    'name' => 'required'
                ],
                [
                    'jabatan_id' => 'Jabatan wajib dipilih',
                    'name.required' => 'Nama penitip wajib diisi!',
                ]
            );


            if ($validationData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validationData->errors()
                ], 400);
            }

            $karyawan = Karyawan::find($id);

            if ($karyawan == null) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data Karyawan tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            $karyawan->update([
                'jabatan_id' => $request->jabatan_id,
                'name' => $request->name,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Karyawan berhasil ditambahkan!',
                'data' => $karyawan
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
            $karyawan = Karyawan::find($id);

            if ($karyawan == null) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data Karyawan tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            $karyawan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Karyawan berhasil dihapus!',
                'data' => $karyawan
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
