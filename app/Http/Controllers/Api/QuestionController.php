<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::orderBy('title', 'ASC')->get(['id', 'title', 'content', 'is_activated', 'unit_id']);
        return response()->json([
            'data' => $questions
        ], 200);
    }
}
