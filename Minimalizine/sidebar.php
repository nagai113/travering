<div id="sidebar">
	
    <?php if (get_option('yoshz_ads125') == "on") { ?>
	<div class="sideads">
    	<a href="<?php echo get_option('yoshz_target1'); ?>" target="_blank"><img src="<?php echo get_option('yoshz_url1'); ?>" alt="Advertiser 1" /></a>
        <a href="<?php echo get_option('yoshz_target2'); ?>" target="_blank"><img src="<?php echo get_option('yoshz_url2'); ?>" alt="Advertiser 2" /></a>
        <a href="<?php echo get_option('yoshz_target3'); ?>" target="_blank"><img src="<?php echo get_option('yoshz_url3'); ?>" alt="Advertiser 3" /></a>
        <a href="<?php echo get_option('yoshz_target4'); ?>" target="_blank"><img src="<?php echo get_option('yoshz_url4'); ?>" alt="Advertiser 4" /></a>
    </div>
    <?php } ?>
    <div class="clear"></div>
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
    <div class="sidewidget">
    	<div class="sidetitle"><h1>Meta</h1></div>
        <div class="sidecont">
    	<ul>
			<?php wp_register(); ?>
            <li><?php wp_loginout(); ?></li>
            <li><a href="http://yoshz.com">Yoshz</a></li>
            <li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
            <?php wp_meta(); ?>
        </ul>
        </div>
    </div>
    <?php  endif; ?>
</div>