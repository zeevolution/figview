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
        return $this->service->findAllUserOrions(Authorizer::getResourceOwnerId());
    }

    public function getEntities(Request $request, $fiwareService, $orionToken){

        //dd($request->url);
        $client = new \GuzzleHttp\Client([
            'base_uri' => $request->url,
            'headers'  =>  [
                'Fiware-Service' => $fiwareService,
                'content-type' => 'application/json',
                'accept' => 'application/json',
                'X-Auth-Token' => $orionToken ]
        ]);

        $body = \GuzzleHttp\Psr7\stream_for(
            "{\n\"entities\":[\n{\n\"type\":\"\",\n\"id\":\".*\",\n\"isPattern\":\"true\"\n}\n],\n\"attributes\":[]\n}\n"
        );

        $response = $client->request('POST', 'ngsi10/queryContext', ['body' => $body ]);

        return $response->getBody();
    }

    public function getEntityAttribute(Request $request, $entityId, $attributeId, $fiwareService, $orionToken){

        //dd($request->url);
        $client = new \GuzzleHttp\Client([
            'base_uri' => $request->url,
            'headers'  =>  [
                'Fiware-Service' => $fiwareService,
                'accept' => 'application/json',
                'X-Auth-Token' => $orionToken ]
        ]);

        $response = $client->request('GET', "/v1/contextEntities/" . $entityId . "/attributes/" . $attributeId);

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
