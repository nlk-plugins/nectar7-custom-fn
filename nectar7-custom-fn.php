<?php
/**
 * Plugin Name: Nectar7 Custom Fn
 * Plugin URI: https://github.com/nlk-plugins/nectar7-custom-fn
 * Description: Custom Functionality in a WordPress plugin for Nectar7
 * Version: 0.2.0
 * Author: Ninthlink, Inc.
 * Author URI: http://www.ninthlink.com
 * License: GPLv2 or later
 *
 */


// remove wp version param from any enqueued scripts
function nectar7_custom_fn_clean_ver( $src ) {
    if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'nectar7_custom_fn_clean_ver', 9999 );
add_filter( 'script_loader_src', 'nectar7_custom_fn_clean_ver', 9999 );

/*
function nectar7_wdjs_no_defer( $no_defer ){
  $no_defer[] = 'jquery';
  $no_defer[] = 'pgb-bootstrapwpjs';
  $no_defer[] = 'gform_gravityforms';
  // visual composer grid scripts
  $no_defer[] = 'wpb_composer_front_js';
  $no_defer[] = 'vc_grid';
  $no_defer[] = 'vc_grid-js-imagesloaded';
	$no_defer[] = 'vc_masonry';
	$no_defer[] = 'vc_grid-style-all-masonry';
	$no_defer[] = 'vc_grid-style-lazy-masonry';
	$no_defer[] = 'vc_grid-style-load-more-masonry';
	$no_defer[] = 'prettyphoto';
	$no_defer[] = 'vc_pageable_owl-carousel';
  // end visual composer grid scripts
  return $no_defer;
}
add_filter( 'do_not_defer', 'nectar7_wdjs_no_defer');
*/
/*
function nectar7_wdjs_labjs_src( $lab_src, $lab_ver ) {
	return str_replace( '?ver='. $lab_ver, '', $lab_src ); // no $lab_ver
}
add_filter( 'wdjs_labjs_src', 'nectar7_wdjs_labjs_src', 10, 2 );
*/

function nectar7_custom_fn_clean_wp_header() {
	// Display the links to the extra feeds such as category feeds
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	// Display the links to the general feeds: Post and Comment Feed
	remove_action( 'wp_head', 'feed_links', 2 );
	// Display the link to the Really Simple Discovery service endpoint, EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// Display the link to the Windows Live Writer manifest file.
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// index link
	remove_action( 'wp_head', 'index_rel_link' );
	// prev link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// Display relational links for the posts adjacent to the current post.
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
	// Display the XHTML generator that is generated on the wp_head hook, WP version
	remove_action( 'wp_head', 'wp_generator' );
	// rel-canonical tag
	remove_action( 'wp_head', 'rel_canonical' );
	// default wp shortlink meta tag
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
  // rest_output_rsd no idea but hey
  remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );
  // rest_output_link_wp_head adds <link rel="https://api.w.org"...
  remove_action( 'wp_head', 'rest_output_link_wp_head' );
}
add_action( 'wp_head', 'nectar7_custom_fn_clean_wp_header', 0 );

/*
// Google Tag Manager
add_action( 'tha_body_top', 'nectar7_gtm' );
function nectar7_gtm() {
	// I think we have a plugin for this somewhere. We will move it to there whenever we are ready? Ok.
	?>
	<!-- Google Tag Manager -->
	<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-W2WW4W"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-W2WW4W');</script>
	<!-- End Google Tag Manager -->
	<?php
}
*/
/*
// Chat code JS?
//add_action( 'tha_head_bottom', 'nectar7_chat_js' );
function nectar7_chat_js() {
	?>
	<!--Start of Zopim Live Chat Script-->
	<script type="text/javascript">
	window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
	d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
	_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
	$.src="//v2.zopim.com/?3QTM9x4eKtsWWMq3RyePaAEVThayWclE";z.t=+new Date;$.
	type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
	</script>
	<!--End of Zopim Live Chat Script-->
	<?php
}
*/

//Remove result count
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
//Remove Default sorting
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

//Remove pricing and rating
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

//Remove sidebar
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

//Remove add to cart from product archive
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

