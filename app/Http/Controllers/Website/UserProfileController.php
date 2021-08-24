<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function index(){
        $user_detail = auth()->user();
        return view('website.pages.profile.profile', compact('user_detail'));
    }

    public function security(){
        return view('website.pages.profile.update_password');
    }

    public function update(Request $request)
    {
        $request->validate([
            'email' => 'email'
        ]);

        $id = auth()->user()->id;

        $admin = User::find($id);
        $admin->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return response()->json(['success' => true, 'message' => "Details Updated Successfully."]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|min:8|max:20',
            'new_password' => 'required|min:8|max:20',
            'confirm_password' => 'required|same:new_password|min:8|max:20',
        ]);

        $id = auth()->user()->id;
        $current_user = User::find($id);

        if (Hash::check($request->current_password, $current_user->password)) {

            $current_user->update([
                'password' => bcrypt($request->new_password)
            ]);
            return response()->json(['success' => true, 'message' => 'Password Updated Successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Current Password does not matched. Try again!']);
        }
    }
}
