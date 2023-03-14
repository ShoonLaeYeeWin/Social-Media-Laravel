<?php

namespace App\Service\Admin;

use App\Mail\InformMail;
use App\Mail\NoticeMail;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Mail;
use App\Contract\Dao\Admin\AdminDaoInterface;
use App\Contract\Service\Admin\AdminServiceInterface;

class AdminService implements AdminServiceInterface
{
    /**
     * User Dao Interface
     */
    private $adminDaoInterface;

    /**
     * class constructor
     */
    public function __construct(AdminDaoInterface $adminDaoInterface)
    {
        $this->adminDaoInterface = $adminDaoInterface;
    }

    /**
     *Admin action Login
     *
     *@param LoginRequest
     *
     * @return mixed
     */
    public function adminView()
    {
        return $this->adminDaoInterface->adminView();
    }

    /**
     *Admin Show Profile
     *
     * @return mixed
     */
    public function showProfile()
    {
        return $this->adminDaoInterface->showProfile();
    }

    /**
     *Admin Edit Profile
     *
     *@param integer $id
     *
     *@return mixed
     */
    public function editProfile($id)
    {
        return $this->adminDaoInterface->editProfile($id);
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
        return $this->adminDaoInterface->updateProfile($request, $id);
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
        return $this->adminDaoInterface->userList($request);
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
        $user = $this->adminDaoInterface->userStatus($id);
        $email = Mail::to($user->email);
        ($user->status == '0') ? $email->send(new InformMail()) : $email->send(new NoticeMail());
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
        return $this->adminDaoInterface->userStatus($id);
    }

    /**
     *Admin export Csv
     *
     *@return mixed
     */
    public function userExport()
    {
        return $this->adminDaoInterface->userExport();
    }
}
