<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;

class CommentsController extends Controller
{
    public function index()
    {
        return view('admin/comment/index')->with('comments',Comment::all());
    }

    public function edit(Request $request,$id)
    {
        return view('admin/comment/edit')->with('comments',Comment::find($id));
    }

    public function update(Request $request,$id)
    {
        $comment = Comment::findOrFail($id);
        $comment->nickname = $request->get('nickname');
        $comment->content = $request->get('content');
        $comment->email = $request->get('email');
        $comment->website = $request->get('website');
        $comment->article_id = $request->get('article_id');

        if ($comment->save()) {
            return redirect('admin/comments');
        } else {
            return redirect()->back()->withInput()->withErrors('评论修改失败！');
        }
    }

    public function destroy($id)
    {
        Comment::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功！');
    }
}
