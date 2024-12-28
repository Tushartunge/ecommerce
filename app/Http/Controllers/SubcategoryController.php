<?php
namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        return Subcategory::with('category')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);
        return Subcategory::create($request->all());
    }

    public function show(Subcategory $subcategory)
    {
        return $subcategory->load('category');
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);
        $subcategory->update($request->all());
        return $subcategory;
    }

    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return response(null, 204);
    }
}

