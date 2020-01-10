<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<base href="{base}">
	<title>Bel-CMS | {currentpage}</title>
	{css}
	<link rel="stylesheet" href="templates/bel-cms/css/vendor/simple-line-icons.css">
	<link rel="stylesheet" href="templates/bel-cms/css/style.css">
	<link rel="icon" href="templates/bel-cms/favicon.ico">
</head>
<body>

	<!-- HEADER -->
	<div class="header-wrap">
		<header>
			<!-- LOGO -->
			<a href="index.html">
				<figure class="logo">
					<img src="templates/bel-cms/images/logo.png" alt="logo">
				</figure>
			</a>
			<!-- /LOGO -->

			<!-- MOBILE MENU HANDLER -->
			<div class="mobile-menu-handler left primary">
				<img src="templates/bel-cms/images/pull-icon.png" alt="pull-icon">
			</div>
			<!-- /MOBILE MENU HANDLER -->

			<!-- LOGO MOBILE -->
			<a href="blog">
				<figure class="logo-mobile">
					<img src="templates/bel-cms/images/logo_mobile.png" alt="logo-mobile">
				</figure>
			</a>
			<!-- /LOGO MOBILE -->

			<!-- MOBILE ACCOUNT OPTIONS HANDLER -->
			<div class="mobile-account-options-handler right secondary">
				<span class="icon-user"></span>
			</div>
			<!-- /MOBILE ACCOUNT OPTIONS HANDLER -->
			<div class="user-board">
				<div class="account-actions">
					<a href="https://github.com/BEL-CMS/Bel-CMS" class="button secondary">Github</a>
				</div>
			</div>
			<!-- /USER BOARD -->
		</header>
	</div>
	<!-- /HEADER -->

	<!-- SIDE MENU -->
	<div id="mobile-menu" class="side-menu left closed">
		<!-- SVG PLUS -->
		<svg class="svg-plus">
			<use xlink:href="#svg-plus"></use>
		</svg>
		<!-- /SVG PLUS -->

		<!-- SIDE MENU HEADER -->
		<div class="side-menu-header">
			<figure class="logo small">
				<img src="templates/bel-cms/images/logo.png" alt="logo">
			</figure>
		</div>
		<!-- /SIDE MENU HEADER -->

		<!-- SIDE MENU TITLE -->
		<p class="side-menu-title">Main Links</p>
		<!-- /SIDE MENU TITLE -->

		<!-- DROPDOWN -->
		<ul class="dropdown dark hover-effect interactive">
			<!-- DROPDOWN ITEM -->
			<li class="dropdown-item">
				<a href="index.html">Home</a>
			</li>
			<!-- /DROPDOWN ITEM -->

			<!-- DROPDOWN ITEM -->
			<li class="dropdown-item">
				<a href="Forum.html">Forum</a>
			</li>
			<!-- /DROPDOWN ITEM -->

			<!-- DROPDOWN ITEM -->
			<li class="dropdown-item">
				<a href="downloads.html">Téléchargemnt</a>
			</li>
			<!-- /DROPDOWN ITEM -->
		</ul>
		<!-- /DROPDOWN -->
	</div>
	<!-- /SIDE MENU -->

	<!-- SIDE MENU -->
	<div id="account-options-menu" class="side-menu right closed">
		<!-- SVG PLUS -->
		<svg class="svg-plus">
			<use xlink:href="#svg-plus"></use>
		</svg>

		<div class="side-menu-header">
			<div class="user-quickview">
				<a href="author-profile.html">
				<div class="outer-ring">
					<div class="inner-ring"></div>
					<figure class="user-avatar">
						<img src="<?=Users::getUserName(false);?>" alt="avatar">
					</figure>
				</div>
				</a>
				<p class="user-name"><?=Users::getUserName();?></p>
			</div>
		</div>
		<p class="side-menu-title">Your Account</p>
		<ul class="dropdown dark hover-effect">
			<li class="dropdown-item">
				<a href="inbox">Messages</a>
			</li>
		</ul>
		<p class="side-menu-title">Dashboard</p>
		<ul class="dropdown dark hover-effect">
			<li class="dropdown-item">
				<a href="User/profil">Profile Page</a>
			</li>
			<li class="dropdown-item">
				<a href="user/profil">Account Settings</a>
			</li>
			<li class="dropdown-item">
				<a href="?management">Management</a>
			</li>
		</ul>
		<a href="#" class="button medium secondary">Logout</a>
		<a href="#" class="button medium primary">Become a Seller</a>
	</div>
	<!-- MAIN MENU -->
	<div class="main-menu-wrap">
		<div class="menu-bar">
			<nav>
				<ul class="main-menu">
					<!-- MENU ITEM -->
					<li class="menu-item">
						<a href="Home">Accueil</a>
					</li>
					<!-- /MENU ITEM -->

					<!-- MENU ITEM -->
					<li class="menu-item">
						<a href="Forum">Forum</a>
					</li>
					<!-- /MENU ITEM -->

					<!-- MENU ITEM -->
					<li class="menu-item">
						<a href="Downloads">Téléchargements</a>
					</li>
					<!-- /MENU ITEM -->
				</ul>
			</nav>
			<form class="search-form">
				<input type="text" class="rounded" name="search" id="search_products" placeholder="Search products here...">
				<input type="image" src="templates/bel-cms/images/search-icon.png" alt="search-icon">
			</form>
		</div>
	</div>
	<!-- /MAIN MENU -->

	<!-- SECTION HEADLINE -->
	<div class="section-headline-wrap">
		<div class="section-headline">
			<h2>{currentpage}</h2>
			<p>Home<span class="separator">/</span><span class="current-section">{currentpage}</span></p>
		</div>
	</div>
	<!-- /SECTION HEADLINE -->

	<!-- SECTION -->
	<div class="section-wrap">
		<div class="section">
			<?php
			if ($tpl_full === true):
			?>
			<div style="width: 100% !important;" class="content">
				{page}
			</div>
			<?php
			else:
			?>
			<div class="content left">
				{page}
			</div>
			<div class="sidebar right">
				<?php Widgets::GetAllWidgets('left'); ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
	<!-- /SECTION -->

	<!-- FOOTER -->
	<footer>
		<!-- FOOTER TOP -->
		<!--
		<div id="footer-top-wrap">
			<div id="footer-top">
				<div class="company-info">
					<p>Lorem ipsum dolor sit amet, consectetur isicing elit, sed do eiusmod tempor incididunt ut labo dolore magna ua.</p>
					<ul class="company-info-list">
						<li class="company-info-item">
							<span class="icon-present"></span>
							<p><span>0</span> Dons</p>
						</li>
						<li class="company-info-item">
							<span class="icon-user"></span>
							<p><span>1.207.300</span> Members</p>
						</li>
						<li class="company-info-item">
							<span class="icon-energy"></span>
							<p><span>74.059</span> Téléchargemnts</p>
						</li>
					</ul>
					<ul class="social-links">
						<li class="social-link fb">
							<a href="#"></a>
						</li>
						<li class="social-link twt">
							<a href="#"></a>
						</li>
						<li class="social-link db">
							<a href="#"></a>
						</li>
						<li class="social-link rss">
							<a href="#"></a>
						</li>
					</ul>
				</div>

				<div class="link-info">
					<p class="footer-title">Our Community</p>
					<ul class="link-list">
						<li class="link-item">
							<div class="bullet"></div>
							<a href="#">How to Join us</a>
						</li>
						<li class="link-item">
							<div class="bullet"></div>
							<a href="#">Buying and Selling</a>
						</li>
						<li class="link-item">
							<div class="bullet"></div>
							<a href="forum.html">Emerald Forum</a>
						</li>
						<li class="link-item">
							<div class="bullet"></div>
							<a href="blog-v1.html">Emerald Blog</a>
						</li>
						<li class="link-item">
							<div class="bullet"></div>
							<a href="#">Free Goods</a>
						</li>
						<li class="link-item">
							<div class="bullet"></div>
							<a href="#">Job Oportunities</a>
						</li>
					</ul>
				</div>

				<div class="link-info">
					<p class="footer-title">Member Links</p>
					<ul class="link-list">
						<li class="link-item">
							<div class="bullet"></div>
							<a href="#">Partner Program</a>
						</li>
						<li class="link-item">
							<div class="bullet"></div>
							<a href="#">Starting a Shop</a>
						</li>
						<li class="link-item">
							<div class="bullet"></div>
							<a href="#">Purchase Credits</a>
						</li>
						<li class="link-item">
							<div class="bullet"></div>
							<a href="#">Withdrawals</a>
						</li>
						<li class="link-item">
							<div class="bullet"></div>
							<a href="#">World Meetings</a>
						</li>
						<li class="link-item">
							<div class="bullet"></div>
							<a href="#">How to Auction</a>
						</li>
					</ul>
				</div>

				<div class="link-info">
					<p class="footer-title">Help and FAQs</p>
					<ul class="link-list">
						<li class="link-item">
							<div class="bullet"></div>
							<a href="#">Help Center</a>
						</li>
						<li class="link-item">
							<div class="bullet"></div>
							<a href="#">FAQs</a>
						</li>
						<li class="link-item">
							<div class="bullet"></div>
							<a href="#">Terms and Conditions</a>
						</li>
						<li class="link-item">
							<div class="bullet"></div>
							<a href="#">Products Licenses</a>
						</li>
						<li class="link-item">
							<div class="bullet"></div>
							<a href="#">Security Information</a>
						</li>
					</ul>
				</div>

				<div class="twitter-feed">
					<p class="footer-title">Twitter Feed</p>
					<ul class="tweets"></ul>
				</div>
			</div>
		</div>
		-->
		<!-- /FOOTER TOP -->

		<!-- FOOTER BOTTOM -->
		<div id="footer-bottom-wrap">
			<div id="footer-bottom">
				<p><span>&copy;</span><a href="https://bel-cms.be">Bel-CMS</a></p>
			</div>
		</div>
		<!-- /FOOTER BOTTOM -->
	</footer>
	<!-- /FOOTER -->

	<div class="shadow-film closed"></div>

