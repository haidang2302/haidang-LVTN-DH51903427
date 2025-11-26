<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierNotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $notifications = $user ? $user->notifications : collect();
        $template = 'backend.supplier.notifications';
        return view('backend.dashboard.layout', compact('template', 'notifications'));
    }
}
