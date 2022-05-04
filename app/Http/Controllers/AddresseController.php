<?php

namespace App\Http\Controllers;

use App\Models\Addresse;
use App\Models\By;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

//Swagger Annotations
/**
 * @OA\get(
 *      path="/addresser",
 *      summary="Liste af Adresser",
 *      description="",
 *      operationId="addressesList",
 *      tags={"Adresser - Adresser"},
 *      security={{"bearerAuth":{}}},
 *
 *      @OA\Response(
 *          response=200,
 *          description="success",
 *          @OA\JsonContent(
 *              @OA\Property(property="id", type="integer", example="1"),
 *              @OA\Property(property="vej", type="string", example="Bedste Vej Navn"),
 *              @OA\Property(property="vej_nummer", type="string", example="12B"),
 *              @OA\Property(property="foretrukken", type="boolean", example="true"),
 *              @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *              @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              @OA\Property(property="by", type="object", example={"postnummer":5000,"navn":"Odense C"},@OA\Property(property="postnummer", type="integer",minimum=100, maximum=9999, example="5000"),@OA\Property(property="navn", type="string", example="Odense C")),
 *              example={
 *                  {"id": 1, "vej": "Swag Vej", "vej_nummer": "12A","foretrukken": false,"created_at": "31-03-2022 02:28:47","updated_at": "31-03-2022 03:15:46","by":{"postnummer":5000,"navn":"Odense C"}},
 *                  {"id": 2, "vej": "Swag Vej", "vej_nummer": "34B","foretrukken": true,"created_at": "31-03-2022 02:28:47","updated_at": "31-03-2022 03:15:46","by":{"postnummer":5000,"navn":"Odense C"}},
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Addresser"
 *      )
 * )
 *
 * @OA\post(
 *      path="/addresser",
 *      summary="Opret en ny Adresse",
 *      description="",
 *      operationId="addressesCreate",
 *      tags={"Adresser - Adresser"},
 *     @OA\Parameter(
 *              name="vej",
 *              description="vej navnet",
 *              @OA\Schema(
 *                 type="string"
 *              ),
 *              in="query",
 *              required=true
 *    ),
 *
 *    @OA\Parameter(
 *              name="vej_nummer",
 *              description="vej numret",
 *              @OA\Schema(
 *                  type="string"
 *              ),
 *              in="query",
 *              required=true
 *   ),
 *
 *   @OA\Parameter(
 *              name="postnummer",
 *              description="postnumret",
 *              @OA\Schema(
 *                  type="integer",
 *                  minimum=100,
 *                  maximum=9999,
 *              ),
 *              in="query",
 *              required=true
 *   ),
 *   security={{"bearerAuth":{}}},
 *
 *      @OA\Response(
 *          response=202,
 *          description="Addresse oprettet"
 *      )
 * )
 * @OA\get(
 *      path="/addresser/{id}",
 *      summary="Find en specifik Adresse",
 *      description="",
 *      operationId="addressesSpecific",
 *      tags={"Adresser - Adresser"},
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *              name="id",
 *              description="Addresse ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *             required=true,
 *              in="path"
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="success",
 *          @OA\JsonContent(
 *              @OA\Property(property="id", type="integer", example="1"),
 *              @OA\Property(property="vej", type="string", example="Bedste Vej Navn"),
 *              @OA\Property(property="vej_nummer", type="string", example="12B"),
 *              @OA\Property(property="foretrukken", type="boolean", example="true"),
 *              @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *              @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              @OA\Property(property="by", type="object", example={"postnummer":5000,"navn":"Odense C"},@OA\Property(property="postnummer", type="integer", minimum=100, maximum=9999, example="5000"),@OA\Property(property="navn", type="string", example="Odense C"))
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Addresse"
 *      )
 * )
 *
 * @OA\put(
 *      path="/addresser/{id}",
 *      summary="Opdater en Adresse",
 *      description="",
 *      operationId="addressesUpdate",
 *      tags={"Adresser - Adresser"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Addresse ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *              required=true,
 *              in="path",
 *      ),
 *      @OA\Parameter(
 *              name="vej",
 *              description="vej navnet",
 *              @OA\Schema(
 *                 type="string"
 *              ),
 *              in="query",
 *              required=true
 *    ),
 *
 *    @OA\Parameter(
 *              name="vej_nummer",
 *              description="vej numret",
 *              @OA\Schema(
 *                  type="string"
 *              ),
 *              in="query",
 *              required=true
 *   ),
 *
 *   @OA\Parameter(
 *              name="postnummer",
 *              description="postnumret",
 *              @OA\Schema(
 *                  type="integer",
 *                  minimum=100,
 *                  maximum=9999
 *              ),
 *              in="query",
 *              required=true
 *   ),
 *   security={{"bearerAuth":{}}},
 *
 *   @OA\Response(
 *      response=200,
 *      description="Addresse Opdateret"
 *   )
 * )
 *
 * @OA\delete(
 *      path="/addresser/{id}",
 *      summary="Slet en Adresse",
 *      description="",
 *      operationId="addressesDelete",
 *      tags={"Adresser - Adresser"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Addresse ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *              required=true,
 *              in="path",
 *      ),
 *   security={{"bearerAuth":{}}},
 *
 *   @OA\Response(
 *      response=204,
 *      description="Addresse Slettet"
 *   )
 * )
 *
 *
 *
 * @OA\put(
 *      path="/addresser/{id}/foretrukken",
 *      summary="Ændre foretrukken status på en specifik Adresse",
 *      description="",
 *      operationId="addressesPrefered",
 *      tags={"Adresser - Adresser"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Addresse ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *              required=true,
 *              in="path",
 *      ),
 *   security={{"bearerAuth":{}}},
 *
 *   @OA\Response(
 *      response=200,
 *      description="Foretrukken Addresse opdateret"
 *   )
 * )
 */


