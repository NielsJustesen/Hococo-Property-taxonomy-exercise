<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    protected $table = 'buildings';

    protected $fillable = [
        'name',
        'height',
        'type',
        'parent_id',
        'zip_code'
    ];

    public static function store(Request $request){

        $building = Building::create($request->all());

        return response()->json(['message' => 'Building created', 'id' => $building->id], 201);
    }
}
