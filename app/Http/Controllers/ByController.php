<?php

namespace App\Http\Controllers;

use App\Models\By;
use Illuminate\Http\Request;

/**
 * @OA\get(
 *      path="/byer",
 *      summary="Liste af Byer",
 *      description="",
 *      operationId="biesList",
 *      tags={"Adresser - Byer"},
 *      security={{"bearerAuth":{}}},
 *
 *      @OA\Response(
 *          response=200,
 *          description="success",
 *          @OA\JsonContent(
 *              @OA\Property(property="postnummer", type="integer", example="100"),
 *              @OA\Property(property="navn", type="string", example="Bedste By Navn"),

 *              example={
 *                  {"postnummer":100,"navn":"Bedste By Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *                  {"postnummer":9000,"navn":"Bedste By Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Byer"
 *      )
 * )
 *
 *
 * @OA\get(
 *      path="/byer/{postnummer}",
 *      summary="Specifik By",
 *      description="",
 *      operationId="biesSpecific",
 *      tags={"Adresser - Byer"},
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *              name="postnummer",
 *              description="Postnumret",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=100,
 *                 maximum=9999
 *              ),
 *              in="path",
 *              required=true
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="success",
 *          @OA\JsonContent(
 *              @OA\Property(property="postnummer", type="integer", example="100"),
 *              @OA\Property(property="navn", type="string", example="Bedste By Navn"),

 *              example={
 *                  {"postnummer":100,"navn":"Bedste By Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"}
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Byer"
 *      )
 * )
 */

class ByController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = By::orderBy('postnummer','ASC')->get();
        if(count($data) == 0){
            return response('Ingen Byer', 404);
        }
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = By::where('postnummer','=',$id)->first();
        if(!$data){
            return response('By ikke fundet', 404);
        }
        return $data;
    }
}
