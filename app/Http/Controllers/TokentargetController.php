<?php

namespace App\Http\Controllers;

use App\Models\Tokentarget;
use Illuminate\Http\Request;

/**
 * @OA\get(
 *      path="/targets",
 *      summary="Liste af API Targets",
 *      description="",
 *      operationId="targetsList",
 *      tags={"API - Targets"},
 *      security={{"bearerAuth":{}}},
 *
 *      @OA\Response(
 *          response=200,
 *          description="success",
 *          @OA\JsonContent(
 *              @OA\Property(property="id", type="integer", example="1"),
 *              @OA\Property(property="navn", type="string", example="Bedste Target Navn"),
 *              @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *              @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              example={
 *                  {"id":1,"navn":"Bedste API Target","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *                  {"id":2,"navn":"Bedste API Target","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen API Target"
 *      )
 * )
 *
 * @OA\post(
 *      path="/targets",
 *      summary="Opret en ny API Target",
 *      description="",
 *      operationId="targetsCreate",
 *      tags={"API - Targets"},
 *      @OA\Parameter(
 *              name="navn",
 *              description="API Target navn",
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
 *          description="API Target oprettet"
 *      )
 * )
 * @OA\get(
 *      path="/targets/{id}",
 *      summary="Find en specifik API Target",
 *      description="",
 *      operationId="targetsSpecific",
 *      tags={"API - Targets"},
 *      @OA\Parameter(
 *              name="id",
 *              description="API Target ID'et",
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
 *              @OA\Property(property="navn", type="string", example="Bedste Target Navn"),
 *              @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *              @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              example={
 *                  {"id":1,"navn":"Bedste Target Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"}
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen API Target"
 *      )
 * )
 *
 * @OA\put(
 *      path="/targets/{id}",
 *      summary="Opdater en API Target",
 *      description="",
 *      operationId="targetsUpdate",
 *      tags={"API - Targets"},
 *      @OA\Parameter(
 *              name="id",
 *              description="API Target ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *              in="path",
 *              required=true
 *      ),
 *     @OA\Parameter(
 *              name="token",
 *              description="API Target navnet",
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
 *      description="API Target Opdateret"
 *   )
 * )
 *
 * @OA\delete(
 *      path="/targets/{id}",
 *      summary="Slet en API Target",
 *      description="",
 *      operationId="targetsDelete",
 *      tags={"API - Targets"},
 *      @OA\Parameter(
 *              name="id",
 *              description="API Target ID'et",
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
 *      description="API Target Slettet"
 *   )
 * )
 */

class TokentargetController extends Controller
{

    public function index(){
        $data = Tokentarget::orderBy('id','ASC')->get();
        if(count($data) == 0){
            return response('Ingen Token Targets', 404);
        }
        return $data;
    }

    public function show($id){
        $data = Tokentarget::where('id','=',$id)->first();
        if(!$data){
            return response('Token Target ikke fundet', 404);
        }

        return $data;
    }

    public function store(Request $request){
        $data = (new Tokentarget());
        $data->navn = $request->navn;
        $data->save();

        return response('Token Target oprettet', 202);
    }

    public function update($id, Request $request){
        $data = Tokentarget::where('id','=',$id)->first();
        if(!$data){
            return response('API Target ikke fundet', 404);
        }
        $data->navn = $request->navn;
        $data->save();
        return response('API Target opdateret', 200);
    }

    public function destroy($id){
        $data = Tokentarget::where('id','=',$id)->first();
        if(!$data){
            return response('Token Target ikke fundet', 404);
        }
        $data->delete();
        return response('Token Target slettet', 204);
    }
}
