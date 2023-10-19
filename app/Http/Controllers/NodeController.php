<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Building;
use App\Models\Corporation;
use App\Models\Property;

class NodeController extends Controller
{
    //
    public function getCorporations()
    {
        $corporations = Corporation::all();
        return $corporations;
    }

    public function store(Request $request) {

        $type = $request->get('type');

        switch (strtolower($type)) {

            case 'corporation':
                return Corporation::store($request);
                break;

            case 'building':
                return Building::store($request);
                break;

            case 'property':
                return Property::store($request);
                break;

            default:
                return response()->json(['message'=>'invalid type']);
                break;
        }
    }

    public function showChildren($type, $id) {

        $result = null;

        switch (strtolower($type)) {

            case 'corporation':
                $result = Building::where('parent_id', $id);
                break;
                
            case 'building':
                $result = Property::where('parent_id', $id);
                break;
            
            default:
                $result = response()->json(['message'=>'bad request'], 400);
                return $result;
                break;
        }
        return $result->get();
    }

    public function changeParent(Request $request, $id) {

        $type = strtoLower($request->get('type'));

        $parent_id = $request->get('parent_id');

        switch ($type) {

            case 'building':

                $building = Building::find($request->get('id'));

                $corporation = Corporation::find($parent_id);

                if(!$corporation) return response()->json(['message'=>"corporation not found"]);

                $building->parent_id = intval($parent_id);

                $building->save();

                return response()->json(['message'=>"building parent_id was updated to $parent_id"], 200);

                break;
                
            case 'property':
                
                $property = Property::find($request->get('id'));

                $property->parent_id = intval($parent_id);

                $property->save();

                return response()->json(['message'=>"property parent_id was updated to $parent_id"], 200);

                break;

            default:
                return response()->json(['message'=>'bad request'], 400);
                break;
        }
    }
}
