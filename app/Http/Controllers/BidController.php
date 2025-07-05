<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBidRequest;
use App\Http\Requests\UpdateBidRequest;
use App\Models\Bid;
use App\Models\Post;
use Illuminate\Routing\Controllers\HasMiddleware;

class BidController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            'auth'
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBidRequest $request)
    {
        $request->validated();

        $post = Post::find($request->post_id);

        if ($post->user_id == $request->user()->id) {
            return abort(403, "You are not allowed to bid on your own advertisements!");
        }

        if ($post->highestBid() && $post->highestBid()->amount >= $request->getAmount()) {
            return back()->withErrors([
                'amount' => "Your bid must be higher than the current highest bid"
            ]);
        }

        Bid::create(array_merge($request->except('amount'), [
            'amount' => $request->getAmount(),
            'user_id' => $request->user()->id
        ]));

        return back()->with([
            'status' => "Succesfully added your bid!"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bid $bid)
    {
        //
    }
}
