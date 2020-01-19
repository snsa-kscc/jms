<?php
include_once get_theme_file_path( '/vendor/autoload.php' );

$helperLoader = new SplClassLoader('Helpers', get_theme_file_path( '/vendor' ));
$helperLoader->register();

use Helpers\Config;

$config = new Config;
$config->load(get_theme_file_path( '/config/config.php' ));

get_header();

if (have_posts()) :
	while ( have_posts() ) : the_post();
?>

<main id="main" class="site-main" role="main">

	<header class="page-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>

	<div class="page-content">
		<?php the_content(); ?>
	</div>
	<div class="form">
        <form enctype="application/x-www-form-urlencoded;" id="contact-form" class="form-horizontal" role="form" method="post">
            <div class="form-group" id="name-field">
                <label for="form-name" class="form-name"><?php echo $config->get('fields.name'); ?></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="form-name" name="form-name" placeholder="<?php echo $config->get('fields.name'); ?>" required>
                </div>
            </div>
            <div class="form-group" id="email-field">
                <label for="form-email" class="form-email"><?php echo $config->get('fields.email'); ?></label>
                <div class="col-lg-10">
                    <input type="email" class="form-control" id="form-email" name="form-email" placeholder="<?php echo $config->get('fields.email'); ?>" required>
                </div>
            </div>
            <div class="form-group" id="subject-field">
                <label for="form-subject" class="form-subject"><?php echo $config->get('fields.subject'); ?></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="form-subject" name="form-subject" placeholder="<?php echo $config->get('fields.subject'); ?>" required>
                </div>
            </div>
            <div class="form-group" id="message-field">
                <label for="form-message" class="form-message"><?php echo $config->get('fields.message'); ?></label>
                <div class="col-lg-10">
                    <textarea class="form-control" rows="6" id="form-message" name="form-message" placeholder="<?php echo $config->get('fields.message'); ?>" required></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="form-btn">
                    <button type="submit" class="btn"><?php echo $config->get('fields.btn-send'); ?></button>
                </div>
            </div>
        </form>
    </div>

</main>

<?php endwhile;
endif;

get_footer();
