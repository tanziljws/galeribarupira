<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PetugasController extends Controller
{
    /**
     * Display a listing of petugas
     */
    public function index(): JsonResponse
    {
        try {
            $petugas = Petugas::select('id', 'username', 'nama', 'email', 'jabatan', 'telepon', 'created_at', 'updated_at')
                             ->get();

            return response()->json([
                'success' => true,
                'message' => 'Petugas retrieved successfully',
                'data' => $petugas,
                'count' => $petugas->count()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve petugas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified petugas
     */
    public function show($id): JsonResponse
    {
        try {
            $petugas = Petugas::select('id', 'username', 'nama', 'email', 'jabatan', 'telepon', 'created_at', 'updated_at')
                            ->find($id);

            if (!$petugas) {
                return response()->json([
                    'success' => false,
                    'message' => 'Petugas not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Petugas retrieved successfully',
                'data' => $petugas
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve petugas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created petugas
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'username' => 'required|string|max:255|unique:petugas',
                'password' => 'required|string|min:6',
                'nama' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:petugas',
                'jabatan' => 'required|string|max:255',
                'telepon' => 'required|string|max:20',
            ]);

            $petugas = Petugas::create([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'nama' => $request->nama,
                'email' => $request->email,
                'jabatan' => $request->jabatan,
                'telepon' => $request->telepon,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Petugas created successfully',
                'data' => [
                    'id' => $petugas->id,
                    'username' => $petugas->username,
                    'nama' => $petugas->nama,
                    'email' => $petugas->email,
                    'jabatan' => $petugas->jabatan,
                    'telepon' => $petugas->telepon,
                    'created_at' => $petugas->created_at,
                    'updated_at' => $petugas->updated_at
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
                'message' => 'Failed to create petugas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified petugas
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $petugas = Petugas::find($id);
            if (!$petugas) {
                return response()->json([
                    'success' => false,
                    'message' => 'Petugas not found'
                ], 404);
            }

            $request->validate([
                'username' => 'sometimes|required|string|max:255|unique:petugas,username,' . $petugas->id,
                'password' => 'sometimes|nullable|string|min:6',
                'nama' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|string|email|max:255|unique:petugas,email,' . $petugas->id,
                'jabatan' => 'sometimes|required|string|max:255',
                'telepon' => 'sometimes|required|string|max:20',
            ]);

            if ($request->filled('username')) $petugas->username = $request->username;
            if ($request->filled('password')) $petugas->password = bcrypt($request->password);
            if ($request->filled('nama')) $petugas->nama = $request->nama;
            if ($request->filled('email')) $petugas->email = $request->email;
            if ($request->filled('jabatan')) $petugas->jabatan = $request->jabatan;
            if ($request->filled('telepon')) $petugas->telepon = $request->telepon;
            $petugas->save();

            return response()->json([
                'success' => true,
                'message' => 'Petugas updated successfully',
                'data' => $petugas->only(['id','username','nama','email','jabatan','telepon','created_at','updated_at'])
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
                'message' => 'Failed to update petugas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified petugas
     */
    public function destroy($id): JsonResponse
    {
        try {
            $petugas = Petugas::find($id);
            if (!$petugas) {
                return response()->json([
                    'success' => false,
                    'message' => 'Petugas not found'
                ], 404);
            }

            // Check if petugas is referenced in other tables
            $postsCount = \Illuminate\Support\Facades\DB::table('posts')->where('petugas_id', $id)->count();
            $fotosCount = \Illuminate\Support\Facades\DB::table('foto')->where('user_id', $id)->count();
            $galeryCount = \Illuminate\Support\Facades\DB::table('galery')->where('user_id', $id)->count();

            if ($postsCount > 0 || $fotosCount > 0 || $galeryCount > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot delete petugas because it is referenced in other data',
                    'details' => [
                        'posts_count' => $postsCount,
                        'fotos_count' => $fotosCount,
                        'galery_count' => $galeryCount
                    ]
                ], 409);
            }

            $petugas->delete();

            return response()->json([
                'success' => true,
                'message' => 'Petugas deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete petugas',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}




