<?php

namespace App\Service\User;

use App\Contract\Dao\User\UserDaoInterface;
use App\Contract\Service\User\UserServiceInterface;

class UserService implements UserServiceInterface
{
    /**
     *User Dao Interface
     */
    private $userDaoInterface;

    /**
     * class constructor
     */
    public function __construct(UserDaoInterface $userDaoInterface)
    {
        $this->userDaoInterface = $userDaoInterface;
    }

    /**
     *User Dashboard View
     *
     *@return mixed
     */
    public function userView()
    {
        return $this->userDaoInterface->userView();
    }

    /**
     *User Edit Profile
     *
     *@param integer $id
     *
     *@return view
     */
    public function editProfile($id)
    {
        return $this->userDaoInterface->editProfile($id);
    }

    /**
     * User Update Profile
     *
     * @param UserProfileRequest $request,
     * @param integer $id
     *
     * @return mixed
     */
    public function updateProfile($request, $id)
    {
        return $this->userDaoInterface->updateProfile($request, $id);
    }

    /**
     * User Post List
     *
     * @param PostRequest $request
     *
     * @return array
     */
    public function postList($request)
    {
        return $this->userDaoInterface->postList($request);
    }
}
