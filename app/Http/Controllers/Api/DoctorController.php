<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Http\Request;

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
        $data = $request->all();

        $user = new User();
        $user->fill($data);

        $user->password = bcrypt('password');

        $user->save();
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

        if (!$doctors) return response(null, 404);

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

        if (!$specialization) return response(null, 404);
        $doctors = $specialization->doctors->all();

        return response()->json(compact('specialization'));
    }
}
