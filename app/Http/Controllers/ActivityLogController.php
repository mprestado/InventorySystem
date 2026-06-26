<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $logs = ActivityLog::with('user')
            ->when($request->action, fn ($q, $a) => $q->where('action', $a))
            ->when($request->user_id, fn ($q, $u) => $q->where('user_id', $u))
            ->when($request->search, fn ($q, $s) => $q->where('description', 'like', "%$s%"))
            ->latest('created_at')->paginate(25)->withQueryString();

        $actions = ActivityLog::select('action')->distinct()->pluck('action');
        $users = User::orderBy('name')->get();

        return view('activity-logs.index', compact('logs', 'actions', 'users'));
    }
}
