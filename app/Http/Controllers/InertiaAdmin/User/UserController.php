<?php

namespace App\Http\Controllers\InertiaAdmin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\users\UpdateUserRequest;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;
use function now;
use function redirect;

class UserController extends Controller
{
    /**
     * @return Response
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize("view-user", auth()->user());
        $users = User::query()->paginate();
        return Inertia::render('Users/List', compact("users"));
    }

    /**
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        return Inertia::render('Users/Show', compact("user"));
    }

    /**
     * edit user page
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        return Inertia::render("Users/Edit", compact("user"));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $userArr = Arr::except($request->validated(), "avatar_img");

        if ($request->file("avatar_img")) {
            $path = $request->file("avatar_img")->storeAs(
                "users",
                Str::random(10) . now()->timestamp . "." . $request->file("avatar_img")->extension(),
                "public"
            );

            if (Storage::disk("public")->exists(str_replace("/storage/", "", $user->avatar_img)))
                Storage::disk("public")->delete(str_replace("/storage/", "", $user->avatar_img));

            $userArr += ["avatar_img" => "/storage/" . $path];
        }

        $user->update($userArr);

        return redirect()->back()->with('success', 'successfully updated.');
    }
}
