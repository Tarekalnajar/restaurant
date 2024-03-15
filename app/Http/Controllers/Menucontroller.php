<?php

namespace App\Http\Controllers;
use App\Http\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;
use App\Models\menu;
use Illuminate\Http\Request;
use App\Http\Resources\Resourcemenue;

class Menucontroller extends Controller
{
    use GeneralTrait;
    
    public function store(Request $request)
    {
        if($request->isMethod('POST')){
        $validato=Validator::make($request->all(),[
            'name'=>'required|string|alpha',
            'descraption'=>'required|string|alpha',
            'price'=>'required|integer',
            'resturant_id'=>'required|exists:resturants,id',
         ]);
         if($validato->fails())
         {
          return $this->requiredField($validato->errors());
         }
        $resturant=menu::create([
            'name'=>$request->name,
            'descraption'=>$request->descraption,
            'price'=>$request->price,
            'resturant_id'=>$request->resturant_id
        ]);
        return $this->apiResponse('Item store successfully',true,null,200);}
        else
        {
            $massege='error in sending';
            return $this->requiredField($massege); 
        }
    }
    public function update(Request $request,$id)
    {
        if($request->isMethod('POST')){
        $validato=Validator::make($request->all(),[
            'name'=>'required|string|alpha',
            'descraption'=>'required|string|alpha',
            'price'=>'required|integer',
            'resturant_id'=>'required|exists:resturants,id',
         ]);
         if($validato->fails())
         {
          return $this->requiredField($validato->errors());
         }

         $resturant=menu::find($id);
         $resturant->name=$request->name;
         $resturant->descraption=$request->descraption;
         $resturant->price=$request->price;
         $resturant->resturant_id=$request->resturant_id;
         $resturant->save();
         return $this->apiResponse('Item upadte successfully',true,null,200);}
         else
         {
             $massege='error in sending';
             return $this->requiredField($massege); 
         }
    }
    public function destore($id)
    {
        $menu=menu::find($id);
        if(!$menu)
        {
            return $this->apiResponse($menu,false,'no item',404);

        }
        $menu->delete();
        if($menu)
        {
            return $this->apiResponse($menu,true,null,200);

        }
        else
        {
            return $this->apiResponse($menu,false,null,500);

        }
    }
    public function index()
    {
        $sta=menu::get();
        $data=Resourcemenue::collection(menu::all());
         return $this->apiResponse($data);
        
    }
}
