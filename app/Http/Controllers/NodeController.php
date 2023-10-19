<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Building;
use App\Models\Corporation;
use App\Models\Property;

class NodeController extends Controller
{
    //
    public function getData()
    {
        return response()->json(['message' => 'Data fetched successfully']);
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

    public function changeParent($type, $id, $toId) {

        switch ($type) {

            case 'building':

                $building = Building::find($id);

                $corporation = Corporation::find($toId);

                if(!$corporation) return response()->json(['message'=>"corporation not found"]);

                $building->parent_id = intval($toId);

                $building->save();

                return response()->json(['message'=>"building parent_id was updated to $toId"], 200);

                break;
                
            case 'property':

                $property = Property::find($id);

                $property->parent_id = intval($toId);

                $property->save();

                return response()->json(['message'=>"property parent_id was updated to $toId"], 200);

                break;

            default:
                return response()->json(['message'=>'bad request'], 400);
                break;
        }
    }
}
