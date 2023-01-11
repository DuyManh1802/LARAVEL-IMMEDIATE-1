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
        private $UserService;

        public function __construct()
        {
            $this->UserService = new UserService();
        }

        public function index()
        {
            $users = $this->UserService->allUser();

            return view('user.list', compact('users'));
        }

        public function create()
        {
            return view('user.create');
        }

        public function store(CreateUserRequest $request)
        {
            if ($this->UserService->storeUser($request)){
                return redirect()->route('user.list')->with('success', 'Thêm mới người dùng thành công.');
            } else {
                return back()->with('error', 'Thêm mới người dùng k thành công.');
            }
        }

        public function edit($id)
        {
            $users = $this->UserService->findId($id);

            return view('user.edit', compact('users'));
        }

        public function update(EditUserRequest $request, $id)
        {
            if ($this->UserService->updateUser($request, $id)){
                return redirect()->route('user.list')->with('success', 'Sửa người dùng thành công.');
            } else {
                return back()->with('error', 'Sửa thông tin người dùng k thành công.');
            }
        }

        public function delete($id)
        {
            if ($this->UserService->deleteUser($id)){
                return redirect()->route('user.list')->with('success', 'Xóa người dùng thành công.');
            } else {
                return back()->with('error', 'Xóa người dùng k thành công.');
            }
        }
    }
?>
