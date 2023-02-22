<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class PostController extends Controller
{
    public function index()
    {
        return view('user.post');
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:10',
            'content' => 'required',
        ]);
        $data=$this->data($request);
        Post::create($data);
        return back()->with(['registerSuccess' => 'Your Post Has Been Created Successfully!']);
    }

    public function list(Request $request)
    {
        $posts=Post::all();
       return view('user.postList',compact('posts'));
    }

    public function delete($id)
    {
        $postDelete=Post::find($id)->delete();
        return back()->with(['deleteSuccess' => 'Your Post Has Been Deleted Successfully!']);
    }

    public function edit($id)
    {
        $postEdit=Post::where('id',$id)->first();
        return view('user.postEdit',compact('postEdit'));
    }

    public function update($id,Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:10',
            'content' => 'required',
        ]);
        $data=$this->data($request);
        $postUpdate=Post::where('id',$request->id)->update($data);
        return redirect('/user/list/post')->with(['updateSuccess' => 'Your Post Has Been Updated Successfully!']);
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

        $callback = function() use ($users, $columns) {
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
            'csv_file'=>'required',
        ]);
        $file = $request->file('csv_file');
        $csvData=file_get_contents($file);
        $rows=array_map('str_getcsv',explode("\n",$csvData));
        $header=array_shift($rows);
        foreach($rows as $row){
            $row=array_combine($header,$row);
            dd($row);
            Post::create([
                'title'=>$row['Post Title'],
                'content'=>$row['Post Content'],
                'user_id'=>$row['User'],
                'created_at'=>$row['Created_At'],
            ]);
        }
        // $handle = fopen($file, 'r');

        // // Loop through each row in the CSV file
        // while (($data = fgetcsv($handle, 1000, ',')) !== false) {
        //     // Insert the data into the database
        //     // Replace this with your own code to handle the imported data
        // }

        // fclose($handle);

        return redirect()->back();
    }

    private function data(Request $request)
    {
        return [
            'title'=>$request->title,
            'content'=>$request->content,
            'user_id'=>Auth::user()->id,
        ];
    }
}
