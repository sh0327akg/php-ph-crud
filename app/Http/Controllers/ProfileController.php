<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use App\Repositories\User\UserRepositoryInterface;

class ProfileController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function show(User $user)
    {
        if(Auth::id() == $user->id){
            return redirect()->route('mypage');
        }
        $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(9, ['*'], 'posts_page');
        return view('profile.show', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public function mypage()
    {
        $user = auth()->user();
        $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(9, ['*'], 'posts_page');
        $liked_posts = $user->likes_posts()->orderBy('created_at', 'desc')->paginate(9, ['*'], 'liked_posts_page');
        return view('profile.mypage', [
            'user' => $user,
            'posts' => $posts,
            'liked_posts' => $liked_posts,
        ]);
    }

    public function ranking()
    {
       $users = $this->userRepository->getUserWithRanking();
       
       return view('profile.ranking', [
           'users' => $users,
       ]);
    }
}
