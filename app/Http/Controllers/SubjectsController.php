<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use App\Models\subjects;
use App\Models\contracts;
use App\Models\companies;
use App\Models\finances;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $subjects = subjects::all();
        $companies = companies::all();
        $contracts = contracts::all();
        $companies = companies::all();
        $finances= finances::all();
        
        return view('subjects.subjects',compact('contracts','subjects'));
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
            'sub_name' => 'required|unique:companies|max:255',
            'con_id' => 'required|unique:companies|max:255',
           
        ],[

            'sub_name.required' =>'يرجى ادخال الموضوع',
            'con_id.required' =>'يرجى ادخال رقم العقد ',
            


        ]);

            companies::create([
                'sub_name' => $request->sub_name,
                'con_id' => $request->con_id,

            ]);
            session()->flash('Add', 'تم اضافة الموضوع بنجاح ');
            return redirect('/subjects');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function show(subjects $subjects)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function edit(subjects $subjects)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, subjects $subjects)
    {
        
       
        $id = $request->id;

        $this->validate($request, [
            'sub_name' => 'required|unique:companies|max:255',
            'con_id' => 'required|unique:companies|max:255',
           
        ],[

            'sub_name.required' =>'يرجى ادخال الموضوع',
            'con_id.required' =>'يرجى ادخال رقم العقد ',
            

        ]);

        $subjects = subjects::find($id);
        $subjects->update([
            'sub_name' => $request->sub_name,
            'con_id' => $request->con_id,
         
        ]);

        session()->flash('edit','تم تعديل الشركة بنجاج');
        return redirect('/subjects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function destroy(subjects $subjects)
    {
       
        $id = $request->id;
        subjects::find($id)->delete();
        session()->flash('delete','تم حذف الموضوع بنجاح');
        return redirect('/subjects');
    }
}
