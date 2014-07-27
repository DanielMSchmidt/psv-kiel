<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage STTF
 * @since STTF 1.0
 */

get_header(); ?>

<div id="container">
    <div id="content" role="main">

        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h2 class="entry-title"><?php the_title(); ?></h2>
                <div class="entry-content">
                    <?php the_content(); ?>
                    <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'stylish' ), 'after' => '</div>' ) ); ?>
                </div><!-- .entry-content -->
            </div><!-- #post-## -->
        <?php endwhile; ?>

        <?php
          $cats = wp_get_post_categories($post->ID);
          if (count($cats) > 0) {
            $args = array(
            'orderby'       => 'date',
            'order'         => 'DESC',
            'category__in'  => $cats,
            'post_type'     => 'post',
            'post_status'   => 'publish'
            );
            query_posts($args);
        ?>

        <?php if (have_posts()) { ?>
            <div id="news" class="post">
                <div class="entry-title">
                    <h3>News</h3>
                </div>

                <div class="newswrapper">
                    <!-- wrapper -->
                    <?php
                        while ( have_posts() ) : the_post();
                            $category = get_the_category();
                            $catName = $category[0]->cat_name;
                    ?>
                        <div class="post type-post" onclick="location.href='<?php echo get_permalink(); ?>'">
                            <h2 class="entry-content-title"><a href="<?php echo get_permalink(); ?>"><?php echo $catName; ?> : <?php the_title(); ?></a></h2>
                            <div class="entry-content">
                                <?php the_excerpt(); ?>
                            </div><!-- .entry-content -->
                        </div><!-- #post-## -->
                    <?php endwhile;
                        }
                    ?>

                </div>
            </div>
        <?php } ?>
    </div>
</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
