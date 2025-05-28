<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Department;
class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::where('is_deleted', null)->paginate(10);
        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            if($validated['thumbnail']){
                Storage::disk('public')->delete($validated['thumbnail']);
            }
            $validated['thumbnail'] = Storage::disk('public')->putFile('departments', $request->file('thumbnail'));

        }

        Department::create($validated);

        return redirect()->route('departments.index')->with('success', '部署を追加しました');
    }

    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }

    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $filename = null;
        if ($request->hasFile('thumbnail')) {
            if($department->thumbnail){
                Storage::disk('public')->delete($department->thumbnail);
            }
            $filename = Storage::disk('public')->putFile('departments', $request->file('thumbnail'));
            $department->update([
                'thumbnail' => $filename
            ]);
        }

        $department->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('departments.index')->with('success', '部署を更新しました');
    }

    public function destroy(int $department_id)
    { 
        $department = Department::findOrFail($department_id);
        $department->update([
            'is_deleted' => true,
        ]);

        return redirect()->route('departments.index')
            ->with('success', '部署を削除しました');
    }
}

