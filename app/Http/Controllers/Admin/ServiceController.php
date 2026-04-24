<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Http\Services\Admin\Service\ServicesService;

class ServiceController extends Controller
{
    public function __construct(
        private ServicesService $servicesService
    ){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = $this->servicesService->getAllServices();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateServiceRequest $request)
    {
        $result = $this->servicesService->createService($request->validated());
        if (!$result) {
            return redirect()->back()->withErrors(['error' => 'Failed to create service. Please try again.']);
        }
        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = $this->servicesService->getServiceById($id);
        if (!$service) {
            return redirect()->route('admin.services.index')->withErrors(['error' => 'Service not found.']);
        }
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, string $id)
    {
        $result = $this->servicesService->updateService($id, $request->validated());
        if (!$result) {
            return redirect()->back()->withErrors(['error' => 'Failed to update service. Please try again.']);
        }
        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->servicesService->deleteService($id);
        if (!$result) {
            return redirect()->back()->withErrors(['error' => 'Failed to delete service. Please try again.']);
        }
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
