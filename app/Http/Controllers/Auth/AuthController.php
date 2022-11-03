<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\MailRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\ActivationMail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use JWTAuth;
use Illuminate\Http\Request;
use mysql_xdevapi\CollectionRemove;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTExceptions;
use DateTime;
use App\User;
use App\Area;
use App\Company;
use App\Article;
use App\Section;
use Validator;
use App\Slider;
use Hash;
use DateTimeZone;

class AuthController extends Controller
{
    public $loginAfterSignUp = true;


    public function login(Request $request)
    {
        $token = null;

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'El email es invalido',
            'email.email' => 'El email es invalido',
            'password.required' => 'El campo contraseña es requerido',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 400,
                'message' => $validator->errors()->first()
            ], 400);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'statusCode' => 400,
                'code' => 'EMAIL_NOT_FOUND',
                'message' => 'EL correo no existe'
            ], 400);
        }


        if (!$token = JWTAuth::attempt($request->all())) {
            return response()->json([
                'statusCode' => 400,
                'code' => 'PASSWORD_INVALID',
                'message' => 'contraseña incorrecta',
            ], 400);
        }

        $user = JWTAuth::user();

        $user->addittional_info = json_decode($user->addittional_info);

        return response()->json([
            'status' => 200,
            'user' => $user,
            'token' => $token,

        ], 200);
    }

    public function register(RegisterRequest $request)
    {

        $fecha = now('America/Lima');
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return response()->json([
                'statusCode' => 400,
                'code' => 'EMAIL_ALREADY_REGISTERED',
                'message' => 'EL correo ya esta registrado'
            ], 400);
        }
        $data = $request->all();
        $name = $data['name'];
        $email = $data['email'];
        $password = $data['password'];
        $encripted = Hash::make($email . '' . time());
        $fecha = now('America/Lima');

        $user = new User;
        $user->name = $request->name;
        $user->sur_name = $request->sur_name;

        $user->email = $email;
        $user->password = bcrypt($password);

        $user->external_enterprise = $request->external_enterprise;
        $user->enterprise = $request->enterprise;
        $user->addittional_info = json_encode($request->addittional_info);
        $user->created_at = $fecha;
        $user->updated_at = $fecha;
        $user->save();

        $data_send = [
            'email' => $email,
            'password' => $password,
        ];
        Mail::to($email)->send(new ActivationMail($data_send));
        $request = new Request($data_send);
        return $this->login($request);
    }

    public function logout(Request $request)
    {
        $data = $request->header('Authorization');

        try {

            JWTAuth::invalidate($data);

            return response()->json([
                'status' => 200,
                'message' => 'EL usuario cerro sesion correctamente',
            ], 200);
        } catch (JWTException $exception) {

            return response()->json([
                'status' => 500,
                'message' => 'Ocurrio un error al intentar cerrar',
            ], 500);
        }
    }


    public function home()
    {
        $section = new Section;
        $sectionData = $section->select("id", "name", "description", "slug", "route", "activated", "text_link", "order_home")->orderBy('order_home', 'asc')->get();
        foreach ($sectionData as $index => $items) {
            $sectionData[$index]->articles = $items->articles()->get();
        }
        return $sectionData;
    }

    public function getSectionDetail($id)
    {
        $sectionDetail = Section::select('id', 'name', 'description')->where('id', $id)->first();
        return $sectionDetail;
    }

    public function getArticlesBySections(Request $request, $slugSection)
    {
        $limit = $request->get('limit');
        $limit = !empty($limit) && is_numeric($limit) ? $limit : 10;
        $section = new Section;
        $sectionData = $section->where("slug", $slugSection)->first();
        $sectionData['articles'] = $sectionData->articles()->select('id', 'title', 'subtitle', 'page_image', 'content', "slug", "text_link", "title_seo", "content_seo", "image_seo")->orderByDesc('published_at')->paginate($limit);
        return $sectionData;
    }

    public function getArticleDetail(Request $request, $idArticle)
    {
        $article = new Article;
        $articleData = $article->where("id", $idArticle)->first();
        return $articleData;
    }

    public function getSections()
    {
        return Section::select('id', 'name', 'route', 'slug', 'slug', 'text_link', 'order')->where('activated', 1)->orderBy('order', 'asc')->get();
    }

    public function getSlide()
    {
        return Slider::select('id', 'url_image', 'order')->orderBy('order', 'asc')->get();
    }

    public function sendLinkResetPassword(MailRequest $request)
    {
        $data = $request->all();
        if (isset($data['email'])) {
            $user = User::where('email', $data['email'])->where('is_activated', 1)->first();
            if (isset($user)) {
                $token = Str::random(10);
                $fecha = now('America/Lima');
                $email = $data['email'];

                DB::table('password_resets')->insert(['email' => $email, 'token' => $token, 'created_at' =>  $fecha]);

                Mail::send('emails.reset', ['token' => $token, 'name' => $user->name], function ($message) use ($email) {
                    $message->to($email);
                    $message->subject('Restaurar Contraseña');
                });

                return response()->json([
                    'status' => 200,
                    'message' => 'Se ha enviado un enlace a tu correo',
                ], 200);

                /* $data_send = [
                    'email' => $data['email'],
                    'name' => $user->name
                ];
                Mail::to($data['email'])->send(new ResetPasswordMail($data_send));
                if (count(Mail::failures()) > 0) {
                    return new \Error(Mail::failures());
                } */
            }
            return response(['status' => 400, 'message' => 'Usuario no encontrado'], 400);
        }
        return response(['status' => 400, 'message' => 'El email ingresado no es válido'], 400);
    }

    public function activate($data, $content)
    {
        $data = [
            'email' => $data,
            'password' => $content
        ];
        $request = new Request($data);
        return $this->login($request);
    }

    public function ResetPassword(ResetPasswordRequest $request)
    {

        $token = $request->get('token');
        $password = $request->get('password');
        $passwordReset = DB::table('password_resets')->where('token', $token)->first();
        if (isset($passwordReset)) {
            $user = User::where('email', $passwordReset->email)->first();
            $user->password = bcrypt($password);
            $user->save();
            return response()->json([
                'status' => 200,
                'message' => 'Tu contraseña ha sido restablecida con exíto',
            ], 200);
        }
        return response(['status' => 400, 'message' => 'Token no valido'], 400);
    }

    public function getAreas()
    {
        return Area::select('id', 'name')->get();
    }

    public function getUserDetails(Request $request)
    {
        $data = $request->header('Authorization');
        $token =  explode(' ', $data)[1];
        $user = JWTAuth::toUser($token);
        $user['addittional_info'] = json_decode($user['addittional_info']);
        $company = Company::first();
        $company['helpCenter'] = json_decode($company['helpCenter']);
        $company['companyInfo'] = json_decode($company['companyInfo']);
        if ($user) {
            return response()->json(['statusCode' => 200, 'data' => ['user' => $user, 'companyData' => $company]]);
        }
    }

    public function getCompanyData()
    {
        $company = Company::first();
        $company['helpCenter'] = json_decode($company['helpCenter']);
        $company['cookiePolicy'] = json_decode($company['cookiePolicy']);
        $company['privacyPolicy'] = json_decode($company['privacyPolicy']);
        $company['companySeo'] = json_decode($company['companySeo']);
        $company['companyInfo'] = json_decode($company['companyInfo']);

        return response()->json(['statusCode' => 200, 'data' => $company]);
    }
}
