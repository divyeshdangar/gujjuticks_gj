<?php

namespace App\Helpers;

class CommonHelper
{
    static function highLight($text)
    {
        $search = $_GET['search'] ?? '';
        $search = trim($search);        
        $replace = '<span class="text-dark bg-warning rounded-1">\1</span>';
        if (empty($search) || $search == "") {
            return $text;
        } else {
            return preg_replace('#('.$search.')#i', $replace, $text);
        }
    }
}



// if (! function_exists('get_month_name')) {
//     function get_month_name(int $month)
//     {
//         return date('F', mktime(0, 0, 0, $month, 1));
//     }
// }

// https://medium.com/@maulanayusupp/how-to-create-helper-in-laravel-10-laravel-helper-creation-7fb7824ce67c