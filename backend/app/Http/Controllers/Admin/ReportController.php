<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $query = Order::query();

        if ($startDate && $endDate) {
            $query->whereBetween(
                'created_at',
                [
                    $startDate . ' 00:00:00',
                    $endDate . ' 23:59:59'
                ]
            );
        }

        $orders = $query
            ->latest()
            ->get();

        $totalOrders = $orders->count();

        $completedOrders = $orders
            ->where('status', 'completed')
            ->count();

        $totalRevenue = $orders
            ->where('status', 'completed')
            ->sum('total_price');

        $salesData = $orders
            ->groupBy(function ($order) {
                return $order->created_at->format('d M');
            })
            ->map(function ($items) {
                return [
                    'day' => $items->first()->created_at->format('d M'),
                    'sales' => $items->sum('total_price')
                ];
            })
            ->values();

        return view(
            'admin.reports.index',
            compact(
                'totalOrders',
                'completedOrders',
                'totalRevenue',
                'orders',
                'salesData'
            )
        );
    }

    public function exportPdf(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $query = Order::query();

        if ($startDate && $endDate) {
            $query->whereBetween(
                'created_at',
                [
                    $startDate . ' 00:00:00',
                    $endDate . ' 23:59:59'
                ]
            );
        }

        $orders = $query
            ->latest()
            ->get();

        $totalOrders = $orders->count();

        $completedOrders = $orders
            ->where('status', 'completed')
            ->count();

        $totalRevenue = $orders
            ->where('status', 'completed')
            ->sum('total_price');

        $pdf = Pdf::loadView(
            'admin.reports.pdf',
            compact(
                'orders',
                'totalOrders',
                'completedOrders',
                'totalRevenue',
                'startDate',
                'endDate'
            )
        );

        return $pdf->download(
            'laporan-sweetbite.pdf'
        );
    }
}