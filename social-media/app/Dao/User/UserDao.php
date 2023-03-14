<?php

namespace App\Dao\User;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Contract\Dao\User\UserDaoInterface;

class UserDao implements UserDaoInterface
{
    /**
     *User Dashboard View
     *
     *@return mixed
     */
    public function userView()
    {
        $posts = User::join('posts', 'posts.user_id', '=', 'users.id')
                    ->select(['users.id', 'users.name', 'users.photo', 'posts.*',])
                    ->orderBy('posts.id', 'desc')->paginate(9);
        return $posts;
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
        $user = User::where('id', $id)->firstOrFail();
        return $user;
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
        $updateData = User::where('id', $id)->update($data);
        return $updateData;
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
        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::user()->id,
        ];
        $listData = Post::create($data);
        return $listData;
    }
}
