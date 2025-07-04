<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

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
            return preg_replace('#(' . $search . ')#i', $replace, $text);
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

    public static function generateUniqueCode($table, $column, $length = 6)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        do {
            $code = substr(str_shuffle(str_repeat($characters, ceil($length / strlen($characters)))), 0, $length);
            $exists = DB::table($table)->where($column, $code)->exists();
        } while ($exists);
        return $code;
    }

    static function getInitials($string)
    {
        $words = preg_split('/\s+/', trim($string));
        $count = count($words);

        // Helper to get safe character
        $safeChar = function ($char) {
            return ctype_alnum($char) ? strtoupper($char) : 'A';
        };

        if ($count === 1) {
            $first = $safeChar(substr($words[0], 0, 1));
            $second = $safeChar(substr($words[0], 1, 1));
            return $first . $second;
        }

        $first = $safeChar(substr($words[0], 0, 1));
        $second = $safeChar(substr($words[1], 0, 1));
        return $first . $second;
    }
}
