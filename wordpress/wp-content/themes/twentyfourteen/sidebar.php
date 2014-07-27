<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage STTF
 * @since STTF 1.0
 */
?>
  <div id="sidebar">
    <div id="primary" class="widget-area" role="complementary">
      <ul class="xoxo">
        <?php dynamic_sidebar( 'primary-widget-area' ); ?>
      </ul>
  </div>
</div>
