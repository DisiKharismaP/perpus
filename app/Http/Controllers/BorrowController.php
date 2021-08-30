<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function readBorrrow($id){
        return Borrow::findOrFail($id);
    }

    public function createBorrow(Request $request){
        $data = $request->all();

        try {
            $borrow = new Borrow();
            $borrow-> author_id = $data['author_id'];
            $borrow-> book_id = $data['book_id'];
            $borrow-> periode = $data['periode'];
            $borrow-> deadline = $data['deadline'];
            $borrow-> return = $data['return'];

            //buat save ke database
            $borrow->save();
            $status = 'success';
            return response()->json(compact('status', 'borrow'), 200);

        } catch (\Throwable $th){
            //throw $th;
            $status = 'error';
            return response()->json(compact('status', 'th'), 401);
        }
    }

    public function updateBorrow($id, Request $request){
        $data = $request->all();

        try {
            $borrow = Borrow::findOrFail($id);

            $borrow-> author_id = $data['author_id'];
            $borrow-> book_id = $data['book_id'];
            $borrow-> periode = $data['periode'];
            $borrow-> deadline = $data['deadline'];
            $borrow-> return = $data['return'];

            $borrow->save();
            $status = 'success';
            return response()->json(compact('status', 'borrow'), 200);

        } catch (\Throwable $th){
            //throw $th;
            $status = 'error';
            return response()->json(compact('status', 'th'), 401);
        }
    }

    public function deleteBorrow($id){
        $author = Borrow::findOrFail($id);
        $author->delete();

        $status = "delete success";
        return response()->json(compact('status'), 200);
    }

}
