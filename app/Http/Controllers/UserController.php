<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\User;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Auth;
    use App\Services\UserService;
    use App\Http\Requests\CreateUserRequest;
    use App\Http\Requests\EditUserRequest;

    class UserController extends Controller
    {
        public function index(UserService $UserService)
        {
            $users = $UserService->allUser();

            return view('user.list', compact('users'));
        }

        public function create()
        {
            return view('user.create');
        }

        public function store(CreateUserRequest $request, UserService $UserService)
        {
            $UserService->storeUser($request);

            return redirect()->route('user.list')->with('success', 'Thêm mới người dùng thành công.' );
        }

        public function edit($id, UserService $UserService)
        {
            $users = $UserService->findId($id);

            return view('user.edit', compact('users'));
        }

        public function update(EditUserRequest $request, $id, UserService $UserService)
        {
            $UserService->findId($id);
            $UserService->updateUser($request, $id);

            return back()->with('success', 'Sửa thông tin người dùng thành công.');
        }

        public function delete($id, UserService $UserService)
        {   
            $UserService->findId($id);
            $UserService->deleteUser($id);

            return back()->with('success', 'Xóa người dùng thành công.' );
        }
    }
?>