<?php
/**
 * Sydney child functions
 *
 * @package Sydney_child
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
add_action( 'wp_enqueue_scripts', 'sydney_child_enqueue_styles', 15 );
/**
 * Override woocommerce_header_cart function in parent theme.
 * display login/account/logout links
 *
 */
function sydney_woocommerce_header_cart() {
	if ( is_user_logged_in() ) {
		$current_user   = wp_get_current_user();
		$account_url    = esc_url( home_url( '/member-account/' ) );
		$favourites_url = esc_url( home_url( '/member-account/favourites/' ) );
		$messages_url   = esc_url( home_url( '/member-account/messages/' ) );
		if ( class_exists( 'Racketmanager\Racketmanager_Player' ) ) {
			$user = Racketmanager\get_player( get_current_user_id() );
			if ( $user ) {
				$message_count = $user->get_messages(
					array(
						'count'  => true,
						'status' => 'unread',
					)
				);
			}
		}
		?>
		<div class="dropdown">
			<a class="nav-link dropdown-toggle header-username" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				<?php echo esc_html( $current_user->display_name ); ?>
			</a>
			<ul class="dropdown-menu">
				<li>
					<a class="dropdown-item" href="<?php echo esc_attr( $account_url ); ?>"><?php esc_html_e( 'Profile', 'sydney' ); ?></a>
				</li>
				<li><hr class="dropdown-divider"></li>
				<li>
					<a class="dropdown-item" href="<?php echo esc_attr( $messages_url ); ?>"><?php esc_html_e( 'Messages', 'sydney' ); ?><?php echo ( empty( $message_count ) ) ? '' : ' (' . esc_html( $message_count ) . ')'; ?></a>
				</li>
				<li><hr class="dropdown-divider"></li>
				<li>
					<a class="dropdown-item" href="<?php echo esc_attr( $favourites_url ); ?>"><?php esc_html_e( 'Favourites', 'sydney' ); ?></a>
				</li>
				<li><hr class="dropdown-divider"></li>
				<li>
					<a class="dropdown-item" href="<?php echo esc_url( wp_logout_url() ); ?>"><?php esc_html_e( 'Logout', 'sydney' ); ?></a>
				</li>
			</ul>
		</div>
		<?php
	} else {
		$login_url = esc_url( home_url( '/member-login/' ) );
		if ( get_option( 'users_can_register' ) ) {
			$register_url = esc_url( home_url( '/member-login?action=register' ) );
		} else {
			$register_url = null;
		}
		?>
		<div id="loginrow" class="">
			<p>
				<a href="<?php echo esc_attr( $login_url ); ?>">Login</a>
				<?php
				if ( ! empty( $register_url ) ) {
					?>
					| <a href="<?php echo esc_attr( $register_url ); ?>"><?php esc_html_e( 'Register', 'sydney' ); ?></a>
					<?php
				}
				?>
			</p>
		</div>
		<?php
	}

}
/**
 * Include files used by this theme.
 */
function sydney_child_includes() {
	require_once get_theme_file_path( 'includes/classes/class-woocommerce-dummy.php' );
	require_once 'includes/widgets/sydney-author-archive.php';
}
add_action( 'after_setup_theme', 'sydney_child_includes' );

/**
 * Add google fonts.
 */
function sydney_child_add_google_fonts() {
	wp_enqueue_style( 'sydney-child-google-fonts', 'https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@900&display=swap', array(), '3.1' );
	wp_enqueue_style( 'sydney-child-google-fonts', 'https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@700&display=swap', array(), '3.1' );
}
add_action( 'wp_enqueue_scripts', 'sydney_child_add_google_fonts' );
/**
 * Dummy functions to handle dummy WooCommerce class.
 */
function is_shop() {
	return false;
}
/**
 * Dummy functions to handle dummy WooCommerce class.
 */
function is_cart() {
	return false;
}
/**
 * Dummy functions to handle dummy WooCommerce class.
 */
function is_product_category() {
	return false;
}
/**
 * Dummy functions to handle dummy WooCommerce class.
 */
function is_woocommerce() {
	return false;
}
/**
 * Dummy functions to handle dummy WooCommerce class.
 */
function is_checkout() {
	return false;
}
/**
 * Dummy functions to handle dummy WooCommerce class.
 */
function is_account_page() {
	return false;
}
