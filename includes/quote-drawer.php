<?php
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'WC' ) || ! WC()->session ) {
	return;
}

$quotes = WC()->session->get( 'quotes' );

if ( empty( $quotes ) ) {
	echo '<p class="empty-quote">Your quote is empty.</p>';
	return;
}
?>

<table class="shop_table addify-quote-table">
	<tbody>
	<?php
	foreach ( $quotes as $quote_item_key => $quote_item ) :

		if ( ! isset( $quote_item['data'] ) || ! is_object( $quote_item['data'] ) ) {
			continue;
		}

		$_product   = apply_filters( 'addify_quote_item_product', $quote_item['data'], $quote_item, $quote_item_key );
		$product_id = apply_filters( 'addify_quote_item_product_id', $quote_item['product_id'], $quote_item, $quote_item_key );

		$price = empty( $quote_item['addons_price'] ) ? $_product->get_price() : $quote_item['addons_price'];
		$price = empty( $quote_item['role_base_price'] ) ? $_product->get_price() : $quote_item['role_base_price'];
		$price = empty( $quote_item['price_calculator_price'] ) ? $price : $quote_item['price_calculator_price'];
		$price = isset( $quote_item['composite_product_price'] ) ? $quote_item['composite_product_price'] : $price;

		$component_name = isset( $quote_item['component_name'] ) ? $quote_item['component_name'] : '';

		if (
			! $_product ||
			! $_product->exists() ||
			$quote_item['quantity'] <= 0 ||
			! apply_filters( 'addify_quote_item_visible', true, $quote_item, $quote_item_key )
		) {
			continue;
		}

		$product_permalink = apply_filters(
			'addify_quote_item_permalink',
			$_product->is_visible() ? $_product->get_permalink( $quote_item ) : '',
			$quote_item,
			$quote_item_key
		);
		?>

		<tr class="<?php echo esc_attr( apply_filters( 'addify_quote_item_class', 'cart_item', $quote_item, $quote_item_key ) ); ?>">

			<!-- Remove -->
			<td class="product-remove">
				<?php if ( empty( $quote_item['composite_child_products'] ) ) : ?>
					<?php
					echo wp_kses_post(
						apply_filters(
							'addify_rfq_cart_item_remove_link',
							sprintf(
								'<a href="%s" class="quote-remove remove_from_quote_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">Remove</a>',
								esc_url( '' ),
								esc_attr__( 'Remove this item', 'addify_rfq' ),
								esc_attr( $product_id ),
								esc_attr( $quote_item_key ),
								esc_attr( $_product->get_sku() )
							),
							$quote_item_key
						)
					);
					?>
				<?php endif; ?>
			</td>

			<!-- Thumbnail -->
			<td class="product-thumbnail">
				<?php
				$thumbnail = apply_filters(
					'addify_quote_item_thumbnail',
					$_product->get_image(),
					$quote_item,
					$quote_item_key
				);

				if ( $product_permalink ) {
					printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), wp_kses_post( $thumbnail ) );
				} else {
					echo wp_kses_post( $thumbnail );
				}
				?>
			</td>

			<!-- Product info -->
			<td class="product-name">
				<?php
				if ( $component_name ) {
					echo esc_html( $component_name ) . '<br>';
				}

				if ( $product_permalink ) {
					printf(
						'<a href="%s">%s</a>',
						esc_url( $product_permalink ),
						wp_kses_post( $_product->get_name() )
					);
				} else {
					echo wp_kses_post( $_product->get_name() );
				}

				do_action( 'addify_after_quote_item_name', $quote_item, $quote_item_key );

				echo wp_kses_post( wc_get_formatted_cart_item_data( $quote_item ) );
				?>
			</td>
		</tr>

	<?php endforeach; ?>
	</tbody>
</table>
