<?php

namespace App\Http\Controllers;

use App\Models\Contents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = Contents::get();   
        return response()->json($contents);
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
        $validator = Validator::make($request->all(), [
            'content_type' => 'required',
            'name' => 'required',
            'youtubeId' => 'required',
            'youtubeLink' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $content = new Contents();
        $content->content_type_id = $request->content_type;
        $content->name = $request->name;
        $content->youtubeId = $request->youtubeId;
        $content->youtubeLink = $request->youtubeLink;
        $content->save();

        return response()->json($content);
    }

    public function newContents()
    {
        $contents = Contents::orderBy('created_at','desc')->take(10)->get();
        return response()->json($contents);
    }

    public function searchName(Request $request)
    {
        $contents = Contents::orderBy('created_at','desc')->where('name','like','%'.$request->name.'%')->get();
        return response()->json($contents);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contents  $contents
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contents = Contents::find($id);
        if(!$contents){
            return response()->json('No data available',403);
        }
        return response()->json($contents);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contents  $contents
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contents = Contents::find($id);
        if(!$contents){
            return response()->json('No data available',403);
        }
        return response()->json($contents);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contents  $contents
     * @return \Illuminate\Http\Response
     */
    public function filterContentType($id)
    {
        $contents = Contents::where('content_type_id',$id)->get();
        if($contents->isEmpty()){
            return response()->json(Contents::get());
        }
        return response()->json($contents);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contents  $contents
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'content_type' => 'required',
            'name' => 'required',
            'youtubeId' => 'required',
            'youtubeLink' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $content = Contents::find($id);
        $content->content_type_id = $request->content_type;
        $content->name = $request->name;
        $content->youtubeId = $request->youtubeId;
        $content->youtubeLink = $request->youtubeLink;;
        $content->save();

        return response()->json($content);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contents  $contents
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contents = Contents::find($id);
        if(!$contents){
            return response()->json('No data available',403);
        }
        $contents->delete();
        return response()->json($contents);
    }
}
