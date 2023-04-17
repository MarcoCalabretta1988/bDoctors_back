<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderRequest;
use App\Models\Doctor;
use App\Models\DoctorSponsored;
use App\Models\Specialization;
use App\Models\Sponsored;
use App\Models\User;
use Braintree\Gateway;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;



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
        $votes = Auth::user()->doctor->votes->toArray();
        $sum = 0;
        if ($votes) {
            foreach ($votes as $vote)
                $sum = $sum + $vote['value'];

            $media = $sum / count($votes);
        } else
            $media = 0;
        return view('admin.doctors.index', compact('name', 'doctor', 'specializations', 'media'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specializations = Specialization::all();
        $doctor = new Doctor();

        $doctor_spec = [];
        return view('admin.doctors.create', compact('specializations', 'doctor_spec', 'doctor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'address' => 'required|string',
                'phone' => 'required|unique:doctors|min:6',
                'curriculum' => 'nullable|mimes:pdf,xlxs,xlx,docx,doc,csv,txt',
                'photo' => 'nullable|image|mimes:jpg,jpeg,png',
                'city' => 'nullable|string'
            ],
            [
                'address.required' => "L'indirizzo è obbligatiorio",
                'address.string' => "Il capo address deve essere una stringa",
                'phone.required' => "Il numero di telefono è obbligatorio",
                'phone.unique' => "Il numero è già presente in archivio",
                'phone.min' => "Il numero deve contenere almeno 6 caratteri",
                'curriculum.mimes' => "Il file inserito per il curriculum non è valido, accettato JPG,JPEG,PNG",
                'curriculum.image' => "Il curriculum deve essere un immagine",
                'photo.mimes' => "il file inserito per la foto non è valido, accettato JPG,JPEG,PNG",
                'photo.image' => "La foto profilo deve essere un immagine",
                'city.string' => "Il campo città deve essere una stringa"
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $data = $request->all();

        //photo converter
        if (Arr::exists($data, 'photo')) {
            $img_path = Storage::put('uploads', $data['photo']);
            $data['photo'] = $img_path;
        }
        //curriculum converter
        if (Arr::exists($data, 'curriculum')) {
            $img_path = Storage::put('uploads', $data['curriculum']);
            $data['curriculum'] = $img_path;
        }

        $doctor = new Doctor();
        $doctor->fill($data);



        $doctor->save();

        //fill and save if doctor it's not empy (but dont work why?)
        if (!empty($doctor)) {
            $user = Auth::user();
            $user->doctor_id = $doctor->id;
            $user->save();
        }

        if (Arr::exists($data, 'specialization')) {
            $doctor->specializations()->attach($data['specialization']);
        }
        $media = 0;
        return view('dashboard', compact('doctor', 'media'));
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
        $sponsoreds = Sponsored::all();
        $specializations = Specialization::all();
        $doctor_spec = $doctor->specializations->pluck('id')->toArray();
        return view('admin.doctors.edit', compact('doctor', 'specializations', 'doctor_spec', 'sponsoreds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        $request->validate(
            [
                'address' => 'required|string',
                'phone' => [
                    'required',
                    'string', Rule::unique('doctors')->ignore($doctor->id),
                    'min:6',
                    'max:50',
                ],
                'curriculum' => 'nullable|mimes:pdf,xlxs,xlx,docx,doc,csv,txt',
                'photo' => 'nullable|image|mimes:jpg,jpeg,png',
                'city' => 'nullable|string'
            ],
            [
                'address.required' => "L'indirizzo è obbligatiorio",
                'address.string' => "Il capo address deve essere una stringa",
                'phone.required' => "Il numero di telefono è obbligatorio",
                'phone.unique' => "Il numero è già presente in archivio",
                'phone.min' => "Il numero deve contenere almeno 6 caratteri",
                'curriculum.mimes' => "Il file inserito per il curriculum non è valido, accettato JPG,JPEG,PNG",
                'curriculum.image' => "Il curriculum deve essere un immagine",
                'photo.mimes' => "il file inserito per la foto non è valido, accettato JPG,JPEG,PNG",
                'photo.image' => "La foto profilo deve essere un immagine",
                'city.string' => "Il campo città deve essere una stringa"
            ]
        );
        $data = $request->all();
        //!photo upload photo
        if (Arr::exists($data, 'photo')) {
            if ($doctor->photo) {
                Storage::delete($doctor->photo);
            }
            $photo = Storage::put('uploads', $data['photo']);
            $data['photo'] = $photo;
        };
        if (Arr::exists($data, 'curriculum')) {
            if ($doctor->curriculum) {
                Storage::delete($doctor->curriculum);
            }
            $curriculum = Storage::put('uploads', $data['curriculum']);
            $data['curriculum'] = $curriculum;
        };
        $doctor->update($data);

        //!specialization atach in db
        if (Arr::exists($data, 'specialization')) {
            $doctor->specializations()->sync($data['specialization']);
        } else
            $doctor->specializations()->detach();
        $specializations = Auth::user()->doctor->specializations->toArray();
        $votes = Auth::user()->doctor->votes->toArray();
        $sum = 0;
        if ($votes) {
            foreach ($votes as $vote)
                $sum = $sum + $vote['value'];

            $media = $sum / count($votes);
        } else
            $media = 0;

        return view('admin.doctors.index', compact('doctor', 'specializations', 'media'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //
    }

    public function sponsored()
    {

        $sponsoreds = Sponsored::all();

        return view('admin.doctors.sponsored', compact('sponsoreds'));
    }
    public function paymentForm(int $id, Gateway $gateway)
    {
        $token = $gateway->clientToken()->generate();
        $data = [
            'success' => true,
            'token' => $token
        ];
        $sponsorization = Sponsored::findOrFail($id);
        return view('admin.doctors.paymentForm', compact('sponsorization', 'data'));
    }



    public function makePayment(OrderRequest $request, Gateway $gateway)
    {



        $request->validate(
            [
                'card' => 'required|string|min:16|max:16',
                'cvv' => 'required|integer|min:100|max:999',
                'expired' => 'required',
                'token' => 'required|string',
                'sponsored' => 'required|string',

            ],
            [

                'expired.required' => "La data di scadenza è obbligatoria",
                'card.required' => "Il numero carta è obbligatiorio",
                'card.string' => "Il capo numero carta deve essere una stringa",
                'card.min' => "Il capo numero carta deve essere minimo 16 numeri",
                'card.max' => "Il capo numero carta deve essere massimo 16 numeri",
                'cvv.required' => "Il cvv è obbligatorio",
                'cvv.max' => "Il cvv deve contenere massimo 3 caratteri",
                'cvv.min' => "Il cvv deve contenere minimo 3 caratteri",
                'token.required' => "Il token è obbligatiorio",
                'sponsored.required' => "Il riferimento a una sponosrizzata è obbligatiorio",
            ]
        );


        $sponsored = Sponsored::find($request->sponsored);
        $result = $gateway->transaction()->sale([
            'amount' => $sponsored->cost,
            'paymentMethodNonce' => $request->token,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
        $doctor = Auth::user()->doctor;
        if ($doctor->is_sponsored) {
            return to_route('admin.doctors.index')->with('type', 'danger')->with('msg', 'Sei già sponsorizzato');
        } else {

            if ($result->success) {
                $doctor->is_sponsored = 1;
                $duration = DB::table('sponsoreds')->where('id', $sponsored->id)->value('duration');
                $start_at = Carbon::now(); // dynamic start date
                $end_at = $start_at->copy()->addHours($duration); // calculate end date based on start date and sponsored duration in hours
                $durationInDays = $start_at->diffInDays($end_at); // calculate duration in days
                $start_at = $start_at->format('Y/m/d'); // format start date year/mounth/day
                $end_at = $end_at->format('Y/m/d'); // format end date with year/mounth/day
                $doctor->sponsoreds()->sync([
                    $sponsored->id => [
                        'start_at' => $start_at,
                        'end_at' => $end_at,
                    ]
                ]);
                $doctor->save();
                return to_route('admin.doctors.index')->with('type', 'success')->with('msg', 'Transazione Eseguita con successo');
            } else {

                return to_route('admin.doctors.index')->with('type', 'danger')->with('msg', 'Transazione negata');
            }
        }
    }
}
