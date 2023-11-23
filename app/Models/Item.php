<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasUuids;

    protected $table = "items";
    protected $primaryKey = "id";
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['transaction_id', 'name', 'quantity', 'amount'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
