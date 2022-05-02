<?php

namespace App\Http\Controllers;

use App\Models\Tokentarget;
use Illuminate\Http\Request;

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
