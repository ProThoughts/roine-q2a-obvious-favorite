<?php

/*
	Plugin Name: Obvious
	Plugin URI: https://github.com/roine/roine-q2a-obvious-favorite
	Plugin Description: Allow to automatically change the background color of a question if contain a favorite tag or category for current user
	Plugin Version: 1.0
	Plugin Date: 2012-02-06
	Plugin Author: jonathan de Montalembert
	Plugin Author URI: jon.webistro.net/b
	Plugin License: GPLv3
	Plugin Minimum Question2Answer Version: 1.5
	Plugin Minimum PHP Version: 5
	Plugin Update Check URI: https://github.com/roine/roine-q2a-obvious-favorite
*/

if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
			header('Location: ../../');
			exit;
	}
	
qa_register_plugin_layer('qa-obvious-layer.php', 'Obvious Layer');
qa_register_plugin_module('module', 'qa-obvious-admin-form.php', 'qa_obvious_admin_form', 'Obvious Favorite Tag');
qa_register_plugin_module('widget', 'qa-favorite-tags.php', 'qa_tag_favorite', 'Favorite Tags');
/*
	Omit PHP closing tag to help avoid accidental output
*/