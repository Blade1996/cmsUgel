<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequestPost;
use App\Question;
use App\Scopes\ActivatedScope;
use App\TypeAnswer;
use App\Unit;
use App\Company;
use Carbon\Traits\Units;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Session;

class QuestionController extends Controller
{

    public function index()
    {
        Session::put('page', 'questions-list');
        $type_answers = TypeAnswer::orderBy('name', 'ASC')->pluck('name', 'id');
        $questions = Question::withoutGlobalScope(ActivatedScope::class)->orderBy('created_at', 'desc')->get(['id', 'title', 'is_activated', 'content', 'unit_id']);
        $company = new Company;
        $companyData = getCompanyData();
        return view('admin.questions.index', compact('questions', 'type_answers', 'companyData'));
    }


    public function create()
    {
        $units = Unit::orderBy('title', 'ASC')->pluck('title', 'id');
        $company = new Company;
        $companyData = getCompanyData();
        return view('admin.questions.create', compact('units', 'companyData'));
    }


    public function store(QuestionRequestPost $request)
    {
        $data = array_merge($request->all());
        $question = new Question();
        $question->fill($data);
        $question->save();
        return redirect()->route('questions.index')->with('status', '¡Registrado satisfactoriamente!');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $question = Question::withoutGlobalScope(ActivatedScope::class)->findOrFail($id);
        $units = Unit::orderBy('title', 'ASC')->pluck('title', 'id');
        $company = new Company;
        $companyData = getCompanyData();
        return view('admin.questions.edit', compact('units', 'question', 'companyData'));
    }


    public function update(QuestionRequestPost $request, $id)
    {
        $data = array_merge($request->all());
        $question = Question::withoutGlobalScope(ActivatedScope::class)->findOrFail($id);
        $question->update($data);
        return redirect()->route('questions.index')->with('status', '¡Modificado satisfactoriamente!');
    }


    public function destroy($id)
    {
        Question::withoutGlobalScope(ActivatedScope::class)->findOrFail($id)->delete();
        return redirect()->route('questions.index')->with('status', '¡Eliminado satisfactoriamente!');
    }

    public function changeStatus($id)
    {
        $question = Question::withoutGlobalScope(ActivatedScope::class)->findOrFail($id);
        if ($question->is_activated == 0) {
            $question->is_activated = 1;
        } else {
            $question->is_activated = 0;
        }
        $question->save();
        return $question;
    }
}
