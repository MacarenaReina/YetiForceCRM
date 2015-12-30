<?php

/**
 * UIType ReferenceProcess Field Class
 * @package YetiForce.Fields
 * @license licenses/License.html
 * @author Mariusz Krzaczkowski <m.krzaczkowski@yetiforce.com>
 */
class Vtiger_ReferenceProcess_UIType extends Vtiger_ReferenceLink_UIType
{

	public function getReferenceList()
	{
		$modules = Vtiger_Module_Model::getModulesByLevel(1);
		return array_keys($modules);
	}
}
