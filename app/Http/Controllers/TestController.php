<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    function index(){
        // dd(123);
     return  $book = Book::all();
    //    dd($book);
    }
    function cond(Request $request){

        if($request->name == null){
            $response = ['success'=>false,'msg'=>'name field is required'];
            return response()->json($response);
        }

        if($request->city == null){

            $response = ['success'=>false,'msg'=>'city field is required'];
            return response()->json($response);
        }

        $book = new Book();
        $book->name = $request->name;
        $book->city = $request->city;

        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            // dd($file);
            $extenstion = $file->getClientOriginalExtension();
            // dd($extenstion);
            $filename = time().'.'.$extenstion;
            $file->move('api/image', $filename);
            $book->image = $filename;
        }

        $book->save();

        $response = ['success'=>true,'msg'=>$book];
        return response()->json($response);

}
    function del(Request $request){

        $userId = User::find($request->user_id);
        // dd( $userId);

        if($userId){
         $book = Book::find($request->book_id);
         if(!$book)
         {
            $response = ['success'=>true,'msg'=>'book is not Exist'];
            return response()->json($response);
         }
         $book->delete();
         $response = ['success'=>true,'msg'=>'book is deleted'];
         return response()->json($response);


        }else{
            return  'user not found';
        }
   }

    function update(Request $request){
        $userId = User::find($request->user_id);
        // dd($userId);

        if($userId){
           $book = Book::find($request->book_id);

           if($book == null){

               $response = ['success'=>'error','book'=>'This book Id is not exist'];

               return response()->json($response);
            }

            $image = null;
            if($request->hasfile('image'))
            {
                $file = $request->file('image');
                // dd($file);
                $extenstion = $file->getClientOriginalExtension();
                // dd($extenstion);
                $filename = time().'.'.$extenstion;
                $file->move('api/image', $filename);
                $image = $filename;
                // dd( $image);
            }
            else{
                $image = $book->image;
            }
            //    dd($image);
            $book->update([

                // dd('in');


                'name' => $request->name,
                'city' => $request->city,
                'image' => $image,

            ]);

            return response()->json(['msg'=>'books updated successfully']);

        }

  

     }
}
