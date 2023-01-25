<?php

#  For more details read this Article: https://kinsta.com/blog/wordpress-hooks/#what-are-wordpress-hooks 

# Hook 1
do_action( 'action_name', [optional_arguments] ); // Run the add_action callback with its parameter now
do_action_ref_array( 'example_action', $arguments_array ); // Run the add_action callback with its arr parameter now

apply_filters( 'filter_name', 'value_to_be_filtered', [optional_arguments] ); // Run the filter hook  callback with its parameter 
apply_filters_ref_array(); // Run the filter hook  callback with its array  parameter

# Hook 2
add_action( 'publish_post', 'change_text_callback' ); // Attach a call back function for this action hook
add_filter( 'the_content', 'change_text_another_callback'); // Attach a call back function for this filter hook

# Hook 3
has_action( 'action_name', 'function_to_check' ); //  check if any callback is hooked into this action or not . 1 required parameter
has_filter('action_name',  'function_to_check'); //check if any callback is hooked into this filter or not . 1 required parameter example: // check to see if 'the_content' filter has been hooked if ( ! has_filter( 'the_content' ){ //add_filter( 'the_content', 'modify_the_content' ); }


# Hook 4
did_action( 'action_name' ); // How many time it run haa ? num of time it fire a action Hook call it inside call-back func


# Hook 5
remove_action(); // remove a attach function  in action hook call it inside call-back func call_back and priority need to be same as action
remove_filter(); // remove a attach function in filter hook call it inside call-back func call_back and priority need to be same as filter

# Hook 6
remove_all_actions(); // remove all attach functions in action hook
remove_all_filters(); // remove all attach function in filter hook

# Hook 7
doing_action(); // if this action is run haa ? if action function is run Then return truse or false 
doing_filter(); // if this action is run haa ?  if filter funtion is run Then return true or false

# Hook 8
current_filter();  // which action/ filter is running now plz ? This filter function retrieves the --> name --> of the current filter or action being run. it run inside the call-back function


<?php

# Hook 1
do_action( 'action_name', [optional_arguments] );
# Hook 2
apply_filters( 'filter_name', 'value_to_be_filtered', [optional_arguments] );

# Hook 3
add_action( 'publish_post', 'change_text_callback' );
# Hook 4
add_filter( 'the_content', 'change_text_another_callback');

# Hook 5
has_action( 'action_name', 'function_to_check' );

# This action function checks whether an action has been hookd. It accepts two parameters. The first one is the name of the action. The second parameter is optional and is the name of the callback function.

# If you specify just the first parameter, it returns true if any function is hookd to the action_name parameter.

# But if you also specify the second parameter, it’ll return false if the specified callback function isn’t registered to the action mentioned.

# If it finds the callback function attached to the action hook though, it’ll return the priority (an integer) set for that function on this action hook.



# Hook 6
// do_action_ref_array()

// here's an example array
$arguments_array = array( 'arg_1', 'foo', true, 'arg_4' );

do_action_ref_array( 'example_action', $arguments_array );


// This action function is identical to do_action(), except for one difference. Any arguments passed through it must be an array. When you have a lot of arguments to pass or your arguments are already in an array, this function is super helpful.

# Hook 7

did_action();
// If you want to count the number of times any action is fired, you can invoke this action function.
did_action( 'action_name' );

// This function returns an integer value.

// The did_action() function is extremely handy when you want to run a callback function only the first time an action is run and never again.

function example_callback_function() {
    if( did_action( 'example_action' ) === 1 ) {
    // checks if the 'example_action' hook is fired once, and only runs then, and never again!
    }
}
add_action('example_action', 'example_callback_function');

# Hook 8

remove_action();

// This action function removes a callback function hookd to the specified action. For instance, you can use this function to remove the default WordPress functions hookd into built-in actions and replace them with your own.

remove_action( 'action_name', 'function_to_be_removed', 'priority');


// There are a few prerequisites to calling the remove_action() function:

