<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function index()
    {
        $users = User::withCount('urgent','normal','onDate')->get();
        return view('notes.report')->with(['users' => $users]);
    }
}
