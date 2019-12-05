<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use Validator;

class PlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $places = Place::all();
            return view(env('THEME').'.index')->with('places',$places);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view(env('THEME').'.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if($request->isMethod('post')){

                $input = $request->except('_token');

                $messages = [

                    'required' => 'Поле :attribute обязательно к заполнению',
                    'unique' => 'Поле :attribute должно быть уникальное',

                ];

                $validator = Validator::make($input,[

                    'name'=>'required|unique:places',
                    'type'=>'required',
                    'desc'=>'required'

                ],$messages);

                if($validator->fails()){
                    //return redirect()->route('pagesAdd')->withErrors($validator)->withInput();
                    return back()->withErrors($validator)->withInput();
                }
 
            if(request()->hasFile('image')){

                $file = $request->image;
                $input['image'] = $request->file('image')->getClientOriginalName();
                
                $file->move(public_path().'/assets/img/',$input['image']);
            
            }

            $place = new Place;

            $place->fill($input);

            if($place->save()){
                $places = Place::all();
                return view(env('THEME').'.index')->with('places',$places);
            }
            
            abort(404);
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
        $place = Place::find($id);

        return view(env('THEME').'.place')->with('place',$place);

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
        $place = Place::find($id);
        return view(env('THEME').'.form_edit')->with('place',$place);
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
        //
        $place = Place::find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