class AddresseController extends Controller
{
    // Liste af Objekter
    /**
     * Display a listing of the resource.
     *
     * @return Collection|Response
     */
    public function index()
    {
        // Hent data
        $data = Addresse::orderBy('id','ASC')->with('by')->get();

        // Skjul properties
        $data->makeHidden(['by_postnummer']);

        // Tæl antal af data
        if(count($data) == 0){
            // Send 404 Ingen objekt
            return response('Ingen Addresser', 404);
        }

        // Send Data
        return $data;
    }

    // Opret Objekt
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response|Addresse
     */
    public function store(Request $request)
    {
        // Opret nyt objekt
        $data = (new Addresse);

        // Sæt properties på objekt
        $data->vej = $request->vej;
        $data->vej_nummer = $request->vej_nummer;
        $data->by_postnummer = $request->postnummer;

        // Send til Database
        $data->save();

        // Send 202 Objekt oprettet respons
        return response('Addresse oprettet', 202);
    }

    // Specifik Objekt
    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return Addresse|Response
     */
    public function show($id)
    {
        // Find specifik Objekt
        $data = Addresse::where('id','=',$id)->with('by')->first();

        // Tjekt om specifikt objekt blev fundet
        if(!$data){
            // Send 404 objekt ikke fundet response hvis objektet ikke findes
            return response('Addresse ikke fundet', 404);
        }

        // Send data
        return $data;
    }

    // Opdater Specifik Objekt
    /**
     * Update the specified resource in storage.
     *
     * @param  $id
     * @param Request $request
     * @return Response
     */
    public function update($id,Request $request)
    {
        // Postman requires Post Method and "_method":"put" as form-data
        // Find objekt
        $data = Addresse::where('id','=',$id)->first();

        // Tjek om objekt blev fundet
        if(!$data){
            // Send 404 objekt ikke fundet response hvis objektet ikke blev fundet
            return response('Addresse ikke fundet', 404);
        }

        // Skjul properties
        $data->makeHidden(['by_postnummer']);

        // Find specifik data
        $post_nummer_input = $request->postnummer;
        $post_nummer = By::where('postnummer','=',$post_nummer_input)->first();

        // Tjek om data blev fundet
        if(!$post_nummer){
            return response('By ikke fundet', 404);
        }

        // Opdater properties
        $data->vej = $request->vej;
        $data->vej_nummer = $request->vej_nummer;
        $data->by_postnummer = $request->postnummer;

        // Send data til Database
        $data->save();

        // Send 200 objekt opdateret response
        return response('Addresse opdateret', 200);
    }

    // Slet Specifik Objekt
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // Find det specifikke objekt
        $data = Addresse::where('id','=',$id)->first();

        // Tjek om objektet blev fundet
        if(!$data){
            // Hvis objektet ikke blev fundet, send en 404 objekt ikke fundet response
            return response('Addresse ikke fundet', 404);
        }

        // Slet objektet
        $data->delete();

        // Send 204 objekt slettet response
        return response('Addresse slettet', 204);
    }

    // Ændre Foretrukken status på Objektet
    /**
     * Opdater foretrukken status på Addressen
     *
     * @param  int  $id
     * @return Response
     */

    public function foretrukken($id){
        // Find det specifikke objekt
        $data = Addresse::where('id',$id)->first();

        // Tjek om objektet blev fundet
        if(!$data){
            // Hvis objektet ikke blev fundet, send en 404 objekt ikke fundet response
            return response('Addresse ikke fundet', 404);
        }

        // Hvis addressen er foretrukken, sæt den til ikke foretrukken
        if($data->foretrukken == 1){
            $data->foretrukken = 0;
        }
        // Hvis addressen ikke er foretrukken, sæt den til foretrukken
        else{
            $data->foretrukken = 1;
        }

        // Send data til Databasen
        $data->save();

        // Send 200 Addresse foretrukken status opdateret
        return response('Addresse foretrukken status opdateret', 200);
    }
}
