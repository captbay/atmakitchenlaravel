<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $produk = Produk::all();

            return response()->json([
                'success' => true,
                'message' => 'Data Produk berhasil diambil!',
                'data' => $produk
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
                    'kategori' => $request->kategori,
                    'kuota_harian' => $request->kuota_harian,
                    'harga' => $request->harga,
                    'gambar' => $request->gambar
                ],
                [
                    'name' => 'required',
                    'kategori' => 'required',
                    'kuota_harian' => 'required',
                    'harga' => 'required',
                    'gambar' => 'required|file|mimes:jpg,jpeg,png|max:2048',
                ],
                [
                    'name.required' => 'Nama produk wajib diisi!',
                    'kategori.required' => 'Kategori produk wajib diisi!',
                    'kuota_harian.required' => 'Kuota harian produk wajib diisi!',
                    'harga.required' => 'Harga produk wajib diisi!',
                    'gambar.required' => 'Gambar produk wajib diisi!',
                    'gambar.file' => 'Gambar produk harus berupa file!',
                    'gambar.mimes' => 'Gambar produk harus berupa file gambar dengan format: jpg, jpeg, png!',
                    'gambar.max' => 'Ukuran gambar produk terlalu besar! Maksimal 2MB.'
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
            $img_name = time() . '_gambar_produk_' . $originalName;
            Storage::disk('public')->putFileAs('images/produk/', $image, $img_name);

            $produk = Produk::create([
                'name' => $request->name,
                'kategori' => $request->kategori,
                'kuota_harian' => $request->kuota_harian,
                'harga' => $request->harga,
                'gambar' => 'images/produk/' . $img_name,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data Produk berhasil disimpan!',
                'data' => $produk
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
            $produk = Produk::find($id);

            if ($produk == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Produk tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data Produk berhasil diambil!',
                'data' => $produk
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
                    'kategori' => $request->kategori,
                    'kuota_harian' => $request->kuota_harian,
                    'harga' => $request->harga,
                    'gambar' => $request->gambar
                ],
                [
                    'name' => 'required',
                    'kategori' => 'required',
                    'kuota_harian' => 'required',
                    'harga' => 'required',
                    'gambar' => 'file|mimes:jpg,jpeg,png|max:2048|nullable',
                ],
                [
                    'name.required' => 'Nama produk wajib diisi!',
                    'kategori.required' => 'Kategori produk wajib diisi!',
                    'kuota_harian.required' => 'Kuota harian produk wajib diisi!',
                    'harga.required' => 'Harga produk wajib diisi!',
                    'gambar.file' => 'Gambar produk harus berupa file!',
                    'gambar.mimes' => 'Gambar produk harus berupa file gambar dengan format: jpg, jpeg, png!',
                    'gambar.max' => 'Ukuran gambar produk terlalu besar! Maksimal 2MB.'
                ]
            );

            if ($validationData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validationData->errors()
                ], 400);
            }

            $produk = Produk::find($id);

            $image = $request->file('gambar');

            if ($image != null) {
                Storage::disk('public')->delete($produk->gambar);
                $originalName = str_replace([' ', '\t', '\n', '\r'], '', $image->getClientOriginalName());
                $img_name = time() . '_gambar_produk_' . $originalName;
                Storage::disk('public')->putFileAs('images/produk/', $image, $img_name);
                $path = 'images/produk/' . $img_name;

                $produk->update([
                    'name' => $request->name,
                    'kategori' => $request->kategori,
                    'kuota_harian' => $request->kuota_harian,
                    'harga' => $request->harga,
                    'gambar' => $path,
                ]);
            } else {
                $produk->update([
                    'name' => $request->name,
                    'kategori' => $request->kategori,
                    'kuota_harian' => $request->kuota_harian,
                    'harga' => $request->harga,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data Produk berhasil diubah!',
                'data' => $produk
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
            $produk = Produk::find($id);

            if ($produk == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Produk tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            Storage::disk('public')->delete($produk->gambar);
            $produk->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Produk berhasil dihapus!',
                'data' => $produk
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
