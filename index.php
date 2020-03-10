<?php
get_header();

if ( is_singular() ) {
		
	while ( have_posts() ) : the_post();
?>

<main id="main" class="site-main" role="main">

	<!-- <header class="page-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header> -->

	<div class="page-content">
		<?php the_content(); ?>
	</div>

</main>

<?php endwhile;
} elseif ( is_archive() ) {
?>

<main id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="page-header">
		<h1 class="entry-title"><?php the_archive_title(); ?></h1>
	</header>

	<div class="page-content">
			<?php 
			if (have_posts()) :
				while ( have_posts() ) : the_post();
					printf( '<h1><a href="%s">%s</a></h1>', get_permalink(), get_the_title() );		
					the_post_thumbnail();
					the_excerpt();
					comments_template();
				endwhile;
			else:
			echo '<p>' . esc_html__('No results', 'jms') . '</p>';
			endif;
			the_tags( '<span class="tag-links">' . __('Tagged ', 'jms' ) . NULL, NULL, NULL, '</span>' ) ?>		
		
	</div>
	
	<div class="entry-links"><?php wp_link_pages(); ?></div>
	
	<?php global $wp_query; if ( $wp_query->max_num_pages > 1 ) { ?>
	<nav id="nav-below" class="navigation" role="navigation">
		<div class="nav-previous"><?php next_posts_link(sprintf( __( '%s older', 'jms' ), '<span class="meta-nav">&larr;</span>' ) ) ?></div>
		<div class="nav-next"><?php previous_posts_link(sprintf( __( 'newer %s', 'jms' ), '<span class="meta-nav">&rarr;</span>' ) ) ?></div>
	</nav>
	<?php } ?>

</main>

<?php
} elseif ( is_search() ) {
	?>
	
	<main id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<header class="page-header">
			<h1 class="entry-title"><?php echo esc_html__('Results for: ', 'jms') . get_search_query(); ?></h1>
		</header>
	
		<div class="page-content">
				<?php 
				if (have_posts()) :
					while ( have_posts() ) : the_post();
						printf( '<h1><a href="%s">%s</a></h1>', get_permalink(), get_the_title() );		
						the_post_thumbnail();
						the_excerpt();
						comments_template();
					endwhile;
				else:
				echo '<p>' . esc_html__('No results', 'jms') . '</p>';
				endif;
				the_tags( '<span class="tag-links">' . __('Tagged ', 'jms' ) . NULL, NULL, NULL, '</span>' ) ?>		
			
		</div>
		
		<div class="entry-links"><?php wp_link_pages(); ?></div>
		
		<?php global $wp_query; if ( $wp_query->max_num_pages > 1 ) { ?>
		<nav id="nav-below" class="navigation" role="navigation">
			<div class="nav-previous"><?php next_posts_link(sprintf( __( '%s older', 'jms' ), '<span class="meta-nav">&larr;</span>' ) ) ?></div>
			<div class="nav-next"><?php previous_posts_link(sprintf( __( 'newer %s', 'jms' ), '<span class="meta-nav">&rarr;</span>' ) ) ?></div>
		</nav>
		<?php } ?>
	
	</main>
	
	<?php
} elseif ( is_home() ) {
?>

<main id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="page-header">
		<h1 class="entry-title"><?php _e( 'Entries', 'jms' ); ?></h1>
	</header>

	<div class="page-content">
		<?php
		while ( have_posts() ) : the_post();
			printf( '<h1><a href="%s">%s</a></h1>', get_permalink(), get_the_title() );		
			the_post_thumbnail();
			the_excerpt();
			comments_template();
		endwhile;

		the_tags( '<span class="tag-links">' . __('Tagged ', 'jms' ) . NULL, NULL, NULL, '</span>' ) ?>		
		
	</div>
	
	<div class="entry-links"><?php wp_link_pages(); ?></div>
	
	<?php global $wp_query; if ( $wp_query->max_num_pages > 1 ) { ?>
	<nav id="nav-below" class="navigation" role="navigation">
		<div class="nav-previous"><?php next_posts_link(sprintf( __( '%s older', 'jms' ), '<span class="meta-nav">&larr;</span>' ) ) ?></div>
		<div class="nav-next"><?php previous_posts_link(sprintf( __( 'newer %s', 'jms' ), '<span class="meta-nav">&rarr;</span>' ) ) ?></div>
	</nav>
	<?php } ?>

</main>

<?php
} else {
	?>
	
<main id="main" class="site-main" role="main">

<header class="page-header">
	<h1 class="entry-title"><?php _e( 'The page cannot be found.', 'jms' ); ?></h1>
</header>

<div class="page-content">
	<p><?php _e( 'Sorry, nothing found at this location.', 'jms' ); ?></p>
</div>

</main>
<?php
}
get_footer();
