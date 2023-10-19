<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corporation extends Model
{
    use HasFactory;

    protected $table = "corporations";

    protected $fillable = [
        'name',
        'type',
        'height'
    ];

    public static function store(Request $request){

        $corporation = Corporation::create($request->all());

        return response()->json(['message' => 'Corporation created', 'id' => $corporation->id], 201);
    }
}
