<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\CardCategory;
use Illuminate\Http\Request;
use URL;

class CardsController extends Controller
{
    public function index(Request $request)
    {
        $dataList = Card::where('is_active', '1')->orderBy('id', 'DESC');
        $dataList = $dataList->searching()->paginate(10)->withQueryString();
        $categories = CardCategory::limit(15)->get();
        $metaData = [
            "title" => "All Customized Wallet Cards – Unique Gift Collection for Every Occasion | GujjuTicks",
            "description" => "Explore our full collection of personalized wallet cards – perfect for birthdays, Raksha Bandhan, anniversaries, and more. Thoughtful, compact gifts crafted with love at GujjuTicks.",
            //"image" => "",
            "keywords" => "custom wallet cards, all wallet cards, personalized cards collection, unique gift ideas, wallet card gifts, gujjuticks cards, gift for every occasion, pocket-sized gifts, custom message cards, celebration wallet cards",
            "url" => route('pages.card.list')
        ];
        $metaData['prev'] = $dataList->previousPageUrl() ?? null;

        return view('pages.card.list', ['metaData' => $metaData, 'dataList' => $dataList, 'categories' => $categories]);
    }

    public function view(Request $request, $slug)
    {
        $dataDetail = Card::where("slug", $slug)->first();
        if ($dataDetail) {
            // to set meta data of page
            $metaData = [
                "title" => $dataDetail->title . " - GujjuTicks",
                "no_title" => true,
                "description" => $dataDetail->meta_description,
                "image" => URL::asset('/images/card/' . $dataDetail->image),
                "url" => route('pages.card.detail', ['slug' => $dataDetail->slug])
            ];
            $categories = CardCategory::limit(15)->get();
            $dataList = Card::where('id', '<>', $dataDetail->id)->where('card_category_id', '<>', $dataDetail->category_id)->limit(3)->get();

            return view('pages.card.view', ['dataDetail' => $dataDetail, 'metaData' => $metaData, 'dataList' => $dataList, 'categories' => $categories]);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('home')->with($message);
        }
    }

    public function category(Request $request, $slug)
    {
        $dataDetail = CardCategory::where("slug", $slug)->first();
        if ($dataDetail) {
            // to set meta data of page
            $metaData = [
                "title" => $dataDetail->title . " - GujjuTicks",
                "no_title" => true,
                "description" => $dataDetail->meta_description,
                "image" => URL::asset('/images/card-category/' . $dataDetail->image),
                "url" => route('pages.card.category.detail', ['slug' => $dataDetail->slug]),

            ];
            $categories = CardCategory::where('id', '<>', $dataDetail->id)->limit(3)->get();
            $dataList = Card::where('card_category_id', $dataDetail->id)
                ->searching()->paginate(6)->withQueryString();
            return view('pages.card.category', ['dataDetail' => $dataDetail, 'metaData' => $metaData, 'dataList' => $dataList, 'categories' => $categories]);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('home')->with($message);
        }
    }
}
