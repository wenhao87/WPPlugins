=== Hierarchical HTML Sitemap ===
Contributors: egolacrima
Tags: html sitemap, seo, sitemap, hierarchical, posts, posts list, pages, pages list, shortcode 

Requires at least: 3.0
Tested up to: 4.3
Stable tag: 1.1
License: GPLv2 or later 

A lightweight and simple HTML sitemap for your WordPress blog.

== Description ==

Hierarchical HTML Sitemap offers visitors an easy and intuitive navigation across your blog.

This plugin generates HTML Sitemap of your WordPress blog. It displays a list of posts, grouped by hierarchically sorted categories. By using a shortcode you can easily and quickly display sitemap on a page, or anywhere where shortcodes work, e.g. in a widget.

The output does not include any CSS or JavaScript files - it is pure HTML, ready for you to style as you want it.

*Полное руководство по установке и использованию плагина на **русском языке** доступны на [блоге автора](http://avovkdesign.com/plugin-hierarchical-html-sitemap.html "Руководство по установке и настройке плагина Hierarchical HTML Sitemap").*


= Features: =

*   Short and easy shortcode: `[htmlmap]`
*   Categories sorted hierarchically.
*   Displays posts and/or pages.
*   Can exclude specified posts/pages or categories.
*   Displays categories cloud above posts list, for better navigation.
*   Displays post’s published date.
*   Clean HTML without inline styles or scripts.
*   Does not enqueue any unnecessary .js or .css files.
*   No ads nor author links.


= Options: =

The plugin’s shortcode `[htmlmap]` accepts several optional parameters:

*   `exclude` : specify posts’ or pages’ IDs you don't want displayed (example: `[htmlmap exclude=445,446]`).
*   `exclude_cat` : specify categories’ IDs you don't want displayed (example: `[htmlmap exclude_cat=1,34]`).
*   `showpages` : enables displaying list of pages (example: `[htmlmap showpages]`).
*   `hidecloud` : disable categories’ cloud (example: `[htmlmap hidecloud]`).
*   `showdescription` : enables displaying categories’ descriptions (they are not shown by default; example: `[htmlmap showdescription]`).
*   `hidedate` : disable displaying posts’ published dates (example: `[htmlmap hidedate]`).

Several parameters could be used in the same shortcode. For example:

`[htmlmap exclude="3546,7398" exclude_cat="1,34" showpages hidecloud]`


== Installation ==

= Automatic installation: =

1. Log-in to your WordPress admin interface.
1. Hover over "Plugins" and click on "Add New".
1. Under Search enter Hierarchical HTML Sitemap and click the "Search Plugins" button.
1. In results page click the "Install Now" link for "Hierarchical HTML Sitemap".
1. Click "Activate Plugin" to finish installation. You're done!

= Manual installation: =

1. Download [Hierarchical HTML Sitemap](http://avovkdesign.com/plugin-hierarchical-html-sitemap.html "Hierarchical HTML Sitemap") and unzip the plugin folder.
1. Upload `hierarchical-sitemap` folder into to the `/wp-content/plugins/` directory.
1. Go to WordPress dashboard and navigate to "Plugins" -> "Installed Plugins".
1. Activate "Hierarchical HTML Sitemap".

= Usage: =

1. Make sure the plugin is installed and activated.
1. Hover over "Pages" and click on "Add New" in WordPress dashboard.
1. Give your page a title "Sitemap" and put `[htmlmap]` into the content box.
1. Save the page and click "View page" link to see your sitemap.



== Screenshots ==

1. Example of a sitemap.

== Changelog ==

= 1.1 =
*	Fix: displaying empty categories (those without children posts but having non-empty sub-categories)
*	New Feature: show categories’ descriptions (use option `showdescription`)
*	New Feature: hide post’s published date (use option `hidedate`)


= 1.0 =
*   Initial release.
