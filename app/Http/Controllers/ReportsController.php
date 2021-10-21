<?php

namespace App\Http\Controllers;
use App\Models\invoices;
use App\Models\section;
use Illuminate\Http\Request;


class ReportsController extends Controller
{
    public function index(){
        return view('reports.invoices_report');
        }

        public function search(Request $request){
            if($request->rdio == 1){

                if ($request->type && $request->start_at == null && $request->end_at == null) {
                    $invoices = invoices::where('Status',$request->type)->get();
                    $type_search = $request->type;
                    return view('reports.invoices_report',['details'=>$invoices,'type'=>$type_search]);
                }elseif($request->type == 'الكل'){
                    $request->validate([
                        'start_at' => 'required']);

                    $start_at = date($request->start_at);
                    $end_at = date($request->end_at);
                    $invoices = invoices::whereBetween('invoice_Date',[$start_at,$end_at])->get();
                    $type_search = $request->type;
                    return view('reports.invoices_report',['details'=>$invoices,'type'=>$type_search]);
                }else{
                    $start_at = date($request->start_at);
                    $end_at = date($request->end_at);
                    $invoices = invoices::whereBetween('invoice_Date',[$start_at,$end_at])->where('Status',$request->type)->get();
                    $type_search = $request->type;
                    return view('reports.invoices_report',['details'=>$invoices,'type'=>$type_search]);
                }
            }else{

                $invoices = invoices::where('invoice_number',$request->invoice_number)->get();
                    $type_search = $request->type;
                    return view('reports.invoices_report',['details'=>$invoices,'type'=>$type_search]);
            }

        }



        public function CustomerShow(){
            $sections = section::all();
            return view('reports.customer_report',['sections'=>$sections]);
        }
        public function CustomerSearch(Request $request){
            if ($request->Section && $request->product && $request->start_at == null && $request->end_at== null) {


                $invoices = invoices::select('*')->where('section_id','=',$request->Section)->where('product','=',$request->product)->get();
                $sections = section::all();
                 return view('reports.customer_report',['sections'=>$sections ,'details'=> $invoices]);
            }else{
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);

               $invoices = invoices::whereBetween('invoice_Date',[$start_at,$end_at])->where('section_id','=',$request->Section)->where('product','=',$request->product)->get();
                $sections = section::all();
                $type = $request->Section;
                return view('reports.customer_report',['sections'=>$sections ,'details'=> $invoices,'type'=>$type]);

            }
        }
}
