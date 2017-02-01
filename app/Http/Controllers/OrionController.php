<?php

namespace Figview\Http\Controllers;

use Figview\Repositories\OrionRepository;
use Figview\Services\OrionService;
use Illuminate\Http\Request;
use Figview\Http\Requests;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;


class OrionController extends Controller
{
    /**
     * @var OrionRepository
     */
    private $repository;
    /**
     * @var OrionService
     */
    private $service;

    public function __construct(OrionRepository $repository, OrionService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($this->checkOrionOwner($id) == false)
        {
            return ['error' => 'Access Forbidden!'];
        }

        return $this->service->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($this->checkOrionOwner($id) == false)
        {
            return ['error' => 'Access Forbidden!'];
        }

        return $this->service->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->checkOrionOwner($id) == false)
        {
            return ['error' => 'Access Forbidden!'];
        }

        $this->service->delete($id);
    }

    private function checkOrionOwner($orionId)
    {
        $userId = Authorizer::getResourceOwnerId();

        return $this->repository->isOwner($orionId, $userId);
    }
}
