@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
<!---Internal Fancy uploader css-->
<link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

@section('title')
تعديل مستخدم - مـساهم
@stop


@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل
                مستخدم</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>خطا</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}">رجوع</a>
                    </div>
                </div><br>
           


                {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id], 'files' => true,'enctype'=>'multipart/form-data'])  !!}
                <div class="">
                     <div class="row position-relative mb-3 mr-3">
                <img alt="user" class="avatar avatar-xxl brround mb-2 "  src="{{URL::asset('assets/avatar/'.  $user->Avatar)}}"><span class="avatar-status profile-status bg-green"></span>
 {{-- <p class="text-danger">* صيغة الصورة , jpeg ,.jpg , png </p> --}}
                {{-- <h5 class="card-title">تغير صورة المستخدم  </h5> --}}
                    <div class="avatar avatar-md position-absolute " title="تغير صورة المستخدم " style=" cursor: pointer; background: rgba(0,0,0,.5); top:65px; right:-17px; ">
                        <i class="fas fa-camera position-absolute "></i>
                        <input type="file" name="Avatar" class="" style="width:100%; color: rgba(0,0,0,.5); opacity: 0; cursor: pointer;" />
                     </div>
                </div>

                    <div class="row mg-b-20">
                        <div class="parsley-input col-md-6" id="fnWrapper">
                            <label>اسم المستخدم: <span class="tx-danger">*</span></label>
                            {!! Form::text('name', null, array('class' => 'form-control','required')) !!}
                        </div>

                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>البريد الالكتروني: <span class="tx-danger">*</span></label>
                            {!! Form::text('email', null, array('class' => 'form-control','required')) !!}
                        </div>
                    </div>

                </div>
                 <a class="btn btn-primary " href="#"  data-toggle="modal" data-target="#delete_invoice">
                 &nbsp;&nbsp; تغيــر كلمة الـسر </a>

                {{-- <div class="row mg-b-20">
                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                        <label>كلمة المرور: <span class="tx-danger">*</span></label>

                        {!! Form::password('password', array('class' => 'form-control','required')) !!}
                    </div>

                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                        <label> تاكيد كلمة المرور: <span class="tx-danger">*</span></label>
                        {!! Form::password('confirm-password', array('class' => 'form-control','required')) !!}
                    </div>
                </div> --}}

               
            </div>
                <div class="row mr-2 mg-b-20">
                    <div class="col-lg-6">
                        <label class="form-label">حالة المستخدم</label>
                        <select name="Status" id="select-beast" class="form-control  nice-select  custom-select">
                            <option value="{{ $user->Status}}">{{ $user->Status}}</option>
                            <option value="مفعل">مفعل</option>
                            <option value="غير مفعل">غير مفعل</option>
                        </select>
                    </div>
                </div>

                <div class="row mr-2 mg-b-20">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>نوع المستخدم</strong>
                           {{-- <select name="roles_name[]" id="select-beast" class="form-control  nice-select  custom-select">
                            @foreach ($user->roles_name as $v)
                                <option value="{{$v}}" >{{$v}}</option>
                            @endforeach
                            @foreach ($roles as $y)

                            <option value="{{$y}}">{{$y}}</option>
                            @endforeach
                        </select> --}}
                             {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple'))!!}
                        </div>
                    </div>
                </div>
                <div class="mg-t-30 mr-2 mb-3">
                    <button class="btn btn-main-primary pd-x-20" type="submit">تحديث</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>






  <div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تغيـر كلمة المرور </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <form action="" id="DataPassword" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$user->id}}">
            </div>
            <div class="modal-body">
              <div class="row mg-b-20">
                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                        <label>كلمة المرور: <span class="tx-danger">*</span></label>
                   <input type="password" class="form-control" name="password">

                        {{-- {!! Form::password('password', array('class' => 'form-control','required')) !!} --}}
                    </div>

                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                        <label> تاكيد كلمة المرور: <span class="tx-danger">*</span></label>
                        {{-- {!! Form::password('confirm-password', array('class' => 'form-control','required')) !!} --}}
                   <input type="password" class="form-control" name="confirm-password">
                    </div>
                </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"  data-dismiss="modal">الغاء</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" id="change">تاكيد</button>
            </div>
            </form>
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

<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>

<!--Internal  Parsley.min js -->
<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<!-- Internal Form-validation js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>

  <!--Internal  Notify js -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
<script>
 $(document).on('click','#change',function(e){
        e.preventDefault();
        var DataPassword = new FormData($('#DataPassword')[0]);
        $.ajax({
            type:'post',
            url:"{{route('update.Password')}}",
            data:DataPassword,
             processData: false,
             contentType:false,
            cache: false,
        success: function(data){ 
        if(data.status == true){
            notif({
                msg: "تـم تغير كلمة المرور بنجـاح",
                type: "success"
            });
        }}

    });
    });
    </script>
@endsection

