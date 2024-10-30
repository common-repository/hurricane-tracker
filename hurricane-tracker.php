<?php
/*
Plugin Name: Hurricane Tracker
Plugin URI:  https://developer.wordpress.org/plugins/the-basics/
Description: Shows information from NOAA on the hurricane warnings. Includes radar maps.
Version:     1.0
Author:      2BitCoders
Author URI:  http://www.2bitcoders.com_create_guid
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wporg
Domain Path: /languages
*/
// If this file is called directly, abort.

if ( ! defined( 'WPINC' ) ) {
    
        die;
    
    }
    
    
    
add_shortcode( 'hurricane-tracker' , 'sc_hurricane_tracker' );
    
    /**
    
     * Perform request to obtain RSS
    
     *
    
     * This call is done internally and will make ready the shortcode
    
    
     *
    
     * @since 1.0.0
    
     */
    #namespace 2BitCoders_Hurricane_Tracker;

    global $body;
    global $header;

    function get_rss_data() {
        WP_DEBUG ? error_log("hurricane_tracker Plugin ::get_rss_data called") : '';

        global $body;

        $response = wp_remote_get("http://www.nhc.noaa.gov/gtwo.xml");
        

        #WP_DEBUG ? error_log("hurricane_tracker Plugin ::get_rss_data response: ".$response) : '';

        if ( is_array( $response ) ) {
            $header = $response['headers']; // array of http header lines
            $body = $response['body']; // use the content
          }
    }

    function sc_hurricane_tracker($atts, $content = '') {
            global $body;
            $build_output_string = '';

            $a = shortcode_atts( array('region' => 'x', 'expanded' => 'x', 'size' => 'x'), $atts );
            get_rss_data();

            $xml = simplexml_load_string($body); #, 'SimpleXMLElement', LIBXML_NOCDATA);
            //echo "xml: ". $xml->asXML();

            WP_DEBUG ? error_log("hurricane_tracker Plugin :: sc_hurricane_tracker: ".$xml->asXML()) : '';   

            if ($a['expanded'] === 'true') {
                $build_output_string .= "<style> .my-weather-details { display: inline; }</style>";
            }

            if ($a['size'] == 'md') {
                $build_output_string .= "<style> .my-weather-details img { width:400px; height:300px; }</style>";
                $build_output_string .= "<style> .my-weather-details .textbackground .textproduct { font-size: 14px; } </style>";
            }

            if ($a['size'] == 'lg') {
                $build_output_string .= "<style> .my-weather-details img { width:600px; height:500px; }</style>";
                $build_output_string .= "<style> .my-weather-details .textbackground .textproduct { font-size: 16px; !important } </style>";
            }

            $build_output_string .= "<div id='hurricane-tracker-outter-container'>";
            $build_output_string .= "<img id='hurricane-tracker-header-img' src='". plugin_dir_url( __FILE__ )."assets/hurricane-tracker-small-header.png'>";

            foreach($xml->channel->item as $item){
                if( strpos($item->title,$a['region']) !== false) {
                    #echo "get_template_directory_uri() : ". plugin_dir_url( __FILE__) ;
                    $a['expanded'] === 'false' ? $class = "dashicons dashicons-plus" : $class = '';

                    $build_output_string .= "<div id='hide-show-hurricane-details' class='". $class ."'></div>";
                    $build_output_string .= "<div class='hurricane-details-last-updated'>Last Updated: ".$item->pubDate."</div>";
                    $build_output_string .= "<br>";
                    $build_output_string .= "<div class='my-weather-details'>" . $item->description . "</div>";
                }
                //echo "this item: ".$item->asXML();
            }

            $build_output_string .= "</div>";
            #$content = "From the Hurricane Tracker! <br>"; #.$body."<br><br><br>".$content;
            return do_shortcode($build_output_string);
    }
    


    function hurricane_enqueue_scripts(){
       wp_enqueue_script( 'hurricane-script', plugin_dir_url( __FILE__) . '/hurricane.js' );
       wp_enqueue_style( 'hurricane', plugin_dir_url( __FILE__) . '/hurricane.css' );
       wp_enqueue_style('dashicons');
    }

add_action( 'wp_enqueue_scripts', "hurricane_enqueue_scripts" );