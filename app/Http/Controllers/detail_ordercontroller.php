<?php

namespace App\Http\Controllers;
use App\Models\detail_order;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Ordercontroller;


class detail_ordercontroller extends Controller
{
    use GeneralTrait;

    public function store(Request $request)
    {
   
        if($request->isMethod('post')){

        $validato=Validator::make($request->all(),[
            'menu_id'=>'required|exists:menus,id',
            'quantity'=>'required|integer',
            'order_id'=>'required|exists:orders,id',
            'price'=>'required|integer',

         ]);
         
         if($validato->fails())
         {
          return $this->requiredField($validato->errors());
         }
         $qun=$request->quantity;
         $price=$request->price;
         $total=$qun*$price;
        $resturant=detail_order::create([
            'menu_id'=>$request->menu_id,
            'quantity'=>$request->quantity,
            'total'=>$total,
            'order_id'=>$request->order_id,
            'price'=>$request->price,

        ]);
        return $this->apiResponse('Item store successfully',true,null,200);}
        else
        {
           return $this->requiredField('error in sending');  

        }
    }
    public function update(Request $request,$id)
    {
        if($request->isMethod('post')){

        $qun=$request->quantity;
        $price=$request->price;
        $total=$qun*$price;

        $validato=Validator::make($request->all(),[
            'menu_id'=>'required|exists:menus,id',
            'quantity'=>'required|integer',
            'order_id'=>'required|exists:orders,id',
            'price'=>'required|integer',
         ]);
         if($validato->fails())
         {
          return $this->requiredField($validato->errors());
         }

         $d_order=detail_order::find($id);
         $d_order->menu_id=$request->menu_id;
         $d_order->quantity=$request->quantity;
         $d_order->order_id=$request->order_id;
         $d_order->price=$request->price;
         $d_order->total=$total;
         $d_order->save();
         return $this->apiResponse('Item upadte successfully',true,null,200);}
         else
         {
            return $this->requiredField('error in sending');  
 
         }

    }
    public function destore($id)
    {
        $d_order=detail_order::find($id);
        if(!$d_order)
        {
            return $this->apiResponse($d_order,false,'no item',404);

        }
        $d_order->delete();
        if($d_order)
        {
            return $this->apiResponse($d_order,true,null,200);

        }
        else
        {
            return $this->apiResponse($d_order,false,null,500);

        }

    }
}
