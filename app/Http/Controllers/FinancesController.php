<?php

namespace App\Http\Controllers;
use App\Models\govers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\finances;

class FinancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $govers = govers::all();
        $finances= finances::all();
        
        return view('finances.finances',compact('govers','finances'));
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
           
            'proj_name'=> 'required|unique:finances|max:255',
            'benifit_comp_id'=> 'required:finances|max:255',
            'assig_year'=> 'required:finances|max:255',
            'proj_cost'=> 'required:finances|max:255',
            'fina_type'=> 'required:finances|max:255',
            'fina_classfic'=> 'required:finances|max:255',
            'fina_amnt_loc'=> 'required:finances|max:255',
            'fina_amnt_for'=> 'required:finances|max:255',
            
            
        ],[

            'proj_name.required' =>'يرجي ادخال اسم المشروع',
            'proj_name.unique' =>'اسم المشروع مسجل مسبقا',
            'benifit_comp_id.required' =>'يرجي ادخال الجهة المستفيدة',
            'assig_year.required' =>'يرجى ادخال سنة التخصيص',
            'proj_cost.required' =>'يرجي ادخال  تكلفة المشروع',
            'fina_type.required' =>'يرجى ادخال نوع التمويل ',
            'fina_classfic.required' =>'يرجي ادخال  التبويب الحسابي',
            'fina_amnt_loc.required' =>'يرجى ادخال تخصيص التبويب المحلي',
            'fina_amnt_for.required' =>'يرجى ادخال خصيص التبويب الاجنبي   '
           

        ]);

            finances::create([

            'proj_name'=>$request->proj_name,
            'benifit_comp_id'=>$request->benifit_comp_id,
            'assig_year'=>$request->assig_year,
            'proj_cost'=>$request->proj_cost,
            'fina_type'=>$request->fina_type,//نوع التمويل 
            'fina_classfic'=>$request->fina_classfic,//التبويب الحسابي
            'fina_amnt_loc'=>$request->fina_amnt_loc,
            'fina_amnt_for'=>$request->fina_amnt_for,
            'notes'=>$request->notes,
            'Value_Status'=>$request->Value_Status,
            'Created_by' => (Auth::user()->name),
            ]);
            session()->flash('Add', 'تم اضافة المشروع بنجاح ');
            return redirect('/finances');
 
    }


    /**
     * Display the specified resource.
     *
     * 
     * 




     
     * @param  \App\Models\finances  $finances
     * @return \Illuminate\Http\Response
     */
    public function show(finances $finances)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\finances  $finances
     * @return \Illuminate\Http\Response
     */
    public function edit(finances $finances)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\finances  $finances
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, finances $finances)
    {
        $cid = $request->id;

        $validatedData = $request->validate([
           
            'proj_name'=> 'required:finances|max:255',
            'benifit_comp_id'=> 'required:finances|max:255',
            'assig_year'=> 'required:finances|max:255',
            'proj_cost'=> 'required:finances|max:255',
            'fina_type'=> 'required:finances|max:255',
            'fina_classfic'=> 'required:finances|max:255',
            'fina_amnt_loc'=> 'required:finances|max:255',
            'fina_amnt_for'=> 'required:finances|max:255',
            
            
        ],[

            'proj_name.required' =>'يرجي ادخال اسم المشروع',
            // 'proj_name.unique' =>'اسم المشروع مسجل مسبقا',
            'benifit_comp_id.required' =>'يرجي ادخال الجهة المستفيدة',
            'assig_year.required' =>'يرجى ادخال سنة التخصيص',
            'proj_cost.required' =>'يرجي ادخال  تكلفة المشروع',
            'fina_type.required' =>'يرجى ادخال نوع التمويل ',
            'fina_classfic.required' =>'يرجي ادخال  التبويب الحسابي',
            'fina_amnt_loc.required' =>'يرجى ادخال تخصيص التبويب المحلي',
            'fina_amnt_for.required' =>'يرجى ادخال خصيص التبويب الاجنبي   '
           

        ]);
     
        $update = finances::find($cid)->update([
            'proj_name'=>$request->proj_name,
            'benifit_comp_id'=>$request->benifit_comp_id,
            'assig_year'=>$request->assig_year,
            'proj_cost'=>$request->proj_cost,
            'fina_type'=>$request->fina_type,//نوع التمويل 
            'fina_classfic'=>$request->fina_classfic,//التبويب الحسابي
            'fina_amnt_loc'=>$request->fina_amnt_loc,
            'fina_amnt_for'=>$request->fina_amnt_for,
            'notes'=>$request->notes,
            'Value_Status'=>$request->Value_Status,
            'Created_by' => (Auth::user()->name),
        ]);
       
        session()->flash('edit','تم تعديل المشروع بنجاج');
        return redirect('/finances');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\finances  $finances
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , finances $finances)
    {
       
        $id = $request->id;
        finances::find($id)->delete();
        session()->flash('delete','تم حذف المشروع بنجاح');
        return redirect('/finances');
    }
}
