<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Webpage;
use App\Models\Template;
use App\Models\IndustryType;
use App\Models\WebpageLink;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class WebpageController extends Controller
{
    public function index(Request $request)
    {
        $metaData = [
            "breadCrumb" => [
                ["title" => __('dashboard.webpage'), "route" => ""]
            ],
            "title" => __('dashboard.webpage')
        ];
        $dataList = Webpage::withTrashed()->orderBy('id', 'DESC')->where('user_id', Auth::id());
        $dataList = $dataList->searching()->paginate(10)->withQueryString();

        return view('dashboard.webpage.index', ['dataList' => $dataList, 'metaData' => $metaData]);
    }

    public function edit(Request $request, $id, $section = 'basic')
    {
        $sections = ['basic', 'social', 'links', 'products', 'template', 'setting'];
        if (in_array($section, $sections)) {
            $dataDetail = Webpage::find($id);
            if ($dataDetail) {
                $metaData = [
                    "breadCrumb" => [
                        ["title" => "Webpage", "route" => "dashboard.webpage"],
                        ["title" => "Edit", "route" => ""]
                    ],
                    "title" => "Edit Webpage"
                ];

                $links = [];
                $industries = [];
                $social = [];
                $templates = [];
                switch ($section) {
                    case 'links':
                        $links = WebpageLink::where('webpage_id', $dataDetail->id)->where('type', 'simple')->orderBy('id', 'DESC')->get();
                        break;

                    case 'social':
                        $links = WebpageLink::where('webpage_id', $dataDetail->id)->where('type', 'social')->orderBy('id', 'DESC')->get();
                        $social = [
                            "Amazon" => "bi bi-amazon",
                            "Android" => "bi bi-android2",
                            "Apple" => "bi bi-apple",
                            "Behance" => "bi bi-behance",
                            "Discord" => "bi-discord",
                            "Dribbble" => "bi bi-dribbble",
                            "Dropbox" => "bi bi-dropbox",
                            "Facebook" => "bi-facebook",
                            "GitHub" => "bi bi-github",
                            "Gitlab" => "bi bi-gitlab",
                            "Google" => "bi bi-google",
                            "Google Play" => "bi bi-google-play",
                            "Instagram" => "bi bi-instagram",
                            "Linkedin" => "bi bi-linkedin",
                            "Mastodon" => "bi bi-mastodon",
                            "Medium" => "bi bi-medium",
                            "Messenger" => "bi bi-messenger",
                            "Paypal" => "bi bi-paypal",
                            "Phone" => "bi bi-telephone-fill",
                            "Pinterest" => "bi bi-pinterest",
                            "Reddit" => "bi bi-reddit",
                            "RSS" => "bi bi-rss",
                            "Signal" => "bi bi-signal",
                            "Skype" => "bi bi-skype",
                            "Slack" => "bi bi-slack",
                            "Snapchat" => "bi bi-snapchat",
                            "Spotify" => "bi bi-spotify",
                            "Stack overflow" => "bi bi-stack-overflow",
                            "Stripe" => "bi bi-stripe",
                            "Telegram" => "bi bi-telegram",
                            "Threads" => "bi bi-threads",
                            "Tiktok" => "bi bi-tiktok",
                            "Twitch" => "bi bi-twitch",
                            "Twitter" => "bi bi-twitter",
                            "Twitter X" => "bi bi-twitter-x",
                            "Vimeo" => "bi bi-vimeo",
                            "Wechat" => "bi bi-wechat",
                            "Whatsapp" => "bi bi-whatsapp",
                            "Wikipedia" => "bi bi-wikipedia",
                            "Wordpress" => "bi bi-wordpress",
                            "Youtube" => "bi bi-youtube",
                        ];
                        break;

                    case 'setting':
                        $industries = IndustryType::where('status', '1')->orderBy('title', 'ASC')->get();
                        break;

                    case 'template':
                        $templates = Template::orderBy('id', 'ASC');
                        $templates = $templates->searching()->paginate(10)->withQueryString();
                        break;
                }

                return view('dashboard.webpage.edit', ['section' => $section, 'links' => $links, 'social' => $social, 'templates' => $templates, 'industries' => $industries, 'dataDetail' => $dataDetail, 'metaData' => $metaData]);
            } else {
                $message = [
                    "message" => [
                        "type" => "error",
                        "title" => __('dashboard.bad'),
                        "description" => __('dashboard.no_record_found')
                    ]
                ];
                return redirect()->route('dashboard.webpage')->with($message);
            }
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard.webpage')->with($message);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'link' => 'required|min:4|max:255|unique:webpages,link',
            'description' => 'sometimes'
        ]);

        if ($validator->fails()) {
            return redirect('dashboard/webpage')->withErrors($validator)->withInput();
        }

        $dataToInsert = $validator->validated();
        $data = [
            'template_id' => 1,
            'title' => $dataToInsert['title'],
            'link' => $dataToInsert['link'],
            'description' => $dataToInsert['description'],
            'user_id' => Auth::id()
        ];

        $webpage = Webpage::create($data);
        if (!empty($webpage) && isset($webpage->id)) {
            $data = [
                'message_tag' => 'msg.new_webpage_created',
                'user_id' => Auth::id(),
                'extra_id' => $webpage->id
            ];
            Notification::create($data);
        }

        $message = [
            "message" => [
                "type" => "success",
                "title" => __('dashboard.great'),
                "description" => __('dashboard.details_submitted')
            ]
        ];
        return redirect()->route('dashboard.webpage')->with($message);
    }

    public function store_edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'record_type' => 'required|in:basic,social,links,products,template,setting'
        ]);

        if ($validator->fails()) {
            return redirect('dashboard/webpage/edit/' . $id)->withErrors($validator)->withInput();
        }

        $dataDetail = Webpage::where('user_id', Auth::id())->find($id);
        if ($dataDetail && $dataDetail->id > 0) {
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard.webpage')->with($message);
        }

        $dataToInsert = $validator->validated();
        $record_type = $dataToInsert['record_type'];

        switch ($record_type) {
            case 'basic':

                $validator = Validator::make($request->all(), [
                    'title' => 'required|max:255',
                    'description' => 'sometimes'
                ]);

                if ($validator->fails()) {
                    return redirect('dashboard/webpage/edit/' . $id)->withErrors($validator)->withInput();
                }

                $dataToInsert = $validator->validated();
                $dataDetail->title = $dataToInsert['title'];
                $dataDetail->description = $dataToInsert['description'];

                if ($request->croppedImage != null) {
                    $croped_image = $request->croppedImage;
                    list($type, $croped_image) = explode(';', $croped_image);
                    list(, $croped_image)      = explode(',', $croped_image);
                    $croped_image = base64_decode($croped_image);
                    $image_name = time() . rand(10000000, 999999999) . '.png';
                    file_put_contents("./images/webpage/" . $image_name, $croped_image);
                    $dataDetail->profile = $image_name;
                }

                $dataDetail->save();

                $message = [
                    "message" => [
                        "type" => "success",
                        "title" => __('dashboard.great'),
                        "description" => __('dashboard.details_submitted')
                    ]
                ];
                return redirect()->route('dashboard.webpage.edit', ['id' => $id, 'section' => $record_type])->with($message);
                break;

            case 'social':
                $validator = Validator::make($request->all(), [
                    'icon' => 'required|max:255',
                    'link' => 'required|url'
                ]);

                if ($validator->fails()) {
                    return redirect('dashboard/webpage/edit/' . $id)->withErrors($validator)->withInput();
                }

                $dataToInsert = $validator->validated();

                $return = false;
                if (!empty($request->link_sub_id)) {
                    $subRecordId = CommonHelper::decUrlParam($request->link_sub_id);
                    if ($subRecordId && $subRecordId > 0) {
                        $dataDetailLink = WebpageLink::find($subRecordId);
                        if (!$dataDetailLink) {
                            $return = true;
                        }
                    } else {
                        $return = true;
                    }
                } else {
                    $dataDetailLink = new WebpageLink();
                    $dataDetailLink->user_id = Auth::id();
                    $dataDetailLink->webpage_id = $id;
                    $dataDetailLink->type = 'social';
                    $dataDetailLink->title = '';
                    $dataDetailLink->template_id = $dataDetail->template_id;
                }

                if ($return == false) {
                    $dataDetailLink->icon = $dataToInsert['icon'];
                    $dataDetailLink->link = $dataToInsert['link'];

                    $dataDetailLink->save();
                    $message = [
                        "message" => [
                            "type" => "success",
                            "title" => __('dashboard.great'),
                            "description" => __('dashboard.details_submitted')
                        ]
                    ];
                    return redirect()->route('dashboard.webpage.edit', ['id' => $id, 'section' => $record_type])->with($message);
                }
                break;

            case 'links':
                $validator = Validator::make($request->all(), [
                    'title' => 'required|max:255',
                    'link' => 'required|url'
                ]);

                if ($validator->fails()) {
                    return redirect('dashboard/webpage/edit/' . $id)->withErrors($validator)->withInput();
                }

                $dataToInsert = $validator->validated();

                $return = false;
                if (!empty($request->link_sub_id)) {
                    $subRecordId = CommonHelper::decUrlParam($request->link_sub_id);
                    if ($subRecordId && $subRecordId > 0) {
                        $dataDetailLink = WebpageLink::find($subRecordId);
                        if (!$dataDetailLink) {
                            $return = true;
                        }
                    } else {
                        $return = true;
                    }
                } else {
                    $dataDetailLink = new WebpageLink();
                    $dataDetailLink->user_id = Auth::id();
                    $dataDetailLink->webpage_id = $id;
                    $dataDetailLink->type = 'simple';
                    $dataDetailLink->icon = '';
                    $dataDetailLink->template_id = $dataDetail->template_id;
                }

                if ($return == false) {
                    $dataDetailLink->title = $dataToInsert['title'];
                    $dataDetailLink->link = $dataToInsert['link'];

                    if ($request->croppedImage != null) {
                        $croped_image = $request->croppedImage;
                        list($type, $croped_image) = explode(';', $croped_image);
                        list(, $croped_image)      = explode(',', $croped_image);
                        $croped_image = base64_decode($croped_image);
                        $image_name = time() . rand(10000000, 999999999) . '.png';
                        file_put_contents("./images/link/" . $image_name, $croped_image);
                        $dataDetailLink->image = $image_name;
                    }

                    $dataDetailLink->save();
                    $message = [
                        "message" => [
                            "type" => "success",
                            "title" => __('dashboard.great'),
                            "description" => __('dashboard.details_submitted')
                        ]
                    ];
                    return redirect()->route('dashboard.webpage.edit', ['id' => $id, 'section' => $record_type])->with($message);
                }
                break;

            case 'template':
                $validator = Validator::make($request->all(), [
                    'template_id' => 'exists:template,id'
                ]);

                if ($validator->fails()) {
                    return redirect('dashboard/webpage/edit/' . $id)->withErrors($validator)->withInput();
                }

                $dataToInsert = $validator->validated();
                $dataDetail->template_id = $dataToInsert['template_id'];
                $dataDetail->save();

                $message = [
                    "message" => [
                        "type" => "success",
                        "title" => __('dashboard.great'),
                        "description" => __('dashboard.details_submitted')
                    ]
                ];
                return redirect()->route('dashboard.webpage.edit', ['id' => $id, 'section' => $record_type])->with($message);
                break;

            case 'setting':
                $validator = Validator::make($request->all(), [
                    'meta_title' => 'nullable|max:160',
                    'meta_description' => 'nullable|max:160',
                    'industry_type_id' => 'sometimes', //|exists:industry_types,id'
                ]);

                if ($validator->fails()) {
                    return redirect('dashboard/webpage/edit/' . $id)->withErrors($validator)->withInput();
                }

                $dataToInsert = $validator->validated();
                $dataDetail->meta_title = $dataToInsert['meta_title'];
                $dataDetail->meta_description = $dataToInsert['meta_description'];
                $dataDetail->industry_type_id = $dataToInsert['industry_type_id'];
                $dataDetail->save();

                $message = [
                    "message" => [
                        "type" => "success",
                        "title" => __('dashboard.great'),
                        "description" => __('dashboard.details_submitted')
                    ]
                ];
                return redirect()->route('dashboard.webpage.edit', ['id' => $id, 'section' => $record_type])->with($message);
                break;

            default:
                # code...
                break;
        }
        return redirect('dashboard');
    }

    public function delete(Request $request, $id)
    {
        $dataDetail = Webpage::find($id);
        if ($dataDetail) {
            $dataDetail->delete();
            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.record_deleted')
                ]
            ];
            return redirect()->route('dashboard.webpage')->with($message);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard.webpage')->with($message);
        }
    }

    public function restore(Request $request, $id)
    {
        $dataDetail = Webpage::withTrashed()->find($id);
        if ($dataDetail) {
            $dataDetail->deleted_at = Null;
            $dataDetail->save();
            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.record_restored')
                ]
            ];
            return redirect()->route('dashboard.webpage')->with($message);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard.webpage')->with($message);
        }
    }

    public function delete_main(Request $request, $id, $section, $sub_id)
    {
        $sections = ['social', 'links', 'products'];
        if (in_array($section, $sections)) {
            $dataDetail = Webpage::find($id);
            if ($dataDetail) {
                switch ($section) {
                    case 'links':
                        $link = WebpageLink::where('id', $sub_id)->first();
                        if ($link) {
                            $link->delete();
                        }
                        $message = [
                            "message" => [
                                "type" => "success",
                                "title" => __('dashboard.great'),
                                "description" => __('dashboard.record_deleted')
                            ]
                        ];
                        return redirect()->route('dashboard.webpage.edit', ['id' => $id, 'section' => $section])->with($message);

                    case 'social':
                        $link = WebpageLink::where('id', $sub_id)->first();
                        if ($link) {
                            $link->delete();
                        }
                        $message = [
                            "message" => [
                                "type" => "success",
                                "title" => __('dashboard.great'),
                                "description" => __('dashboard.record_deleted')
                            ]
                        ];
                        return redirect()->route('dashboard.webpage.edit', ['id' => $id, 'section' => $section])->with($message);
    
                }
            } else {
                $message = [
                    "message" => [
                        "type" => "error",
                        "title" => __('dashboard.bad'),
                        "description" => __('dashboard.no_record_found')
                    ]
                ];
                return redirect()->route('dashboard.webpage')->with($message);
            }
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard.webpage')->with($message);
        }
    }

    public function refresh(Request $request, $id)
    {
        $wp = Webpage::find($id);
        if ($wp) {
            $dataLink = $wp->links()->get()->toArray();
            $data = $wp->toArray();
            $data['child_links'] = $dataLink;

            //dd($data);

            $response = Http::post('http://127.0.0.1:8001/api/laN4xIRHpDfdcMg76Gu8xo5M5anVn2Am', $data);
            if ($response->successful()) {
                //return "Data sent successfully!" . $response->body();
                $message = [
                    "message" => [
                        "type" => "success",
                        "title" => __('dashboard.great'),
                        "description" => __('dashboard.sync_success')
                    ]
                ];
                return redirect()->route('dashboard.webpage')->with($message);
            } else {
                return "Error sending data: " . $response->body();
                $message = [
                    "message" => [
                        "type" => "error",
                        "title" => __('dashboard.bad'),
                        "description" => __('dashboard.sync_error')
                    ]
                ];
                return redirect()->route('dashboard.webpage')->with($message);
            }
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard.webpage')->with($message);
        }
    }
}
