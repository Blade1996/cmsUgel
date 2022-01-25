<?php

namespace App\Http\Controllers\Api;

use App\Course;
use App\Http\Controllers\Controller;
use App\Scopes\ActivatedScope;
use App\Unit;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use function Symfony\Component\String\u;

class CourseController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $courses = Course::orderBy('created_at', 'DESC')->get(['id', 'title', 'url_image', 'slug', 'is_activated', 'created_at']);
        $courses_by_user = $user->courses;
        foreach ($courses as $course) {
            if (count($courses_by_user) > 0) {
                foreach ($courses_by_user as $course_user) {
                    if ($course->id === $course_user->pivot->course_id) {
                        $course->flag_registered = $course_user->pivot->flag_registered;
                        $course->flag_completed = $course_user->pivot->flag_completed;
                        $course->insc_date = $course_user->pivot->insc_date;
                        unset($course_user);
                        break;
                    } else {
                        $course->flag_registered = 0;
                        $course->flag_completed = 0;
                        $course->insc_date = 0;
                        unset($course_user);
                    }
                }
            } else {
                $course->flag_registered = 0;
                $course->flag_completed = 0;
                $course->insc_date = 0;
            }

        }
        return response()->json([
            'courses' => $courses
        ], 200);
    }

    public function detailCourseByUser($id)
    {
        $user = User::find(Auth::user()->id);
        $course = $user->courses->find($id);


        return response()->json([
            'data' => $course->pivot->user_id
        ], 200);
    }

    public function unitsByCourse($id)
    {
        $user = User::find(Auth::user()->id);
        $course = Course::find($id);
        $units = Unit::where('course_id', $id)->orderBy('order', 'ASC')->get(['id', 'title', 'content', 'is_activated', 'order', 'course_id', 'url_image', 'url_video']);
        $units_by_user = $user->units->where('course_id', $id);
        foreach($units as $unit){
            if(count($units_by_user) > 0){
                foreach($units_by_user as $unit_user){
                    if($unit->id === $unit_user->pivot->unit_id){
                        $unit->flag_complete_unit = $unit_user->pivot->flag_complete_unit;
                        unset($unit_user);
                        break;
                    }else{
                        $unit->flag_complete_unit = 0;
                        unset($unit_user);
                    }
                }
            }else{
                $unit->flag_complete_unit = 0;
            }
        }
        return response()->json([
            'course' => $course,
            'units' => $units
        ], 200);
    }

    public function UserRegisterOnCourse(Request $request)
    {

        try {
            DB::beginTransaction();
            $user = User::find(Auth::user()->id);
            $data = array_merge($request->all());
            //Verificamos si el usuario ya esta regisrado en el curso elejido
            $courses = $user->courses;
            $courses = $courses->firstWhere('id', $data['course_id']);
            if (!isset($courses)) {
                $date_now = new \DateTime('now', new \DateTimeZone('America/Lima'));
                $data['user_id'] = $user->id;
                $data['init_date'] = $date_now;
                $data['insc_date'] = $date_now;
                $data['flag_registered'] = 1;
                $data['created_at'] = $date_now;
                $data['updated_at'] = $date_now;
                DB::table('user_courses')->insert($data);
                DB::commit();
                return response()->json([
                    'status' => 200,
                    'message' => 'Registro exitoso'
                ], 200);
            }
            return response()->json([
                'statusCode' => 400,
                'code' => 'ALREADY_REGISTERED_COURSE',
                'message' => 'Actualmente esta registrado en este curso'
            ], 400);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'code' => 'ERROR_REQUEST',
                'statusCode' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
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
            'code' => 'DOCUMENT_NOT_FOUND',
            'statusCode' => 404,
            'message' => 'Documento no encontrado'
        ], 404);
    }
}
