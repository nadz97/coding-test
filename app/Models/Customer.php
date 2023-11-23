<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasUuids;

    protected $table = "customers";
    protected $primaryKey = "id";
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['transaction_id', 'name', 'email', 'phone'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
