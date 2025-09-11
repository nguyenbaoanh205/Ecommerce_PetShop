<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;

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

        // Tạo mảng chứa tổng thu nhập từng ngày trong tuần
        $weeklyIncome = [];

        $startOfWeek = Carbon::now()->startOfWeek();
        for ($i = 0; $i < 7; $i++) {
            $date = $startOfWeek->copy()->addDays($i);
            $dailyIncome = Order::whereDate('created_at', $date)
                ->where('status', 'completed')
                ->sum('total_amount');

            $weeklyIncome[] = round($dailyIncome,2);
        }

        // Tổng thu nhập của cả tuần
        $weeklyTotalIncome = array_sum($weeklyIncome);

        // Tạo mảng chứa tổng thu nhập từng ngày trong tháng
        $monthlyIncome = [];
        $currentYear = Carbon::now()->year;

        for ($month = 1; $month <= 12; $month++) {
            $startOfMonth = Carbon::create($currentYear, $month, 1)->startOfMonth();
            $endOfMonth = $startOfMonth->copy()->endOfMonth();

            $income = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->where('status', 'completed')
                ->sum('total_amount');

            $monthlyIncome[] = round($income,2);
        }

        // Tổng thu nhập cả tháng
        $monthlyTotalIncome = array_sum($monthlyIncome);

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
            'recentOrders',
            'weeklyIncome',
            'weeklyTotalIncome',
            'monthlyIncome',
            'monthlyTotalIncome'
        ));
    }
}
