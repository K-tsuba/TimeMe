<?php

namespace App\Http\Controllers;

use App\User;
use App\StudySite;

use Auth;

class UserController extends Controller
{
    public function index(User $user)
    {
        // return view('User/index')->with(['own_study_sites' => $study_site->times()->where('user_id', Auth::id())->get()]);
        return view('User/index')->with(['own_study_sites' => $user->getOwnTimes()]);
    }
}
