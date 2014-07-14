
# GalleryView

GalleryView is a photo gallery plugin for jQuery. It offers several features such as a filmstrip, and now support to be responsive. You can find the latest version at https://github.com/bhubbard/GalleryView

## Contributors
* Jack Anderson (@jackwanders)
* Jeroen (@jeroenpx)

## Frequently Asked Questions
This section will be updated soon.

---

# Getting Started
1. Place galleryview-x.x folder somewhere in your website directory structure (you can rename this folder if desired)

2. Include script tags for the desired version of the script (uncompressed, packed) and for the included jQuery Timers and Easing plugin files

3. Include a reference to the jquery.galleryview-x.x.css stylesheet in your document

4. Create an unordered list in your HTML with the content you wish to be displayed in your gallery (see below for more information on markup options

5. Add class "galleryView" to the unordered list to make it invisible at firt (in order to prevent a flash of unstyled content).

6. Call the GalleryView plugin with the function call below:

	```js
	jQuery('#id_of_list').galleryView()
	```

	To override default option values, include them in object literal format in the call to the plugin, like so:

	```js
	jQuery('#id_of_list').galleryView({
		panel_width: 800,
		panel_height: 600,
		frame_width: 120,
		frame_height: 90
	});
	```
	
	Refer to the uncompressed javascript to see a full list of options, their effects on the plugin and their default values.
	


### HTML MARKUP REQUIREMENTS
Below, I will show you the markup required to produce various types of galleries. After the first example, 
I will exclude the UL wrapper and only show the HTML necessary for a single panel and/or frame.

1. Basic slideshow (no added features)

	```html
	<ul id="gallery" class="galleryView">
		<li><img src="../gv/path/to/image1.jpg" alt="image1" /></li>
		<li><img src="../gv/path/to/image2.jpg" alt="image2" /></li>
		<li><img src="../gv/path/to/image3.jpg" alt="image3" /></li>
		<li><img src="../gv/path/to/image4.jpg" alt="image4" /></li>
	</ul>
	```

	This is the simplest gallery one can have. By default, the filmstrip will appear below the panels. The number of frames visible will be determined by the size of the panels. If there is enough space in the gallery to fit all the filmstrip frames, the filmstrip will be centered within the gallery. If there are too many frames, the additional frames will be hidden from view initially, appearing as the filmstrip slides to the left with each transition. Panel and frame dimensions are set via plugin options, as is the location of the filmstrip. It can be set to appear below, above, or to either side of the panels.

2. Slideshow with custom thumbnails
	```html
	<li>
		<img src="../gv/path/to/image.jpg" data-frame="../gv/path/to/thumb.jpg" alt="image" height="" width="" />
	</li>
	```

	By adding a data-frame attribute with a relative or absolute path to a separate image, GalleryView will use it to populate the thumbnail. This can be helpful when using large panel images and small thumbnails to avoid degradation due to scaling.
	
3. Slideshow with panel overlays
	```html
	<li>
		<img src="../gv/path/to/image.jpg" alt="image" title="Pretty Picture" data-description="Some more information about the photo" height="" width="" />
	</li>
	```

	For this gallery, the contents of the title and data-description attributes will display on top of the panel image, its position determined by the 'overlay_position' option. The color of the overlays are  set in the included CSS file.

4. Slideshow with images delayed loading
	```html
	<li><img data-original="../gv/path/to/image1.jpg" src="../css/grey.gif" alt="image1" height="" width="" /></li>
	<li><img data-original="../gv/path/to/image2.jpg" src="../css/grey.gif" alt="image2" height="" width="" /></li>
	<li><img data-original="../gv/path/to/image3.jpg" src="../css/grey.gif" alt="image3" height="" width="" /></li>
	<li><img data-original="../gv/path/to/image4.jpg" src="../css/grey.gif" alt="image4" height="" width="" /></li>
	```
	
	Put placeholder image into src attribute and store real image url in data-original attribute. The browser won't load the real images until the GalleryView is initialized (that is, when <code>$('#id_of_list').galleryView()</code> is called). This feature is inspired by the [Lazy Load Plugin for jQuery](https://github.com/tuupola/jquery_lazyload) by [Mika Tuupola](http://www.appelsiini.net/projects/lazyload).
	
### CREATING/USING CUSTOM NAVIGATION THEMES
GalleryView comes with two themes by default:
* dark
* light

The dark themes contain dark navigation buttons and are best used in galleries with light backgrounds. The light themes contain light colored images and are best for galleries with dark backgrounds. Both themes also contain oversized panel navigation buttons to demonstrate GalleryView's ability to use any kind of navigation images you may want to use.

To create your own navigation theme, first create the following images:
* next.png
* prev.png
* play.png
* pause.png
* panel-nav-next.png
* panel-nav-prev.png

The images can be of any file type. Then, update the galleryView CSS file with the paths to your new navigation images.

---

## Upgrade Notice
Currently there are no upgrade notices.

## Changelog

#### Version 3.1.0 - 2014-07-05
* Offering Minified Versions of Galleryview CSS & JS
* Re-Organizing Files in the Repo
* Responsive Code Provided by Jerome
* Separated Themes Into Separate Sass Files & Image Folders

#### Version 3.0 beta 3 - 2011-03-15
* Anchor tags in source markup now transfer to both the filmstrip and the panel
* Fixed bug preventing filmstrip from stretching full width of gallery when 'show_filmstrip_nav' option was set to false
* Enabled ability to show all frames and filmstrip navigation together
* Added new option to control display of panel overlays
* Classes applied to the source <li> tags will be copied to both the appropriate filmstrip frame and panel
* Classes applied to the source <ul> tag will be copied to the resulting gallery <div> 
* New options:
	- show_overlays
	- BOOLEAN: flag to indicate whether to show or hide panel overlays

#### Version 3.0 beta 2 - 2011-03-14
* Class names altered to be less generic, avoid interference from other CSS
* Removed fixed caption size, added CSS support for multi-line captions
* Added 'filter:inherit' CSS rule to panels to combat IE8 which prevents fade animations from working
* Changed navigation images to <div> tags with images as backgrounds. Navigation images can now be defined in CSS
* Removed options:
	- nav_theme - no longer necessary as navigation images are defined in CSS
	- theme_format - no longer necessary as navigation images are defined in CSS	

#### Version 3.0 beta 1 - 2011-03-10
* Setting transition interval to 0 prevents automated transitions instead of causing instant transitions
* Capped transition speed at value of transition interval to prevent overlapping animations
* Changed default panel_scale value from 'nocrop' to 'crop'
* Capped pointer size to 1/2 of frame width to prevent pointer from extending past frame edge
* Fixed bug that caused misplaced panels when not displaying filmstrip
* Fixed bug when calling plugin after window load
* Added ability to slide panels as an alternative to fading
* Various bug fixes regarding incorrect element placement after customizing CSS
* Improved gallery loading behavior (users no longer see gallery animating to initial panel/frame)
* Updated navigation themes to PNG format and included PNG support for custom navigation themes
* Made both panel and filmstrip navigation optional, regardless of panel and filmstrip visibility
* Panel navigation overlay images are now set to be opaque due to an IE7 PNG transparency bug. You can create your own transparent overlay images if you wish
* New options:
	- filmstrip_style
		- STRING: Sets behavior of filmstrip (scroll,show all)
			- 'show all' forces 'show_navigation' to false and 'pointer_size' to zero (if there are 
			  multiple rows of frames)
	- show_panel_nav
		- BOOLEAN: flag to indicate whether to display panel-based navigation buttons
	- show_filmstrip_nav
		- BOOLEAN: flag to indicate whether to display filmstrip-based navigation buttons
	- animate_pointer
		- BOOLEAN: flag to indicate whether filmstrip pointer animates between frames or jumps instantly
	- panel_animation
		- STRING: type of transition panels should undergo (fade,crossfade,slide,zoom,none)
	- theme_format
		- STRING: extension type of images in the theme indicated by the 'nav_theme' option
* Removed options:
	- fade_panels
		- no longer necessary as setting panel_animation to 'none' serves the same purpose

#### Version 2.1.1 - 2010-03-15
* Small bug fix dealing with frame opacity

#### Version 2.1 - 20010-03-14
* Made minor updates to ensure compatibility with jQuery 1.4.x
* Heavily commented javascript code
* Included README.txt with instructions on using plugin
* Updated jQuery Timers plugin to version 1.3

#### Version 2.0 - 2009-05-05
* Revised required HTML markup for GalleryView
* Filmstrip frames are generated automatically (no need for two sets of images)
* Moved majority of aesthetic styling to external CSS
* Default aesthetics for gallery updated
* Set GalleryView to wait until images finish loading before building itself
* Added 'current' class to current filmstrip frame for user customization
* Allowed for more user-defined styling in panels and filmstrip frames
* Filmstrip can now be placed on left and right side of gallery, in addition to top and bottom
* Panel images can now be scaled to fit within panel or zoomed & cropped to fill panel
* Filmstrip images can now be scaled to fit within frame or zoomed & cropped to fill frame
* Panel overlay backgrounds are now only added to those panels with overlays
* 'pause_on_hover' option now pauses when mouse hovers over filmstrip as well as panel
* Added option to start gallery on any frame
* Current frame pointer is now built with CSS and its size can be customized easily
* Increased size of hitbox on panel-navigation buttons
* Updated options:
	- filmstrip_position
		- new allowable values : 'top', 'right', 'bottom', 'left'		
* Removed options:
	- overlay_height
	- overlay_font_size
	- overlay_color
	- background_color
	- overlay_text_color
	- caption_text_color
	- border
* New options:
	- show_panels (boolean)
	- show_filmstrip (boolean)
	- start_frame (integer)
	- pointer_size (integer)
	- panel_scale
		- allowable values : 'crop', 'nocrop'
	- frame_scale
		- allowable values : 'crop', 'nocrop'
	- frame_gap (integer)	

#### Version 1.1 - 2009-04-05
* Added feature allowing filmstrip w/o panels
* Added feature allowing panels w/o filmstrip
* Added feature allowing filmstrip placement above or below panels
* Added new graphics for panel navigation
* Anchored navigation buttons to edges of filmstrip, rather than gallery boundaries
* New options:
	- filmstrip_position
		- allowable values : 'top', 'bottom'
	- overlay_position
		- allowable values : 'top', 'bottom'

#### Version 1.0.1 - 2009-03-30
* Fixed bug allowing blank frames to display in filmstrip
* Changed pointer graphic from GIF to PNG to allow for greater customization
* Added 'overflow: hidden' to panels to prevent oversized content from breaking gallery
* Disabled frame clicking during filmstrip animation
* Changed pointer border from 4px to 2px

#### Version 1.0 - 2009-03-29
* Initial Release


