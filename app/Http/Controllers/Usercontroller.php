<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Contracts\HasApiTokens;




class Usercontroller extends Controller
{
    use GeneralTrait;
    public function regester(Request $request)
    {

        $validato=Validator::make($request->all(),[
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
        return $this->apiResponse('Regester Done', true, null, 200);


    }

    public function login(Request $request)
    {
        $user=User::where('email',$request->email)->first();
        if(!hash::check($request->password,$user->password)){
            return $this->apiResponse([], true, 'regester faild', 500);

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
            return $this->apiResponse([], true, null, 200);
          }else {
            return $this->apiResponse([], true, 'logout faild', 200) ;
                              }

    }


}
