<?php
if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
	header( 'Location: '.admin_url().'admin.php?page=theme-setting.php' ) ;
}
include (TEMPLATEPATH . '/functions/theme-setting.php');
//widget ready
if ( function_exists('register_sidebar') )
	register_sidebar(array(
	'before_widget' => '<div class="sidewidget">',
	'after_widget' => '</div></div>',
	'before_title' => '<div class="sidetitle"><h1>',
	'after_title' => '</h1></div><div class="sidecont">',
));
//widget ready 2
if ( function_exists('register_sidebar') )
	register_sidebar(array('name' => 'Footer',
	'before_widget' => '<div class="sidewidget">',
	'after_widget' => '</div></div>',
	'before_title' => '<h1>',
	'after_title' => '</h1><div class="sidecont">',
));
function register_main_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Menu' ),
		)
	);
};
if (function_exists('register_nav_menus')) add_action( 'init', 'register_main_menus' );
// retreives image from the post
function getImage() {
global $more;
$more = 1;
$num = 1;
$content = get_the_content();
$count = substr_count($content, '<img');
$start = 0;
for($i=1;$i<=$count;$i++) {
	$imgBeg = strpos($content, '<img', $start);
	$post = substr($content, $imgBeg);
	$imgEnd = strpos($post, '>');
	$postOutput = substr($post, 0, $imgEnd+1);
	$image[$i] = $postOutput;
	$start=$imgEnd+1;  
	 
	$cleanF = strpos($image[$num],'src="')+5;
	$cleanB = strpos($image[$num],'"',$cleanF)-$cleanF;
	$imgThumb = substr($image[$num],$cleanF,$cleanB);
}
$images = $imgThumb;
$more = 0;
return $images;

}
//retreive image ends
function excerpt($num) {
$limit = $num+1;
$excerpt = explode(' ', get_the_excerpt(), $limit);
array_pop($excerpt);
$excerpt = implode(" ",$excerpt)."...";
echo $excerpt;
}
//page
function custom_wp_pagenavi($prelabel = '', $nxtlabel = '', $pages_to_show = 5, $always_show = false) {
	global $request, $posts_per_page, $wpdb, $paged;
	if(empty($prelabel)) {
		$prelabel  = '<strong>&laquo;</strong>';
	}
	if(empty($nxtlabel)) {
		$nxtlabel = '<strong>&raquo;</strong>';
	}
	$half_pages_to_show = round($pages_to_show/2);
	if (!is_single()) {
		if(!is_category()) {
			preg_match('#FROM\s(.*)\sORDER BY#siU', $request, $matches);
		} else {
			preg_match('#FROM\s(.*)\sGROUP BY#siU', $request, $matches);
		}
		$fromwhere = $matches[1];
		$numposts = $wpdb->get_var("SELECT COUNT(DISTINCT ID) FROM $fromwhere");
		$max_page = ceil($numposts /$posts_per_page);
		if(empty($paged)) {
			$paged = 1;
		}
		if($max_page > 1 || $always_show) {
			echo "<div class=\"pagination\"><ul><li><a href=\"#\" class=\"prevnext pages\">Pages $paged of $max_page</a></li>";
			if ($paged >= ($pages_to_show-1)) {
				echo '<a href="'.get_pagenum_link().'">&laquo; First</a> ... ';
			}
			previous_posts_link($prelabel);
			for($i = $paged - $half_pages_to_show; $i  <= $paged + $half_pages_to_show; $i++) {
				if ($i >= 1 && $i <= $max_page) {
					if($i == $paged) {
						echo "<li><a href=\"#\" class=\"currentpage\">$i</a></li>";
					} else {
						echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
					}
				}
			}
			echo "<li>";
			next_posts_link($nxtlabel, $max_page);
			echo "</li>";
			if (($paged+$half_pages_to_show) < ($max_page)) {
				echo ' ... <a href="'.get_pagenum_link($max_page).'">Last &raquo;</a>';
			}
			echo "</ul></div>";
		}
	}
}
function mytheme_comment($comment, $args, $depth) {
   	$GLOBALS['comment'] = $comment; ?>
   	<?php global $cmntCnt; ?>
   	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>">
      		<div class="comment-author vcard">
			<?php echo get_avatar($comment, '60'); ?>
        	<div class="commentnumber"><?php echo $cmntCnt+1; ?></div>   
        
      		<div class="comment-meta commentmetadata"><div class="author"><?php comment_author_link() ?></div><p><?php comment_date('F jS, Y') ?> at <?php comment_time() ?><?php edit_comment_link(__('Edit'),'  ','') ?></p>
            </div>
            
            <?php if ($comment->comment_approved == '0') : ?>
         		<em><?php _e('Your comment is awaiting moderation.') ?></em>
      		<?php endif; ?>
            
			<?php $cmntCnt = $cmntCnt + 1; ?>
      		<?php comment_text() ?>
			<?php if($args['max_depth']!=$depth) { ?>
      		<div class="reply">
         		<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      		</div>
      		<?php } ?>
			</div>
		</div>

<?php
}?>
<?php add_theme_support('post-thumbnails'); ?>