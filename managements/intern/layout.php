<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="fr"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="fr"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title><?=CMS_WEBSITE_NAME?> - Managements</title>
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">
        <link rel="shortcut icon" href="/managements/assets/img/favicon.png">
        <link rel="apple-touch-icon" href="/managements/assets/img/icon57.png" sizes="57x57">
        <link rel="apple-touch-icon" href="/managements/assets/img/icon72.png" sizes="72x72">
        <link rel="apple-touch-icon" href="/managements/assets/img/icon76.png" sizes="76x76">
        <link rel="apple-touch-icon" href="/managements/assets/img/icon114.png" sizes="114x114">
        <link rel="apple-touch-icon" href="/managements/assets/img/icon120.png" sizes="120x120">
        <link rel="apple-touch-icon" href="/managements/assets/img/icon144.png" sizes="144x144">
        <link rel="apple-touch-icon" href="/managements/assets/img/icon152.png" sizes="152x152">
        <link rel="apple-touch-icon" href="/managements/assets/img/icon180.png" sizes="180x180">
        <link rel="stylesheet" href="/assets/styles/belcms.notification.css">
        <link rel="stylesheet" href="/managements/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="/managements/assets/css/plugins.css">
        <link rel="stylesheet" href="/managements/assets/css/main.css">
        <link rel="stylesheet" href="/managements/assets/css/themes.css">
        <script src="/managements/assets/js/vendor/modernizr.min.js"></script>
    </head>
    <body>
        <div id="page-wrapper">
            <div class="preloader themed-background">
                <h1 class="push-top-bottom text-light text-center"><strong>Bel</strong>CMS</h1>
                <div class="inner">
                    <h3 class="text-light visible-lt-ie9 visible-lt-ie10"><strong>Loading..</strong></h3>
                    <div class="preloader-spinner hidden-lt-ie9 hidden-lt-ie10"></div>
                </div>
            </div>
            <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">
                <div id="sidebar">
                    <div id="sidebar-scroll">
                        <div class="sidebar-content">
                            <a href="index.html" class="sidebar-brand">
                                <i class="gi gi-flash"></i><span class="sidebar-nav-mini-hide"><?=CMS_WEBSITE_NAME?></span>
                            </a>

                            <div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
                                <div class="sidebar-user-avatar">
                                    <a href="index.html">
                                        <img src="<?=Users::hashkeyToUsernameAvatar($_SESSION['USER']['HASH_KEY'], 'avatar')?>" alt="avatar">
                                    </a>
                                </div>
                                <div class="sidebar-user-name"><?=Users::hashkeyToUsernameAvatar($_SESSION['USER']['HASH_KEY'])?></div>
                                <div class="sidebar-user-links">
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="Profile"><i class="gi gi-user"></i></a>
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="Messages"><i class="gi gi-envelope"></i></a>
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="Settings"><i class="gi gi-cogwheel"></i></a>
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="Logout"><i class="gi gi-exit"></i></a>
                                </div>
                            </div>

                            <ul class="sidebar-nav">
                                <li>
                                    <a href="?management" class=" active"><i class="gi gi-stopwatch sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Dashboard</span></a>
                                </li>
                                <li>
                                    <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-cogwheel sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Paramètres</span></a>
                                    <ul>
                                        <?php
                                        foreach ($menuParameter as $k => $v):
                                            ?>
                                            <li aria-haspopup="true"><a href="<?=$k?>"><?=$v?></a></li>
                                            <?php
                                        endforeach;
                                        ?>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-cogwheel sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Pages</span></a>
                                    <ul>
                                        <?php
                                        foreach ($menuPage as $k => $v):
                                            ?>
                                            <li aria-haspopup="true"><a href="<?=$k?>"><?=$v?></a></li>
                                            <?php
                                        endforeach;
                                        ?>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-cogwheel sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Widgets</span></a>
                                    <ul>
                                        <?php
                                        foreach ($menuWidget as $k => $v):
                                            ?>
                                            <li aria-haspopup="true"><a href="<?=$k?>"><?=$v?></a></li>
                                            <?php
                                        endforeach;
                                        ?>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-cogwheel sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Gaming</span></a>
                                    <ul>
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

                        </div>

                    </div>

                </div>

                <div id="main-container">
					<?php
                    echo $render;
                    ?>
                </div>
                <footer class="clearfix">
                    <div class="pull-right">
                        Propulsé <i class="fa fa-heart text-danger"></i> par <a href="https://bel-cms.be" target="_blank">Bel-CMS</a>
                    </div>
                </footer>
            </div>
        </div>
        <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>

        <script src="/managements/assets/js/vendor/jquery.min.js"></script>
        <script src="/managements/assets/js/vendor/bootstrap.min.js"></script>
        <script src="/managements/assets/js/plugins.js"></script>
        <script src="/managements/assets/js/app.js"></script>
        <script type="text/javascript" src="/assets/plugins/tinymce/tinymce.min.js"></script>
        <script type="text/javascript" src="/assets/plugins/belcms.core.js"></script>
    </body>
</html>