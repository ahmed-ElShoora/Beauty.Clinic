<?php

namespace App\Http\Services\Admin\Doctor;

use App\Traits\ManegeFiles;
use App\Models\Doctor;

class DoctorService
{
    use ManegeFiles;

    public function getAllDoctors()
    {
        return Doctor::all();
    }

    public function getDoctorById($id)
    {
        return Doctor::find($id);
    }

    public function createDoctor($data)
    {
        return Doctor::create([
            'name' => $data['name'],
            'specialization' => $data['specialization'],
            'experience' => $data['experience'],
            'description' => $data['description'],
            'photo' => $this->uploadFile($data['photo'], 'doctors'),
        ]);
    }

    public function updateDoctor($id, $data)
    {
        $doctor = $this->getDoctorById($id);
        if (!$doctor) {
            return false;
        }

        $doctor->name = $data['name'];
        $doctor->specialization = $data['specialization'];
        $doctor->experience = $data['experience'];
        $doctor->description = $data['description'];

        if (isset($data['photo'])) {
            $this->deleteFile($doctor->photo);
            $doctor->photo = $this->uploadFile($data['photo'], 'doctors');
        }

        return $doctor->save();
    }

    public function deleteDoctor($id)
    {
        $doctor = $this->getDoctorById($id);
        if (!$doctor) {
            return false;
        }

        $this->deleteFile($doctor->photo);
        return $doctor->delete();
    }
}