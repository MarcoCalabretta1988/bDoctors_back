<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Review;
use App\Models\Specialization;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageMail;
use App\Models\Message;
use App\Models\Sponsored;
use Carbon\Carbon;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::orderBy('is_sponsored', 'DESC')->with('review', 'votes', 'sponsoreds', 'specializations', 'user')->get();
        $this->expired_sponsored();

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

    //filter by votes
    public function voteDoctorIndex(string $id)
    {
        $media = Doctor::find($id)->votes->avg('value');
        if (!$media) {
            $media = 0;
        }

        return response()->json(compact('media'));
    }

    public function reviewDoctorIndex(string $id)
    {
        $review = Review::find($id);

        if (!$review)
            return response(null, 404);
        $doctors = $review->doctors->all();

        return response()->json(compact('review'));
    }

    //pass specialization in route 

    public function specialization()
    {

        $specialization = Specialization::all();

        return response()->json($specialization);
    }

    public function votes()
    {

        $votes = Vote::all();

        return response()->json($votes);
    }

    public function getREwiev(Request $request)
    {

        $data = $request->all();
        //validation for review
        $validator = Validator::make(
            $data,
            [

                'name' => 'bail|required|string',
                'text' => 'bail|required|string',
            ],


        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $review = new Review();

        $review->fill($data);
        $review->save();
        return response(null, 204);
    }

    //vote api route

    public function getVote(Request $request, Doctor $doctor)
    {
        //take vote
        $voteId = $request->input('vote_id');
        // dd($voteId);
        $doctor->votes()->attach($voteId);

        return response()->json(['success' => true]);
    }

    /**
     * Send Email route.
     */
    public function messageMail(Request $request)
    {
        $data = $request->all();
        //take user
        $validator = Validator::make(
            $data,
            [
                'sender' => 'bail|required|email',
                'subject' => 'bail|string',
                'message' => 'bail|required|string',

            ],


        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $sender = $data['sender'];
        $subject = $data['subject'];
        $message = $data['message'];
        $doctor_id = $data['doctor_id'];

        $mail = new MessageMail($sender, $subject, $message);
        // todo aggiungere la mail del dottore al quale mandare la mail del nuovo messaggio, anche nel cosntruct se serve
        //todo adesso la mail viene inviata a chi la scrive 
        Mail::to($sender)->send($mail);
        $new_message = new Message();
        $new_message->email = $sender;
        $new_message->name = $subject;
        $new_message->text = $message;
        $new_message->is_read = 0;

        //! AGGIUNGERE COLLEGAMENTO CON ID DOTTORE
        $new_message->doctor_id = $doctor_id;
        $new_message->save();
        return response(null, 204);
    }


    public function expired_sponsored()
    {

        $now = Carbon::now(); // recupera l'ora corrente
        $doctors = Doctor::where('is_sponsored', true)->get(); // recupera tutti i medici sponsorizzati

        foreach ($doctors as $doctor) {

            $sponsored_create = $doctor->sponsoreds()->first()->pivot->created_at; // cerca la correlazione della sponsorizzazione scaduta
            $sponsored_id = $doctor->sponsoreds()->first()->pivot->sponsored_id;
            $sponsored_day = Sponsored::where('id', $sponsored_id)->pluck('duration')->toArray();
            $expire = $sponsored_create->addDays($sponsored_day['0'] / 24);
            if ($now->gt($expire)) {
                $doctor->sponsoreds()->detach($sponsored_id); // rimuove la correlazione
                $doctor->is_sponsored = false; // imposta is_sponsored a false
                $doctor->save();
            }
        }
    }
}
