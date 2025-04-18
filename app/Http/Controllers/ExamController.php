<?php

namespace App\Http\Controllers;

use App\Models\Gemini;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index($id)
    {
        $gemini = Gemini::where('id', $id)->first();
        return view('pages.exam.index', [
            'id'    => $id,
            'json'  => json_decode($gemini->qcm,true),
            'gemini' => $gemini
        ]);
    }
}
