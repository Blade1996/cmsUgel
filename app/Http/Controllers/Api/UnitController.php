<?php

namespace App\Http\Controllers\Api;

use App\Course;
use App\Http\Controllers\Controller;
use App\Question;
use App\Unit;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::orderBy('title', 'ASC')->get(['id', 'title', 'content', 'is_activated', 'order', 'course_id']);
        return response()->json([
            'data' => $units
        ], 200);
    }

    public function questionsByUnit($id)
    {
        $unit = Unit::find($id);
        $questions = Question::where('unit_id', $id)->orderBy('title', 'ASC')->with('type_answers')->get(['id', 'title', 'content', 'is_activated', 'unit_id']);
        foreach ($questions as $question) {
            $list = new Collection();
            foreach ($question->type_answers as $answer) {
                $data = [
                    'id' => $answer->id,
                    'name' => $answer->name,
                    'url_image' => $answer->url_image,
                    'confirm_answer' => $answer->confirm_answer,
                    'type_answer_valid' => $answer->pivot->type_answer_valid,
                    'status' => $answer->pivot->status,
                ];
                $list->push($data);
            }
            $question->answers = $list;
            unset($question->type_answers);
        }
        return response()->json([
            'unit' => $unit,
            'data' => $questions
        ], 200);
    }

    public function finishUnit(Request $request, $id)
    {
        $data = $request->all();
        $date_now = new \DateTime('now', new \DateTimeZone('America/Lima'));

        $user = User::find(Auth::user()->id);
        $course = Course::find($data['course_id']);
        $unit = $course->units->firstWhere('id', $id);

        if (is_null($unit)) {
            return response()->json([
                'statusCode' => 404,
                'code' => 'UNIT_NOT_FOUND_ON_COURSE',
                'message' => 'No se encontro la unidad en el curso ' . $course->title
            ], 404);
        }

        $res_unit = DB::table('unit_users_course')->where('user_id', $user->id)->where('unit_id', $unit->id)->where('course_id', $course->id)->first();
        if (!isset($res_unit)) {
            $user_course_unit = [
                'user_id' => $user->id,
                'unit_id' => $unit->id,
                'course_id' => $unit->course_id,
                'questions' => json_encode($data['data']),
                'flag_complete_unit' => 1,
                'date_answered' => $date_now,
                'created_at' => $date_now,
                'updated_at' => $date_now,
            ];
            DB::table('unit_users_course')->insert($user_course_unit);
            $unit_finish = DB::table('unit_users_course')->where('user_id', $user->id)->where('course_id', $unit->course_id)->get('id');
            if (count($course->units) == count($unit_finish)) {
                $flag_completed = ['flag_completed' => 1, 'final_date' => $date_now];
                DB::table('user_courses')->where('user_id', $user->id)->where('course_id', $course->id)->update($flag_completed);
                return response()->json([
                    'statusCode' => 200,
                    'code' => 'COURSE_FINISH_SUCCESS',
                    'message' => 'Curso finalizado con exíto',
                    'certification' => $course->file_url,
                ], 200);
            }
            return response()->json([
                'statusCode' => 200,
                'code' => 'REGISTER_SUCCESS',
                'message' => 'Unidad finalizada con exíto'
            ], 200);
        }
        return response()->json([
            'statusCode' => 200,
            'code' => 'ALREADY_UNIT_IS_FINISH',
            'message' => 'Esta unidad ya a sido marcada como terminda'
        ], 200);
    }
}
