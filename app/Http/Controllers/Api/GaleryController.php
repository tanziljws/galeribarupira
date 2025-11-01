<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Galery;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GaleryController extends Controller
{
    /**
     * Display a listing of galery
     */
    public function index(): JsonResponse
    {
        try {
            $galery = Galery::with(['kategori:id,nama,slug', 'user:id,name,email'])
                           ->select('id', 'nama', 'deskripsi', 'cover_image', 'kategori_id', 'user_id', 'status', 'created_at', 'updated_at')
                           ->get();

            return response()->json([
                'success' => true,
                'message' => 'Galery retrieved successfully',
                'data' => $galery,
                'count' => $galery->count()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve galery',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified galery
     */
    public function show($id): JsonResponse
    {
        try {
            $galery = Galery::with(['kategori:id,nama,slug,color', 'user:id,name,email'])
                          ->select('id', 'nama', 'deskripsi', 'cover_image', 'kategori_id', 'user_id', 'status', 'created_at', 'updated_at')
                          ->find($id);

            if (!$galery) {
                return response()->json([
                    'success' => false,
                    'message' => 'Galery not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Galery retrieved successfully',
                'data' => $galery
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve galery',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get photos for a specific galery
     */
    public function fotos($id): JsonResponse
    {
        try {
            $galery = Galery::find($id);

            if (!$galery) {
                return response()->json([
                    'success' => false,
                    'message' => 'Galery not found'
                ], 404);
            }

            $fotos = $galery->fotos()
                           ->with(['kategori:id,nama,slug', 'user:id,name'])
                           ->select('id', 'judul', 'deskripsi', 'file_path', 'file_name', 'thumbnail_path', 'kategori_id', 'user_id', 'views', 'likes', 'status', 'created_at', 'updated_at')
                           ->get();

            return response()->json([
                'success' => true,
                'message' => 'Photos for galery retrieved successfully',
                'data' => [
                    'galery' => $galery->only(['id', 'nama', 'deskripsi']),
                    'fotos' => $fotos,
                    'count' => $fotos->count()
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve photos for galery',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created galery
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'cover_image' => 'nullable|string',
                'kategori_id' => 'required|exists:kategori,id',
                'user_id' => 'required|exists:users,id',
                'status' => 'nullable|string|in:active,inactive,draft',
            ]);

            $galery = Galery::create([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'cover_image' => $request->cover_image,
                'kategori_id' => $request->kategori_id,
                'user_id' => $request->user_id,
                'status' => $request->status ?? 'active',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Galery created successfully',
                'data' => [
                    'id' => $galery->id,
                    'nama' => $galery->nama,
                    'deskripsi' => $galery->deskripsi,
                    'cover_image' => $galery->cover_image,
                    'kategori_id' => $galery->kategori_id,
                    'user_id' => $galery->user_id,
                    'status' => $galery->status,
                    'created_at' => $galery->created_at,
                    'updated_at' => $galery->updated_at
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
                'message' => 'Failed to create galery',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified galery
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $galery = Galery::find($id);
            if (!$galery) {
                return response()->json([
                    'success' => false,
                    'message' => 'Galery not found'
                ], 404);
            }

            $request->validate([
                'nama' => 'sometimes|required|string|max:255',
                'deskripsi' => 'sometimes|nullable|string',
                'cover_image' => 'sometimes|nullable|string',
                'kategori_id' => 'sometimes|exists:kategori,id',
                'user_id' => 'sometimes|exists:users,id',
                'status' => 'sometimes|nullable|string|in:active,inactive,draft',
            ]);

            if ($request->filled('nama')) $galery->nama = $request->nama;
            if ($request->exists('deskripsi')) $galery->deskripsi = $request->deskripsi;
            if ($request->exists('cover_image')) $galery->cover_image = $request->cover_image;
            if ($request->filled('kategori_id')) $galery->kategori_id = $request->kategori_id;
            if ($request->filled('user_id')) $galery->user_id = $request->user_id;
            if ($request->exists('status')) $galery->status = $request->status;
            $galery->save();

            return response()->json([
                'success' => true,
                'message' => 'Galery updated successfully',
                'data' => $galery->only(['id','nama','deskripsi','cover_image','kategori_id','user_id','status','created_at','updated_at'])
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
                'message' => 'Failed to update galery',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified galery
     */
    public function destroy($id): JsonResponse
    {
        try {
            $galery = Galery::find($id);
            if (!$galery) {
                return response()->json([
                    'success' => false,
                    'message' => 'Galery not found'
                ], 404);
            }

            $galery->delete();

            return response()->json([
                'success' => true,
                'message' => 'Galery deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete galery',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}






