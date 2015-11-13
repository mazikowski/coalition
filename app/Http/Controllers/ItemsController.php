<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $json= File::get('../items.json');
        echo $json;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Create an empty items.json file if one does not exist
        if ( ! File::exists('../items.json')) {
            File::put('../items.json', '{}');
        }

        $jsonFile = File::get('../items.json');     // Read contents from items.json
        $itemList = json_decode($jsonFile, true);   // Decode into an assoc array

        $requestItem = json_decode($request->input('json'), true);     // Decode incoming json into an assoc array

        // Add datetime to item
        $dt = Carbon::now();
        $requestItem['datetime'] = $dt->toDateTimeString();

        array_push($itemList, $requestItem);   // Push newly added item onto the array

        File::put('../items.json', json_encode($itemList));     // Encode and write to items.json

        echo json_encode($requestItem);
    }

    /**
     * Updates an existing resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Create an empty items.json file if one does not exist
        if ( ! File::exists('../items.json')) {
            File::put('../items.json', '{}');
        }

        $jsonFile = File::get('../items.json');     // Read contents from items.json
        $itemList = json_decode($jsonFile, true);   // Decode into an assoc array

        $requestItem = json_decode($request->input('json'), true);     // Decode incoming json into an assoc array
        unset($requestItem['_token']);

        $dt1 = Carbon::parse($requestItem['datetime']);

        foreach ($itemList as $key => $val) {
            $dt2 = Carbon::parse($val['datetime']);
            if ($dt1->eq($dt2)) {
                $itemList[$key] = $requestItem;
            }
        }

        File::put('../items.json', json_encode($itemList));     // Encode and write to items.json

        echo json_encode($requestItem);
    }
}
