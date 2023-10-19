<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = 'properties';

    protected $fillable = [
        'name',
        'height',
        'type',
        'parent_id',
        'monthly_rent'
    ];

    public static function store(Request $request){

        $property = Property::create($request->all());

        return response()->json(['message' => 'Property created', 'id' => $property->id], 201);
    }
}
