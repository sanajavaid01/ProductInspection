<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inspection; 
use App\Models\ProductsInspection; 
use DataTables;


class InspectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'heading'=>"required|string|max:50",
            ]);
            $heading=$request->heading;
            $saved=Inspection::create([
            'heading'=>$heading
        ]);
        
        if($saved)
        {
            return response()->json(['status'=>true,'msg' => 'inspection added sucessfully']);
        }
        else
        {
            return response()->json(['status'=>false,'msg' => 'inspection is not added sucessfully']);
        }
       
    }

    /**
     * Display datatable for inspection.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $data = Inspection::latest()->get();
            return Datatables::of($data)
                    ->addColumn('heading', function($row){
                        return $row->heading;
                    })
                    ->addColumn('substeps', function($row){
                        $btn = '<a href="javascript:void(0)" onclick="subSteps('.$row->id.', \''.$row->heading.'\')">'.count($row->substeps).'</a>';
     
                        return $btn;
                    })
                    ->addColumn('edit', function($row){
   
                           $btn = '<a href="javascript:void(0)" onclick="editInspection('.$row->id.', \''.$row->heading.'\')"><i class="fa fa-edit"></i></a>';
     
                            return $btn;
                    })
                    ->addColumn('delete', function($row){
   
                        $btn = '<a href="javascript:void(0)" onclick="deleteInspection('.$row->id.')"><i class="fa fa-trash"></i></a>';
  
                         return $btn;
                 })
                    ->rawColumns(['substeps','edit','delete'])
                    ->make(true);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
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
        $request->validate([
            'heading'=>"required|string|max:50",
            ]);
            $heading=$request->heading;
            $edited=Inspection::where('id',$request->id)->update([
            'heading'=>$heading
        ]);
        
        if($edited)
        {
            return response()->json(['status'=>true,'msg' => 'inspection edit sucessfully']);
        }
        else
        {
            return response()->json(['status'=>false,'msg' => 'inspection is not edit sucessfully']);
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
        $deleted = Inspection::find($request->id)->delete();
        if($deleted)
        {
            return response()->json(['status'=>true,'msg' => 'inspection deleted sucessfully']);
        }
        else
        {
            return response()->json(['status'=>false,'msg' => 'inspection is not deleted sucessfully']);
        }

    }

    public function getInspectionSubsteps(Request $request)
    {
        
        $data=Inspection::with('SubSteps')->get();
        $assign_data=ProductsInspection::where('product_id',$request->id)->get()->all();
        if(count($data)>0)
        {
            return response()->json(['status'=>true,'msg' => ' data found','data' => $data,'assign_data'=> $assign_data]);
        }
        else
        {
            return response()->json(['status'=>false,'msg' => 'no data found']);
        }
        
        
    }
}
