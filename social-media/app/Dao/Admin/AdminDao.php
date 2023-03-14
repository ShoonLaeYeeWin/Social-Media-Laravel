<?php

namespace App\Dao\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Contract\Dao\Admin\AdminDaoInterface;

class AdminDao implements AdminDaoInterface
{
    /**
     *Admin Dashboard View
     *
     *@return mixed
     */
    public function adminView(): int
    {
        $userCount = User::all()->count();
        return $userCount;
    }

    /**
     *Admin Show Profile
     *
     *@return mixed
     */
    public function showProfile(): int
    {
        $userCount = User::all()->count();
        return $userCount;
    }

    /**
     *Admin Edit Profile
     *
     *@param integer $id
     *
     *@return mixed
     */
    public function editProfile($id): mixed
    {
        $user = Admin::where('id', $id)->firstOrFail();
        $userCount = User::all()->count();
        return compact('user', 'userCount');
    }

    /**
     *Admin Update Profile
     *
     *@param ProfileUpdateRequest $request,
     *@param integer $id
     *
     *@return mixed
     */
    public function updateProfile($request, $id)
    {
        $data = [
            'name' => $request->editName,
            'email' => $request->editEmail,
            'Address' => $request->editAddress,
            'dob' => $request->editDob,
            'phone' => $request->editPhone,
        ];
        if ($request->hasFile('editPhoto')) {
            $imageName = uniqid() . $request->file('editPhoto')->getClientOriginalName();
            $request->file('editPhoto')->storeAs('public/', $imageName);
            $data['photo'] = $imageName;
        }
        $updateData = Admin::where('id', $id)->update($data);
        return $updateData;
    }

    /**
     *Admin User List
     *
     *@param Request $request
     *
     *@return mixed
     */
    public function userList($request)
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
        return compact('users');
    }

    /**
     *Admin User Status
     *
     *@param integer $id
     *
     *@return mixed
     */
    public function userStatus($id)
    {
        $userList = User::where('id', $id)->select('email', 'status')->firstOrFail();
        if ($userList['status'] == '1') {
            $status = 0;
        } else {
            $status = 1;
        }
        User::where('id', $id)->update(['status' => $status]);
        return $userList;
    }

    /**
     *Admin Delete User
     *
     *@param integer $id
     *
     *@return mixed
     */
    public function userDelete($id)
    {
        return User::where('id', $id)->delete();
    }

    /**
     *Admin export Csv
     *
     *@return mixed
     */
    public function userExport()
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
        return compact('headers', 'callback');
    }
}
