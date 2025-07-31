<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class ResumeController extends Controller
{
    public $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    public function index(Request $request): View
    {
        $metaData = [
            "title" => "Free Online Resume Builder | Create a Professional Resume in Minutes | GujjuTicks Resume Builder",
            "description" => "Build a job-winning resume online with our free, easy-to-use resume builder. Choose a template, fill in your details, and download a professional PDF resume - no sign-up required.",
            //"image" => "",
            "keywords" => "online resume builder, free resume maker, create resume, resume templates, resume generator, download resume pdf, resume builder india, build cv online, professional resume",
            "url" => route('pages.resume.list')
        ];
        return view('pages.resume.list', ['metaData' => $metaData]);
    }

    public function post(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|max:128',
            'lastname' => 'required|max:128',
            'email' => 'required|max:128|email',
        ]);

        if ($validator->fails()) {
            return redirect()->route('pages.resume.list')->withErrors($validator)->withInput();
        }

        $dataToInsert = $validator->validated();

        $resume = new Resume();
        $resume->firstname = $dataToInsert['firstname'];
        $resume->lastname = $dataToInsert['lastname'];
        $resume->email = $dataToInsert['email'];

        $resume->language = 'English';
        $resume->image = 'default.png';

        $resume->save();

        if ($resume) {

            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.details_submitted')
                ]
            ];
            return redirect()->route('pages.resume.builder', ['token' => $resume->token])->with($message);
        } else {
            echo '<h1>Error:</h1>';
        }
    }

    public function builder(Request $request, $token)
    {
        $dataDetail = Resume::where("token", $token)->first();
        if ($dataDetail) {
            $metaData = [
                "title" => "Resume Builder",
                "description" => "Build a job-winning resume online with our free, easy-to-use resume builder. Choose a template, fill in your details, and download a professional PDF resume - no sign-up required.",
                //"image" => "",
                "keywords" => "online resume builder, free resume maker, create resume, resume templates, resume generator, download resume pdf, resume builder india, build cv online, professional resume",
                "url" => route('pages.resume.list'),
                "nofollow" => true
            ];
            return view('pages.resume.builder', ['metaData' => $metaData, 'dataDetail' => $dataDetail, 'months' => $this->months]);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('pages.resume.list')->with($message);
        }
    }

    public function process(Request $request, $token)
    {
        $validator = Validator::make($request->all(), [
            'record_type' => 'required|in:basic,skills,educations,experiences'
        ]);

        if ($validator->fails()) {
            return redirect()->route('pages.resume.list');
        }

        $dataDetail = Resume::where("token", $token)->first();
        if ($dataDetail) {
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('pages.resume.list')->with($message);
        }

        $dataToInsert = $validator->validated();
        $record_type = $dataToInsert['record_type'];

        switch ($record_type) {
            case 'basic':

                $validator = Validator::make($request->all(), [
                    'firstname' => 'required|max:128',
                    'lastname' => 'required|max:128',
                    'email' => 'required|max:128|email',
                    'mobile' => 'sometimes|max:128',
                    'website' => 'sometimes|max:128',
                    'designation' => 'sometimes|max:255',
                    'links' => 'sometimes|max:255',
                    'language' => 'sometimes|max:128',
                    'address' => 'sometimes|max:512',
                    'about' => 'sometimes|max:2048'
                ]);

                if ($validator->fails()) {
                    return redirect('resume-builder/' . $token)->withErrors($validator)->withInput();
                }

                $dataToInsert = $validator->validated();
                $dataDetail->firstname = $dataToInsert['firstname'];
                $dataDetail->lastname = $dataToInsert['lastname'];
                $dataDetail->email = $dataToInsert['email'];
                $dataDetail->mobile = $dataToInsert['mobile'];
                $dataDetail->website = $dataToInsert['website'];
                $dataDetail->designation = $dataToInsert['designation'];
                $dataDetail->links = $dataToInsert['links'];
                $dataDetail->language = $dataToInsert['language'];
                $dataDetail->about = $dataToInsert['about'];
                $dataDetail->address = $dataToInsert['address'];

                if ($request->croppedImage != null) {
                    $croped_image = $request->croppedImage;
                    list($type, $croped_image) = explode(';', $croped_image);
                    list(, $croped_image)      = explode(',', $croped_image);
                    $croped_image = base64_decode($croped_image);
                    $image_name = time() . rand(10000000, 999999999) . '.png';
                    file_put_contents("./images/resume/" . $image_name, $croped_image);
                    $dataDetail->image = $image_name;
                }

                $dataDetail->save();

                $message = [
                    "message" => [
                        "type" => "success",
                        "title" => __('dashboard.great'),
                        "description" => __('dashboard.details_submitted')
                    ],
                    "tab" => $record_type
                ];
                return redirect('resume-builder/' . $token)->with($message);
                break;

            case 'skills':

                $validator = Validator::make($request->all(), [
                    'skills' => 'required|array|min:1',
                    'skills.*.skill' => 'required|string|max:128',
                ]);

                if ($validator->fails()) {
                    return redirect('resume-builder/' . $token)->withErrors($validator)->withInput();
                }

                // Save each skill
                $dataDetail->skills()->delete(); // if replacing all
                foreach ($request->skills as $skillData) {
                    $dataDetail->skills()->create([
                        'name' => $skillData['skill'],
                    ]);
                }

                $message = [
                    "message" => [
                        "type" => "success",
                        "title" => __('dashboard.great'),
                        "description" => __('dashboard.details_submitted')
                    ],
                    "tab" => $record_type
                ];
                return redirect('resume-builder/' . $token)->with($message);
                break;

            case 'educations':

                $validator = Validator::make($request->all(), [
                    'educations' => 'nullable|array',
                    'educations.*.title' => 'required|string|max:255',
                    'educations.*.place' => 'required|string|max:255',
                    'educations.*.start_month' => 'nullable|string|max:20',
                    'educations.*.start_year' => 'nullable|string|min:4|max:4',
                    'educations.*.end_month' => 'nullable|string|max:20',
                    'educations.*.end_year' => 'nullable|string|min:4|max:4',
                    'educations.*.description' => 'nullable|string|max:1024',
                ]);

                if ($validator->fails()) {
                    return redirect('resume-builder/' . $token)->withErrors($validator)->withInput();
                }

                // Optional: clear old educations before saving new
                $dataDetail->educations()->delete();

                // Save each entry
                foreach ($request->educations as $edu) {
                    $dataDetail->educations()->create([
                        'title' => $edu['title'],
                        'place' => $edu['place'],
                        'start_month' => $edu['start_month'] ?? null,
                        'start_year' => $edu['start_year'] ?? null,
                        'end_month' => $edu['end_month'] ?? null,
                        'end_year' => $edu['end_year'] ?? null,
                        'description' => $edu['description'] ?? null,
                    ]);
                }

                $message = [
                    "message" => [
                        "type" => "success",
                        "title" => __('dashboard.great'),
                        "description" => __('dashboard.details_submitted')
                    ],
                    "tab" => $record_type
                ];
                return redirect('resume-builder/' . $token)->with($message);
                break;

            case 'experiences':

                $validator = Validator::make($request->all(), [
                    'experiences' => 'nullable|array',
                    'experiences.*.title' => 'required|string|max:255',
                    'experiences.*.place' => 'required|string|max:255',
                    'experiences.*.city' => 'nullable|string|max:128',
                    'experiences.*.start_month' => 'nullable|string|max:20',
                    'experiences.*.start_year' => 'nullable|string|min:4|max:4',
                    'experiences.*.end_month' => 'nullable|string|max:20',
                    'experiences.*.end_year' => 'nullable|string|min:4|max:4',
                    'experiences.*.description' => 'nullable|string|max:1024',
                ]);

                if ($validator->fails()) {
                    return redirect('resume-builder/' . $token)->withErrors($validator)->withInput();
                }

                // Optional: clear old experiences before saving new
                $dataDetail->experiences()->delete();

                // Save each entry
                foreach ($request->experiences as $edu) {
                    $dataDetail->experiences()->create([
                        'title' => $edu['title'],
                        'place' => $edu['place'],
                        'city' => $edu['city'],
                        'start_month' => $edu['start_month'] ?? null,
                        'start_year' => $edu['start_year'] ?? null,
                        'end_month' => $edu['end_month'] ?? null,
                        'end_year' => $edu['end_year'] ?? null,
                        'experience' => $edu['experience'] ?? null,
                    ]);
                }

                $message = [
                    "message" => [
                        "type" => "success",
                        "title" => __('dashboard.great'),
                        "description" => __('dashboard.details_submitted')
                    ],
                    "tab" => $record_type
                ];
                return redirect('resume-builder/' . $token)->with($message);
                break;
        }

        return redirect()->route('pages.resume.list');
    }
}
