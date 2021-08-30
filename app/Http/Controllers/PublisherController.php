<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function readPublisher($id){
        return Publisher::findOrFail($id);
    }

    public function createPublisher(Request $request){
        $data = $request->all();

        try {
            $publisher = new Publisher();
            $publisher-> name = $data['name'];
            $publisher-> description = $data['description'];
            $publisher-> image_url = $data['image_url'];

            //buat save ke database
            $publisher->save();
            $status = 'success';
            return response()->json(compact('status', 'publisher'), 200);

        } catch (\Throwable $th){
            //throw $th;
            $status = 'error';
            return response()->json(compact('status', 'th'), 200);
        }
    }

    public function updatePublisher($id, Request $request){
        $data = $request->all();

        try {
            $publisher = Publisher::findOrFail($id);

            $publisher-> name = $data['name'];
            $publisher-> description = $data['description'];
            $publisher-> image_url = $data['image_url'];

            $publisher->save();
            $status = 'success';
            return response()->json(compact('status', 'publisher'), 200);

        } catch (\Throwable $th){
            //throw $th;
            $status = 'error';
            return response()->json(compact('status', 'th'), 200);
        }
    }

    public function deletePublisher($id){
        $publisher = Publisher::findOrFail($id);
        $publisher->delete();

        $status = "delete success";
        return response()->json(compact('status'), 200);
    }
}
