<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grooming;
use App\Models\Comment;

use View;
use DB;

class CommentController extends Controller
{
    public function infos($id)
    {
        $comments = DB::table('comments')
            ->join('groomings','groomings.id','comments.groomings_id')
            ->select('comments.name AS name', 'comments.email', 'comments.comment', 'comments.created_at')
            ->where('groomings.id', '=', "$id")
            ->orderBy('comments.created_at','DESC')
            ->get();

        $groomingservice = Grooming::findOrFail($id);
        $imge = DB::table('groomingimages')
                ->select('groomingimages.groomings_img')
                ->where('groomingimages.groomings_id', $id)
                ->pluck('groomings_img');
        return View::make('groomingtransaction.show',compact('comments','groomingservice', 'imge'));
    }

    public function create(Request $request){
        $commentss = app('profanityFilter')->filter($request->comment);
        $query = DB::table('comments')->insert([
            'created_at' => now(),
            'name' => $request->input('name'),
            'email'=> $request->input('email'),
            'groomings_id'=> $request->input('groomings_id'),
            'comment' => $commentss,
        ]);

        DB::commit();
        return redirect()->back()->with('status','Comment Added Successfully');
    }
}