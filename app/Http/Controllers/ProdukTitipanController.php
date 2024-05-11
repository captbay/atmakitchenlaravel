<?php

namespace App\Http\Controllers;

use App\Models\ProdukTitipan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProdukTitipanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $produkTitipan = ProdukTitipan::all();

            return response()->json([
                'success' => true,
                'message' => 'Data Produk Titipan berhasil diambil!',
                'data' => $produkTitipan
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
                    'penitip_id' => $request->penitip_id,
                    'name' => $request->name,
                    'harga' => $request->harga,
                    'kategori' => $request->kategori,
                    'gambar' => $request->gambar
                ],
                [
                    'penitip_id' => 'required',
                    'name' => 'required',
                    'harga' => 'required',
                    'kategori' => 'required',
                    'gambar' => 'required|file|mimes:jpg,jpeg,png|max:2048',
                ],
                [
                    'penitip_id.required' => 'Penitip wajib dipilih!',
                    'name.required' => 'Nama produk titipan wajib diisi!',
                    'harga.required' => 'Harga produk titipan wajib diisi!',
                    'kategori.required' => 'Kategori produk titipan wajib diisi!',
                    'gambar.required' => 'Gambar produk titipan wajib diisi!',
                    'gambar.file' => 'Gambar produk titipan harus berupa file!',
                    'gambar.mimes' => 'Gambar produk titipan harus berupa file gambar dengan format: jpg, jpeg, png!',
                    'gambar.max' => 'Ukuran gambar produk titipan terlalu besar! Maksimal 2MB.'
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
            $img_name = time() . '_gambar_produk_titipan_' . $originalName;
            Storage::disk('public')->putFileAs('images/produk_titipan/', $image, $img_name);

            $produk_titipan = ProdukTitipan::create([
                'penitip_id' => $request->penitip_id,
                'name' => $request->name,
                'harga' => $request->harga,
                'kategori' => $request->kategori,
                'gambar' => 'images/produk_titipan/' . $img_name,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data Produk Titipan berhasil disimpan!',
                'data' => $produk_titipan
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
            $produk_titipan = ProdukTitipan::find($id);

            if ($produk_titipan == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Produk Titipan tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data Produk Titipan berhasil diambil!',
                'data' => $produk_titipan
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
                    'penitip_id' => $request->penitip_id,
                    'name' => $request->name,
                    'harga' => $request->harga,
                    'kategori' => $request->kategori,
                    'gambar' => $request->gambar
                ],
                [
                    'penitip_id' => 'required',
                    'name' => 'required',
                    'harga' => 'required',
                    'kategori' => 'required',
                    'gambar' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                ],
                [
                    'penitip_id.required' => 'Penitip wajib dipilih!',
                    'name.required' => 'Nama produk titipan wajib diisi!',
                    'harga.required' => 'Harga produk titipan wajib diisi!',
                    'kategori.required' => 'Kategori produk titipan wajib diisi!',
                    'gambar.file' => 'Gambar produk titipan harus berupa file!',
                    'gambar.mimes' => 'Gambar produk titipan harus berupa file gambar dengan format: jpg, jpeg, png!',
                    'gambar.max' => 'Ukuran gambar produk titipan terlalu besar! Maksimal 2MB.'
                ]
            );

            if ($validationData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validationData->errors()
                ], 400);
            }

            $produk_titipan = ProdukTitipan::find($id);

            if ($produk_titipan == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Produk Titipan tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            $image = $request->file('gambar');

            if ($image != null) {
                Storage::disk('public')->delete($produk_titipan->gambar);
                $originalName = str_replace([' ', '\t', '\n', '\r'], '', $image->getClientOriginalName());
                $img_name = time() . '_gambar_produk_titipan_' . $originalName;
                Storage::disk('public')->putFileAs('images/produk_titipan/', $image, $img_name);
                $path = 'images/produk_titipan/' . $img_name;

                $produk_titipan->update([
                    'name' => $request->name,
                    'kategori' => $request->kategori,
                    'kuota_harian' => $request->kuota_harian,
                    'harga' => $request->harga,
                    'gambar' => $path,
                ]);
            } else {
                $produk_titipan->update([
                    'name' => $request->name,
                    'kategori' => $request->kategori,
                    'kuota_harian' => $request->kuota_harian,
                    'harga' => $request->harga,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data Produk Titipan berhasil diubah!',
                'data' => $produk_titipan
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
            $produkTitipan = ProdukTitipan::find($id);

            if($produkTitipan == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Produk Titipan tidak ditemukan!',
                    'data' => null
                ], 404);
            }
            
            $produkTitipan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Produk Titipan berhasil dihapus!',
                'data' => $produkTitipan
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
