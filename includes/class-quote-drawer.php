<?php

namespace Mandy\QuoteDrawer;

if (! defined('ABSPATH')) {
	exit;
}

if (! class_exists('\Mandy\QuoteDrawer\Quote_Drawer')) {

	class Quote_Drawer {

		public static function html_structure() {

			if ( ! function_exists('WC') || ! WC()->session ) {
				return;
			}

			$quotes = WC()->session->get('quotes');

			if ( empty($quotes) ) {
				echo '<p class="empty-quote">Your quote is empty.</p>';
				return;
			}
			?>

			<table class="shop_table addify-quote-table">
				<tbody>
				<?php foreach ( $quotes as $quote_item_key => $quote_item ) :

					if ( ! isset( $quote_item['data'] ) || ! is_object( $quote_item['data'] ) ) {
						continue;
					}

					$_product = apply_filters(
						'addify_quote_item_product',
						$quote_item['data'],
						$quote_item,
						$quote_item_key
					);

					if (
						! $_product ||
						! $_product->exists() ||
						$quote_item['quantity'] <= 0
					) {
						continue;
					}

					$product_permalink = $_product->is_visible()
						? $_product->get_permalink()
						: '';
					?>

					<tr class="cart_item">

						<td class="product-remove">
							<a href="#"
							class="quote-remove remove_from_quote_button"
							data-cart_item_key="<?php echo esc_attr($quote_item_key); ?>">
								Remove
							</a>
						</td>

						<td class="product-thumbnail">
							<?php
							$thumbnail = $_product->get_image();
							echo $product_permalink
								? '<a href="'.esc_url($product_permalink).'">'.$thumbnail.'</a>'
								: $thumbnail;
							?>
						</td>

						<td class="product-name">
							<?php
							echo $product_permalink
								? '<a href="'.esc_url($product_permalink).'">'.wp_kses_post($_product->get_name()).'</a>'
								: wp_kses_post($_product->get_name());

							echo wc_get_formatted_cart_item_data($quote_item);
							?>
						</td>

					</tr>

				<?php endforeach; ?>
				</tbody>
			</table> <?php
		}
	}
}

