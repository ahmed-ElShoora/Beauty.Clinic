<?php

namespace App\Http\Services\Admin\Service;

use App\Traits\ManegeFiles;
use App\Models\Service;

class ServicesService
{
    use ManegeFiles;

    public function getAllServices()
    {
        return Service::all();
    }

    public function getServiceById($id)
    {
        return Service::find($id);
    }

    public function createService($data)
    {
        return Service::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'duration' => $data['duration'],
            'price' => $data['price'],
            'patch' => $data['patch'],
            'icon' => $this->uploadFile($data['icon'], 'services'),
        ]);
    }

    public function updateService($id, $data)
    {
        $service = $this->getServiceById($id);
        if (!$service) {
            return false;
        }

        $service->name = $data['name'];
        $service->description = $data['description'];
        $service->duration = $data['duration'];
        $service->price = $data['price'];
        $service->patch = $data['patch'];

        if (isset($data['icon'])) {
            $this->deleteFile($service->icon);
            $service->icon = $this->uploadFile($data['icon'], 'services');
        }

        return $service->save();
    }

    public function deleteService($id)
    {
        $service = $this->getServiceById($id);
        if (!$service) {
            return false;
        }
        $service->delete();
        return true;
    }
}