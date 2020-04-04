<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if( current_theme_supports( "cousom-logo" ) ) { ?>
                    <div class="header-logo text-center">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php } ?>
                <h3 class="tagline"><?php bloginfo("description"); ?></h3>
                <h1 class="align-self-center display-1 text-center heading"><a href="<?php echo site_url(); ?>"><?php bloginfo("name") ?></a></h1>
            </div>
            <div class="col-md-12">
                <div class="navigation">
                <?php
                    wp_nav_menu(array(
                        'theme_location'  => 'topmenu',
                        'menu_id'         => 'topmennucontaoner',
                        'menu_class'      => 'list-inline text-center',
                    ))
                ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
            <?php if( is_search() ){ ?>
                <h3><?php _e( "You search for ", 'alpha' ); ?> : <?php echo get_search_query(); ?></h3>
            <?php } ?>
            <?php echo get_search_form(); ?>
            </div>
        </div>
    </div>
</div>