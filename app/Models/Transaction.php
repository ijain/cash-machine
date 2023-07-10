<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'transactions';

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
}
