<?php

namespace App\Contract\Dao\User;

interface UserDaoInterface
{
    /**
     *User Dashboard View
     *
     *@return mixed
     */
    public function userView();

    /**
     *User Edit Profile
     *
     *@param integer $id
     *
     *@return view
     */
    public function editProfile($id);

    /**
     * User Update Profile
     *
     * @param UserProfileRequest $request,
     * @param integer $id
     *
     * @return mixed
     */
    public function updateProfile($request, $id);

    /**
     * User Post List
     *
     * @param PostRequest $request
     *
     * @return array
     */
    public function postList($request);
}
