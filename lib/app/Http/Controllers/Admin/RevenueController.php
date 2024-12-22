<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VpOrder;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function getRevenue()
    {
        $revenue = VpOrder::where('order_status', '=', 'Hoàn thành')->sum('total_price');

        return view('backend.revenue', compact('revenue'));
    }
    public function getTax()
    {
        $tax = VpOrder::where('order_status', '=', 'Hoàn thành')->sum('total_price') * 0.1;
        $tax = number_format($tax, 0, '', '.');

        return view('backend.tax', compact('tax'));
    }
}
