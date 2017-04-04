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

    <div id="main-content" class="clearfix">

            <?php print render($page['content']); ?>

    </div> <!-- /main-content -->

    <?php include ($directory . '/includes/footer.tpl.php'); ?>

</div> <!-- /main-wrapper -->
<a href="javascript:void(0)" id="scrolltop"></a>