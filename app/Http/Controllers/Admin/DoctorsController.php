<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\Doctor\DoctorService;
use App\Http\Requests\CreateDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;

class DoctorsController extends Controller
{
    public function __construct(
        private DoctorService $doctorService
    ){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = $this->doctorService->getAllDoctors();
        return view('admin.doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.doctors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateDoctorRequest $request)
    {
        $result = $this->doctorService->createDoctor($request->validated());
        if (!$result) {
            return redirect()->back()->withErrors(['error' => 'Failed to create doctor. Please try again.']);
        }
        return redirect()->route('admin.doctors.index')->with('success', 'Doctor created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $doctor = $this->doctorService->getDoctorById($id);
        return view('admin.doctors.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDoctorRequest $request, string $id)
    {
        $result = $this->doctorService->updateDoctor($id, $request->validated());
        if (!$result) {
            return redirect()->back()->withErrors(['error' => 'Failed to update doctor. Please try again.']);
        }
        return redirect()->route('admin.doctors.index')->with('success', 'Doctor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->doctorService->deleteDoctor($id);
        if (!$result) {
            return redirect()->back()->withErrors(['error' => 'Failed to delete doctor. Please try again.']);
        }
        return redirect()->route('admin.doctors.index')->with('success', 'Doctor deleted successfully.');
    }
}
