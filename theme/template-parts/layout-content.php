<?php
	$sections_path = 'template-parts/section';

	$id = get_queried_object_id();

	$post = get_post($id); 
?>

<?php if( have_rows('section') ): ?>
	<?php while( have_rows('section') ): the_row(); ?>
			
			<?php if( get_row_layout() == 'featured_right' ): ?>
				
				<?php get_template_part( $sections_path, 'featured-right',
					array(
						'title_string' => get_sub_field('title'),
						'description_string' => get_sub_field('description'),
						'highlighted_array' => get_sub_field('highlighted'),
						'side_description_string' => empty(get_sub_field('side_description')) ? get_sub_field('title') : get_sub_field('side_description')['title'],
						'section_class' => 'bg-white text-black'
					)
				); ?>

			<?php endif; ?>
					
			<?php if( get_row_layout() == 'featured_center' ):  ?>
					
					<?php get_template_part( $sections_path, 'featured-center',
						array(
							'title_string' => get_sub_field('title'),
							'description_string' => get_sub_field('description'),
							'highlighted_icon_center_id' => get_sub_field('highlighted_icon_center'),
							'background_id' => get_sub_field('background'),
							'highlighted_array' => get_sub_field('highlighted'),
							'side_description_string' => empty(get_sub_field('side_description')) ? get_sub_field('title') : get_sub_field('side_description')['title'],
						)
					); ?>

			<?php endif; ?>
					
			<?php if( get_row_layout() == 'featured_center' ):  ?>
					
					<?php get_template_part( $sections_path, 'featured-center',
						array(
							'title_string' => get_sub_field('title'),
							'description_string' => get_sub_field('description'),
							'highlighted_icon_center_id' => get_sub_field('highlighted_icon_center'),
							'background_id' => get_sub_field('background'),
							'highlighted_array' => get_sub_field('highlighted'),
							'side_description_string' => empty(get_sub_field('side_description')) ? get_sub_field('title') : get_sub_field('side_description')['title'],
						)
					); ?>

			<?php endif; ?>

			<?php if( get_row_layout() == 'text_left' ):  ?>
					
					<?php get_template_part( $sections_path, 'text-left',
						array(
							'title_string' => get_sub_field('title'),
							'description_string' => get_sub_field('description'),
							'background_id' => get_sub_field('background'),
						)
					); ?>
			<?php endif; ?>
			
			<?php if( get_row_layout() == 'gallery' ):  ?>
					
					<?php get_template_part( $sections_path, 'gallery',
						array(
							'title_string' => get_sub_field('title'),
							'description_string' => get_sub_field('description'),
							'highlighted_array' => get_sub_field('highlighted'),
							'gallery_array' => get_sub_field('gallery'),
						)
					); ?>

			<?php endif; ?>

			<?php if( get_row_layout() == 'reviews' ):  ?>		
					
					<?php get_template_part( $sections_path, 'reviews',
						array(
							'side_description_string' => '',
							'title_string' => get_sub_field('title'),
							'review_array' => get_sub_field('review')
						)
					); ?>

			<?php endif; ?>

	<?php endwhile; ?>
<?php endif; ?>
