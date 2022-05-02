<?php

namespace App\Http\Controllers;


use App\Models\Sagstype;
use Illuminate\Http\Request;

/**
 * @OA\get(
 *      path="/sagstyper",
 *      summary="Liste af Sags Typer",
 *      description="",
 *      operationId="sagstypesList",
 *      tags={"Sager - Sags Typer"},
 *      security={{"bearerAuth":{}}},
 *
 *      @OA\Response(
 *          response=200,
 *          description="success",
 *          @OA\JsonContent(
 *              @OA\Property(property="id", type="integer", example="1"),
 *              @OA\Property(property="navn", type="string", example="Bedste Sags Type Navn"),
 *              @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *              @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              example={
 *                  {"id":1,"Navn":"Bedste Sags Type Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *                   {"id":1,"Navn":"Bedste Sags Type Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Sags Typer"
 *      )
 * )
 *
 * @OA\post(
 *      path="/sagstyper",
 *      summary="Opret en ny Sags Type",
 *      description="",
 *      operationId="sagstypesCreate",
 *      tags={"Sager - Sags Typer"},
 *      @OA\Parameter(
 *              name="navn",
 *              description="Sags Type navnet",
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
 *          description="Sags Type oprettet"
 *      )
 * )
 * @OA\get(
 *      path="/sagstyper/{id}",
 *      summary="Find en specifik Sags Type",
 *      description="",
 *      operationId="sagstypesSpecific",
 *      tags={"Sager - Sags Typer"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Sags Type ID'et",
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
 *              @OA\Property(property="navn", type="string", example="Bedste Sags Type Navn"),
 *              @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *              @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              example={
 *                  {"id":1,"Navn":"Bedste Sags Type Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"}
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Sags Type"
 *      )
 * )
 *
 * @OA\put(
 *      path="/sagstyper/{id}",
 *      summary="Opdater en Sags Type",
 *      description="",
 *      operationId="sagstypesUpdate",
 *      tags={"Sager - Sags Typer"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Sags Type ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *              in="path",
 *              required=true
 *      ),
 *     @OA\Parameter(
 *              name="navn",
 *              description="Sags Type navnet",
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
 *      description="Sags Type Opdateret"
 *   )
 * )
 *
 * @OA\delete(
 *      path="/sagstyper/{id}",
 *      summary="Slet en Sags Type",
 *      description="",
 *      operationId="sagstypesDelete",
 *      tags={"Sager - Sags Typer"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Sags Type ID'et",
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
 *      description="Sags Type Slettet"
 *   )
 * )
 */

class SagstypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Sagstype::orderBy('id','ASC')->get();
        if(count($data) == 0){
            return response('Ingen Sagstyper', 404);
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
        $data = (new Sagstype());
        $data->navn = $request->navn;
        $data->pris = $request->pris;
        $data->save();

        return response('Sagstype oprettet', 202);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Sagstype::where('id','=',$id)->first();
        if(!$data){
            return response('Sagstype ikke fundet', 404);
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
        $data = Sagstype::where('id','=',$id)->first();
        if(!$data){
            return response('Sagstype ikke fundet', 404);
        }

        $data->navn = $request->navn;
        $data->pris = $request->pris;
        $data->save();

        return response('Sagstype opdateret', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Sagstype::where('id','=',$id)->first();
        if(!$data){
            return response('Sagstype ikke fundet', 404);
        }
        $data->delete();

        return response('Sagstype slettet', 204);
    }
}
