<?php /* Template Name: Staff Template */ ?>
<?php get_header(); ?>

<?php if(post_type_exists("post_staff")) : ?>

    <?php if($content = $post->post_content) { ?>

    <div class="container pm-containerPadding-top-80">
        <div class="row">
            <div class="col-lg-12">
            
                <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                    
                    <?php the_content(); ?>
                
                <?php endwhile; else: ?>
                    
                <?php endif; ?> 
            
            </div>
        </div>
    </div>

    <?php } ?>


    <?php 
    $terms = get_terms('staffcats');
    ?>

    <!-- Events filter system -->
    <?php if($content = $post->post_content) { ?>
    <div class="container pm-containerPadding-top-60 pm-containerPadding-bottom-60">
    <?php } else { ?>
    <div class="container pm-containerPadding-top-80 pm-containerPadding-bottom-60">
    <?php } ?>

    <div class="row">

        <div class="col-lg-12 pm-containerPadding-bottom-40">
            
            <div class="pm-featured-header-container">
                
                <!-- Filter menu -->
                <div class="pm-isotope-filter-container">
                    <ul class="pm-isotope-filter-system">
                        <li class="pm-isotope-filter-system-expand"><?php esc_attr_e('Currently Viewing:', 'quantumtheme'); ?> <i class="fa fa-angle-down"></i></li>
                        <li>
                            <div class="pm-rounded-btn">
                                <a href="#" class="current" id="all"><?php esc_attr_e('All', 'quantumtheme'); ?></a>
                            </div>
                        </li>
                        <?php
                            foreach ($terms as $term) {
                                echo '<li><div class="pm-rounded-btn"><a href="#" id="'.$term->slug.'">'.ucfirst($term->name).'</a></div></li>';	
                            }
                        ?>
                    </ul>
                </div>
                <!-- Filter menu end -->
            
            </div>
            
        </div><!-- /.col-lg-12 -->
        
        <?php
            
            $staffPostsOrder = get_theme_mod('staffPostsOrder', 'ASC');
        
            //global $paged;
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        
            $arguments = array(
                'post_type' => 'post_staff',
                'post_status' => 'publish',
                'paged' => $paged,
                'posts_per_page' => -1,
                'order' => $staffPostsOrder
                //'tag' => get_query_var('tag')
            );
        
            $blog_query = new WP_Query($arguments);
        
            pm_ln_set_query($blog_query);
            
            //$count_posts = wp_count_posts('post_staff');
            //$published_posts = $count_posts->publish;
            
        ?>
        
        <div id="pm-isotope-item-container">
        
            <?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                
                <?php get_template_part( 'content', 'staffpost' ); ?>
            
            <?php endwhile; else: ?>
                <p><?php esc_attr_e('No staff posts were found.', 'quantumtheme'); ?></p>
            <?php endif; ?>
                        
            <?php pm_ln_restore_query(); ?> 
        
        </div>
        
        
                        
    </div>
    </div>
    <!-- Staff filter system end -->

<?php endif; ?>

<?php get_footer(); ?>