<?php

namespace App\Http\Controllers;

use App\Models\DetailHampers;
use App\Models\Hampers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HampersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $hampers = Hampers::with('detail_hampers')->get();

            return response()->json([
                'success' => true,
                'message' => 'Data Hampers berhasil diambil!',
                'data' => $hampers
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
                    'harga' => $request->harga,
                    'kategori' => $request->harga,
                    'gambar' => $request->gambar,
                    'detail_hampers' => $request->detail_hampers
                ],
                [
                    'name' => 'required',
                    'harga' => 'required',
                    'kategori' => 'required',
                    'gambar' => 'required',
                    'detail_hampers' => 'required|json'
                ],
                [
                    'name.required' => 'Nama hampers wajib diisi!',
                    'harga.required' => 'Harga hampers wajib diisi!',
                    'kategori.required' => 'Kategori hampers wajib diisi!',
                    'gambar.required' => 'Gambar hampers wajib diisi!',
                    'detail_hampers.required' => 'Detail hampers wajib diisi!'
                ]
            );

            if ($validationData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validationData->errors()
                ], 400);
            }

            $image = $request->file('gambar');

            $originalName = str_replace([' ', '\t', '\n', '\r'], '', $image->getClientOriginalName());
            $img_name = time() . '_gambar_hampers_' . $originalName;
            Storage::disk('public')->putFileAs('images/hampers/', $image, $img_name);

            $hampers = Hampers::create([
                'name' => $request->name,
                'harga' => $request->harga,
                'kategori' => $request->kategori,
                'gambar' => 'images/hampers/' . $img_name,
            ]);

            $detail_hampers = json_decode($request->detail_hampers, true);
            $result = [];

            foreach ($detail_hampers as $data) {
                $detail_hampers_inserted = DetailHampers::create([
                    'hampers_id' => $hampers->id,
                    'produk_id' => $data['product_id'],
                    'jumlah' => $data['jumlah']

                ]);

                array_push($result, $detail_hampers_inserted);
            }

            $hampers->detail_hampers = $result;

            return response()->json([
                'success' => true,
                'message' => 'Hampers berhasil ditambahkan!',
                'data' => $hampers
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
            $hampers = Hampers::with('detail_hampers')->find($id);

            if ($hampers == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data hampers tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data hampers berhasil diambil!',
                'data' => $hampers
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
                    'harga' => $request->harga,
                    'kategori' => $request->harga,
                    'gambar' => $request->gambar,
                    'detail_hampers' => $request->detail_hampers
                ],
                [
                    'name' => 'required',
                    'harga' => 'required',
                    'kategori' => 'required',
                    'gambar' => 'nullable',
                    'detail_hampers' => 'required|json'
                ],
                [
                    'name.required' => 'Nama hampers wajib diisi!',
                    'harga.required' => 'Harga hampers wajib diisi!',
                    'kategori.required' => 'Kategori hampers wajib diisi!',
                    'gambar.required' => 'Gambar hampers wajib diisi!',
                    'detail_hampers.required' => 'Detail hampers wajib diisi!'
                ]
            );

            if ($validationData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validationData->errors()
                ], 400);
            }

            $hampers = Hampers::with('detail_hampers')->find($id);

            if ($hampers == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data hampers tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            $image = $request->file('gambar');

            if ($image != null) {
                Storage::disk('public')->delete($hampers->gambar);
                $originalName = str_replace([' ', '\t', '\n', '\r'], '', $image->getClientOriginalName());
                $img_name = time() . '_gambar_hampers_' . $originalName;
                Storage::disk('public')->putFileAs('images/hampers/', $image, $img_name);

                $hampers->update([
                    'name' => $request->name,
                    'harga' => $request->harga,
                    'kategori' => $request->kategori,
                    'gambar' => 'images/hampers/' . $img_name,
                ]);
            } else {
                $hampers->update([
                    'name' => $request->name,
                    'harga' => $request->harga,
                    'kategori' => $request->kategori,
                ]);
            }

            $detail_hampers_new = json_decode($request->detail_hampers, true);

            $hampers->detail_hampers->each->delete();
            // $detail_hampers = json_decode($request->detail_hampers, true);
            $result = [];

            foreach ($detail_hampers_new as $data) {
                $detail_hampers_inserted = DetailHampers::create([
                    'hampers_id' => $hampers->id,
                    'produk_id' => $data['product_id'],
                    'jumlah' => $data['jumlah']

                ]);

                array_push($result, $detail_hampers_inserted);
            }

            $hampers = Hampers::with('detail_hampers')->find($id);

            return response()->json([
                'success' => true,
                'message' => 'Hampers berhasil diperbarui!',
                'data' => $hampers
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
            $hampers = Hampers::with('detail_hampers')->find($id);

            if ($hampers == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data hampers tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            Storage::disk('public')->delete($hampers->gambar);
            $hampers->detail_hampers->each->delete();
            $hampers->delete();

            return response()->json([
                'success' => true,
                'message' => 'Hampers berhasil dihapus!',
                'data' => $hampers
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
