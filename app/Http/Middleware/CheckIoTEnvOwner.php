<?php

namespace Figview\Http\Middleware;

use Closure;
use Figview\Services\IoTEnvService;

class CheckIoTEnvOwner
{

    /**
     * @var IoTEnvService
     */
    private $service;

    public function __construct(IoTEnvService $service)
    {
        $this->service = $service;
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
        $iotenvId = $request->route('id') ? $request->route('id') : $request->route('iotenv');

        if($this->service->checkIoTEnvOwner($iotenvId) == false)
        {
            return ['error' => 'Access Forbidden'];
        }

        return $next($request);
    }
}