add_image_size( 'cart_item_image_size', 180, 180, true );
add_filter( 'woocommerce_cart_item_thumbnail', 'nectar7_custom_fn_cart_item_thumbnail', 10, 3 );

function nectar7_custom_fn_cart_item_thumbnail( $thumb, $cart_item, $cart_item_key ) {

 // create the product object
 $product = get_product( $cart_item['product_id'] );
 return $product->get_image( 'cart_item_image_size' );

}

add_action( 'pre_get_posts', 'nectar7_custom_fn_pre_get_posts_query' );
function nectar7_custom_fn_pre_get_posts_query( $q ) {

	if ( ! $q->is_main_query() ) return;
	if ( ! $q->is_post_type_archive() ) return;

	if ( ! is_admin() && is_shop() ) {
    // Don't display products in the 'subscribe' category on the shop page
		$q->set( 'tax_query', array(array(
			'taxonomy' => 'product_cat',
			'field' => 'slug',
			'terms' => array( 'subscribe' ),
			'operator' => 'NOT IN'
		)));

	}

	remove_action( 'pre_get_posts', 'nectar7_custom_fn_pre_get_posts_query' );
}

add_action('template_redirect', 'nectar7_custom_fn_emptycart_redirect');
function nectar7_custom_fn_emptycart_redirect(){
  global $woocommerce;


  if( ( is_cart() || is_checkout() ) && ( ! is_wc_endpoint_url( 'order-received' ) ) ) {
    $cartContent = sizeof( $woocommerce->cart->get_cart() );
    $redir = ( $cartContent == 0 );
    if ( function_exists('is_wcopc_checkout') ) {
      // don't trigger this empty card redirect on one page checkout which is a checkout but hey
      if ( is_wcopc_checkout() ) {
        $redir = false;
      }
    }
    if ( $redir ) {
      wp_redirect( 'products' );
      exit;
    }
  }
}

// hook to woocommerce_sale_flash to remove Sales Flash
add_filter('woocommerce_sale_flash', 'nectar7_custom_fn_hide_sales_flash');
function nectar7_custom_fn_hide_sales_flash() {
  // https://wordimpress.com/how-to-remove-product-sales-flash-in-woocommerce/
  return '';
}
/*
add_shortcode('stylesheet_directory_uri', 'func_stylesheet_directory_uri');

function func_stylesheet_directory_uri()
{
	return get_stylesheet_directory_uri();
}

add_shortcode('blog_url', 'func_blog_url');

function func_blog_url()
{
	return get_bloginfo('url');
}
*/

// woocommerce_package_rates is a 2.1+ hook
add_filter( 'woocommerce_package_rates', 'nectar7_custom_fn_hide_shipping_when_free', 10, 2 );

/**
 * Hide shipping rates when free shipping is available
 *
 * @param array $rates Array of rates found for the package
 * @param array $package The package array/object being shipped
 * @return array of modified rates
 */
function nectar7_custom_fn_hide_shipping_when_free( $rates, $package ) {

 	// Only modify rates if free_shipping is present
  	if ( isset( $rates['free_shipping'] ) ) {

  		// To unset a single rate/method, do the following. This example unsets flat_rate shipping
  		unset( $rates['flat_rate'] );

  		// To unset all methods except for free_shipping, do the following
  		$free_shipping          = $rates['free_shipping'];
  		$rates                  = array();
  		$rates['free_shipping'] = $free_shipping;
	}

	return $rates;
}

/**
 * hook to woocommerce_enable_order_notes_field filter
 *
 * to hide notes on opc
 */
function nectar7_custom_fn_filter_order_notes( $ret ) {
  if ( function_exists( 'is_wcopc_checkout' ) ) {
    if ( is_wcopc_checkout() ) {
      $ret = false;
    }
  }
  return $ret;
}
add_filter('woocommerce_enable_order_notes_field', 'nectar7_custom_fn_filter_order_notes');

/**
 * hook woocommerce_cart_shipping_method_full_label
 *
 * change Free Shipping to -0.00- or something
 */
function nectar7_custom_fn_shipping_label( $label, $method ) {
  if ( $method->id == 'free_shipping' ) {
    if ( is_wcopc_checkout() ) {
      $label = '<s>$00.00</s>';
    }
  }
  return $label;
}
add_filter('woocommerce_cart_shipping_method_full_label', 'nectar7_custom_fn_shipping_label', 10, 2);

