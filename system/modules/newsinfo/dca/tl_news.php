<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */
 
 
/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_news']['palettes']['default'] = str_replace('time;', 'time;{location_legend},location;', $GLOBALS['TL_DCA']['tl_news']['palettes']['default']);

// remove some filter options
$GLOBALS['TL_DCA']['tl_news']['fields']['noComments']['filter'] = false;

// Fields
$GLOBALS['TL_DCA']['tl_news']['fields']['location'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_news']['location'],
	'exclude'                 => true,
	'filter'                  => true,
	'inputType'               => 'text',
	'eval'                    => array('tl_class'=>'w50 long',),
	'sql'                     => "varchar(256) NOT NULL default ''"
);

