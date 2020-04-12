<!doctype html>
<html lang="fr" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="Bel-CMS Management" name="description">
		<meta content="Stive@determe.be" name="author">
		<link rel="icon" href="/managements/assets/images/brand/favicon.ico" type="image/x-icon">
		<link rel="shortcut icon" type="image/x-icon" href="/managements/assets/images/brand/favicon.ico">
		<title>Bel-CMS Management</title>
		<link rel="stylesheet" type="text/css" href="../../assets/styles/belcms.notification.css">
		<link href="/managements/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="/managements/assets/css-dark/style.css" rel="stylesheet">
		<link href="/managements/assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet">
		<link href="/managements/assets/plugins/horizontal-menu/dropdown-effects/fade-down.css" rel="stylesheet">
		<link href="/managements/assets/plugins/horizontal-menu/dark-horizontalmenu.css" rel="stylesheet">
		<link href="/managements/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
		<link href="/managements/assets/plugins/accordion1/css/dark-easy-responsive-tabs.css" rel="stylesheet">
		<link href="/managements/assets/plugins/sidebar/dark-sidebar.css" rel="stylesheet">
		<link href="/managements/assets/plugins/iconfonts/plugin.css" rel="stylesheet">
		<link href="/managements/assets/plugins/iconfonts/icons.css" rel="stylesheet">
		<link href="/managements/assets/fonts/fonts/font-awesome.min.css" rel="stylesheet">
		<link href="/managements/assets/plugins/wysiwyag/richtext.css" rel="stylesheet" />
		<script src="/managements/assets/js-dark/vendors/jquery-3.2.1.min.js"></script>
		<script src="/managements/assets/plugins/bootstrap/popper.min.js"></script>
		<script src="/managements/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	</head>

	<body class="app sidebar-mini rtl">
		<div id="global-loader">
			<img src="/managements/assets/images/icons/loader.svg" alt="loader">
		</div>
		<div class="page">
			<div class="page-main">
				<div class="app-header header hor-topheader d-flex">
					<div class="container">
						<div class="d-flex">
						    <a style="line-height: 62px" class="header-brand" href="/index.html">
								Bel-CMS Management
								<img src="/managements/assets/images/brand/icon.png" class="header-brand-img icon-logo" alt="Hogo logo">
							</a>
							<a id="horizontal-navtoggle" class="animated-arrow hor-toggle"><span></span></a>
							<div class="d-flex order-lg-2 ml-auto header-rightmenu">
								<div class="dropdown">
									<a  class="nav-link icon full-screen-link" id="fullscreen-button">
										<i class="fe fe-maximize-2"></i>
									</a>
								</div>
								<div class="dropdown header-user">
									<a class="nav-link leading-none siderbar-link" data-toggle="sidebar-right" data-target=".sidebar-right">
										<span class="mr-3 d-none d-lg-block ">
											<span class="text-gray-white"><span class="ml-2"><?=Users::hashkeyToUsernameAvatar($_SESSION['USER']['HASH_KEY'])?></span></span>
										</span>
										<span class="avatar avatar-md brround"><img src="/<?=Users::hashkeyToUsernameAvatar($_SESSION['USER']['HASH_KEY'], 'avatar')?>" alt="Profile-img" class="avatar avatar-md brround"></span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="horizontal-main hor-menu clearfix">
					<div class="horizontal-mainwrapper container clearfix">
						<nav class="horizontalMenu clearfix">
							<ul class="horizontalMenu-list">
								<li aria-haspopup="true"><a href="/dashboard?admin" class="sub-icon"><i class="typcn typcn-device-desktop hor-icon"></i> Dashboard</a></li>
								<li aria-haspopup="true"><a href="#" class="sub-icon"><i class="typcn typcn-chart-pie-outline"></i> Paramètres <i class="fa fa-angle-down horizontal-icon"></i></a>
									<ul class="sub-menu">
										<?php
										foreach ($menuParameter as $k => $v):
											?>
											<li aria-haspopup="true"><a href="<?=$k?>"><?=$v?></a></li>
											<?php
										endforeach;
										?>
									</ul>
								</li>
								<li aria-haspopup="true"><a href="#" class="sub-icon"><i class="typcn typcn-th-large-outline hor-icon"></i> Pages <i class="fa fa-angle-down horizontal-icon"></i></a>
									<ul class="sub-menu">
										<?php
										foreach ($menuPage as $k => $v):
											?>
											<li aria-haspopup="true"><a href="<?=$k?>"><?=$v?></a></li>
											<?php
										endforeach;
										?>
									</ul>
								</li>
								<li aria-haspopup="true"><a href="#" class="sub-icon"><i class="typcn typcn-chart-pie-outline"></i> Widgets <i class="fa fa-angle-down horizontal-icon"></i></a>
									<ul class="sub-menu">
										<?php
										foreach ($menuWidget as $k => $v):
											?>
											<li aria-haspopup="true"><a href="<?=$k?>"><?=$v?></a></li>
											<?php
										endforeach;
										?>
									</ul>
								</li>
								<li aria-haspopup="true"><a href="#" class="sub-icon"><i class="typcn typcn-chart-pie-outline"></i> Gaming <i class="fa fa-angle-down horizontal-icon"></i></a>
									<ul class="sub-menu">
										<?php
										foreach ($menuGaming as $k => $v):
											?>
											<li aria-haspopup="true"><a href="<?=$k?>"><?=$v?></a></li>
											<?php
										endforeach;
										?>
									</ul>
								</li>
							</ul>
						</nav>
					</div>
				</div>
				<div class="container content-area">
					<div class="side-app">
						<div class="page-header">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="/dashboard?admin">Home</a></li>
							</ol>
						</div>
						<?=$render?>
					</div>
					<footer class="footer">
						<div class="container">
							<div class="row align-items-center flex-row-reverse">
								<div class="col-lg-12 col-sm-12 text-center">
									Copyright © <?=date('Y')?> <a href="https://bel-cms.be">Bel-CMS</a> All rights reserved.
								</div>
							</div>
						</div>
					</footer>
				</div>
			</div>
		</div>
		<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>
		<script src="https://cdn.ckeditor.com/ckeditor5/17.0.0/classic/ckeditor.js"></script>
		    <script>
		        ClassicEditor
		            .create( document.querySelector( '.ckeditor' ) )
		            .catch( error => {
		                console.error( error );
		            } );
		        ClassicEditor
		            .create( document.querySelector( '.ckeditor2' ) )
		            .catch( error => {
		                console.error( error );
		            } );
		    </script>
		<script src="/managements/assets/js-dark/vendors/jquery.sparkline.min.js"></script>
		<script src="/managements/assets/js-dark/vendors/circle-progress.min.js"></script>
		<script src="/managements/assets/plugins/rating/jquery.rating-stars.js"></script>
		<script src="/managements/assets/plugins/moment/moment.min.js"></script>
		<script src="/managements/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
		<script src="/managements/assets/plugins/horizontal-menu/horizontalmenu.js"></script>
		<script src="/managements/assets/plugins/counters/jquery.missofis-countdown.js"></script>
		<script src="/managements/assets/plugins/counters/counter.js"></script>
		<script src="/managements/assets/plugins/accordion1/js/easyResponsiveTabs.js"></script>
		<script src="/managements/assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>
		<script src="/managements/assets/plugins/sidebar/sidebar.js"></script>
		<script src="/managements/assets/js-dark/custom.js"></script>
	</body>
</html>