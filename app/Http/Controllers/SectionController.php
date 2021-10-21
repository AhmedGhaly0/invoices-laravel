<?php

namespace App\Http\Controllers;

use App\Models\section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AllNotification;



class SectionController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = section::all();
        return view('section.section',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.

     */
    public function store(Request $request)
    {

        $val = $request->validate([

            "name" => "required|unique:sections",


        ],[

            'name.required' =>'يرجي ادخال اسم القسم',
            'name.unique' =>'اسم القسم مسجل مسبقا',
        ]);
        // dd($request);

        $data = new section();
        $data->name = $request->name;
        $data->desc = $request->desc;
        $data->created_by = Auth::user()->name;


        // $user = User::find(Auth::user()->id);
        $user = User::first();

        $offer=[
            'user' =>Auth::user()->name,
            'title' =>'تم اضافة قسم جديد بواسطة : ',
            'section_id' =>section::latest()->first(),
            'controller' => 'section',
        ];

        Notification::send($user, new AllNotification($offer));

        if($data->save()){
            Session::flash('message', 'تم الحفظ بنجاح .');
            return redirect("section");
        }else{
            Session::flash('message', ' لم يتم الحفظ ');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $val = $request->validate([

            "name" => "required",

        ],[

            'name.required' =>'يرجي ادخال اسم القسم',
            'name.unique' =>'اسم القسم مسجل مسبقا',
        ]);

        $update = section::find($request->id);

        $update->name = $request->name ;
        $update->desc = $request->desc ;
        Auth::user()->name = $request->created_by ;

        if($update->save()){
            Session::flash('message', 'تم تعديل القسم بنجاح .');
            return redirect("section");
        }else{
            Session::flash('message', ' لم يتم التعديل ');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $delete = section::find($request->id);
        if($delete->delete()){
            Session::flash('message', 'تم حذف القسم بنجاح .');
            return redirect("section");
        }else{
            Session::flash('message', ' لم يتم الحذف ');
        }
    }

}
