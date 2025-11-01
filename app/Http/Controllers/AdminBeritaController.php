<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class AdminBeritaController extends Controller
{
    /**
     * Check if admin is logged in
     */
    private function checkAdminAuth()
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login')
                ->with('error', 'Silakan login terlebih dahulu!');
        }
        return null;
    }

    public function index()
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        // Get admin data
        $admin = \DB::table('petugas')
            ->where('id', Session::get('admin_id'))
            ->first();

        // Order by created_at DESC untuk menampilkan berita terbaru di atas
        $news = News::orderByDesc('created_at')->paginate(10);
        return view('admin.berita.index', compact('news', 'admin'));
    }

    public function create()
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'excerpt' => 'nullable|string|max:300',
            'content' => 'required|string',
            'status' => 'required|in:draft,published,archived',
            'jenis' => 'required|in:berita,pengumuman',
            'categories' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $slug = Str::slug($validated['title']);
        if (News::where('slug', $slug)->exists()) {
            $slug .= '-' . Str::random(5);
        }

        $imagePath = null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('news', 'public');
        }

        News::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'] ?? null,
            'image_path' => $imagePath,
            'status' => $validated['status'],
            'jenis' => $validated['jenis'],
            'categories' => $validated['categories'] ?? null,
            'published_at' => $validated['published_at'] ?? null,
            'user_id' => Session::get('admin_id'),
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit(News $beritum)
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $berita = $beritum; // route-model binding alias
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, News $beritum)
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $berita = $beritum;
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'excerpt' => 'nullable|string|max:300',
            'content' => 'required|string',
            'status' => 'required|in:draft,published,archived',
            'jenis' => 'required|in:berita,pengumuman',
            'categories' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $data = [
            'title' => $validated['title'],
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'] ?? null,
            'status' => $validated['status'],
            'jenis' => $validated['jenis'],
            'categories' => $validated['categories'] ?? null,
            'published_at' => $validated['published_at'] ?? null,
        ];

        // Handle image upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Delete old image if exists
            if ($berita->image_path && file_exists(storage_path('app/public/' . $berita->image_path))) {
                unlink(storage_path('app/public/' . $berita->image_path));
            }
            
            // Store new image
            $data['image_path'] = $request->file('image')->store('news', 'public');
        }

        $berita->update($data);
        return redirect()->route('admin.berita.index')->with('success', 'Berita diperbarui');
    }

    public function destroy(News $beritum)
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $berita = $beritum;
        
        // Delete image file if exists
        if ($berita->image_path && file_exists(storage_path('app/public/' . $berita->image_path))) {
            unlink(storage_path('app/public/' . $berita->image_path));
        }
        
        $berita->delete();
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus');
    }

    /**
     * Show berita details (for view button)
     */
    public function show(News $beritum)
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $berita = $beritum;
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $berita->id,
                'title' => $berita->title,
                'excerpt' => $berita->excerpt,
                'content' => $berita->content,
                'jenis' => $berita->jenis,
                'status' => $berita->status,
                'categories' => $berita->categories,
                'published_at' => $berita->published_at,
                'image_path' => $berita->image_path,
                'created_at' => $berita->created_at->format('d M Y H:i'),
                'updated_at' => $berita->updated_at->format('d M Y H:i')
            ]
        ]);
    }
}




