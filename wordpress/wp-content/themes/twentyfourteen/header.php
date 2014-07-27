<?php
/**
 * The Header for our theme.
 *
 * @package WordPress
 * @subpackage STTF
 * @since STTF 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
  /*
   * Print the <title> tag based on what is being viewed.
   * We filter the output of wp_title() a bit -- see
   * stylish_filter_wp_title() in functions.php.
   */
  wp_title( '|', true, 'right' );

  ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php if(get_option('GoogleFont')) : ?><link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=<?= get_option('GoogleFont'); ?>"><?php endif; ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php if(get_option('Favicon')) : ?>
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo get_option('Favicon'); ?>" sizes="16x16" />
  <link rel="icon" type="image/x-icon" href="<?php echo get_option('Favicon'); ?>" sizes="16x16" />
<?php endif;
  /* Leave this always before the closing <head> */
  wp_head();
?>

  <link href="<?php bloginfo('template_url'); ?>/stylesheets/screen.css" media="screen, projection" rel="stylesheet" type="text/css" />
  <link href="<?php bloginfo('template_url'); ?>/stylesheets/print.css" media="print" rel="stylesheet" type="text/css" />
  <!--[if IE]>
      <link href="<?php bloginfo('template_url'); ?>/stylesheets/ie.css" media="screen, projection" rel="stylesheet" type="text/css" />
  <![endif]-->

</head>

<body <?php body_class(); ?> <?php if(get_option('ColorVariant') != '') { echo "id='" . get_option('ColorVariant') . "'"; } ?>>

<div id="wrapper" class="hfeed">
  <div id="header">
  <?php if(get_option('ShareRSS') || get_option('ShareTwitter') || get_option('ShareFacebook') || get_option('ShareXing') || get_option('ShareYoutube')) : ?>
    <div id="metanav">
      <ul>
       <?php if(get_option('ShareRSS')) : ?><li class="rss"><a href="<?php echo home_url( '/' ); ?>feed/" title="<?php _e('RSS-Feed', 'stylish'); ?>"><?php _e('RSS-Feed', 'stylish'); ?></a></li><?php endif; ?>
       <?php if(get_option('ShareTwitter')) : ?><li class="twitter"><a href="http://www.twitter.com/<?php echo get_option('ShareTwitter') ?>" title="<? echo get_option('ShareTwitter') ?> <?php _e('on Twitter', 'stylish'); ?>">Twitter</a></li><?php endif; ?>
       <?php if(get_option('ShareFacebook')) : ?><li class="facebook"><a href="http://www.facebook.com/<?php echo get_option('ShareFacebook') ?>" title="<? echo get_option('ShareFacebook') ?> <?php _e('on Facebook', 'stylish'); ?>">Facebook</a></li><?php endif; ?>
       <?php if(get_option('ShareXing')) : ?><li class="xing"><a href="http://www.xing.com/profile/<?php echo get_option('ShareXing') ?>" title="<?php echo get_option('ShareXing') ?> <?php _e('on Facebook', 'stylish'); ?>">Xing</a></li><?php endif; ?>
       <?php if(get_option('ShareYoutube')) : ?><li class="youtube"><a href="http://www.youtube.com/<?php echo get_option('ShareYoutube') ?>" title="<?php echo get_option('ShareYoutube') ?> <?php _e('on Youtube', 'stylish'); ?>">Youtube</a></li><?php endif; ?>
      </ul>
    </div>
   <?php endif; ?>
    <div id="headerimg">
      <div id="branding" role="banner">
        <h1>
          <span>
            <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
          </span>
        </h1>
        <p id="site-description"><?php bloginfo( 'description' ); ?></p>
      <div id="access" role="navigation">
        <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
        <div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'stylish' ); ?>"><?php _e( 'Skip to content', 'stylish' ); ?></a></div>
        <div id="navigation">
          <?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
          <?php
              $locations = get_registered_nav_menus();
              $menus = wp_get_nav_menus();
              $menu_locations = get_nav_menu_locations();
              $location_id = 'primary';
              if (isset($menu_locations[ $location_id ])) {
                foreach ($menus as $menu) {
                  // If the ID of this menu is the ID associated with the location we're searching for
                  if ($menu->term_id == $menu_locations[ $location_id ]) {
                    $raw_menu_items = wp_get_nav_menu_items($menu);
                    $menu_items = array();
                    $menu_childs = array();

                    foreach ($raw_menu_items as $item) {
                      if($item->menu_item_parent == 0){
                        $menu_items[] = $item;
                      } else {
                        if (!isset($menu_childs[$item->menu_item_parent])) {
                          $menu_childs[$item->menu_item_parent] = array($item);
                        } else {
                          $menu_childs[$item->menu_item_parent][] = $item;
                        }
                      }
                    }

                    $menu_items_count = count($menu_items);
                    break;
                  }
                }
                ?>
          <div class="menu-header">
            <ul class="actions-list is-sized-<?php echo $menu_items_count; ?>">
            <?php
              }
              foreach ($menu_items as $item) {?>
                <li class="action-item <?php echo implode(' ', $item->classes); ?> <?php if (isset($menu_childs[$item->ID])){ echo 'has-children'; }  ?>">
                  <div class="action-item-full-height action-item-image" style="background-image: url('<?php $id = get_post_thumbnail_id($item->object_id, 'full'); echo wp_get_attachment_url($id); ?>');">
                    <a href="<?php echo $item->url; ?>" class="action-item-title"><?php echo $item->title; ?></a>
                    <ul class="action-item-childs">
                    <?php foreach ($menu_childs[$item->ID] as $key => $value) {?>
                      <li><a href="<?php echo $value->url; ?>"><?php echo $value->title; ?></a></li>
                    <?php } ?>
                    </ul>
                  </div>
                </li>
              <?php
              }
              ?>
            </ul>
          </div>
          <div class="clearfix"> </div>
        </div><!-- #nav -->
      </div><!-- #access -->
      <div id="secondnav">
                  <?php wp_nav_menu( array( 'container_class' => 'menu', 'theme_location' => 'secondary' ) ); ?>
      </div>


     </div>
  </div><!-- #headerimg -->
</div><!-- #header -->

<div id="main" class="clearfix">
