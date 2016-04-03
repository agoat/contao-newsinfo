<?php
/**
 * Contao Open Source CMS Extension
 *
 * @package  	 News meta info (Content block pattern)
 * @author   	 Arne Stappen
 * @license  	 LGPL-3.0+ 
 * @copyright	 Arne Stappen (2016)
 */
 
 
/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_content_pattern']['palettes']['__selector__'][] = 'preLoadComments';

$GLOBALS['TL_DCA']['tl_content_pattern']['palettes']['newsinfo'] = '{type_legend},type;{newsinfo_legend},preLoadComments;{pattern_legend},alias;{invisible_legend},invisible';
$GLOBALS['TL_DCA']['tl_content_pattern']['subpalettes']['preLoadComments'] = 'numberOfComments';


// Fields
$GLOBALS['TL_DCA']['tl_content_pattern']['fields']['preLoadComments'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content_pattern']['preLoadComments'],
	'inputType'               => 'checkbox',
	'eval'                    => array('submitOnChange'=>true, 'tl_class' => 'w50 m12'),
	'sql'                     => "varchar(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_content_pattern']['fields']['numberOfComments'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content_pattern']['numberOfComments'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('rgxp'=>'natural', 'maxval'=>50, 'tl_class'=>'w50',),
	'sql'                     => "varchar(4) NOT NULL default '0'"
);

