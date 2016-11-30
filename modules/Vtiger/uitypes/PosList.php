<?php

/**
 * UIType POS Field Class
 * @package YetiForce.UIType
 * @license licenses/License.html
 * @author Tomasz Kur <t.kur@yetiforce.com>
 * @author Radosław Skrzypczak <r.skrzypczak@yetiforce.com>
 */
class Vtiger_PosList_UIType extends Vtiger_Taxes_UIType
{

	private function getServers()
	{
		$dataReader = (new \App\Db\Query())->select(['id', 'name'])
				->from('w_#__servers')
				->where(['type' => 'POS', 'status' => 1])
				->createCommand()->query();
		$listServers = [];
		while ($server = $dataReader->read()) {
			$listServers[$server['id']] = $server['name'];
		}
		return $listServers;
	}

	public function getPicklistValues()
	{
		return $this->getServers();
	}

	/**
	 * Function to get value for database
	 * @param mixed $value
	 * @return string
	 */
	public function getDBValue($value)
	{
		if (is_array($value)) {
			$value = implode(',', $value);
		}
		return $value;
	}
}
