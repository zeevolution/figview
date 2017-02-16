<?php

namespace Figview\Http\Controllers;

use Figview\Services\DeviceModelService;
use Illuminate\Http\Request;

use Figview\Http\Requests;
use Figview\Repositories\DeviceModelRepository;


class DeviceModelsController extends Controller
{

    /**
     * @var DeviceModelRepository
     */
    protected $repository;

    /**
     * @var DeviceModelService
     */
    protected $service;

    public function __construct(DeviceModelRepository $repository, DeviceModelService $service)
    {
        $this->repository = $repository;
        $this->service  = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @param $iotEnvId
     * @return mixed
     */
    public function index($iotEnvId)
    {
        return $this->service->iotenvAllDeviceModels($iotEnvId);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $iotEnvId
     * @param Request $request
     * @return array|mixed
     */
    public function store($iotEnvId, Request $request)
    {
        $request["iotenv_id"] = $iotEnvId;
        //dd($request->all());
        return $this->service->create($request->all());
    }


    /**
     * Display the specified resource.
     *
     * @param $iotEnvId
     * @param $deviceModelId
     * @return mixed
     */
    public function show($iotEnvId, $deviceModelId)
    {
        return $this->service->iotenvDeviceModel($iotEnvId, $deviceModelId);
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
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $deviceModelId)
    {
        return $this->service->update($request->all(), $deviceModelId);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $deviceModelId)
    {
        $this->service->delete($deviceModelId);
    }
}
