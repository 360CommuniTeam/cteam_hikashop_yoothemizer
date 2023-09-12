<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Installer\InstallerAdapter;
use Joomla\CMS\Filesystem\Folder;

class plgSystemCTeam_Hikashop_YoothemizerInstallerScript
{
	/**
	 * Constructor
	 *
	 * @param   InstallerAdapter  $adapter  The object responsible for running this script
	 */
	public function __construct(InstallerAdapter $adapter)
	{
        var_dump(__DIR__);
	}
	
	/**
	 * Called before any type of action
	 *
	 * @param   string  $route  Which action is happening (install|uninstall|discover_install|update)
	 * @param   InstallerAdapter  $adapter  The object responsible for running this script
	 *
	 * @return  boolean  True on success
	 */
	public function preflight($route, InstallerAdapter $adapter)
	{
		return true;
	}
	
	/**
	 * Called after any type of action
	 *
	 * @param   string  $route  Which action is happening (install|uninstall|discover_install|update)
	 * @param   InstallerAdapter  $adapter  The object responsible for running this script
	 *
	 * @return  boolean  True on success
	 */
	public function postflight($route, $adapter)
	{
		return true;
	}

    private static function recurseCopy($src, $dst) {
        $dir = opendir($src);
        @mkdir($dst);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . DIRECTORY_SEPARATOR . $file) ) {
                    self::recurseCopy($src . DIRECTORY_SEPARATOR . $file,$dst . DIRECTORY_SEPARATOR . $file);
                }
                else {
                    copy($src . DIRECTORY_SEPARATOR . $file,$dst . DIRECTORY_SEPARATOR . $file);
                }
            }
        }
    }

    private static function getDirContents($dir, &$results = array()) {
        $files = scandir($dir);
    
        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != "..") {
                self::getDirContents($path, $results);
                $results[] = $path;
            }
        }
    
        return $results;
    }

    private static function getTplFilesManifest() {
        $results = self::getDirContents(__DIR__ . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'html');

        foreach ($results as $key => $value) {
            $results[$key] = str_replace(__DIR__ . DIRECTORY_SEPARATOR . 'templates', JPATH_ROOT . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'yootheme', $value);
        }

        return $results;
    }

    private function installTpl() {

        $allFiles = self::getTplFilesManifest();
        
        // Get active template path from anywhere on Joomla: 
        $app    = Factory::getApplication();
        $yoothemePath   = JPATH_ROOT . '/templates/yootheme/';

        if(!Folder::exists($yoothemePath)) {
            Factory::getApplication()->enqueueMessage('YOOTheme is not installed ! ' . $yoothemePath, 'error');
            return false;
        }

        $tplPath = __DIR__ . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'html';
        $destPath =  $yoothemePath . DIRECTORY_SEPARATOR . 'html';

        if(!Folder::exists($tplPath)) {
            Factory::getApplication()->enqueueMessage($tplPath . ' not exists!', 'error');
            return false;
        }

        self::recurseCopy($tplPath, $destPath);

        return true;
    }
	
	/**
	 * Called on installation
	 *
	 * @param   InstallerAdapter  $adapter  The object responsible for running this script
	 *
	 * @return  boolean  True on success
	 */
	public function install(InstallerAdapter $adapter)
	{
		return $this->installTpl();
	}
	
	/**
	 * Called on update
	 *
	 * @param   InstallerAdapter  $adapter  The object responsible for running this script
	 *
	 * @return  boolean  True on success
	 */
	public function update(InstallerAdapter $adapter)
	{
		return $this->installTpl();
	}
	
	/**
	 * Called on uninstallation
	 *
	 * @param   InstallerAdapter  $adapter  The object responsible for running this script
	 */
	public function uninstall(InstallerAdapter $adapter)
	{
        $allFiles = self::getTplFilesManifest();
        $folders = array();
        foreach ($allFiles as $path) {
            if(!is_dir($path)) {
                unlink($path);
            } else {
                array_push($folders, $path);
            }
        }
        foreach ($folders as $path) {
            if(is_dir($path)) {
                rmdir($path);
            }
        }
		return true;
	}
}

?>