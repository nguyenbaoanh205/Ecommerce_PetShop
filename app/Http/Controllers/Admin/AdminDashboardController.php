<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Tổng số lượt xem sản phẩm
        $totalProductViews = Product::sum('view');
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $totalSales = Order::where('status', 'completed')
            ->sum('total_amount');

        // Số liệu năm trước
        $lastYearProductViews = Product::whereYear('created_at', now()->subYear()->year)->sum('view');
        $lastYearUsers = User::whereYear('created_at', now()->subYear()->year)->count();
        $lastYearOrders = Order::whereYear('created_at', now()->subYear()->year)->count();
        $lastYearSales = Order::where('status', 'completed')
            ->whereYear('created_at', now()->subYear()->year)
            ->sum('total_amount');

        // Tính % tăng/giảm so với năm trước
        $productViewsChange = $lastYearProductViews > 0 ? min(100, (($totalProductViews - $lastYearProductViews) / $lastYearProductViews) * 100) : 100;
        $usersChange = $lastYearUsers > 0 ? min(100, (($totalUsers - $lastYearUsers) / $lastYearUsers) * 100) : 100;
        $ordersChange = $lastYearOrders > 0 ? min(100, (($totalOrders - $lastYearOrders) / $lastYearOrders) * 100) : 100;
        $salesChange = $lastYearSales > 0 ? min(100, (($totalSales - $lastYearSales) / $lastYearSales) * 100) : 100;

        // Đơn hàng gần đây 
        $recentOrders = Order::with('orderItems')->orderBy('created_at', 'desc')->take(10)->get();

        return view('admin.dashboard', compact(
            'totalProductViews',
            'lastYearProductViews',
            'productViewsChange',
            'totalUsers',
            'lastYearUsers',
            'usersChange',
            'totalOrders',
            'lastYearOrders',
            'ordersChange',
            'totalSales',
            'lastYearSales',
            'salesChange',
            'recentOrders'
        ));
    }
}
