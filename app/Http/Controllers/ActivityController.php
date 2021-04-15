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
    
     public function index()
    {
        $methods = Methods::all();
        $activitys = LearningActivitys::all();
        $method_act_map = $this->map_activity_method($methods);
        // foreach ($method_act_map as $key => $map) {
        //     dd(array_key_exists(1, $map));
        // };
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
            'title' => 'required',
            'start' => 'required',
            'end' => 'required',
            'method' => 'required',
        ]);
 
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = new LearningActivitys;
        $data->title = $request->title;
        $data->start_date = $request->start;
        $data->end_date = $request->end;
        if(gettype($request->method) == 'string'){
            if (($method = Methods::where('name','like','%'.$request->method.'%')->first()) == null) {
                $method = new Methods;
                $method->name = $request->method;
                $method->save();
            }
        }else{
            if(($method = Methods::find($request->method)) == null){
                $method = new Methods;
                $method->name = $request->method;
                $method->save();
            }
        }
        $data->id_method = $method->id;
        $data->save();
        return redirect(route('learning_activity.index'));
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
        $methods = Methods::all();
        $activity = LearningActivitys::find($id);
        return view('learning_activity.edit',compact('methods', 'activity'));
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
            'title' => 'required',
            'start' => 'required',
            'end' => 'required',
            'method' => 'required|exists:methods,id',
        ]);
 
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = LearningActivitys::find($id);
        $data->title = $request->title;
        $data->start_date = $request->start;
        $data->end_date = $request->end;
        $data->id_method = $request->method;
        $data->save();
        return redirect(route('learning_activity.index'));
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
        return redirect(route('learning_activity.index'));
    }
}
