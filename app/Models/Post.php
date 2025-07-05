<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Laravel\Scout\Searchable;
use NumberFormatter;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'premium',
        'price',
        'category_id'
    ];

    public function searchableAs(): string
    {
        return 'posts_index';
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => (int) $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'price' => (float) $this->price / 100,
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function highestBid()
    {
        return $this->bids()->orderBy('amount', 'desc')->first();
    }

    public function displayPrice()
    {
        $fmt = numfmt_create(Config::get("app.currency.locale"), NumberFormatter::CURRENCY);
        $fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
        return $fmt->formatCurrency($this->price / 100, $fmt->getSymbol($fmt::INTL_CURRENCY_SYMBOL));
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected function casts(): array
    {
        return [
            'premium' => 'boolean'
        ];
    }
}
