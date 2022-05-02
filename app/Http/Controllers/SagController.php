<?php

namespace App\Http\Controllers;

use App\Models\Sag;
use App\Models\Status;
use Illuminate\Http\Request;

/**
 * @OA\get(
 *      path="/sager",
 *      summary="Liste af Sager",
 *      description="",
 *      operationId="sagersList",
 *      tags={"Sager - Sager"},
 *      security={{"bearerAuth":{}}},
 *
 *      @OA\Response(
 *          response=200,
 *          description="success",
 *          @OA\JsonContent(
 *              @OA\Property(property="id", type="integer", example="1"),
 *              @OA\Property(property="navn", type="string", example="Bedste Fabrikant Navn"),
 *              @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *              @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              example={
 *                  {"id":1,"Navn":"Bedste Fabrikant Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *                   {"id":1,"Navn":"Bedste Fabrikant Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"},
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Sag"
 *      )
 * )
 *
 * @OA\post(
 *      path="/sager",
 *      summary="Opret en ny Sag",
 *      description="",
 *      operationId="sagersCreate",
 *      tags={"Sager - Sager"},
 *      @OA\Parameter(
 *              name="navn",
 *              description="Sag navnet",
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
 *          description="Sag oprettet"
 *      )
 * )
 *
 *
 * @OA\get(
 *      path="/sager/chip/{id}",
 *      summary="Find en specifik Sag ved hjælp af Chip ID",
 *      description="",
 *      operationId="sagersChipSpecific",
 *      tags={"Sager - Sager"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Sag ID'et",
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
 *              @OA\Property(property="navn", type="string", example="Bedste Fabrikant Navn"),
 *              @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *              @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              example={
 *                  {"id":1,"Navn":"Bedste Fabrikant Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"}
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Sag"
 *      )
 * )
 *
 * @OA\get(
 *      path="/sager/{id}",
 *      summary="Find en specifik Sag",
 *      description="",
 *      operationId="sagersSpecific",
 *      tags={"Sager - Sager"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Sag ID'et",
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
 *              @OA\Property(property="navn", type="string", example="Bedste Fabrikant Navn"),
 *              @OA\Property(property="created_at", type="string", format="datetime", example="31-03-2022 02:28:47"),
 *              @OA\Property(property="updated_at", type="string", format="datetime", example="31-03-2022 03:15:46"),
 *              example={
 *                  {"id":1,"Navn":"Bedste Fabrikant Navn","created_at":"31-03-2022 02:28:47","updated_at":"31-03-2022 03:15:46"}
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Sag"
 *      )
 * )
 *
 * @OA\put(
 *      path="/sager/{id}",
 *      summary="Opdater en Sag",
 *      description="",
 *      operationId="sagersUpdate",
 *      tags={"Sager - Sager"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Sag ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *              in="path",
 *              required=true
 *      ),
 *     @OA\Parameter(
 *              name="navn",
 *              description="Sag navnet",
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
 *      description="Sag Opdateret"
 *   )
 * )
 *
 * @OA\delete(
 *      path="/sager/{id}",
 *      summary="Slet en Sag",
 *      description="",
 *      operationId="sagersDelete",
 *      tags={"Sager - Sager"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Sag ID'et",
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
 *      description="Sag Slettet"
 *   )
 * )
 *
 * @OA\get(
 *      path="/sager/{id}/status",
 *      summary="Find en specifik Sag's status",
 *      description="",
 *      operationId="sagersStatus",
 *      tags={"Sager - Sager"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Sag ID'et",
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
 *              example="Bedste Status Navn"
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Sag"
 *      )
 * )
 *
 * @OA\put(
 *      path="/sager/{id}/status",
 *      summary="Opdater en specifik Sag's status",
 *      description="",
 *      operationId="sagersStatusUpdate",
 *      tags={"Sager - Sager"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Sag ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *              in="path",
 *              required=true
 *      ),
 *      @OA\Parameter(
 *              name="status_id",
 *              description="Status ID'et",
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
 *              example="Status Updateret"
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Sag"
 *      )
 * )
 * @OA\post(
 *      path="/sager/{id}/chip/{chip_id}",
 *      summary="Tilføj et chip id til en specifik Sag",
 *      description="",
 *      operationId="sagersChipAdd",
 *      tags={"Sager - Sager"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Sag ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *              in="path",
 *              required=true
 *      ),
 *      @OA\Parameter(
 *              name="chip_id",
 *              description="Chip ID'et",
 *              @OA\Schema(
 *                 type="string",
 *              ),
 *              in="path",
 *              required=true
 *      ),
 *      security={{"bearerAuth":{}}},
 *      @OA\Response(
 *          response=200,
 *          description="success",
 *          @OA\JsonContent(
 *              example="Chip Tilføjet"
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Sag"
 *      )
 * )
 *
 * @OA\put(
 *      path="/sager/{id}/chip/{chip_id}",
 *      summary="Opdater en specifik Sag's chip id",
 *      description="",
 *      operationId="sagersChipUpdate",
 *      tags={"Sager - Sager"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Sag ID'et",
 *              @OA\Schema(
 *                 type="integer",
 *                 minimum=1
 *              ),
 *              in="path",
 *              required=true
 *      ),
 *      @OA\Parameter(
 *              name="chip_id",
 *              description="Chip ID'et",
 *              @OA\Schema(
 *                 type="string",
 *              ),
 *              in="path",
 *              required=true
 *      ),
 *      security={{"bearerAuth":{}}},
 *      @OA\Response(
 *          response=200,
 *          description="success",
 *          @OA\JsonContent(
 *              example="Chip Updateret"
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Sag"
 *      )
 * )
 *
 *
 * @OA\delete(
 *      path="/sager/{id}/chip",
 *      summary="Fjern chip id fra en specifik Sag",
 *      description="",
 *      operationId="sagersChipDelete",
 *      tags={"Sager - Sager"},
 *      @OA\Parameter(
 *              name="id",
 *              description="Sag ID'et",
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
 *              example="Chip Fjernet"
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="Ingen Sag"
 *      )
 * )
 */

class SagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Sag::orderBy('id','ASC')
            ->with('kunde')
            ->with('medarbejder')
            ->with('produkt')
                ->with('produkt.model')
                    ->with('produkt.model.fabrikant')
                    ->with('produkt.model.type')
            ->with('sagstype')
            ->with('afhentningstype')
            ->with('status')
        ->get();
        if(count($data) == 0){
            return response('Ingen Sager', 404);
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
        $data = (new Sag());
        $data->kunde_id = $request->kunde_id;
        $data->medarbejder_id = $request->medarbejder_id;
        $data->produkt_id  = $request->produkt_id ;
        $data->status_id  = $request->status_id;
        $data->sagstype_id  = $request->sagstype_id ;
        $data->afhentningstype_id  = $request->afhentningstype_id ;
        $data->beskrivelse = $request->beskrivelse;
        $data->indlevering = now();
        $data->status_skift  = now();
        $data->chip_id = $request->chip_id;
        $data->save();

        return response('Sag oprettet', 202);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Sag::where('id','=',$id)
            ->with('kunde')
            ->with('medarbejder')
            ->with('produkt')
            ->with('produkt.model')
            ->with('produkt.model.fabrikant')
            ->with('produkt.model.type')
            ->with('sagstype')
            ->with('afhentningstype')
            ->with('status')
        ->first();
        if(!$data){
            return response('Sag ikke fundet', 404);
        }
        return $data;
    }


    /**
     * Display the specified resource.
     *
     * @param  string $chip_id
     * @return \Illuminate\Http\Response
     */
    public function byChip(string $chip_id)
    {
        $data = Sag::where('chip_id','=',$chip_id)
            ->with('kunde')
            ->with('medarbejder')
            ->with('produkt')
            ->with('produkt.model')
            ->with('produkt.model.fabrikant')
            ->with('produkt.model.type')
            ->with('sagstype')
            ->with('afhentningstype')
            ->with('status')
        ->first();
        if(!$data){
            return response('Sag ikke fundet', 404);
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
        $data = Sag::where('id','=',$id)->first();
        if(!$data){
            return response('Sag ikke fundet', 404);
        }

        $data->kunde_id = $request->kunde_id;
        $data->medarbejder_id = $request->medarbejder_id;
        $data->produkt_id  = $request->produkt_id ;
        $data->status_id  = $request->status_id;
        $data->sagstype_id  = $request->sagstype_id ;
        $data->afhentningstype_id  = $request->afhentningstype_id ;
        $data->beskrivelse = $request->beskrivelse;
        $data->indlevering = now();
        $data->status_skift  = now();
        $data->chip_id = $request->chip_id;
        $data->save();

        return response('Sag opdateret', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Sag::where('id','=',$id)->first();
        if(!$data){
            return response('Sag ikke fundet', 404);
        }
        $data->delete();

        return response('Sag slettet', 204);
    }

    public function getStatus($id){
        $data = Sag::where('id','=',$id)->first();
        if(!$data){
            return response('Sag ikke fundet', 404);
        }
        return $data->status->navn;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @param  int $status_id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus($id,int $status_id){
        $data = Sag::where('id','=',$id)->first();
        if(!$data){
            return response('Sag ikke fundet', 404);
        }

        $status = Status::where('id','=',$status_id)->first();
        if(!$status){
            return response('Status ikke fundet', 404);
        }

        $data->status_id = $status_id;
        $data->status_skift = now();
        $data->save();

        return response('Status Updateret', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @param  string $chip_id
     * @return \Illuminate\Http\Response
     */
    public function addChip($id,string $chip_id){
        $data = Sag::where('id','=',$id)->first();
        if(!$data){
            return response('Sag ikke fundet', 404);
        }

        $data->chip_id = $chip_id;
        $data->save();

        return response('Chip tilføjet', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @param  string $chip_id
     * @return \Illuminate\Http\Response
     */
    public function updateChip($id,string $chip_id){
        $data = Sag::where('id','=',$id)->first();
        if(!$data){
            return response('Sag ikke fundet', 404);
        }

        $data->chip_id = $chip_id;
        $data->save();

        return response('Chip fjernet', 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function removeChip($id){
        $data = Sag::where('id','=',$id)->first();
        if(!$data){
            return response('Sag ikke fundet', 404);
        }

        $data->chip_id = "";
        $data->save();

        return response('Chip fjernet');
    }

}
