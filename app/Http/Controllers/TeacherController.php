<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::with('user')->whereHas('user', function($query){
            $query->where('is_deleted', null);
        })->latest()->paginate(10);;
        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = \App\Models\Department::all();
        return view('teachers.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info($request->all());
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string',
            'gender' => 'nullable|string',
            'qualification' => 'nullable|string',
            'position' => 'nullable|string',
            'department_id' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($request->hasFile('thumbnail')) {
            $filename = Storage::disk('public')->putFile('teachers', $request->file('thumbnail'));
        }

        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'teacher',
        ]);
        \App\Models\Teacher::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'phone' => $validated['phone'],
            'date_of_birth' => $validated['date_of_birth'],
            'address' => $validated['address'],
            'gender' => $validated['gender'],
            'qualification' => $validated['qualification'],
            'position' => $validated['position'],
            'department_id' => $validated['department_id'],
            'thumbnail' => $filename,
            'user_id' => $user->id
        ]);

        return redirect()->route('teachers.index')->with('success', '教師を追加しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        $departments = Department::all();
        return view('teachers.edit', compact('teacher', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Log::info($id);
        Log::info($request->all());
        $user = User::join('teachers', 'users.id', '=', 'teachers.user_id')->where('teachers.id', $id)->first();
        Log::info($user);
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->user_id,            
            'phone' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string',
            'gender' => 'nullable|string',
            'qualification' => 'nullable|string',
            'position' => 'nullable|string',
            'department_id' => 'nullable|string',
        ];

        if($request->filled('thumbnail')){
            $rules['thumbnail'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
        }
        if ($request->filled('current_password') || $request->filled('password')) {
            $rules['current_password'] = ['required', 'current_password'];
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
            $rules['password_confirmation'] = ['required', 'string'];
        }
        $validated = $request->validate($rules);

        $teacher = \App\Models\Teacher::findOrFail($id);

        if($request['password']){
            $user->update([
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);
        } else {
            $user->update([
                'email' => $validated['email'],
            ]);
        }

        $filename = null;
        if($request->hasFile('thumbnail')){
            if($teacher->thumbnail){
                Storage::disk('public')->delete($teacher->thumbnail);
            }
            $filename = Storage::disk('public')->putFile('teachers', $request->file('thumbnail'));
            $teacher->update([
                'thumbnail' => $filename
            ]);
        }
        $teacher->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'phone' => $validated['phone'],
            'date_of_birth' => $validated['date_of_birth'],
            'address' => $validated['address'],
            'gender' => $validated['gender'],
            'qualification' => $validated['qualification'],
            'position' => $validated['position'],
            'department_id' => $validated['department_id'],
        ]);

        return redirect()->route('teachers.index')->with('success', '教師の情報を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        $user = User::findOrFail($teacher->user_id);
        $user->update([
            'is_deleted' => true,
        ]);

        return redirect()->route('teachers.index')->with('success', '教師の情報を削除しました');
    }
}
