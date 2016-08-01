	<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_tx_google_map
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$doc = JFactory::getDocument();
$doc->addScript('https://maps.googleapis.com/maps/api/js?v=3.exp&key='. $params->get('api', ''));//Add map api script
$doc->addStyledeclaration("#tx_google_map_canvas$uniqid{height:" . $height . "px}");//Add inline stlesheet

?>
<div class="tx_google_map-module clearfix">
<?php
if ($lat && $lng) { ?>
	<div id="tx_google_map<?php echo $uniqid ?>">
		<script type="text/javascript">
		var myLatlng  = new google.maps.LatLng(<?php echo $lat ?>,<?php echo $lng ?>);
		function initialize() {
			<?php if($params->get('enable_style', 0)): ?>
			// Specify features and elements to define styles.
			var styleArray = [
				{
					featureType: "all",
					stylers: [
						{ saturation: -80 }
					]
				},{
					featureType: "road.arterial",
					elementType: "geometry",
					stylers: [
						{ hue: "#00ffee" },
						{ saturation: 50 }
					]
				},{
					featureType: "poi.business",
					elementType: "labels",
					stylers: [
						{ visibility: "off" }
					]
				}
			];
			<?php endif; ?>
			var mapOptions = {
				zoom: <?php echo $zoom ?>,
				center: myLatlng,
				mapTypeId: google.maps.MapTypeId.<?php echo $map_type ?>,
				scrollwheel: false,
				<?php if($params->get('enable_style', 0)): ?>
				//Apply the map style array to the map.
				styles: styleArray,
				<?php endif; ?>
				
				<?php if($params->get('mapTypeControl', 0)): ?>
				// Apply the map style array to the map.
				mapTypeControl: true,
				mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
                }
				<?php endif; ?>

			};
			var map = new google.maps.Map(document.getElementById('tx_google_map_canvas<?php echo $uniqid ?>'), mapOptions);
			var marker = new google.maps.Marker({position: myLatlng, map:map, icon: '<?php echo $marker_img; ?>'});
		}
		google.maps.event.addDomListener(window, 'load', initialize);
		</script>
		<div id="tx_google_map_canvas<?php echo $uniqid ?>"></div>
	</div>
<?php } else { ?>
	<p></p>
<?php } ?>

</div>
