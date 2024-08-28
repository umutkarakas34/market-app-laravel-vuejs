<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use \Laravel\Sanctum\PersonalAccessToken;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $token = $request->bearerToken();

        $accessToken = PersonalAccessToken::findToken($token);

        if (!$accessToken) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        if ($accessToken->tokenable_type === 'App\Models\Admin') {
            return Order::with('product')->get();
        } else {
            return $accessToken->tokenable->orders()->with('product')->get();
        }
    }

    // Kullanıcıların sadece kendi siparişlerini görmesi
    public function userOrders(Request $request)
    {
        // Siparişleri kullanıcının ID'sine göre getiriyoruz
        $orders = Order::where('user_id', $request->user()->id)->with('product')->get();
        return response()->json($orders);
    }

    // Adminlerin tüm siparişleri görmesi
    public function allOrders()
    {
        $orders = Order::all();
        return response()->json($orders);
    }

    public function store(Request $request)
    {
        // Authenticated kullanıcının kimliğini al
        $user = $request->user();

        // Yeni sipariş oluştur
        $order = Order::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

        return response()->json($order, 201);
    }
    public function show($id)
    {
        $order = Order::with('user', 'product')->findOrFail($id);
        return $order;
    }
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->all());
        return response()->json($order, 200);
    }
    public function destroy($id)
    {
        Order::findOrFail($id)->delete();
        return response()->json([], 204);
    }

}