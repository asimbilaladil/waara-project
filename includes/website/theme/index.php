<?php
date_default_timezone_set('Asia/Karachi');

require "twitteroauth/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

if (!defined('CONSUMER_KEY'))
{
    define('CONSUMER_KEY', 'ryxIU3day36pu83EXXZxu5uKf');
}

if (!defined('CONSUMER_SECRET'))
{
    define('CONSUMER_SECRET', '8G9QrYsSMxHpW0XW4PVng9oSTPbVEc43yv0NAB3FWaPhgzhAib');
}

if (!defined('OAUTH_TOKEN'))
{
    define('OAUTH_TOKEN', '933957756784119808-EQ11YDHI6oiW5VqIbnm6nP9raqwzeIW');
}

if (!defined('OAUTH_SECRET'))
{
    define('OAUTH_SECRET', 'uoEou16deCIYvVh4Rp2ZsADrwMi6RCvZmSWOjLrCbT4XF');
}

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, OAUTH_TOKEN, OAUTH_SECRET);
$content = $connection->get('account/verify_credentials');

$connection->post('statuses/update', array('status' => $_GET['message']));

?>