<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Log::info('Students index page');
        $students = Student::with('user')->whereHas('user', function($query){
            $query->where('is_deleted', null);
        })->latest()->paginate(10);
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'required|date',
            'address' => 'nullable|string',
            'gender' => 'required|string',
            'nationality' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $filename = null;
        if($request->hasFile('thumbnail')){
            $filename = Storage::disk('public')->putFile('students', $request->file('thumbnail'));
        }
  
        
        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'student',
        ]);
        Student::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'phone' => $validated['phone'],
            'date_of_birth' => $validated['date_of_birth'],
            'address' => $validated['address'],
            'gender' => $validated['gender'],
            'nationality' => $validated['nationality'],
            'thumbnail' => $filename,
            'user_id' => $user->id
        ]);

        return redirect()->route('students.index')
            ->with('success', '生徒の作成は成功した。');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::with('user')->findOrFail($id);
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::with('user')->findOrFail($id);
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Log::info($request->all());
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'required|date',
            'address' => 'nullable|string',
            'gender' => 'required|string',
            'nationality' => 'nullable|string',
            'thumbnail' => 'image|mimes:jped,png,jpg,gif|max:2048',
        ]);
        
        $student = Student::findOrFail($id);
        $user = User::findOrFail($student->user_id);
        $user->update([
            'email' => $validated['email'],
        ]);
        $filename = null;
        if($request->hasFile('thumbnail')){
            if($student->thumbnail){
                Storage::disk('public')->delete($student->thumbnail);
            }
            $filename = Storage::disk('public')->putFile('students', $request->file('thumbnail'));
            $student->update([
                'thumbnail' => $filename
            ]);
        }
        $student->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'phone' => $validated['phone'],
            'date_of_birth' => $validated['date_of_birth'],
            'address' => $validated['address'],
            'gender' => $validated['gender'],
            'nationality' => $validated['nationality'],
        ]);

        if($request['password']){
            $user->update([
                'password' => Hash::make($request['password']),
            ]);
        }

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Log::info('Student deleted');
        Log::info($id);
        $student = Student::findOrFail($id);
        $user = User::findOrFail($student->user_id);
        $user->update([
            'is_deleted' => true,
        ]);

        return redirect()->route('students.index')
            ->with('success', '生徒を削除しました');
    }


}
