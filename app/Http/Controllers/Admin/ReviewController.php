<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::id();
        $reviews = Review::where('doctor_id', $id)->orderBy('updated_at', 'DESC')->simplePaginate(10);
        $votes = Auth::user()->doctor->votes->toArray();

        return view('admin.reviews.index', compact('reviews', 'votes'));
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
    public function show(Review $review)
    {
        if (Auth::user()->doctor->id != $review->doctor_id) {
            return to_route('admin.reviews.index')->with('type', 'danger')->with('msg', 'OPERAZIONE NON AUTORIZZATA!');
        } else {
            $review->is_read = true;
            $review->save();

            return view('admin.reviews.show', compact('review'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return to_route('admin.reviews.index')->with('type', 'success')->with('msg', 'Recensione spostata nel cestino');
    }

    public function trash()
    {
        $reviews = Review::onlyTrashed()->Paginate(10);
        return view('admin.reviews.trash', compact('reviews'));
    }
    public function restore(int $id)
    {
        $review = Review::onlyTrashed()->findOrFail($id);
        $review->restore();
        return to_route('admin.reviews.index')->with('type', 'success')->with('msg', 'Recensione ripristinata con successo');
    }
    public function delete(int $id)
    {
        $review = Review::onlyTrashed()->findOrFail($id);
        $review->forceDelete();
        return to_route('admin.reviews.index')->with('type', 'success')->with('msg', 'Recensione eliminata definitivamente');
    }
}