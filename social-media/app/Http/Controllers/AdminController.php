<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\ProfileUpdateRequest;
use App\Contract\Service\Admin\AdminServiceInterface;

class AdminController extends Controller
{
    /**
     * Admin Service Interface
     */
    private $adminServiceInterface;

    /**
     * class constructor
     */
    public function __construct(AdminServiceInterface $adminServiceInterface)
    {
        $this->adminServiceInterface = $adminServiceInterface;
    }

    /**
     *Admin Dashboard View
     *
     *@return integer
     */
    public function view()
    {
        $userCount = $this->adminServiceInterface->adminView();
        return view('admin.dashboard', compact('userCount'));
    }

    /**
     *Admin Show Profile
     *
     *@return integer
     */
    public function show()
    {
        $userCount = $this->adminServiceInterface->showProfile();
        return view('admin.profile', compact('userCount'));
    }

    /**
     *Admin Edit Profile
     *
     *@param integer $id
     *
     *@return mixed
     */
    public function edit($id)
    {
        $user = $this->adminServiceInterface->editProfile($id);
        return view('admin.profileEdit', compact('user'));
    }

    /**
     *Admin Update Profile
     *
     *@param ProfileUpdateRequest $request,
     *@param integer $id
     *
     *@return mixed
     */
    public function upgrade(ProfileUpdateRequest $request, $id)
    {
        $this->adminServiceInterface->updateProfile($request, $id);
        return redirect()->route('admin.profile')
                        ->with([
                            'updateSuccess' => 'Your Profile Has Been Updated Successfully!'
                        ]);
    }

    /**
     *Admin User List
     *
     *@param Request $request
     *
     *@return mixed
     */
    public function listUser(Request $request)
    {
        $user = $this->adminServiceInterface->userList($request);
        $users = $user['users'];
        $userCount = $this->adminServiceInterface->showProfile();
        return view('admin.userList', compact('users', 'userCount'));
    }

    /**
     *Admin User Status
     *
     *@param integer $id
     *
     *@return mixed
     */
    public function statusUpdate($id)
    {
        $this->adminServiceInterface->userStatus($id);
        return back();
    }

    /**
     *Admin Delete User
     *
     *@param integer $id
     *
     *@return mixed
     */
    public function deleteUser($id)
    {
        $this->adminServiceInterface->userDelete($id);
        return back()
            ->with([
                'deleteSuccess' => 'Your Account User Has Been Deleted Successfully!'
            ]);
    }

    /**
     *Admin export Csv
     *
     *@return mixed
     */
    public function exportCsv()
    {
        $data = $this->adminServiceInterface->userExport();
        $callback = $data['callback'];
        $headers = $data['headers'];
        return Response::stream($callback, 200, $headers);
    }
}
