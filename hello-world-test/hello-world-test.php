<?php
/**
 * Plugin Name: Hello World Test
 * Plugin URI: https://github.com/webyanazagrebelna/test_task
 * Description: Output "hello world" in the newest post via browser console
 * Author: yanazagrebelna
 * Author URI: https://github.com/webyanazagrebelna
 * Version: 1.0
 *
 * @package hello-world-test
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Class for outputing "hello world" in the newest post via browser console
 */
class HelloWorldTest {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'display_message' ) );
	}

	/**
	 * Get the ID of last published post
	 *
	 * @return int
	 */
	public function get_last_post_id() {
		$posts_array  = get_posts(
			array(
				'numberposts' => -1,
				'post_type'   => 'post',
			)
		);
		$last_post_id = $posts_array[0]->ID;

		return $last_post_id;
	}

	/**
	 * Loads jsscript for last published post
	 */
	public function display_message() {
		$post_id = $this->get_last_post_id();
		if ( $post_id ) {
			if ( is_single( $post_id ) ) {
				wp_enqueue_script( 'my-script', plugins_url( 'assets/js/front.js', __FILE__ ), array( 'jquery' ), '1.0', true );
			}
		}
	}
}

$hello_world_test = new HelloWorldTest();
