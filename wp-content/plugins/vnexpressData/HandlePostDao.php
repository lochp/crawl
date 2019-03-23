<?php
final class HandlePostDao {

    public static function get_instance_by_post_name($post_name){
        global $wpdb;

		if ( ! $post_name ) {
			return false;
		}

		$_post = wp_cache_get( $post_name, 'posts' );

		if ( ! $_post ) {
			$_post = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $wpdb->posts WHERE post_name = %s LIMIT 1", $post_name ) );

			if ( ! $_post )
				return false;

			$_post = sanitize_post( $_post, 'raw' );
			wp_cache_add( $_post->post_name, $_post, 'posts' );
		} elseif ( empty( $_post->filter ) ) {
			$_post = sanitize_post( $_post, 'raw' );
		}

		return new WP_Post( $_post );
    }

    public static function get_instance_by_post_title($post_title){
        global $wpdb;

		if ( ! $post_title ) {
			return false;
		}

		$_post = wp_cache_get( $post_title, 'posts' );

		if ( ! $_post ) {
			$_post = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $wpdb->posts WHERE post_title = %s LIMIT 1", $post_title ) );

			if ( ! $_post )
				return false;

			$_post = sanitize_post( $_post, 'raw' );
			wp_cache_add( $_post->post_title, $_post, 'posts' );
		} elseif ( empty( $_post->filter ) ) {
			$_post = sanitize_post( $_post, 'raw' );
		}

		return new WP_Post( $_post );
    }
}
?>