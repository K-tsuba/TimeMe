<?php

namespace App\Http\Controllers;

use App\StudySite;
use Illuminate\Http\Request;
use  App\Http\Requests\StudySiteRequest;
use Illuminate\Support\Facades\Auth;

class StudySiteController extends Controller
{
    public function store(StudySiteRequest $request, StudySite $study_site)
    {
        $study_site->study_title = $request->study_title;
        $study_site->study_site = $request->study_site;
        $study_site->user_id = Auth::user()->id;
        $study_site->save();
        return redirect('/');
    }
    public function delete(StudySite $study_site)
    {
        $study_site->delete();
        return redirect('/');
    }
}
