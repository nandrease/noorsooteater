<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Noorsooteater
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<main id="content" class="site-main">

	<?php if ( apply_filters( 'noorsooteater_page_title', true ) ) : ?>
		<header class="page-header">
			<h1 class="entry-title"><?php echo esc_html__( 'The page can&rsquo;t be found.', 'noorsooteater' ); ?></h1>
		</header>
	<?php endif; ?>

	<div class="page-content">
		<p><?php echo esc_html__( 'It looks like nothing was found at this location.', 'noorsooteater' ); ?></p>
	</div>

</main>
