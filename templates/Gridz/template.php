<?php
$host  = "51.77.215.87";
$microTime = microtime(true);
$blog      = null;
$downloads = null;
$forum     = null;
$members   = null;
$gallery   = null;
$page      = null;

switch (strtolower(utf8_decode($this->currentpage))) {
	case 'blog':
		$blog = 'menu-active';
	break;

	case 'téléchargements':
		$downloads = 'menu-active';
	break;

	case 'forum':
		$forum = 'menu-active';
	break;

	case 'membres':
		$members = 'menu-active';
	break;

	case 'gallery':
		$gallery = 'menu-active';
	break;

	case 'page':
		$page = 'menu-active';
	break;

	default:
		$blog = 'active';
	break;
}
?>
<!DOCTYPE HTML>
<html lang="fr-fr" dir="ltr">
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>Bel-CMS | {currentpage}</title>
<base href="{base}">
{css}
<link href="templates/Gridz/css/style.css" rel="stylesheet" type="text/css">
<link href="templates/Gridz/css/hover.css" rel="stylesheet" type="text/css">
<link href="templates/Gridz/css/button.css" rel="stylesheet" type="text/css">
<link href="templates/Gridz/css/form.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="template/Gridz/css/prism.css">
<link href="templates/Gridz/css/responsive.css" rel="stylesheet" type="text/css">
<link href="templates/Gridz/layerslider/css/layerslider.css" rel="stylesheet" type="text/css">
<link href="templates/Gridz/css/prettyPhoto.css" rel="stylesheet" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800|Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
<!--[if lte IE 8]>
<meta HTTP-EQUIV="REFRESH" content="0; url=lte-ie8.html">
<![endif]-->
</head>
<body>
	<header class="header-section">
		<nav class="main-menu">
			<ul>
				<li class="<?=$blog;?>"><a href="Blog">Accueil</a><div class="hover-active"></div></li>
				<li class="<?=$forum;?>"><a href="Forum">Forums</a><div class="hover-active"></div></li>
				<?php
				if (Users::isLogged()) {
					?>
				<li><a href="?admin">Administration</a><div class="hover-active"></div></li>
					<?php
				}
				?>
			</ul>
		</nav>
		
		<div id="navbtn">
			<a href="#">
				<img src="templates/Gridz/images/hide-menu.png" alt="responsive menu" />
			</a>
		</div>
		
		<div class="logo">
			<a href="Blog"><img src="templates/Gridz/images/logo.png" alt="logo" /></a>
		</div>
		
	</header>
	
	<div class="wrapper">
		<section class="page-header">
			<div class="content">
				
				<!--Title Start-->
				<div class="header-title">
					<h1>{currentpage}</h1>
				</div>
				<nav class="page-navigation">
					<ul>
						<li><a href="Blog">Home</a></li>
						<li><a href="{currentpage}">{currentpage}</a></li>
					</ul>
				</nav>
				
			</div>
		</section>

		<?php
		if ($tpl_full !== true):
		?>	
		<section class="container blog">
			<div class="blog-content">
				{page}
			</div>
			<aside class="sidebar">
				<?php Widgets::GetAllWidgets('right'); ?>
			</aside>
		</section>
		<?php
		else:
		?>
		<section class="container">
			{page}
		<?php
		endif;
		?>
		</section>
	</div>
	
	<div class="clearfix"></div>
	
	<footer class="footer-section">
			<section class="footer-about">
			<div class="footer-content">
				<div class="footer-text">
				</div>
			</div>
		</section>
		<section class="footer-contact">
			<h2 class="footer-title">CONTACT INFO</h2>
			<div class="footer-content">
				<ul>
					<li>
						<div class="contact-list footer-text">
							<span>Company Name<br>Bel-CMS</span>
						</div>
					</li>
					<li>
						<div class="contact-list footer-text email">
							<span>Email: admin@bel-cms.dev</span>
						</div>
					</li>
				</ul>
			</div>
		</section>
		<section class="footer-subscribe">
			<h2 class="footer-title">SERVEUR</h2>
			<div class="footer-content">
							<ul>
								<li>Votre IP : <span style="float: right;"><?= Common::GetIp();?></span>
								<li>Port : <span style="float: right;"><?=$_SERVER['SERVER_PORT'];?></span></li>
								<li>Chargement : 
									<span style="float: right;">
										<?php
										$time = (microtime(true) - $microTime);
										echo round($time, 3);
										?> Secondes
									</span>
								</li>
								<?php $seconds = time(); $rounded_seconds = round($seconds / (15 * 60)) * (15 * 60); ?>
								<li>Heure :<span style="float: right;"><?=date('H:i', $seconds);?></span></li>
								<?php
									if ($_SERVER['SERVER_PORT'] == '80'):
										?>
										<li>Certificats SSL
											<span style="float: right;">
												<i style="color: red;" class="fa-solid fa-circle"></i>
											</span>
										</li>
										<?php
									else:
									?>
										<li>Certificats SSL
											<span style="float: right;">
												<i style="color: green;" class="fa-solid fa-circle"></i>
											</span>
										</li>
									<?php
									endif;
								?>
								<hr>
							</ul>
			</div>
		</section>
		<div class="clearfix"></div>
		<section class="footer-bottom">
			<div class="copyright">
				Copyright © All Rights Reserved. <a href="https://bel-cms.dev">Bel-CMS</a>
			</div>
		</section>
		<a href="#" class="back-to-top"></a>
		
	</footer>

