<?php get_header(); ?>

<div id="mainbody">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="mcontent">    
    	<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
        <div class="submain">Posted By: <?php the_author() ?> on <?php the_time('F, d Y') ?>  </div>
    	<div class="clear"></div>
        <div class="maincontent">
            <?php the_content(); ?>
        </div>
    	<div class="clear"></div>
        <div class="comment">
			<?php comments_template(); ?>
		</div>
    </div>
    <?php endwhile; endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
<?php get_foot(); ?>