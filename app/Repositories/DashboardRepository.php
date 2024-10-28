<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Rating;
use App\Models\Product;
use App\Models\Category;
use App\Models\Currency;
use App\Models\BrandType;
use App\Models\FlashDeal;
use App\Models\OrderDetail;
use App\Models\ProductStock;
use App\Models\StockPurchase;
use App\Models\ProductQuestion;
use App\Repositories\Interface\DashboardRepositoryInterface;


class DashboardRepository implements DashboardRepositoryInterface
{
    public function index($request)
    {
        $orderStats = Order::selectRaw('
            COUNT(*) as total_orders,
            SUM(CASE WHEN status = "delivered" THEN final_amount ELSE 0 END) as total_order_amount,
            SUM(CASE WHEN payment_status = "Paid" THEN final_amount ELSE 0 END) as total_paid_order_amount,
            SUM(CASE WHEN payment_status = "Not_Paid" THEN final_amount ELSE 0 END) as total_unpaid_order_amount,
            SUM(CASE WHEN status = "delivered" AND payment_status = "Paid" AND is_cod = true THEN final_amount ELSE 0 END) as total_cash_on_delivery,
            COUNT(CASE WHEN status = "pending" THEN 1 END) as total_pending_orders,
            COUNT(CASE WHEN status = "packaging" THEN 1 END) as total_packaging_orders,
            COUNT(CASE WHEN status = "delivered" THEN 1 END) as total_delivered_orders,
            COUNT(CASE WHEN status = "returned" THEN 1 END) as total_returned_orders,
            COUNT(CASE WHEN status = "failed" THEN 1 END) as total_failed_orders
        ')
            ->first();

        $productStats = Product::selectRaw('
            COUNT(*) as total_products,
            COUNT(CASE WHEN status = true THEN 1 END) as total_active_products
        ')
            ->first();

        $brandStats = Brand::selectRaw('
            COUNT(*) as total_brands,
            COUNT(CASE WHEN status = true THEN 1 END) as active_brands
        ')
            ->first();

        $categoryStats = Category::selectRaw('
            COUNT(*) as total_categories,
            COUNT(CASE WHEN parent_id IS NULL THEN 1 END) as total_primary_categories,
            COUNT(CASE WHEN status = true THEN 1 END) as active_categories,
            COUNT(CASE WHEN parent_id IS NOT NULL THEN 1 END) as total_sub_categories
        ')
            ->first();

        $currencyStats = Currency::selectRaw('
            COUNT(*) as total_currency,
            COUNT(CASE WHEN status = true THEN 1 END) as total_active_currency
        ')
            ->first();

        $stockStats = ProductStock::selectRaw('
            SUM(stock) as total_stock
        ')
            ->first();

        $purchaseStats = StockPurchase::selectRaw('
            SUM(quantity) as total_stock_purchase,
            SUM(purchase_total_price) as total_stock_purchase_amount
        ')
            ->first();

        $totalRatings = Rating::count();
        $totalUsers = User::count();
        $totalCoupons = Coupon::where('status', true)->count();

        $now = now();
        $totalQuestions = ProductQuestion::count();
        $currentMonthQuestions = ProductQuestion::where('created_at', '>=', $now->copy()->firstOfMonth())->count();
        $lastMonthQuestions = ProductQuestion::whereBetween('created_at', [
            $now->copy()->subMonth()->firstOfMonth(),
            $now->copy()->subMonth()->endOfMonth()
        ])->count();

        $percentageChange = $lastMonthQuestions > 0
            ? (($currentMonthQuestions - $lastMonthQuestions) / $lastMonthQuestions) * 100
            : ($currentMonthQuestions > 0 ? 100 : 0);

        $totalQuantityAcrossAllOrders = OrderDetail::all()->map(function ($orderDetail) {
            $details = json_decode($orderDetail->details, true);
            return collect($details['products'])->sum('qty');
        })->sum();
        $totalFlashDeals = FlashDeal::where('status', true)->count();

        $symbol = get_system_default_currency()->symbol;

        return [
            'total_users' => $totalUsers,
            'total_products' => $productStats->total_products,
            'total_active_products' => $productStats->total_active_products,
            'total_questions' => $totalQuestions,
            'questions_percentage_change' => round($percentageChange, 2),
            'total_stock' => $stockStats->total_stock,
            'order_to_stock_ratio%' => intval($stockStats->total_stock) > 0
                ? round(($totalQuantityAcrossAllOrders / $stockStats->total_stock) * 100, 4)
                : 0,
            'total_stock_purchase' => $purchaseStats->total_stock_purchase,
            'total_stock_purchase_amount' => $symbol . round(covert_to_defalut_currency($purchaseStats->total_stock_purchase_amount), 3),
            'total_orders' => $orderStats->total_orders,
            'total_order_qty' => $totalQuantityAcrossAllOrders,
            'total_order_amount' =>  $symbol . round(covert_to_defalut_currency($orderStats->total_order_amount), 3),
            'total_paid_order_amount' => $symbol . round(covert_to_defalut_currency($orderStats->total_paid_order_amount), 3),
            'total_unpaid_order_amount' =>  $symbol . round(covert_to_defalut_currency($orderStats->total_unpaid_order_amount), 3),
            'total_cash_on_delivery' => $symbol . round(covert_to_defalut_currency($orderStats->total_cash_on_delivery), 3),
            'total_pending_orders' => $orderStats->total_pending_orders,
            'total_packaging_orders' => $orderStats->total_packaging_orders,
            'total_delivered_orders' => $orderStats->total_delivered_orders,
            'total_returned_orders' => $orderStats->total_returned_orders,
            'total_failed_orders' => $orderStats->total_failed_orders,
            'total_currency' => $currencyStats->total_currency,
            'total_active_currency' => $currencyStats->total_active_currency,
            'total_brands' => $brandStats->total_brands,
            'active_brands' => $brandStats->active_brands,
            'total_categories' => $categoryStats->total_categories,
            'total_primary_categories' => $categoryStats->total_primary_categories,
            'active_categories' => $categoryStats->active_categories,
            'total_sub_categories' => $categoryStats->total_sub_categories,
            'total_ratings' => $totalRatings,
            'total_coupons' => $totalCoupons,
            'total_flash_deals' => $totalFlashDeals,
        ];
    }
}
