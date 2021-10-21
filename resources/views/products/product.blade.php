@extends('layouts.master')
@section('title', 'المنتجات - مساهم')
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
    <script src="http://127.0.0.1:8000/assets/plugins/ionicons/ionicons/ionicons.suuqn5vt.js" type="module"
        crossorigin="true" data-resources-url="http://127.0.0.1:8000/assets/plugins/ionicons/ionicons/"
        data-namespace="ionicons"></script>
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">ألأعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    المنتجات</span>
            </div>
        </div>

    </div>
    <!-- ERROR  -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible ml-5 text-center sewthidden" style="width:99%;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5 class="text-center"><i class="icon fas fa-ban"></i> ERROR!</h5>
            @foreach ($errors->all() as $error)
                <li class="text-center" style="list-style:none; "><i
                        class="fas fa-exclamation-triangle ml-1"></i>{{ $error }}</li>
            @endforeach
        </div>
    @endif


    @if (Session::has('message'))

        <div class="alert alert-success alert-dismissible ml-2 text-center sewthidden" style="width:95%;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Done </h5>
            {{ Session::get('message') }}
        </div>
    @endif
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">


                   @can('اضافة منتج')
                   <div class="col-sm-4 col-md-3 col-xl-2">
                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                        data-toggle="modal" href="#add_product">أضافة منتج</a>
                </div>
                   @endcan



                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='10'
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0"> أسم المنتج </th>
                                    <th class="border-bottom-0"> أسم القسم </th>
                                    <th class="border-bottom-0"> الوصف </th>
                                    <th class="border-bottom-0"> العمليات </th>


                                </tr>
                            </thead>
                            <tbody>

                                <?php $i = 0; ?>

                                @foreach ($product as $product)

                                    <?php $i++; ?>


                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->section->name }}</td>
                                        <td>{{ $product->desc }}</td>
                                        <td>
                                          @can('تعديل منتج')
                                          <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                          data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                          data-desc="{{ $product->desc }}" data-toggle="modal" href="#edit_product"
                                          title="تعديل"> <i class="las la-pen"></i> تعديل </a>
                                          @endcan

                                          @can('حذف منتج')
                                          <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                          data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                          data-toggle="modal" href="#delete_product" title="حذف"><i
                                              class="las la-trash"></i> حذف </a>
                                          @endcan
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
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
    <div class="modal" id="add_product">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">أضافة منتج </h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('add.product') }}" method="post">
                        @csrf
                        <div class="">
                            <div class="form-group has-danger mg-b-0">
                                <h4>أسم المنتج <span class="text-danger"> * </span></h4>
                                <input class="form-control mb-3" name="name" placeholder="أكتب هنا" type="text">
                                <h4> أختر أسم القسم <span class="text-danger"> * </span></h4>

                                <select name="section_id" class="form-control SlectBox mb-3 " tabindex="-1"
                                    placeholder="أسم القسم">
                                    <!--placeholder-->
                                    <option value="2" Disabled selected> ألاقسام </option>
                                    @foreach ($section as $section)
                                        <option title="أختر أسم ألقسم  " value="{{ $section->id }}">{{ $section['name'] }}</option>
                                    @endforeach
                                </select>
                                <h4>الوصف <span class="text-danger"> * </span></h4>
                                <textarea class="form-control mg-t-20" name="desc" placeholder="أكتب هنا"
                                    rows="3"></textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" type="submit">تأكيد </button>
                    </form>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">ألغاء</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Edit -->
    <div class="modal" id="edit_product">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">تعديل المنتج </h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">


                    <form action="{{ route('update.product') }}" method="post">
                        @csrf
                        <div class="">
                            <input type="hidden" name="id" id="id" value="">
                            <div class="form-group has-danger mg-b-0">
                                <h4>أسم المنتج <span class="text-danger"> * </span> </h4>
                                <input class="form-control mb-3" name="name" id="name" placeholder="أكتب هنا" type="text"
                                    value="">

                                    <h4> أختر أسم القسم <span class="text-danger"> * </span></h4>

                                    <select name="section_id" class="form-control SlectBox mb-3 " tabindex="-1"
                                        placeholder="أسم القسم">
                                        <!--placeholder-->
                                        <option Disabled selected> ألاقسام </option>
                                        @foreach ($data as $data)
                                        <option value=" {{ $data->id }} ">{{ $data['name'] }}</option>
                                    @endforeach
                                    </select>
                                <h4>الوصف <span class="text-danger"> * </span> </h4>
                                <textarea class="form-control mg-t-20" name="desc" id="desc" placeholder="أكتب هنا"
                                    rows="3"></textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-success" type="submit">  حفظ التغيرات </button>
                    </form>

                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">ألغاء </button>
                </div>
            </div>
        </div>
    </div>
    <!-- delete -->
    <div class="modal" id="delete_product">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف المنتج</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="products/delete" method="post">

                    @csrf
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="name" id="name" type="text" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger"> حذف</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <!-- main-content closed -->
@endsection
@section('js')

    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
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
    <script src="http://127.0.0.1:8000/assets/js/modal.js"></script>
    <script src="http://127.0.0.1:8000/assets/js/form-elements.js"></script>
    <script src="{{ URL::asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>
    <!-- Sweet-alert js  -->
    <script src="{{ URL::asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/sweet-alert.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>


    <script>
        $('#edit_product').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var desc = button.data('desc')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #desc').val(desc);
        });
    </script>
    <script>
        $('#delete_product').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
        })
    </script>


    <script>
        $(document).ready(function() {
            $(".sewthidden").delay(5000).fadeOut();
        });
    </script>




@endsection
