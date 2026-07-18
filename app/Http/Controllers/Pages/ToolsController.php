<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ToolsController extends Controller
{
    public const PRODUCT_TYPES = [
        'Custom app',
        'Website',
        'Custom software',
        'MVP',
        'Not sure',
    ];

    public const FEATURES = [
        'User accounts / login',
        'Payments',
        'Admin dashboard',
        'Third-party integrations',
        'Mobile app',
        'Content / CMS',
        'Notifications',
        'Reporting / analytics',
    ];

    public const TIMELINES = [
        'ASAP',
        '1–2 months',
        '3–6 months',
        'Exploring',
    ];

    public const BUDGETS = [
        'Under ₹1L',
        '₹1L–₹3L',
        '₹3L–₹8L',
        '₹8L+',
        'Not sure',
    ];

    /**
     * Indicative estimate config (weeks + INR lakhs). Not a quote.
     */
    public function estimateConfig(): array
    {
        return [
            'bases' => [
                'Custom app' => ['weeks' => [8, 16], 'lakhs' => [3, 8]],
                'Website' => ['weeks' => [3, 8], 'lakhs' => [0.75, 3]],
                'Custom software' => ['weeks' => [10, 20], 'lakhs' => [4, 12]],
                'MVP' => ['weeks' => [6, 12], 'lakhs' => [2, 6]],
                'Not sure' => ['weeks' => [6, 14], 'lakhs' => [2, 7]],
            ],
            'addOns' => [
                'auth' => ['label' => 'User accounts / login', 'weeks' => [1, 2], 'lakhs' => [0.4, 1]],
                'payments' => ['label' => 'Payments', 'weeks' => [1, 3], 'lakhs' => [0.5, 1.5]],
                'admin' => ['label' => 'Admin dashboard', 'weeks' => [2, 4], 'lakhs' => [0.8, 2]],
                'integrations' => ['label' => 'Third-party integrations', 'weeks' => [2, 5], 'lakhs' => [1, 3]],
                'mobile' => ['label' => 'Mobile app', 'weeks' => [4, 8], 'lakhs' => [2, 5]],
                'cms' => ['label' => 'Content / CMS', 'weeks' => [1, 2], 'lakhs' => [0.3, 1]],
                'notifications' => ['label' => 'Notifications', 'weeks' => [1, 2], 'lakhs' => [0.3, 0.8]],
                'analytics' => ['label' => 'Reporting / analytics', 'weeks' => [1, 3], 'lakhs' => [0.5, 1.5]],
            ],
            'complexity' => [
                'simple' => ['label' => 'Simple', 'weeksMul' => 0.85, 'lakhsMul' => 0.85],
                'standard' => ['label' => 'Standard', 'weeksMul' => 1, 'lakhsMul' => 1],
                'complex' => ['label' => 'Complex', 'weeksMul' => 1.35, 'lakhsMul' => 1.4],
            ],
        ];
    }

    public function brief(Request $request): View
    {
        $prefillType = $request->query('type');
        if (! in_array($prefillType, self::PRODUCT_TYPES, true)) {
            $prefillType = null;
        }

        return view('pages.tools.brief', [
            'metaData' => $this->meta(
                'Project Brief Builder | GujjuTicks',
                'Build a clear project brief for your custom app, website, or software — then send it to GujjuTicks.',
                route('pages.tools.brief')
            ),
            'productTypes' => self::PRODUCT_TYPES,
            'features' => self::FEATURES,
            'timelines' => self::TIMELINES,
            'budgets' => self::BUDGETS,
            'prefillType' => $prefillType,
        ]);
    }

    public function storeBrief(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'product_type' => 'required|in:' . implode(',', self::PRODUCT_TYPES),
            'goal' => 'required|max:255',
            'features' => 'nullable|array',
            'features.*' => 'string|max:100',
            'timeline' => 'nullable|in:' . implode(',', self::TIMELINES),
            'budget' => 'nullable|in:' . implode(',', self::BUDGETS),
            'name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'phone' => 'required|digits:10',
            'links' => 'nullable|max:500',
            'notes' => 'nullable|max:5000',
        ]);

        if ($validator->fails()) {
            return redirect()->route('pages.tools.brief')->withErrors($validator)->withInput();
        }

        $data = $validator->validated();
        $features = array_values(array_intersect($data['features'] ?? [], self::FEATURES));

        $parts = array_filter([
            'Source: Project Brief Builder',
            'Product type: ' . $data['product_type'],
            'Goal: ' . $data['goal'],
            $features !== [] ? 'Features: ' . implode(', ', $features) : null,
            ! empty($data['timeline']) ? 'Timeline: ' . $data['timeline'] : null,
            ! empty($data['budget']) ? 'Budget: ' . $data['budget'] : null,
            ! empty($data['links']) ? 'Links: ' . $data['links'] : null,
        ]);

        $body = implode("\n", $parts);
        if (! empty($data['notes'])) {
            $body .= "\n\n" . $data['notes'];
        }

        $this->saveContact($data['name'], $data['email'], $data['phone'], $body);

        return redirect()->route('home')->with($this->successFlash());
    }

    public function estimate(Request $request): View
    {
        $prefillType = $request->query('type');
        if (! in_array($prefillType, self::PRODUCT_TYPES, true)) {
            $prefillType = 'MVP';
        }

        return view('pages.tools.estimate', [
            'metaData' => $this->meta(
                'Project Estimate Calculator | GujjuTicks',
                'Get an indicative timeline and budget range for a custom app, website, or software project. Not a formal quote.',
                route('pages.tools.estimate')
            ),
            'productTypes' => self::PRODUCT_TYPES,
            'timelines' => self::TIMELINES,
            'budgets' => self::BUDGETS,
            'estimateConfig' => $this->estimateConfig(),
            'prefillType' => $prefillType,
        ]);
    }

    public function storeEstimate(Request $request): RedirectResponse
    {
        $addonKeys = array_keys($this->estimateConfig()['addOns']);

        $validator = Validator::make($request->all(), [
            'product_type' => 'required|in:' . implode(',', self::PRODUCT_TYPES),
            'complexity' => 'required|in:simple,standard,complex',
            'addons' => 'nullable|array',
            'addons.*' => 'in:' . implode(',', $addonKeys),
            'weeks_low' => 'required|numeric|min:1|max:104',
            'weeks_high' => 'required|numeric|min:1|max:104',
            'lakhs_low' => 'required|numeric|min:0|max:100',
            'lakhs_high' => 'required|numeric|min:0|max:100',
            'name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'phone' => 'required|digits:10',
            'notes' => 'nullable|max:5000',
        ]);

        if ($validator->fails()) {
            return redirect()->route('pages.tools.estimate')->withErrors($validator)->withInput();
        }

        $data = $validator->validated();
        $config = $this->estimateConfig();
        $addonLabels = [];
        foreach ($data['addons'] ?? [] as $key) {
            if (isset($config['addOns'][$key])) {
                $addonLabels[] = $config['addOns'][$key]['label'];
            }
        }

        $complexityLabel = $config['complexity'][$data['complexity']]['label'] ?? $data['complexity'];

        $parts = array_filter([
            'Source: Project Estimate Calculator',
            'Product type: ' . $data['product_type'],
            'Complexity: ' . $complexityLabel,
            $addonLabels !== [] ? 'Add-ons: ' . implode(', ', $addonLabels) : null,
            sprintf(
                'Indicative range: %s–%s weeks · ₹%sL–₹%sL (not a quote)',
                $this->formatNum($data['weeks_low']),
                $this->formatNum($data['weeks_high']),
                $this->formatNum($data['lakhs_low']),
                $this->formatNum($data['lakhs_high'])
            ),
        ]);

        $body = implode("\n", $parts);
        if (! empty($data['notes'])) {
            $body .= "\n\n" . $data['notes'];
        }

        $this->saveContact($data['name'], $data['email'], $data['phone'], $body);

        return redirect()->route('home')->with($this->successFlash());
    }

    private function formatNum($value): string
    {
        $n = (float) $value;
        if (abs($n - round($n)) < 0.05) {
            return (string) (int) round($n);
        }

        return rtrim(rtrim(number_format($n, 1, '.', ''), '0'), '.');
    }

    private function saveContact(string $name, string $email, string $phone, string $message): void
    {
        $row = new ContactUs;
        $row->user_id = Auth::id();
        $row->name = $name;
        $row->email = $email;
        $row->phone = $phone;
        $row->message = $message;
        $row->save();
    }

    private function successFlash(): array
    {
        return [
            'message' => [
                'type' => 'success',
                'title' => __('dashboard.great'),
                'description' => __('dashboard.details_submitted'),
            ],
        ];
    }

    private function meta(string $title, string $description, string $url): array
    {
        return [
            'title' => $title,
            'description' => $description,
            'keywords' => 'project brief, software estimate, MVP cost, custom app timeline, GujjuTicks',
            'url' => $url,
            'image' => asset('brand/pages/gujjuticks-homepage.png'),
            'robots' => 'noindex, follow',
        ];
    }
}
