<?php

namespace App\Models;

use App\Models\Item;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasUuids;

    protected $table = "transactions";
    protected $primaryKey = "id";
    protected $keyType = "string";
    public $incrementing = false;

    protected $fillable = ['total_amount', 'status', 'description', 'expired_date'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }
    public function uniqueIds(): array
    {
        return [$this->primaryKey, "order_id"];
    }


}
