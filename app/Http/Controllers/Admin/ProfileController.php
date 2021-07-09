<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $admin_detail = auth()->user();
        return view('admin.pages.profile.index', compact('admin_detail'));
    }

    public function show()
    {
        return auth()->user();
    }

    public function update(Request $request)
    {
        $request->validate([
            'email' => 'email'
        ]);

        $id = auth()->user()->id;

        $admin = Admin::find($id);
        $admin->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|min:8|max:20',
            'new_password' => 'required|min:8|max:20',
            'confirm_password' => 'required|same:new_password|min:8|max:20',
        ]);

        $id = auth()->user()->id;
        $current_user = Admin::find($id);

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
