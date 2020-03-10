<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="wrapper">
<?php
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
	?>
	
<div class="preloader-wrap"><div class="preloader"></div></div>
<?php if ( is_front_page() ) : ?>
<div class="entry-anima">
<svg
      id="svg-logo"
      version="1.1"
      xmlns="http://www.w3.org/2000/svg"
      xmlns:xlink="http://www.w3.org/1999/xlink"
      x="0px"
      y="0px"
      viewBox="0 0 1366 768"
      fill="none"
      xml:space="preserve"
    >
      <path
        d="M709.84,404.99l7.54-5.95c2.93,4.94,6.36,7.28,11.22,7.28c3.52,0,6.45-1.34,8.71-3.6
               c2.26-2.18,3.68-5.02,5.53-12.22l9.12-34.07h10.63l-9.79,36.41c-2.26,8.45-4.27,12.98-8.29,16.99c-4.18,4.1-9.71,6.03-16.32,6.03
               C720.06,415.87,713.44,411.77,709.84,404.99z"
        stroke="#c0c0c0"
        stroke-width="2"
        stroke-miterlimit="10"
      />

      <path
        d="M773.13,356.44h10.46l10.21,27.71l25.11-27.71h11.8l-15.74,58.6h-10.46l11.3-42.02l-25.78,27.63h-0.34 l-10.8-27.46l-11.22,41.86h-10.3L773.13,356.44z"
        stroke="#c0c0c0"
        stroke-width="2"
        stroke-miterlimit="10"
      />

      <path
        d="M827.06,404.91l7.78-6.45c4.77,5.44,10.13,8.29,17.66,8.29c6.53,0,11.3-3.26,11.3-8.12
               c0-3.52-2.43-5.61-10.8-8.87c-8.96-3.6-15.07-7.62-15.07-15.74c0-11.05,9.96-18.42,22.52-18.42c9.71,0,16.74,3.52,21.51,8.79
               l-7.2,7.03c-4.44-4.35-8.96-6.7-15.07-6.7c-6.86,0-10.88,3.77-10.88,7.7c0,3.77,2.93,5.61,11.39,8.96
               c8.96,3.52,14.57,7.62,14.57,15.74c0,11.47-10.46,18.75-22.85,18.75C840.87,415.87,832.42,412.02,827.06,404.91z"
        stroke="#c0c0c0"
        stroke-width="2"
        stroke-miterlimit="10"
      />

      <path
        d="M484.03,635.68V132.33c0-7.17,7.77-11.66,13.98-8.07l378.63,218.6h-66.9L533.75,183.52
                c-7.23-4.18-16.28,1.04-16.28,9.4v382.39c0,8.25,8.93,13.41,16.08,9.28l221.7-128l0.1-31.62l121.28,0L498,643.74
                C491.79,647.32,484.03,642.84,484.03,635.68z"
        stroke="#c0c0c0"
        stroke-width="3"
        stroke-miterlimit="10"
      />
    </svg>
</div>
<?php endif; ?>

<header id="site-header" class="site-header" role="banner">
	
	<div class="lang-menu"><ul><?php pll_the_languages(); ?></ul></div>

	<nav>
	<!-- <div class="logo">
		<?php the_custom_logo(); ?>
	</div> -->
	
	<?php if (display_header_text()) : ?>
	<h1 class="site-title">
		<a href="<?php echo esc_attr( home_url( '/' ) ); ?>" title="Home" rel="home">
		<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
		</a>
	</h1>
	<p class="tagline"><?php bloginfo('description'); ?></p>	
	
	<?php endif; ?>	
	
	<?php wp_nav_menu(); ?>
	<div class="burger">
		<div class="line1"></div>
		<div class="line2"></div>
		<div class="line3"></div>
	</div>
	</nav>

</header>

<?php
}
