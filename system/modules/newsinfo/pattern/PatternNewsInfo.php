<?php
/**
 * Contao Open Source CMS Extension
 *
 * @package  	 News meta info (Content block pattern)
 * @author   	 Arne Stappen
 * @license  	 LGPL-3.0+ 
 * @copyright	 Arne Stappen (2016)
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

			//headline
			$arrMeta['headline'] = $objNewsArticle->headline;

			//author
			if (($objAuthor = $objNewsArticle->getRelated('author')) !== null)
			{
				$arrMeta['author'] = $objAuthor->name;
			}

			//date
			$arrMeta['mdate'] = $objNewsArticle->date;
			$arrMeta['date'] = \Date::parse($objPage->datimFormat, $objNewsArticle->date);

			//location
			$arrMeta['location'] = $objNewsArticle->location;
			
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
