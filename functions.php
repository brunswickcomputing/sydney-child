<?php
/**
 * Sydney child functions
 *
 */


/**
 * Enqueues the parent stylesheet. Do not remove this function.
 *
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
  echo '<div id="loginrow" class="">';
  if ( is_user_logged_in() ) {
    $current_user = wp_get_current_user();
    $accountURL = esc_url( home_url( '/member-account/' ) );
    echo '<p>'.esc_html( $current_user->display_name ).' | <a href="'. $accountURL.'">Profile</a> | <a href="'. wp_logout_url().'">Logout</a></p>';
  } else {
    $loginURL = esc_url( home_url( '/member-login/' ) );
    echo '<p><a href="'.$loginURL.'">Login</a></p>';
  }
  echo '</div>';

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
