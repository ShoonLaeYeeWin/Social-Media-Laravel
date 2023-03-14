<?php

namespace App\Http\Controllers;

use App\Contract\Service\User\UserServiceInterface;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Rules\CustomEmailValidation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserProfileRequest;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * User Service Interface
     */
    private $userServiceInterface;

    /**
     * class constructor
     */
    public function __construct(UserServiceInterface $userServiceInterface)
    {
        $this->userServiceInterface = $userServiceInterface;
    }

    /**
     * User Dashboard View
     *
     *@return mixed
     */
    public function dashboard()
    {
        $posts = $this->userServiceInterface->userView();
        return view('user.dashboard', compact('posts'));
    }

    /**
     * User Show Profile
     *
     * @return view
     */
    public function index()
    {
        return view('user.profile');
    }

    /**
     *User Edit Profile
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function edit($id)
    {
        $user = $this->userServiceInterface->editProfile($id);
        return view('user.profileEdit', compact('user'));
    }

    /**
     * User Update Profile
     *
     * @param UserProfileRequest $request,
     * @param integer $id
     *
     * @return mixed
     */
    public function update(UserProfileRequest $request, $id)
    {
        $this->userServiceInterface->updateProfile($request, $id);
        return redirect()->route('user.profile')
            ->with([
                'updateSuccess' => 'Your Profile Has Been Updated Successfully!'
            ]);
    }

    /**
     * User Post List
     *
     * @param PostRequest $request
     *
     * @return array
     */
    public function createPost(PostRequest $request)
    {
        $this->userServiceInterface->postList($request);
        return back();
    }
}
