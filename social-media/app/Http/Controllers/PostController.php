<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class PostController extends Controller
{
    public function index()
    {
        return view('user.post');
    }

    public function create(PostRequest $request)
    {
            $data = $this->data($request);
            Post::create($data);
            return back()->with(['registerSuccess' => 'Your Post Has Been Created Successfully!']);
    }

    public function list(Request $request)
    {
        // $array = [0, 1];
        if ($request->content) {
            $posts = Post::where('user_id', Auth::user()->id)->where('content', 'like', '%' . $request->content .
            '%')->get();
        } else {
            $posts = Post::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(5);
        }
        return view('user.postList', compact('posts'));
    }

    public function delete($id)
    {
            $postDelete = Post::find($id)->delete();
            return back()->with(['deleteSuccess' => 'Your Post Has Been Deleted Successfully!']);
    }

    public function edit($id)
    {
            $postEdit = Post::where('id', $id)->first();
            return view('user.postEdit', compact('postEdit'));
    }

    public function update($id, PostRequest $request)
    {
            $data = $this->data($request);
            Post::where('id', $request->id)->update($data);
            return redirect('/user/list/post')->with(['updateSuccess' => 'Your Post Has Been Updated Successfully!']);
    }

    public function statusUpdate($id)
    {
        $postList = Post::where('id', $id)->select('status')->get()->toArray();
        if ($postList[0]['status'] == '1') {
            $status = 0;
        } else {
            $status = 1;
        }
        $postStatus = Post::where('id', $id)->update(['status' => $status]);
        return back();
    }

    public function exportCsv()
    {
            $users = User::join('posts', 'posts.user_id', '=', 'users.id')
            ->select(['users.id','users.name','users.photo', 'posts.*',])
            ->get();
            $headers = array(
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=posts.csv",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            $columns = array('Post Title', 'Post Content','User','Created_At',);

            $callback = function () use ($users, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach ($users as $user) {
                    $row = [];
                    $row['Post Title'] = $user->title;
                    $row['Post Content'] = $user->content;
                    $row['User'] = $user->name;
                    $row['Created_At'] = $user->created_at;

                    fputcsv($file, $row);
                }

                fclose($file);
            };
            return Response::stream($callback, 200, $headers);
    }

    public function importCsv(Request $request)
    {
            $validated = $request->validate([
                'csv_file' => 'required',
            ]);
            $file = $request->file('csv_file')->getRealPath();
            $data = array_map('str_getcsv', file($file));
            $header = array_shift($data);
        foreach ($data as $row) {
                $row = array_combine($header, $row);
                $posts = User::select(['users.id','users.name'])
                ->where('users.name', $row['User'])
                ->get()->toArray();
                $postTitle = $row['Post Title'];
                $content = $row['Post Content'];
                $user = $row['User'];
                $createdAt = $row['Created_At'];
            if (count($posts) > 0) {
                foreach ($posts as $post) {
                    if ($user == $post['name']) {
                            Post::create([
                                'title' => $postTitle,
                                'content' => $content,
                                'user_id' => $post['id'],
                            ]);
                    }
                }
            }
            return redirect()->back();
        }
    }

    private function data(PostRequest $request)
    {
        return [
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::user()->id,
        ];
    }
}
