<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\contracts;
use App\Models\govers;
use App\Models\finances;
use App\Models\companies;

class ContractsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contracts = contracts::all();
        $govers = govers::all();
        $finances= finances::all();
        $companies = companies::all();
        
        return view('contracts.contracts',compact('finances','companies','contracts',));
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
           
            'fin_id'=> 'required|unique:contracts|max:255',
            'cont_date'=> 'required:contracts|max:255',
            'cont_num'=> 'required:contracts|max:255',
            'finn_type'=> 'required:contracts|max:255',
            'full_amnt_cont'=> 'required:contracts|max:255',
            'cont_end_date'=> 'required:contracts|max:255',
            'excut_comp'=> 'required:contracts|max:255',
            
            
            
        ],[

            'fin_id.required' =>'يرجي ادخال اسم المشروع',
            'fin_id.unique' =>'اسم المشروع مسجل مسبقا',
            'cont_date.required' =>'يرجي ادخال  تاريخ العقد',
            'cont_num.required' =>'يرجى ادخال رقم العقد',
            'finn_type.required' =>'يرجي ادخال   نوع العملة',
            'full_amnt_cont.required' =>'يرجى ادخال الكلفة الكلية  ',
            'cont_end_date.required' =>'يرجي ادخال  تاريخ انتهاء العقد ',
            'excut_comp.required' =>'يرجى ادخال  الشركة المنفذة',
           
           

        ]);

            contracts::create([

            'fin_id'=>$request->fin_id,
            'cont_date'=>$request->cont_date,
            'cont_num'=>$request->cont_num,
            'finn_type'=>$request->finn_type,
            'full_amnt_cont'=>$request->full_amnt_cont,//نوع التمويل 
            'cont_end_date'=>$request->cont_end_date,//التبويب الحسابي
            'excut_comp'=>$request->excut_comp,
            'notes'=>$request->notes,
            'Value_Status'=>$request->Value_Status,
            'Created_by' => (Auth::user()->name),
            ]);
            session()->flash('Add', 'تم اضافة العقد بنجاح ');
            return redirect('/contracts');
 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        //
    }
}
