<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmpresaController extends Controller
{
    public function index()
    {
        $data = Empresa::orderBy("orden")->get(["id","nombre"]);
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $data = new Empresa($request->all());
        // upload image base64
        if($request->urlfoto){
            $img = $request->urlfoto;
            ///process
            $folderPath = "/img/empresa/";
            $image_parts = explore(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath.Str::slug($request->nombre).'.'.$image_type;
            file_put_contents(public_path($file), $image_base64);
            $data->urlfoto = Str::slug($request->nombre).'.'.$image_type;
        }
        $data->save();
        return response()->json($data, 200);
    }
    public function show($id)
    {
        $data = Empresa::find($id);
        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $data = Empresa::find($id);
        $data->fill($request->all());
        if($request->urlfoto){
            $img = $request->urlfoto;
            ///process
            $folderPath = "/img/empresa/";
            $image_parts = explore(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath.Str::slug($request->nombre).'.'.$image_type;
            file_put_contents(public_path($file), $image_base64);
            $data->urlfoto = Str::slug($request->nombre).'.'.$image_type;
        }
        $data->save();
        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $data = Empresa::find($id);
        $data->delete();
        return response()->json($data, 200);
    }
}
