<?php

namespace App\Http\Controllers;

use App\Models\CommonLife;
use App\Models\UserSchool;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommonLifeController extends Controller
{
    public function index() {
        $user = Auth::user();
        $id = $user->id;
        $role = UserSchool::where('user_id', $id)->value('role');
        $tasks = commonlife::all();
        if($role == "admin") {

            return view('pages.commonLife.index', compact('tasks'));

        }
        return view('pages.commonLife.index', compact('tasks'));
    }

    public function create(request $request) {
        $user = Auth::user();
        $title = $request->input('title');
        $description = $request->input('description');
        if($title == null || $description == null) {
            return redirect()->route('common-life.index');
        }
        else{
            $CommonLife = CommonLife::create([
                'user_id' => $user -> id,
                'title' => $title,
                'description'=> $description,
            ]);

            $CommonLife->save();
            return redirect()->route('common-life.index');
        }
    }
    public function destroy(request $request) {
        $id = $request->id;
        commonlife::where('task_id', $id)->delete();
        
        return redirect()->route('common-life.index');
    }
    public function edit(request $request) {
        $id = $request->id;
        $task = commonlife::where('task_id', $id);
        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description')
        ]);
        return redirect()->route('common-life.index');
    }
}
