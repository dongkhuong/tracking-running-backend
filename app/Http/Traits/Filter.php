<?php

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Filter
{
	protected function buildFilter($conditions)
	{
        $newConditions = [];
		foreach($conditions as $index => $condition) {
            if (is_array($condition)) {
                if ($condition[2] == '' || is_null($condition[2])) {
                    continue;
                } else {
                    if (strtolower($condition[1]) === 'like') {
                        $condition[2] = '%' . $condition[2] . '%';
                    }
                    array_push($newConditions, $condition);
                }
            } else {
                if (is_null($condition)) {
                    continue;
                } else {
                    $newConditions[$index] = $condition;
                }
            }
        }

        return $newConditions;
	}

	public function scopeFilter(Builder $query, $params)
	{
		return $query->where($this->buildFilter($params));
	}
}
