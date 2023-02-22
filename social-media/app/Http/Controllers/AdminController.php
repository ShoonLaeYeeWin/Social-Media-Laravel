<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\LoginRequest;
use App\Rules\CustomEmailValidation;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ProfileUpdateRequest;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function login(LoginRequest $request)
    {
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $user_data = array(
            $fieldType => $request->email,
            'password'  => $request->password,
        );
        $input_data = Auth::attempt($user_data);
        if ($input_data) {
            if (Auth::user()->type == 0) {
                return redirect('/admin/dashboard');
            }
        } else {
            return back()->with('loginError', 'Your email and password are incorrect!');
        }
    }

    public function view()
    {
        return view('admin.dashboard');
    }

    public function show()
    {
        if(Auth::user()->type == 0)
        {
            $user=Auth::user();
        }
        return view('admin.profile',compact('user'));
    }

    public function edit($id)
    {
        $user=User::where('id',$id)->first();
        return view('admin.profileEdit',compact('user'));
    }

    public function upgrade(Request $request, $id)
    {
        $this->profileUpdateRequest($request);
        $data=$this->data($request);
        User::where('id',$id)->update($data);
        if($request->hasFile('editPhoto')){
            $imageName = uniqid().$request->file('editPhoto')->getClientOriginalName();
            $request->file('editPhoto')->storeAs('public/', $imageName);
            $data = User::find($id);

            if($data){
                $data->photo=$imageName;
            }
        }
        $data->update();
        return redirect('/admin/profile')->with(['updateSuccess' => 'Your Profile Has Been Updated Successfully!']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function listPost()
    {
        $posts=Post::orderBy('id', 'desc')->paginate(4);
        return view('admin.postList',compact('posts'));
    }

    public function editPost($id)
    {
        $post=Post::where('id',$id)->first();
        return view('admin.postEdit',compact('post'));
    }

    public function updatePost($id,Request $request)
    {
        $request->validate([
            'title' => 'required|min:10',
            'content' => 'required',
        ]);
        $postData=$this->postData($request);
        Post::where('id',$id)->update($postData);
        return redirect('/admin/list/post')->with(['updateSuccess' => 'Your Post Has Been Updated Successfully!']);

    }

    public function deletePost($id)
    {
        Post::find($id)->delete();
        return back()->with(['deleteSuccess' => 'Your Post Has Been Deleted Successfully!']);
    }

    public function listUser()
    {
        $users=Auth::user()->orderBy('id', 'desc')->paginate(5);
        return view('admin.userList',compact('users'));
    }

    public function deleteUser($id)
    {
        User::find($id)->delete();
        return back()->with(['deleteSuccess' => 'Your Post Has Been Deleted Successfully!']);
    }

    public function exportCsv()
    {
        $users = User::all();

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=users.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('User Name', 'User Email', 'Address', 'Phone Number','Date Of Birthday');

        $callback = function() use ($users, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($users as $user) {
                $row = [];
                $row['User Name'] = $user->name;
                $row['User Email'] = $user->email;
                $row['Address'] = $user->address;
                $row['Phone Number'] = $user->phone;
                $row['Date Of Birthday'] = $user->dob;

                fputcsv($file, $row);
            }

            fclose($file);
        };
        return Response::stream($callback, 200, $headers);
    }

    private function postData(Request $request)
    {
        return [
            'title'=>$request->title,
            'content'=>$request->content,
        ];
    }

    private function data(Request $request)
    {
        return [
            'name' => $request->editName,
            'email' => $request->editEmail,
            'Address' => $request->editAddress,
            'photo'=>$request->editPhoto,
            'dob'=>$request->editDob,
            'phone'=>$request->editPhone,
        ];
    }

    private function profileUpdateRequest($request)
    {
        $todayDate = date('m/d/Y');
        $validation= [
            'editName' => 'required',
            'editEmail' => ['required','unique:users,email,'.Auth::user()->id,new CustomEmailValidation()],
            'editAddress' => 'required',
            'editPhoto'=>'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'editDob'=>'required|date|before:'.$todayDate,
            'editPhone' => 'required|digits:11',
        ];
        Validator::make($request->all(), $validation)->validate();
    }
}
