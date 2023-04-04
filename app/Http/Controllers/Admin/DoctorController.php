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
        $doctor = Auth::user()->doctor;
        $name = Auth::user()->name;
        $specializations = Auth::user()->doctor->specializations->toArray();

        return view('admin.doctors.index', compact('name', 'doctor', 'specializations'));
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
    public function store(Request $request, Doctor $doctor)
    {
        $request->validate(
            [
                'address' => 'required|string',
                'phone' => 'required|unique|min:6',
                'curriculum' => 'nullable|mimetipe: png, jpg, jpeg',
                'photo' => 'nullable|mimetipe: png, jpg, jpeg'
            ],
            [
                'address.required' => "l'indirizzo è obbligatiorio",
                'address.string' => "il capo inserito è errato",
                'phone.required' => "il numero di recapito è obbligatorio",
                'phone.unique' => "il Numero è già stato utilizzato",
                'phone.min' => "il numero deve contenere almeno 6 caratteri",
                'curriculum.mimetipe' => "il file inserito per il curriculum non è valido",
                'photo.mimetipe' => "il file inserito per la foto non è valido",
            ]
        );
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
        // mbe ??????
        return view('dashboard', compact('doctor'));
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
    public function edit(Doctor $doctor)
    {
        $specializations = Specialization::all();
        return view('admin.doctors.edit', compact('doctor', 'specializations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        $request->validate(
            [
                'address' => 'required|string',
                'phone' => 'required|unique|min:6',
                'curriculum' => 'nullable|mimetipe: png, jpg, jpeg',
                'photo' => 'nullable|mimetipe: png, jpg, jpeg'
            ]
            ,
            [
                'address.required' => "l'indirizzo è obbligatiorio",
                'address.string' => "il capo inserito è errato",
                'phone.required' => "il numero di recapito è obbligatorio",
                'phone.unique' => "il Numero è già stato utilizzato",
                'phone.min' => "il numero deve contenere almeno 6 caratteri",
                'curriculum.mimetipe' => "il file inserito per il curriculum non è valido",
                'photo.mimetipe' => "il file inserito per la foto non è valido",
            ]
        );
        $data = $request->all();
        if ($doctor->photo && array_search('photo', $data)) {
            Storage::delete($doctor->photo);
            $photo = Storage::put('uploads', $data['photo']);
            $data['photo'] = $photo;
        };
        if ($doctor->curriculum && array_search('curriculum', $data)) {
            Storage::delete($doctor->curriculum);
            $curriculum = Storage::put('uploads', $data['curriculum']);
            $data['curriculum'] = $curriculum;
        };
        $doctor->update($data);
        if (Arr::exists($data, 'specialization')) {
            $doctor->specializations()->sync($data['specialization']);
        } else
            $doctor->specializations()->detach();
        return view('admin.doctors.index', compact('doctor'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}
