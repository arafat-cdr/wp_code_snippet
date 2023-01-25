<?php

# NOT ALLOW DIRECT ACCESS
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

<?php

# Need help GO to here
$url = "https://github.com/topics/wordpress-plugin-development";
#  end

# NOT ALLOW DIRECT ACCESS
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


define( 'PLUGIN_NAME_PLUGIN_NAME', 'plugin-name' );
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

define( 'PLUGIN_NAME_URL', plugin_dir_url( __FILE__ ) );
define( 'PLUGIN_NAME_PATH', plugin_dir_path( __FILE__ ) );
define( 'PLUGIN_NAME_BASE_NAME', plugin_basename( __FILE__ ) );
# Important one
define( 'FILE_PATH_MINE', __FILE__ );
define( 'MY_DIR_PATH', plugin_dir_path( FILE_PATH_MINE ) );
# End imporrtant one

# What this do ?

plugins_url( 'img/bar.jpg' , __FILE__ );
// will return a url like http://www.example.com/wp-content/plugins/foo/img/bar.jpg

$res = plugin_dir_url( __FILE__ );
// http://localhost/wordpress/wp-content/plugins/wl_learning/

$res = plugin_dir_path( __FILE__ );
// /var/www/html/wordpress/wp-content/plugins/wl_learning/


$res = plugin_basename( __FILE__ );
// wl_learning/wl_learning.php

# haa ?

# What this do ?
sanitize_key("key_name");
// Sanitizes a string key.

// Keys are used as internal identifiers. Lowercase alphanumeric characters, dashes, and underscores are allowed.
# Haa ?

# tgmpa-install-plugins 
# This use for show notices for required plugins

// +++++++++++++++++++++++++++++++++++++++++++++++++++
// Data validation
wp_kses($string, $allowed_html, $allowed_protocols);
//  Wordpress function wp_kses(). This function makes sure that only allowed HTML elements, attribute names and values are allowed in the string.

$value = esc_textarea($string);
// When you are displaying text from a database to be displayed inside a textarea you should escape the characters to make sure they render correctly in a textarea. Wordpress comes with the function esc_textarea ($val) which is used to escape text for use inside a textarea.

$attribute = esc_attr($val);
// When display input fields from the server-side there will be times when you have dynamic HTML attributes such as name, id, value, class. Using the Wordpress function esc_attr( $val ) you can make sure the the values added to the HTML attribute is escaped of special characters.


esc_attr_e($val);

// If you need to echo the return of this function it is recommended that you use the function esc_attr_e().

// If you need to output Javascript inside a onclick attribute then the values you enter in this need to be escaped. Wordpress comes with the function esc_js($val), which will escape single quotes, htmlspecialchar " &, and fix line endings.

$js = esc_js($val);

// Escape URLs
// When you need to escape URL's you should always use the function esc_url(). This function will make sure that the URL provide has an accepted protocol, it will remove invalid characters, and encode special characters to be valid for URLs.

$url = esc_url($val);

// The esc_url function should be used when you displaying the URL in a textbox, input attribute or on the page. If you want to store the value in a database or use the URL to redirect the user you should use the function esc_url_raw().

$url = esc_url_raw($val);

// Sanitize A String
// When you get input from a user you need to sanitize the value to make sure that you encode any characters, strip tags, remove line breaks, tabs and white space. Using the Wordpress function sanitize_text_field ($val) it will sanitize the input and return a string safe to be stored in the database.

# sanitize ---> Meaning validating the data

$safe_string = sanitize_text_field ($val);

// Sanitize A String For URL
// When you create a new post in Wordpress it will take the title of the post and sanitize it to be used in the URL of the post. To do this Wordpress has a function sanitize_title() which will take a string a will return a URL slug of the string. This function will remove any HTML or PHP tags and replace all spaces with a hyphen.

