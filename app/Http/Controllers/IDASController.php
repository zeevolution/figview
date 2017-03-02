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
        return $this->service->findAllUserIdas(Authorizer::getResourceOwnerId());
    }

    public function getVersion(Request $request, $token){

        $client = new \GuzzleHttp\Client([
            'base_uri' => $request->url,
            'headers'  =>  [
                'accept' => 'application/json',
                'x-auth-token' => $token ]
        ]);

        $response = $client->request('GET', 'iot/about');

        return $response->getBody();
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
        $this->service->delete($id);
    }
}
