<?php
/**
 * @wordpress-plugin
 * Plugin Name:       CiviCart Wordpress
 * Plugin URI:        https://github.com/TobiasLounsbury/civicart-wordpress
 * Description:       Provides a Wordpress shortcode for including CiviCart inventory information, links, and buttons inside worpress content
 * Version:           1.0.0
 * Author:            Tobias Lounsbury <tobiaslounsbury@gmail.com>
 * Author URI:        http://example.com/
 * License:           AGPL-3.0
 * License URI:       http://www.gnu.org/licenses/agpl-3.0.html
 *
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}


// [civicart foo="foo-value"]

/**
 * civicart shortcode handler.
 *
 * Examples:
 *
 * [civicart item="5" type="full"]
 * Includes a full description of the item along with the appropriate
 * buttons to add the item to the cart
 *
 * [civicart item="5" type="description"]
 * Includes only the description of the item
 *
 * [civicart item="5" type="button"]
 * Includes only the buttons to add this item to the cart
 *
 * [civicart option="25" type="button"]
 * This adds the button to add a single checkbox item to the cart.
 *
 * @param $atts
 * @return string
 */
function civicart_shortcode_func( $atts ) {
  $a = shortcode_atts( array(
    'item' => false,
    'option' => false,
    'type' => "full",
  ), $atts );

  try {
      return CRM_Civicart_Tokens::getItemContent($a['item'], $a['option'], $a['type']);
  } catch (Exception $e) {
    return "";
  }
}

add_shortcode( 'civicart', 'civicart_shortcode_func' );