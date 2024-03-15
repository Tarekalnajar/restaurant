<?php

namespace App\Http\Controllers;
use App\Models\resturant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\GeneralTrait;
use App\Models\menu;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ResourceResturant;


class Resturantcontroller extends Controller
{
    use GeneralTrait;
    
    public function store(Request $request,$avg)
    {
        if($request->isMethod('post'))
        {
        $avg=DB::table('rates')->where('resturant_id',$avg)->avg('rate');
        $validato=Validator::make($request->all(),[
            'name'=>'required|string|alpha',
            'location'=>'required|string|alpha',
            'type'=>'required',
            'phone'=>'required|integer',
          //  'reate'=>'required',
         ]);
         if($validato->fails())
         {
          return $this->requiredField($validato->errors());
         }
        $resturant=resturant::create([
            'name'=>$request->name,
            'location'=>$request->location,
            'type'=>$request->type,
            'phone'=>$request->phone,
            'reate'=>$avg
        ]);
        return $this->apiResponse('Item store successfully',true,null,200);
    }
        else {
           return $this->requiredField('error in sending');  
        }
           
        
    }




    public function update(Request $request,$id)
    {
        if($request->isMethod('post')){
        $validato=Validator::make($request->all(),[
            'name'=>'required',
            'location'=>'required',
            'type'=>'required',
            'phone'=>'required',
           // 'reate'=>'required',
         ]);
         if($validato->fails())
         {
          return $this->requiredField($validato->errors());
         }

         $resturant=resturant::find($id);
         $resturant->name=$request->name;
         $resturant->location=$request->location;
         $resturant->type=$request->type;
         $resturant->phone=$request->phone;
         $resturant->save();
         return $this->apiResponse('Item upadte successfully',true,null,200);
        }
         else
         {
            return $this->requiredField('error in sending');  

         }
        }



    public function destore($id)
    {
        $resturant=resturant::find($id);
        if(!$resturant)
        {
            return $this->apiResponse($resturant,false,'no item',404);

        }
        $resturant->delete();
        if($resturant)
        {
            return $this->apiResponse($resturant,true,null,200);

        }
        else
        {
            return $this->apiResponse($resturant,false,null,500);

        }


    }
    public function index()
    {
        $resturant=resturant::with('menu')->get();
        $res=ResourceResturant::collection($resturant);
        return $this->apiResponse($res);
    }
    public function show(Request $request)
    {
        $restura=resturant::with('menu')->where('name',$request->name)->get();

        return $this->apiResponse($restura);
    }


    public function showrate(Request $request)
    {
        $restura=resturant::with('rate')->where('name',$request->name)->get();
        return $this->apiResponse($restura);
    }


    public function search(Request $request)
    {
    $search = $request->search;
    $results = resturant::where('location', 'like', "%$search%")
    ->orWhere('type', 'like', "%$search%")->get();
    return $this->apiResponse($results);
    }
}

