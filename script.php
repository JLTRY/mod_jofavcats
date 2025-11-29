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

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Installer\InstallerAdapter;
use Joomla\CMS\Installer\InstallerScriptInterface;
use Joomla\CMS\Language\Text;
use Joomla\Filesystem\Folder;
use Joomla\CMS\Log\Log;

return new class () implements InstallerScriptInterface {
    private string $minimumJoomla = '5.0.0';
    private string $minimumPhp    = '7.4.0';

    private function mkdirThumbs()
    {
        try {
            $thumbFolder =  JPATH_SITE . DIRECTORY_SEPARATOR . 'files' .
                            DIRECTORY_SEPARATOR . 'mod_jofavcats' . DIRECTORY_SEPARATOR . 'thumbs';
            Log::add("mod_jofavcats install . $thumbFolder", Log::INFO, 'extension-installation');
            Folder::create($thumbFolder);
            for ($i = 0; $i < 10; $i++) {
                Folder::create($thumbFolder . DIRECTORY_SEPARATOR . "0" . "$i");
            }
        } catch (\FilesystemException $e) {
            echo Text::sprintf('FILES_JOOMLA_ERROR_FILE_FOLDER', $e) . '<br>';
        }
    }

    public function install(InstallerAdapter $adapter): bool
    {
        Log::add("mod_jofavcats install", Log::INFO, 'extension-installation');
        $this->mkdirThumbs();
        return true;
    }

    public function update(InstallerAdapter $adapter): bool
    {

        Log::add("mod_jofavcats update", Log::INFO, 'extension-installation');
        $this->mkdirThumbs();
        return true;
    }

    public function uninstall(InstallerAdapter $adapter): bool
    {
        Log::add("mod_jofavcats uninstall", Log::INFO, 'extension-installation');
        return true;
    }

    public function preflight(string $type, InstallerAdapter $adapter): bool
    {
        Log::add("mod_jofavcats preflight", Log::INFO, 'extension-installation');

        if (version_compare(PHP_VERSION, $this->minimumPhp, '<')) {
            Factory::getApplication()->enqueueMessage(sprintf(
                Text::_('JLIB_INSTALLER_MINIMUM_PHP'),
                $this->minimumPhp
            ), 'error');
            return false;
        }

        if (version_compare(JVERSION, $this->minimumJoomla, '<')) {
            Factory::getApplication()->enqueueMessage(sprintf(
                Text::_('JLIB_INSTALLER_MINIMUM_JOOMLA'),
                $this->minimumJoomla
            ), 'error');
            return false;
        }

        return true;
    }

    public function postflight(string $type, InstallerAdapter $adapter): bool
    {
        Log::add("mod_jofavcats postflight", Log::INFO, 'extension-installation');
        return true;
    }
};
