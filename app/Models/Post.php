<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use NumberFormatter;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'premium',
        'price'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function displayPrice()
    {
        $fmt = numfmt_create(Config::get("app.currency.locale"), NumberFormatter::CURRENCY);
        $fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
        return $fmt->formatCurrency($this->price / 100, $fmt->getSymbol($fmt::INTL_CURRENCY_SYMBOL));
    }

    protected function casts(): array
    {
        return [
            'premium' => 'boolean'
        ];
    }
}