$new_url = sanitize_title('Wordpress will convert this to be used in the URL of the post');
echo $new_url; //wordpress-will-convert-this-to-be-used-in-the-URL-of-the-post


// Sanitize File Name
// When you are storing file names you need to make sure that you use the Wordpress function sanitize_file_name(). This function will remove any invalid characters that are not allowed in file names and will replace any whitespace with dashes.

$filename = sanitize_file_name($val);

// Sanitize Email Address
// To make sure that an email address only has valid characters Wordpress has a function sanitize_email() which makes sure that the email address has no invalid characters.

$email = sanitize_email($val);

// Validate Email Address
// To check that the input data email address is a valid email address Wordpress has a function is_email(). This will return a boolean value true if the email address is valid.

if(is_email($val))
{
    // Valid email
} else {
    // Invalid email
}

// Numbers
// When expecting numeric data, it's possible to check if the data 'is some form of number', for instance is_int or is_float. Usually, it's sufficient to simply cast the data as numeric with: intval or floatval.

// If you need to ensure the number is padded with leading zeros, WordPress provides the function zeroise(). Which takes the following parameters:

// Number – the number to pad
// Threshold – the number of digits the number will be padded to
// For example:

// 1
echo zeroise(70,4); // Prints 0070

esc_html($title);
esc_html__('Text to translate', 'plugin-domain');
sanitize_email($email);

intval( $int ); 
//or 
(int) $int;
// If it's supposed to be an integer, cast it as one.
absint( $int );

$wpdb->update(
  'my_table',
  array( 'status' => $untrusted_status, 'title' => $untrusted_title ),
  array( 'id' => 123 )
);

$wpdb->get_var( $wpdb->prepare(
  "SELECT something FROM table WHERE foo = %s and status = %d",
  $name, // an unescaped string (function will do the sanitization for you)
  $status // an untrusted integer (function will do the sanitization for you)
) );



// Validation & Sanitization
// As previously mentioned, sanitization doesn't make much sense without a context – so it's pretty pointless to sanitize data when writing to the database. Often, you need to store data in its raw format anyway, and in any case – Rule No. 1 dictates that we should always sanitize on output.

// Query::
$age = 14;
$firstname = "Robert'; DROP TABLE Students;";
$sql = $wpdb->prepare('SELECT * WHERE age=%d AND firstname = %s;',array($age,$firstname));
$results = $wpdb->get_results($sql);

$wpdb->get_row($sql);
$wpdb->get_var($sql);
$wpdb->get_results($sql);
$wpdb->get_col($sql);
$wpdb->query($sql);


$oldname = "Robert'; DROP TABLE Students;";
$newname = "Bobby";
$wpdb->update(
    'Students',
    array( 'firstname' => $newname ),
    array( 'firstname' => $oldname ),
    array( '%s' ),
    array( '%s' )
);
// Both the $wpdb->insert() and the $wpdb->update() methods perform all the necessary sanitization for writing to the database.

$age=14;
$firstname = "Robert'; DROP TABLE Students;";
// SELECT * WHERE age=$age AND (firstname LIKE '%$firstname%');
// $query = $wpdb->prepare('SELECT * WHERE age=%d AND (firstname LIKE %s);', array($age, '%'.like_escape($firstname).'%') );

// Header splitting attacks are annoying since they are dependent on the HTTP client. WordPress has little need to include user-generated content in HTTP headers, but when it does, WordPress typically uses safelisting for most of its HTTP headers.

// WordPress does use user-generated content in HTTP Location headers and provides sanitization for those.

wp_redirect($location, $status = 302);
// A safe way to redirect to any URL. Ensures the resulting HTTP Location header is legitimate.
wp_safe_redirect($location, $status = 302);
// Even safer. Only allows redirects to safelisted domains.

// Input Validation
sanitize_title( $title );
// Used in post slugs, for example
sanitize_user( $username, $strict = false );
// Use $strict when creating a new user (though you should use the API for that).

