<?php
/**
 * Plugin name: Hide Development/Staging From Indexing
 * Description: Uses robots.txt to not index this site with search-engines
 * Plugin author: Onni Hakala / Geniem Oy
 * Version: 0.1
 */

/**
 * Hides staging/development from Search engines
 *
 * @param string $output - Output into robots.txt.
 * @param bool   $public - 1 or 0 depending if blog public meta is turned on.
 */
function geniem_hide_non_production_robots( string $output, bool $public ) {
    // Don't do anything if blog is already hidden
    if ( ! $public ) { return $output; }

    // Hide all non production sites.
    if ( defined( 'WP_ENV' ) && WP_ENV !== 'production' ) {
        $output = "User-agent: *\n";
        $output .= "Disallow: /\n";
    }

    return $output;
}
add_filter( 'robots_txt', 'geniem_hide_non_production_robots', 10, 2 );
