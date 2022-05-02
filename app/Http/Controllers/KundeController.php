<?php

namespace App\Http\Controllers;

use App\Models\Kunde;
use App\Models\Medarbejder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;


/**
 * @OA\get(
 *      path="/kunder",
 *      summary="Liste af Kunder",
 *      description="",
 *      operationId="kundersList",
 *      tags={"Personer - Kunder"},
 *      security={{"bearerAuth":{}}},
 *
 *      @OA\Response(
 *          response=200,
 *          description="success",
 *          @OA\JsonContent(
 *              @OA\Property(property="id", type="integer", example="1"),
 *              @OA\Property(property="fornavn", type="string", example="Bedste Kunde Fornavn"),
 *              @OA\Property(property="efternavn", type="string", example="Bedste Kunde Efternavn"),
 *              @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *              @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              example={
 *                  {"id":1,"fornavn":"Bedste Kunde fornavn","efternavn":"Bedste Kunde efternavn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *                  {"id":2,"fornavn":"Bedste Kunde fornavn","efternavn":"Bedste Kunde efternavn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Kunder"
 *      )
 * )
 *
 * @OA\post(
 *      path="/kunder",
 *      summary="Opret en ny Kunde",
 *      description="",
 *      operationId="kundersCreate",
 *      tags={"Personer - Kunder"},
 *      @OA\Parameter(
 *              name="fornavn",
 *              description="Fornavn",
 *              @OA\Schema(
 *                 type="string"
 *              ),
 *              in="query",
 *              required=true
 *      ),
 *      @OA\Parameter(
 *              name="efternavn",
 *              description="Efternavn",
 *              @OA\Schema(
 *                 type="string"
 *              ),
 *              in="query",
 *              required=true
 *      ),
 *      @OA\Parameter(
 *              name="username",
 *              description="Brugernavn",
 *              @OA\Schema(
 *                 type="string"
 *              ),
 *              in="query",
 *              required=true
 *      ),
 *      @OA\Parameter(
 *              name="password",
 *              description="Password",
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
 *          description="Kunde oprettet"
 *      )
 * )
 * @OA\get(
 *      path="/kunder/{id}",
 *      summary="Find en specifik Kunde",
 *      description="",
 *      operationId="kundersSpecific",
 *      tags={"Personer - Kunder"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Kunde ID'et",
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
 *              @OA\Property(property="fornavn", type="string", example="Bedste Kunde Fornavn"),
 *              @OA\Property(property="efternavn", type="string", example="Bedste Kunde Efternavn"),
 *              @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *              @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              example={
 *                  {"id":1,"fornavn":"Bedste Kunde fornavn","efternavn":"Bedste Kunde efternavn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Kunde"
 *      )
 * )
 *
 * @OA\put(
 *      path="/kunder/{id}",
 *      summary="Opdater en Kunde",
 *      description="",
 *      operationId="kundersUpdate",
 *      tags={"Personer - Kunder"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Kunde ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *              in="path",
 *              required=true
 *      ),
 *      @OA\Parameter(
 *              name="fornavn",
 *              description="Fornavn",
 *              @OA\Schema(
 *                 type="string"
 *              ),
 *              in="query",
 *              required=true
 *      ),
 *      @OA\Parameter(
 *              name="efternavn",
 *              description="Efternavn",
 *              @OA\Schema(
 *                 type="string"
 *              ),
 *              in="query",
 *              required=true
 *      ),
 *      @OA\Parameter(
 *              name="username",
 *              description="Brugernavn",
 *              @OA\Schema(
 *                 type="string"
 *              ),
 *              in="query",
 *              required=true
 *      ),
 *      @OA\Parameter(
 *              name="password",
 *              description="Password",
 *              @OA\Schema(
 *                 type="string"
 *              ),
 *              in="query",
 *              required=true
 *      ),
 *   security={{"bearerAuth":{}}},
 *
 *   @OA\Response(
 *      response=200,
 *      description="Kunde Opdateret"
 *   )
 * )
 *
 *
 * @OA\put(
 *      path="/kunder/{id}/navn",
 *      summary="Opdater en Kunde's navn",
 *      description="",
 *      operationId="kundersNameUpdate",
 *      tags={"Personer - Kunder"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Kunde ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *              in="path",
 *              required=true
 *      ),
 *      @OA\Parameter(
 *              name="fornavn",
 *              description="Fornavn",
 *              @OA\Schema(
 *                 type="string"
 *              ),
 *              in="query",
 *              required=true
 *      ),
 *      @OA\Parameter(
 *              name="efternavn",
 *              description="Efternavn",
 *              @OA\Schema(
 *                 type="string"
 *              ),
 *              in="query",
 *              required=true
 *      ),
 *   security={{"bearerAuth":{}}},
 *
 *   @OA\Response(
 *      response=200,
 *      description="Kunde Opdateret"
 *   )
 * )
 *
 * @OA\delete(
 *      path="/kunder/{id}",
 *      summary="Slet en Kunde",
 *      description="",
 *      operationId="kundersDelete",
 *      tags={"Personer - Kunder"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Kunde ID'et",
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
 *      description="Kunde Slettet"
 *   )
 * )
 *
 *
 * @OA\get(
 *      path="/kunder/{id}/sager",
 *      summary="Find en specifik Kunde's sager",
 *      description="",
 *      operationId="kundersSager",
 *      tags={"Personer - Kunder"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Kunde ID'et",
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
 *              @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *              @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              @OA\Property(property="afhentningstype", type="object",
 *                  @OA\Property(property="id", type="integer", example="1"),
 *                  @OA\Property(property="navn", type="string", example="Bedste Afhentningstype"),
 *                  @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *                  @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              ),
 *              @OA\Property(property="sagstype", type="object",
 *                  @OA\Property(property="id", type="integer", example="1"),
 *                  @OA\Property(property="navn", type="string", example="Bedste Sagstype"),
 *                  @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *                  @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              ),
 *              @OA\Property(property="status", type="object",
 *                  @OA\Property(property="id", type="integer", example="1"),
 *                  @OA\Property(property="navn", type="string", example="Bedste Status"),
 *                  @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *                  @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              ),
 *              example={
 *                  {"id":1,"beskrivelse":"Bedste Beskrivelse","indlevering":"31-03-2022 18:54:56","status_skift":"31-03-2022 18:54:56","chip_id":"Bedste Chip ID","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46","status":{"id":1,"navn":"Bedste Status","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},"afhentningstype":{"id":1,"navn":"Bedste Afhentningstype","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},"sagstype":{"id":1,"navn":"Bedste Sagstype","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"}},
 *                  {"id":2,"beskrivelse":"Bedste Beskrivelse","indlevering":"31-03-2022 18:54:56","status_skift":"31-03-2022 18:54:56","chip_id":"Bedste Chip ID","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46","status":{"id":1,"navn":"Bedste Status","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},"afhentningstype":{"id":1,"navn":"Bedste Afhentningstype","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},"sagstype":{"id":1,"navn":"Bedste Sagstype","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"}},
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Kunde"
 *      )
 * )
 *
 */

class KundeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kunde::orderBy('id','ASC')->get();
        if(count($data) == 0){
            return response('Ingen Kunder', 404);
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
        $data = (new Kunde());
        $data->fornavn = $request->fornavn;
        $data->efternavn = $request->fornavn;
        $data->username = hash('sha512',$request->username);
        $data->password = hash('sha512',$request->password);
        $data->email = $request->email;
        $data->save();

        return response('Kunde oprettet', 202);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Kunde::where('id','=',$id)->first();
        if(!$data){
            return response('Kunde ikke fundet', 404);
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
        $data = Kunde::where('id','=',$id)->first();
        if(!$data){
            return response('Kunde ikke fundet', 404);
        }
        $data->fornavn = $request->fornavn;
        $data->efternavn = $request->efternavn;
        $data->username = hash('sha512',$request->username);
        $data->password = hash('sha512',$request->password);
        $data->email = $request->email;

        $data->save();

        return response('Kunde opdateret', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Kunde::where('id','=',$id)->first();
        if(!$data){
            return response('Kunde ikke fundet', 404);
        }
        $data->delete();

        return response('Kunde slettet', 204);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function navn($id,Request $request)
    {
        // Postman requires Post Method and "_method":"put" as form-data
        $data = Kunde::where('id','=',$id)->first();
        if(!$data){
            return response('Medarbejder ikke fundet', 404);
        }
        $data->fornavn = $request->fornavn;
        $data->efternavn = $request->efternavn;
        $data->save();

        return response('Medarbejder opdateret', 200);
    }

    public function check_login(Request $request){
        $hashed_username = hash('sha512',$request->username);
        $hashed_password = hash('sha512',$request->password);
        $user = Kunde::where('username','=',$hashed_username)->first();

         if($user->password == $hashed_password){
            return $user;
        }
        else{
            return response('Forkert Credentials', 404);
        }
    }

    public function password($id,Request $request){
        // Postman requires Post Method and "_method":"put" as form-data
        $data = Kunde::where('id','=',$id)->first();
        if(!$data){
            return response('Kunde ikke fundet', 404);
        }
        $data->password = hash('sha512',$request->password);
        $data->save();

        return response('Kunde opdateret', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function kundeSager($id,Request $request)
    {
        // Postman requires Post Method and "_method":"put" as form-data
        $data = Kunde::where('id','=',$id)
            ->with('sager')
            ->with('sager.kunde')
            ->with('sager.medarbejder')
            ->with('sager.produkt')
            ->with('sager.produkt.model')
            ->with('sager.produkt.model.fabrikant')
            ->with('sager.produkt.model.type')
            ->with('sager.sagstype')
            ->with('sager.afhentningstype')
            ->with('sager.status')
            ->first();
        if(!$data){
            return response('Medarbejder ikke fundet', 404);
        }
        $sager = $data->sager;

        if(count($sager) >= 1){
            return $sager;
        }
        else{
            return response('Ingen sager fundet', 404);
        }
    }
}
