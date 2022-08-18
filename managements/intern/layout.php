<!DOCTYPE html>
<html lang="FR-fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex, nofollow">
	<title>Administration</title>
	<script type="text/javascript">
		document.onreadystatechange = function() {
			if (document.readyState != "complete") {
				document.querySelector("body").style.visibility = "hidden";
				document.querySelector("#loading").style.visibility = "visible";
			}  else  {
				document.querySelector("#loading").style.display = "none";
				document.querySelector("body").style.visibility = "visible";
			}
		};
	</script>
	<link rel="stylesheet" href="/assets/styles/belcms.global.css">
	<link rel="stylesheet" href="/assets/plugins/loading/loading.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link rel="stylesheet" href="/assets/plugins/fontawesome-6.1.1/css/all.min.css">
	<link rel="stylesheet" href="/assets/plugins/DataTables-1.10.22/datatables.min.css">
	<link rel="stylesheet" href="/managements/asset/css/adminlte.min.css">
	<link rel="stylesheet" href="/assets/plugins/colorpicker/css/bootstrap-colorpicker.min.css">
	<link rel="stylesheet" href="/assets/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css">
	<link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<link rel="stylesheet" href="/assets/styles/belcms.notification.css">
	<link rel="stylesheet" href="/managements/css/simple-line-icons.css">
	<link rel="stylesheet" href="/managements/asset/css/magnific-popup.css">
	<link rel="stylesheet" href="/managements/asset/css/quick-events.css">
	<!-- Include css files -->
	<link rel="stylesheet" href="/managements/asset/css/simple-line-icons.css">
	<link rel="stylesheet" href="/managements/asset/css/demo.css">
	<link href="https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i&display=swap&subset=cyrillic" rel="stylesheet">
	</head>
	<body class="hold-transition sidebar-mini">
		<div id="loading">
		  <div><img src="/assets/images/loader_7.gif"><p><?=DOWNLOADS_IS_PROGRESS;?></p></div>
		</div>
		<div class="wrapper">
		  <aside class="main-sidebar sidebar-dark-primary elevation-4">
			<div class="sidebar">
			  <div class="user-panel mt-3 mb-3 d-flex">
			  <nav>
				<ul class="nav nav-pills nav-sidebar flex-column">
				  <li class="nav-item" style="text-align: center;">
					<a href="https://bel-cms.dev" class="nav-link">
						<img style="width:140px; height: 90px;" src="/managements/asset/img/logo.png">
						<div class="clear"></div>
					  	<p>Bel-CMS</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="\index.php" class="nav-link">
					  <p><?=BACK_TO_WEBSITE;?></p>
					  <i style="float: right" class="fa-solid fa-arrow-right-arrow-left"></i>
					</a>
				  </li>
				</ul>
			  </div>
			  <nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				  <li class="nav-item">
					<a href="index?management" class="nav-link active">
					  <i class="nav-icon fas fa-tachometer-alt"></i>
					  <p><?=HOME;?></p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="#" class="nav-link">
					  <i class="fa-solid fa-gears"></i>
					  <p><?=PARAMETERS;?></p>
					  <i class="right fas fa-angle-left"></i>
					</a>
					<ul class="nav nav-treeview">
					  <?php
					  foreach ($menuParameter as $k => $v):
						  ?>
						  <li class="nav-item">
							<a class="nav-link" href="<?=$k?>">
								<i class="right fas fa-angle-left"></i>
								<p><?=ucfirst($v)?></p>
							</a>
						  </li>
						  <?php
					  endforeach;
					  ?>
					</ul>
				  </li>
				  <li class="nav-item">
					<a href="#" class="nav-link">
					  <i class="fa-solid fa-arrows-turn-to-dots"></i>
					  <p><?=TEMPLATES?></p>
					  <i class="right fas fa-angle-left"></i>
					</a>
					<ul class="nav nav-treeview">
					  <?php
					  foreach ($menuTemplates as $k => $v):
						  ?>
						  <li class="nav-item">
							<a class="nav-link" href="<?=$k?>">
								<i class="right fas fa-angle-left"></i>
								<p><?=ucfirst($v)?></p>
							</a>
						  </li>
						  <?php
					  endforeach;
					  ?>
					</ul>
				  </li>
				  <li class="nav-item">
					<a href="#" class="nav-link">
					  <i class="fa-solid fa-user-gear"></i>
					  <p><?=USERS;?></p>
					  <i class="right fas fa-angle-left"></i>
					</a>
					<ul class="nav nav-treeview">
					  <?php
					  foreach ($menuUsers as $k => $v):
						  ?>
						  <li class="nav-item">
							<a class="nav-link" href="<?=$k?>">
								<i class="right fas fa-angle-left"></i>
								<p><?=ucfirst($v)?></p>
							</a>
						  </li>
						  <?php
					  endforeach;
					  ?>
					</ul>
				  </li>
				  <li class="nav-item">
					<a href="#" class="nav-link">
					  <i class="fa-solid fa-paperclip"></i>
					  <p><?=PAGES;?></p>
					  <i class="right fas fa-angle-left"></i>
					</a>
					<ul class="nav nav-treeview">
					  <?php
					  foreach ($menuPage as $k => $v):
						  ?>
						  <li class="nav-item">
							<a class="nav-link" href="<?=$k?>">
								<i class="right fas fa-angle-left"></i>
								<p><?=ucfirst($v)?></p>
							</a>
						  </li>
						  <?php
					  endforeach;
					  ?>
					</ul>
				  </li>
				  <li class="nav-item">
					<a href="#" class="nav-link">
					  <i class="fa-solid fa-cubes"></i>
					  <p><?=WIDGETS;?></p>
					  <i class="right fas fa-angle-left"></i>
					</a>
					<ul class="nav nav-treeview">
					  <?php
					  foreach ($menuWidget as $k => $v):
						  ?>
						  <li class="nav-item">
							<a class="nav-link" href="<?=$k?>">
								<i class="right fas fa-angle-left"></i>
								<p><?=$v?></p>
							</a>
						  </li>
						  <?php
					  endforeach;
					  ?>
					</ul>
				  </li> 
				  <li class="nav-item">
					<a href="#" class="nav-link">
					  <i class="fa-solid fa-gamepad"></i>
					  <p><?=GAMINGS;?></p>
					  <i class="right fas fa-angle-left"></i>
					</a>
					<ul class="nav nav-treeview">
					  <?php
					  foreach ($menuGaming as $k => $v):
						  ?>
						  <li class="nav-item">
							<a class="nav-link" href="<?=$k?>">
								<i class="right fas fa-angle-left"></i>
								<p><?=$v?></p>
							</a>
						  </li>
						  <?php
					  endforeach;
					  ?>
					</ul>
				  </li>      
				</ul>
			  </nav>
			</div>
		  </aside>
		  <div class="content-wrapper">
			<section class="content">
			  <div class="container-fluid">
				<div class="row">
				  <div class="col-12">
				  <?=$render;?>
				  </div>
				</div>
			  </div>
			</section>
		  </div>
		  <footer class="main-footer">
			<div class="float-right d-none d-sm-block">
			  <b>Version</b> <?=VERSION_CMS?>
			</div>
			<strong>Copyright &copy; <a href="https://bel-cms.be">Bel-CMS</a> - <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
		  </footer>
		</div>
		<a class="back-to-top"><i class="fa-arrow-up"></i></a>
		<script src="/assets/plugins/jquery-3.3.1/jquery-3.3.1.min.js" type="text/javascript"></script>
		<script src="/assets/plugins/bootstrap-4.1.3/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
		<script src="/asset/plugins/calendar_lang/calendar.js"></script>
		<script src="/pages/events/js/javascripts.js"></script>
		<script src="/assets/plugins/colorpicker/js/bootstrap-colorpicker.min.js" type="text/javascript"></script>
		<script src="/assets/plugins/tinymce/tinymce.min.js" type="text/javascript"></script>
		<script src="/managements/asset/js/adminlte.min.js" type="text/javascript"></script>
		<script src="/assets/plugins/DataTables-1.10.22/datatables.min.js" type="text/javascript"></script>
		<script src="/managements/assets/plugins/tinymce/tinymce.min.js" type="text/javascript"></script>
		<script src="/assets/plugins/belcms.core.js" type="text/javascript"></script>
		<script src="/managements/asset/js/lang.js"></script>
		<script src="/managements/asset/js/jquery.min.js"></script>
		<script src="/managements/asset/js/jquery.magnific-popup.js"></script>
		<script src="/managements/asset/js/quick-events.js"></script>
		<script src="/managements/asset/js/demo.js"></script>
		<script type="text/javascript">
		$(function () {
			$("input[data-bootstrap-switch]").each(function(){
				$(this).bootstrapSwitch('state', $(this).prop('checked')); 
			});
		});
		</script>
	</body>
</html>
