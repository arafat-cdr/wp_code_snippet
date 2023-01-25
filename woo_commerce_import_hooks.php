WooCommerce is a plugin for WordPress that adds e-commerce functionality to your website. It provides a number of "hooks" that allow you to customize its behavior and add your own code at specific points in the execution of WooCommerce code.

Here is a list of some of the most commonly used WooCommerce hooks:

Actions

woocommerce_after_single_product: fired after a single product is displayed
woocommerce_after_shop_loop: fired after the product loop in the shop page
woocommerce_before_checkout_form: fired before the checkout form is displayed
woocommerce_before_single_product: fired before a single product is displayed
woocommerce_cart_is_empty: fired when the cart is empty
woocommerce_checkout_process: fired during checkout process, before the order is created
woocommerce_checkout_update_order_review: fired during checkout when the order review is updated
woocommerce_email_header: fired before the email header in WooCommerce emails
woocommerce_email_order_details: fired during the order details table in WooCommerce emails
woocommerce_email_order_meta: fired after the order meta in WooCommerce emails
woocommerce_email_footer: fired after the email footer in WooCommerce emails
woocommerce_order_status_changed: fired when the order status is changed
woocommerce_payment_complete: fired when payment is complete
Filters

woocommerce_add_to_cart_redirect: allows you to customize the redirect URL after an item is added to the cart
woocommerce_available_payment_gateways: allows you to customize the available payment gateways
woocommerce_cart_item_name: allows you to customize the name of a cart item
woocommerce_cart_item_price: allows you to customize the price of a cart item
woocommerce_cart_item_subtotal: allows you to customize the subtotal of a cart item
woocommerce_email_recipient_*: allows you to customize the recipient of a WooCommerce email
woocommerce_email_subject_*: allows you to customize the subject of a WooCommerce email
woocommerce_order_item_name: allows you to customize the name of an order item
woocommerce_order_item_price: allows you to customize the price of an order item
woocommerce_order_item_subtotal: allows you to customize the subtotal of an order item
woocommerce_product_get_price: allows you to customize the price of a product
woocommerce_product_variation_get_price: allows you to customize the price of a product variation
These are just a few examples of the many hooks available in WooCommerce. You can find more information about WooCommerce hooks in the WooCommerce documentation: 