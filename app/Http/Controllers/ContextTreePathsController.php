<?php

namespace Figview\Http\Controllers;

use Figview\Services\ContextTreePathService;
use Illuminate\Http\Request;
use Figview\Http\Requests;
use Figview\Repositories\ContextTreePathRepository;


class ContextTreePathsController extends Controller
{

    /**
     * @var ContextTreePathRepository
     */
    protected $repository;

    /**
     * @var ContextTreePathService
     */
    protected $service;

    public function __construct(ContextTreePathRepository $repository, ContextTreePathService $service)
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
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     *
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
     * @param  Request $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $id)
    {
        //dd($id->all());
        return $this->service->find($id->all());
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
     * @param  Request $request
     * @param  Request $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Request $id)
    {
        return $this->service->update($request->all(), $id->all());
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $id)
    {
        $this->service->delete($id->all());
    }
}
