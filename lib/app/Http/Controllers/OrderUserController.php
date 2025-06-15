<?php

namespace App\Http\Controllers;

use App\Models\VpOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderUserController extends Controller
{
    public function getListOrder()
    {
        $id = Auth::id();
        $orders = VpOrder::where('user_id', $id)->paginate(2);
        return view('frontend.listOrder', compact('orders'));
    }
    public function receivedOrder($id)
    {
        $order = VpOrder::find($id);
        $order->order_status = 'Hoàn thành';

        $order->save();
        return redirect()->intended('/list-order');
    }
}
