<?php

namespace App\Http\Controllers;

use App\Models\Fabrikant;
use Illuminate\Http\Request;

/**
 * @OA\get(
 *      path="/fabrikanter",
 *      summary="Liste af Fabrikanter",
 *      description="",
 *      operationId="fabrikantsList",
 *      tags={"Produkter - Fabrikanter"},
 *      security={{"bearerAuth":{}}},
 *
 *      @OA\Response(
 *          response=200,
 *          description="success",
 *          @OA\JsonContent(
 *              @OA\Property(property="id", type="integer", example="1"),
 *              @OA\Property(property="navn", type="string", example="Bedste Fabrikant Navn"),
 *              @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *              @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              example={
 *                  {"id":1,"Navn":"Bedste Fabrikant Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *                   {"id":1,"Navn":"Bedste Fabrikant Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Fabrikanter"
 *      )
 * )
 *
 * @OA\post(
 *      path="/fabrikanter",
 *      summary="Opret en ny Fabrikant",
 *      description="",
 *      operationId="fabrikantsCreate",
 *      tags={"Produkter - Fabrikanter"},
 *      @OA\Parameter(
 *              name="navn",
 *              description="Fabrikant navnet",
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
 *          description="Fabrikant oprettet"
 *      )
 * )
 * @OA\get(
 *      path="/fabrikanter/{id}",
 *      summary="Find en specifik Fabrikant",
 *      description="",
 *      operationId="fabrikantsSpecific",
 *      tags={"Produkter - Fabrikanter"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Fabrikant ID'et",
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
 *              @OA\Property(property="navn", type="string", example="Bedste Fabrikant Navn"),
 *              @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *              @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              example={
 *                  {"id":1,"Navn":"Bedste Fabrikant Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"}
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Fabrikant"
 *      )
 * )
 *
 * @OA\put(
 *      path="/fabrikanter/{id}",
 *      summary="Opdater en Fabrikant",
 *      description="",
 *      operationId="fabrikantsUpdate",
 *      tags={"Produkter - Fabrikanter"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Fabrikant ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *              in="path",
 *              required=true
 *      ),
 *     @OA\Parameter(
 *              name="navn",
 *              description="Fabrikant navnet",
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
 *      description="Fabrikant Opdateret"
 *   )
 * )
 *
 * @OA\delete(
 *      path="/fabrikanter/{id}",
 *      summary="Slet en Fabrikant",
 *      description="",
 *      operationId="fabrikantsDelete",
 *      tags={"Produkter - Fabrikanter"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Fabrikant ID'et",
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
 *      description="Fabrikant Slettet"
 *   )
 * )
 */

class FabrikantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Fabrikant::orderBy('id','ASC')->get();
        if(count($data) == 0){
            return response('Ingen Fabrikanter', 404);
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
        $data = (new Fabrikant());
        $data->navn = $request->navn;
        $data->save();

        return response('Fabrikant oprettet', 202);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Fabrikant::where('id','=',$id)->first();
        if(!$data){
            return response('Fabrikant ikke fundet', 404);
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
        $data = Fabrikant::where('id','=',$id)->first();
        if(!$data){
            return response('Fabrikant ikke fundet', 404);
        }
        $data->navn = $request->navn;
        $data->save();

        return response('Fabrikant opdateret', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Fabrikant::where('id','=',$id)->first();
        if(!$data){
            return response('Fabrikant ikke fundet', 404);
        }
        $data->delete();

        return response('Fabrikant slettet', 204);
    }
}
