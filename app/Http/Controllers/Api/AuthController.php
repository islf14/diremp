<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $response = ["success" => "false"];
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            $response = ["error" => $validator->errors()];
             return response()->json($response, 200);
        }

        $input = $request->all();
        $input["password"] = bcrypt($input["password"]);
        $user = User::create($input);
        $user->assignRole('client');

        $response["success"] = true;
        return response()->json($response,200);
    }

    public function login (Request $request){
        $response = ["success" => false];
        $response = ['message' => 'No logueado'];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            $response = ["error"=>$validator->errors()];
            return response()->json($response, 200);
        }

        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            $user = Auth::user();
            $role = $user->hasRole('client'); //pregunta rol
            $response["token"] = $user->createToken("world")->plainTextToken;
            $response['success'] = true;
            $response['role'] = $role;
            $response['user'] = $user;
            $response['message'] = 'Sesisón iniciada';
        }
        return response()->json($response,200);
    }

    public function logout(){
        $response = ['success' => false];
        $user = Auth::user();
        $user->tokens()->delete();
        $response = [
            'success' => true,
            'message' => 'Sesión cerrada',
        ];
        return response()->json($response, 200);

    }
}
