<?php

namespace App\Http\Controllers;
use App\Models\invoices;
use Illuminate\Http\Request;

class ArchivesController extends Controller
{
    public function index(){
        $data = invoices::onlyTrashed()->get();
        return view('invoices.archives-invoices',['data'=>$data]);
    }
    public function restore(Request $request){
        invoices::withTrashed()->where('id',$request->id)->restore();
        session()->flash('restore_invoice');
        return redirect('invoices');
    }
    public function  destroy(Request $request){
        $delete=invoices::withTrashed()->where('id',$request->id)->first();
        $delete->forceDelete();
        session()->flash('delete_invoice');
        return back();
    }

}
