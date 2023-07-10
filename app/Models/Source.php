<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;

    public const CASH = 1;
    public const CARD = 2;
    public const BANK = 3;

    /**
     * @var string $table
     */
    protected $table = 'sources';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'transactions_sources', 'source_id', 'transaction_id');
    }
}
