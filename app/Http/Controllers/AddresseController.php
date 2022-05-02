<?php

namespace App\Http\Controllers;

use App\Models\Addresse;
use App\Models\By;
use App\Models\Kunde;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

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
    /**
     * Display a listing of the resource.
     *
     * @return Collection|Response
     */
    public function index()
    {
        $data = Addresse::orderBy('id','ASC')->with('by')->get();
        $data->makeHidden(['by_postnummer']);
        if(count($data) == 0){
            return response('Ingen Addresser', 404);
        }
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response|Addresse
     */
    public function store(Request $request)
    {
        $data = (new Addresse);
        $data->vej = $request->vej;
        $data->vej_nummer = $request->vej_nummer;
        $data->by_postnummer = $request->postnummer;
        $data->save();

        return response('Addresse oprettet', 202);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return Addresse|Response
     */
    public function show($id)
    {
        $data = Addresse::where('id','=',$id)->with('by')->first();
        if(!$data){
            return response('Addresse ikke fundet', 404);
        }

        return $data;
    }

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
        $data = Addresse::where('id','=',$id)->first();

        if(!$data){
            return response('Addresse ikke fundet', 404);
        }
        $data->makeHidden(['by_postnummer']);

        $post_nummer_input = $request->postnummer;
        $post_nummer = By::where('postnummer','=',$post_nummer_input)->first();
        if(!$post_nummer){
            return response('By ikke fundet', 404);
        }

        $data->vej = $request->vej;
        $data->vej_nummer = $request->vej_nummer;
        $data->by_postnummer = $request->postnummer;
        $data->save();

        return response('Addresse opdateret', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $data = Addresse::where('id','=',$id)->first();
        if(!$data){
            return response('Addresse ikke fundet', 404);
        }
        $data->delete();
        return response('Addresse slettet', 204);
    }

    public function foretrukken($id){
        $data = Addresse::where('id',$id)->first();
        if(!$data){
            return response('Addresse ikke fundet', 404);
        }
        if($data->foretrukken == 1){
            $data->foretrukken = 0;
            $data->save();
        }
        else{
            $data->foretrukken = 1;
            $data->save();
        }

        return response('Foretrukken Addresse opdateret', 200);
    }
}
