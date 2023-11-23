<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemTest extends TestCase
{


    public function testCreateItem()
    {
        $transaction = new Transaction();
        $transaction->total_amount = 20000;
        $transaction->status = 'PENDING';
        $transaction->description = 'order pertama';
        $transaction->expired_date = '2023-01-01';
        $transaction->save();

        \Log::info('Transaction ID: ' . $transaction->id);

        $item = new Item();
        $item->transaction_id = $transaction->id;
        $item->name = "John";
        $item->quantity = 1;
        $item->amount = 20000;
        \Log::info('Transaction ID for Item: ' . $item->transaction_id);
        $item->save();


        self::assertNotNull($item->id);
        self::assertNotNull($item->transaction_id);
    }

}
