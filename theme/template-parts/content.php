<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ProtonMultimedia
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('container content'); ?>>
	<?php
		the_content();
	?>
</article><!-- #post-<?php the_ID(); ?> -->