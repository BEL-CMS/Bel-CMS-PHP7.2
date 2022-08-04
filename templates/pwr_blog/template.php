<?php
$host  = "51.77.215.87";
$microTime = microtime(true);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Bel-CMS | {currentpage}</title>
	<base href="{base}">
	{css}
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#333333">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link href="https://fonts.googleapis.com/css?family=Merriweather:300,400,700" rel="stylesheet">
	<link rel="stylesheet" href="templates/pwr_blog/assets/font/css/font-awesome.min.css">
	<link rel="stylesheet" href="templates/pwr_blog/assets/css/zui.css">
</head>
<body>
<div class="theme-wrapper">
	<ul class="main-menu">
		<li><a class="ajax" href="Articles"><span>Accueil</span></a></li>
		<li><a class="" href="Forum"><span>Forum</span></a></li>
		<li><a class="" href="Downloads"><span>Téléchargements</span></a></li>
		<li><a class="" href="Members"><span>Membres</span></a></li>
		<li><a class="" href="page"><span>Articles</span></a></li>
		<li><a href="?management"><span>Administration</span></a></li>
	</ul>
	<div class="wrapper-right">
		<div class="wrapper-content-right">
			<div class="wrapper-content-right-in">

				<div class="blog-articles">
					<?php
					if (strtolower($current) == 'articles' or strtolower($current) == 'articles'):
					?>
					<div class="article-basalt short">
						<div class="article-header">
							<div class="thumbnail" style="background-image: url(templates/pwr_blog/assets/ph/a7.jpg);"></div>

							<div class="article-header-in">
								<div class="zui-section zui-space-t-30 fill-height">

									<div class="inner">
										<div id="article-title" class="title">
											<div class="article-category-label cold"><a href="https://github.com/BEL-CMS/Bel-CMS" title="Github Bel-CMS"></a> Github</div> <div class="article-category-label blue"><a href=""></a> Facebook</div>
											<p><h1>Vous chercher un site internet simple a créé, vous êtes au bon endroit.</h1></p>
											<p>Crée son site n'aie jamais été au simple avec Bel-CMS, il manque quelque chose, la création de page est simpliste ainsi que les widgets.</p>
											<p>Vous désirez le mettre dans une autre langue-là aussi, c'est facile, rien de plus facile que d'ajouter par exemple l'anglais (lang.eng.php) et le tour est joué.</p>
										</div>
									</div> <!-- .inner -->

								</div> <!-- .zui-section -->

								<!-- Section end ======================== -->
							</div>
						</div>
					</div>
					<div class="zui-section zui-space-b-30">
						<div class="inner">
							{page}
						</div>
					</div>
					<?php
					else:
					?>
					<div class="zui-section zui-space-b-30 zui-margin-b-30">
						<div class="inner">
							{page}
						</div>
					</div>
					<?php
					endif;
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="wrapper-left">
		<div class="wrapper-content-left">
			<div class="wrapper-content-left-in">
				<div class="widget">
					<div class="widget-about">
						<img src="templates/pwr_blog/assets/img/logo.png" alt="Bel-CMS-Logo">
						<p>Bienvenue sur le site <a href="https://bel-cms.dev">Bel-CMS.dev</a></p>
						<p>Une question, un sujet, une amelioration, n'hésite pas a m'en faire par sur le Forum</p>
					</div>
				</div>
				<div class="widget">
					<div class="widget-categories">
						<?php
						if (Users::isLogged() === true):
						?>
						<button onclick="location.href='User'" type="button">Profile</button>
						<button onclick="location.href='User/Logout'" type="button">Déconnexion</button>
						<?php
						else:
							?>
						<button onclick="location.href='User/register&echo'" type="button">Inscription</button>
						<button onclick="location.href='User/login&echo'" type="button">Login</button>							
							<?php
						endif;
						?>
					</div>
				<div class="widget">
					<h3 class="widget-title">Dernier Articles</h3>
					<div class="widget-categories">
						<?php
						$sql = New BDD;
						$sql->table('TABLE_PAGE');
						$sql->queryAll();
						$sql->limit(5);
						foreach ($sql->data as $k => $v) {
							$get = New BDD();
							$get->table('TABLE_PAGE_CONTENT');
							$where = array(
								'name'  => 'number',
								'value' => $v->id
							);
							$get->where($where);
							$get->count();
							$return = $get->data;
							$sql->data[$k]->count = $return;
						}
						?>
						<ul>
						<?php
						foreach ($sql->data as $k => $v):
							?>
							<li><a href="page"><?=$v->name;?><span><?=$v->count;?></span> </a></li>
							<?php
						endforeach;
						?>
						</ul>
					</div>
				</div>
			</div>
			<div class="copyright">
				Copyright &copy; 2022 <strong>Bel-CMS</strong><br>
				All rights reserved
			</div>
		</div>
	</div>
	<div class="theme-footer">
		<div class="footer-pointer"></div>
		<div class="footer-esc-tip">Appuyé <strong>Esc</strong> pour fermer.</div>
		<div class="footer-content">
			<div class="zui-section">
				<div class="inner">
					<div class="zui-grid">

						<div class="col-xs-5 col-md-4">
							<div class="widget">
								<h3 class="widget-title">Info Utilisateur</h3>
								<div class="widget">
									<ul style="color: #333333;">
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
							</div>
						</div>

						<div class="col-xs-7 col-md-4">
							<div class="widget">
								<h3 class="widget-title"></h3>
								<div class="widget">
									<?php Widgets::GetAllWidgets('top'); ?>
								</div>
							</div>
						</div>

						<div class="col-md-4 col-hide col-md-show">
							<div class="widget">
								<h3 class="widget-title">Keyboard shortcuts</h3>
								<div class="widget-shortcuts">
									<div class="zui-grid">
										<div class="col-5"><span>M</span> or <span title="Space"><i class="fa fa-window-minimize"></i></span></div>
										<div class="col-7">Open the menu</div>
									</div>
									<div class="zui-grid">
										<div class="col-5"><span>S</span> or <span>F</span></div>
										<div class="col-7">Start a search</div>
									</div>
									<div class="zui-grid">
										<div class="col-5"><span>Ctrl</span>+<span><i class="fa fa-long-arrow-up"></i></span></div>
										<div class="col-7">Open the footer</div>
									</div>
									<div class="zui-grid">
										<div class="col-5"><span>Ctrl</span>+<span><i class="fa fa-long-arrow-down"></i></span></div>
										<div class="col-7">Close the footer</div>
									</div>
									<div class="zui-grid">
										<div class="col-5"><span><i class="fa fa-long-arrow-left"></i></span> , <span><i class="fa fa-long-arrow-right"></i></span></div>
										<div class="col-7">Previous, next article</div>
									</div>
									<div class="zui-grid">
										<div class="col-5"><span>C</span></div>
										<div class="col-7">New comment</div>
									</div>
									<div class="zui-grid">
										<div class="col-5"><span>Ctrl</span>+<span><i class="fa fa-level-down fa-rotate-90"></i></span></div>
										<div class="col-7">Submit a comment</div>
									</div>
									<div class="zui-grid">
										<div class="col-5"><span>Esc</span></div>
										<div class="col-7">Cancel an action</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="the-menu-button"><i class="fa fa-bars"></i></div>
	<div class="pb-close"></div>
	<div id="general-overlay" class="general-overlay">
		<span class="general-loader"><span class="pb-loader large-dark"></span></span>
	</div>
	<div class="mobile-header">
		<div class="sidebar-expander"><i class="the-icon fa fa-ellipsis-v"></i></div>
		<div class="zui-grid grid-nowrap">
			<div class="col-auto">
				<div class="logo-block">
					<span class="pb-search-button header-round-button"><i class="the-icon fa fa-search"></i></span>
				</div>
			</div>
			<div class="col-auto flex grid-right">
				<div class="the-menu-button"><i class="fa fa-bars"></i></div>
			</div>
		</div>
	</div>
</div>
{js}
<script src="templates/pwr_blog/assets/js/perfect-scrollbar.jquery.min.js"></script>
<script src="templates/pwr_blog/assets/js/mousetrap.min.js"></script>
<script src="templates/pwr_blog/assets/js/mousetrap-global-bind.js"></script>
<script src="templates/pwr_blog/assets/js/jquery.scrollTo.min.js"></script>
<script src="templates/pwr_blog/assets/js/config.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-88923585-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-88923585-1');
</script>

</body>
</html>