<?php

if ( ! class_exists( 'ET_Builder_Element' ) ) {
	return;
}
$module_files = glob( __DIR__ . '/modules/*/*.php' );

// Load custom  Masterstudy LMS Divi Builder modules
foreach ( (array) $module_files as $module_file ) {
	if ( $module_file && preg_match( "/\/modules\/\b([^\/]+)\/\\1\.php$/", $module_file ) ) {
		require_once $module_file;
	}
}

// Adding filter to disable wrapping with default themes
$theme = wp_get_theme()->name;
if ( !($theme === 'Divi') && !($theme === 'GlobalStudy Divi Education Theme') && et_builder_is_frontend()) {
    add_filter( 'et_builder_outer_content_id', function () {} ,1 );
}