/**
 * hook woocommerce_checkout_fields
 *
 * to change labels to placeholders (only on opc?)
 */
function nectar7_custom_fn_checkout_fields( $fields ) {

  if ( function_exists('is_wcopc_checkout') ) {
    // on OPC, change Labels to Placeholders in Billing & Shipping fields
    if ( is_wcopc_checkout() ) {
      $labelize = array( 'billing', 'shipping' );
      foreach ( $labelize as $l ) {
        if ( isset( $fields[$l] ) ) {
          foreach ( $fields[$l] as $k => $v ) {
            if ( isset ( $fields[$l][$k]['label'] ) ) {
              $label = $fields[$l][$k]['label'];
              $fields[$l][$k]['placeholder'] = $label;
              unset( $fields[$l][$k]['label'] );
            }
          }
        }
      }
    }
  }
  //wp_die('<pre>'. print_r($fields,true) .'</pre>');
  return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'nectar7_custom_fn_checkout_fields' );

/**
 * hook through wc_authorize_net_cim_credit_card_payment_form_manage_payment_methods_button_html
 *
 * woocommerce-gateway-authorize-net-cim\lib\skyverge\woocommerce\payment-gateway\
 * class-sv-wc-payment-gateway-payment-form.php
 *
 * to change the "Manage Payment Methods" button injected in to Not a button
 */
function nectar7_custom_fn_payment_btn( $html ) {
  if ( function_exists('is_wcopc_checkout') ) {
    // only make Not a button on one page checkout pages?
    if ( is_wcopc_checkout() ) {
      $html = str_replace( 'class="button"', '', $html );
      $html = str_replace( 'float:right', 'display: block', $html );
    }
  }
  return $html;
}
add_filter( 'wc_authorize_net_cim_credit_card_payment_form_manage_payment_methods_button_html', 'nectar7_custom_fn_payment_btn' );

//Enhanced eCommerce Tracking - GTM - by Eric DuRose 12/18/2015
add_action( 'woocommerce_thankyou', 'nectar7_custom_fn_tracking' );

function nectar7_custom_fn_tracking( $order_id ) {

// Lets grab the order
$order = new WC_Order( $order_id );


 $items = $order->get_items();


 $purchase_id = $order_id;
 $total_sale = $order->get_total();
 $tax = $order->get_cart_tax();
 $ship_cost = 0.00;
 $coupon_name_a = $order->get_used_coupons();
 $coupon_name = $coupon_name_a[0];
 ?>

<script>

dataLayer.push({
'event': 'transactionSuccess',
  'ecommerce': {
    'purchase': {
      'actionField': {
        'id': '<?php echo $order_id; ?>',
        'affiliation': 'WooCommerce Store',
        'revenue': '<?php echo $total_sale; ?>',
        'tax': '<?php echo $tax; ?>',
        'shipping': '<?php echo $ship_cost; ?>',
        'coupon': '<?php echo $coupon_name; ?>'
      },
      'products':[
<?php
$pcount = 0;
foreach ( $items as $k=>$v ) {
if ( $pcount++ > 0 ) echo ',';
?>
{
'name':'<?php echo $v['name']; ?>', //ProductNameorIDisrequired
'id':'<?php echo $v['product_id']; ?>',
'price':'<?php echo $v['line_total']; ?>',
'brand':'Nectar7',
'category':'<?php echo $v['name']; ?>',
'variant': '<?php echo $v['lace-size']; ?>',
'quantity': '<?php echo ''. $v['qty'] ?>',
'coupon': '<?php echo $coupon_name; ?>'
}
<?php } ?>
]
}
}
});
</script>
<?php
}

// look for a query param ?exclusive=1 & empty cart if yes
function nectar7_custom_fn_emptycart_action() {
  if ( isset( $_REQUEST['exclusive'] ) ) {
    if ( $_REQUEST['exclusive'] == 1 ) {
      // empty the cart?
      wc_empty_cart();
    }
  }
}
// set priority 18 so it fires before the add-to-cart happens which is 20
add_action( 'wp_loaded', 'nectar7_custom_fn_emptycart_action', 18 );