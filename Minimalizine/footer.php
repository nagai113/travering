<div class="clear"></div>

<div id="footer">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer') ) : ?>
    <div class="footer">
        <div class="sidetitle"></div>
        <div class="sidecont"></div>
    </div>
    
    <!--<div class="sidewidget">
        <div class="sidetitle"><h1>About Us</h1></div>
        <div class="sidecont">
        <p>YoshzThemes was founded by Ther in May 2010 that delivers a Fantastic Worpdress Theme for Bloggers or Business Individual.</p>
		<p>We are committed to bring a best Wordpress Theme that we design. Hope you will love it.</p>

        </div>
    </div>
    
    <div class="sidewidget">
        <div class="sidetitle"><h1>Blogroll</h1></div>
        <div class="sidecont">
        <ul><?php wp_list_bookmarks('categorize=&title_li='); ?></ul>
        </div>
    </div>-->
</div>



<?php endif; wp_footer(); ?>