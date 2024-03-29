<?php
/**
 * The service category template file
 *
 * @package ProtonMultimedia
 */

get_header();
$sections_path = 'template-parts/section';
?>

  <?php get_template_part( $sections_path, 'header', 
    array( 
      'title_string' => single_term_title('', false), 
      'description_string' => term_description(get_queried_object()->term_id),
      'background_id' => get_field('service_category_featured_image', get_queried_object())
    )
  ); ?>

  <?php 
    $posts = get_posts( array(
      'posts_per_page' => -1,
      'orderby' => 'title',
      'post_type' => 'services',
      'post_status' => 'publish',
      'tax_query' => array(
        array(
            'taxonomy' => get_queried_object()->taxonomy,
            'field' => 'slug',
            'terms' => get_queried_object()->slug
        )
      )
    ));

    $cats_terms_all = [];

    foreach ($posts as $key => $post) {
      $terms_post = wp_get_post_terms(
        $post->ID, 
        'services_category'
      );
      
      if(!is_wp_error( $terms_post ) && !empty( $terms_post ) && is_array($terms_post)){
        $filtered_cats_term_post = array_filter(
          $terms_post,
          function ($val){
            return $val->parent !== 0;
          },
          ARRAY_FILTER_USE_BOTH
      );

        $cats_terms_all = array_merge(
          $cats_terms_all , 
          $filtered_cats_term_post
        );
      }
    }

    $cats_terms_all = array_map("unserialize", array_unique(array_map("serialize", $cats_terms_all)));

    get_template_part( $sections_path, 'post-list-tiles', array(
      'section_name_string' => 'Oferta',
      'list_post_array' => $posts,
      'filters_array' => $cats_terms_all
    )); 
  ?>

  <?php get_template_part( $sections_path, 'call-to-action' ); ?>

<?php
get_footer();
