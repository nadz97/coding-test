<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testCreateTransaction()
    {
        $transaction = new Transaction();
        $transaction->total_amount = 20000;
        $transaction->status = 'PENDING';
        $transaction->description = 'order pertama';
        $transaction->expired_date = '2023-01-01';
        $transaction->save();

        self::assertNotNull($transaction->id);
    }
    public function testCreateTransactionUUID()
    {
        $transaction = new Transaction();
        $transaction->total_amount = 20000;
        $transaction->status = 'PENDING';
        $transaction->description = 'order pertama';
        $transaction->expired_date = '2023-01-01';
        $transaction->save();

        self::assertNotNull($transaction->id);
        self::assertNotNull($transaction->order_id);
    }
}
