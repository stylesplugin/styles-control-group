<?php

/*
Plugin Name: Styles Control: Group
Plugin URI: http://stylesplugin.com/
Description: Add a "group" control type to Styles.
Version: 1.0
Author: Brainstorm Media
Author URI: http://brainstormmedia.com
*/

/**
 * Copyright (c) 2013 Brainstorm Media. All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * **********************************************************************
 */

new Styles_Control_Group_Plugin();

/**
 * Enqueue necessary files when needed by the WordPress Costumizer.
 *
 * Example JSON usage:
 *     { "type": "group", "label": "Most awesome group ever" },
 */
class Styles_Control_Group_Plugin {

	/**
	 * Version of the plugin. Used to cache-bust enqueued scripts and styles.
	 */
	var $version = '1.0';

	public function __construct() {
		add_action( 'customize_register', array( $this, 'customize_register' ), 5 ); 
		add_action( 'customize_controls_enqueue_scripts',  array( $this, 'customize_controls_enqueue_scripts' ) );
	}

	/**
	 * Include the class to make available to Styles.
	 * Styles looks for class "Styles_Control_Foo_Bar"
	 * when presented with { type: "foo-bar" } in customize.json
	 */
	public function customize_register(){
		include dirname( __FILE__ ) . '/inc/styles-control-group.php';
	}

	/**
	 * Supporting CSS or Javascript for use in WordPress Customizer
	 */
	function customize_controls_enqueue_scripts() {
		wp_enqueue_style( 'styles-control-group', plugins_url( '/inc/styles-control-group.css', __FILE__ ), array(), $this->version );
	}
}







