=== NextGEN-Galleryview ===
Contributors: Alex Rabe, Brandon Hubbard
Donate link: http://brandonhubbard.com/
Tags: photos, slideshow,images,gallery,media,admin,post,photo-albums,pictures,widgets,photo,picture,image,nextgen-gallery,nextgen gallery
Requires at least: 3.4
Tested up to: 3.5.2
Stable tag: 1.3.1
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Adds the Galleryview template for use with the NextGen-Gallery plugin.

== Description ==

NextGEN-Galleryview (originally created by Alex Rabe) is a Wordpress plugin providing NextGen-Gallery plugin users a new template based on the Galleryview jQuery Plugin created by Jack Wanders (@jackwanders). The plugin has been updated by Brandon Hubbard (@bhubbard).




== Credits ==

Brandon Hubbard - @bhubbard
Alex Rabe
Jack Wanders

== Installation ==

= Basic Usage: =

1. Download, install, and activate the NextGEN Gallery plugin.
1. Download, install, and activate the NextGEN-Galleryview plugin
1. From your Wordpress Dashboard, go to Gallery > Add Gallery/Images > Follow the on-screen cues.
1. When adding a gallery via the shortcode add template="galleryview"

= Advanced Usage: =

1. Create a folder called "nggallery" within your Wordpress theme.
1. Copy "gallery-galleryview.php" from the "view" folder of the plugin and place it within the nggallery folder you created.
1. Now modify the template and galleryview javascript to meet your needs.
1. When adding a gallery via the shortcode add template="galleryview"

== Screenshots ==



== Shortcode ==

= Examples =


[nggallery id=1 template="galleryview"]


== Frequently Asked Questions ==



== Changelog ==

= V1.3.1 =

* Switched galleryview script to responsive version (Thanks to Jeroen Penninck)

= V1.3 =

* Fixed issue with plugin replacing all galleries. Thanks @vtxyzzy
* Updated Easing call to use // instead of http://

= V1.1 =

* Updated GalleryView to latest version (Version 3.0 beta 3)