<?php

namespace Figview\Http\Controllers;

use Figview\Services\IoTEnvMemberService;
use Illuminate\Http\Request;

use Figview\Http\Requests;
use Figview\Repositories\IoTEnvMemberRepository;
use Figview\Validators\IoTEnvMemberValidator;


class IoTEnvMembersController extends Controller
{

    /**
     * @var IoTEnvMemberRepository
     */
    protected $repository;

    /**
     * @var IoTEnvMemberValidator
     */
    protected $service;

    public function __construct(IoTEnvMemberRepository $repository, IoTEnvMemberService $service)
    {
        $this->repository = $repository;
        $this->service  = $service;
        $this->middleware('check.iotenv.owner', ['except' => ['index', 'show']]);
        $this->middleware('check.iotenv.permission', ['except' => ['store', 'destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($iotenvId)
    {
        return $this->service->findWhere($iotenvId);
    }

    /**
     * Store a new member to an IoTEnv.
     *
     * @param Request $request
     * @return array|mixed
     */
    public function store(Request $request, $iotenvId)
    {
        $data = $request->all();
        $data['iotenv_id'] = $iotenvId;
        return $this->service->create($data);
    }


    /**
     * Display the specified resource.
     * 
     * @param $iotenvId
     * @param $idIotEnvMember
     * @return mixed
     */
    public function show($iotenvId, $idIotEnvMember)
    {
        return $this->service->find($idIotEnvMember);
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
     * @param Request $request
     * @param $id
     * @return array|mixed
     */
    public function update(Request $request, $id, $idIotEnvMember)
    {
        return $this->service->update($request->all(), $idIotEnvMember);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $idIotEnvMember)
    {
        $this->service->delete($idIotEnvMember);
    }
}
