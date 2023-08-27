<?php

// It Give me so much pain ..

// After All I found Only this Below is working fine .

// When you need to do something after a woo-order place use this below code

add_action('woocommerce_checkout_order_processed', 'enroll_student', 10, 1);

// or

add_action('woocommerce_thankyou', 'enroll_student', 10, 1);
