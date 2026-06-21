<?php
/**
 * The front page template file
 *
 * Displays the site's front page. Scaffolded with semantic sections
 * and Tailwind utility classes to match the Figma-based layout.
 *
 * Replace placeholder content with real text/images from the Figma file.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package demoVGS
 */

get_header();

// Load central static frontpage content (template-part)
get_template_part( 'template-parts/frontpage/content', 'frontpage' );

get_footer();

?>