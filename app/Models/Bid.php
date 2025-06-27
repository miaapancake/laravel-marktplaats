<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use NumberFormatter;

class Bid extends Model
{
    /** @use HasFactory<\Database\Factories\BidFactory> */
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'amount'
    ];

    public function displayPrice()
    {
        $fmt = numfmt_create(Config::get("app.currency.locale"), NumberFormatter::CURRENCY);
        $fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
        return $fmt->formatCurrency($this->amount / 100, $fmt->getSymbol($fmt::INTL_CURRENCY_SYMBOL));
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
