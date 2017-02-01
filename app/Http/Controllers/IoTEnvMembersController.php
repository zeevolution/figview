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
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->service->all();
    }

    /**
     * Store a new member to an IoTEnv.
     *
     * @param Request $request
     * @return array|mixed
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
     * @param Request $request
     * @param $id
     * @return array|mixed
     */
    public function update(Request $request, $id)
    {
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
        $this->service->delete($id);
    }
}
