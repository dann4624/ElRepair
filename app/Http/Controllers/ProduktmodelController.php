<?php

namespace App\Http\Controllers;

use App\Models\Produktmodel;
use Illuminate\Http\Request;

/**
 * @OA\get(
 *      path="/modeller",
 *      summary="Liste af Modeller",
 *      description="",
 *      operationId="modelsList",
 *      tags={"Produkter - Modeller"},
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
 *              @OA\Property(property="fabrikant", type="object",
 *                      example={"id":1,"Navn":"Bedste Fabrikant Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *                      @OA\Property(property="id", type="integer", example="1"),
 *                      @OA\Property(property="navn", type="string", example="Bedste Fabrikant Navn"),
 *                      @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *                      @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              ),
 *              @OA\Property(property="type", type="object",
 *                      example={"id":1,"Navn":"Bedste Type Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *                      @OA\Property(property="id", type="integer", example="1"),
 *                      @OA\Property(property="navn", type="string", example="Bedste Type Navn"),
 *                      @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *                      @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              ),
 *              example={
 *                  {"id": 1, "navn": "Swag Model", "created_at": "31-03-2022 02:28:47","updated_at": "31-03-2022 03:15:46","fabrikant":{"id":1,"Navn":"Bedste Fabrikant Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},"type":{"id":1,"Navn":"Bedste Type Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"}},
 *                  {"id": 2, "navn": "Swag Model 2", "created_at": "31-03-2022 02:28:47","updated_at": "31-03-2022 03:15:46","fabrikant":{"id":1,"Navn":"Bedste Fabrikant Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},"type":{"id":1,"Navn":"Bedste Type Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"}}
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Modeller"
 *      )
 * )
 *
 * @OA\post(
 *      path="/modeller",
 *      summary="Opret en ny Model",
 *      description="",
 *      operationId="modelsCreate",
 *      tags={"Produkter - Modeller"},
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
 *              name="fabrikant_id",
 *              description="fabrikant id'et",
 *              @OA\Schema(
 *                  type="integer",
 *                  minimum=1
 *              ),
 *              required=true,
 *              in="query",
 *   ),
 *
 *   @OA\Parameter(
 *              name="type_id",
 *              description="type id'et",
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
 *          description="Model oprettet"
 *      )
 * )
 * @OA\get(
 *      path="/modeller/{id}",
 *      summary="Find en specifik Model",
 *      description="",
 *      operationId="modelsSpecific",
 *      tags={"Produkter - Modeller"},
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *              name="id",
 *              description="Model ID'et",
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
 *             @OA\Property(property="id", type="integer", example="1"),
 *              @OA\Property(property="navn", type="string", example="Bedste Produkt Navn"),
 *              @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *              @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              @OA\Property(property="fabrikant", type="object",
 *                      example={"id":1,"Navn":"Bedste Fabrikant Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *                      @OA\Property(property="id", type="integer", example="1"),
 *                      @OA\Property(property="navn", type="string", example="Bedste Fabrikant Navn"),
 *                      @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *                      @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              ),
 *              @OA\Property(property="type", type="object",
 *                      example={"id":1,"Navn":"Bedste Type Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *                      @OA\Property(property="id", type="integer", example="1"),
 *                      @OA\Property(property="navn", type="string", example="Bedste Type Navn"),
 *                      @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *                      @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              ),
 *              example={"id": 1, "navn": "Swag Model", "created_at": "31-03-2022 02:28:47","updated_at": "31-03-2022 03:15:46","fabrikant":{"id":1,"Navn":"Bedste Fabrikant Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},"type":{"id":1,"Navn":"Bedste Type Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"}},
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Model"
 *      )
 * )
 *
 * @OA\put(
 *      path="/modeller/{id}",
 *      summary="Opdater en Model",
 *      description="",
 *      operationId="modelsUpdate",
 *      tags={"Produkter - Modeller"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Model ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *              in="path",
 *              required=true
 *      ),
 *     @OA\Parameter(
 *              name="navn",
 *              description="Model navnet",
 *              @OA\Schema(
 *                 type="string"
 *              ),
 *              in="query",
 *              required=true
 *    ),
 *
 *    @OA\Parameter(
 *              name="fabrikant_id",
 *              description="fabrikant id'et",
 *              @OA\Schema(
 *                  type="integer",
 *                  minimum=1
 *              ),
 *              required=true,
 *              in="query",
 *   ),
 *   security={{"bearerAuth":{}}},
 *
 *   @OA\Parameter(
 *              name="type_id",
 *              description="type id'et",
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
 *      description="Model Opdateret"
 *   )
 * )
 *
 * @OA\delete(
 *      path="/modeller/{id}",
 *      summary="Slet en Model",
 *      description="",
 *      operationId="modelsDelete",
 *      tags={"Produkter - Modeller"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Model ID'et",
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
 *      description="Model Slettet"
 *   )
 * )
 */

class ProduktmodelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Produktmodel::orderBy('id','ASC')->with('fabrikant')->with('type')->get();
        $data->makeHidden(['fabrikant_id','type_id']);
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
        $data = (new Produktmodel());
        $data->navn = $request->navn;
        $data->fabrikant_id = $request->fabrikant_id;
        $data->type_id = $request->type_id;
        $data->save();

        return response('Model oprettet', 202);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Produktmodel::where('id','=',$id)->with('fabrikant')->with('type')->first();
        $data->makeHidden(['fabrikant_id','type_id']);
        if(!$data){
            return response('Model ikke fundet', 404);
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
        $data = Produktmodel::where('id','=',$id)->first();
        if(!$data){
            return response('Model ikke fundet', 404);
        }

        $data->navn = $request->navn;
        $data->fabrikant_id = $request->fabrikant_id;
        $data->type_id = $request->type_id;
        $data->save();

        return response('Model opdateret', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Produktmodel::where('id','=',$id)->first();
        if(!$data){
            return response('Model ikke fundet', 404);
        }
        $data->delete();

        return response('Model slettet', 204);
    }
}
