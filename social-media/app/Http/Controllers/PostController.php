<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
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
        return redirect()->route('post.listPost')
                        ->with([
                            'registerSuccess' => 'Your Post Has Been Created Successfully!'
                        ]);
    }

    public function list(Request $request)
    {
        $posts = Post::where('user_id', Auth::user()->id)
                ->when(request('content'), function ($query) {
                    $query->where('content', 'like', '%' . request('content') . '%');
                })
                ->when(in_array(request('postStatus'), [0, 1]), function ($query) {
                    $query->where('status', 'like', '%' . request('postStatus') . '%');
                })
                ->orderBy('id', 'desc')->paginate(5);
        return view('user.postList', compact('posts'));
    }

    public function delete($id)
    {
        $postDelete = Post::where('id', $id)->delete();
        return back()
            ->with([
                'deleteSuccess' => 'Your Post Has Been Deleted Successfully!'
            ]);
    }

    public function edit($id)
    {
        $postEdit = Post::where('id', $id)->firstOrFail();
        return view('user.postEdit', compact('postEdit'));
    }

    public function update($id, PostRequest $request)
    {
        $data = $this->data($request);
        Post::where('id', $id)->update($data);
        return redirect()->route('post.updatePost')
            ->with([
                'updateSuccess' => 'Your Post Has Been Updated Successfully!'
            ]);
    }

    public function statusUpdate($id)
    {
        $postList = Post::where('id', $id)->select('status')->firstOrFail();
        if ($postList['status'] == '1') {
            $status = 0;
        }
        if ($postList['status'] == '0') {
            $status = 1;
        }
        Post::where('id', $id)->update(['status' => $status]);
        return back();
    }

    public function exportCsv($id)
    {
        $users = User::join('posts', 'posts.user_id', '=', 'users.id')
                ->select(['users.id', 'users.photo', 'posts.*'])
                ->where('users.id', $id)
                ->whereNull('posts.deleted_at')
                ->get();
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=posts.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        );
        $columns = array('Post Title', 'Post Content', 'Status', 'Created_At');
        $callback = function () use ($users, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($users as $user) {
                $row = [];
                $row['Post Title'] = $user->title;
                $row['Post Content'] = $user->content;
                if ($user->status == '1') {
                    $row['Status'] = 'Active';
                } else {
                    $row['Status'] = 'Inactive';
                }
                $row['Created_At'] = $user->created_at->format('Y-M-d');
                fputcsv($file, $row);
            }
            fclose($file);
        };
        return Response::stream($callback, 200, $headers);
    }

    public function importCsv(Request $request, $id)
    {
        $request->validate([
            'csv_file' => 'required',
        ]);
        $file = $request->file('csv_file')->getRealPath();
        $data = array_map('str_getcsv', file($file));
        $header = array_shift($data);
        foreach ($data as $row) {
            $row = array_combine($header, $row);
            $postTitle = $row['Post Title'];
            $content = $row['Post Content'];
            if (Auth::user()->id) {
                DB::table('posts')->insert([
                    'title' => $postTitle,
                    'content' => $content,
                    'user_id' => Auth::user()->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        return back();
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
