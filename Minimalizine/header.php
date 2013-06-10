<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title>
<?php if (is_home () ) {
    bloginfo('name');
} elseif ( is_category() ) {
    single_cat_title(); echo ' - ' ; bloginfo('name');
} elseif (is_single() ) {
    single_post_title();
} elseif (is_page() ) {
    bloginfo('name'); echo ': '; single_post_title();
} else {
    wp_title('',true);
} ?>
</title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/slider.css" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_enqueue_script('jquery'); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<script type="text/javascript" src="<?php echo bloginfo(stylesheet_directory) .'/js/jquery.nivo.slider.pack.js'; ?>"></script>
<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'sliceDown',
		slices:15,
		animSpeed:500,
		pauseTime:5000,
		directionNav:true, //Next & Prev
		directionNavHide:true, //Only show on hover
		controlNav:true, //1,2,3...
		keyboardNav:true, //Use left & right arrows
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});

</script>
<?php wp_head(); ?>

<?php
if((is_home() && ($paged < 2 )) || is_single() || is_page() || is_category()){
    echo '<meta name="robots" content="index,follow" />';
} else {
    echo '<meta name="robots" content="noindex,follow" />';
}
?>
</head>
<body>
<div id="wrapper">
	<div id="header">
        <div class="banner">
        	<div class="logo">
        	<h1><a href="<?php echo get_option('home'); ?>"><?php bloginfo( 'name' ); ?></h1></a>
            <?php bloginfo('description'); ?>
            </div>
        </div>
        <?php
        $primary = '';
		if (function_exists('wp_nav_menu')) {//if 3.0 menus exist
			$primary = wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => 'navcat','depth' => 1, 'sort_column' => 'menu_order', 'echo' => false ) );
			$primary = $primary;
		};
		if ($primary == '') { ?>
        <div class="navcat">
            <ul>
                <li><a href="<?php echo get_option('home'); ?>/">Home</a></li>
                <?php wp_list_categories('title_li=&depth=1' ); ?>
            </ul>
        </div>
		<?php } else echo($primary); ?>
    </div>
    <div class="clear"></div>
    <div id="wrap">
    
	