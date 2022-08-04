<?php

use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);


Class test_module extends CModule
{
	var $MODULE_ID = "test_module";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
	var $MODULE_GROUP_RIGHTS = "Y";

	function __construct()
	{
		$arModuleVersion = array();

		include(__DIR__.'/version.php');

		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];

		$this->MODULE_NAME = "Тренировочный модуль";
		$this->MODULE_DESCRIPTION ="Описание тренировочного модуля";
	}


	function InstallDB($install_wizard = true)
	{
		RegisterModule("test_module");
		return true;
	}

	function UnInstallDB($arParams = Array())
	{
		UnRegisterModule("test_module");
		return true;
	}

	function InstallEvents()
	{
		return true;
	}

	function UnInstallEvents()
	{
		return true;
	}

	function InstallFiles()
	{
		return true;
	}

	function InstallPublic()
	{
	}

	function UnInstallFiles()
	{
		return true;
	}

	function DoInstall()
	{
		$this->InstallFiles();
		$this->InstallDB(false);
	}

	function DoUninstall()
	{
		return true;
	}
}
?>