<!-- SVG ARROW -->
<svg style="display: none;">	
	<symbol id="svg-arrow" viewBox="0 0 3.923 6.64014" preserveAspectRatio="xMinYMin meet">
		<path d="M3.711,2.92L0.994,0.202c-0.215-0.213-0.562-0.213-0.776,0c-0.215,0.215-0.215,0.562,0,0.777l2.329,2.329
			L0.217,5.638c-0.215,0.215-0.214,0.562,0,0.776c0.214,0.214,0.562,0.215,0.776,0l2.717-2.718C3.925,3.482,3.925,3.135,3.711,2.92z"/>
	</symbol>
</svg>
<!-- /SVG ARROW -->

<!-- SVG STAR -->
<svg style="display: none;">
	<symbol id="svg-star" viewBox="0 0 10 10" preserveAspectRatio="xMinYMin meet">	
		<polygon points="4.994,0.249 6.538,3.376 9.99,3.878 7.492,6.313 8.082,9.751 4.994,8.129 1.907,9.751 
	2.495,6.313 -0.002,3.878 3.45,3.376 "/>
	</symbol>
</svg>
<!-- /SVG STAR -->

<!-- SVG PLUS -->
<svg style="display: none;">
	<symbol id="svg-plus" viewBox="0 0 13 13" preserveAspectRatio="xMinYMin meet">
		<rect x="5" width="3" height="13"/>
		<rect y="5" width="13" height="3"/>
	</symbol>
</svg>
<!-- /SVG PLUS -->

<!-- jQuery -->
{js}
<!-- Tweet -->
<script src="templates/bel-cms/js/vendor/twitter/jquery.tweet.min.js"></script>
<!-- Side Menu -->
<script src="templates/bel-cms/js/side-menu.js"></script>
<!-- User Quickview Dropdown -->
<script src="templates/bel-cms/js/user-board.js"></script>
<!-- Footer -->
<script src="templates/bel-cms/js/footer.js"></script>
</body>
</html>