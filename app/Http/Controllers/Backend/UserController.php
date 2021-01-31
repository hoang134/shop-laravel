<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Constant;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $this->authorize('viewAny', User::class);
        $users = $this->userRepository->getAndPaginate(10);
        return view('backend.modules.users.index', compact('users'));
    }

    public function create()
    {
        $this->authorize('create', User::class);
        return view('backend.modules.users.add');

    }

    public function store(UserRequest $request)
    {
        $this->authorize('create', User::class);
        $data = $request->only('name', 'username', 'email', 'password');
        try {
            $this->userRepository->create($data);
            return redirect()->route('users.index')->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }

    }

    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        if (!$user) {
            return redirect()->route('users.index')->with('danger', __('messages.general.not_found'));
        }
        $this->authorize('update', $user);
        return view('backend.modules.users.edit', compact('user'));
    }

    public function update(UserRequest $request, $id)
    {
        $user = $this->userRepository->find($id);
        if (!$user) {
            return redirect()->route('users.index')->with('danger', __('messages.general.error'));
        }

        $this->authorize('update', $user);

        $data = $request->only('name', 'username', 'email');
        if (isset($request->password)) {
            $data['password'] = $request->password;
        }
        try {
            $this->userRepository->update($id, $data);
            return redirect()->route('users.index')->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }

    public function destroy($id)
    {
        $user = $this->userRepository->find($id);
        if (!$user) {
            return redirect()->route('users.index')->with('danger', __('messages.general.not_found'));
        }
        $this->authorize('delete', $user);

        try {
            $this->userRepository->update($id, ['status' => Constant::STATUS_DELETED]);
            return redirect()->back()->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }

    public function restore($id)
    {
        $this->authorize('restore', User::class);
        $user = $this->userRepository->find($id);
        if (!$user) {
            return redirect()->route('users.index')->with('danger', __('messages.general.not_found'));
        }

        try {
            $this->userRepository->update($id, ['status' => Constant::STATUS_ACTIVE]);
            return redirect()->back()->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }

    public function profile()
    {
        $user = auth()->user();
        $this->authorize('update', $user);
        return view('backend.modules.users.profile', compact('user'));
    }

    public function updateProfile(ProfileRequest $request)
    {
        $user = auth()->user();

        $this->authorize('update', $user);

        $data = $request->only('name', 'username', 'email');
        if (isset($request->password)) {
            $data['password'] = $request->password;
        }
        try {
            $this->userRepository->update($user->id, $data);
            return redirect()->back()->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }
}
