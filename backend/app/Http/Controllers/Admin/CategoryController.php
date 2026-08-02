<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Menampilkan seluruh data kategori
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    // Menampilkan halaman form tambah kategori
    public function create()
    {
        return view('admin.categories.create');
    }

    // Menyimpan data kategori baru ke database
    public function store(Request $request)
    {
        Category::create([
            'name' => $request->name
        ]);

        return redirect('/admin/categories');
    }

    // Menampilkan halaman edit kategori
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // Memperbarui data kategori yang dipilih
    public function update(Request $request, Category $category)
    {
        $category->update([
            'name' => $request->name
        ]);

        return redirect('/admin/categories');
    }

    // Menghapus data kategori dari database
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect('/admin/categories');
    }
}