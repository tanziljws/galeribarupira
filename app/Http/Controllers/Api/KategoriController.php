<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class KategoriController extends Controller
{
    /**
     * Display a listing of kategori
     */
    public function index(): JsonResponse
    {
        try {
            $kategori = Kategori::select('id', 'nama', 'deskripsi', 'slug', 'icon', 'color', 'created_at', 'updated_at')
                               ->get();

            return response()->json([
                'success' => true,
                'message' => 'Kategori retrieved successfully',
                'data' => $kategori,
                'count' => $kategori->count()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve kategori',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified kategori
     */
    public function show($id): JsonResponse
    {
        try {
            $kategori = Kategori::select('id', 'nama', 'deskripsi', 'slug', 'icon', 'color', 'created_at', 'updated_at')
                              ->find($id);

            if (!$kategori) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kategori not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Kategori retrieved successfully',
                'data' => $kategori
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve kategori',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get photos for a specific kategori
     */
    public function fotos($id): JsonResponse
    {
        try {
            $kategori = Kategori::find($id);

            if (!$kategori) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kategori not found'
                ], 404);
            }

            $fotos = $kategori->fotos()
                             ->with(['galery:id,nama', 'user:id,name'])
                             ->select('id', 'judul', 'deskripsi', 'file_path', 'file_name', 'thumbnail_path', 'galery_id', 'kategori_id', 'user_id', 'views', 'likes', 'status', 'created_at', 'updated_at')
                             ->get();

            return response()->json([
                'success' => true,
                'message' => 'Photos for kategori retrieved successfully',
                'data' => [
                    'kategori' => $kategori->only(['id', 'nama', 'deskripsi', 'slug', 'color']),
                    'fotos' => $fotos,
                    'count' => $fotos->count()
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve photos for kategori',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get galery for a specific kategori
     */
    public function galery($id): JsonResponse
    {
        try {
            $kategori = Kategori::find($id);

            if (!$kategori) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kategori not found'
                ], 404);
            }

            $galery = $kategori->galery()
                              ->with(['user:id,name'])
                              ->select('id', 'nama', 'deskripsi', 'cover_image', 'kategori_id', 'user_id', 'status', 'created_at', 'updated_at')
                              ->get();

            return response()->json([
                'success' => true,
                'message' => 'Galery for kategori retrieved successfully',
                'data' => [
                    'kategori' => $kategori->only(['id', 'nama', 'deskripsi', 'slug', 'color']),
                    'galery' => $galery,
                    'count' => $galery->count()
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve galery for kategori',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created kategori
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'slug' => 'nullable|string|max:255|unique:kategori',
                'icon' => 'nullable|string|max:255',
                'color' => 'nullable|string|max:7',
            ]);

            // Generate slug if not provided
            if (!$request->slug) {
                $slug = \Illuminate\Support\Str::slug($request->nama);
            } else {
                $slug = $request->slug;
            }

            $kategori = Kategori::create([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'slug' => $slug,
                'icon' => $request->icon,
                'color' => $request->color,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Kategori created successfully',
                'data' => [
                    'id' => $kategori->id,
                    'nama' => $kategori->nama,
                    'deskripsi' => $kategori->deskripsi,
                    'slug' => $kategori->slug,
                    'icon' => $kategori->icon,
                    'color' => $kategori->color,
                    'created_at' => $kategori->created_at,
                    'updated_at' => $kategori->updated_at
                ]
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create kategori',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified kategori
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $kategori = Kategori::find($id);
            if (!$kategori) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kategori not found'
                ], 404);
            }

            $request->validate([
                'nama' => 'sometimes|required|string|max:255',
                'deskripsi' => 'sometimes|nullable|string',
                'slug' => 'sometimes|nullable|string|max:255|unique:kategori,slug,' . $kategori->id,
                'icon' => 'sometimes|nullable|string|max:255',
                'color' => 'sometimes|nullable|string|max:7',
            ]);

            if ($request->filled('nama')) $kategori->nama = $request->nama;
            if ($request->exists('deskripsi')) $kategori->deskripsi = $request->deskripsi;
            if ($request->exists('slug')) $kategori->slug = $request->slug ?: \Illuminate\Support\Str::slug($kategori->nama);
            if ($request->exists('icon')) $kategori->icon = $request->icon;
            if ($request->exists('color')) $kategori->color = $request->color;
            $kategori->save();

            return response()->json([
                'success' => true,
                'message' => 'Kategori updated successfully',
                'data' => $kategori->only(['id','nama','deskripsi','slug','icon','color','created_at','updated_at'])
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update kategori',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified kategori
     */
    public function destroy($id): JsonResponse
    {
        try {
            $kategori = Kategori::find($id);
            if (!$kategori) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kategori not found'
                ], 404);
            }

            $kategori->delete();

            return response()->json([
                'success' => true,
                'message' => 'Kategori deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete kategori',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}






