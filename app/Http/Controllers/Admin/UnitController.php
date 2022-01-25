<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\UnitRequestPost;
use App\Question;
use App\Scopes\ActivatedScope;
use App\TypeAnswer;
use App\Unit;
use App\Company;
use Session;
use Illuminate\Http\Request;


class UnitController extends Controller
{

    public function index(Request $request)
    {
        Session::put('page', 'units');
        $units = Unit::withoutGlobalScope(ActivatedScope::class)->orderBy('created_at', 'desc')->get(['id', 'title', 'is_activated', 'content', 'course_id', 'order', 'url_image', 'url_video']);
        $type_answers = TypeAnswer::orderBy('name', 'ASC')->pluck('name', 'id');
        $courses = Course::orderBy('title', 'ASC')->get(['title', 'id']);
        $company = new Company;
        $companyData = getCompanyData();
        return view('admin.units.index', compact('units', 'type_answers', 'courses', 'companyData'));
    }

    public function create()
    {
        $courses = Course::orderBy('title', 'ASC')->pluck('title', 'id');
        $company = new Company;
        $companyData = getCompanyData();
        return view('admin.units.create', compact('courses', 'companyData'));
    }

    public function store(UnitRequestPost $request)
    {
        $data = array_merge($request->all());
        $unit = new Unit();
        $data['url_image'] = $this->loadFile($request, 'url_image', 'units/images', 'units_images');
        $unit->fill($data);
        $unit->save();
        return redirect()->route('units.index')->with('status', '¡Registrado satisfactoriamente!');
    }


    public function edit($id)
    {
        $unit = Unit::withoutGlobalScope(ActivatedScope::class)->findOrFail($id);
        $courses = Course::orderBy('title', 'ASC')->pluck('title', 'id');
        $company = new Company;
        $companyData = getCompanyData();
        return view('admin.units.edit', compact('courses', 'unit', 'companyData'));
    }


    public function update(UnitRequestPost $request, $id)
    {
        $data = array_merge($request->all());
        $unit = Unit::withoutGlobalScope(ActivatedScope::class)->findOrFail($id);
        if ($request->file('url_image')) {
            $data['url_image'] = $this->loadFile($request, 'url_image', 'units/images', 'units_images');
        }
        $unit->update($data);
        return redirect()->route('units.index')->with('status', '¡Modificado satisfactoriamente!');
    }


    public function destroy($id)
    {
        Unit::withoutGlobalScope(ActivatedScope::class)->findOrFail($id)->delete();
        return redirect()->route('units.index')->with('status', '¡Eliminado satisfactoriamente!');
    }

    public function getList()
    {
        $units = Course::orderBy('title', 'ASC')->get(['id', 'title']);

        return $units;
    }

    public function changeStatus($id)
    {
        $unit = Unit::withoutGlobalScope(ActivatedScope::class)->findOrFail($id);
        if ($unit->is_activated == 0) {
            $unit->is_activated = 1;
        } else {
            $unit->is_activated = 0;
        }
        $unit->save();
        return $unit;
    }

    public function deleteImageUnit($id)
    {
        $unit = Unit::withoutGlobalScope(ActivatedScope::class)->findOrFail($id);
        $this->destroyFile($unit->url_image);
        $unit->url_image = null;
        $unit->save();

        return view('admin.units.image', compact('unit'))->render();
    }

    public function getTableQuestionsByUnit($id)
    {
        $type_answers = TypeAnswer::orderBy('name', 'ASC')->pluck('name', 'id');
        $questions = Question::withoutGlobalScope(ActivatedScope::class)->where('unit_id', $id)->orderBy('title', 'ASC')->get();
        return view('admin.units.table_questions_unit', compact('questions', 'type_answers'))->render();
    }

    public function getTableUnitsByCourse($id)
    {
        if ($id == 0) {
            $units = Unit::withoutGlobalScope(ActivatedScope::class)->orderBy('created_at', 'desc')->get(['id', 'title', 'is_activated', 'content', 'course_id', 'order', 'url_image', 'url_video']);
        } else {
            $units = Unit::withoutGlobalScope(ActivatedScope::class)->where('course_id', $id)->orderBy('created_at', 'desc')->get(['id', 'title', 'is_activated', 'content', 'course_id', 'order', 'url_image', 'url_video']);
        }
        return view('admin.units.table', compact('units'))->render();
    }


    public function unitOrderUpdate(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            Unit::withoutGlobalScope(ActivatedScope::class)->where('id', $data['unit_id'])->update(['order' => $data['order']]);
            return response()->json(['status' => 'Ordenado Correctamente']);
        }
    }
}
