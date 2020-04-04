<?php get_header(); ?>
<?php get_template_part( "template-parts/hero" ); ?>
<div class="posts">

    <h2 class="text-center">Post In 
    <?php 
    if( is_month() ){
        $month = esc_html( get_query_var( "monthnum" ) );
        $dateobj = DateTime::createFromFormat("!m", $month);
        echo $dateobj->format( "F" );
    } elseif( is_year() ) {
        echo esc_html( get_query_var( "year" ) );
    } elseif ( is_day() ) {
        $day = esc_html( get_query_var( "day" ) );
        $month = esc_html( get_query_var( "monthnum" ) );
        $year = esc_html( get_query_var( "year" ) );
        printf( "%s/%s/%s", $day, $month, $year );
    }
    ?>
    </h2>
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