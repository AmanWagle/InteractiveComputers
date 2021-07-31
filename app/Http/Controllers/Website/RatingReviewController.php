<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\RatingReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function checkIfReviewExists($product_id)
    {
        $user_id = Auth::id();

        $existing_review = RatingReview::where('product_id', $product_id)->where('user_id', $user_id)->get();

        dd($existing_review);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($product_id, Request $request)
    {
        $product = Product::findOrFail($product_id);

        $user_id = Auth::id();

        $this->validate($request, [
            'rating' => 'required|numeric',
            'review_summary' => 'required',
            'review' => 'required'
        ]);

        $rating_review = RatingReview::create([
            'rating' => $request->rating,
            'review_summary' => $request->review_summary,
            'review' => $request->review,
            'status' => $request->status ? 1 : 0,
            'user_id' => $user_id,
            'product_id' => $product_id
        ]);

        return response()->json(['success' => true, 'message' => "Review submitted successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
