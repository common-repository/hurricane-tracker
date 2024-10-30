=== Plugin Name ===
Contributors: 2BitCoders
Donate link: http://www.2bitcoders.com
Tags: weather, hurricane, storm
Requires at least: 4.6
Tested up to: 4.7
Stable tag: trunk
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Shortcode driven version of Hurricane Tracker pulling data from NOAA.

== Description ==

Get Hurricane weather forcast info right on your Wordpress site! Currently pulls info using National Oceanic and Atmospheric Administration (NOAA.gov) for North America Atlantic and Pacific regions
with full meteorological descriptions, time of update and radar images.

To use it, just place the shortcode in any page, post or text widget using this tag...

[hurricane-tracker region='Atlantic']

There are currently 3 options you can provide in the tag.

- region
    - REQUIRED. Values are 'Atlantic' or 'Pacific'
- expanded
    - Optional. Start minimized or expanded. Default is expanded. 
- size
    - How large do you want to copy and images?
    - Values are'sm', 'md' and 'lg'
        - sm = width:200px; height:200px; font-size: 10px; This is the default.
        - md = width:400px; height:300px; font-size: 14px;
        - lg = width:600px; height:500px; font-size: 16px;

For example, [hurricane-tracker region='Atlantic' expanded='true' size='lg']

note: If you don't provide a size, it will default to 'sm' and the view will be expanded.



== Installation ==

Installation is basic...

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress



== Screenshots ==

1. shown using shortcode in page

== Changelog ==

= 1.0 =
initil release