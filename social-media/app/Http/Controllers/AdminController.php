<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Admin;
use App\Mail\InformMail;
use App\Mail\NoticeMail;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Notifications\UserCreated;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\ProfileUpdateRequest;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function login(LoginRequest $request)
    {
        // dd(Auth::guard('admin'));
        $input_data = Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]);
        if ($input_data) {
            return redirect('/admin/dashboard');
        } else {
             return back()->with('loginError', 'Your email and password are incorrect!');
        }
    }

    public function view()
    {
        $userCount = Admin::all()->count();
        return view('admin.dashboard', compact('userCount'));
    }

    public function show()
    {
        $userCount = Admin::all()->count();
        return view('admin.profile', compact('userCount'));
    }

    public function edit($id)
    {
        $user = Admin::where('id', $id)->first();
        $userCount = Admin::all()->count();
        return view('admin.profileEdit', compact('user', 'userCount'));
    }

    public function upgrade(ProfileUpdateRequest $request, $id)
    {
        $data = $this->data($request);
        Admin::where('id', $id)->update($data);
        if ($request->hasFile('editPhoto')) {
            $imageName = uniqid() . $request->file('editPhoto')->getClientOriginalName();
            $request->file('editPhoto')->storeAs('public/', $imageName);
            $data = Admin::find($id);

            if ($data) {
                $data->photo = $imageName;
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

    // public function listUser(Request $request)
    // {
    //     $users = User::when(request('name'), function ($query) {
    //         $query->where('name', 'like', '%' . request('name') . '%');
    //     })
    //     ->when(request('email'), function ($query) {
    //         $query->where('email', 'like', '%' . request('email') . '%');
    //     })
    //     ->orderBy('id', 'desc')->paginate(5);
    //     $userCount = User::all()->count();
    //     return view('admin.userList', compact('users', 'userCount'));
    // }

    // public function statusUpdate($id)
    // {
    //     $userList = User::where('id', $id)->select('status')->get()->toArray();
    //     if ($userList[0]['status'] == '1') {
    //         $status = 0;
    //     } else {
    //         $status = 1;
    //     }
    //     $userStatus = User::where('id', $id)->update(['status' => $status]);
    //     if ($status == '0') {
    //         $user = User::where('id', $id)->first();
    //         $user->deleted_at = Carbon::now();
    //         $user->save();
    //         Mail::to($user->email)
    //         ->send(new NoticeMail());
    //     } else {
    //         $user = User::where('id', $id)->first();
    //         $user->deleted_at = null;
    //         $user->save();
    //         Mail::to($user->email)
    //         ->send(new InformMail());
    //     }
    //     return back();
    // }

    // public function deleteUser($id)
    // {
    //     User::find($id)->delete();
    //     return back()->with(['deleteSuccess' => 'Your Post Has Been Deleted Successfully!']);
    // }

    // public function exportCsv()
    // {
    //     $users = User::all();
    //     dd($users);
    //     $headers = array(
    //         "Content-type" => "text/csv",
    //         "Content-Disposition" => "attachment; filename=users.csv",
    //         "Pragma" => "no-cache",
    //         "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
    //         "Expires" => "0"
    //     );

    //     $columns = array('User Name', 'User Email', 'Address', 'Phone Number','Date Of Birthday');

    //     $callback = function () use ($users, $columns) {
    //         $file = fopen('php://output', 'w');
    //         fputcsv($file, $columns);

    //         foreach ($users as $user) {
    //             $row = [];
    //             $row['User Name'] = $user->name;
    //             $row['User Email'] = $user->email;
    //             $row['Address'] = $user->address;
    //             $row['Phone Number'] = $user->phone;
    //             $row['Date Of Birthday'] = $user->dob;

    //             fputcsv($file, $row);
    //         }

    //         fclose($file);
    //     };
    //     return Response::stream($callback, 200, $headers);
    // }

    private function loginData(LoginRequest $request)
    {
        return [
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
    }

    private function data(ProfileUpdateRequest $request)
    {
        return [
            'name' => $request->editName,
            'email' => $request->editEmail,
            'Address' => $request->editAddress,
            'photo' => $request->editPhoto,
            'dob' => $request->editDob,
            'phone' => $request->editPhone,
        ];
    }
}
