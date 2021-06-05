<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>FUKI 4.0 - Phụ kiện thông minh 4.0</title>
	<link rel="shortcut icon" href="{{ asset('static/imgs/logo.png') }}">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/animations.css') }}">
	<link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
	<link rel="stylesheet" href="{{ asset('css/main.css') }}" class="color-switcher-link">
</head>

<body>
	<div id="canvas" style="background-color: #000">
		<div id="box_wrapper">

			<!-- template sections -->

			<div class="header_absolute">

				<div class="page_header_wrapper ds affix-top-wrapper" style="height: 140px;">
					<header class="page_header page_header_side vertical_menu_header ds affix-top">
						<div class="container-fluid">
							<div class="row">
								<div class="col-12 my-0 mx-0 d-flex justify-content-between align-items-center">
									<a href="/" class="logo">
										<img style="height: 65px; width: auto" src="{{ asset('imgs/logo_w.png') }}" alt="">
									</a>
									<span
										class="toggle_menu toggle_menu_side header-slide toggle_menu_special"><span></span></span>
									<!-- <a href="https://html.modernwebtemplates.com/way2go/#" class="btn btn-outline-maincolor2 color_white">hire me</a> -->
								</div>
							</div>
						</div>
						<div class="side_header_inner ds">
							<div class="scroll-wrapper scrollbar-macosx" style="position: relative;">
								<div class="scrollbar-macosx scroll-content"
									style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 780px;">
									<div class="header-side-menu text-left">
										<div class="container-fluid c-gutter-0">
											<div class="row">
												<div class="col-xs-12 col-sm-6">
													<div class="menu-part-1" style="background-color: #7A8084">
														<ul class="nav menu-side-click">
															<li class="menu-title">
																<a href="/">Sản phẩm</a>
															</li>
															<li>
																<div class="row">
																	<div class="col-sm-12 col-md-6" style="padding-right: 15px;">
																		<h6>Thẻ cá nhân thông minh</h6>
																		<a href="https://shopee.vn/product/453514978/4790348140/" class="d-block">
																			<img src="{{ asset('imgs/prod1.png') }}" class="img-fluid" alt="">
																		</a>
																	</div>
																	<div class="col-sm-12 col-md-6" style="padding-left: 15px;">
																		<h6>Sticket thông minh</h6>
																		<a href="https://shopee.vn/Sticker-th%C3%B4ng-minh-FUKI-Th%E1%BA%BB-c%C3%A1-nh%C3%A2n-th%C3%B4ng-minh-i.453514978.4390465814" class="d-block">
																			<img src="{{ asset('imgs/prod2.png') }}" class="img-fluid" alt="">
																		</a>
																	</div>
																</div>
															</li>
															
														</ul>
													</div>
													<div class="menu-part-2">
														<ul class="nav menu-side-click">
															<li class="menu-title">
																<a>Người dùng FUKI 4.0</a>
															</li>
															<li class="menu-item"><a href="{{ route('Login') }}">Đăng nhập</a> </li>
															<li class="menu-item"><a href="{{ route('Register') }}">Đăng ký</a></li>
														</ul>
													</div>
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="menu-part-3 menu-side-click"  style="background-color: #9FA2A5">
														<!-- main side nav start -->
														<nav class="mainmenu_side_wrapper">
															<ul class="nav menu-click">
																<li><a href="/">Trang chủ</a></li>
																<li><a href="">Tính nâng</a></li>
																<li><a href="">Khuyến mãi</a></li>
																{{-- <li class="active">
																	<a href="https://html.modernwebtemplates.com/way2go/index.html">Home</a>
																	<ul>
																		<li>
																			<a
																				href="https://html.modernwebtemplates.com/way2go/index.html">MultiPage</a>
																		</li>
																		<li>
																			<a
																				href="https://html.modernwebtemplates.com/way2go/index_static.html">Static
																				Intro</a>
																		</li>
																		<li>
																			<a
																				href="https://html.modernwebtemplates.com/way2go/index_singlepage.html">Single
																				Page</a>
																		</li>
																	</ul>
																	<span class="toggle_submenu color-darkgrey"></span>
																</li> --}}
																<li><a href="">Về chúng tôi</a></li>
																<li><a href="">Hướng dẫn</a></li>
																<li>
																	<a href="javascript:;">Đại lý</a>
																	<ul>
																		<li><a href="/">Chính sách đại lý</a></li>
																		<li> <a href="/">Đăng ký làm đại lý</a></li>
																	</ul>
																	<span class="toggle_submenu color-darkgrey"></span>
																</li>
																<!-- eof contacts -->
															</ul>
														</nav>
														<!-- eof main side nav -->
													</div>
												</div>
											</div>
											<div class="row header_bottom_part d-none">
												<div
													class="col-12 d-flex flex-wrap align-items-center justify-content-xl-between">
													<div class="media-wrap d-flex">
														<div class="media">
															<div class="icon-styled color-main fs-24">
																<i class="themeicon-phone"></i>
															</div>
															<div class="media-body color_2">
																<p>0-800-123-4567</p>
															</div>
														</div>
														<div class="media">
															<div class="icon-styled color-main fs-24">
																<i class="themeicon-mail"></i>
															</div>
															<div class="media-body color_2">
																<p>hi5@clive.com</p>
															</div>
														</div>
														<div class="media">
															<div class="icon-styled color-main fs-24">
																<i class="themeicon-marker"></i>
															</div>
															<div class="media-body color_2">
																<p>248 Hedge St, NJ 07201</p>
															</div>
														</div>
													</div>
													<h5 class="my-0">Contacts</h5>
													<div class="my-0 social-icons d-flex">
														<div class="icon-styled">
															<a href="https://html.modernwebtemplates.com/way2go/#"
																class="fa fa-linkedin" title="linkedin"></a>
														</div>
														<div class="icon-styled">
															<a href="https://html.modernwebtemplates.com/way2go/#"
																class="fa fa-instagram" title="twitter"></a>
														</div>
														<div class="icon-styled">
															<a href="https://html.modernwebtemplates.com/way2go/#"
																class="fa fa-facebook" title="facebook"></a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="scroll-element scroll-x">
									<div class="scroll-element_outer">
										<div class="scroll-element_size"></div>
										<div class="scroll-element_track"></div>
										<div class="scroll-bar" style="width: 0px;"></div>
									</div>
								</div>
								<div class="scroll-element scroll-y">
									<div class="scroll-element_outer">
										<div class="scroll-element_size"></div>
										<div class="scroll-element_track"></div>
										<div class="scroll-bar" style="height: 0px;"></div>
									</div>
								</div>
							</div>
						</div>
					</header>
				</div>
			</div>
			<div class="container">
				<div class="owl-carousel owl-theme">
					<div class="item">
						<div class="slideIntro__item page_slider">
							<div class="row">
								<div class="col-md-12">
									<div class="intro_layers_wrapper">
										<div class="intro_layers">
											<div class="intro_layer" data-wow-duration=".5s">
												<img src="{{ asset('imgs/banner1.jpg') }}" class="pull-left" alt="slide-img">
											</div>
											<div class="intro_layer text-right" data-wow-duration=".5s">
												<p class="title text-light">FUKI<span class="red">4.0</span>
													<span class="light"><br>Phụ kiện thông minh 4.0</span></p>
											</div>
										</div> <!-- eof .intro_layers -->
									</div> <!-- eof .intro_layers_wrapper -->
								</div> <!-- eof .col-* -->
							</div>
						</div>
					</div>
					{{-- <div class="item">
						<div class="slideIntro__item">
							2
						</div>
					</div>
					<div class="item">
						<div class="slideIntro__item">
							3
						</div>
					</div> --}}
				</div>
			</div>

			<div class="block-home bg-white">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 col-md-5 h-100 wow slideInLeft" data-wow-duration=".5s">
							<div>
								<h4 style="color: #333">FUKI4.0 là gì</h4>
								<p style="color: #333">FUKI 4.0 là công cụ giúp bạn chia sẻ thông tin cá nhân như thông tin liên hệ, tài khoản mạng xã hội,... thay co cardvisit thông qua những món đồ phụ kiện thông minh do chúng tôi cung cấp</p>
								{{-- <a href="">Xem sản phẩm</a> --}}
							</div>
						</div>
						<div class="col-sm-12 col-md-1"></div>
						<div class="col-sm-12 col-md-6 wow slideInRight" data-wow-duration=".5s">
							<div class="row">
								<div class="col-sm-12 col-md-6">
									{{-- <a href="https://shopee.vn/product/453514978/4790348140/" class="d-block"> --}}
										<img src="{{ asset('imgs/prod1.png') }}" class="img-fluid" alt="">
									{{-- </a> --}}
								</div>	
								<div class="col-sm-12 col-md-6">
									{{-- <a href="https://shopee.vn/Sticker-th%C3%B4ng-minh-FUKI-Th%E1%BA%BB-c%C3%A1-nh%C3%A2n-th%C3%B4ng-minh-i.453514978.4390465814" class="d-block"> --}}
										<img src="{{ asset('imgs/prod2.png') }}" class="img-fluid" alt="">
									{{-- </a> --}}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="block-home bg-white">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 col-md-4 h-100">
							<div>
								<h4 style="color: #333">Fuki4.0 giúp bạn chia sẻ thông tin như thế nào ?</h4>
								<p style="color: #333">Bạn có thể chia sẻ thông tin bằng các tính năng có sẵn trên Smartphone của mình mà không cài thêm bất kỳ ứng dụng nào</p>
								{{-- <a href="">Xem sản phẩm</a> --}}
							</div>
						</div>
						<div class="col-sm-12 col-md-1"></div>
						<div class="col-sm-12 col-md-7">
							<img src="{{ asset('imgs/home2.png') }}" class="img-fluid" alt="">
						</div>
					</div>
				</div>
			</div>

			<div class="block-home bg-white">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 col-md-5 h-100 wow slideInLeft" data-wow-duration=".5s">
							<div>
								<h4 style="color: #333">Bạn có thể chia sẻ những gì ?</h4>
								<p style="color: #333">Với FUKI 4.0, bạn có thể chia sẻ những thông tin liên hệ, trang cá nhân ở bất kỳ nền tảng mạng xã hội nào. Thạm chí bạn có thể chia sẻ cả số tài khoản ngân hàng hay ví điện tử trên nền tảng của chúng tôi.</p>
								{{-- <a href="">Xem sản phẩm</a> --}}
							</div>
						</div>
						<div class="col-sm-12 col-md-1"></div>
						<div class="col-sm-12 col-md-6  wow slideInRight" data-wow-duration=".5s">
							<div class="row">
								<img src="{{ asset('imgs/home3.png') }}" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="block-home bg-white">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 col-md-5 h-100 wow slideInLeft" data-wow-duration=".5s">
							<div>
								<h4 style="color: #333">Thẻ cá nhân thông minh</h4>
								<p style="color: #333">Thẻ cá nhân thông minh bản chất là Card visit, nhưng thẻ cá nhân thông minh của FUKI 4.0 có nhiều ưu điểm hơn, giúp bạn có thể thường xuyên cập nhập thông tin cá nhân và chia sẻ thông tin dễ dàng hơn so Card visit truyền thống.</p>
								<a href="https://shopee.vn/product/453514978/4790348140/">Xem sản phẩm</a>
							</div>
						</div>
						<div class="col-sm-12 col-md-1"></div>
						<div class="col-sm-12 col-md-6  wow slideInRight" data-wow-duration=".5s">
							<div class="row">
								<img src="{{ asset('imgs/home4.png') }}" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="block-home bg-white">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 col-md-5 h-100 wow slideInLeft" data-wow-duration=".5s">
							<div>
								<h4 style="color: #333">Sticker thông minh</h4>
								<p style="color: #333">Sticker thông minh có mặt sau là băng keo, có thể dán lên bất kỳ món đồ nào của bạn như, điện thoại, máy tính bảng, laptop hoặc một món đồ bất ly thân nào đó, giúp bạn có thể chia sẻ thông tin cá nhân của mình, mọi lúc mọi nơi với khách hàng hay đối tác.</p>
								<a href="https://shopee.vn/Sticker-th%C3%B4ng-minh-FUKI-Th%E1%BA%BB-c%C3%A1-nh%C3%A2n-th%C3%B4ng-minh-i.453514978.4390465814">Xem sản phẩm</a>
							</div>
						</div>
						<div class="col-sm-12 col-md-1"></div>
						<div class="col-sm-12 col-md-6  wow slideInRight" data-wow-duration=".5s">
							<div class="row">
								<img src="{{ asset('imgs/home5.png') }}" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
			<footer>
				<div class="container">
					<div class="row">
						<div class="col-sm-12 col-md-3">
							<a href="/" class="logo">
								<img src="{{ asset('imgs/logo_w.png') }}" style="height: 65px" alt="">
							</a>
						</div>
						<div class="col-sm-6 col-md-5">
							<p><i class="fas fa-mobile-alt mr-3"></i> 0796.006.660</p>
							<p><i class="far fa-envelope-open  mr-3	"></i> phukienthongminhfuki40@gmail.com</p>
						</div>
						<div class="col-sm-6 col-md-4">
							<a href="https://www.facebook.com/fuki4.0"><i class="fab fa-facebook mr-3"></i>Follow us on facebook</a> <br>
							<a href="https://www.instagram.com/fuki4.0/"><i class="fab fa-instagram mr-3"></i>Follow us on instagram</a>
						</div>
					</div>
				</div>
			</footer>

		</div><!-- eof #box_wrapper -->
	</div><!-- eof #canvas -->
	{{-- <div class="fix-contact">
		<a href=""><i class="fab fa-facebook-f"></i></a>
		<a href=""><i class="fab fa-instagram"></i></a>
		<a href=""><i class="fab fa-youtube"></i></a>
	</div> --}}
	<style>
		.fix-contact {
			position: fixed;
			top: 50vh;
			right: 50px;
			display: flex;
			flex-direction: column;
		}

		.fix-contact a {
			color: #242d3c;
			margin-bottom: 16px;
		}

		
		.block-home {
			min-height: 100vh;
			display: flex;
			align-items: center;
		}
		.block-home h2 {
			font-size: 62px;
			font-weight: normal;
			color: #333;
			line-height: 1.2;
			margin-bottom: 48px;
		}
		.block-home a {
			display: flex;
			/* align-items: center; */
			justify-content: center;
			font-size: 14px;
		    padding: 15px 25px;
			text-transform: uppercase;
    		letter-spacing: 5.5px;
			font-weight: 700;
			color: #3c3c3c;
			border: 1px solid #3c3c3c;
		}
		.bg-yellow {
			background-color: #f8f5d4;
		}
		.bg-blue {
			background-color: #b4e4e5;
		}
		.bg-green {
			background-color: #d0f2c0;
		}
		.bg-white {
			background-color: #d0f2c0;
		}
		footer {
			background-color: #d0f0be;
			padding: 80px 0px;
		}
		footer p {
			color: #333333;
			margin: 0;
		}
	</style>
	<script src="{{ asset('js/compressed.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="{{ asset('js/main.js') }}"></script>
	<script>
		$('.owl-carousel').owlCarousel({
			loop:true,
			margin:10,
			nav:false,
			items: 1,
			dots: false
		})
		new WOW().init();
	</script>
	<style>
		.slideIntro__item {
			padding: 150px 0px;
		}
		#toTop {
			display: none!important
		}
	</style>