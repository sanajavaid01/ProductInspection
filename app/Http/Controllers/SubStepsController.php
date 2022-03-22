<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubStep; 
use DataTables;

class SubStepsController extends Controller
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
            'sub_step_name'=>"required|string|max:50",
            "inspection_id"=>"required|int"
            ]);
            $sub_step_name=$request->sub_step_name;
            $saved=SubStep::create([
            'sub_step_name'=>$sub_step_name,
            "inspection_id"=>$request->inspection_id

        ]);
        
        if($saved)
        {
            return response()->json(['status'=>true,'msg' => 'Sub Step added sucessfully']);
        }
        else
        {
            return response()->json(['status'=>false,'msg' => 'Sub Step is not added sucessfully']);
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
     * Display datatable for sub step.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
     
        if ($request->ajax()) {
            $data = SubStep::where('inspection_id',$request->inspection_id)->latest()->get();
            return Datatables::of($data)
                    ->addColumn('sub_step_name', function($row){
                        return $row->sub_step_name;
                    })
                    ->addColumn('edit', function($row){
   
                           $btn = '<a href="javascript:void(0)" onclick="editSubStep('.$row->id.', \''.$row->sub_step_name.'\')"><i class="fa fa-edit"></i></a>';
     
                            return $btn;
                    })
                    ->addColumn('delete', function($row){
   
                        $btn = '<a href="javascript:void(0)" onclick="deleteSubStep('.$row->id.')"><i class="fa fa-trash"></i></a>';
  
                         return $btn;
                 })
                    ->rawColumns(['edit','delete'])
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
        //
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
            'sub_step_name'=>"required|string|max:50",
            ]);
            $sub_step_name=$request->sub_step_name;
            $edited=SubStep::where('id',$request->id)->update([
            'sub_step_name'=>$sub_step_name
        ]);
        
        if($edited)
        {
            return response()->json(['status'=>true,'msg' => 'Sub step edit sucessfully']);
        }
        else
        {
            return response()->json(['status'=>false,'msg' => 'Sub step is not edit sucessfully']);
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
        $deleted = SubStep::find($request->id)->delete();
        if($deleted)
        {
            return response()->json(['status'=>true,'msg' => 'Sub Step deleted sucessfully']);
        }
        else
        {
            return response()->json(['status'=>false,'msg' => 'Sub Step is not deleted sucessfully']);
        }

    }
}
