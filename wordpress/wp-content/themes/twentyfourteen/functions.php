<?php
/**
 * stylish functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, stylish_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage STTF
 */

/**
 *
 * Various global Theme settings for Stylish Templates theme
 *
 */

function global_theme_settings() {

  /** Replace false with font name (e.g. 'Yanone') to activate the use of Google font API */
  update_option("GoogleFont", 'Lobster');

  /** Slider images height and width */
  update_option("SliderImgWidth", '970');
  update_option("SliderImgHeight", '300');

  /** Use Teaser images, set size and alignment. If true, input fields for image URL will be added in settings page */
  update_option("UseTeaserImg", true);
  update_option("TeaserImgWidth", '125');
  update_option("TeaserImgHeight", '125');
  update_option("TeaserImgAlign", 'alignleft'); /** alignleft || alignright || aligncenter (with line break) */

}
add_action('init', 'global_theme_settings');

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 680;

/** Tell WordPress to run stylish_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'stylish_setup' );

if ( ! function_exists( 'stylish_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function stylish_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'stylish', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'stylish' ),
    'secondary' => __( 'Secondary Navigation', 'stylish' )
	) );

	// This theme allows users to set a custom background
	// add_custom_background();

	// Your changeable header business starts here
	define( 'HEADER_TEXTCOLOR', '' );
	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	define( 'HEADER_IMAGE', '%s/images/headers/path.jpg' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to stylish_header_image_width and stylish_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'stylish_header_image_width', 970 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'stylish_header_image_height', 198 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 940 pixels wide by 198 pixels tall.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Don't support text inside the header image.
	define( 'NO_HEADER_TEXT', true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See stylish_admin_header_style(), below.
	add_custom_image_header( '', 'stylish_admin_header_style' );

	// ... and thus ends the changeable header business.

}
endif;

if ( ! function_exists( 'stylish_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in stylish_setup().
 */
function stylish_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headerimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;

/**
 * Makes some changes to the <title> tag, by filtering the output of wp_title().
 */
