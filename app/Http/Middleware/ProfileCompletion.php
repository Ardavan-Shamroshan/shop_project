<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileCompletion
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {

        $user = Auth::user();
        // if user has logged in via email,
        // email should not be empty and mobile should be empty,
        // and if email_verified_at was empty, user should redirects to profile completion
        if (
            !empty($user->email) &&
            empty($user->mobile) &&
            empty($user->email_verified_at)
        )
            return redirect()->route('customer.sales-process.profile-completion');

        // if user has logged in via mobile,
        // mobile should not be empty and email should be empty,
        // and if mobile_verified_at was empty, user should redirects to profile completion
        if (
            !empty($user->mobile) &&
            empty($user->email) &&
            empty($user->mobile_verified_at)
        )
            return redirect()->route('customer.sales-process.profile-completion');

        // if user first_name or last_name or national_code was empty, user should redirects to profile completion
        if (
            empty($user->first_name) ||
            empty($user->last_name) ||
            empty($user->national_code)
        )
            return redirect()->route('customer.sales-process.profile-completion');


        return $next($request);

    }
}
