<?php
/*------------------------------------------------------------------------
# mod_jofavcats - JO Favorite Categories
# ------------------------------------------------------------------------
# author    JL TRYOEN / Jesús Vargas Garita
# Copyright (C) 2010 www.joomlahill.com. All Rights Reserved.
# Copyright (C) 2025 www.jltryoen.fr All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
# Websites: http://www.jltryoen.fr http://www.joomlahill.com
-------------------------------------------------------------------------*/
namespace JLTRY\Module\JOFavCats\Site\Dispatcher;


use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use Joomla\CMS\Helper\HelperFactoryAwareInterface;
use Joomla\CMS\Helper\HelperFactoryAwareTrait;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\Registry\Registry;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Dispatcher class for mod_articles
 *
 * @since  5.2.0
 */
class Dispatcher extends AbstractModuleDispatcher implements HelperFactoryAwareInterface
{
    use HelperFactoryAwareTrait;
	/**
	 * Returns the layout data.
	 *
	 * @return  array
	 *
	 * @since   5.2.0
	 */
	protected function getLayoutData(): array {
		$data   = parent::getLayoutData();
		$params = $data['params'];

		if ($params->get('hide1', 0) && (JRequest::getCmd('option')=='com_content' && JRequest::getCmd('view')=='article')) {
			return array();
		} else {
			$cats = $this->getHelperFactory()->getHelper('FeatCatsHelper')::getList($params);
			if (!empty($cats)) {

				if (!$params->get('mid')) { 
					$mid = $this->module->id;
				} else {
					$mid = $params->get('mid');
				}
				return array(
							'module'   => $this->module,
							'app'      => $this->app,
							'input'    => $this->input,
							'params'   => new Registry($this->module->params),
							'template' => 'default',
							'cats' => $cats);
			} else {
				return array();
			}
		}
	}
}