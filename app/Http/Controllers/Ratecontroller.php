<?php

namespace App\Http\Controllers;

use App\Http\Resources\Resourcerate;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\GeneralTrait;
use App\Models\rate;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class Ratecontroller extends Controller
{
    use GeneralTrait;
    
    public function store(Request $request)
    {

        if($request->isMethod('post')){

        $user=auth()->id();
        $validato=Validator::make($request->all(),[
            'commint'=>'required|string|alpha',
            'rate'=>'required|integer|min:0|max:10',
            'resturant_id'=>['required',Rule::unique('rates')->where(function ($query)use($request)
            {
                return $query->where('resturant_id',$request->resturant_id)->where('user_id',auth()->id());
            })],
           // 'user_id'=>'required|integer',
         ]);
         if($validato->fails())
         {
          return $this->requiredField($validato->errors());
         }
        $resturant=rate::create([
            'commint'=>$request->commint,
            'rate'=>$request->rate,
            'resturant_id'=>$request->resturant_id,
            'user_id'=>$user,
        ]);
        return $this->apiResponse('Item store successfully',true,null,200);}
        {
            return $this->requiredField('error in sending');  
 
         }
    }
    public function update(Request $request,$id)
    {        if($request->isMethod('post')){

        $validato=Validator::make($request->all(),[
            'commint'=>'required|string|alpha',
            'rate'=>'required|integer|min:0|max:10',
            'resturant_id'=>'required',
         ]);
         if($validato->fails())
         {
          return $this->requiredField($validato->errors());
         }

         $rate=rate::find($id);
         $rate->commint=$request->commint;
         $rate->rate=$request->rate;
         $rate->save();
         return $this->apiResponse('Item update successfully',true,null,200);}
         {
            return $this->requiredField('error in sending');  
 
         }
        }
        public function destore($id)
        {
            $rate=rate::find($id);
            if(!$rate)
            {
                return $this->apiResponse($rate,false,'no item',404);
    
            }
            $rate->delete();
            if($rate)
            {
                return $this->apiResponse($rate,true,null,200);
    
            }
            else
            {
                return $this->apiResponse($rate,false,null,500);
    
            }
    
        }
        public function index()
        {
            $rate=rate::with('resturant')->get();
            $rate_r=Resourcerate::collection($rate);
            return $this->apiResponse($rate_r);
        }
        
}
