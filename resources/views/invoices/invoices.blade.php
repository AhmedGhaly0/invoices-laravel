@extends('layouts.master')
@section('title')
  قائمة الفواتير - مساهم
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                    الفواتير</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
@if (Session::has('message'))
<div class="alert alert-success alert-dismissible ml-2 text-center sewthidden" style="width:95%;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-check"></i> تم  </h5>
    {{ Session::get('message') }}
</div>
@endif


    @if (session()->has('delete_invoice'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم حذف الفاتورة بنجاح",
                    type: "success"
                })
            }
        </script>
    @endif


    @if (session()->has('update_invoice'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم تحديث حالة الدفع بنجاح",
                    type: "success"
                })
            }
        </script>
    @endif

    @if (session()->has('transfer_invoice'))
    <script>
        window.onload = function() {
            notif({
                msg: "تم أرشفة الفاتورة بنجاح",
                type: "success"
            })
        }
    </script>
@endif

    @if (session()->has('restore_invoice'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم استعادة الفاتورة بنجاح",
                    type: "success"
                })
            }
        </script>
    @endif


    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="row">
                        @can('اضافة فاتورة')
                        <a href="invoices/create-invoices" class="btn btn-success-gradient pl-5 pr-5 ml-1"><i class="fas fa-plus"></i> &nbsp;أضافة فاتورة</a>

                        @endcan
                        @can('تصدير EXCEL')
                        <a class=" btn btn-primary-gradient" href="{{ url('Invoices/export-invoice') }}"
                        style="color:white"><i class="far fa-file-excel"></i> &nbsp;تصدير EXCEL </a>
                        @endcan

                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='10'style="text-align: center">
                            <thead>
                                <tr>

                                    <th class="border-bottom-0 border-star ">#</th>
                                    <th class="border-bottom-0 border-star">رقم الفاتورة</th>
                                    <th class="border-bottom-0 border-star">تاريخ القاتورة</th>
                                    <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                    <th class="border-bottom-0">المنتج</th>
                                    <th class="border-bottom-0">القسم</th>
                                    <th class="border-bottom-0">الخصم</th>
                                    <th class="border-bottom-0">نسبة الضريبة</th>
                                    <th class="border-bottom-0">قيمة الضريبة</th>
                                    <th class="border-bottom-0">الاجمالي</th>
                                    <th class="border-bottom-0">الحالة</th>
                                    <th class="border-bottom-0">ملاحظات</th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 0;
                                @endphp
                                @foreach ($data as $invoice)
                                    @php
                                    $i++
                                    @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                            <a style="position: relative;" class="border-bottom border-primary" title="{{ $invoice->invoice_number }} عرض تفاصيل الفاتورة" href="invoices/invoices-details/{{ $invoice->id }}">{{ $invoice->invoice_number }}</a>
                                        </td>
                                        <td>{{ $invoice->invoice_Date }}</td>
                                        <td>{{ $invoice->Due_date }}</td>
                                        <td>{{ $invoice->product }}</td>
                                        <td>
                                            {{ $invoice->section->name }}
                                        </td>
                                        {{-- <a href="{{ url('InvoicesDetails') }}/{{ $invoice->id }}">{{ $invoice->section->name }}</a> --}}
                                        <td>{{ $invoice->Discount }}</td>
                                        <td>{{ $invoice->Rate_VAT }}</td>
                                        <td>{{ $invoice->Value_VAT }}</td>
                                        <td>{{ $invoice->Total }}</td>
                                        <td class="  p-0 fs-6">
                                            @if ($invoice->Value_Status == 1)
                                                <span class="badge badge-pill badge-success">{{ $invoice->Status }}</span>
                                            @elseif($invoice->Value_Status == 2)
                                                <span class="badge badge-pill badge-warning">{{ $invoice->Status }}</span>
                                            @else
                                                <span class="badge  badge-danger">{{ $invoice->Status }}</span>
                                            @endif

                                        </td>

                                        <td>{{ $invoice->note }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu  tx-13" title=" فاتورة رقم {{$invoice->invoice_number}} ">
                                                            @can('تعديل الفاتورة')
                                                            <a class="dropdown-item "
                                                            href="invoices/edit-invoice/{{ $invoice->id }}"><i class="fas fa-cog  text-primary"></i>  تعديل
                                                            الفاتورة</a>
                                                            @endcan


                                                            @can('حذف الفاتورة')
                                                            <a class="dropdown-item" href="#" data-id="{{ $invoice->id}}"
                                                                data-toggle="modal" data-target="#delete_invoice"><i
                                                                    class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                                الفاتورة</a>
                                                            @endcan



                                                                @can('تغير حالة الدفع')
                                                                <a class="dropdown-item" href="invoices/status_show/{{$invoice->id}}" >
                                                                    <i class=" text-success fas fa-money-bill"></i>&nbsp;&nbsp;تغير
                                                                    حالة
                                                                    الدفع</a>
                                                                @endcan




                                                                    @can('ارشفة الفاتورة')
                                                                    <a class="dropdown-item" href="#" data-id="{{ $invoice->id }}"
                                                                        data-toggle="modal" data-target="#Transfer_invoice"><i
                                                                            class="text-warning fas fa-exchange-alt"></i>&nbsp;&nbsp;نقل الي
                                                                        الارشيف</a>

                                                                    @endcan


                                                                        @can( 'طباعةالفاتورة')
                                                                        <a class="dropdown-item" href="invoices/Print-invoice/{{ $invoice->id }}"><i
                                                                            class="text-success fas fa-print"></i>&nbsp;&nbsp;طباعة
                                                                        الفاتورة
                                                                    </a>
                                                                        @endcan


                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>

    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    {{-- invoice.delete --}}
    <div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف الفاتورة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <form action="{{Route('invoice.delete')}}" method="post">

                    @csrf
            </div>
            <div class="modal-body">
                هل انت متاكد من عملية الحذف ؟
                <input type="hidden" name="id" id="id" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                <button type="submit" class="btn btn-danger">تاكيد</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- Transfer_invoice --}}
<div class="modal fade" id="Transfer_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">أرشفة الفاتورة</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

            <form action="{{Route('invoice.delete')}}" method="post">

                @csrf
        </div>
        <div class="modal-body">
            هل انت متاكد من أرشفة الفاتورة ؟
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="transfer" id="Transfer" value="2">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
            <button type="submit" class="btn btn-success">تاكيد</button>
        </div>
        </form>
    </div>
</div>
</div>

    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

    <script>
        $('#delete_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
        })
    </script>

    <script>
        $('#Transfer_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
        })
    </script>



<script>
    $(document).ready(function() {
        $(".sewthidden").delay(5000).fadeOut();
    });
</script>



@endsection