<script src="templates/Gridz/js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript" charset="utf-8" src="templates/Gridz/js/menu.js"></script>

<!--Placeholder Script-->
<script src="templates/Gridz/js/placeholder.js" type="text/javascript"></script>
<script type="text/javascript">
$.fn.placeholder();
</script>

<!--PrettyPhoto Script-->
<script src="templates/Gridz/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" charset="utf-8">

	// Checking for Retina Devices
	function isRetina() {
		var query = '(-webkit-min-device-pixel-ratio: 1.5),\
		(min--moz-device-pixel-ratio: 1.5),\
		(-o-min-device-pixel-ratio: 3/2),\
		(min-device-pixel-ratio: 1.5),\
		(min-resolution: 144dpi),\
		(min-resolution: 1.5dppx)';
	
		if (window.devicePixelRatio > 1 || (window.matchMedia && window.matchMedia(query).matches)) {
			return true;
		}
		return false;
	}

$(document).ready(function(){
	"use strict";
	
	// Add class for retina display
	var retinaElement = "#navbtn img, .social-main ul li img, .footer-about figure img, .service-icon img, .box-title .icon img, #social-share a img"
	$(retinaElement).addClass("retinaImg");
	
		// Replace images with @2x
		$(window).on("load", function() {
			$(".retinaImg").each(function() {
				var itemWidth = $(this).width();
				setTimeout(function(){
					if (window.isRetina()) {
						var images = document.getElementsByClassName("retinaImg");
						for (var i = 0, j = images.length; i < j; i++) {
							var image = images[i],
							src = image.src,
							lastSlash = src.lastIndexOf('/'),
							path = src.substring(0, lastSlash),
							file = src.substring(lastSlash + 1),
							retinaSrc = 'images/@2x/' + file;
							image.src = retinaSrc;
						}
					}
				}, 1000);
				var hiResWidth = itemWidth * 2;
				$(this).width(hiResWidth / 2);
			});
		});
	
	// Pretty Photo Settings
	$("a[rel^='prettyPhoto']").prettyPhoto();
	
	// GO TO TOP SETTING
		var offset = 220;
		var duration = 500;
		jQuery(window).scroll(function() {
			if (jQuery(this).scrollTop() > offset) {
				jQuery('.back-to-top').fadeIn(duration);
			} else {
				jQuery('.back-to-top').fadeOut(duration);
			}
		});
		
		jQuery('.back-to-top').click(function(event) {
			event.preventDefault();
			jQuery('html, body').animate({scrollTop: 0}, duration);
			return false;
		})
});
</script>
<script type="text/javascript" src="templates/Gridz/css/prism.js"></script>
<script type="text/javascript"></script>
{js}
</body>
</html>
