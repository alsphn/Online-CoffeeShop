<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function dashboard()
    {
        $recentOrders = Order::where('user_id', Auth::id())
            ->latest()
            ->take(5)
            ->get();

        return view('member.dashboard', compact('recentOrders'));
    }
}
