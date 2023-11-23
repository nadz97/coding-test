<?php

namespace App\Http\Controllers;

use config;
use App\Models\Item;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\TransactionRequest;

class TransactionController extends Controller
{
    public function createTransaction(TransactionRequest $request)
    {
        $data = $request->validated();

        $apiKey = trim($request->header('x-api-key'));

        if ($apiKey !== config('api.key')) {
            return response()->json(['error' => 'Unauthorized.'], 401);
        }

        $transaction = new Transaction($data);

        $transaction->total_amount = $request->input('total_amount');
        $transaction->status = $request->input('status');
        $transaction->description = $request->input('description');
        $transaction->expired_date = $request->input('expired_date');
        $transaction->save();

        $item = new Item($data);

        $item->transaction_id = $transaction->id;
        $item->name = $request->input('item_name');
        $item->quantity = $request->input('item_quantity');
        $item->amount = $request->input('item_amount');
        $item->save();

        $customer = new Customer($data);

        $customer->transaction_id = $transaction->id;
        $customer->name = $request->input('customer_name');
        $customer->email = $request->input('customer_email');
        $customer->phone = $request->input('customer_phone');
        $customer->save();

        return response()->json(['status' => 'success', 'transaction' => $transaction, 'item' => $item, 'customer' => $customer]);
    }

    public function getTransaction(Request $request, $orderId)
    {
        $apiKey = trim($request->header('x-api-key'));

        if ($apiKey !== config('api.key')) {
            return response()->json(['error' => 'Unauthorized.'], 401);
        }

        $transaction = Transaction::where('order_id', $orderId)->first();

        if (!$transaction) {
            return response()->json(['error' => 'Transaction not found.'], 404);
        }

        return response()->json(['status' => 'success', 'transaction' => $transaction]);
    }

    public function callback(Request $request){

        $orderId = $request->input('order_id');
        $transactionId = $request->input('transaction_id');
        $status = $request->input('status');
        $providedSignature = $request->input('signature');

        $transaction = Transaction::where('id', $transactionId)->first();

        if (!$transaction) {
            return response()->json(['error' => 'Transaction not found.'], 404);
        }

        $expectedSignature = hash('sha256', $orderId . $transactionId . $status);

        if ($providedSignature !== $expectedSignature) {
            return response()->json(['error' => 'Invalid signature.'], 401);
        }

        $transaction->status = $status;
        $transaction->save();

        return response()->json(['status' => 'success', 'message' => 'Transaction status updated successfully.']);
    }
}
