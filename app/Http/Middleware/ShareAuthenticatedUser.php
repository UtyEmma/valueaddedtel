<?php

namespace App\Http\Middleware;

use App\Enums\Status;
use App\Models\PlanDuration;
use Closure;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Auth\Authenticatable;

class ShareAuthenticatedUser
{
    /**
     * The View Factory.
     *
     * @var \Illuminate\Contracts\View\Factory
     */
    protected Factory $factory;

    /**
     * The Authenticated user, if any.
     *
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    protected Authenticatable | null $user;

    /**
     * Create a new Share Authenticated User instance.
     *
     * @param  \Illuminate\Contracts\View\Factory  $factory
     * @param  \Illuminate\Contracts\Auth\Authenticatable|null  $user
     */
    public function __construct(Factory $factory, Authenticatable $user = null) {
        $this->factory = $factory;
        $this->user = $user;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $this->user;
        $this->factory->share('authenticated', $user);
        $this->factory->share('isEmployer', $user?->is_employer);
        $this->factory->share('isCandidate', $user?->is_candidate);
        $this->factory->share('isAdmin', $user?->is_admin);
        $this->factory->share('currency', config('app.currency'));

        return $next($request);
    }
}
