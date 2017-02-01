<?php

namespace Figview\Http\Controllers;

use Figview\Services\IoTEnvService;
use Illuminate\Http\Request;
use Figview\Http\Requests;
use Figview\Repositories\IotEnvRepository;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class IotEnvsController extends Controller
{

    /**
     * @var IotEnvRepository
     */
    protected $repository;

    /**
     * @var IoTEnvService
     */
    protected $service;

    public function __construct(IotEnvRepository $repository, IoTEnvService $service)
    {
        $this->repository = $repository;
        $this->service  = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->service->findWhere(Authorizer::getResourceOwnerId());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($this->checkIoTEnvPermissions($id) == false)
        {
            return ['error' => 'Access Forbidden!'];
        }

        return $this->service->find($id);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($this->checkIoTEnvOwner($id) == false)
        {
            return ['error' => 'Access Forbidden!'];
        }

        return $this->service->update($request->all(), $id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->checkIoTEnvOwner($id) == false)
        {
            return ['error' => 'Access Forbidden!'];
        }

        $this->service->delete($id);
    }

    /**
     * Check if the user is owner of the iotEnv.
     *
     * @param $iotEnvId
     * @return mixed
     */
    private function checkIoTEnvOwner($iotEnvId)
    {
        $userId = Authorizer::getResourceOwnerId();

        return $this->repository->isOwner($iotEnvId, $userId);
    }

    /**
     * Check the user is member of the IoTEnv.
     *
     * @param $iotEnvId
     * @return mixed
     */
    private function checkIoTEnvMember($iotEnvId)
    {
        $userId = Authorizer::getResourceOwnerId();

        return $this->repository->hasMember($iotEnvId, $userId);
    }

    private function checkIoTEnvPermissions($iotEnvId)
    {
        if($this->checkIoTEnvOwner($iotEnvId) or $this->checkIoTEnvMember($iotEnvId))
        {
            return true;
        }

        return false;
    }
}
