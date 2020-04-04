<?php get_header(); ?>

<?php get_template_part ( "template-parts/hero" ); ?>

    <div class="posts">
        <?php
        while( have_posts() ){
            the_post();
        ?>
        <div class="post <?php post_class(); ?>">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="post-title text-center"><?php the_title(); ?></h2>
                        <p class="text-center">
                            <strong><?php the_author(); ?></strong><br/>
                            <?php echo get_the_date('jS F, Y'); ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <p>
                            <?php
                            if( has_post_thumbnail() ){
                                $thum_url = get_the_post_thumbnail_url( null, "large" );
                                printf( '<a href="%s" data-featherlight="image">', $thum_url );
                                the_post_thumbnail( "large", array( "class" => "img-fluid" ) );
                                printf( '</a>' );
                            }
                            ?>
                        </p>
                        <?php 
                        the_content();
                        ?>
                    </div>
                </div>

            </div>
        </div>
        <?php
        }
        ?>
    </div>

<?php get_footer(); ?>