<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\UserService;
use App\Http\Requests\Web\UserRequest;
use App\Http\Models\AuthItem;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $items = $this->userService->getList($request)->paginate();

        return view('user.index', compact('items'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(UserRequest $request)
    {
        $input = $request->all();
        $this->repo->create($input);

        return redirect('users')->with('success', trans('message.create_successful'));
    }

    public function show($id)
    {
        $model = $this->userService->getDetail($id);
        $roles = AuthItem::listRoles();

        return view('user.show', compact('model', 'roles'));
    }

    public function update(UserRequest $request, $id)
    {
        $this->userService->update($request->all(), $id);

        return redirect('users')->with('success', trans('message.update_successful'));
    }

    public function destroy($id)
    {
        $this->userService->delete($id);

        return redirect('users')->with('success', trans('message.delete_successful'));
    }
}
