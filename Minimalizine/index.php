<?php get_header(); ?>
<div id="mainbody">
    <?php if ( is_search() ) {  ?>
    <div class="mainsearch">Search Status: "<?php echo $s; ?>"</div>
    <?php } else { ?>
    <?php if (get_option('yoshz_featured') == "on") { ?>
    <div id="slider">
        <?php
        rewind_posts();
        $temp = $wp_query;
        $wp_query= null;
        $wp_query = new WP_Query();
        $wp_query->query('showposts=5&category_name='.get_option('yoshz_slide_category'));
        while ($wp_query->have_posts()) : $wp_query->the_post();
        ?>
        
        <?php if (getImage() != ""){ ?>
        <a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo getImage(); ?>&h=250&w=600" width="600" height="250" title="<?php the_title_attribute(); ?>" /></a>
        <?php } else { ?>
        <a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/default.jpg" width="600" height="250" title="<?php the_title_attribute(); ?>" /></a>
        <?php } ?>
        
        <?php endwhile; $wp_query = null; $wp_query = $temp;?>
    </div>
    <div class="clear"></div>
    <?php } ?>
    <?php } $postcount = 1; if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="content">
    	<?php if (getImage() != ""){ ?>
        	<a href="<?php the_permalink() ?>"><img src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo getImage(); ?>&h=150&w=281&zc=1" class="center" /></a>
        <?php } ?>
    	<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
        <div class="submain"><?php the_time('F, d Y') ?>  </div>
    	<div class="clear"></div>
        <div class="maincontent">
            <?php excerpt('15'); ?>
        </div>
        <div class="maincom"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">続き読む... &raquo;</a></div>
    	<div class="clear"></div>
    </div>
    <?php if ($postcount == 2 || $postcount == 4 || $postcount == 6 || $postcount == 8 || $postcount == 10) : ?>
    	<div class="clear"></div>
    <?php endif; $postcount++; ?>
    <?php endwhile; ?>
    <div class="clear"></div>
    <?php include (TEMPLATEPATH . '/paginate.php'); else : include (TEMPLATEPATH . '/404.php'); endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>