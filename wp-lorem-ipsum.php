<?php
/*
Plugin Name: WP Lorem Ipsum
Plugin URI: https://github.com/wp-composerize/wp-lorem-ipsum
Description: WordPress plugin that displays lorem ipsum like Hello Dolly
Author: Jan Voracek
Version: 1.0
*/

// This just echoes the chosen line, we'll position it later
function wp_lorem_ipsum() {
    $generator = new Badcow\LoremIpsum\Generator();
    $sentences = $generator->getSentences(30);

    $chosen = wptexturize($sentences[mt_rand(0, count($sentences) - 1)]);
    echo "<p id='wp-lorem-ipsum-text'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'wp_lorem_ipsum' );

// We need some CSS to position the paragraph
function wp_lorem_ipsum_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#wp-lorem-ipsum-text {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

add_action( 'admin_head', 'wp_lorem_ipsum_css' );