// The function_to_be_removed and priority parameters must be the same as the ones used originally in the add_action() function.
// You cannot call the remove_action() function directly. You need to call it from inside another function.
// If the callback function is registered from a class, then removing it has other requirements. You can check out the WordPress Codex documentation for more details.
// You cannot remove the callback function before it’s registered or after it’s run.
// Here’s an example of how WooCommerce uses this action function to remove the default product thumbnail on the main shop page.

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );



# Hook 9

remove_all_actions();

// This action function removes everything hookd to an action. The priority parameter is optional.


# Hook 10

doing_action();
// This action function checks whether the specified action is being run or not. It returns a boolean value (true or false).

// check whether the 'action_name' action is being executed
if ( doing_action( 'action_name' ) ) {
    // execute your code here
}

// You can leave the action_name parameter empty to check whether any action is being executed. It’ll return true every time any action is fired.

// check if any action is running and do something
if ( doing_action() ) {
    // the code here is run when any action is fired
}


# Hook 11

has_filter();

// This function checks whether the specified filter is hookd by any function. It accepts two parameters. The first parameter is for entering the filter name. The second parameter is optional and is for entering the name of the callback function.

has_filter( 'filter_name', 'function_to_check' );

// If you specify just the first parameter, it’ll return true if the filter_name is hookd by any function.

// However, if you specify both the parameters, then it’ll return false if the callback function mentioned isn’t registered with the given filter. If it finds the callback function registered with the filter, then it’ll return the priority (an integer) set for that function on this filter.

// One possible application of the has_filter() function is to check whether any filter has been hookd already, and based on that go ahead with code execution.

// check to see if 'the_content' filter has been hookd
if ( ! has_filter( 'the_content' ) ) {
    // hook the filter if and only if it hasn't been hookd before
    add_filter( 'the_content', 'modify_the_content' );
}

# Hook 12

apply_filters_ref_array();

// This function is like the apply_filters() function, except all the arguments it accepts are bundled up as an array.

// an example array
$arguments_array = array( 'some_value', 'foo', false, 'another_value' );

apply_filters_ref_array( 'example_filter', $arguments_array );

// This filter function can be handy when you have many arguments to pass or if all of them are already in an array. Ensure that the arguments inside the array are in the right order.

# Hook 13

current_filter();

// This filter function retrieves the name of the current filter or action being run. You don’t need to specify any parameters as it runs within the callback function.

// Here’s an example of its usage:

function example_callback() {
    echo current_filter(); // 'the_title' will be echoed
    return;
}
add_filter( 'the_title', 'example_callback' );

// Despite its name, this function can retrieve the name of both actions and filters.

# Hook 14
remove_filter();

// This filter function removes the callback function attached to the specified filter. It’s works exactly like the remove_action() function. You can use it to delete default WordPress functions registered with a specific filter, and if necessary replace them with your own functions.

remove_filter( 'filter_name', 'function_to_be_removed', 10 );

// To unhitch a callback function hookd to a filter, the function_to_be_removed and priority parameters must be identical to the arguments used when hooking the callback function.

// If the filter has been added from within a class, which is usually the case when they’re added by plugins, then you need to access the class variable to remove the filter.

// access the class variable first, and then remove the filter through it
global $some_class;

remove_filter( 'the_content', array($some_class, 'class_filter_callback') );


# Hook 15
remove_all_filters();

// This filter function removes all the callback functions registered to a filter.

remove_all_filters( 'filter_name', $priority );

// It’s similar to the remove_all_actions() function.


# Hook 16

doing_filter();

// This filter function checks whether the filter specified is being executed at the moment.

if ( doing_filter( 'save_post' ) ) {
    // run your code here
}


// It returns a boolean value (true or false).


# Hook 17

current_filter();

// You should note the difference between this function and the current_filter() function, which returns the name of the filter or action being run (a string).

# Hook 17


# Hook 18
# Hook 19
# Hook 20
# Hook 1
# Hook 1
# Hook 1
# Hook 1
# Hook 1
# Hook 1
# Hook 1
# Hook 1
# Hook 1
# Hook 1
# Hook 1
# Hook 1
# Hook 1
# Hook 1
# Hook 1