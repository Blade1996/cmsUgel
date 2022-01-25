<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequestPost;
use App\Scopes\ActivatedScope;
use App\Unit;
use App\User;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CourseController extends Controller
{

    public function index(Request $request)
    {
        Session::put('page', 'courses');
        $courses = Course::withoutGlobalScope(ActivatedScope::class)->orderBy('created_at', 'desc')->get(['id', 'title', 'url_image', 'file_url', 'is_activated']);
        $company = new Company;
        $companyData = getCompanyData();
        return view('admin.courses.index', compact('courses', 'companyData'));
    }

    public function create()
    {
        $company = new Company;
        $companyData = getCompanyData();
        return view('admin.courses.create', compact('companyData'));
    }

    public function store(CourseRequestPost $request)
    {
        $data = array_merge($request->all());
        $course = new Course();
        $data['slug'] = strtr($course->cleanSlug(strtolower($data['title'])), ' ', '-');
        $data['url_image'] = $this->loadFile($request, 'url_image', 'course/images', 'courses_images');
        $data['banner'] = $this->loadFile($request, 'banner', 'course/images', 'courses_images');
        $data['file_url'] = $this->loadFile($request, 'file_url', 'course/pdfs', 'courses_files');

        $course->fill($data);
        $course->save();
        return redirect()->route('courses.index')->with('status', '¡Registrado satisfactoriamente!');
    }


    public function edit($id)
    {
        $course = Course::withoutGlobalScope(ActivatedScope::class)->findOrFail($id);
        $company = new Company;
        $companyData = getCompanyData();
        return view('admin.courses.edit', compact('course', 'companyData'));
    }


    public function update(CourseRequestPost $request, $id)
    {
        $data = array_merge($request->all());
        $course = Course::withoutGlobalScope(ActivatedScope::class)->findOrFail($id);
        $data['slug'] = strtr(strtolower($data['title']), ' ', '-');
        if ($request->file('url_image')) {
            $data['url_image'] = $this->loadFile($request, 'url_image', 'course/images', 'courses_images');
        }
        if ($request->file('banner')) {
            $data['banner'] = $this->loadFile($request, 'banner', 'course/images', 'courses_images');
        }
        if ($request->file('file_url')) {
            $data['file_url'] = $this->loadFile($request, 'file_url', 'course/pdfs', 'courses_files');
        }
        $course->update($data);
        return redirect()->route('courses.index')->with('status', '¡Modificado satisfactoriamente!');
    }


    public function destroy($id)
    {
        try {
            Course::withoutGlobalScope(ActivatedScope::class)->findOrFail($id)->delete();
            return redirect()->route('courses.index')->with('status', '¡Eliminado satisfactoriamente!');
        } catch (\Exception $e) {
            return redirect()->route('courses.index')->with('error', $e->getMessage());
        }
    }

    public function deleteUserCourse($id)
    {
        try {
            DB::table('user_courses')->where('id', $id)->delete();
            return response()->json(['message' => 'Eliminado con exíto'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function CoursesByUser()
    {
        Session::put('page', 'courses-users');
        $courses = Course::orderBy('title', 'ASC')->get(['id', 'title']);
        $company = new Company;
        $companyData = getCompanyData();
        return view('admin.progress.index', compact('courses', 'companyData'));
    }

    public function getUnitsCourseByUser($course_id, $user_id)
    {
        $user = User::find($user_id);
        $course = Course::find($course_id);
        $units = $course->units;
        $title_course = $course->title;
        foreach ($units as $unit) {
            if (count($user->units) > 0) {
                foreach ($user->units as $unit_course) {
                    if ($unit->id == $unit_course->pivot->unit_id) {
                        $unit->questions = $unit_course->pivot->questions;
                        $unit->date_answered = $unit_course->pivot->date_answered;
                        $unit->is_completed = 1;
                        unset($user->units, $unit_course);
                        break;
                    } else {
                        $unit->questions = "";
                        $unit->is_completed = 0;
                        $unit->date_answered = "";
                    }
                }
            } else {
                $unit->questions = "";
                $unit->is_completed = 0;
                $unit->date_answered = "";
            }
        }
        return view('admin.progress.table_units', compact('units', 'title_course'))->render();
    }

    public function getTemplateDetailCourse($id)
    {
        $course = Course::find($id);

        $users = $course->users;
        $user_list = view('admin.progress.table', compact('course'))->render();
        $course_detail = view('admin.progress.detail', compact('course'))->render();

        return response([
            'detail' => $course_detail,
            'users' => $user_list
        ]);
    }

    public function changeStatus($id)
    {
        $course = Course::withoutGlobalScope(ActivatedScope::class)->findOrFail($id);
        if ($course->is_activated == 0) {
            $course->is_activated = 1;
        } else {
            $course->is_activated = 0;
        }
        $course->save();
        return $course;
    }

    public function downloadPdf($id)
    {
        $course = Course::find($id);
        $path_relative = Str::of($course->file_url)->after(env('URL_DOMAIN'));
        $sbstr_path_rel = substr($path_relative, 1);
        if (is_file($sbstr_path_rel)) {
            $name_pdf = $course->title;
            return response()->download($sbstr_path_rel, $name_pdf . ".pdf");
        }
        return response()->json([
            'status' => 404,
            'message' => 'Documento no encontrado'
        ], 404);
    }

    public function getModalUnitsByCourse($id)
    {
        $units = Unit::withoutGlobalScope(ActivatedScope::class)->orderBy('order', 'ASC')->where('course_id', $id)->get();
        return view('admin.courses.table_units_course', compact('units'))->render();
    }
}
