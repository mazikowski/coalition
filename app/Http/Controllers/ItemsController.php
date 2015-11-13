<?php

namespace App\Http\Controllers;

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
        if ( ! File::exists('../items.json')) {
            File::put('../items.json', '{}');
        }

        $jsonFile = File::get('../items.json');
        $itemList = json_decode($jsonFile, true);

        $requestItem = json_decode($request->input('json'));

        echo $requestItem;

        $item = ['product' => , 'price', '5'];

        array_push($itemList, $item);

        File::put('../items.json', json_encode($itemList));
    }
}
