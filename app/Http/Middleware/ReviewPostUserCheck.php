<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;

class ReviewPostUserCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $id = $request->review;
        $review = Review::find($id);
        $review_user_id = $review->user_id;

        if (Auth::id() != $review_user_id) {
           return redirect(route('shops.index'))->with('failure', '指定されたページは開けません');
        }

        return $next($request);
    }
}
