<?php

namespace App\Http\Controllers;

use App\Models\govers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $govers= govers::all();
        
        return view('govers.govers',compact('govers'));
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
        $validatedData = $request->validate([
            'gov_name' => 'required|unique:govers|max:255',
        ],[

            'gov_name.required' =>'يرجي ادخال اسم الدائرة',
            'gov_name.unique' =>'اسم الدائرة مسجل مسبقا',


        ]);

            govers::create([
                'gov_name' => $request->gov_name,
                'Created_by' => (Auth::user()->name),

            ]);
            session()->flash('Add', 'تم اضافة الدائرة بنجاح ');
            return redirect('/govers');
 
    }


    /**
     * Display the specified resource.
     *
     * 
     * 












     
     * @param  \App\Models\govers  $govers
     * @return \Illuminate\Http\Response
     */
    public function show(govers $govers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\govers  $govers
     * @return \Illuminate\Http\Response
     */
    public function edit(govers $govers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\govers  $govers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, govers $govers)
    {
        $id = $request->id;

        $this->validate($request, [

            'gov_name' => 'required|max:255|unique:govers,gov_name,'.$id,
           
        ],[

            'gov_name.required' =>'يرجي ادخال اسم القسم',
            'gov_name.unique' =>'اسم القسم مسجل مسبقا',
          

        ]);

        $govers = govers::find($id);
        $govers->update([
            'gov_name' => $request->gov_name,
         
        ]);

        session()->flash('edit','تم تعديل القسم بنجاج');
        return redirect('/govers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\govers  $govers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , govers $govers)
    {
        $id = $request->id;
        govers::find($id)->delete();
        session()->flash('delete','تم حذف الدائرة بنجاح');
        return redirect('/govers');
    }
}
