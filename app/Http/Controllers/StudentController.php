<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return response()->json([
            'message' => 'Students fetched successfully',
            'students' => $students
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'roll_no' => 'required|integer|unique:students,roll_no',
            'contact' => 'required|numeric|digits_between:7,15',
        ], [
            'name.required' => 'The student name is required.',
            'name.string' => 'The student name must be a string.',
            'name.max' => 'The student name may not be greater than 255 characters.',
            'class.required' => 'The student class is required.',
            'class.string' => 'The student class must be a string.',
            'class.max' => 'The student class may not be greater than 255 characters.',
            'roll_no.required' => 'The student roll number is required.',
            'roll_no.integer' => 'The student roll number must be an integer.',
            'roll_no.unique' => 'The student roll number has already been taken.',
            'contact.required' => 'The student contact number is required.',
            'contact.numeric' => 'The student contact number must be a number.',
            'contact.digits_between' => 'The student contact number must be between 7 and 15 digits.',
        ]);

        $student = Student::create($validatedData);

        return response()->json([
            'message' => 'Student created successfully',
            'student' => $student
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return response()->json([
            'message' => 'Student fetched successfully',
            'student' => $student
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'roll_no' => [
                'required',
                'integer',
                Rule::unique('students', 'roll_no')->ignore($student->id),
            ],
            'contact' => 'required|numeric|digits_between:7,15',
        ], [
            'name.required' => 'The student name is required.',
            'name.string' => 'The student name must be a string.',
            'name.max' => 'The student name may not be greater than 255 characters.',
            'class.required' => 'The student class is required.',
            'class.string' => 'The student class must be a string.',
            'class.max' => 'The student class may not be greater than 255 characters.',
            'roll_no.required' => 'The student roll number is required.',
            'roll_no.integer' => 'The student roll number must be an integer.',
            'roll_no.unique' => 'The student roll number has already been taken by another student.',
            'contact.required' => 'The student contact number is required.',
            'contact.numeric' => 'The student contact number must be a number.',
            'contact.digits_between' => 'The student contact number must be between 7 and 15 digits.',
        ]);

        $student->update($validatedData);

        return response()->json([
            'message' => 'Student updated successfully',
            'student' => $student
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json([
            'message' => 'Student deleted successfully'
        ], 200);
    }
}
