<?php get_header(); ?>
<div id="mainbody">
	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
	<?php /* If this is a category archive */ if (is_category()) { ?>
    <div class="mainsearch">Category: <?php single_cat_title(); ?></div>
    <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
    <div class="mainsearch">Tag: <?php single_tag_title(); ?></div>
    <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
    <div class="mainsearch">Date: <?php the_time('F jS, Y'); ?></div>
    <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
    <div class="mainsearch">Month: <?php the_time('F Y'); ?></div>
    <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
    <div class="mainsearch">Year: <?php the_time('Y'); ?></div>
    <?php /* If this is an author archive */ } elseif (is_author()) { ?>
    <div class="mainsearch">Author: </div>
    <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
    <div class="mainsearch">Archives</div>
    <?php } ?>
    <?php $postcount = 1; if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="content">
    	<?php if (getImage() != ""){ ?>
        	<img src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo getImage(); ?>&h=150&w=281&zc=1" class="center" />
        <?php } ?>
    	<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
        <div class="submain">Posted By: <?php the_author() ?> on <?php the_time('F, d Y') ?>  </div>
    	<div class="clear"></div>
        <div class="maincontent">
            <?php excerpt('30'); ?>
        </div>
        <div class="maincom"><?php comments_popup_link('No Comment', '1 Comment', '% Comments'); ?> | <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">Read More &raquo;</a></div>
    	<div class="clear"></div>
    </div>
    <?php if ($postcount == 2 || $postcount == 4 || $postcount == 6 || $postcount == 8 || $postcount == 10) : ?>
    	<div class="clear"></div>
    <?php endif; $postcount++; ?>
    <?php endwhile; ?>
    <div class="clear"></div>
    <?php include (TEMPLATEPATH . '/paginate.php'); endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
<?php get_foot(); ?>