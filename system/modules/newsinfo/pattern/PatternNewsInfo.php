<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-201 Leo Feyer
 * 
 * @package   Wrapper 
 * @author    Arne Stappen 
 * @license   LGPL 
 * @copyright A. Stappen (2011-2015)
 */

 
namespace Contao;

 
class PatternNewsInfo extends \Pattern
{


	/**
	 * generate the DCA construct
	 */
	public function construct()
	{
		return;
	}
	

	/**
	 * Generate backend output
	 */
	public function view()
	{
		return '';
	}

	/**
	 * Generate data for the frontend template 
	 */
	public function compile()
	{
		// generate a readmore link
		if ($this->cptable == 'tl_news')
		{
			global $objPage;
			
			$objNewsArticle = \NewsModel::findbyPk($this->cpid);
			
			$arrMeta = array();
			
			//date
			$arrMeta['mdate'] = $objNewsArticle->date;
			$arrMeta['date'] = \Date::parse($objPage->datimFormat, $objNewsArticle->date);

			//location
			$arrMeta['location'] = $objNewsArticle->location;

			//author
			if (($objAuthor = $objNewsArticle->getRelated('author')) !== null)
			{
				$arrMeta['author'] = $objAuthor->name;
			}
			
			//comments
			if (!$objNewsArticle->noComments && in_array('comments', \ModuleLoader::getActive()) && $objNewsArticle->source == 'default')
			{
				$arrMeta['ccount'] = \CommentsModel::countPublishedBySourceAndParent('tl_news', $objNewsArticle->id);
				
				if ($this->preLoadComments)
				{
					$colComments = \CommentsModel::findPublishedBySourceAndParent('tl_news', $objNewsArticle->id, true, $this->numberOfComments);
					
					if ($colComments != null)
					{
						$arrMeta['comments'] = $colComments->fetchAll();
					}
				}
			}
			
			parent::compile($arrMeta);
		}
	}
	
}