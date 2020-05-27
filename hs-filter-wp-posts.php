<?php
/*
 * Plugin Name:       Filter WP Posts
 * Plugin URI:        https://homescriptone.com
 * Description:       Filtrer les posts publiés par l'utilisateur actuel.
 * Version:           1.0
 * Author:            HomeScript
 * Author URI:        https://homescriptone.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hs-filter-posts
 * WC requires at least: 3.0.0
 * WC tested up to: 4.0
 */

if (!defined('ABSPATH')){
  die();
}


add_action('pre_get_posts', 'hs_filter_posts_list');
function hs_filter_posts_list($query)
{
	//$pagenow holds the name of the current page being viewed
	 global $pagenow;

	//$current_user uses the get_currentuserinfo() method to get the currently logged in user's data
	 global $current_user;
	 wp_get_current_user();
    
    	//Shouldn't happen for the admin, but for any role with the edit_posts capability and only on the posts list page, that is edit.php
    	if(!current_user_can('administrator') && current_user_can('edit_posts') && ('edit.php' == $pagenow))
   	 {
		//global $query's set() method for setting the author as the current user's id
		$query->set('author', $current_user->ID); 
    	}
}
