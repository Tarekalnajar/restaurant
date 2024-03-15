<?php

namespace App\Http\Controllers;
use App\Models\order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\GeneralTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\ordernew;
use App\Http\Resources\Resourceorder;

class Ordercontroller extends Controller
{
    use GeneralTrait;

       public function store(Request $request,$idtotal)
    {
        if($request->isMethod('POST')){
        $total_price=DB::table('detail_orders')->where('order_id',$idtotal)->sum('total');
        $validato=Validator::make($request->all(),[
            'resturant_id'=>'required|string|exists:resturants,id',
            'status'=>'string|in:sent delivered,delivery is in progress',

         ]);
         $user=auth()->id();
         if($validato->fails())
         {
          return $this->requiredField($validato->errors());
         }
            $order=order::create([
            'resturant_id'=>$request->resturant_id,
            'user_id'=>$user,
            'time'=>Carbon::now()->toTimeString(),
            'date'=>Carbon::now()->toDate(),
            'titel_price'=>$total_price,
            'status'=>$request->status,

        ]);
        $us=auth()->id();
        $user=user::find($us);
        $name=$user->name;
        $massages['welcome']="Hey, you".','.$name;
        $user->notify(new ordernew($massages));
        return $this->apiResponse('Item store successfully',true,null,200);
    }
        else
        {
            $massege='error in sending';
            return $this->requiredField($massege); 
        }

       

      
       //  $last=$order->id;
        
    }
    public function update(Request $request,$id)
    {
        if($request->isMethod('POST')){
        $validato=Validator::make($request->all(),[
            'status'=>'string|in:sent delivered,delivery is in progress',

         ]);
         $user=auth()->id();
         if($validato->fails())
         {
          return $this->requiredField($validato->errors());
         }
         $order=order::find($id);
         $order->status=$request->status;
         $order->save();
         return $this->apiResponse('Item update successfully',true,null,200);
        }
         else
         {
             $massege='error in sending';
             return $this->requiredField($massege); 
         }
    }

    public function index()
    {
        if(Auth::check())
        {
        $order=auth()->user()->order;
        $order_r=Resourceorder::collection($order);
        return $this->apiResponse($order_r);
        }
        else
        {
          return  response()->json(null,204);
        }


        

        








    }
    public function destore($id)
    {
        $order=order::find($id);
        if(!$order) {
            return $this->apiResponse($order,false,'order not found',404);
        }
        $order->delete();
        if($order)
        {
            return $this->apiResponse($order,true,null,200);

        }
        else
        {
            return $this->apiResponse($order,false,null,500);

        }
        

    }

}
