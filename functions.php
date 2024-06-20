<?php
/**
 * Sydney child functions
 *
 */
	
/**
 * Enqueues the parent stylesheet. Do not remove this function.
 */
add_action( 'wp_enqueue_scripts', 'sydney_child_enqueue' );
function sydney_child_enqueue() {

	wp_dequeue_style( 'sydney-bootstrap' );
	wp_enqueue_style( 'sydney-child-bootstrap', get_theme_file_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

/* ADD YOUR CUSTOM FUNCTIONS BELOW */
function child_enqueue_styles() {
	wp_enqueue_script( 'bootstrap-js', get_theme_file_uri() . '/js/bootstrap.bundle.min.js', array( 'jquery' ),'',true );
}
add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );
/**
 * Override woocommerce_header_cart function in parent theme.
 * display login/account/logout links
 *
 */
function sydney_woocommerce_header_cart() {
	if ( is_user_logged_in() ) {
		$current_user    = wp_get_current_user();
		$account_url     = esc_url( home_url( '/member-account/' ) );
		$favourites_url  = esc_url( home_url( '/member-account/favourites/' ) );
		$messages_url    = esc_url( home_url( '/member-account/messages/' ) );
		?>
		<div class="dropdown">
			<a class="nav-link dropdown-toggle header-username" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				<?php echo esc_html( $current_user->display_name ); ?>
			</a>
			<ul class="dropdown-menu">
				<li><a class="dropdown-item" href="<?php echo esc_attr( $account_url ); ?>"><?php esc_html_e( 'Profile', 'sydney' ); ?></a></li>
				<li><hr class="dropdown-divider"></li>
				<li><a class="dropdown-item" href="<?php echo esc_attr( $messages_url ); ?>"><?php esc_html_e( 'Messages', 'sydney' ); ?></a></li>
				<li><hr class="dropdown-divider"></li>
				<li><a class="dropdown-item" href="<?php echo esc_attr( $favourites_url ); ?>"><?php esc_html_e( 'Favourites', 'sydney' ); ?></a></li>
				<li><hr class="dropdown-divider"></li>
				<li><a class="dropdown-item" href="<?php echo wp_logout_url(); ?>"><?php esc_html_e( 'Logout', 'sydney' ); ?></a></li>
			</ul>
		</div>
		<?php
	} else {
		$loginURL = esc_url( home_url( '/member-login/' ) );
		?>
		<div id="loginrow" class="">
			<p><a href="<?php echo esc_attr( $loginURL ); ?>">Login</a></p>
		</div>
		<?php
	}

}
/**
 * Include files used by this theme.
 *
 */
function mytheme_includes() {
		require_once get_theme_file_path( 'includes/classes/class-woocommerce-dummy.php' );
		require_once( 'includes/widgets/sydney-author-archive.php' );
}
add_action( 'after_setup_theme', 'mytheme_includes' );

/**
 * Dummy functions to handle dummy WooCommerce class.
 *
 */
function is_shop() {
	return false;
}
function is_cart() {
	return false;
}
function is_product_category() {
	return false;
}
function is_woocommerce() {
	return false;
}
function is_checkout() {
	return false;
}
function is_account_page() {
	return false;
}
function register_user_menu() {
	register_nav_menu('user-menu',__( 'User Menu' ));
}
add_action( 'init', 'register_user_menu' );
function sydney_child_add_google_fonts() {
	wp_enqueue_style( 'sydney-child-google-fonts', 'https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@900&display=swap',array(), null );
	wp_enqueue_style( 'sydney-child-google-fonts', 'https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@700&display=swap',array(), null );
}
add_action( 'wp_enqueue_scripts', 'sydney_child_add_google_fonts' );
