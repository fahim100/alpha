<?php get_header(); ?>
<?php get_template_part( "template-parts/hero" ); ?>
<div class="container">
    <div class="author-section">
        <div class="row">
            <div class="col-md-2 author-image">
            <?php echo get_avatar( get_the_author_meta( "id" ) ); ?>
            </div>
            <div class="col-md-10">
                <h4><?php echo get_the_author_meta( "display_name" ); ?></h4>
                <p><?php echo get_the_author_meta( "description" ); ?></p>
            </div>
        </div>
    </div>
</div>
<div class="posts">
    <?php
    while( have_posts() ){
        the_post();
    ?>
    <h2 class="text-center"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php
    }
    ?>

    <div class="container post-pagination">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-8">
                <?php
                    the_posts_pagination( array(
                        "mid_size" => 3,
                        'screen_reader_text' => ' ',
                    ) );
                ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>