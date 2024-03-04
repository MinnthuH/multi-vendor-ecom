<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends Controller
{
    // Admin Profile Method
    public function index()
    {
        return view('admin.porfile.index');
    }

    // Admin Profile Update
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'image' => 'image|max:2048',
        ]);
        $user = Auth::user();
        if ($request->hasfile('image')) {
            File::exists($user->image) && File::delete($user->image);
            $image = $request->file('image');
            $ext = $image->getClientOriginalName();
            $filename = time() . '.' . $ext;
            $image->move('uploads/profile/', $filename);
            $path = 'uploads/profile/' . $filename;
            $user->image = $path;

        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        toastr()->success('Profile Updated Successfully');
        return redirect()->back();
    }

    // Admin  Password Change Method
    public function changePassword()
    {
        return view('admin.porfile.updatePassword');
    }

    // Admin Update Password Method
    public function updatePassword(Request $request)
    {

        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|min:6|confirmed',
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password),
        ]);
        toastr()->success('Profile Passwrod Updated Successfully');
        return redirect()->back();
    }
}
