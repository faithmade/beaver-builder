<?php 

// Opening Wrapper
echo '<div class="fl-woocommerce-' . $settings->layout . '">';

// Shortcodes
$pages = array(
	'cart'          => '[woocommerce_cart]',
	'checkout'      => '[woocommerce_checkout]',
	'tracking'      => '[woocommerce_order_tracking]',
	'account'       => '[woocommerce_my_account]'
);

// WooCommerce Pages
if(isset($pages[$settings->layout])) {
	echo $pages[$settings->layout];
}

// Single Product
else if($settings->layout == 'product') {
	add_filter('post_class', array($module, 'single_product_post_class'));
	echo '[product id="'. $settings->product_id .'"]';
	remove_filter('post_class', array($module, 'single_product_post_class'));
}

// Add to Cart Button
else if($settings->layout == 'add-cart') {
	echo '[add_to_cart id="'. $settings->product_id .'" style=""]';
}

// Categories
else if($settings->layout == 'categories') {
	echo '[product_categories parent="'. $settings->parent_cat_id .'" columns="'. $settings->cat_columns .'"]';
}

// Multiple Products
else if($settings->layout == 'products') {
	add_filter('post_class', array($module, 'products_post_class'));
	
	// Product IDs
	if($settings->products_source == 'ids') {
		echo '[products ids="'. $settings->product_ids .'" columns="'. $settings->columns .'" orderby="'. $settings->orderby .'" order="'. $settings->order .'"]';
	}
	
	// Product Category
	else if($settings->products_source == 'category') {
		echo '[product_category category="'. $settings->category_slug .'" per_page="'. $settings->num_products .'" columns="'. $settings->columns .'" orderby="'. $settings->orderby .'" order="'. $settings->order .'"]';
	}
	
	// Recent Products
	else if($settings->products_source == 'recent') {
		echo '[recent_products per_page="'. $settings->num_products .'" columns="'. $settings->columns .'" orderby="'. $settings->orderby .'" order="'. $settings->order .'"]';
	}
	
	// Featured Products
	else if($settings->products_source == 'featured') {
		echo '[featured_products per_page="'. $settings->num_products .'" columns="'. $settings->columns .'" orderby="'. $settings->orderby .'" order="'. $settings->order .'"]';
	}
	
	// Sale Products
	else if($settings->products_source == 'sale') {
		echo '[sale_products per_page="'. $settings->num_products .'" columns="'. $settings->columns .'" orderby="'. $settings->orderby .'" order="'. $settings->order .'"]';
	}
	
	// Best Selling Products
	else if($settings->products_source == 'best-selling') {
		echo '[best_selling_products per_page="'. $settings->num_products .'" columns="'. $settings->columns .'"]';
	}
	
	// Top Rated Products
	else if($settings->products_source == 'top-rated') {
		echo '[top_rated_products per_page="'. $settings->num_products .'" columns="'. $settings->columns .'" orderby="'. $settings->orderby .'" order="'. $settings->order .'"]';
	}
	
	remove_filter('post_class', array($module, 'products_post_class'));
}

// Closing Wrapper
echo '</div>';

?>