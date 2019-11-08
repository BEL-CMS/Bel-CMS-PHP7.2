<!DOCTYPE html>
<html lang="fr">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Bel-CMS | Management</title>
	<script src="https://kit.fontawesome.com/5538c58e45.js" crossorigin="anonymous"></script>
	<!-- Bootstrap -->
	<link href="/managements/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="/managements/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
	<link href="/managements/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- NProgress -->
	<link href="/managements/vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- notification -->
	<link href="/assets/styles/belcms.notification.css" rel="stylesheet">
	<!-- Custom Theme Style -->
	<link href="/managements/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
	<div class="container body">
	  <div class="main_container">
		<div class="col-md-3 left_col">
		  <div class="left_col scroll-view">
			<div class="navbar nav_title" style="border: 0;">
			  <a href="https://bel-cms.be" class="site_title"><span>Bel-CMS.be</span> Admin</a>
			</div>

			<div class="clearfix"></div>

			<!-- menu profile quick info -->
			<div class="profile clearfix">
			  <div class="profile_info" style="text-align: center;">
				Welcome, <?=Users::hashkeyToUsernameAvatar($_SESSION['USER']['HASH_KEY'])?>
			  </div>
			  <div class="clearfix"></div>
			</div>
			<!-- /menu profile quick info -->

			<br />

			<!-- sidebar menu -->
			<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
			  <div class="menu_section">
				<h3>General</h3>
				<ul class="nav side-menu">
				  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
					  <li><a href="Dashboard?management">Home Management</a></li>
					  <li><a href="blog">Home Website</a></li>
					</ul>
				  </li>
				  <li><a><i class="fa fa-edit"></i> Pages <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
						<?php
						foreach ($menuPage as $k => $v):
							?>
							<li><a href="<?=$k?>"><?=$v?></a></li>
							<?php
						endforeach;
						?>
					</ul>
				  </li>
				  <li><a><i class="fa fa-desktop"></i> Widgets <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
						<?php
						foreach ($menuWidget as $k => $v):
							?>
							<li><a href="<?=$k?>"><?=$v?></a></li>
							<?php
						endforeach;
						?>
					</ul>
					</li>
				  <li><a><i class="fa fas fa-gamepad"></i> Gaming <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
						<?php
						foreach ($menuGaming as $k => $v):
							?>
							<li><a href="<?=$k?>"><?=$v?></a></li>
							<?php
						endforeach;
						?>
					</ul>
				  </li>
				</ul>
			  </div>
			  <div class="menu_section">
				<h3>Extras</h3>
				<ul class="nav side-menu">
				  <li><a href="https://bel-cms.be"><i class="fa fa-windows"></i> Forum BEL-CMS</a></li>
				</ul>
			  </div>

			</div>
			<!-- /sidebar menu -->

			<!-- /menu footer buttons -->
			<div class="sidebar-footer hidden-small">
			  <a data-toggle="tooltip" data-placement="top" title="Settings">
				<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
			  </a>
			  <a data-toggle="tooltip" data-placement="top" title="FullScreen">
				<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
			  </a>
			  <a data-toggle="tooltip" data-placement="top" title="Lock">
				<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
			  </a>
			  <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
				<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
			  </a>
			</div>
			<!-- /menu footer buttons -->
		  </div>
		</div>


		<!-- page content -->
		<div class="right_col" role="main">
		  <div class="">
			<div class="page-title">
			  <div class="title_left">
			  	<?php
				if (defined('ADMIN_NAMEPAGE')) {
					$namepage = constant('ADMIN_NAMEPAGE');
				} else {
					$namepage = 'Management : '.CURENT_PAGE;
				}
			  	?>
				<h3><?=$namepage?></h3>
			  </div>
			</div>

			<div class="clearfix"></div>

			<div class="row">
				<?php
				echo $render;
				?>
			</div>
		  </div>
		</div>
		<!-- /page content -->

		<!-- footer content -->
		<footer>
		  <div class="pull-right">
			<a href="https://bel-cms.be">Bel-CMS</a> | Admin Template by <a href="https://colorlib.com">Colorlib</a>
		  </div>
		  <div class="clearfix"></div>
		</footer>
		<!-- /footer content -->
	  </div>
	</div>

	<!-- jQuery -->
	<script src="/managements/vendors/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="/managements/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- FastClick -->
	<script src="/managements/vendors/fastclick/lib/fastclick.js"></script>
	<!-- NProgress -->
	<script src="/managements/vendors/nprogress/nprogress.js"></script>
	<!-- Custom Theme Scripts -->
	<script src="/managements/build/js/custom.min.js"></script>
	<script src="/assets/plugins/tipped/tipped.js"></script>
	<script src="/managements/vendors/switchery/dist/switchery.min.js"></script>
	<!-- tinymce Scripts -->
	<script src="/assets/plugins/tinymce/tinymce.min.js"></script>
	<!-- custom cms Scripts -->
	<script src="/assets/plugins/belcms.core.js"></script>
  </body>
</html>