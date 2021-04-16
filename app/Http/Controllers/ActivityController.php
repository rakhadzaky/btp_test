<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\Methods;
use App\Models\LearningActivitys;

class ActivityController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function map_activity_method($methods){
        $method_act_map = array();
        foreach ($methods as $method) {
            $method_act_map[$method->name] = $this->map_activity_month($method->activitys);
        }
        return $method_act_map;
    }

    function map_activity_month($activitys){
        $month_act = array();
        foreach ($activitys as $activity) {
            $month_act[(int)date('m',strtotime($activity->start_date))][] = $activity;
        }
        return $month_act;
    }

    public function refresh_data(){
        $methods = Methods::all();
        $method_act_map = $this->map_activity_method($methods);
        return response()->json($method_act_map);
    }
    
    public function index()
    {
        $methods = Methods::all();
        $activitys = LearningActivitys::all();
        $method_act_map = $this->map_activity_method($methods);
        return view('learning_activity.index',compact('methods','activitys','method_act_map'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $methods = Methods::all();
        return view('learning_activity.create',compact('methods'));
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
            'title_input' => 'required',
            'start_input' => 'required',
            'end_input' => 'required',
            'method_input' => 'required',
        ]);
 
        if ($validator->fails()) {
            return response()->json(['status'=>'fail','validation'=>$validator->messages()]);
        }

        if ($request->id_input != null) {
            $data = LearningActivitys::find($request->id_input);
        }else{
            $data = new LearningActivitys;
        }
        $data->title = $request->title_input;
        $data->start_date = $request->start_input;
        $data->end_date = $request->end_input;
        if(!is_numeric($request->method_input)){
            if (($method = Methods::where('name','like','%'.$request->method_input.'%')->first()) == null) {
                $method = new Methods;
                $method->name = $request->method_input;
                $method->save();
            }
        }else{
            if(($method = Methods::find($request->method_input)) == null){
                $method = new Methods;
                $method->name = $request->method_input;
                $method->save();
            }
        }
        $data->id_method = $method->id;
        $data->save();
        // return redirect(route('learning_activity.index'));
        return response()->json(['status'=>'success','success'=>'Ajax request submitted successfully']);
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
    public function edit($id)
    {
        // $methods = Methods::all();
        $activity = LearningActivitys::find($id);
        // return view('learning_activity.edit',compact('methods', 'activity'));
        return response()->json($activity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title_edit' => 'required',
            'start_edit' => 'required',
            'end_edit' => 'required',
            'method_edit' => 'required|exists:methods,id',
        ]);
 
        if ($validator->fails()) {
            return response()->json(['status'=>'fail','validation'=>$validator->messages()]);
        }

        $data = LearningActivitys::find($id);
        $data->title = $request->title_edit;
        $data->start_date = $request->start_edit;
        $data->end_date = $request->end_edit;
        $data->id_method = $request->method_edit;
        $data->save();
        return response()->json(['status'=>'success','success'=>'Ajax request submitted successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = LearningActivitys::find($id);
        $data->delete();
        // return redirect(route('learning_activity.index'));
        return response()->json(['success'=>'Activity deleted!']);
    }
}
