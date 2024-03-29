<section class="relative bg-dark-blue-2">
    <div class="container">
        <?php if(get_field('news_side_title', 'option')): ?>
        <side-heading
            data-text="<?php echo get_field('news_side_title', 'option'); ?>"
        ></side-heading>
        <?php endif; ?>

        <div class="guides left-minus-px right-auto bg-dark-blue" role="presentation"></div>
            
        <div class="pt-4 phone-wide:pt-12">
            <div class="relative desktop-wide:px-smaller-container flex flex-row">
                <img    
                    class="hidden desktop-wide:block absolute left-0 bottom-0 flex-initial mb-0 mt-auto" 
                    src="<?php echo get_template_directory_uri() . '/assets/svg/news-dots.svg' ?>" 
                    alt="Decorations"
                    style="max-width: 95px;"
                    role="presentation"
                />

                <div class="flex-auto">
                    <?php if(isset($args['header_title_string'])): ?>
                        <h2 class="uppercase mb-14 mt-20 desktop:mt-40">
                            <?php
                                $news_title = $args['header_title_string'];
                                $news_lines = explode(PHP_EOL, $news_title);
                                foreach ( $news_lines as $line) {
                                    echo preg_replace("/\*(.+)\*/", '<span class="block text-primary">$1</span>', $line);
                                }
                            ?>
                        </h2>    
                    <?php else: ?>
                        <h2 class="uppercase mb-14 mt-20 desktop:mt-40">
                            <?php
                                $news_title = get_field('news_title', 'option');
                                $news_lines = explode(PHP_EOL, $news_title);
                                foreach ( $news_lines as $line) {
                                    echo preg_replace("/\*(.+)\*/", '<span class="block text-primary">$1</span>', $line);
                                }
                            ?>
                        </h2>
                    <?php endif; ?>

                    <?php if(isset($args['header_description_string'])): ?>
                        <?php if($args['header_description_string'] !== ''): ?>
                            <p class="pb-10 tablet:pb-16">
                                <?php echo $args['header_description_string']; ?>
                            </p>
                        <?php endif; ?>
                    <?php else: ?>
                        <p class="pb-10 tablet:pb-16">
                            <?php echo get_field('news_description', 'option'); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>

            <?php
            $post_list = get_posts( array(
                'sort_order' => 'desc',
                'posts_per_page' => $args['count_posts_int'],
            ));

            if( $post_list ): ?>
            <ul class="w-full flex-auto flex flex-col tablet:flex-row tablet:flex-wrap box-shadow-bottom">
                <?php foreach( $post_list as $featured_post ): 
                    $post_date = get_the_date( 'd / m / Y' ); 
                    $permalink = get_permalink( $featured_post->ID );
                    $title = get_the_title( $featured_post->ID );
                    $excerpt = get_the_excerpt( $featured_post->ID);
                    $post_image = get_the_post_thumbnail_url($featured_post->ID, array('400', '9999'));
                ?>
                    <li class="phone-wide:flex-1/2 tablet:max-w-1/2 relative">
                        <div class="box-gradient-overlay box-gradient-overlay--dark-blue-2 absolute top-0 bottom-0 left-0 w-full h-full -mb-1 z-10"></div>
                        <img 
                            class="absolute object-cover h-full w-full min-h-full min-w-full" 
                            src="<?php echo $post_image; ?>" 
                            alt="<?php echo esc_html( $title ); ?>" 
                            title="<?php echo esc_html( $title ); ?>" 
                        />
                        <article class="relative min-h-300px flex group w-full h-full z-10 p-5 desktop:py-8 desktop:px-12 desktop-wide:pr-32 full-hd:px-16 full-hd:pr-48 desktop:hover:bg-white transition duration-300">
                            <div class="h-full w-full relative mt-auto">
                                <div class="relative flex flex-col justify-end desktop:group-hover:justify-between z-10 h-full w-full">
                                    <div class="desktop:sticky desktop:top-screen desktop:group-hover:top-auto">
                                        <span class="text-primary text-sm tablet:text-base leading-line-height-normal block mb-1 tablet:mb-2"><?php echo $post_date; ?></span>
                                        <h3 class="mb-4 full-hd:mb-6 desktop:text-white desktop:group-hover:text-black"><?php echo esc_html( $title ); ?></h3>
                                    </div>
                                    <div class="desktop:invisible desktop:group-hover:visible">
                                        <div class="hidden desktop:block desktop:text-black mb-6">
                                            <?php 
                                            
                                            $post_services = get_field( 'services', $featured_post->ID );
                                            if($post_services) {
                                                foreach($post_services as $post_service) {
                                
                                                    $service = get_post($post_service);
                                                    $service_title = get_the_title( $service->ID );
                                                    $service_link = get_permalink($service->ID);

                                                    $service_tag = new stdClass;
                                                    $service_tag->name = $service_title;
                                                    $service_tag->link = $service_link;

                                                    $service_categories = wp_get_post_terms($post_service, 'services_category', array("fields" => "all"));
                                                    $post_taxonomies = array();
                                                    
                                                    if ( $service_categories ) {
                                                        foreach($service_categories as $category) {
                                                            $category->link = get_term_link( $category->term_id );
                                                            array_push($post_taxonomies, $category);
                                                        }
                                                    }
                                                    array_push($post_taxonomies, $service_tag);

                                                    foreach($post_taxonomies as $post_taxonomy) {
                                                        ?>
                                                        <a class="pm-taxonomy-pill" href="<?php echo $post_taxonomy->link; ?>" title="<?php echo $post_taxonomy->name; ?>">
                                                            <?php echo $post_taxonomy->name; ?>
                                                        </a>
                                                        <?php
                                                    }
                                                }
                                            }?>
                                        </div>
                                    </div>
                                    <div class="flex-1 hidden desktop:block desktop:invisible desktop:group-hover:visible text-sm full-hd:text-base text-black">
                                        <p class="mb-6 full-hd:mb-14"><?php echo $excerpt; ?></p>
                                    </div>
                                    <a class="desktop:invisible desktop:group-hover:visible pm-button pm-button--text-primary" href="<?php echo esc_url( $permalink ); ?>">
                                        <?php echo $news_title = get_field('news_read_more', 'option'); ?>
                                    </a>
                                </div>
                            </div>
                        </article>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        <?php wp_reset_postdata(); ?>
            <div class="container relative py-10">
                <img    
                    class="hidden desktop:block absolute top-0 left-0 z-50" 
                    src="<?php echo get_template_directory_uri() . '/assets/svg/news-dots-2.svg' ?>" 
                    alt="Decorations"
                    style="max-width: 168px;"
                    role="presentation"
                />
                <div class="mx-auto max-w-885px">
                    <?php $news_title = get_field('news_show_all', 'option'); ?>
                    <a class="pm-button pm-button--outline w-full text-center uppercase" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" title="<?php echo $news_title; ?>">
                        <?php echo $news_title; ?>
                    </a>
                </div>
            </div>
        </div>

        <img    
            class="hidden tablet:block flex-initial mb-auto mt-0 absolute top-0 right-0 left-auto" 
            src="<?php echo get_template_directory_uri() . '/assets/svg/news-lines.svg' ?>" 
            alt="Decorations"
            width="352px"
            height="379px"
            role="presentation"
        />

        <div class="guides right-minus-px left-auto bg-dark-purple" role="presentation"></div>
    </div>
</section>