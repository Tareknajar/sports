<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\GeneralTrait;
use Illuminate\Http\Request;

class Auth_controller extends Controller
{
    use GeneralTrait;
    public function regester(Request $request)
    {   $validato=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|unique:Users,email',
            'password'=>'required',
         ]);
         if($validato->fails())
         {
          return $this->requiredField($validato->errors());
         }
        $uese=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
           
        ]);
        return $this->apiResponse('Regester Done');

    }

    public function login(Request $request)
    {
        $user=User::where('email',$request->email)->first();
        if(!hash::check($request->password,$user->password)){
            return $this->requiredField('Regester faild');

        }
        else{
           $token=$user->createToken($user->name);
           return response()->json(['token'=>$token->plainTextToken,'user'=>$user]);
         //  return $token;
           
        }
    }
    public function logout()
    {
        $user =auth()->user();
        if ($user) {
           $user->tokens()->delete();
            return $this->apiResponse('You are logged out');
          }else {
                return $this->requiredField('not found');
            }
    }
    
}
