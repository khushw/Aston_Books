<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Condition;

class ConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $conditions = Condition::all();

        return view('conditions.index')->with('conditions',$conditions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('conditions.create');
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
        
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required'
        ]);

        $conditions = new Condition;
        $conditions->name = $request->input('name');
        $conditions->description = $request->input('description');
        $conditions->save();

        return redirect('conditions')->with('success', 'Your condition has been created!');
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
        //
        $condition = Condition::find($id);

        return view('conditions.edit')->with('condition', $condition);
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
        
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required'
        ]);

        $condition =  Condition::find($id);
        $condition->name = $request->input('name');
        $condition->description = $request->input('description');
        $condition->save();

        return redirect('conditions')->with('success', 'Your condition has been updated!');
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
        $condition = Condition::find($id);
        $condition->delete();

        return redirect('conditions')->with('success', 'Category has been removed');
    }
}
