<?php

namespace App\Http\Controllers\InertiaAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => User::query()->paginate()
        ]);
    }
}