function stylish_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'stylish' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'stylish' ), $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'stylish' ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'stylish_filter_wp_title', 10, 2 );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function stylish_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'stylish_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 */
function stylish_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'stylish_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 */
function stylish_continue_reading_link() {
	return ' <a class="morelink" href="'. get_permalink() . '">' . __( 'Read more', 'stylish' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and stylish_continue_reading_link().
 */
function stylish_auto_excerpt_more( $more ) {
	//return ' &hellip;' . stylish_continue_reading_link();
	return '…';
}
add_filter( 'excerpt_more', 'stylish_auto_excerpt_more' );

/**
 * Adds a pretty "Read more" link to custom post excerpts.
 */
function stylish_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= stylish_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'stylish_custom_excerpt_more' );

if ( ! function_exists( 'stylish_comment' ) ) :

/**
 * Template for comments and pingbacks.
 */
function stylish_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php printf( __( ' <span class="says">Author:</span> %s', 'stylish' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'stylish' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '&nbsp;| %1$s', 'stylish' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'stylish' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'stylish' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'stylish'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 */
function stylish_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'stylish' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'stylish' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'stylish' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'stylish' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running stylish_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'stylish_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 */
function stylish_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'stylish_remove_recent_comments_style' );

if ( ! function_exists( 'stylish_posted' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 */
function stylish_posted() {
	printf( __( '<p class="date">%2$s</p><p class="post-meta">Posted <span class="meta-sep">by</span> %3$s ', 'stylish' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date( $d, $m),
      get_the_category_list( ', ' )
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'stylish' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'stylish_posted_in' ) ) :

function stylish_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$posted_in = __( 'in %1$s.', 'stylish' );

	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

/** Automated sidebar in theme */
function st_theme_info() {
    if(is_front_page()) : ?>
    <li id="st-info" class="widget-container">
      <h3>Free Wordpress Themes</h3>
      <ul>
        <li><a class="rightlink" href="http://www.stylish-templates.de" title="Wordpress Themes">Wordpress-Themes</a></li>
      </ul>
    </li>
<?php endif;
}

/** jQuery calls for templates */
function st_calljq() {
    wp_enqueue_script('fancybox', get_bloginfo('template_url') . '/js/fancybox/jquery.fancybox-1.3.4.pack.js', array('jquery'), '1.3.4' );
    wp_enqueue_style('fancybox', get_bloginfo('template_url') . '/css/jquery.fancybox-1.3.4.css');
}
add_action('init', 'st_calljq');

/** Add fancybox class to image links */
function st_add_fancybox($content){
    $content = preg_replace('/<a(.*?)href="(.*?).(jpg|jpeg|png|gif|bmp|ico)"(.*?)><img/U', '<a$1href="$2.$3" $4 class="grouped_images"><img', $content);
    return $content;
}
add_filter('the_content', 'st_add_fancybox');


/** Slider images */
function st_slider() {
  $slides[0] = array(
    'slide' => get_option('SliderImage_01'),
    'slideurl' => get_option('SliderUrl_01')
  );
  $slides[1] = array(
    'slide' => get_option('SliderImage_02'),
    'slideurl' => get_option('SliderUrl_02')
  );
  $slides[2] = array(
    'slide' => get_option('SliderImage_03'),
    'slideurl' => get_option('SliderUrl_03')
  );
  $slides[3] = array(
    'slide' => get_option('SliderImage_04'),
    'slideurl' => get_option('SliderUrl_04')
  );
  $slides[4] = array(
    'slide' => get_option('SliderImage_05'),
    'slideurl' => get_option('SliderUrl_05')
  );
  foreach ($slides as $slide) {
    if ($slide[slideurl] != ''){ ?>
      <a href="<?php echo $slide[slideurl]; ?>"><img src="<?php echo $slide[slide]; ?>" width="<?php echo get_option('SliderImgWidth'); ?>" height="<?php echo get_option('SliderImgHeight'); ?>"></a>
    <?php } elseif ($slide[slide] == '') {
      // Do nothing
    } else { ?>
      <img src="<?php echo $slide[slide]; ?>">
    <?php }
  }
}

/** ST feed */
/**
 *
 * Dashboard Widget to get RSS from ST
 *
**/

include_once(ABSPATH . WPINC . '/rss.php');

/* Print Dashboard Widget */
function dashboard_StylishTemplates() {
  $st_rss_feed = 'http://feeds.feedburner.com/stylishtemplates';
  $widget_options = dashboard_StylishTemplates_Options();
  $rss = fetch_rss($st_rss_feed);

  if ( !empty($rss->items) ) {
  echo "<div id='identity'></div>";
  echo '<ul>';
  $rss->items = array_slice($rss->items, 0, $widget_options['items']);
  foreach ($rss->items as $item ) {
    $trlink = '<li><a href="' . wp_filter_kses($item['link']) . '">' . wptexturize(wp_specialchars($item['title'])) . '</a>';
    if($widget_options['showexcerpt']) {
      $trlink .=  "<p>" . wptexturize(wp_specialchars(substr(strip_tags($item['description']), 0,350) )) . "...</p>";
    }
    echo '<p>';
    echo $trlink;
    echo '</p>';
  }
  echo '<li></ul>';
}
else {
  echo '<p>' . __( 'This dashboard widget queries <a href="http://www.stylish-templates.de">Stylish-Templates.de</a> for their latest Templates.', $themename) . "</p>";
  }
 echo '<p class="textright"><a class="button" href="http://www.stylish-templates.de">'.__('View all', '360WP').'</a></p>';
}

/* add Dashboard Widget via function wp_add_dashboard_widget() */
function dashboard_StylishTemplates_Init() {
  wp_add_dashboard_widget('dashboard_StylishTemplates', __( 'Stylish Templates Template Feed', '360WP'), 'dashboard_StylishTemplates', 'dashboard_StylishTemplates_Setup');
}

function StylishTemplates_head() {
  echo '<link href="'.get_bloginfo('wpurl').'/wp-content/plugins/StylishTemplates-dashboard-feed/style.css" rel="stylesheet" type="text/css" />'."\n";
}

function dashboard_StylishTemplates_Options() {
  $defaults = array( 'items' => 5, 'showURL' => 1, 'showexcerpt' => 1);
  if ( ( !$options = get_option( 'dashboard_StylishTemplates' ) ) || !is_array($options) )
  $options = array();
  return array_merge( $defaults, $options );
}

function dashboard_StylishTemplates_Setup() {
  $options = dashboard_StylishTemplates_Options();
  if ( 'post' == strtolower($_SERVER['REQUEST_METHOD']) && isset( $_POST['widget_id'] ) && 'dashboard_StylishTemplates' == $_POST['widget_id'] ) {
    foreach ( array( 'items', 'showurl', 'showexcerpt' ) as $key )
    $options[$key] = $_POST[$key];
    update_option( 'dashboard_StylishTemplates', $options );
  }

?>
<!-- add Dashboard configure panel -->
<div id='identity-configure'></div>
<p>
  <label for="items"><?php _e('How many items would you like to display?', 'dashboard_StylishTemplates' ); ?>
  <select id="items" name="items">
    <?php for ( $i = 5; $i <= 20; $i = $i + 1 )
    echo "<option value='$i'" . ( $options['items'] == $i ? " selected='selected'" : '' ) . ">$i</option>";
    ?>
  </select>
 </label>
</p>
<p>
  <label for="showexcerpt">
    <input id="showexcerpt" name="showexcerpt" type="checkbox" value="1"<?php if ( 1 == $options['showexcerpt'] ) echo ' checked="checked"'; ?> />
    <?php _e('Show excerpt?', 'dashboard_StylishTemplates' ); ?>
  </label>
</p>

<?php }

add_action('wp_dashboard_setup', 'dashboard_StylishTemplates_Init');

/** Theme Settings in Menu */
add_action('admin_menu', 'settingsPage_display');

/** Settings page */
require_once ('options/stylish-settings.php'); // Requires the settings page where all functions are located.


/** Add categories to pages **/

function addCategory() {
  register_taxonomy_for_object_type('category', 'page');
}

add_action('admin_init', 'addCategory');
