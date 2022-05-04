<?php

namespace App\Http\Controllers;

use App\Models\Addresse;
use App\Models\Kunde;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


/**
 *  * @OA\get(
 *      path="/kunder/{id}/addresse",
 *      summary="Find en specifik Kundes Foretrukne Adresse",
 *      description="",
 *      operationId="kunderAddressesSpecific",
 *      tags={"Personer - Kunder"},
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *              name="id",
 *              description="Kunde ID'et",
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
 * @OA\get(
 *      path="/kunder/{id}/addresser",
 *      summary="Liste af en specifik Kundes Adresser",
 *      description="",
 *      operationId="kunderAddressesList",
 *      tags={"Personer - Kunder"},
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *              name="id",
 *              description="Kunde ID'et",
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
 *      path="/kunder/{id}/addresser",
 *      summary="Opret en ny Adresse og tilknyt den specifikke Kunde",
 *      description="",
 *      operationId="kunderAddressesCreate",
 *      tags={"Personer - Kunder"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Kunde ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *             required=true,
 *              in="path"
 *      ),
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
 *
 * @OA\post(
 *      path="/kunder/{id}/addresser/{addresse_id}",
 *      summary="Tilknyt en existerende Adresse en specifik Kunde",
 *      description="",
 *      operationId="kunderAddressesExisting",
 *      tags={"Personer - Kunder"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Kunde ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *              required=true,
 *              in="path",
 *      ),
 *     @OA\Parameter(
 *              name="addresse_id",
 *              description="Addresse ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *             required=true,
 *              in="path"
 *      ),
 *   security={{"bearerAuth":{}}},
 *
 *   @OA\Response(
 *      response=200,
 *      description="Addresse Opdateret"
 *   )
 * )
 *
 * @OA\put(
 *      path="/kunder/{id}/addresser/{addresse_id}",
 *      summary="Opdater en Adresse tilknyttet en specifik Kunde",
 *      description="",
 *      operationId="kunderAddressesUpdate",
 *      tags={"Personer - Kunder"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Kunde ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *              required=true,
 *              in="path",
 *      ),
 *     @OA\Parameter(
 *              name="addresse_id",
 *              description="Addresse ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *             required=true,
 *              in="path"
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
 *      path="/kunder/{id}/addresser/{addresse_id}/fjern",
 *      summary="Slet en Adresse tilknytning for en specifik Kunde",
 *      description="",
 *      operationId="kunderAddressesDelete",
 *      tags={"Personer - Kunder"},
 *     @OA\Parameter(
 *              name="id",
 *              description="Kunde ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *              required=true,
 *              in="path",
 *      ),
 *      @OA\Parameter(
 *              name="addresse_id",
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
 * @OA\delete(
 *      path="/kunder/{id}/addresser/{addresse_id}/fjern/true",
 *      summary="Slet en Adresse tilknytning for en specifik Kunde og selve addressen",
 *      description="",
 *      operationId="kunderAddressesDeleteObject",
 *      tags={"Personer - Kunder"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Kunde ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *              required=true,
 *              in="path",
 *      ),
 *      @OA\Parameter(
 *              name="addrese_id",
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
 * @OA\put(
 *      path="/kunder/{id}/addresser/{addresse_id}/foretrukken",
 *      summary="Ændre foretrukken status på en specifik Adresse tilknyttet en specifik Kunde",
 *      description="",
 *      operationId="kunderAddressesPrefered",
 *      tags={"Personer - Kunder"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Kunde ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *              required=true,
 *              in="path",
 *      ),
 *      @OA\Parameter(
 *              name="addresse_id",
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
 *
 * @OA\delete(
 *      path="/kunder/{id}/addresser/{addresse_id}/foretrukken",
 *      summary="Fjern foretrukken status på en specifik Adresse tilknyttet en specifik Kunde",
 *      description="",
 *      operationId="kunderAddressesPreferedRemove",
 *      tags={"Personer - Kunder"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Kunde ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *              required=true,
 *              in="path",
 *      ),
 *      @OA\Parameter(
 *              name="addresse_id",
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

class KundeAddresseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection|Response
     */
    public function index($id){
        // Find Kunde
        $kunde = Kunde::where('id',$id)
            ->with('addresser')
            ->with('addresser.by')
            ->first()
        ;

        // Check om kunden er fundet og hvis ikke, så returner '404 Kunde ikke fundet'
        if(!$kunde){
            return response('Kunde ikke fundet', 404);
        }

        // Find Kundens addresser
        $data = $kunde->addresser;

        // Check om addresser er fundet og hvis ikke, så returner '404 Ingen addresser fundet'
        if(!$data||count($data) == 0){
            return response('Ingen addresser fundet', 404);
        }

        // returner adresserne
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return Addresse|Response
     */
    public function foretrukken($id){
        // Find Kunde
        $kunde = Kunde::where('id',$id)->first();

        // Check om kunden er fundet og hvis ikke, så returner '404 Kunde ikke fundet'
        if(!$kunde){
            return response('Kunde ikke fundet', 404);
        }

        // Find Kundens addresser
        $data = $kunde->addresser->where('foretrukken',1)->first();

        // Check om addresse er fundet og hvis ikke, så returner '404 Ingen foretrukken addresse fundet'
        if(!$data){
            return response('Ingen foretrukken addresse fundet', 404);
        }

        // returner adressen
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @param  $id
     * @return Addresse|Response
     */
    public function kundeForetrukken($id,$addresse_id){
        // Find Kunde
        $kunde = Kunde::where('id',$id)->first();

        // Check om kunden er fundet og hvis ikke, så returner '404 Kunde ikke fundet'
        if(!$kunde){
            return response('Kunde ikke fundet', 404);
        }

        // Find Kundens addresser
        $addresser = $kunde->addresser()->where('foretrukken','=','1');
        $addresser->update(['foretrukken' => '0']);

        $data = Addresse::where('id',$addresse_id)->first();
        if(!$data){
            return response('Addresse ikke fundet', 404);
        }
        if($data->foretrukken == 1){
            $data->foretrukken = 0;
            $data->save();
        }

        //return response('Foretrukken Addresse opdateret', 200);

    }

    public function add($kunde_id,Request $request){
        $data = (new Addresse);
        $data->vej = $request->vej;
        $data->vej_nummer = $request->vej_nummer;
        $data->by_postnummer = $request->postnummer;
        $data->save();


        $result = DB::table('kundes_addresses')->insert(
            ['kunde_id' => $kunde_id, 'addresse_id' => $data->id]
        );

        if($result){
            return response('Addresse tilføjet til Kundens addresser', 200);
        }
        else{
            return response('Addresse kunne IKKE tilføjes til Kundens addresser', 500);
        }
    }

    public function remove(int $kunde_id, int $addresse_id, $delete = false){
        // Find Kunde
        $kunde = Kunde::where('id',$kunde_id)->first();

        // Check om kunden er fundet og hvis ikke, så returner '404 Kunde ikke fundet'
        if(!$kunde){
            return response('Kunde ikke fundet', 404);
        }

        // Find Addresse
        $addresse = Addresse::where('id',$addresse_id)->first();

        // Check om addresse er fundet og hvis ikke, så returner '404 Addresse ikke fundet'
        if(!$addresse){
            return response('Addresse ikke fundet', 404);
        }

        if($delete){
            $address_delete_result = DB::table('addresses')->where('id', '=', $addresse_id)->delete();
            if(!$address_delete_result){
                return response('Addresse kunne ikke slettes', 500);
            }
        }

        $result = DB::table('kundes_addresses')->where('addresse_id', '=', $addresse_id)->delete();
        if($result){
            if($delete){
                return response('Addresse fjernet fra Kundens addresser og slettet', 200);
            }
            else{
                return response('Addresse fjernet fra Kundens addresser', 200);
            }

        }
        else{
            return response('Addresse kunne IKKE fjernes fra Kundens addresser', 500);
        }
    }

    public function setForetrukken($id,$addresse_id){
        // Find Kundens addresser
        $kunde = Kunde::where('id','=',$id)->first();

        if(!$kunde){
            return response('Kunde ikke fundet', 404);
        }

        $addresse = Addresse::where('id','=',$addresse_id)->first();
        if(!$addresse){
            return response('Adresse ikke fundet', 404);
        }

        $addresser = $kunde->addresser;
        foreach($addresser as $cur_address){
            $cur_address->foretrukken = 0;
            $cur_address->save();
        }

        $addresse->foretrukken = 1;
        $addresse->save();

        return response('Adresse sat til foretrukken', 200);
    }

    public function removeForetrukken($id,$addresse_id){
        // Find Kundens addresser
        $addresse = Addresse::where('id','=',$addresse_id)->first();
        if(!$addresse){
            return response('Adresse ikke fundet', 404);
        }
        $addresse->foretrukken = 0;
        $addresse->save();

        return response('Adresse sat til ikke foretrukken', 200);
    }

    public function existing($kunde_id,$addresse_id){
        // Find Kunde
        $kunde = Kunde::where('id',$kunde_id)->first();

        // Check om kunden er fundet og hvis ikke, så returner '404 Kunde ikke fundet'
        if(!$kunde){
            return response('Kunde ikke fundet', 404);
        }

        // Find Addresse
        $addresse = Addresse::where('id',$addresse_id)->first();

        // Check om addresse er fundet og hvis ikke, så returner '404 Addresse ikke fundet'
        if(!$addresse){
            return response('Addresse ikke fundet', 404);
        }

        $result = DB::table('kundes_addresses')->insert(
            ['kunde_id' => $kunde_id, 'addresse_id' => $addresse_id]
        );

        if($result){
            return response('Addresse tilføjet til Kundens addresser', 200);
        }
        else{
            return response('Addresse kunne IKKE tilføjes til Kundens addresser', 500);
        }
    }



}
