<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::id();
        $messages = Message::where('doctor_id', $id)->orderBy('updated_at', 'DESC')->simplePaginate(10);
        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        if (Auth::user()->doctor->id != $message->doctor_id) {
            return to_route('admin.messages.index')->with('type', 'danger')->with('msg', 'OPERAZIONE NON AUTORIZZATA!');
        } else {
            $message->is_read = true;
            $message->save();

            return view('admin.messages.show', compact('message'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
    public function destroy(Message $message)
    {
        $message->delete();
        return to_route('admin.messages.index')->with('type', 'success')->with('msg', 'Messaggio spostato nel cestino');
    }

    public function trash()
    {
        $messages = Message::onlyTrashed()->Paginate(10);
        return view('admin.messages.trash', compact('messages'));
    }
    public function restore(int $id)
    {
        $message = Message::onlyTrashed()->findOrFail($id);
        $message->restore();
        return to_route('admin.messages.index')->with('type', 'success')->with('msg', 'Messaggio ripristinato con successo');
    }
    public function delete(int $id)
    {
        $message = Message::onlyTrashed()->findOrFail($id);
        $message->forceDelete();
        return to_route('admin.messages.index')->with('type', 'success')->with('msg', 'Messaggio eliminato definitivamente');
    }
}
