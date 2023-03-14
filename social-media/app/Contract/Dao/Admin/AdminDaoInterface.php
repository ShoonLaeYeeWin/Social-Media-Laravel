<?php

namespace App\Contract\Dao\Admin;

interface AdminDaoInterface
{
    /**
     *Admin Dashboard View
     *
     *@return mixed
     */
    public function adminView();

    /**
     *Admin Show Profile
     *
     *@return mixed
     */
    public function showProfile();

    /**
     *Admin Edit Profile
     *
     *@param integer $id
     *
     *@return mixed
     */
    public function editProfile($id);

    /**
     *Admin Update Profile
     *
     *@param ProfileUpdateRequest $request,
     *@param integer $id
     *
     *@return mixed
     */
    public function updateProfile($request, $id);

    /**
     *Admin User List
     *
     *@param Request $request
     *
     *@return mixed
     */
    public function userList($request);

    /**
     *Admin User Status
     *
     *@param integer $id
     *
     *@return mixed
     */
    public function userStatus($id);

    /**
     *Admin Delete User
     *
     *@param integer $id
     *
     *@return mixed
     */
    public function userDelete($id);

    /**
     *Admin export Csv
     *
     *@return mixed
     */
    public function userExport();
}