balanceTags( $html ) or force_balance_tags( $html );
// Tries to make sure HTML tags are balanced so that valid XML is output.
tag_escape( $html_tag_name );
// Sanitizes an HTML tag name (does not escape anything, despite the name of the function).
sanitize_html_class( $class, $fallback );
// Sanitizes a html classname to ensure it only contains valid characters. Strips the string down to A-Z,a-z,0-9,'-' if this results in an empty string then it will return the alternative value supplied
sanitize_email();
sanitize_file_name();
sanitize_html_class();
sanitize_key();
sanitize_mime_type();
sanitize_option();
sanitize_sql_orderby();
sanitize_text_field();
sanitize_title_for_query();
sanitize_title_with_dashes();
sanitize_user();
sanitize_meta();
sanitize_term();
sanitize_term_field();

// +++++++++++++++++++++++++++++++++++++++++++++++++++++++
do_action(); // why we use it ?
// do_action( string $hook_name, mixed $arg );
// Calls the callback functions that have been added to an action hook.

# action Hook
// +++++++++++++++++++++++++++++++++++++++++++++
add_action("wao", "cal_me", 10, 3);
# here Important is -->
// 10 --> priority
// 3 --> I want to pass 3 argument

function cal_me($a, $b, $c){
    echo "<br/>----$a-------$b-----$c<br/>";
}
do_action('wao', 'arafat', 'oeshi', 'wao wao');
// call my added action hook --> wao
// in wao i told i pass 3 so pass 3 here

// ++++++++++++++++++++++++++++++++++++++++++++

add_filter("abc", "test", 10, 3);
// here abc is filter hook
// test is callback function
// 10 is priority
// 3 is --> i want to pass 3 argument only

function test($filter_this, $that, $ant){
    echo "------$filter_this------ $that--$ant";
}

apply_filters( "abc", 'arafat', 'pew pew', 'jon doe' );
//here 
// abc is filter hook that is previously defined
// and arafat, pew pew, jon don is = 3 argument 
// That i told was I pass 3 arguemnt 

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++

// Write a Blog post to understood 
// add_action
// do_action

// add_filter
// apply_filter

// add_action vs do_action
// add_filter vs apply_filter

/*do_action() - this defines a hookable location for actions
add_action() - this attaches a function to a hook created with do_action()
has_action() - this checks to see if an action has been registered with do_action()
remove_action() - this removes an action that was set with add_action()
Of these four, you will use do_action() and add_action() the most.

For filters there are also four main functions:

apply_filters() - this creates a hookable location for custom filters to tie into
add_filter() - this attaches a custom filter to a hook created with apply_filters()
has_filter() - this checks to see if a filter has been registered with apply_filters()
remove_filter() - this removes a filter previously connected to apply_filters()*/




// https://developer.wordpress.org/reference/functions/do_action/

// How to Make WordPress Extensible ?
// https://www.smashingmagazine.com/2018/03/making-wordpress-plugin-extensible/

# how it works ?
ob_start();
// Handle complex html input
ob_get_clean();
# Haa?

# what this function do
function get_jobs( $site, $params ) {
    $query_str = $this->build_query_str( $params );
    $url = 'https://api.lever.co/v0/postings/' . $site . '?' . $query_str;
    $response = wp_remote_get( $url, array(
        'timeout' => 200,
        'headers' => array(
            'Accept' => 'application/json'
        )
    ) );
    $body = wp_remote_retrieve_body( $response );
    return json_decode( $body );
}

plugin_dir_url( __FILE__ ) . 'css/main.css';

printf('helo');

sprintf( __() );

esc_html__('Hello world', 'text-domain');

echo esc_attr( 'some_var' );

echo esc_html( 'some Data' );

echo esc_url( 'some_url' );

esc_html_e( 'data', 'text-domain' );

is_admin();
is_super_admin();

# How to show admin notice 
# How to Push Update on Plugin at your OWN/use someone library



