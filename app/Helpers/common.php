<?php

if (!function_exists('uuid')) {
    /**
     * Function generate uuid
     *
     * @param bool $hasDash Condition to remove dash
     *
     * @return string
     */
    function uuid(bool $hasDash = false)
    {
        $uuid = \Ramsey\Uuid\Uuid::uuid4();
        return $hasDash ? $uuid : str_replace('-', '', $uuid->toString());
    }
}


if (!function_exists('cuser')) {
    /**
     * Function generate uuid
     *
     * @param bool $hasDash Condition to remove dash
     *
     * @return string
     */
    function cuser()
    {
        return \Illuminate\Support\Facades\Auth::user() ? \Illuminate\Support\Facades\Auth::user() : \App\Http\Models\User::find(1) ;
    }
}

/**
 * Format to view datatime with format
 *
 * @param string $date
 * @param string $format
 *
 * @return string
 */
function formatDate($date, $format = 'd-m-Y')
{
    if ($date) {
        return date($format, strtotime($date));
    }

    return null;
}

/**
 * Format to view datatime is d-m-Y
 *
 * @param string $date
 *
 * @return string
 */
function viewFormatDate($date)
{
    return formatDate($date, 'd-m-Y');
}

/**
 * Format to view datatime is Y-m-d
 *
 * @param string $date
 *
 * @return string
 */
function serverFormatDate($date)
{
    return formatDate($date, 'Y-m-d');
}
