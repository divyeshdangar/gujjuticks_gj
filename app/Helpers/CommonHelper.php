<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Crypt;

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

    static function encUrlParam($slug)
    {
        return Crypt::encrypt($slug);
    }

    static function decUrlParam($slug)
    {
        try {
            return Crypt::decrypt($slug);
        } catch (\Throwable $th) {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard')->with($message);
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