<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Mail\InformMail;
use App\Mail\NoticeMail;
use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function login(LoginRequest $request)
    {
        $input_data = Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]);
        if ($input_data) {
            return redirect('/admin/dashboard');
        } else {
            return back()->with('loginError', 'Your email and password are incorrect!');
        }
    }

    public function view()
    {
        $userCount = User::all()->count();
        return view('admin.dashboard', compact('userCount'));
    }

    public function show()
    {
        $userCount = User::all()->count();
        return view('admin.profile', compact('userCount'));
    }

    public function edit($id)
    {
        $user = Admin::where('id', $id)->first();
        $userCount = User::all()->count();
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

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function listUser(Request $request)
    {
        $users = User::when(request('name'), function ($query) {
            $query->where('name', 'like', '%' . request('name') . '%');
        })
            ->when(request('email'), function ($query) {
                $query->where('email', 'like', '%' . request('email') . '%');
            })
            ->when(in_array(request('userStatus'), [0, 1]), function ($query) {
                $query->where('status', 'like', '%' . request('userStatus') . '%');
            })
            ->withTrashed()
            ->orderBy('id', 'desc')->paginate(5);
        $userCount = User::all()->count();
        return view('admin.userList', compact('users', 'userCount'));
    }

    public function statusUpdate($id)
    {
        $userList = User::where('id', $id)->select('status')->get()->toArray();
        if ($userList[0]['status'] == '1') {
            $status = 0;
        } else {
            $status = 1;
        }
        $userStatus = User::where('id', $id)->update(['status' => $status]);
        if ($status == '0') {
            $user = User::where('id', $id)->first();
            Mail::to($user->email)
                ->send(new NoticeMail());
        } else {
            $user = User::where('id', $id)->first();
            Mail::to($user->email)
                ->send(new InformMail());
        }
        return back();
    }

    public function deleteUser($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Your Account User Has Been Deleted Successfully!']);
    }

    public function exportCsv()
    {
        $users = User::all();
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=users.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        );
        $columns = array('User Name', 'User Email', 'Address', 'Phone Number', 'Status', 'Date Of Birthday');
        $callback = function () use ($users, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($users as $user) {
                $row = [];
                $row['User Name'] = $user->name;
                $row['User Email'] = $user->email;
                $row['Address'] = $user->address;
                $row['Phone Number'] = "=\"" . $user->phone . "\"";
                if ($user->status == '1') {
                    $row['Status'] = 'Activated';
                } else {
                    $row['Status'] = 'Deactivated';
                }
                $row['Date Of Birthday'] = Carbon::parse($user->dob)->format('d-M-Y');
                fputcsv($file, $row);
            }
            fclose($file);
        };
        return Response::stream($callback, 200, $headers);
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
