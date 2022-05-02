<?php

namespace App\Http\Controllers;

use App\Models\Produkttype;
use Illuminate\Http\Request;

/**
 * @OA\get(
 *      path="/produkttyper",
 *      summary="Liste af Produkt Typer",
 *      description="",
 *      operationId="produkttypesList",
 *      tags={"Produkter - Produkt Typer"},
 *      security={{"bearerAuth":{}}},
 *
 *      @OA\Response(
 *          response=200,
 *          description="success",
 *          @OA\JsonContent(
 *              @OA\Property(property="id", type="integer", example="1"),
 *              @OA\Property(property="navn", type="string", example="Bedste Produkt Type Navn"),
 *              @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *              @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              example={
 *                  {"id":1,"Navn":"Bedste Produkt Type Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *                   {"id":1,"Navn":"Bedste Produkt Type Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Produkt Typer"
 *      )
 * )
 *
 * @OA\post(
 *      path="/produkttyper",
 *      summary="Opret en ny Produkt Type",
 *      description="",
 *      operationId="produkttypesCreate",
 *      tags={"Produkter - Produkt Typer"},
 *      @OA\Parameter(
 *              name="navn",
 *              description="Produkt Type navnet",
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
 *          description="Produkt Type oprettet"
 *      )
 * )
 * @OA\get(
 *      path="/produkttyper/{id}",
 *      summary="Find en specifik Produkt Type",
 *      description="",
 *      operationId="produkttypesSpecific",
 *      tags={"Produkter - Produkt Typer"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Produkt Type ID'et",
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
 *              @OA\Property(property="navn", type="string", example="Bedste Produkt Type Navn"),
 *              @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *              @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              example={
 *                  {"id":1,"Navn":"Bedste Produkt Type Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"}
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Produkt Type"
 *      )
 * )
 *
 * @OA\put(
 *      path="/produkttyper/{id}",
 *      summary="Opdater en Produkt Type",
 *      description="",
 *      operationId="produkttypesUpdate",
 *      tags={"Produkter - Produkt Typer"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Produkt Type ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *              in="path",
 *              required=true
 *      ),
 *     @OA\Parameter(
 *              name="navn",
 *              description="Produkt Type navnet",
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
 *      description="Produkt Type Opdateret"
 *   )
 * )
 *
 * @OA\delete(
 *      path="/produkttyper/{id}",
 *      summary="Slet en Produkt Type",
 *      description="",
 *      operationId="produkttypesDelete",
 *      tags={"Produkter - Produkt Typer"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Produkt Type ID'et",
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
 *      description="Produkt Type Slettet"
 *   )
 * )
 */

class ProdukttypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Produkttype::orderBy('id','ASC')->get();
        if(count($data) == 0){
            return response('Ingen Produkttyper', 404);
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
        $data = (new Produkttype());
        $data->navn = $request->navn;
        $data->save();

        return response('Produkttype oprettet', 202);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Produkttype::where('id','=',$id)->first();
        if(!$data){
            return response('Produkttype ikke fundet', 404);
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
        $data = Produkttype::where('id','=',$id)->first();
        if(!$data){
            return response('Produkttype ikke fundet', 404);
        }

        $data->navn = $request->navn;
        $data->save();

        return response('Produkttype opdateret', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Produkttype::where('id','=',$id)->first();
        if(!$data){
            return response('Produkttype ikke fundet', 404);
        }
        $data->delete();

        return response('Produkttype slettet', 204);
    }
}
