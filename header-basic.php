<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Sydney
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php wp_head(); ?>
	</head>
	<body class="page--basic">
		<?php wp_body_open(); ?>
		<div id="page" class="basic">
			<?php do_action( 'sydney_basic_header' ); ?>
			<div id="content" class="basic-body">
				<div class="content-wrapper <?php echo esc_attr( apply_filters( 'sydney_main_container', 'container' ) ); ?>">
					<div class="row">
