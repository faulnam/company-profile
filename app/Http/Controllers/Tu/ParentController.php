<?php

namespace App\Http\Controllers\Tu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ParentController extends Controller
{
    public function index(Request $request)
    {
        $query = User::role('walimurid')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $parents = $query->paginate(10)->withQueryString();
        return view('tu.parents.index', compact('parents'));
    }

    public function show($id)
    {
        $parent = User::findOrFail($id);
        $children = \App\Models\Student::where('parent_id', $id)->with('classroom')->get();
        return view('tu.parents.show', compact('parent', 'children'));
    }
}
