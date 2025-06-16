<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_featcats
 *
 * @copyright   (C) 2025 JL TRYOEN  <https://www.jltryoen.fr>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

\defined('_JEXEC') or die;

use Joomla\CMS\Extension\Service\Provider\Module as ModuleServiceProvider;
use Joomla\CMS\Extension\Service\Provider\ModuleDispatcherFactory as ModuleDispatcherFactoryServiceProvider;
use Joomla\CMS\Extension\Service\Provider\HelperFactory as HelperFactoryServiceProvider;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

/**
 * The articles module service provider.
 *
 * @since  5.2.0
 */
return new class () implements ServiceProviderInterface {
    /**
     * Registers the service provider with a DI container.
     *
     * @param   Container  $container  The DI container.
     *
     * @return  void
     *
     * @since   5.2.0
     */
    public function register(Container $container)
    {
        $container->registerServiceProvider(new ModuleDispatcherFactoryServiceProvider('\\JLTRY\\Module\\FeatCats'));
        $container->registerServiceProvider(new HelperFactoryServiceProvider('\\JLTRY\\Module\\FeatCats\\Site\\Helper'));
        $container->registerServiceProvider(new ModuleServiceProvider());
    }
};
