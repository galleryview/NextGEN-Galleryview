<?php
/**
NextGEN-Galleryview Template

DO NOT MODIFY TEMPLATE DIRECTLY. 

If you wish to modify this template please create a folder called nggallery within your theme and copy the file. Then make any desired changes.

 Follow variables are useable :

 $gallery     : Contain all about the gallery
 $images      : Contain all images, path, title
 $pagination  : Contain the pagination content

 You can check the content when you insert the tag <?php var_dump($variable) ?>
 If you would like to show the timestamp of the image ,you can use <?php echo $exif['created_timestamp'] ?>
 
 Find more galleryview options at http://spaceforaname.com/galleryview/
 **/
?>

<!-- Css to hide gallery unitl loads -->
<style>
#<?php echo $gallery->anchor ?>{display:none;}
</style>

<?php if (!defined('ABSPATH')) die ('No direct access allowed'); ?><?php if (!empty ($gallery)) : ?>

<div id="<?php echo $gallery->anchor; ?>" class="galleryview">
  	<ul class="<?php echo $gallery->anchor; ?>">
  	<?php foreach ($images as $image) : ?>
	    <li><div class="filmstrip-borders"></div><img src="<?php echo $image->imageURL;  ?>" alt="<?php echo $image->alttext; ?>" data-description="<?php echo $image->description; ?>" title="<?php echo $image->alttext; ?>" <?php echo $image->size; ?>  /></li>
	<?php endforeach; ?>
  	</ul>
</div>

<div class="clear"><br /></div>
<script type="text/javascript" defer="defer">
	jQuery("document").ready(function(){
		jQuery('#<?php echo $gallery->anchor ?>').galleryView({

		// General Options
		transition_speed: 1000, 		//INT - duration of panel/frame transition (in milliseconds)
		transition_interval: 5000, 		//INT - delay between panel/frame transitions (in milliseconds)
		easing: 'swing', 				//STRING - easing method to use for animations (jQuery provides 'swing' or 'linear', more available with jQuery UI or Easing plugin)

		// Panel Options
		show_panels: true, 				//BOOLEAN - flag to show or hide panel portion of gallery
		show_panel_nav: true, 			//BOOLEAN - flag to show or hide panel navigation buttons
		enable_overlays: false, 			//BOOLEAN - flag to show or hide panel overlays
		panel_width: 620, 				//INT - width of gallery panel (in pixels)
		panel_height: 300, 				//INT - height of gallery panel (in pixels)
		panel_animation: 'fade', 		//STRING - animation method for panel transitions (crossfade,fade,slide,none)
		panel_scale: 'crop', 			//STRING - cropping option for panel images (crop = scale image and fit to aspect ratio determined by panel_width and panel_height, fit = scale image and preserve original aspect ratio)
		overlay_position: 'bottom', 	//STRING - position of panel overlay (bottom, top)
		pan_images: false,				//BOOLEAN - flag to allow user to grab/drag oversized images within gallery
		pan_style: 'drag',				//STRING - panning method (drag = user clicks and drags image to pan, track = image automatically pans based on mouse position
		pan_smoothness: 15,				//INT - determines smoothness of tracking pan animation (higher number = smoother)

		// Filmstrip Options
		start_frame: 1, 				//INT - index of panel/frame to show first when gallery loads
		show_filmstrip: true, 			//BOOLEAN - flag to show or hide filmstrip portion of gallery
		show_filmstrip_nav: true, 		//BOOLEAN - flag indicating whether to display navigation buttons
		enable_slideshow: true,			//BOOLEAN - flag indicating whether to display slideshow play/pause button
		autoplay: true,				//BOOLEAN - flag to start slideshow on gallery load
		show_captions: false, 			//BOOLEAN - flag to show or hide frame captions
		filmstrip_size: 3, 				//INT - number of frames to show in filmstrip-only gallery
		filmstrip_style: 'scroll', 		//STRING - type of filmstrip to use (scroll = display one line of frames, scroll filmstrip if necessary, showall = display multiple rows of frames if necessary)
		filmstrip_position: 'bottom', 	//STRING - position of filmstrip within gallery (bottom, top, left, right)
		frame_width: 80, 				//INT - width of filmstrip frames (in pixels)
		frame_height: 40, 				//INT - width of filmstrip frames (in pixels)
		frame_opacity: 0.4, 			//FLOAT - transparency of non-active frames (1.0 = opaque, 0.0 = transparent)
		frame_scale: 'crop', 			//STRING - cropping option for filmstrip images (same as above)
		frame_gap: 5, 					//INT - spacing between frames within filmstrip (in pixels)

		// Info Bar Options
		show_infobar: true,				//BOOLEAN - flag to show or hide infobar
		infobar_opacity: 1				//FLOAT - transparency for info bar
		});
	});

</script>
<?php endif; ?>