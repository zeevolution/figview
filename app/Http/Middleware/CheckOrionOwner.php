<?php

namespace Figview\Http\Middleware;

use Closure;
use Figview\Repositories\OrionRepository;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class CheckOrionOwner
{
    /**
     * @var OrionRepository
     */
    private $repository;

    public function __construct(OrionRepository $repository)
    {
        $this->repository = $repository;
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
        $userId = Authorizer::getResourceOwnerId();
        $orionId = $request->orion;

        if($this->repository->isOwner($orionId, $userId) == false)
        {
            return ['error' => 'Access Forbidden'];
        }

        return $next($request);
    }
}
