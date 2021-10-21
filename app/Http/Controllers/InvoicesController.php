<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use App\Models\invoices;
use App\Models\invoice_attachments;
use App\Models\invoices_details;
use App\Models\section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AllNotification;



class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware("auth");
    }

    public function index()
    {
        $invoices = invoices::all();
        return view("invoices.invoices",['data'=>$invoices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data = section::all();
        return view("invoices.add-invoices",['invoices'=>$data]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'file' => 'mimes:pdf,jpeg,png,jpg',
            "invoice_number" => "required",
            "invoice_Date" => "required",
            "Due_date" => "required",
            "Section" => "required",
            "product" => "required",
            "Amount_collection" => "required",
            "Amount_Commission" => "required",
            "Discount" => "required",
            "Rate_VAT" => "required",
            "Value_VAT" => "required",
            "Total" => "required",
        ], [
            'file.mimes' => 'صيغة المرفق يجب ان تكون   pdf, jpeg , png , jpg',
            'required' => 'يرجي ادخال  قيمة في الحقل',
        ]);
        // Save Data In invoices
        $invoices = new invoices();
        $invoices->invoice_number	 = $request->invoice_number;
        $invoices->invoice_Date      = $request->invoice_Date;
        $invoices->Due_date          = $request->Due_date;
        $invoices->product           = $request->product;
        $invoices->section_id        = $request->Section;
        $invoices->Amount_collection = $request->Amount_collection;
        $invoices->Amount_Commission = $request->Amount_Commission;
        $invoices->Discount          = $request->Discount;
        $invoices->Value_VAT         = $request->Value_VAT;
        $invoices->Rate_VAT          = $request->Rate_VAT;
        $invoices->Total             = $request->Total;
        $invoices->Status            = "غير مدفوعه";
        $invoices->Value_Status      = "3";
        $invoices->note              = $request->note;
        $invoices->save();
// Save Data In invoices_details
        $invoice_id = invoices::latest()->first()->id;
        $details = new invoices_details();
        $details->id_Invoice      = $invoice_id;
        $details->invoice_number  = $request->invoice_number;
        $details->product         = $request-> product;
        $details->Section         = $request->Section;
        $details->Status          = "غير مدفوعه";
        $details->Value_Status    = "3";
        $details->note            = $request->note;
        $details->user            = Auth::user()->name;
        $details->save();
        // Save Data In invoice_attachments
        $invoice_id = invoices::latest()->first()->id;
        $attachments = new invoice_attachments();
        $attachments->invoice_number  = $request->invoice_number;
        $attachments->Created_by      = Auth::user()->name;
        $attachments->invoice_id      = $invoice_id;
        if(!empty($request->file)){
        $imageName = time() . '.' . $request->file('file')->getClientOriginalExtension();
        $attachments->file_name = $imageName;
        $request->file->move(public_path('assets/invoices/'. $request->invoice_number), $imageName);
        }

        $attachments->save();


        $user = User::first();
        $offer=[
            'user' =>Auth::user()->name,
            'title' =>'تم اضافة فاتورة جديدة بواسطة : ',
            'invoice_id' =>invoices::latest()->first()->id,
            'controller' => 'invoices',
        ];
        Notification::send($user, new AllNotification($offer));

        if($attachments->save()){
            Session::flash('message', 'تم حفظ  الفاتورة بنجاح .');
            return redirect("invoices");
        }else{
            Session::flash('message', ' لم يتم الحفظ ');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoices = invoices::where('id', $id)->first();

        return view('invoices.status-invoices',['invoices'=>$invoices]);
    }

    public function status_update(Request $request){


        if($request->status == "مدفوعة"){
            $invoices = invoices::find($request->id);
            $invoices->invoice_number	 = $request->invoice_number;
            $invoices->invoice_Date      = $request->invoice_Date;
            $invoices->Due_date          = $request->Due_date;
            $invoices->product           = $request->product;
            $invoices->section_id        = $request->Section;
            $invoices->Amount_collection = $request->Amount_collection;
            $invoices->Amount_Commission = $request->Amount_Commission;
            $invoices->Discount          = $request->Discount;
            $invoices->Value_VAT         = $request->Value_VAT;
            $invoices->Rate_VAT          = $request->Rate_VAT;
            $invoices->Total             = $request->Total;
            $invoices->Status            = $request->status;
            $invoices->Value_Status      = 1;
            $invoices->Payment_Date      = $request->payment_Date;
            $invoices->note              = $request->note;
            $invoices->save();

        $details = new invoices_details();
        $details->id_Invoice      = $request->id;
        $details->invoice_number  = $request->invoice_number;
        $details->product         = $request-> product;
        $details->Section         = $request->Section;
        $details->Status         = $request->status;
        $details->Value_Status   = 1;
        $details->Payment_Date   = $request->payment_Date;
        $details->note            = $request->note;
        $details->user            = Auth::user()->name;
        $details->save();
        session()->flash('update_invoice');
        return redirect('invoices');

        }else{
           $Total = $request->Total ."-".$request->many ."=" .$request->rest_amount;
            invoices::where('id',$request->id)
            ->update([
            'Value_Status' => 2,
            'Status' => $request->status,
            'Payment_Date' => $request->payment_Date,
            'Total' => $request->rest_amount,
            ]);


            $details = new invoices_details();
            $details->id_Invoice      = $request->id;
            $details->invoice_number  = $request->invoice_number;
            $details->product         = $request-> product;
            $details->Section         = $request->Section;
            $details->Status         = $request->status;
            $details->Value_Status   = 2;
            $details->Payment_Date   = $request->payment_Date;
            $details->note            = $request->note;
            $details->user            = Auth::user()->name;
            $details->save();
            session()->flash('update_invoice');
            return redirect('invoices');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoices = invoices::where('id', $id)->first();
        $section = section::all();
      return view('invoices.edit-invoices',['invoices'=>$invoices,'section'=>$section]);
    //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $request->validate([

            "invoice_number" => "required",
            "invoice_Date" => "required",
            "Due_date" => "required",
            "Section" => "required",
            "product" => "required",
            "Amount_collection" => "required",
            "Amount_Commission" => "required",
            "Discount" => "required",
            "Rate_VAT" => "required",
            "Value_VAT" => "required",
            "Total" => "required",
        ], [

            'required' => 'يرجي ادخال  قيمة في الحقل',
        ]);
        $invoices = invoices::find($request->id);
        $invoices->invoice_number	 = $request->invoice_number;
        $invoices->invoice_Date      = $request->invoice_Date;
        $invoices->Due_date          = $request->Due_date;
        $invoices->product           = $request->product;
        $invoices->section_id        = $request->Section;
        $invoices->Amount_collection = $request->Amount_collection;
        $invoices->Amount_Commission = $request->Amount_Commission;
        $invoices->Discount          = $request->Discount;
        $invoices->Value_VAT         = $request->Value_VAT;
        $invoices->Rate_VAT          = $request->Rate_VAT;
        $invoices->Total             = $request->Total;
        $invoices->note              = $request->note;
        $invoices->save();

        // invoices_details
    $update_table= [
        "invoice_number"  => $request->invoice_number,
        "product"         => $request-> product,
        "Section"         => $request->Section,
        "note"            => $request->note,
        "user"            => Auth::user()->name,
    ];
        $details=invoices_details::where("id_Invoice",$request->id)->update($update_table);
        $invoice = invoices_details::where("id_Invoice",$request->id)->first();
        $invoice_id = $invoice->id;
        // $user = User::find(Auth::user()->id);
        $user = User::first();
        $offer=[
            'user' =>Auth::user()->name,
            'title' =>'تم تعديل الفاتورة بواسطة : ',
            'invoice_id' =>$invoice_id,
            'controller' => 'update',
        ];
        Notification::send($user, new AllNotification($offer));
        if($details == true){
            Session::flash('message', 'تم تعديل  الفاتورة بنجاح .');
            return redirect("invoices");
       }else{
            Session::flash('message', ' لم يتم تعديل الفاتورة');
       }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $invoices= invoices::where('id',$request->id)->first();
        $attachment= invoice_attachments::where('invoice_id',$request->id)->first();

            if ($request->transfer==2) {
                $invoices->Delete();
                session()->flash('transfer_invoice');
                return back();

            }else{
            if (!empty($attachment->invoice_number)) {

             Storage::disk('file_invoices')->deleteDirectory($attachment->invoice_number);
         }
        $invoices->forceDelete();
        session()->flash('delete_invoice');
        return back();
        }
    }

    public function paid(){
        $invoices=invoices::where('Value_Status',1)->get();
        return view("invoices.paid-invoices",['data'=>$invoices]);
    }
    public function unpaid(){
        $invoices=invoices::where('Value_Status',3)->get();
        return view("invoices.unpaid-invoices",['data'=>$invoices]);
    }
    public function Partial(){
        $invoices=invoices::where('Value_Status',2)->get();
        return view("invoices.Partial-invoices",['data'=>$invoices]);
    }


    public function Print_invoice($id)
    {
        $invoices = invoices::where('id', $id)->first();
        return view('invoices.print-invoice',['invoices'=>$invoices]);
    }


    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("name", "id");
        return response()->json([
            'status'=>true,
            'products'=>$products,
        ]);
    }

    public function export()
    {

        return Excel::download(new InvoicesExport, 'invoice.xlsx');
    }
    public function read_notify(Request $request){

        $notification = auth()->user()->notifications()->where('id', $request->id)->first();

        if ($notification) {
            $notification->markAsRead();
        }
    }
    public function raedAt_All(){
        $userUnreadNotification= auth()->user()->unreadNotifications;

        if($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
        }
    }

    public function deleteNotification(Request $request){

        DB::table("notifications")->where("id", $request->id)->delete();
        return response()->json([
           'status' => true,
           'id' => $request->id
        ]);
    }


}
