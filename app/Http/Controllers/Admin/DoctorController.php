<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user()->name;
        return view('admin.doctors.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specializations = Specialization::all();
        return view('admin.doctors.create', compact('specializations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Doctor $doctor)
    {
        $request->validate([
            'address' => 'required|string',
            'photo' => 'nullable|image|mimes: jpg, png, jpeg',
            'curriculum' => 'nullable|image|mimes: jpg, png, jpeg',
            'phone' => 'required|string|min:6',
            'specialization' => 'nullable|exists: specializations , id|'
        ]);
        $data = $request->all();
        if (Arr::exists($data, 'photo')) {
            $img_path = Storage::put('uploads', $data['photo']);
            $data['photo'] = $img_path;
        }

        if (Arr::exists($data, 'curriculum')) {
            $img_path = Storage::put('uploads', $data['curriculum']);
            $data['curriculum'] = $img_path;
        }

        $doctor = new Doctor();
        $doctor->fill($data);
        $doctor->save();
        $user = Auth::user();
        $user->doctor_id = $doctor->id;
        $user->save();
        if (Arr::exists($data, 'specialization')) {
            $doctor->specializations()->attach($data['specialization']);
        }

        return view('welcome', compact('doctor'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Doctor $doctor)
    {
        $request->validate([
            'address' => 'required|string',
            'photo' => 'nullable|image|mimes: jpg, png, jpeg',
            'curriculum' => 'nullable|image|mimes: jpg, png, jpeg',
            'phone' => 'required|string|min:6',
            'specialization' => 'nullable|exists: specializations , id|'
        ]);
        $data = $request->all();
        if (Arr::exists($data, 'photo')) {
            if ($doctor->photo) {
                Storage::delete($doctor->photo);
            }
            $img_path = Storage::put('uploads', $data['photo']);
            $data['photo'] = $img_path;
        }
        if (Arr::exists($data, 'curriculum')) {
            if ($doctor->curriculum) {
                Storage::delete($doctor->curriculum);
            }
            $img_path = Storage::put('uploads', $data['curriculum']);
            $data['curriculum'] = $img_path;
        }
        $doctor->update($data);
        if (Arr::exists($data, 'specialization')) {
            $doctor->specializations()->sync($data['specializations']);
        } else if (count($doctor->specializations)) {
            $doctor->specializations()->detach();
        }
        return view('dashboard', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}