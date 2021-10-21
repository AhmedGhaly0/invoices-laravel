<!-- main-header opened -->
			<div class="main-header sticky side-header nav nav-item">
				<div class="container-fluid">
					<div class="main-header-left ">
						<div class="responsive-logo">
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="logo-1" alt="logo"></a>
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="dark-logo-1" alt="logo"></a>
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-2" alt="logo"></a>
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="dark-logo-2" alt="logo"></a>
						</div>
						<div class="app-sidebar__toggle" data-toggle="sidebar">
							<a class="open-toggle" href="#"><i class="header-icon fe fe-align-left" ></i></a>
							<a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
						</div>
						<div class="main-header-center mr-3 d-sm-none d-md-none d-lg-block">
							{{-- <input class="form-control" placeholder="Search for anything..." type="search"> <button class="btn"><i class="fas fa-search d-none d-md-block"></i></button> --}}
						</div>
					</div>
					<div class="main-header-right">
						<ul class="nav">
							{{-- <li class="">
								<div class="dropdown  nav-itemd-none d-md-flex">
									<a href="#" class="d-flex  nav-item nav-link pl-0 country-flag1" data-toggle="dropdown" aria-expanded="false">
										<span class="avatar country-Flag mr-0 align-self-center bg-transparent"><img src="{{URL::asset('assets/img/flags/us_flag.jpg')}}" alt="img"></span>
										<div class="my-auto">
											<strong class="mr-2 ml-2 my-auto">English</strong>
										</div>
									</a>
									<div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow" x-placement="bottom-end">
										<a href="#" class="dropdown-item d-flex ">
											<span class="avatar  ml-3 align-self-center bg-transparent"><img src="{{URL::asset('assets/img/flags/french_flag.jpg')}}" alt="img"></span>
											<div class="d-flex">
												<span class="mt-2">French</span>
											</div>
										</a>
										<a href="#" class="dropdown-item d-flex">
											<span class="avatar  ml-3 align-self-center bg-transparent"><img src="{{URL::asset('assets/img/flags/germany_flag.jpg')}}" alt="img"></span>
											<div class="d-flex">
												<span class="mt-2">Germany</span>
											</div>
										</a>
										<a href="#" class="dropdown-item d-flex">
											<span class="avatar ml-3 align-self-center bg-transparent"><img src="{{URL::asset('assets/img/flags/italy_flag.jpg')}}" alt="img"></span>
											<div class="d-flex">
												<span class="mt-2">Italy</span>
											</div>
										</a>
										<a href="#" class="dropdown-item d-flex">
											<span class="avatar ml-3 align-self-center bg-transparent"><img src="{{URL::asset('assets/img/flags/russia_flag.jpg')}}" alt="img"></span>
											<div class="d-flex">
												<span class="mt-2">Russia</span>
											</div>
										</a>
										<a href="#" class="dropdown-item d-flex">
											<span class="avatar  ml-3 align-self-center bg-transparent"><img src="{{URL::asset('assets/img/flags/spain_flag.jpg')}}" alt="img"></span>
											<div class="d-flex">
												<span class="mt-2">spain</span>
											</div>
										</a>
									</div>
								</div>
							</li> --}}
						</ul>
						<div class="nav nav-item  navbar-nav-right ml-auto">
							<div class="nav-link" id="bs-example-navbar-collapse-1">
								{{-- <form class="navbar-form" role="search">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Search">
										<span class="input-group-btn">
											<button type="reset" class="btn btn-default">
												<i class="fas fa-times"></i>
											</button>
											<button type="submit" class="btn btn-default nav-link resp-btn">
												<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
											</button>
										</span>
									</div>
								</form> --}}
							</div>
							{{-- <div class="dropdown nav-item main-header-message ">
								<a class="new nav-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg><span class=" pulse-danger"></span></a>
								<div class="dropdown-menu">
									<div class="menu-header-content bg-primary text-right">
										<div class="d-flex">
											<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">Messages</h6>
											<span class="badge badge-pill badge-warning mr-auto my-auto float-left">Mark All Read</span>
										</div>
										<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">You have 4 unread messages</p>
									</div>
									<div class="main-message-list chat-scroll">
										{{-- <a href="#" class="p-3 d-flex border-bottom">
											<div class="  drop-img  cover-image  " data-image-src="{{URL::asset('assets/img/faces/3.jpg')}}">
												<span class="avatar-status bg-teal"></span>
											</div>
											<div class="wd-90p">
												<div class="d-flex">
													<h5 class="mb-1 name">Petey Cruiser</h5>
												</div>
												<p class="mb-0 desc">I'm sorry but i'm not sure how to help you with that......</p>
												<p class="time mb-0 text-left float-right mr-2 mt-2">Mar 15 3:55 PM</p>
											</div>
										</a>
										<a href="#" class="p-3 d-flex border-bottom">
											<div class="drop-img cover-image" data-image-src="{{URL::asset('assets/img/faces/2.jpg')}}">
												<span class="avatar-status bg-teal"></span>
											</div>
											<div class="wd-90p">
												<div class="d-flex">
													<h5 class="mb-1 name">Jimmy Changa</h5>
												</div>
												<p class="mb-0 desc">All set ! Now, time to get to you now......</p>
												<p class="time mb-0 text-left float-right mr-2 mt-2">Mar 06 01:12 AM</p>
											</div>
										</a>
										<a href="#" class="p-3 d-flex border-bottom">
											<div class="drop-img cover-image" data-image-src="{{URL::asset('assets/img/faces/9.jpg')}}">
												<span class="avatar-status bg-teal"></span>
											</div>
											<div class="wd-90p">
												<div class="d-flex">
													<h5 class="mb-1 name">Graham Cracker</h5>
												</div>
												<p class="mb-0 desc">Are you ready to pickup your Delivery...</p>
												<p class="time mb-0 text-left float-right mr-2 mt-2">Feb 25 10:35 AM</p>
											</div>
										</a>
										<a href="#" class="p-3 d-flex border-bottom">
											<div class="drop-img cover-image" data-image-src="{{URL::asset('assets/img/faces/12.jpg')}}">
												<span class="avatar-status bg-teal"></span>
											</div>
											<div class="wd-90p">
												<div class="d-flex">
													<h5 class="mb-1 name">Donatella Nobatti</h5>
												</div>
												<p class="mb-0 desc">Here are some products ...</p>
												<p class="time mb-0 text-left float-right mr-2 mt-2">Feb 12 05:12 PM</p>
											</div>
										</a>
										<a href="#" class="p-3 d-flex border-bottom">
											<div class="drop-img cover-image" data-image-src="{{URL::asset('assets/img/faces/5.jpg')}}">
												<span class="avatar-status bg-teal"></span>
											</div>
											<div class="wd-90p">
												<div class="d-flex">
													<h5 class="mb-1 name">Anne Fibbiyon</h5>
												</div>
												<p class="mb-0 desc">I'm sorry but i'm not sure how...</p>
												<p class="time mb-0 text-left float-right mr-2 mt-2">Jan 29 03:16 PM</p>
											</div>
										</a>
									</div>
									<div class="text-center dropdown-footer">
										<a href="text-center">VIEW ALL</a>
									</div>
								</div>
							</div> --}}
                            @can('الاشعارات')


							<div class="dropdown nav-item main-header-notification " >
								<a class="new nav-link togglelink" href="#Notifications" title="الاشعـارات" >
								<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"> <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                                       <div class="" id="notifications_count" >
                                        @php
                                        $count = auth()->user()->unreadNotifications->count();
                                        @endphp
                                        @if (!empty($count))
                                         <span class=" pulse"></span>
                                         @endif
                                       </div>

                                  </a>
								<div class="dropdown-menu">
									<div class="menu-header-content bg-primary text-right">
                                        <div class="" id="notifications_show" >
                                     <div class="">
                                        @if (!empty(auth()->user()->unreadNotifications->count()))
                                        <span id="raed_at" class="badge bg-warning p-2 fw-bold   float-left" style="cursor: pointer;"> تعين قـراءة الــكل </span>

                                        @endif
                                     </div>
										<div class=" d-flex">

											<h5 class="dropdown-title mb-1 d-flex text-white font-weight-semibold"> الاشعـارات </h5>
                                            @if ( auth()->user()->unreadNotifications->count() == 0 )
                                            <p class="badge bg-warning fw-bold mr-2 " style="font-size: 15px">لا توجد اشعارات</p>
                                             @else
											<p class="badge bg-warning fw-bold mr-2" style="font-size: 15px">{{ auth()->user()->unreadNotifications->count() }}</p>
                                            @endif

										</div>

                                        </div>



									</div>
									<div class="main-notification-list chat-scroll unreadNotifications" id="unreadNotifications" style="overflow: scroll;">

                                        @foreach (auth()->user()->unreadNotifications as $notification)
										@if ($notification->data['controller'] == 'invoices' )
                                        <a class="d-flex p-3 border-bottom  read_one_notify"   href="{{url('invoices/invoices-details')}}/{{$notification->data['invoice_id']}}">
		<small class="id_notify" data-id="{{$notification->id}}"></small>
											<div class="notifyimg bg-pink">
												<i class="la la-file-alt text-white"></i>
											</div>
											<div class="mr-3">
                                                <h4 class="notification-label mb-1">{{$notification->data['title']}} {{$notification->data['user']}}</h4>
                                                <div class="notification-subtext">{{ $notification->created_at }}</div>
											</div>
											<div class="mr-auto" >
												<i class="las la-angle-left text-left text-muted"></i>
											</div>
										</a>
                                        @endif
                                        @endforeach

                                        @foreach (auth()->user()->unreadNotifications as $notification)
                                       @if ($notification->data['controller'] == 'update')
                                       <a class="d-flex p-3 border-bottom read_one_notify"   href="{{url('invoices/invoices-details')}}/{{$notification->data['invoice_id']}}">
									   <small class="id_notify" data-id="{{$notification->id}}"></small>
                                        <div class="notifyimg bg-warning">
                                            <i class="fas fa-file-signature text-white"></i>
                                        </div>
                                        <div class="mr-3">
                                            <h4 class="notification-label mb-1">{{$notification->data['title']}} {{$notification->data['user']}}</h4>
                                            <div class="notification-subtext">{{ $notification->created_at }}</div>
                                        </div>
                                        <div class="mr-auto" >
                                            <i class="las la-angle-left text-left text-muted"></i>
                                        </div>
									</a>
                                       @endif
                                       @endforeach

                                       @foreach (auth()->user()->unreadNotifications as $notification)
                                       @if ($notification->data['controller'] == 'product')
                                       <a class="d-flex p-3 border-bottom read_one_notify"   href="{{url('products')}}">
									   <small class="id_notify" data-id="{{$notification->id}}"></small>
                                        <div class="notifyimg bg-success">
                                            <i class="la la-shopping-basket text-white"></i>
                                        </div>
                                        <div class="mr-3">
                                            <h4 class="notification-label mb-1">{{$notification->data['title']}} {{$notification->data['user']}}</h4>
                                            <div class="notification-subtext">{{ $notification->created_at }}</div>
                                        </div>
                                        <div class="mr-auto" >
                                            <i class="las la-angle-left text-left text-muted"></i>
                                        </div>
                                    </a>
                                       @endif
                                       @endforeach

                                       @foreach (auth()->user()->unreadNotifications as $notification)
                                        @if ($notification->data['controller'] == 'section')
                                        <a class="d-flex p-3 border-bottom read_one_notify"   href="{{url('section')}}">
									   <small class="id_notify" data-id="{{$notification->id}}"></small>

											<div class="notifyimg bg-primary">
												<i class="la la-check-circle text-white"></i>
											</div>
											<div class="mr-3">
                                                <h4 class="notification-label mb-1">{{$notification->data['title']}} {{$notification->data['user']}}</h4>
                                                <div class="notification-subtext">{{ $notification->created_at }}</div>
											</div>
											<div class="mr-auto" >

											</div>
										</a>
                                        @endif
                                        @endforeach

									</div>
									<div class="dropdown-footer">
                                        @foreach (auth()->user()->Notifications as $notification )
                                        @endforeach

                                        @if (!empty($notification->read_at))
										<a href="{{url('Notification')}}"> عرض الاشعارات المقروءة </a>
                                           @else
                                           <span>لا يوجد اشعارات مقروءة</span>
                                        @endif

									</div>
								</div>
							</div>

                            @endcan

							<div class="nav-item full-screen fullscreen-button">

								<a class="new nav-link full-screen-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg></a>
							</div>
							<div class="dropdown main-profile-menu nav nav-item nav-link">
								<a class="profile-user d-flex" href=""><img alt=""  src="{{URL::asset('assets/avatar/'. Auth::user()->Avatar)}}"></a>
								<div class="dropdown-menu">
									<div class="main-header-profile bg-primary p-3">
										<div class="d-flex wd-100p">
											<div class="main-img-user"><img alt=""  src="{{URL::asset('assets/avatar/'. Auth::user()->Avatar)}}" class=""></div>
											<div class="mr-3 my-auto">
												<h6>{{Auth::user()->name;}}</h6>

												<span>{{Auth::user()->email;}}</span>
											</div>
										</div>
									</div>

									<a class="dropdown-item" href=""><i class="bx bx-user-circle"></i>Profile</a>
									<a class="dropdown-item" href="{{ route('user.editauth', Auth::user()->id) }}"><i class="bx bx-cog"></i> Edit Profile</a>
									<a class="dropdown-item" href=""><i class="bx bxs-inbox"></i>Inbox</a>
									<a class="dropdown-item" href=""><i class="bx bx-envelope"></i>Messages</a>
									<a class="dropdown-item" href=""><i class="bx bx-slider-alt"></i> Account Settings</a>
									<a class="dropdown-item" href="{{ route('logout') }}"
                                     onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                     class="bx bx-log-out"></i>تسجيل خروج</a>
                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                     @csrf

                                     </form>

								</div>
							</div>
							<div class="dropdown main-header-message right-toggle">
								<a class="nav-link pr-0" data-toggle="sidebar-left" data-target=".sidebar-left">
									<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
								</a>
							</div>
						</div>
					</div>

				</div>




			</div>
<!-- /main-header -->
<script>
    setInterval(function() {

        $("#notifications_count").load(window.location + " #notifications_count");
        $("#notifications_show").load(window.location + " #notifications_show");
        $("#unreadNotifications").load(window.location + " #unreadNotifications");
    }, 5000);
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>

//  Read All
    $(document).on('click','#raed_at',function(e){
        e.preventDefault();
        $.ajax({
            type:'post',
            url:"{{route('Raed_At.All')}}",
            data:{
                '_token': "{{csrf_token()}}",

            },
        success: function(result){

        }});

    });

	//  Read One Notify
	 $(document).on('click','.read_one_notify',function(){

        var data_id = $('.id_notify').attr('data-id');
        $.ajax({
            type:'post',
            url:"{{route('read.one.notify')}}",
            data:{
                '_token': "{{csrf_token()}}",
                'id' : data_id
            },
        success: function(data){
        }});

    });
    </script>



