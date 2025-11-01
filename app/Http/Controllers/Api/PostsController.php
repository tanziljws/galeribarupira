<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PostsController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $posts = Post::select('id','judul','isi','kategori_id','petugas_id','status')->get();
            return response()->json([
                'success' => true,
                'message' => 'Posts retrieved successfully',
                'data' => $posts,
                'count' => $posts->count()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve posts',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $post = Post::select('id','judul','isi','kategori_id','petugas_id','status')->find($id);
            if (!$post) {
                return response()->json(['success' => false, 'message' => 'Post not found'], 404);
            }
            return response()->json(['success' => true, 'message' => 'Post retrieved successfully', 'data' => $post], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve post',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'isi' => 'nullable|string',
                'kategori_id' => 'nullable|exists:kategori,id',
                'petugas_id' => 'nullable|exists:petugas,id',
                'status' => 'nullable|string|in:published,draft,pending',
            ]);

            $post = Post::create([
                'judul' => $request->judul,
                'isi' => $request->isi ?? 'Tidak ada isi',
                'kategori_id' => $request->kategori_id,
                'petugas_id' => $request->petugas_id,
                'status' => $request->status ?? 'published',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Post created successfully',
                'data' => $post
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
                'message' => 'Failed to create post',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $post = Post::find($id);
            if (!$post) {
                return response()->json(['success' => false, 'message' => 'Post not found'], 404);
            }

            $request->validate([
                'judul' => 'sometimes|required|string|max:255',
                'isi' => 'sometimes|nullable|string',
                'kategori_id' => 'sometimes|nullable|exists:kategori,id',
                'petugas_id' => 'sometimes|nullable|exists:petugas,id',
                'status' => 'sometimes|nullable|string|in:published,draft,pending',
            ]);

            foreach (['judul','isi','kategori_id','petugas_id','status'] as $field) {
                if ($request->exists($field)) {
                    $post->$field = $request->$field;
                }
            }
            $post->save();

            return response()->json(['success' => true, 'message' => 'Post updated successfully', 'data' => $post], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update post',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $post = Post::find($id);
            if (!$post) {
                return response()->json(['success' => false, 'message' => 'Post not found'], 404);
            }
            $post->delete();
            return response()->json(['success' => true, 'message' => 'Post deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete post',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

