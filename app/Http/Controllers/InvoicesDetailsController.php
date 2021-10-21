<?php

namespace App\Http\Controllers;

use App\Models\invoices_details;
use App\Models\invoice_attachments;
use App\Models\invoices;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;


class InvoicesDetailsController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function viewFile($invoice_number, $file_name)
    {
        $files = Storage::disk('file_invoices')->getDriver()->getAdapter()->applyPathPrefix($invoice_number . '/' . $file_name);
        return response()->file($files);
    }
    public function download($invoice_number, $file_name)
    {
        $files = Storage::disk('file_invoices')->getDriver()->getAdapter()->applyPathPrefix($invoice_number . '/' . $file_name);
        return response()->download($files);
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
        $this->validate($request, [

            'file' => 'mimes:pdf,jpeg,png,jpg',

            ], [
                'file.mimes' => 'صيغة المرفق يجب ان تكون   pdf, jpeg , png , jpg',
            ]);
        $attachments = new invoice_attachments();
        $attachments->invoice_number  = $request->invoices_number;
        $attachments->Created_by      = Auth::user()->name;
        $attachments->invoice_id      = $request->id;
        $attachments->file_name = $imageName = $request->file->getClientOriginalName();
        $request->file->move(public_path('assets/invoices/'. $request->invoices_number), $imageName);
        if($attachments->save()){
            Session::flash('message', 'تم اضافة مرفق بنجاح .');
            return back();
        }else{
            Session::flash('message', ' لم يتم الحفظ ');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $invoices = invoices::where('id', $id)->first();
        $details = invoices_details::where('id_Invoice', $id)->get();
        $attachments = invoice_attachments::where('invoice_id', $id)->get();
        return view('invoices.invoices_details', ['invoices' => $invoices, 'details' => $details, 'attachments' => $attachments]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $delete = invoice_attachments::find($request->id);
        if ($delete->delete()) {
            Storage::disk('file_invoices')->delete($request->invoice_number.'/'.$request->file_name);
            Session::flash('message', 'تم حذف المرفق بنجاح.');
            return back();
        } else {
            Session::flash('message', ' لم يتم الحذف ');
        }
    }
}
