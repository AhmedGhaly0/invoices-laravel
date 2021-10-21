
@extends('layouts.master')

@section("title")
لوحه التحكم - مساهم
@endsection
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="left-content">
						<div>
						  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1"> مــساهم  للأدارة الـقانونية</h2>
						  <p class="mg-b-0">مرحبـا بــك  <ion-icon name="hand"></ion-icon></p>
						</div>
					</div>
					<div class="main-dashboard-header-right">
						<div>

							{{-- <div class="main-star">
								<i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star"></i> <span></span>
							</div> --}}
						</div>
						<div>
							<label class="tx-13"></label>
							<h5></h5>
						</div>
						<div>
							<label class="tx-13"></label>
							<h5></h5>
						</div>
					</div>
				</div>
				<!-- /breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
                    @can('الفواتير')
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-primary-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">اجمالي الفواتير </h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">
                                                {{ number_format(\App\models\invoices::sum('Total'), 2) }}
                                            </h4>
											<p class="mb-0 tx-12 text-white op-7">اجمالي عدد الفواتير : {{\App\models\invoices::count()}}</p>
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											<span class="text-white op-7"> 100%</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline" class="pt-1"></span>
						</div>
					</div>
                    @endcan
                    @can('الفواتير المدفوعة')
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-success-gradient ">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">الفواتير المدفوعة</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">
                                                {{ number_format(\App\models\invoices::where("Value_Status",1)->sum('Total'), 2) }}
                                            </h4>
											<p class="mb-0 tx-12 text-white op-7"> عدد الفواتير : {{\App\models\invoices::where("Value_Status",1)->count()}}</p>
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											<span class="text-white ">
                                                @php
                                                $count_all= \App\models\invoices::count();
                                                $count_invoices2 = \App\models\invoices::where('Value_Status', 1)->count();
                                                if($count_invoices2 == 0){
                                                   echo $count_invoices2 = 0 ."%";
                                                }
                                                else{
                                                    $count_invoices2 = $count_invoices2 / $count_all *100;
                                                    echo number_format($count_invoices2)."%";
                                                }
                                                @endphp
                                            </span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
						</div>
					</div>
                    @endcan
                    @can('الفواتير المدفوعة جزئيا')
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-warning-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">الفواتير المدفوعة جزئيا</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">
                                                {{ number_format(\App\models\invoices::where("Value_Status",2)->sum('Total'), 2) }}
                                            </h4>
											<p class="mb-0 tx-12 text-white op-7">
                                                عدد الفواتير : {{\App\models\invoices::where("Value_Status",2)->count()}}
                                            </p>
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-down text-white"></i>
											<span class="text-white op-7">
                                                @php
                                                $count_all= \App\models\invoices::count();
                                                $count_invoices2 = \App\models\invoices::where('Value_Status', 2)->count();
                                                if($count_invoices2 == 0){
                                                   echo $count_invoices2 = 0 ."%";
                                                }
                                                else{
                                                    $count_invoices2 = $count_invoices2 / $count_all *100;
                                                    echo number_format($count_invoices2)."%";
                                                }
                                                @endphp
                                            </span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>

					</div>
                    @endcan
                    @can('الفواتير الغير مدفوعة')
                    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-danger-gradient ">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">الفواتير الغير مدفوعة</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">
                                                {{ number_format(\App\models\invoices::where("Value_Status",3)->sum('Total'), 2) }}
                                            </h4>
											<p class="mb-0 tx-12 text-white op-7">
                                                عدد الفواتير : {{\App\models\invoices::where("Value_Status",3)->count()}}
                                            </p>
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-down text-white"></i>
											<span class="text-white op-7">
                                                @php
                                                $count_all= \App\models\invoices::count();
                                                $count_invoices2 = \App\models\invoices::where('Value_Status', 3)->count();
                                                if($count_invoices2 == 0){
                                                   echo $count_invoices2 = 0 ."%";
                                                }
                                                else{
                                                    $count_invoices2 = $count_invoices2 / $count_all *100;
                                                    echo number_format($count_invoices2)."%";
                                                }
                                                @endphp
                                            </span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
						</div>
                        @endcan
					</div>
				</div>


				<!-- row closed -->

				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-md-12 col-lg-12 col-xl-7">
						<div class="card">
							<div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
								<div class="d-flex justify-content-between">
									<h4 class="">حـالة الــفواتير</h4>

								</div>
								<p class="text-muted mb-0">حــالة الـــفواتير في الــوقت الحــالي.</p>
                                <br>
							</div>
							<div class=''style="width: 70%">
								{!! $chartjs->render() !!}
							</div>
						</div>
					</div>
					<div class="col-lg-12 col-xl-5">
						<div class="card card-dashboard-map-one">
                            <h4 class="">حـالة الــفواتير</h4>


                        <p class="text-muted mb-2 ">حــالة الـــفواتير مئويا.</p>
							<div class="" style="width: 110%">
								{!! $chartjs2->render() !!}
							</div>
						</div>
					</div>
				</div>
				<!-- row closed -->

				<!-- row opened -->
                @can("الاعدادات")
                <div class="card ">
                    <div class="card-body">
                        <div class="row">
                         @can('الاقسام')
                         <div class="col-md-6">
                            <div class="d-flex align-items-center pb-2">
                                <h3 class="mb-0">الاقــسام</h3>
                            </div>
                            <h6 class="text-muted mb-2">
                                عدد الافسام : {{\App\models\section::count()}}
                            </h6>
                            <div class="progress progress-style progress-sm">
                                <div class="progress-bar bg-primary-gradient " style="width:{{\App\models\section::count()}}rem" role="progressbar" aria-valuenow="" aria-valuemin="" aria-valuemax=""></div>
                            </div>
                        </div>
                         @endcan
                            @can('المنتجات')
                            <div class="col-md-6 mt-4 mt-md-0">
                                <div class="d-flex align-items-center pb-2">
                                    <h3 class="mb-0">المنتجـات</h3>
                                </div>
                                <h6 class="text-muted mb-2">
                                    عدد المنتجات : {{\App\models\products::count()}}
                                </h6>
                                <div class="progress progress-style progress-sm">
                                    <div class="progress-bar bg-danger-gradient" style="width:{{\App\models\products::count()}}rem" role=""  aria-valuenow="0" aria-valuemin="46" aria-valuemax="100"></div>
                                </div>
                            @endcan




                            </div>
                        </div>
                @endcan

				<!-- row close -->

				<!-- row opened -->

				<!-- /row -->
			</div>
		</div>
		<!-- Container closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>
@endsection
