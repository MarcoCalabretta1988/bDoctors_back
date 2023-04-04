<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::orderBy('updated_at', 'DESC')->with('review', 'votes', 'sponsoreds', 'specializations')->get();

        return response()->json($doctors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation api




        $data = $request->all();
        //take user
        $validator = Validator::make(
            $data,
            [
                'email' => 'bail|required|email',
                'name' => 'bail|required',
                'password' => 'bail|required|min:6',
                'phone' => 'bail|required|min:6',
                'address' => 'bail|required',
            ],


        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $user = new User();
        //take doctor and fill data
        $doctor = new Doctor();
        $doctor->fill($data);
        $doctor->save();
        //fill user data
        $user->fill($data);
        //add doctor_id corelation
        $user->doctor_id = $doctor->id;
        $user->password = bcrypt('password');
        $user->save();

        //take aray whith specializations id
        if (Arr::exists($data, 'specialization')) {
            $doctor->specializations()->attach($data['specialization']);
        }

        return response(null, 204);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $doctors = Doctor::find($id);

        $doctors->review;
        $doctors->votes;
        $doctors->sponsoreds;
        $doctors->specializations;

        if (!$doctors)
            return response(null, 404);

        return response()->json($doctors);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    //filter by specialization 

    public function specializationDoctorIndex(string $id)
    {
        $specialization = Specialization::find($id);

        if (!$specialization)
            return response(null, 404);
        $doctors = $specialization->doctors->all();

        return response()->json(compact('specialization'));
    }

    //pass specialization in route 

    public function specialization()
    {

        $specialization = Specialization::all();

        return response()->json($specialization);
    }
}
