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
        private $userService;

        public function __construct()
        {
            $this->userService = new UserService();
        }

        public function index()
        {
            $users = $this->userService->allUser();

            return view('user.list', compact('users'));
        }

        public function create()
        {
            return view('user.create');
        }

        public function store(CreateUserRequest $request)
        {
            try {
                $this->userService->storeUser($request);
            } catch (ModelNotFoundException $exception) {
                return back()->withError($exception->getMessage());
            }

            return redirect()->route('user.list')->with('success', 'Thêm mới người dùng thành công.');
        }

        public function edit($id)
        {
            $users = $this->userService->findId($id);

            return view('user.edit', compact('users'));
        }

        public function update(EditUserRequest $request, $id)
        {
            try {
                $this->userService->updateUser($request, $id);
            } catch (ModelNotFoundException $exception) {
                return back()->withError($exception->getMessage());
            }

            return redirect()->route('user.list')->with('success', 'Sửa người dùng thành công.');
        }

        public function delete($id)
        {
            try {
                $this->userService->deleteUser($id);
            } catch (ModelNotFoundException $exception) {
                return back()->withError($exception->getMessage());
            }
            
            return redirect()->route('user.list')->with('success', 'Xóa người dùng thành công.');
        }
    }
?>
