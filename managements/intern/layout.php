<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="@Stive">
		<!-- Title -->
		<title>Bel-CMS Management</title>
		<!-- Styles -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
		<link href="/managements/assets/bootstrap-3.3.7/bootstrap.min.css" rel="stylesheet">
		<link href="/assets/plugins/fontawesome-5.4.2/css/all.min.css" rel="stylesheet">
		<link href="/assets/plugins/icomoon/style.css" rel="stylesheet">

		<link href="/managements/assets/waves/waves.min.css" rel="stylesheet">
		<link href="/managements/assets/uniform/css/default.css" rel="stylesheet">
		<link href="/managements/assets/switchery/switchery.min.css" rel="stylesheet">
		<!-- Data Tables -->
        <link href="/managements/assets/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css"/>	
        <link href="/managements/assets/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css"/>	
		<!-- Theme Styles -->
		<link href="/managements/assets/metrotheme.min.css" rel="stylesheet">
		<link href="/managements/assets/nv.d3.min.css" rel="stylesheet"> 
		<!-- BEL CMS Styles -->
		<link href="/assets/styles/belcms.global.css" rel="stylesheet">
		<link href="/assets/styles/belcms.notification.css" rel="stylesheet">
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		
		<!-- Page Container -->
		<div class="page-container">
			<!-- Page Sidebar -->
			<div class="page-sidebar">
				<a class="logo-box" href="https://bel-cms.be"><span>Bel-CMS</span><i class="icon-radio_button_unchecked" id="fixed-sidebar-toggle-button"></i>
					<i class="icon-close" id="sidebar-toggle-button-close"></i></a>
				<div class="page-sidebar-inner">
					<div class="page-sidebar-menu">
						<ul class="accordion-menu">
							<li class="active-page">
								<a href="Dashboard?management">
									<i class="menu-icon icon-home4"></i><span>Dashboard</span>
								</a>
							</li>
							<li>
								<a href="javascript:void(0);">
									<i class="menu-icon icon-file-text"></i><span>Pages</span><i class="accordion-icon fa fa-angle-left"></i>
								</a>
								<ul class="sub-menu">
									<?php
									foreach ($menuPage as $k => $v):
										?>
										<li><a href="<?=$k?>"><?=$v?></a></li>
										<?php
									endforeach;
									?>
								</ul>
							</li>
							<li>
								<a href="javascript:void(0);">
									<i class="menu-icon icon-layers"></i><span>Widgets</span><i class="accordion-icon fa fa-angle-left"></i>
								</a>
								<ul class="sub-menu">
									<li><a href="layout-blank.html" class="active">Blank Page</a></li>
								</ul>
							</li>
							<li class="menu-divider"></li>
							<li>
								<a href="https://bel-cms.be">
									<i class="menu-icon icon-help_outline"></i><span>Documentation</span>
								</a>
							</li>
							<li>
								<a href="#">
									<i class="menu-icon icon-public"></i><span>Version</span><span class="label label-danger">1.0.0</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div><!-- /Page Sidebar -->
			
			<!-- Page Content -->
			<div class="page-content">
			
				<!-- Page Header -->
				<div class="page-header">
					<nav class="navbar navbar-default">
						<div class="container-fluid">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
								<div class="logo-sm">
									<a href="javascript:void(0)" id="sidebar-toggle-button"><i class="fa fa-bars"></i></a>
									<a class="logo-box" href="https://bel-cms.be"><span>Bel-CMS</span></a>
								</div>
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
									<i class="fa fa-angle-down"></i>
								</button>
							</div>
						
							<!-- Collect the nav links, forms, and other content for toggling -->
						
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								<ul class="nav navbar-nav">
									<li class="collapsed-sidebar-toggle-inv"><a href="javascript:void(0)" id="collapsed-sidebar-toggle-button"><i class="fa fa-bars"></i></a></li>
									<li><a href="javascript:void(0)" id="toggle-fullscreen"><i class="fa fa-expand"></i></a></li>
								</ul>
								<ul class="nav navbar-nav navbar-right">
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="/managements/images/avatars/avatar1.png" alt="" class="img-circle"></a>
									</li>
								</ul>
							</div><!-- /.navbar-collapse -->
						</div><!-- /.container-fluid -->
					</nav>
				</div><!-- /Page Header -->
				<!-- Page Inner -->
				<div class="page-inner">
					<div id="main-wrapper">
						<div class="row">
							<?php
							echo $render;
							?>
						</div><!-- Row -->
					</div><!-- Main Wrapper -->
					<div class="page-footer">
						Propuslé par <a href="https://bel-cms.be">Bel-CMS</a>
					</div>
				</div><!-- /Page Inner -->

			</div><!-- /Page Content -->
		</div><!-- /Page Container -->
		
		
		<!-- Javascripts -->
		<script src="/assets/plugins/jquery-3.3.1/jquery-3.3.1.min.js"></script>
		<script src="/managements/assets/bootstrap-3.3.7/bootstrap.min.js"></script>
		<script src="/assets/plugins/slimscroll-1.3.8/jquery.slimscroll.min.js"></script>
		<script src="/managements/assets/waves/waves.min.js"></script>
		<script src="/managements/assets/uniform/js/jquery.uniform.standalone.js"></script>
		<script src="/managements/assets/switchery/switchery.min.js"></script>
		<script src="/managements/assets/datatables/js/jquery.datatables.min.js"></script>
		<script src="/managements/assets/metrotheme.min.js"></script>
	</body>
</html>