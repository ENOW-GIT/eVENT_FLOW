<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function create()
        {
            return view('admin.category.create');
        }

        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
            ]);

            //Category::create([$request->all()]);

            return redirect()->route('admin.category.create')->with('success', 'CATEGORY CREATED SUCCESSFULLY');
        }
    
}
