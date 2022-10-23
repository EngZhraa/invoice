<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use App\Models\contracts;
use App\Models\companies;
use App\Models\finances;



class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $companies = companies::all();
        $contracts = contracts::all();
        $companies = companies::all();
        $finances= finances::all();
        
        return view('companies.companies',compact('companies'));
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
            'comp_name' => 'required|unique:companies|max:255',
            'comp_id' => 'required|unique:companies|max:255',
            'comp_rel' => 'required:companies|max:255',
        ],[

            'comp_name.required' =>'يرجي ادخال اسم الجهة المنفذه',
            'comp_id.required' =>'يرجى ادخال رمز الجهة',
            'comp_rel.required' =>'   يرجى ادخال جنسية الدائرة',


        ]);

            companies::create([
                'comp_name' => $request->comp_name,
                'comp_id' => $request->comp_id,
                'comp_rel' => $request->comp_rel,
               

            ]);
            session()->flash('Add', 'تم اضافة الجهة بنجاح ');
            return redirect('/companies');
 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function show(companies $companies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function edit(companies $companies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, companies $companies)
    {
       
        $id = $request->id;

        $this->validate($request, [
            'comp_name' => 'required:companies|max:255',
            'comp_id' => 'required:companies|max:255',
            'comp_rel' => 'required:companies|max:255',
        ],[

            'comp_name.required' =>'يرجي ادخال اسم الجهة المنفذه',
            'comp_id.required' =>'يرجى ادخال رمز الجهة',
            'comp_rel.required' =>'   يرجى ادخال جنسية الدائرة',



        ]);

        $companies = companies::find($id);
        $companies->update([
            'comp_name' => $request->comp_name,
            'comp_id' => $request->comp_id,
            'comp_rel' => $request->comp_rel,
         
        ]);

        session()->flash('edit','تم تعديل الشركة بنجاج');
        return redirect('/companies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , companies $govers)
    {
        $id = $request->id;
        companies::find($id)->delete();
        session()->flash('delete','تم حذف الشركة بنجاح');
        return redirect('/companies');
    }
}
