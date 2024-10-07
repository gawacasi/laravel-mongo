<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client as MongoDBClient;

class MainController extends Controller
{
    public function index()
    {
        try {
            $client = new MongoDBClient(config('database.connections.mongodb.host'));
            $db = $client->selectDatabase('mongo-clash');
            return response()->json(['status' => 'Connected to MongoDB']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
