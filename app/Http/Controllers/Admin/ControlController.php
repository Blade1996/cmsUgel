<?php

namespace App\Http\Controllers\Admin;

use Auth;
use File;
use Image;
use Session;
use App\Control;
use App\Company;
use App\DocumentTree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ControlController extends Controller
{
    public function index()
    {
        Session::put('page', 'control');
        $controls = Control::orderBy('creado', 'desc')->where('idcontrol_categoria', '<>', 10)->get(['id', 'titulo', 'estado']);
        $company = new Company;
        $companyData = getCompanyData();
        return view('admin.control.control')->with(compact('controls', 'companyData'));
    }

    public function updateControlStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Activado') {
                $status = 0;
            } else {
                $status = 1;
            }
            Control::where('id', $data['id'])->update(['estado' => $status]);
            return response()->json(['status' => $status, 'id' => $data['id']]);
        }
    }


    public function addControl(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();
            /* echo '<pre>';
            print_r($data);
            die;*/

            $control = new Control;

            if (!File::exists('images/backend_images/controls')) {
                $path = 'images/admin_images/controls';
                File::makeDirectory($path, 0755, true, true);
            }

            // Upload Image
            if ($request->hasFile('controlImage')) {
                $image_tmp = $request->file('controlImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/controls/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $control->imagen = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            }

            if ($request->hasFile('controlFile')) {
                $control->archivo = $this->loadFile($request, 'controlFile', 'control/files', 'controls');
            }

            if ($request->hasFile('sliderImage')) {
                $control->imagen_slider = $this->loadFile($request, 'sliderImage', 'sliders', 'sliders');
            }


            if (!empty($data['showCaption'])) {
                $control->show_caption = 1;
            }

            $control->titulo = $data['controlTitle'];
            $control->idcontrol_categoria = $data['categoryId'];
            $control->idusuario = Auth::guard('admin')->user()->id;
            $control->resumen = $data['controlResume'] ?? '';
            $control->tipo = $data['typelink'] ?? '';
            $control->redireccion = $data['controlTextLink'] ?? '';
            $control->video = $data['controlUrlVideo'];
            $control->tree_id = $data['treeId'];
            $control->creado = now('America/Lima');
            $control->modificado = now('America/Lima');
            $control->descripcion = htmlspecialchars_decode(e($data['controlContent']));

            $control->save();
            Session::flash('success_message', 'El articulo se creo Correctamente');
            return redirect()->route('dashboard.control.index');
        }

        $categories = DB::table('dx_control_categoria')->select('id', 'titulo')->where('estado',1)->get();
        $trees = DocumentTree::where('parent_id', '=', 0)->pluck('name', 'id')->all();
        $companyData = getCompanyData();
        return view('admin.control.add_control')->with(compact('categories', 'companyData', 'trees'));
    }

    public function editControl(Request $request, $id = null)
    {

        if ($request->isMethod('post')) {

            $data = $request->all();
            /*            echo '<pre>';
            print_r($data);
            die;*/

            $control = Control::find($id);

            // Upload Image
            if ($request->hasFile('controlImage')) {
                $controlImage = $this->loadFile($request, 'controlImage', 'control/files', 'controls');
            } else if (!empty($data['currentControlImage'])) {
                $controlImage = $data['currentControlImage'];
            } else {
                $controlImage = '';
            }

            if ($request->hasFile('controlFile')) {
                $control->archivo = $this->loadFile($request, 'controlFile', 'control/files', 'controls');
            } else {
                $control->archivo = $data['currentControlFile'] ?? "";
            }

            if ($request->hasFile('sliderImage')) {
                $control->imagen_slider = $this->loadFile($request, 'sliderImage', 'sliders', 'sliders');
            } else if (!empty($data['currentSliderImage'])) {
                $control->imagen_slider = $data['currentSliderImage'];
            } else {
                $control->imagen_slider = '';
            }

            if (!empty($data['treeId'])) {
                $control->tree_id = $data['treeId'];
            }

            if (!empty($data['showCaption'])) {
                $control->show_caption = 1;
            } else {
                $control->show_caption = 0;
            }

            $control->titulo = $data['controlTitle'];
            $control->idcontrol_categoria = $data['categoryId'];
            $control->imagen = $controlImage;
            $control->idusuario = Auth::guard('admin')->user()->id;
            $control->resumen = $data['controlResume'] ?? '';
            $control->tipo = $data['typelink'] ?? '';
            $control->redireccion = $data['controlTextLink'] ?? '';
            $control->video = $data['controlUrlVideo'];
            $control->modificado = now('America/Lima');
            $control->descripcion = htmlspecialchars_decode(e($data['controlContent']));

            $control->update();

            Session::flash('success_message', 'El articulo se Actualizo Correctamente');
            return redirect()->route('dashboard.control.index');
        }

        $controlDetail = Control::find($id);
        $categories = DB::table('dx_control_categoria')->select('id', 'titulo')->where('estado',1)->get();
        $trees = DocumentTree::where('parent_id', '=', 0)->pluck('name', 'id')->all();
        $tree_drop_down = "<option value='' selected disabled>Selected</option>";
        foreach ($trees as $id => $tree) {
            if ($id == $controlDetail->tree_id) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $tree_drop_down .= "<option value='" . $id . "' " . $selected . ">" . $tree . "</option>";
        }
        $categories_drop_down = "<option value='' selected disabled>Select</option>";
        foreach ($categories as $category) {
            if ($category->id == $controlDetail->idcontrol_categoria) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $categories_drop_down .= "<option value='" . $category->id . "' " . $selected . ">" . $category->titulo . "</option>";
        }
        $companyData = getCompanyData();
        return view('admin.control.edit_control')->with(compact('categories_drop_down', 'controlDetail', 'companyData', 'tree_drop_down'));
    }

    public function destroy($id)
    {
        Control::find($id)->delete();
        $message = 'La Seccion se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect()->route('dashboard.controls.index');
    }
}
