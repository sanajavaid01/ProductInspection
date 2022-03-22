<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Product; 
use DataTables;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        $validator = Validator::make($request->all(), [
            'name'=>"required|string|max:50",
            'sku_code'=>"required|string|unique:products",
            
            ]);
            if($request->file('image')){
                $file= $request->file('image');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('public/image'), $filename);
            }
            if ( $validator->fails())
            {
                return response()->json(['status'=>false,'msg' => json_encode($validator->errors())]);
            }
            else{
                $name=$request->name;
                $sku_code=$request->sku_code;
                $saved=Product::create([
                'name'=>$name,
                'sku_code'=>$sku_code,
                'image'=>$filename
                
            ]);
           
            if($saved)
            {
                return response()->json(['status'=>true,'msg' => 'Product added sucessfully']);
            }
            else
            {
                return response()->json(['status'=>false,'msg' => 'Product is not added sucessfully']);
            }

            }
           
    }

     /**
     * Display datatable for products.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::latest()->get();
            return Datatables::of($data)
                    ->addColumn('name', function($row){
                        return $row->name;
                    })
                    ->addColumn('assign_inspection', function($row){
                        $btn = '<a href="javascript:void(0)" onclick="assignInspectionSteps('.$row->id.', \''.$row->name.'\')">Assign Inspection Step</a>';
     
                            return $btn;
                    })
                    ->addColumn('edit', function($row){
   
                           $btn = '<a href="javascript:void(0)" onclick="editProduct('.$row->id.', \''.$row->name.'\')"><i class="fa fa-edit"></i></a>';
     
                            return $btn;
                    })
                    ->addColumn('delete', function($row){
   
                        $btn = '<a href="javascript:void(0)" onclick="deleteProduct('.$row->id.')"><i class="fa fa-trash"></i></a>';
  
                         return $btn;
                 })
                    ->rawColumns(['assign_inspection','edit','delete'])
                    ->make(true);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $detail=Product::where('id',$request->id)->get();
        if($detail)
            {
                return response()->json(['status'=>true,'msg' => 'Product updated sucessfully','data'=> $detail]);
            }
            else
            {
                return response()->json(['status'=>false,'msg' => 'Product is not updated sucessfully']);
            }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'p_name'=>"required|string|max:50",
            
            
            ]);
            if($request->file('p_image')){
                $file= $request->file('p_image');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('public/image'), $filename);
                $saved=Product::where('id',$request->update_p_id)->update([
                    'image'=>$filename
                ]);
            }
            if ( $validator->fails())
            {
                return response()->json(['status'=>false,'msg' => json_encode($validator->errors())]);
            }
            else{
                $name=$request->p_name;
                $sku_code=$request->p_sku_code;
                $saved=Product::where('id',$request->update_p_id)->update([
                'name'=>$name,
                
            ]);
           
            if($saved)
            {
                return response()->json(['status'=>true,'msg' => 'Product updated sucessfully']);
            }
            else
            {
                return response()->json(['status'=>false,'msg' => 'Product is not updated sucessfully']);
            }

            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $deleted = Product::find($request->id)->delete();
        if($deleted)
        {
            return response()->json(['status'=>true,'msg' => 'Product deleted sucessfully']);
        }
        else
        {
            return response()->json(['status'=>false,'msg' => 'Product is not deleted sucessfully']);
        }
    }
}
