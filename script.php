<?php
defined('_JEXEC') or die;
define("DS", DIRECTORY_SEPARATOR);
use Joomla\CMS\Factory;
use Joomla\CMS\Installer\InstallerAdapter;
use Joomla\CMS\Installer\InstallerScriptInterface;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Filesystem\Folder;
use Joomla\CMS\Log\Log;

return new class () implements InstallerScriptInterface {

    private string $minimumJoomla = '4.4.0';
    private string $minimumPhp    = '7.4.0';

    private function mkdirThumbs()
    {
        try {
          $thumbFolder = JPATH_SITE . DS.  'modules' . DS . 'mod_featcats' . DS . 'thumbs';
		  Log::add("mod_hello install . $thumbFolder" , Log::INFO, 'extension-installation'); 
          Folder::create($thumbFolder);
          for ($i = 0; $i < 10; $i++) {
              Folder::create($thumbFolder . DS . "0" . "$i");
          }
       } catch (\FilesystemException $e) {
          echo Text::sprintf('FILES_JOOMLA_ERROR_FILE_FOLDER', $e) . '<br>';
       }
    }

    public function install(InstallerAdapter $adapter): bool
    {
        Log::add("mod_hello install" , Log::INFO, 'extension-installation'); 
        $this->mkdirThumbs();
        return true;
    }

    public function update(InstallerAdapter $adapter): bool
    {

        Log::add("mod_featcats update" , Log::INFO, 'extension-installation'); 
		$this->mkdirThumbs();
        return true;
    }

    public function uninstall(InstallerAdapter $adapter): bool
    {
        Log::add("mod_featcats uninstall" , Log::INFO, 'extension-installation'); 
        return true;
    }

    public function preflight(string $type, InstallerAdapter $adapter): bool
    {
        Log::add("mod_featcats preflight" , Log::INFO, 'extension-installation'); 
        
        if (version_compare(PHP_VERSION, $this->minimumPhp, '<')) {
            Factory::getApplication()->enqueueMessage(sprintf(Text::_('JLIB_INSTALLER_MINIMUM_PHP'), $this->minimumPhp), 'error');
            return false;
        }

        if (version_compare(JVERSION, $this->minimumJoomla, '<')) {
            Factory::getApplication()->enqueueMessage(sprintf(Text::_('JLIB_INSTALLER_MINIMUM_JOOMLA'), $this->minimumJoomla), 'error');
            return false;
        }

        return true;
    }

    public function postflight(string $type, InstallerAdapter $adapter): bool
    {
        Log::add("mod_featcats postflight" , Log::INFO, 'extension-installation'); 
        return true;
    }

};
