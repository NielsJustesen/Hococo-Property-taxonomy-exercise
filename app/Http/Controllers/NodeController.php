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


    private function saveNewParent($node, $type, $newParentId) {

        $node->parent_id = intval($newParentId);

        $node->save();

        return response()->json(['message'=>"$type parent_id was updated to $newParentId"], 200);
    }

    public function changeParent(Request $request, $id) {

        $type = strtoLower($request->get('type'));

        $id = $request->get('id');

        $parent_id = $request->get('parent_id');

        switch ($type) {

            case 'building':

                $building = Building::find($id);

                $corporation = Corporation::find($parent_id);

                if(!$corporation) return response()->json(['message'=>"corporation not found"], 404);

                return $this->saveNewParent($building, $type, $parent_id);

                break;
                
            case 'property':
                
                $property = Property::find($id);

                $building = Building::find($parent_id);

                if(!$building) return response()->json(['message'=>"building not found"], 404);

                return $this->saveNewParent($property, $type, $parent_id);

                break;

            default:
                return response()->json(['message'=>'bad request'], 400);
                break;
        }
    }

    public function getAvailableParents($type, $id){

        switch (strToLower($type)) {
            case 'building':
                return Corporation::all();
                break;
            case 'property':
                return Building::all();
                break;
        }
    }
}
