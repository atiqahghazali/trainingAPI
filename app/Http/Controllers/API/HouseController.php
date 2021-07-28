<?php

namespace App\Http\Controllers\API;

use App\Models\House;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HouseController extends Controller
{
    public function index(Request $request)
    {
        if($request->search){
            $houses = House::where('type','LIKE','%'.$request->search.'%')->paginate();
        }else{
            $houses = House::paginate();
        }
        //query all Houses from DB using Model House.php
        
        //return to json
        return response()->json([
            'success' => true,
            'message' => 'Successsfully fetch all Houses',
            'data' => $houses,
        ]);
    }

    public function store (Request $request)
    {
        // validation
        // $request->validate([
        //     'name' => 'min:5',
        //     'email' => 'required|unique:Houses',
        //     'password' => 'min:5'
        // ]);
    
        //store to DB using House.php
        // name,email,password
        $house = House::create([
            'type' => $request->type,
            'price' => $request->price
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Successsfully store house',
            'data' => $house,
        ]);
    }

    public function show(House $house){

        return response()->json([
            'success' => true,
            'message' => 'Successsfully retrieved',
            'data' => $house
        ]);

    }

    public function update(Request $request,House $house){
        $house->update([
            'type' => $request->type,
            'price' => $request->price
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Successsfully updated'
        ]);

    }

    public function delete(House $house){
        $house->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successsfully deleted'
        ]);

    }
}
