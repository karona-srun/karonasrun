<?php

namespace App\Http\Controllers;

use App\Models\ContentTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContentTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contentTypes = ContentTypes::get();  
        foreach($contentTypes as $i => $cont)
            $contentTypes[$i]['image'] = url()->previous().$cont->image;
        return response()->json($contentTypes);
        // return ContentTypeResource::collection(ContentTypes::all());
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
            'image' => 'required',
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').str_replace(' ', '_', $file->getClientOriginalName());
            $file-> move(public_path('images/content_types'), $filename);
        }

        $contentTypes = new ContentTypes();
        $contentTypes->name = $request->name;
        $contentTypes->image = '/images/content_types/'.$filename ?? '';
        $contentTypes->save();

        return response()->json($contentTypes);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContentTypes  $contentTypes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contentTypes = ContentTypes::find($id);
        if(!$contentTypes){
            return response()->json('No data available',403);
        }
        return response()->json($contentTypes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContentTypes  $contentTypes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContentTypes  $contentTypes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').str_replace(' ', '_', $file->getClientOriginalName());
            $file-> move(public_path('images/content_types'), $filename);
        }

        $contentTypes = ContentTypes::find($id);
        if(!$contentTypes){
            return response()->json('No data available',403);
        }
        $contentTypes->name = $request->name;
        $contentTypes->image = '/images/content_types/'.$filename ?? '';
        $contentTypes->save();

        return response()->json($contentTypes);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContentTypes  $contentTypes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contentTypes = ContentTypes::find($id);
        if($contentTypes){
            $contentTypes->delete();
            return response()->json($contentTypes);
        }

        return response()->json('No data available',403);
    }
}
