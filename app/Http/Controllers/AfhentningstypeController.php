<?php

namespace App\Http\Controllers;

use App\Models\Afhentningstype;
use Illuminate\Http\Request;

//Swagger Annotations
/**
 * @OA\get(
 *      path="/afhentningstyper",
 *      summary="Liste af Afhentnings Typer",
 *      description="",
 *      operationId="afhentningstypesList",
 *      tags={"Sager - Afhentnings Typer"},
 *      security={{"bearerAuth":{}}},
 *
 *      @OA\Response(
 *          response=200,
 *          description="success",
 *          @OA\JsonContent(
 *              @OA\Property(property="id", type="integer", example="1"),
 *              @OA\Property(property="navn", type="string", example="Bedste Afhentnings Type Navn"),
 *              @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *              @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              example={
 *                  {"id":1,"Navn":"Bedste Afhentnings Type Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *                   {"id":1,"Navn":"Bedste Afhentnings Type Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Afhentnings Typer"
 *      )
 * )
 *
 * @OA\post(
 *      path="/afhentningstyper",
 *      summary="Opret en ny Afhentnings Type",
 *      description="",
 *      operationId="afhentningstypesCreate",
 *      tags={"Sager - Afhentnings Typer"},
 *      @OA\Parameter(
 *              name="navn",
 *              description="Afhentnings Type navnet",
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
 *          description="Afhentnings Type oprettet"
 *      )
 * )
 * @OA\get(
 *      path="/afhentningstyper/{id}",
 *      summary="Find en specifik Afhentnings Type",
 *      description="",
 *      operationId="afhentningstypesSpecific",
 *      tags={"Sager - Afhentnings Typer"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Afhentnings Type ID'et",
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
 *              @OA\Property(property="navn", type="string", example="Bedste Afhentnings Type Navn"),
 *              @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *              @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              example={
 *                  {"id":1,"Navn":"Bedste Afhentnings Type Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"}
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Afhentnings Type"
 *      )
 * )
 *
 * @OA\put(
 *      path="/afhentningstyper/{id}",
 *      summary="Opdater en Afhentnings Type",
 *      description="",
 *      operationId="afhentningstypesUpdate",
 *      tags={"Sager - Afhentnings Typer"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Afhentnings Type ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *              in="path",
 *              required=true
 *      ),
 *     @OA\Parameter(
 *              name="navn",
 *              description="Afhentnings Type navnet",
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
 *      description="Afhentnings Type Opdateret"
 *   )
 * )
 *
 * @OA\delete(
 *      path="/afhentningstyper/{id}",
 *      summary="Slet en Afhentnings Type",
 *      description="",
 *      operationId="afhentningstypesDelete",
 *      tags={"Sager - Afhentnings Typer"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Afhentnings Type ID'et",
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
 *      description="Afhentnings Type Slettet"
 *   )
 * )
 */

class AfhentningstypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Hent data
        $data = Afhentningstype::orderBy('id','ASC')->get();

        // Tæl antal af data
        if(count($data) == 0){
            // Send 404 Ingen objekt
            return response('Ingen Afhentningstyper', 404);
        }

        // Send Data
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
        // Opret nyt objekt
        $data = (new Afhentningstype());

        // Sæt properties på objekt
        $data->navn = $request->navn;

        // Send til Database
        $data->save();

        // Send 202 Objekt oprettet respons
        return response('Afhentningstype oprettet', 202);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find specifikt object
        $data = Afhentningstype::where('id','=',$id)->first();

        // Tjek om specifikt objekt blev fundet
        if(!$data){
            // Hvis det specifikke objekt ikke blev fundet, send 404 Objekt ikke fundet response
            return response('Afhentningstype ikke fundet', 404);
        }

        // Send data
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

        // Find specifikt object
        $data = Afhentningstype::where('id','=',$id)->first();

        // Tjek om det specifikke objekt blev fundet
        if(!$data){
            // Hvis det specifikke objekt ikke blev fundet, send 404 Objekt ikke fundet response
            return response('Afhentningstype ikke fundet', 404);
        }

        // Opdater properties
        $data->navn = $request->navn;

        // Opdater data i databasen
        $data->save();

        // Send 200 Objekt opdateret response
        return response('Afhentningstype opdateret', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find specifikt object
        $data = Afhentningstype::where('id','=',$id)->first();

        // Tjek om det specifikke objekt blev fundet
        if(!$data){
            // Hvis det specifikke objekt ikke blev fundet, send 404 Objekt ikke fundet response
            return response('Afhentningstype ikke fundet', 404);
        }

        // Opdater data fra databasen
        $data->delete();

        // Send 204 Objekt slettet response
        return response('Afhentningstype slettet', 204);
    }
}
