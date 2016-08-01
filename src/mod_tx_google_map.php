<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_tx_google_map
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

//Parameters
$uniqid 			= $module->id;
$lat					= $params->get ('lat');
$lng					= $params->get ('lng');
$height				= $params->get ('height',300);
$map_type			= $params->get ('map_type','ROADMAP');
$zoom					= $params->get ('zoom',8);

if( !empty($params->get ('marker_image', '')) ){
    $marker_img = JUri::root(false) . '/' . $params->get ('marker_image', '');
}else{
    $marker_img = 'http://maps.google.com/mapfiles/marker.png';
}

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_tx_google_map', $params->get('layout', 'default'));
