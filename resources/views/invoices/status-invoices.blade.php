@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title', 'تغير حالة الدفع- مساهم')

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <a class="content-title mb-0 my-auto"
                               href="/invoices">قائمة الفواتير</a><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                                تغير حالة الدفع فاتورة رقـم <h6 class="text-warning d-inline">{{ $invoices->invoice_number }}</h6></span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    @if (Session::has('message'))

    <div class="alert alert-success alert-dismissible ml-2 text-center sewthidden" style="width:95%;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> تم  </h5>
        {{ Session::get('message') }}<br>
        <a class="content-title mb-0 my-auto"
        href="/invoices"> رجوع لقائمة الفواتير  <i class="fas fa-arrow-alt-circle-left"></i>   </a>
    </div>

    @endif
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{Route('status.update')}}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        {{-- 1 --}}
                        <input type="hidden"  name="id" value="{{$invoices->id}}">
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">رقم الفاتورة</label>
                                <input type="text" class="form-control" id="inputName" name="invoice_number" readonly value="{{$invoices->invoice_number}}">

                            </div>

                            <div class="col">
                                <label>تاريخ الفاتورة</label>
                                <input class="form-control fc-datepicker" name="invoice_Date"
                                    type="text" readonly value="{{ $invoices->invoice_Date }}">

                            </div>

                            <div class="col">
                                <label>تاريخ الاستحقاق</label>
                                <input class="form-control fc-datepicker" name="Due_date" readonly placeholder="YYYY-MM-DD"
                                value="{{ $invoices->Due_date }}"
                                    type="text">

                            </div>

                        </div>

                        {{-- 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">القسم</label>
                                <select id="Section" name="Section" class="form-control " readonly>
                                    <!--placeholder-->
                                    <option value="{{ $invoices->section->id }}"   class="text-info"> {{ $invoices->section->name }}</option>

                                </select>

                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">المنتج</label>
                                <select id="product" name="product" class="form-control" readonly>
                                    <option  value="{{ $invoices->product }}"   >{{ $invoices->product }}</option>


                                </select>

                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">مبلغ التحصيل</label>
                                <input type="text" class="form-control" id="inputName" name="Amount_collection" readonly value="{{$invoices->Amount_collection}}">

                            </div>

                        </div>


                        {{-- 3 --}}

                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label">مبلغ العمولة</label>
                                <input type="text" class="form-control form-control-lg" id="Amount_Commission" readonly
                                    name="Amount_Commission" title="يرجي ادخال مبلغ العمولة "  value="{{$invoices->Amount_Commission}}">

                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">الخصم</label>
                                <input type="text" class="form-control form-control-lg" id="Discount" name="Discount" readonly
                                    title="يرجي ادخال مبلغ الخصم "  value="{{$invoices->Discount}}">

                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">نسبة ضريبة القيمة المضافة</label>
                                <select name="Rate_VAT" id="Rate_VAT" class="form-control"  readonly>
                                    <!--placeholder-->
                                    <option  value="{{$invoices->Rate_VAT}}">{{$invoices->Rate_VAT}}</option>
                                    <option value=" 5%">5%</option>
                                </select>

                            </div>

                        </div>

                        {{-- 4 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                                <input type="text" class="form-control" id="Value_VAT" name="Value_VAT" readonly  value="{{$invoices->Value_VAT}}">
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">الاجمالي شامل الضريبة</label>
                                <input type="text" class="form-control" id="Total" name="Total" readonly  value="{{$invoices->Total}}">
                            </div>
                        </div>

                        {{-- 5 --}}
                        <div class="row mb-4">
                            <div class="col">
                                <label for="exampleTextarea">ملاحظات</label>
                                <textarea class="form-control "  id="exampleTextarea" readonly name="note" rows="3">{{$invoices->note}}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">حالة الدفع</label>
                                <select class="form-control " id="status"  name="status" required >
                                    <option selected="true" readonly="readonly" disabled  >-- حدد حالة الدفع --</option>
                                    <option value="مدفوعة">مدفوعة</option>
                                    <option  value="مدفوعة جزئيا">مدفوعة جزئيا</option>

                                </select>


                            </div>


                            <div class="col hide_many" style="display:none">
                                <label for="inputName" class="control-label">مبلغ التحصيل</label>
                                <input type="text" class="form-control many" id="many" name="many"  onclick="myFunction()">
                            </div>


                            <div class="col">
                                <label>تاريخ الدفع</label>
                                <input class="form-control fc-datepicker" name="payment_Date" placeholder="YYYY-MM-DD"
                                    type="text" required>
                            </div>
                        </div>
                        <div class="col hide_many" style="display:none">
                            <label for="inputName" class="control-label">الاجمالي</label>
                            <input type="text" class="form-control" id="rest_amount" name="rest_amount" readonly  value="">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success-gradient pl-5 pr-5 mb-4"> تحديث حالة الدفع </button>
                    </div>

                </div>





                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script> --}}

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>


    <script>
        $(document).ready(function() {
            $('select[name="Section"]').on('change', function() {
                var SectionId = $(this).val();
                // console.log('change in select'+ SectionId);
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('invoices') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        StatusCode: true,
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $.each(data.products, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
    <script>
        function myFunction() {
            var Total = parseFloat(document.getElementById("Total").value);
            var Many = parseFloat(document.getElementById("many").value);

            if (typeof Many === 'undefined' ) {
                alert(' يرجي ادخال مبلغ التحصيل ');
            } else {
                var intResults =   Total -Many;


                sumq = parseFloat(intResults).toFixed(2);
                document.getElementById("rest_amount").value = sumq;


            }
        }

    </script>

<script>
    $(function(){

        $("#status").change(function(){
            var status_val = $(this).val();
            if(status_val == 'مدفوعة جزئيا'){
                console.log(status_val);
        $(".hide_many").show();

            }else{
                console.log(status_val + "ERROR");
                $(".hide_many").hide();

            }
        });


        $(".hide_many").hide();





            $(".sewthidden").delay(7000).fadeOut();
        });
    </script>

@endsection
