<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    const CASH_LIMIT = 10000;
    const TOTAL_LIMIT = 20000;

    const OUTPUT_CASH_LIMIT = '10.000';
    const OUTPUT_TOTAL_LIMIT = '20.000';

    /**
     * @var string $table
     */
    protected $table = 'transactions';
    protected $hidden = ['updated_at'];

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'total',
        'inputs'
    ];

    protected $casts = [
        'inputs' => 'json'
    ];

    public $timestamps = true;

    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    public static function total()
    {
        return Transaction::query()
            ->whereDate('created_at', date("Y-m-d"))
            ->sum('total');
    }
}
