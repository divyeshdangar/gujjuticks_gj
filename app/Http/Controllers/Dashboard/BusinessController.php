<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'pending');

        $query = Business::query()
            ->with(['city', 'placeCategory'])
            ->where('place_id', 'like', 'manual-%')
            ->orderByDesc('id');

        if (in_array($status, ['pending', 'success', 'failed'], true)) {
            $query->where('status', $status);
        }

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('phone', 'LIKE', '%' . $search . '%')
                    ->orWhere('address', 'LIKE', '%' . $search . '%');
            });
        }

        $dataList = $query->paginate(15)->withQueryString();

        $metaData = [
            'breadCrumb' => [
                ['title' => 'Business submissions', 'route' => ''],
            ],
            'title' => 'Business submissions',
        ];

        $counts = [
            'pending' => Business::awaitingReview()->count(),
            'success' => Business::where('place_id', 'like', 'manual-%')->where('status', 'success')->count(),
            'failed' => Business::where('place_id', 'like', 'manual-%')->where('status', 'failed')->count(),
        ];

        return view('dashboard.business.index', [
            'dataList' => $dataList,
            'metaData' => $metaData,
            'status' => $status,
            'counts' => $counts,
        ]);
    }

    public function view(Request $request, $id)
    {
        $dataDetail = Business::with(['city', 'placeCategory'])
            ->where('place_id', 'like', 'manual-%')
            ->find($id);

        if (!$dataDetail) {
            return redirect()->route('dashboard.business')->with([
                'message' => [
                    'type' => 'error',
                    'title' => __('dashboard.bad'),
                    'description' => __('dashboard.no_record_found'),
                ],
            ]);
        }

        $metaData = [
            'breadCrumb' => [
                ['title' => 'Business submissions', 'route' => 'dashboard.business'],
                ['title' => 'Detail', 'route' => ''],
            ],
            'title' => 'Review business',
        ];

        return view('dashboard.business.view', [
            'dataDetail' => $dataDetail,
            'metaData' => $metaData,
        ]);
    }

    public function approve(Request $request, $id): RedirectResponse
    {
        $business = Business::where('place_id', 'like', 'manual-%')->find($id);
        if (!$business) {
            return redirect()->route('dashboard.business')->with([
                'message' => [
                    'type' => 'error',
                    'title' => __('dashboard.bad'),
                    'description' => __('dashboard.no_record_found'),
                ],
            ]);
        }

        $business->status = 'success';
        $business->save();

        return redirect()->route('dashboard.business.view', $business->id)->with([
            'message' => [
                'type' => 'success',
                'title' => __('dashboard.great'),
                'description' => 'Business approved and published to the city directory.',
            ],
        ]);
    }

    public function reject(Request $request, $id): RedirectResponse
    {
        $business = Business::where('place_id', 'like', 'manual-%')->find($id);
        if (!$business) {
            return redirect()->route('dashboard.business')->with([
                'message' => [
                    'type' => 'error',
                    'title' => __('dashboard.bad'),
                    'description' => __('dashboard.no_record_found'),
                ],
            ]);
        }

        $business->status = 'failed';
        $business->save();

        return redirect()->route('dashboard.business.view', $business->id)->with([
            'message' => [
                'type' => 'success',
                'title' => __('dashboard.great'),
                'description' => 'Business rejected and kept off public listings.',
            ],
        ]);
    }
}
