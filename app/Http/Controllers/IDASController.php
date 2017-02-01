<?php

namespace Figview\Http\Controllers;

use Figview\Repositories\IdasRepository;
use Figview\Services\IdasService;
use Illuminate\Http\Request;

use Figview\Http\Requests;
use Figview\Http\Controllers\Controller;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class IDASController extends Controller
{
    /**
     * @var IdasRepository
     */
    private $repository;
    /**
     * @var IdasService
     */
    private $service;
    
    public function __construct(IdasRepository $repository, IdasService $service)
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
        if($this->checkIdasOwner($id) == false)
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
        if($this->checkIdasOwner($id) == false)
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
        if($this->checkIdasOwner($id) == false)
        {
            return ['error' => 'Access Forbidden!'];
        }

        $this->service->delete($id);
    }

    /**
     * Check if the user is owner of the resource.
     *
     * @param $orionId
     * @return mixed
     */
    private function checkIdasOwner($orionId)
    {
        $userId = Authorizer::getResourceOwnerId();

        return $this->repository->isOwner($orionId, $userId);
    }
}
