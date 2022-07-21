<!doctype html>
<html lang="fr">
	<head>
        <base href="{base}">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Bel-CMS | Default template</title>
		{css}
		<link rel="stylesheet" href="/assets/template/default/css/styles.css">
		<link rel="stylesheet" href="/assets/template/default/css/blue.css">
	</head>
	<body>
		<!-- Top Bar Menu -->
		<nav id="bel_cms-top_bar">
			<ul class="bel_cms_content">
				<li><a href="Blog">Home</a></li>
				<li><a href="Forum">Forum</a></li>
				<li><a href="Team">Team</a></li>
				<li><a href="inbox">Inbox</a></li>
				<li><a href="User"><i class="fas fa-user-tie"></i> User</a></li>
			</ul>
		</nav>
		<!-- / Top Bar Menu -->
		<!-- Main Menu -->
		<nav id="bel_cms-main_menu">
			<div class="bel_cms_content">
				<h1>Bel-CMS | Default template</h1>
			</div>
		</nav>
		<!-- / Main Menu -->
		<!-- Main Content -->
		<div class="bel_cms_content">
			<!-- Main Content left -->
			<div class="bel_cms_content_left">
				<?php Widgets::GetAllWidgets('top'); ?>
				{page}
			</div>
			<!-- / Main Content left -->
			<!-- Aside -->
			<aside class="bel_cms_content_right">
				<?php Widgets::GetAllWidgets('left'); ?>
				<div class="bel_cms_widgets">
					<div class="bel_cms_widgets_title"><h3>FaceBook</h3></div>
					<div class="bel_cms_widgets_pattern"></div>
					<div class="bel_cms_widgets_content">
						<div id="fb-root"></div>
						<script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v4.0"></script>
						<div class="fb-page" data-href="https://www.facebook.com/Bel.CMS/" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Bel.CMS/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Bel.CMS/">Bel-c.m.s</a></blockquote></div>
					</div>
				</div>
			</aside>
			<!-- / Aside -->
		</div>
		<!-- / Main Content -->
		<!-- Footer -->
		<footer id="footer">
			<div class="bel_cms_content">
				<span>Copyright 2019 > <?=(date('Y'))?> | By <a href="https://bel-cms.dev">Bel-CMS</a></span>
		</footer>
		<!-- / Footer -->
		{js}
		<script src="assets/template/default/js/scripts.js"></script>
	</body>
</html>