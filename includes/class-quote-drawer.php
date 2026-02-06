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
			<form class="woocommerce-cart-form addify-quote-form"  method="post" data-form-type="popup" enctype="multipart/form-data">

				<ul class="shop_table addify-quote-table addify-quote-form__contents">
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

						<li class="cart_item">

							<div class="product-remove">
								<a href="#"
								class="quote-remove remove_from_quote_button"
								data-cart_item_key="<?php echo esc_attr($quote_item_key); ?>">
									Remove
								</a>
							</div >

							<div class="product-thumbnail">
								<?php
								$thumbnail = $_product->get_image();
								echo $product_permalink
									? '<a href="'.esc_url($product_permalink).'">'.$thumbnail.'</a>'
									: $thumbnail;
								?>
							</div >

							<div class="product-details" >
								<div class="product-name">
									<?php
									echo $product_permalink
										? '<a href="'.esc_url($product_permalink).'">'.wp_kses_post($_product->get_name()).'</a>'
										: wp_kses_post($_product->get_name());

									echo wc_get_formatted_cart_item_data($quote_item);
									?>
								</div >

								<div class="product-attributes-sku">
									<p class="product-attribute-summary">
										<?php
											if( $_product->get_type() === 'variation' ) {
												echo(esc_html( $_product->get_attribute_summary() ));
											}
										?>
									</p>
									<p class="product-sku" >
										<?php
											echo(esc_html( $_product->get_sku() ));
										?>
									</p>
								</div >
							</div>

							<div class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'addify_rfq' ); ?>">
								<?php
									if ( $_product->is_sold_individually() ) {
										$product_quantity = sprintf( '<input type="hidden" name="quote_qty[%s]" value="1" />', $quote_item_key );
									} else {
										$max_product_quantity = apply_filters('addify_quote_product_quantity_maximum', $_product->get_max_purchase_quantity(), $_product, $quote_item);
										woocommerce_quantity_input(
											array(
												'input_name'   => "quote_qty[{$quote_item_key}]",
												'input_value'  => $quote_item['quantity'],
												'max_value'    => $max_product_quantity,
												'min_value'    => '0',
												'product_name' => $_product->get_name(),
											),
											$_product,
											true
										);
									}
								?>
							</div >
							<div class="actions" style="display: none;">
								<?php
									$afrfq_update_button_text     = get_option( 'afrfq_update_button_text' );
									$afrfq_update_button_bg_color = get_option( 'afrfq_update_button_bg_color' );
									$afrfq_update_button_fg_color = get_option( 'afrfq_update_button_fg_color' );
									$afrfq_update_button_text     = empty( $afrfq_update_button_text ) ? __( 'Update Quote', 'addify_rfq' ) : $afrfq_update_button_text;
								?>

								<style type="text/css">
									.afrfq_update_quote_btn{
										color: <?php echo esc_html( $afrfq_update_button_fg_color ); ?> !important;
										background-color: <?php echo esc_html( $afrfq_update_button_bg_color ); ?> !important;
									}
								</style>

								<button type="button" type="submit" id="afrfq_update_quote_btn" class="button afrfq_update_quote_btn" name="update_quote" value="<?php esc_html( $afrfq_update_button_text ); ?>"><?php echo esc_html( $afrfq_update_button_text ); ?></button>

								<?php do_action( 'addify_quote_actions' ); ?>

								<?php wp_nonce_field( 'addify-cart', 'addify-cart-nonce' ); ?>
							</div >
						</tr>

					<?php endforeach; ?>
				</ul>
			</form>
			<?php
		}
	}
}

