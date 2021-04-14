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
    public function index()
    {
        $methods = Methods::all();
        $activitys = LearningActivitys::all();
        return view('learning_activity.index',compact('methods','activitys'));
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
            'method' => 'required|exists:methods,id',
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
        $data->id_method = $request->method;
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
