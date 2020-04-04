<?php 
$alpha_layout_class = "col-md-8";
$alpha_text_center = "";
if( !is_active_sidebar("sidebar-1") ){
    $alpha_layout_class = "col-md-10 offset-md-1";
    $alpha_text_center = "text-center";
}
?>
<?php get_header(); ?>

<?php get_template_part ( "template-parts/hero" ); ?>

<div class="container">
    <div class="row">
        <div class="<?php echo $alpha_layout_class; ?>">
            <div class="posts">
                <?php
                while( have_posts() ){
                    the_post();
                ?>
                <div <?php post_class(); ?>>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="post-title <?php echo $alpha_text_center; ?>"><?php the_title(); ?></h2>
                                <p class="<?php echo $alpha_text_center; ?>">
                                    <strong><em><?php the_author_posts_link(); ?></em></strong><br/>
                                    <?php echo get_the_date('jS F, Y'); ?>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="slider">
                                <?php
                                if ( class_exists( 'Attachments' ) ) {
                                    $attachments = new Attachments( 'slider' );
                                    if( $attachments -> exist() ){
                                        while( $attachment = $attachments->get() ) { ?>
                                            <div class="slider-item">
                                                <?php echo $attachments->image( 'large' ); ?>
                                            </div>
                                        <?php }
                                    }
                                }
                                ?>
                                </div>
                                <p>
                                    <?php
                                    if ( !class_exists( 'Attachments' ) ) {
                                        if( has_post_thumbnail() ){
                                            $thum_url = get_the_post_thumbnail_url( null, "large" );
                                            printf( '<a href="%s" data-featherlight="image">', $thum_url );
                                            the_post_thumbnail( "large", array( "class" => "img-fluid" ) );
                                            printf( '</a>' );
                                        }
                                    }
                                    ?>
                                </p>
                                <?php 
                                the_content();

                                next_post_link();
                                echo "</br>";
                                previous_post_link();
                                ?>
                                <div class="author-section">
                                    <div class="row">
                                        <div class="col-md-2 author-image">
                                        <?php echo get_avatar( get_the_author_meta( "ID" ) ); ?>
                                        </div>
                                        <div class="col-md-10">
                                            <h4><?php echo get_the_author_meta( "display_name" ); ?></h4>
                                            <p><?php echo get_the_author_meta( "description" ); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if ( comments_open() ) { ?>
                                <div class="col-md-12">
                                    <?php comments_template(); ?>
                                </div>
                            <?php } ?>
                        </div>

                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        <?php if ( is_active_sidebar("sidebar-1") ) : ?>
        <div class="col-md-4">
            <?php
            if ( is_active_sidebar("sidebar-1") ){
                dynamic_sidebar("sidebar-1");
            }
            ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>