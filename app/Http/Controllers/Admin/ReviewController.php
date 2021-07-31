<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RatingReview;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function index()
    {
        return view('admin.pages.review.index');
    }

    public function getAllReviews()
    {
        $reviews = RatingReview::with('user', 'product')->get();
        return response()->json(['data' => $reviews]);
    }

    public function updateStatus(Request $request, $id)
    {
        $brand = RatingReview::find($id);
        $brand->update([
            'status' => ($request->status) ? 1 : 0,
        ]);

        $action = ($request->status == 1) ? 'enabled' : 'disabled';

        return response()->json(['success' => true, 'message' => "Review successfully {$action}"]);
    }
}
