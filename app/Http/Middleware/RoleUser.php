<?php

namespace App\Http\Middleware;

use Closure;

class RoleUser
{
    protected $hierarchy = [
        'admin'  => 3,
        'edit'   => 2,
        'normal' => 1
        ];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $user = auth()->user();

        if ($this->hierarchy[$user->role] < $this->hierarchy[$role]) {
            //abort(404);
            return redirect()->route('home');
        }
        return $next($request);
    }
}
