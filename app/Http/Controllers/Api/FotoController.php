<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FotoController extends Controller
{
    /**
     * Display a listing of fotos
     */
    public function index(): JsonResponse
    {
        try {
            $fotos = Foto::with(['galery:id,nama', 'kategori:id,nama,slug', 'user:id,name'])
                        ->select('id', 'judul', 'deskripsi', 'file_path', 'file_name', 'thumbnail_path', 'galery_id', 'kategori_id', 'user_id', 'views', 'likes', 'status', 'created_at', 'updated_at')
                        ->get();

            return response()->json([
                'success' => true,
                'message' => 'Photos retrieved successfully',
                'data' => $fotos,
                'count' => $fotos->count()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve photos',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified foto
     */
    public function show($id): JsonResponse
    {
        try {
            $foto = Foto::with(['galery:id,nama,deskripsi', 'kategori:id,nama,slug,color', 'user:id,name,email'])
                       ->select('id', 'judul', 'deskripsi', 'file_path', 'file_name', 'file_size', 'file_type', 'thumbnail_path', 'galery_id', 'kategori_id', 'user_id', 'views', 'likes', 'status', 'created_at', 'updated_at')
                       ->find($id);

            if (!$foto) {
                return response()->json([
                    'success' => false,
                    'message' => 'Photo not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Photo retrieved successfully',
                'data' => $foto
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve photo',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get photos by kategori
     */
    public function byKategori($kategori_id): JsonResponse
    {
        try {
            $fotos = Foto::with(['galery:id,nama', 'kategori:id,nama,slug', 'user:id,name'])
                        ->where('kategori_id', $kategori_id)
                        ->select('id', 'judul', 'deskripsi', 'file_path', 'file_name', 'thumbnail_path', 'galery_id', 'kategori_id', 'user_id', 'views', 'likes', 'status', 'created_at', 'updated_at')
                        ->get();

            return response()->json([
                'success' => true,
                'message' => 'Photos by kategori retrieved successfully',
                'data' => $fotos,
                'count' => $fotos->count(),
                'kategori_id' => $kategori_id
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve photos by kategori',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get photos by galery
     */
    public function byGalery($galery_id): JsonResponse
    {
        try {
            $fotos = Foto::with(['galery:id,nama', 'kategori:id,nama,slug', 'user:id,name'])
                        ->where('galery_id', $galery_id)
                        ->select('id', 'judul', 'deskripsi', 'file_path', 'file_name', 'thumbnail_path', 'galery_id', 'kategori_id', 'user_id', 'views', 'likes', 'status', 'created_at', 'updated_at')
                        ->get();

            return response()->json([
                'success' => true,
                'message' => 'Photos by galery retrieved successfully',
                'data' => $fotos,
                'count' => $fotos->count(),
                'galery_id' => $galery_id
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve photos by galery',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created foto
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'file_path' => 'required|string',
                'file_name' => 'required|string|max:255',
                'file_size' => 'nullable|integer',
                'file_type' => 'nullable|string|max:100',
                'thumbnail_path' => 'nullable|string',
                'galery_id' => 'required|exists:galery,id',
                'kategori_id' => 'required|exists:kategori,id',
                'user_id' => 'required|exists:users,id',
                'views' => 'nullable|integer|min:0',
                'likes' => 'nullable|integer|min:0',
                'status' => 'nullable|string|in:active,inactive,draft',
            ]);

            $foto = Foto::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'file_path' => $request->file_path,
                'file_name' => $request->file_name,
                'file_size' => $request->file_size ?? 0,
                'file_type' => $request->file_type ?? 'image/jpeg',
                'thumbnail_path' => $request->thumbnail_path,
                'galery_id' => $request->galery_id,
                'kategori_id' => $request->kategori_id,
                'user_id' => $request->user_id,
                'views' => $request->views ?? 0,
                'likes' => $request->likes ?? 0,
                'status' => $request->status ?? 'active',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Foto created successfully',
                'data' => [
                    'id' => $foto->id,
                    'judul' => $foto->judul,
                    'deskripsi' => $foto->deskripsi,
                    'file_path' => $foto->file_path,
                    'file_name' => $foto->file_name,
                    'file_size' => $foto->file_size,
                    'file_type' => $foto->file_type,
                    'thumbnail_path' => $foto->thumbnail_path,
                    'galery_id' => $foto->galery_id,
                    'kategori_id' => $foto->kategori_id,
                    'user_id' => $foto->user_id,
                    'views' => $foto->views,
                    'likes' => $foto->likes,
                    'status' => $foto->status,
                    'created_at' => $foto->created_at,
                    'updated_at' => $foto->updated_at
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
                'message' => 'Failed to create foto',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified foto
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $foto = Foto::find($id);
            if (!$foto) {
                return response()->json([
                    'success' => false,
                    'message' => 'Photo not found'
                ], 404);
            }

            $request->validate([
                'judul' => 'sometimes|required|string|max:255',
                'deskripsi' => 'sometimes|nullable|string',
                'file_path' => 'sometimes|required|string',
                'file_name' => 'sometimes|required|string|max:255',
                'file_size' => 'sometimes|nullable|integer',
                'file_type' => 'sometimes|nullable|string|max:100',
                'thumbnail_path' => 'sometimes|nullable|string',
                'galery_id' => 'sometimes|exists:galery,id',
                'kategori_id' => 'sometimes|exists:kategori,id',
                'user_id' => 'sometimes|exists:users,id',
                'views' => 'sometimes|nullable|integer|min:0',
                'likes' => 'sometimes|nullable|integer|min:0',
                'status' => 'sometimes|nullable|string|in:active,inactive,draft',
            ]);

            foreach (['judul','deskripsi','file_path','file_name','thumbnail_path','galery_id','kategori_id','user_id','views','likes','status'] as $field) {
                if ($request->exists($field)) {
                    $foto->$field = $request->$field;
                }
            }
            
            // Handle file_size and file_type with defaults
            if ($request->exists('file_size')) {
                $foto->file_size = $request->file_size ?? 0;
            }
            if ($request->exists('file_type')) {
                $foto->file_type = $request->file_type ?? 'image/jpeg';
            }
            $foto->save();

            return response()->json([
                'success' => true,
                'message' => 'Foto updated successfully',
                'data' => $foto->only(['id','judul','deskripsi','file_path','file_name','file_size','file_type','thumbnail_path','galery_id','kategori_id','user_id','views','likes','status','created_at','updated_at'])
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
                'message' => 'Failed to update foto',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified foto
     */
    public function destroy($id): JsonResponse
    {
        try {
            $foto = Foto::find($id);
            if (!$foto) {
                return response()->json([
                    'success' => false,
                    'message' => 'Photo not found'
                ], 404);
            }

            $foto->delete();

            return response()->json([
                'success' => true,
                'message' => 'Foto deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete foto',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}