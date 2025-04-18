<?php

namespace App\Http\Controllers;

use App\Models\CommonLife;
use App\Models\UserSchool;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommonLifeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $id = $user->id;
        $role = UserSchool::where('user_id', $id)->value('role');
        $tasks = commonlife::all();
        if ($role == "admin") {

            return view('pages.commonLife.index', compact('tasks'));

        }
        return view('pages.commonLife.index', compact('tasks'));
    }

    public function create(request $request)
    {

        $user = Auth::user();
        $title = $request->input('title');
        $description = $request->input('description');
        if ($title == null || $description == null) {
            return redirect()->route('common-life.index');
        } else {
            $CommonLife = CommonLife::create([
                'user_id' => $user->id,
                'title' => $title,
                'description' => $description,
            ]);

            $CommonLife->save();
            return redirect()->route('common-life.index');
        }
    }

    public function destroy(request $request)
    {
        $id = $request->id;
        $task = CommonLife::where('id', $id);
        $task->update([
            'deleted' => true,
        ]);
        return redirect()->route('common-life.index');
    }

    public function edit(request $request)
    {
        //edit the information in the database with every possible cases
        $id = $request->id;
        $task = CommonLife::where('id', $id)->first();
        $title = $task->title;
        $description = $task->description;
        $comment = $task->comment;
        if($request->input('title') != null){
            $title = $request->input('title');
        }if($request->input('description') != null){
            $description = $request->input('description');
        }if($request->input('comment') != null){
            $comment = $request->input('comment');
        }
        $task->update([
            'title' => $title,
            'description' => $description,
            'comment' => $comment
        ]);
        return redirect()->route('common-life.index');
    }

    public function swapDone(request $request)
    {
        //swap between done by someone and not done when clicking on it
        $user = Auth::user();
        $id = $request->id;
        $task = CommonLife::where('id',$id)->first();
        if ($task->done == 1) {
            $task->update([
                'done' => false,
                'doneby' => null
            ]);
        } else {
            $task->update([
                'done' => true,
                'doneby' => $user->first_name
            ]);
        }
        return redirect()->route('common-life.index');
    }
}
