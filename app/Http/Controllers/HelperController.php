<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Request as AdRequest;

class HelperController extends Controller
{
    /**
     * Loads requests for helpers.
     *
     * @param  Request $request
     * @return Response
     */
    public function requests(Request $request)
    {
        $query = AdRequest::orderBy('approval_id', 'asc')->orderBy('updated_at', 'asc');
        $status = $request->input('status', null);
        $options = [];
        $config = config('requests.approval');

        foreach ($config as $id => $approval) {
            $options[$id] = $approval['name'];
        }

        $appId = intval($status);
        if ($status !== null && $config[$appId]) {
            $query = $query->where('approval_id', $appId);
        }

        $data = [
            'requests' => $query->get(),
            'page' => 'Helper &mdash; Requests',
            'approval' => $options,
            'status' => $status,
            'route' => 'helper.requests'
        ];

        return view('admin.requests', $data);
    }
}
