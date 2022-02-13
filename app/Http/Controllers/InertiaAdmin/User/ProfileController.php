<?php

namespace App\Http\Controllers\InertiaAdmin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use function auth;
use function now;
use function redirect;

class ProfileController extends Controller
{
    public function show()
    {
        return Inertia::render('Auth/Profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        $user = [
            'name'  => $request->name,
            'email' => $request->email,
        ];
        if ($request->file("avatar_img")) {

            $file = $request->file("avatar_img");

            $fileName = Str::random(10) . now()->timestamp . "." . $file->extension();

            $path = Storage::disk("public")->putFileAs("users", $file, $fileName);

            $user += ["avatar_img" => "/storage/" . $path];
        }

        if ($request->password)
            $user += ['password' => Hash::make($request->password)];

        auth()->user()->update($user);

        return redirect()->back()->with('success', 'Profile updated.');
    }
}
