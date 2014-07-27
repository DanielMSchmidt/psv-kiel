<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage STTF
 * @since STTF 1.0
 */

get_header();

    if(get_option('UseTeaser') == 'on') { ?>
      <div id="teaser" class="clearfix">
        <div class="box">
          <h2><a href="<?php echo get_option('LeftTeaserLink'); ?>"><?php echo get_option('LeftTeaserHead'); ?></a></h2>
          <p>
            <?php if(get_option('LeftTeaserImg')) : ?><img src="<?php echo get_option('LeftTeaserImg'); ?>" alt="<?php echo get_option('LeftTeaserHead'); ?>" class="<?php echo get_option('TeaserImgAlign'); ?>" width="<?php echo get_option('TeaserImgWidth'); ?>" height="<?php echo get_option('TeaserImgHeight'); ?>" ?><?php endif; ?>
            <?php echo get_option('LeftTeaserContent'); ?>
          </p>
          <p><a href="<?php echo get_option('LeftTeaserLink'); ?>"><?php _e('Read more', 'stylish'); ?></a></p>
        </div>
        <div class="box">
          <h2><a href="<?php echo get_option('MiddleTeaserLink'); ?>"><?php echo get_option('MiddleTeaserHead'); ?></a></h2>
          <p>
            <?php if(get_option('MiddleTeaserImg')) : ?><img src="<?php echo get_option('MiddleTeaserImg'); ?>" alt="<?php echo get_option('MiddleTeaserHead'); ?>" class="<?php echo get_option('TeaserImgAlign'); ?>" width="<?php echo get_option('TeaserImgWidth'); ?>" height="<?php echo get_option('TeaserImgHeight'); ?>" ?><?php endif; ?>
            <?php echo get_option('MiddleTeaserContent'); ?>
          </p>
          <p><a href="<?php echo get_option('MiddleTeaserLink'); ?>"><?php _e('Read more', 'stylish'); ?></a></p>
        </div>
        <div class="box">
          <h2><a href="<?php echo get_option('RightTeaserLink'); ?>"><?php echo get_option('RightTeaserHead'); ?></a></h2>
          <p>
            <?php if(get_option('RightTeaserImg')) : ?><img src="<?php echo get_option('RightTeaserImg'); ?>" alt="<?php echo get_option('RightTeaserHead'); ?>" class="<?php echo get_option('TeaserImgAlign'); ?>" width="<?php echo get_option('TeaserImgWidth'); ?>" height="<?php echo get_option('TeaserImgHeight'); ?>" ?><?php endif; ?>
            <?php echo get_option('RightTeaserContent'); ?>
          </p>
          <p><a href="<?php echo get_option('RightTeaserLink'); ?>"><?php _e('Read more', 'stylish'); ?></a></p>
        </div>
      </div>
      <?php }
    ?>
		<div id="container" class="clearfix">
			<div id="content" role="main">

			<?php
			/* Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			 */
			 get_template_part( 'loop', 'index' );
			?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
