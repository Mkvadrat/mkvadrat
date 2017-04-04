<div id="main-wrapper">
    <div id="fixed-panel">

        <div id="header">
            <div class="container">
                <a href="javascript:void(0)" id="menu-btn"></a>
                <a href="/" id="logo"></a>
				<div id="logo-text">
				<div class="logo-1">MKVADRAT</div>
				<div class="logo-2">Сайты для бизнеса</div>
				</div>
                <ul id="main-menu" class="list horizontal">
                    <?php echo mkvadrat_custom_main_menu(); ?>
                </ul>
				<span class="contact-top">
				<div class="phone-top">+7 (495) 240-8705</div>
				<div class="button-top"><a href="/contacts/#contact">Заказать обратный звонок</a></div>
				
				</span>
            </div>
        </div><!--/header-->
    </div><!--/fixed-panel-->
    <div id="left-menu">
        <a href="javascript:void(0)" id="menu-btn-close"></a>
        <ul class="list vertical">
            <?php echo mkvadrat_custom_left_menu() ?>
        </ul>
    </div><!--/left-menu-->
<div id="content-top"><?php print render($page['content_top']); ?></div>
    <div id="main-content" class="clearfix">
        <div class="container">
            <?php if ($messages): ?>
                <div id="messages"><div class="section clearfix">
                        <?php print $messages; ?>
                    </div></div> <!-- /.section, /#messages -->
            <?php endif; ?>

            <?php if ($breadcrumb): ?>
                <div id="breadcrumb"><?php print $breadcrumb; ?></div>
            <?php endif; ?>

            <div id="content" class="column"><div class="section">
                    <a id="main-content"></a>
                    <?php print render($title_prefix); ?>
                    <?php if ($title): ?>
                        <h1 class="title" id="page-title">
                            <?php print $title; ?>
                        </h1>
                    <?php endif; ?>
                    <?php print render($title_suffix); ?>
                    <?php if ($tabs): ?>
                        <div class="tabs">
                            <?php print render($tabs); ?>
                        </div>
                    <?php endif; ?>
                    <?php print render($page['help']); ?>
                    <?php if ($action_links): ?>
                        <ul class="action-links">
                            <?php print render($action_links); ?>
                        </ul>
                    <?php endif; ?>
                    <?php print render($page['content']); ?>
                    <?php print $feed_icons; ?>

                </div></div> <!-- /content -->

        </div><!--/container-->
    </div> <!-- /main-content -->
<div id="content-bottom"><?php print render($page['content_bottom']); ?></div>
    <?php include ($directory . '/includes/footer.tpl.php'); ?>

</div> <!-- /main-wrapper -->
<a href="javascript:void(0)" id="scrolltop"></a>