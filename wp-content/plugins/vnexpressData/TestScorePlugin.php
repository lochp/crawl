<?php
   /*
   Plugin Name: Test Score Plugin
   Plugin URI: 
   description: Get data from Vnexpress and insert them into database
   Version: 1.0
   Author: loc huynh
   Author URI: http://lochuynh.com
   License: GNU
   */
?>
<?php
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
require_once( dirname( dirname( __FILE__ ) ) . '/vnexpressData/TestScoreImpl.php' );
