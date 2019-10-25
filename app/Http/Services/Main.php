<?php
namespace App\Http\Services;

trait Main
{
	public function response($obj, $statusCode = 200)
	{
		if ($statusCode === 200) {
			$obj = array_merge(['success' => true], $obj);
		} else {
			$obj = array_merge(['success' => false], $obj);
		}

		$obj = array_merge(['statusCode' => $statusCode], $obj);

		return $obj;
	}

	public function filter($conditions)
	{
		foreach($conditions as $index => $condition) {
			if ((is_array($condition) && $condition[2] == '') || (!is_array($condition) && $condition == '')) {
				unset($conditions[$index]);
			} else if (is_array($condition) && strtolower($condition[1]) === 'like') {
				$condition[2] = '%' . $condition[2] . '%';
				$conditions[$index] = $condition;
			}
		}

		return $conditions;
	}
}
