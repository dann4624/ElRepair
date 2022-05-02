<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

/**
 * @OA\get(
 *      path="/statuser",
 *      summary="Liste af Statuser",
 *      description="",
 *      operationId="statusesList",
 *      tags={"Sager - Statuser"},
 *      security={{"bearerAuth":{}}},
 *
 *      @OA\Response(
 *          response=200,
 *          description="success",
 *          @OA\JsonContent(
 *              @OA\Property(property="id", type="integer", example="1"),
 *              @OA\Property(property="navn", type="string", example="Bedste Status Navn"),
 *              @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *              @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              example={
 *                  {"id":1,"Navn":"Bedste Status Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *                   {"id":1,"Navn":"Bedste Status Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Statuser"
 *      )
 * )
 *
 * @OA\post(
 *      path="/statuser",
 *      summary="Opret en ny Status",
 *      description="",
 *      operationId="statusesCreate",
 *      tags={"Sager - Statuser"},
 *      @OA\Parameter(
 *              name="navn",
 *              description="Status navnet",
 *              @OA\Schema(
 *                 type="string"
 *              ),
 *              in="query",
 *              required=true
 *      ),
 *      security={{"bearerAuth":{}}},
 *
 *      @OA\Response(
 *          response=202,
 *          description="Status oprettet"
 *      )
 * )
 * @OA\get(
 *      path="/statuser/{id}",
 *      summary="Find en specifik Status",
 *      description="",
 *      operationId="statusesSpecific",
 *      tags={"Sager - Statuser"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Status ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *              in="path",
 *              required=true
 *      ),
 *      security={{"bearerAuth":{}}},
 *      @OA\Response(
 *          response=200,
 *          description="success",
 *          @OA\JsonContent(
 *              @OA\Property(property="id", type="integer", example="1"),
 *              @OA\Property(property="navn", type="string", example="Bedste Status Navn"),
 *              @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *              @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              example={
 *                  {"id":1,"Navn":"Bedste Status Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"}
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Status"
 *      )
 * )
 *
 * @OA\put(
 *      path="/statuser/{id}",
 *      summary="Opdater en Status",
 *      description="",
 *      operationId="statusesUpdate",
 *      tags={"Sager - Statuser"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Status ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *              in="path",
 *              required=true
 *      ),
 *     @OA\Parameter(
 *              name="navn",
 *              description="Status navnet",
 *              @OA\Schema(
 *                 type="string"
 *              ),
 *              in="query",
 *              required=true
 *    ),
 *   security={{"bearerAuth":{}}},
 *
 *   @OA\Response(
 *      response=200,
 *      description="Status Opdateret"
 *   )
 * )
 *
 * @OA\delete(
 *      path="/statuser/{id}",
 *      summary="Slet en Status",
 *      description="",
 *      operationId="statusesDelete",
 *      tags={"Sager - Statuser"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Status ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *              in="path",
 *              required=true
 *      ),
 *   security={{"bearerAuth":{}}},
 *
 *   @OA\Response(
 *      response=204,
 *      description="Status Slettet"
 *   )
 * )
 */

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Status::orderBy('id','ASC')->get();
        if(count($data) == 0){
            return response('Ingen Statuser', 404);
        }
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = (new Status());
        $data->navn = $request->navn;
        $data->save();

        return response('Status oprettet', 202);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Status::where('id','=',$id)->first();
        if(!$data){
            return response('Status ikke fundet', 404);
        }
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        // Postman requires Post Method and "_method":"put" as form-data
        $data = Status::where('id','=',$id)->first();
        if(!$data){
            return response('Status ikke fundet', 404);
        }

        $data->navn = $request->navn;
        $data->save();

        return response('Status opdateret', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Status::where('id','=',$id)->first();
        if(!$data){
            return response('Status ikke fundet', 404);
        }
        $data->delete();

        return response('Status slettet', 204);
    }
}
