<?php
/**
 * Widget API: WP_Widget_Archives class
 *

 */

/**
 * Core class used to implement the Author Archives widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class Sydney_Author_Archive extends WP_Widget {

	/**
	 * Sets up a new Archives widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'sydney_author_archive',
			'description' => __( 'An archive of your site&#8217;s Posts by author.' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct('author_archives', __('Sydney: Author Archive'), $widget_ops);
	}

	/**
	 * Outputs the settings form for the Author Archives widget.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'optioncount' => 0, 'excludeadmin' => 0, 'showfullname' => 0) );
		$title = sanitize_text_field( $instance['title'] );
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p>
			<input class="checkbox" type="checkbox"<?php checked( $instance['excludeadmin'] ); ?> id="<?php echo $this->get_field_id('excludeadmin'); ?>" name="<?php echo $this->get_field_name('excludeadmin'); ?>" /> <label for="<?php echo $this->get_field_id('excludeadmin'); ?>"><?php _e('Exclude admin author'); ?></label>
			<br/>
			<input class="checkbox" type="checkbox"<?php checked( $instance['optioncount'] ); ?> id="<?php echo $this->get_field_id('optioncount'); ?>" name="<?php echo $this->get_field_name('optioncount'); ?>" /> <label for="<?php echo $this->get_field_id('optioncount'); ?>"><?php _e('Show post counts'); ?></label>
			<br/>
			<input class="checkbox" type="checkbox"<?php checked( $instance['showfullname'] ); ?> id="<?php echo $this->get_field_id('showfullname'); ?>" name="<?php echo $this->get_field_name('showfullname'); ?>" /> <label for="<?php echo $this->get_field_id('showfullname'); ?>"><?php _e('Show full name'); ?></label>
		</p>
		<?php
	}
	/**
	 * Handles updating settings for the current Author Archives widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            Sydney_Author_Archive::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, array( 'title' => '', 'optioncount' => 0, 'excludeadmin' => 0, 'showfullname' => 0) );
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['optioncount'] = $new_instance['optioncount'] ? 1 : 0;
		$instance['excludeadmin'] = $new_instance['excludeadmin'] ? 1 : 0;
		$instance['showfullname'] = $new_instance['showfullname'] ? 1 : 0;

		return $instance;
	}

	/**
	 * Outputs the content for the current Archives widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Archives widget instance.
	 */
	function widget( $args, $instance ) {
		$optioncount = ! empty( $instance['optioncount'] ) ? '1' : '0';
		$excludeadmin = ! empty( $instance['excludeadmin'] ) ? '1' : '0';
		$showfullname = ! empty( $instance['showfullname'] ) ? '1' : '0';

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Author Archives' ) : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<div class="archives-authors-section">
			<ul>
		<?php /**
		 * Filters the arguments for the Author Archives widget.
		 *
		 * @since 2.8.0
		 *
		 * @see wp_list_authors()
		 *
		 * @param array $args An array of Author Archives option arguments.
		 */
			
			wp_list_authors( array(
							   'optioncount'		=> $optioncount,
							   'exclude_admin'		=> $excludeadmin,
							   'show_fullname'		=> $showfullname
							   )
						);
			?>
			</ul>
		</div>

		<?php echo $args['after_widget'];
	}

}
			
// register widget
            add_action('widgets_init', function() { register_widget( 'Sydney_Author_Archive' ); });

