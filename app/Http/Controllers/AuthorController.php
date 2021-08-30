<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function readAuthor($id){
        return Authors::findOrFail($id);
    }

    public function createAuthor(Request $request){
        $data = $request->all();

        try {
            $author = new Authors();
            $author-> name = $data['name'];
            $author-> description = $data['description'];
            $author-> image_url = $data['image_url'];

            //buat save ke database
            $author->save();
            $status = 'success';
            return response()->json(compact('status', 'author'), 200);

        } catch (\Throwable $th){
            //throw $th;
            $status = 'error';
            return response()->json(compact('status', 'th'), 401);
        }
    }

    public function updateAuthor($id, Request $request){
        $data = $request->all();

        try {
            $author = Authors::findOrFail($id);

            $author-> name = $data['name'];
            $author-> description = $data['description'];
            $author-> image_url = $data['image_url'];

            $author->save();
            $status = 'success';
            return response()->json(compact('status', 'author'), 200);

        } catch (\Throwable $th){
            //throw $th;
            $status = 'error';
            return response()->json(compact('status', 'th'), 401);
        }
    }

    public function deleteAuthor($id){
        $author = Authors::findOrFail($id);
        $author->delete();

        $status = "delete success";
        return response()->json(compact('status'), 200);
    }
}
