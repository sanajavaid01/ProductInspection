<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductsInspection; 

class ProductsInspectionController extends Controller
{
    /**
     * Assigning inspctions steps to product.
     *
     * @return \Illuminate\Http\Response
     */
    public function assignStepsToProduct(Request $request)
    {
        $product_id=$request->product_id;
        $sub_steps_array=$request->sub_step_array;
        $collection = collect($sub_steps_array);
        $grouped = $collection->groupBy('inspection_id');
        $deleted = ProductsInspection::where('product_id',$product_id)->delete();

        foreach($grouped as $key => $value) {
            $steps=collect($value)->implode('step_id', ',');
            $saved=ProductsInspection::create([
                'product_id'=>$product_id,
                'inspection_id'=>$key,
                'inspection_steps'=>json_encode(explode(",", $steps))
                
            ]);
          }
          if($saved)
        {
            return response()->json(['status'=>true,'msg' => 'Steps saved sucessfully']);
        }
        else
        {
            return response()->json(['status'=>false,'msg' => 'Steps are not saved sucessfully']);
        }

       
    }

   
}
