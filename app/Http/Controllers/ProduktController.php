<?php

namespace App\Http\Controllers;

use App\Models\Produkt;
use App\Models\Produktmodel;
use Illuminate\Http\Request;

/**
 * @OA\get(
 *      path="/produkter",
 *      summary="Liste af Produkter",
 *      description="",
 *      operationId="produktsList",
 *      tags={"Produkter - Produkter"},
 *      security={{"bearerAuth":{}}},
 *
 *      @OA\Response(
 *          response=200,
 *          description="success",
 *          @OA\JsonContent(
 *              @OA\Property(property="id", type="integer", example="1"),
 *              @OA\Property(property="navn", type="string", example="Bedste Produkt Navn"),
 *              @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *              @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              @OA\Property(property="model", type="object",
 *                  example={
 *                      "id":1,
 *                      "navn":"Bedste Model",
 *                      "created_at":"31-03-2022 02:28:47",
 *                      "updated_at":"31-03-2022 03:15:46",
 *                      "fabrikant":{"id":1,"Navn":"Bedste Fabrikant Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *                      "type":{"id":1,"Navn":"Bedste Type Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *                  },
 *                  @OA\Property(property="id", type="integer", example="1"),
 *                  @OA\Property(property="navn", type="string", example="Bedste Produkt Navn"),
 *                  @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *                  @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *                  @OA\Property(property="fabrikant", type="object",
 *                      example={"id":1,"Navn":"Bedste Fabrikant Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *                      @OA\Property(property="id", type="integer", example="1"),
 *                      @OA\Property(property="navn", type="string", example="Bedste Fabrikant Navn"),
 *                      @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *                      @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *                  ),
 *                  @OA\Property(property="type", type="object",
 *                      example={"id":1,"Navn":"Bedste Type Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *                      @OA\Property(property="id", type="integer", example="1"),
 *                      @OA\Property(property="navn", type="string", example="Bedste Type Navn"),
 *                      @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *                      @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *                 )
 *              ),
 *              example={
 *                  {"id": 1, "navn": "Swag Produkt", "created_at": "31-03-2022 02:28:47","updated_at": "31-03-2022 03:15:46","model":{"id": 1, "navn": "Swag Model", "created_at": "31-03-2022 02:28:47","updated_at": "31-03-2022 03:15:46","fabrikant":{"id":1,"Navn":"Bedste Fabrikant Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},"type":{"id":1,"Navn":"Bedste Type Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"}}},
 *                  {"id": 2, "navn": "Swag Produkt 2", "created_at": "31-03-2022 02:28:47","updated_at": "31-03-2022 03:15:46","model":{"id": 1, "navn": "Swag Model", "created_at": "31-03-2022 02:28:47","updated_at": "31-03-2022 03:15:46","fabrikant":{"id":1,"Navn":"Bedste Fabrikant Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},"type":{"id":1,"Navn":"Bedste Type Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"}}},
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Produkter"
 *      )
 * )
 *
 * @OA\post(
 *      path="/produkter",
 *      summary="Opret et ny Produkt",
 *      description="",
 *      operationId="produktsCreate",
 *      tags={"Produkter - Produkter"},
 *     @OA\Parameter(
 *              name="navn",
 *              description="produkt navnet",
 *              @OA\Schema(
 *                 type="string"
 *              ),
 *              in="query",
 *              required=true
 *    ),
 *
 *    @OA\Parameter(
 *              name="model_id",
 *              description="model id'et",
 *              @OA\Schema(
 *                  type="integer",
 *                  minimum=1
 *              ),
 *              required=true,
 *              in="query",
 *   ),
 *
 *      security={{"bearerAuth":{}}},
 *
 *      @OA\Response(
 *          response=202,
 *          description="Produkt oprettet"
 *      )
 * )
 * @OA\get(
 *      path="/produkter/{id}",
 *      summary="Find et specifik Produkt",
 *      description="",
 *      operationId="produktsSpecific",
 *      tags={"Produkter - Produkter"},
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *              name="id",
 *              description="Addresse ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *             required=true,
 *             in="path"
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="success",
 *          @OA\JsonContent(
 *              @OA\Property(property="id", type="integer", example="1"),
 *              @OA\Property(property="navn", type="string", example="Bedste Navn"),
 *              @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *              @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              example={"id": 1, "navn": "Swag Produkt", "created_at": "31-03-2022 02:28:47","updated_at": "31-03-2022 03:15:46","model":{"id": 1, "navn": "Swag Model", "created_at": "31-03-2022 02:28:47","updated_at": "31-03-2022 03:15:46","fabrikant":{"id":1,"Navn":"Bedste Fabrikant Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},"type":{"id":1,"Navn":"Bedste Type Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"}}}
 *          ),
 *
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Produkt"
 *      )
 * )
 *
 * @OA\put(
 *      path="/produkter/{id}",
 *      summary="Opdater et Produkt",
 *      description="",
 *      operationId="produktsUpdate",
 *      tags={"Produkter - Produkter"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Produkt ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *              in="path",
 *              required=true
 *      ),
 *     @OA\Parameter(
 *              name="navn",
 *              description="produkt navnet",
 *              @OA\Schema(
 *                 type="string"
 *              ),
 *              in="query",
 *              required=true
 *    ),
 *
 *    @OA\Parameter(
 *              name="model_id",
 *              description="model id'et",
 *              @OA\Schema(
 *                  type="integer",
 *                  minimum=1
 *              ),
 *              required=true,
 *              in="query",
 *   ),
 *   security={{"bearerAuth":{}}},
 *
 *   @OA\Response(
 *      response=200,
 *      description="Produkt Opdateret"
 *   )
 * )
 *
 * @OA\delete(
 *      path="/produkter/{id}",
 *      summary="Slet en Adresse",
 *      description="",
 *      operationId="produktsDelete",
 *      tags={"Produkter - Produkter"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Produkt ID'et",
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
 *      description="Produkt Slettet"
 *   )
 * )
 */

class ProduktController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Produkt::orderBy('id','ASC')->with('model')->with('model.fabrikant')->with('model.type')->get();
        $data->makeHidden(['model_id']);
        if(count($data) == 0){
            return response('Ingen Produkter', 404);
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
        $data = (new Produkt());
        $data->navn = $request->navn;
        $model = Produktmodel::where('id','=', $request->model_id);
        if(!$model){
            return response('Model ikke fundet', 404);
        }
        $data->model_id = $request->model_id;
        $data->save();

        return response('Produkt oprettet', 202);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Produkt::where('id','=',$id)->with('model')->with('model.fabrikant')->with('model.type')->first();
        if(!$data){
            return response('Produkt ikke fundet', 404);
        }
        $data->makeHidden(['model_id']);


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
        $data = Produkt::where('id','=',$id)->first();
        if(!$data){
            return response('Produkt ikke fundet', 404);
        }

        $data->navn = $request->navn;
        $data->model_id = $request->model_id;
        $data->save();

        return response('Produkt opdateret', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Produkt::where('id','=',$id)->first();
        if(!$data){
            return response('Produkt ikke fundet', 404);
        }
        $data->delete();

        return response('Produkt slettet', 204);
    }
}
