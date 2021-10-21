<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use App\Models\section;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\invoices;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AllNotification;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $section = section::all();
        $data = section::all();
        $products = products::all();
        return view('products.product',['product' => $products, 'section' =>$section ,'data'=>$data]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $val = $request->validate([
            "name" => "required",
            "section_id" => "required",
        ], [
            'name.required' => 'يرجي ادخال اسم المنتج',
            'section_id.required' => 'يرجي أختيار اسم القسم',
        ]);
        $data = new products();
        $data->name = $request->name;
        $data->desc = $request->desc;
        $data->section_id = $request->section_id;

        // $user = User::find(Auth::user()->id);
        $user = User::first();
        $offer=[
            'user' =>Auth::user()->name,
            'title' =>'تم اضافة منتج جديد بواسطة : ',
            'invoice_id' =>products::latest()->first(),
            'controller' => 'product',
        ];
        Notification::send($user, new AllNotification($offer));
        if ($data->save()) {
            Session::flash('message', 'تم حفظ المنتج بنجاح .');
            return redirect("products");
        } else {
            Session::flash('message', ' لم يتم الحفظ ');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $val = $request->validate([

            "name" => "required",
            "section_id" => "required",

        ],[

            'section_id.required' =>'يرجي ادخال اسم القسم',
            'name.required' =>'يرجي ادخال اسم المنتج',
            'name.unique' =>'اسم القسم مسجل مسبقا',

        ]);

        $update = products::find($request->id);

        $update->name = $request->name ;
        $update->desc = $request->desc ;
        $update->section_id = $request->section_id ;

    if($update->save()){
        Session::flash('message', 'تم تعديل المنتج بنجاح .');
        return redirect("products");
    }else{
        Session::flash('message', ' لم يتم التعديل ');
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete = products::find($request->id);
        if ($delete->delete()) {
            Session::flash('message', 'تم حذف المنتج بنجاح .');
            return redirect("products");
        } else {
            Session::flash('message', ' لم يتم الحذف ');
        }
    }
}
