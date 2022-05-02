<?php

namespace App\Http\Controllers;

use App\Models\Addresse;
use App\Models\Apitoken;
use Illuminate\Http\Request;

/**
 * @OA\get(
 *      path="/tokens",
 *      summary="Liste af API Tokens",
 *      description="",
 *      operationId="tokensList",
 *      tags={"API - Tokens"},
 *      security={{"bearerAuth":{}}},
 *
 *      @OA\Response(
 *          response=200,
 *          description="success",
 *          @OA\JsonContent(
 *              @OA\Property(property="id", type="integer", example="1"),
 *              @OA\Property(property="token", type="string", example="Bedste API Token"),
 *              @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *              @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              example={
 *                  {"id":1,"token":"Bedste API Token","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *                  {"id":2,"token":"Bedste API Token","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen API Token"
 *      )
 * )
 *
 * @OA\post(
 *      path="/tokens",
 *      summary="Opret en ny API Token",
 *      description="",
 *      operationId="tokensCreate",
 *      tags={"API - Tokens"},
 *      @OA\Parameter(
 *              name="navn",
 *              description="API Token",
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
 *          description="API Token oprettet"
 *      )
 * )
 * @OA\get(
 *      path="/tokens/{id}",
 *      summary="Find en specifik API Token",
 *      description="",
 *      operationId="tokensSpecific",
 *      tags={"API - Tokens"},
 *      @OA\Parameter(
 *              name="id",
 *              description="API Token ID'et",
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
 *              @OA\Property(property="token", type="string", example="Bedste API Token"),
 *              @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *              @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              example={
 *                  {"id":1,"token":"Bedste API Token","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"}
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen API Token"
 *      )
 * )
 *
 * @OA\put(
 *      path="/tokens/{id}",
 *      summary="Opdater en API Token",
 *      description="",
 *      operationId="tokensUpdate",
 *      tags={"API - Tokens"},
 *      @OA\Parameter(
 *              name="id",
 *              description="API Token ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *              in="path",
 *              required=true
 *      ),
 *     @OA\Parameter(
 *              name="token",
 *              description="API Token navnet",
 *              @OA\Schema(
 *                 type="string"
 *              ),
 *              in="query",
 *              required=true
 *    ),
 *    @OA\Parameter(
 *              name="target_id",
 *              description="Target ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *              in="query",
 *              required=true
 *    ),
 *   security={{"bearerAuth":{}}},
 *
 *   @OA\Response(
 *      response=200,
 *      description="API Token Opdateret"
 *   )
 * )
 *
 * @OA\delete(
 *      path="/tokens/{id}",
 *      summary="Slet en API Token",
 *      description="",
 *      operationId="tokensDelete",
 *      tags={"API - Tokens"},
 *      @OA\Parameter(
 *              name="id",
 *              description="API Token ID'et",
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
 *      description="API Token Slettet"
 *   )
 * )
 */

class ApitokenController extends Controller
{
    public function index(){
        $data = Apitoken::orderBy('id','ASC')->with('target')->get();
        if(count($data) == 0){
            return response('Ingen API Tokens', 404);
        }
        return $data;
    }

    public function show($id){
        $data = Apitoken::where('id','=',$id)->first();
        if(!$data){
            return response('API Token ikke fundet', 404);
        }

        return $data;
    }

    public function store(Request $request){
        $data = (new Apitoken());
        $data->token = $request->token;
        $data->target_id = $request->target_id;
        $data->save();

        return response('API Token oprettet', 202);
    }

    public function new_token(Request $request){
        $data = (new Apitoken());
        $timestamp = now();
        $data->token = hash('sha512',$timestamp);
        $data->target_id = $request->target;
        $data->save();

        return response('API Token oprettet', 202);
    }

    public function update($id, Request $request){
        $data = Apitoken::where('id','=',$id)->first();
        if(!$data){
            return response('API Token ikke fundet', 404);
        }
        $data->token = $request->token;
        $data->target_id = $request->target_id;
        $data->save();
        return response('API Token opdateret', 200);
    }

    public function destroy($id){
        $data = Apitoken::where('id','=',$id)->first();
        if(!$data){
            return response('API Token ikke fundet', 404);
        }
        $data->delete();
        return response('API Token slettet', 204);
    }
}
