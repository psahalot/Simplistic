<?php
/* By taking advantage of hooks, filters, and the Custom Loop API, you can make Thesis
 * do ANYTHING you want. For more information, please see the following articles from
 * the Thesis User’s Guide or visit the members-only Thesis Support Forums:
 * 
 * Hooks: http://diythemes.com/thesis/rtfm/customizing-with-hooks/
 * Filters: http://diythemes.com/thesis/rtfm/customizing-with-filters/
 * Custom Loop API: http://diythemes.com/thesis/rtfm/custom-loop-api/
 * Custom Thesis theme by Puneet Sahalot : http://icustomizethesis.com/
---:[ place your custom code below this line ]:---*/

//remove navigation
remove_action('thesis_hook_before_header','thesis_nav_menu');
add_action('thesis_hook_after_header','thesis_nav_menu');

//remove thesis attribution 
remove_action('thesis_hook_footer','thesis_attribution');

function custom_link_open () {
if(is_home()) { ?>
	<a href="<?php the_permalink(); ?>" >
<?php }
}
add_action ('thesis_hook_before_teaser','custom_link_open');

function custom_link_close () {
if(is_home()) { ?>
 </a>
<?php }
}
add_action ('thesis_hook_after_teaser','custom_link_close');

function add_to_byline() { ?>
   	<p class="headline_meta"><?php echo (''). ' <span>' .get_the_time('F j, Y') . '</span></p>'; ?>
<?php }
add_action('thesis_hook_before_headline', 'add_to_byline', '1');



/* register sidebars for widgetized footer */
if (function_exists('register_sidebar')) {
	$sidebars = array(1, 2, 3);
	foreach($sidebars as $number) {
		register_sidebar(array(
			'name' => 'Footer ' . $number,
			'id' => 'footer-' . $number,
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
		));
	}
}


/* set up footer widgets */
function widgetized_footer() {
?>
	<div id="footer_setup" class="sidebar">
		<div class="footer_items1">
  	  	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 1') ) : ?>
    		<?php endif; ?>
		</div>

		<div class="footer_items2">
    		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 2') ) : ?>
    		<?php endif; ?>
		</div>

		<div class="footer_items3"> 		
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 3') ) : ?> 		
		<?php endif; ?>		
		</div>

	</div>
<?php
}
add_action('thesis_hook_footer','widgetized_footer');


// custom footer 
function custom_footer() { ?>
<div id="copyright-text">
<p> &copy; Copyright <?php echo date('Y'); ?> | <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> | <a href="http://icustomizethesis.com/" title="Thesis Customization" target="_blank">Thesis Customization</a> by <a href="http://icustomizethesis.com/" title="Thesis Customization" target="_blank">iCustomizeThesis</a>
</div>
<?php }

add_action('thesis_hook_footer','custom_footer');