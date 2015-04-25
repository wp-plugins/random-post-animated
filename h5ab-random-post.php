<?php
/**
 * Plugin Name: Random Post Animated
 * Plugin URI: https://www.html5andbeyond.com/random-post-animated-widget-wordpress-plugin/
 * Description: Displays randomly selected links to posts from a selection list according to an adjustable time interval.
 * Version: 0.1
 * Author: HTML5andBeyond
 * Author URI: https://www.html5andbeyond.com/
 * License: GPL2 or Later
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'H5AB_RANDOM_WIDGET_DIR', plugin_dir_path( __FILE__ ) );
define( 'H5AB_RANDOM_WIDGET_URL', plugin_dir_url( __FILE__ ) );


class H5AB_RANDOM_POST_WIDGET extends WP_Widget {
	
	function __construct() {
		
		parent::__construct(
				'h5ab_random_post_widget',
				__( 'Random Post', 'text_domain' ),
				array( 'description' => __( 'Animated Random Post Widget', 'text_domain' ), )
			);	
	}

	public function widget( $args, $instance ) {
	
		echo $args['before_widget'];

        echo $args['before_title'] . apply_filters( 'widget_title', $instance['h5abtitle'] ). $args['after_title'];

        $widegtArgs = array('posts_per_page' => $instance['h5abpostnumber'], 'orderby' => 'rand', 'category_name' => $instance['h5abcategoryname'], 'exclude' => $instance['h5abrandexclude']);
        $posts_array = get_posts( $widegtArgs );
		$rand = rand(0, 100); 
		$id = 'h5ab-random-post_' . $rand;
		$class = 'h5ab-random-post';
		$slider_timer = esc_attr($instance['h5abslidertimer']);
        $widget_height = esc_attr($instance['h5abrandheight']);

        echo __("<ul class= '". esc_attr($class) . "' id='". esc_attr($id) ."'  data-rand = '" . esc_attr($rand) . "' data-timer = '" . $slider_timer ."' style='height:" . $widget_height . "px;'>", 'text_domain' );
	
		foreach($posts_array as $item) {
			echo __('<li><a href=' . esc_url($item->guid) . '>' . esc_attr($item->post_title) . '</a></li>', 'text_domain' );
        }

        echo __('</ul>', 'text_domain' );

        echo $args['after_widget'];


			wp_register_script('post-settings-load', H5AB_RANDOM_WIDGET_URL . 'js/h5ab-random-post-setting-load.js');
			wp_enqueue_script( 'post-settings-load', H5AB_RANDOM_WIDGET_URL . 'js/h5ab-random-post-setting-load.js', array('jquery'), '', true);
	  
	}

	public function form( $instance ) {
		$h5abtitle = ! empty( $instance['h5abtitle'] ) ? $instance['h5abtitle'] : __( 'Title', 'text_domain' );
        $h5abcategoryname = ! empty( $instance['h5abcategoryname'] ) ? $instance['h5abcategoryname'] : __( '', 'text_domain' );
        $h5abrandexclude = ! empty( $instance['h5abrandexclude'] ) ? $instance['h5abrandexclude'] : __( '', 'text_domain' );
        $h5abpostnumber = ! empty( $instance['h5abpostnumber'] ) ? $instance['h5abpostnumber'] : __( '2', 'text_domain' );
        $h5abrandheight = ! empty( $instance['h5abrandheight'] ) ? $instance['h5abrandheight'] : __( '75', 'text_domain' );
        $h5abslidertimer = ! empty( $instance['h5abslidertimer'] ) ? $instance['h5abslidertimer'] : __( '7', 'text_domain' );

		?>
		<p>
            <label for="<?php echo $this->get_field_id( 'h5abtitle' ); ?>">Title:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'h5abtitle' ); ?>" name="<?php echo $this->get_field_name( 'h5abtitle' ); ?>" type="text" value="<?php echo esc_attr( $h5abtitle ); ?>">
		</p>
		<p>
            <label for="<?php echo $this->get_field_id( 'h5abpostnumber' ); ?>">Number of Posts to Display</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'h5abpostnumber' ); ?>" name="<?php echo $this->get_field_name( 'h5abpostnumber' ); ?>" type="text" value="<?php echo esc_attr( $h5abpostnumber ); ?>">
		</p>
		<p>
            <label for="<?php echo $this->get_field_id( 'h5abcategoryname' ); ?>">Categories (comma separated):</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'h5abcategoryname' ); ?>" name="<?php echo $this->get_field_name( 'h5abcategoryname' ); ?>" type="text" value="<?php echo esc_attr( $h5abcategoryname ); ?>">
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'h5abrandexclude' ); ?>">Exclude (post ids - comma separated):</label>
    		<input class="widefat" id="<?php echo $this->get_field_id( 'h5abrandexclude' ); ?>" name="<?php echo $this->get_field_name( 'h5abrandexclude' ); ?>" type="text" value="<?php echo esc_attr( $h5abrandexclude ); ?>">
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'h5abrandheight' ); ?>">Widget Height:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'h5abrandheight' ); ?>" name="<?php echo $this->get_field_name( 'h5abrandheight' ); ?>" type="text" value="<?php echo esc_attr( $h5abrandheight ); ?>" style="width: 90%;"><label>px</label>
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'h5abslidertimer' ); ?>">Animation Speed (Seconds):</label>
    		<input class="widefat" id="<?php echo $this->get_field_id( 'h5abslidertimer' ); ?>" name="<?php echo $this->get_field_name( 'h5abslidertimer' ); ?>" type="text" value="<?php echo esc_attr( $h5abslidertimer ); ?>">
		</p>

<hr/>
<div style="text-align: center;">
<p><b>Affiliate Advertisement</b></p>
<p><a href="http://themeover.com?ap_id=html5andbeyond">Microthemer - Visual Editor for your WP Site.</a></p>
<p>We (Plugin Authors) earn commission on sales generated through this link.</p>
</div>
<hr/>
		<?php
	}

	public function update( $new_instance, $old_instance ) {

		$instance = array();
		$instance['h5abtitle'] = ( ! empty( $new_instance['h5abtitle'] ) ) ? strip_tags( $new_instance['h5abtitle'] ) : '';
        $instance['h5abcategoryname'] = ( ! empty( $new_instance['h5abcategoryname'] ) ) ? strip_tags( $new_instance['h5abcategoryname'] ) : '';
        $instance['h5abrandexclude'] = ( ! empty( $new_instance['h5abrandexclude'] ) ) ? strip_tags( $new_instance['h5abrandexclude'] ) : '';
        $instance['h5abpostnumber'] = ( ! empty( $new_instance['h5abpostnumber'] ) ) ? strip_tags( $new_instance['h5abpostnumber'] ) : '';
        $instance['h5abrandheight'] = ( ! empty( $new_instance['h5abrandheight'] ) ) ? strip_tags( $new_instance['h5abrandheight'] ) : '';
        $instance['h5abslidertimer'] = ( ! empty( $new_instance['h5abslidertimer'] ) ) ? strip_tags( $new_instance['h5abslidertimer'] ) : '';

		return $instance;

	}

}

function register_H5AB_RANDOM_POST_WIDGET() {
	 
    register_widget( 'H5AB_RANDOM_POST_WIDGET' );
}

add_action( 'widgets_init', 'register_H5AB_RANDOM_POST_WIDGET' );

?>
