<?php
/**
 * Sydney child functions
 *
 * @package Sydney_child
 */

/**
 * Enqueues the parent stylesheet. Do not remove this function.
 */
function sydney_child_enqueue() {
	wp_dequeue_style( 'sydney-bootstrap' );
	wp_enqueue_style( 'sydney-child-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), '3.3' );
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array(), '3.3' );
}
add_action( 'wp_enqueue_scripts', 'sydney_child_enqueue' );
/* ADD YOUR CUSTOM FUNCTIONS BELOW */
/**
 * Enqueue styles function
 *
 * @return void
 */
function sydney_child_enqueue_styles() {
	wp_dequeue_script( 'bootstrap-js' );
	wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), '3.3', true );
}
add_action( 'wp_enqueue_scripts', 'sydney_child_enqueue_styles', 15 );
/**
 * Override woocommerce_header_cart function in parent theme.
 * display login/account/logout links
 */
function sydney_woocommerce_header_cart() {
	if ( is_user_logged_in() ) {
		$current_user    = wp_get_current_user();
		$account_url     = esc_url( home_url( '/member-account/' ) );
		$favourites_url  = esc_url( home_url( '/member-account/favourites/' ) );
		$messages_url    = esc_url( home_url( '/member-account/messages/' ) );
		$memberships_url = esc_url( home_url( '/member-account/memberships/' ) );
		if ( class_exists( 'Racketmanager\Racketmanager_User' ) ) {
			$rm_user = Racketmanager\get_user( get_current_user_id() );
			if ( $rm_user ) {
				$profile_url = esc_url( home_url( '/player/' . Racketmanager\seo_url( $rm_user->display_name ) . '/' ) );
				if ( ! empty( $rm_user->btm ) ) {
					$profile_url .= $rm_user->btm . '/';
				}
				$message_count = $rm_user->get_messages(
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
					<a class="dropdown-item" href="<?php echo esc_attr( $profile_url ); ?>"><?php esc_html_e( 'Profile', 'sydney' ); ?></a>
				</li>
				<li>
					<a class="dropdown-item" href="<?php echo esc_attr( $account_url ); ?>"><?php esc_html_e( 'Account', 'sydney' ); ?></a>
				</li>
				<li>
					<a class="dropdown-item" href="<?php echo esc_attr( $memberships_url ); ?>"><?php esc_html_e( 'Memberships', 'sydney' ); ?></a>
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
/**
 * Basic Footer area
 */
function sydney_basic_footer_area() {
	$container = get_theme_mod( 'footer_credits_container', 'container' );
	$credits   = sydney_footer_credits();
	?>

	<footer id="colophon" class="site-footer">
		<div class="<?php echo esc_attr( $container ); ?>">
			<div class="site-info">
				<div class="row">
					<div class="col-12">
						<?php echo wp_kses_post( $credits ); ?>
					</div>
				</div>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

	<?php
}
add_action( 'sydney_basic_footer', 'sydney_basic_footer_area' );
/**
 * Basic Header area
 */
function sydney_basic_header_area() {
	$container = get_theme_mod( 'header_container', 'container' );
	?>

	<div id="masthead" class="basic-header">
		<div class="<?php echo esc_attr( $container ); ?>">
			<div class="row valign">
				<div class="col-12 align-center">
					<?php
					$sydney_header = new Sydney_Header();
					$sydney_header->logo( $context = 'main' );
					?>
				</div>
			</div>
		</div>
	</div>

	<?php
}
add_action( 'sydney_basic_header', 'sydney_basic_header_area' );
