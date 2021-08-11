<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //fungsi untuk mengatur register/ create user
    public function registerUser(Request $request){

        //buat variable data yg berisi request (name, email, password)
        $data = $request->only(['name', 'email', 'password']);

        //validasi data dari user input
        $validator = Validator::make( 
            $data,
            [
                'name' => 'required|string|max:100',
                'email' => 'required|string|email|unique:App\Models|user,email',
                'password' => 'required|string|min:8'
            ]
        );
           

        //jika validatornya gagal maka muncul error
        if($validator->fails()){
            $errors = $validator->errors();
            return response()->json(compact('errors'), 401);
        }

        //buat user sesuai $data tersebut
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        //generate token untuk user yang telah dibuat
        $token = $user->createToken('api_token')->plainTextToken;

        //menampilkan response berisi user dan token
        //200 artinya sukses
        return response()->json(compact(['user', 'token']), 200);
    }

    //Fungsi login user 
    public function loginUser(Request $request){

        //ambil data email dan password saja
        $data = $request->only(['email', 'password']);

        //validasi data
        $validator = Validator::make(
            $data,
            [
                'email' => 'required|string|email',
                'password' => 'required|string|min:8'
            ]
        );

        //jika validator gagal, tampilkan error
        if($validator->fails()){
            $errors = $validator->errors();
            return response()->json(compact('errors'), 400);
        }

        //Auth attempt untuk mengecek apakah data (email dan password) sesuai
        if(Auth::attempt($data)){
            $user = User::where('email', $data['email'])->first();
            $token = $user->createToken('api_token')->plainTextToken;
            return response()->json(compact(['user', 'token']), 200);
        }
    }
}
