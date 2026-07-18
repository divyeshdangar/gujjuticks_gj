<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Support\SitePages;
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

    public const STACK_PRODUCTS = [
        'Custom app' => 'Product with accounts, workflows, and ongoing use',
        'Website' => 'Marketing, brochure, or content-led site',
        'Custom software' => 'Internal ops, portals, or multi-system tools',
        'MVP' => 'First version to validate with real users',
        'Not sure' => 'Still shaping the product — we will suggest a safe default',
    ];

    public const STACK_SURFACES = [
        'marketing' => [
            'label' => 'Marketing / brochure site',
            'hint' => 'Pages, SEO, and content edits matter most',
        ],
        'web' => [
            'label' => 'Web product / portal',
            'hint' => 'Logged-in workflows in the browser',
        ],
        'spa' => [
            'label' => 'App-like SPA dashboard',
            'hint' => 'Rich client UI with heavier interactivity',
        ],
        'mobile' => [
            'label' => 'Mobile-first (PWA)',
            'hint' => 'Phone-first without requiring app stores yet',
        ],
        'native' => [
            'label' => 'Native store apps',
            'hint' => 'iOS/Android presence, push, or device APIs',
        ],
    ];

    public const STACK_CAPABILITIES = [
        'auth' => 'User accounts / login',
        'payments' => 'Payments',
        'admin' => 'Admin dashboard',
        'integrations' => 'Third-party integrations',
        'cms' => 'Content / CMS',
        'ai' => 'AI features',
        'mobile' => 'Mobile experience',
        'notifications' => 'Notifications',
        'analytics' => 'Reporting / analytics',
        'multiuser' => 'Roles & multi-user teams',
    ];

    public const STACK_PRIORITIES = [
        'fast' => [
            'label' => 'Ship a first version fast',
            'hint' => 'Lean defaults, fewer moving parts',
        ],
        'scale' => [
            'label' => 'Build for scale & reliability',
            'hint' => 'Testing, hosting, and data discipline',
        ],
        'growth' => [
            'label' => 'SEO & growth after launch',
            'hint' => 'Performance, content, and discoverability',
        ],
        'maintain' => [
            'label' => 'Easy to maintain long term',
            'hint' => 'Boring, coherent stack your team can own',
        ],
    ];

    public const STACK_PRINCIPLES = [
        [
            'title' => 'Ship the job, not the fashion',
            'text' => 'Bias toward proven layers that get users online — then add complexity only when the product proves it needs it.',
        ],
        [
            'title' => 'One coherent spine',
            'text' => 'Most products need a clear backend, a clear UI, and clean integrations — not five frameworks fighting each other.',
        ],
        [
            'title' => 'Room to grow after v1',
            'text' => 'Leave a path to admin, mobile, AI, or native later without forcing a rewrite on day one.',
        ],
    ];

    /**
     * Catalog + copy for the tech stack recommender (client-side quiz).
     */
    public function stackConfig(): array
    {
        $hubItems = SitePages::get('technology.hub.items', []);
        $catalog = [];

        foreach (is_array($hubItems) ? $hubItems : [] as $item) {
            $slug = $item['slug'] ?? null;
            if (! is_string($slug) || $slug === '') {
                continue;
            }

            $detail = SitePages::page('technology', $slug) ?? [];
            $fitPoints = [];
            if (is_array($detail['when_fit']['points'] ?? null)) {
                $fitPoints = array_values(array_slice($detail['when_fit']['points'], 0, 3));
            }

            $tools = [];
            if (is_array($detail['tools'] ?? null)) {
                $tools = array_values(array_slice($detail['tools'], 0, 6));
            }

            $catalog[$slug] = [
                'title' => $detail['label'] ?? ($item['title'] ?? $slug),
                'tag' => $detail['category'] ?? ($item['tag'] ?? ''),
                'summary' => $item['summary'] ?? ($detail['lead'] ?? ''),
                'lead' => $detail['lead'] ?? ($item['summary'] ?? ''),
                'best_for' => $detail['best_for'] ?? '',
                'maturity' => $detail['maturity'] ?? '',
                'delivery' => $detail['delivery'] ?? '',
                'tools' => $tools,
                'fit_points' => $fitPoints,
                'url' => route('pages.technology.show', ['slug' => $slug]),
            ];
        }

        return [
            'catalog' => $catalog,
            'hubUrl' => route('pages.technology'),
            'whys' => [
                'laravel' => 'Solid backend for apps, APIs, and admin workflows you can maintain long term.',
                'web-apps' => 'Clear, fast interfaces for products, portals, and day-to-day tools.',
                'apis-integrations' => 'Connect payments, CRMs, and ops systems without fragile handoffs.',
                'mobile-apps' => 'Mobile-ready experience without jumping straight to native store apps.',
                'hosting-devops' => 'Deploy, SSL, uptime basics, and a path to ongoing maintenance.',
                'databases' => 'Reliable data models and schemas that stay easy to report on.',
                'authentication-security' => 'Login, roles, and practical hardening for real user accounts.',
                'admin-panels' => 'Internal consoles your team needs to run the product day to day.',
                'quality-testing' => 'Critical-path checks and staging confidence before go-live.',
                'mvp-stack' => 'A lean path to ship a first version without overbuilding the stack.',
                'cms-content' => 'Editable pages and content workflows for marketing and publishing.',
                'payments' => 'Checkout and billing flows wired into the product, not bolted on later.',
                'performance-seo' => 'Speed, crawlability, and launch hygiene that support growth.',
                'react' => 'Interactive SPA surfaces when the product needs richer client state.',
                'wordpress' => 'Fast marketing sites when content editing matters more than custom product logic.',
                'ai-features' => 'Practical AI assist features where they improve the product, not as decoration.',
                'native-mobile' => 'Store apps when push, device APIs, or app-store presence are required.',
            ],
            'nextSteps' => [
                'fast' => [
                    'Lock three core user flows before expanding the stack',
                    'Prefer one backend spine and a clear web UI for v1',
                    'Defer native apps and heavy SPA until demand is proven',
                ],
                'scale' => [
                    'Plan staging, backups, and critical-path tests early',
                    'Keep data models and permissions explicit from the start',
                    'Add hosting/ops discipline before feature sprawl',
                ],
                'growth' => [
                    'Treat performance and crawlability as launch requirements',
                    'Keep content editable where marketing needs to move fast',
                    'Measure the funnel before adding experimental layers',
                ],
                'maintain' => [
                    'Choose boring defaults your next engineer can read',
                    'Limit frameworks to what the product actually uses',
                    'Document integrations and ownership as you build',
                ],
            ],
        ];
    }

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

    public function stack(): View
    {
        return view('pages.tools.stack', [
            'metaData' => $this->meta(
                'Tech Stack Recommender',
                'Answer a short quiz to get a recommended technology stack for your custom app, website, or software — with why each layer fits and links to Technology pages.',
                route('pages.tools.stack')
            ),
            'productTypes' => self::STACK_PRODUCTS,
            'surfaces' => self::STACK_SURFACES,
            'capabilities' => self::STACK_CAPABILITIES,
            'priorities' => self::STACK_PRIORITIES,
            'principles' => self::STACK_PRINCIPLES,
            'stackConfig' => $this->stackConfig(),
        ]);
    }

    public function storeStack(Request $request): RedirectResponse
    {
        $capabilityKeys = array_keys(self::STACK_CAPABILITIES);
        $surfaceKeys = array_keys(self::STACK_SURFACES);
        $priorityKeys = array_keys(self::STACK_PRIORITIES);
        $productKeys = array_keys(self::STACK_PRODUCTS);
        $techSlugs = array_keys($this->stackConfig()['catalog']);

        $validator = Validator::make($request->all(), [
            'product_type' => 'required|in:' . implode(',', $productKeys),
            'surface' => 'required|in:' . implode(',', $surfaceKeys),
            'capabilities' => 'nullable|array',
            'capabilities.*' => 'in:' . implode(',', $capabilityKeys),
            'priority' => 'required|in:' . implode(',', $priorityKeys),
            'primary_slug' => 'required|in:' . implode(',', $techSlugs),
            'layer_slugs' => 'nullable|array',
            'layer_slugs.*' => 'in:' . implode(',', $techSlugs),
            'name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'phone' => 'required|digits:10',
            'notes' => 'nullable|max:5000',
        ]);

        if ($validator->fails()) {
            return redirect()->route('pages.tools.stack')->withErrors($validator)->withInput();
        }

        $data = $validator->validated();
        $catalog = $this->stackConfig()['catalog'];

        $capLabels = [];
        foreach ($data['capabilities'] ?? [] as $key) {
            if (isset(self::STACK_CAPABILITIES[$key])) {
                $capLabels[] = self::STACK_CAPABILITIES[$key];
            }
        }

        $layerTitles = [];
        foreach ($data['layer_slugs'] ?? [] as $slug) {
            if (isset($catalog[$slug])) {
                $layerTitles[] = $catalog[$slug]['title'];
            }
        }

        $primaryTitle = $catalog[$data['primary_slug']]['title'] ?? $data['primary_slug'];
        $surfaceLabel = self::STACK_SURFACES[$data['surface']]['label'] ?? $data['surface'];
        $priorityLabel = self::STACK_PRIORITIES[$data['priority']]['label'] ?? $data['priority'];

        $parts = array_filter([
            'Source: Tech Stack Recommender',
            'Product type: ' . $data['product_type'],
            'Surface: ' . $surfaceLabel,
            $capLabels !== [] ? 'Capabilities: ' . implode(', ', $capLabels) : null,
            'Priority: ' . $priorityLabel,
            'Recommended primary: ' . $primaryTitle . ' (' . $data['primary_slug'] . ')',
            $layerTitles !== [] ? 'Supporting layers: ' . implode(', ', $layerTitles) : null,
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
            'keywords' => 'project brief, software estimate, tech stack, MVP cost, custom app timeline, GujjuTicks',
            'url' => $url,
            'image' => asset('brand/pages/gujjuticks-homepage.png'),
            'robots' => 'noindex, follow',
        ];
    }
}
