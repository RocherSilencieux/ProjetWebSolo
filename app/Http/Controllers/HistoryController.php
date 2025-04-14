<?php

namespace App\Http\Controllers;

use App\Models\CommonLife;
use App\Models\UserSchool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $id = $user->id;
        $role = UserSchool::where('user_id', $id)->value('role');
        $tasks = commonlife::all();
        if ($role == "admin") {

            return view('pages.history.index', compact('tasks'));

        }
        return view('pages.history.index', compact('tasks'));
    }
}
