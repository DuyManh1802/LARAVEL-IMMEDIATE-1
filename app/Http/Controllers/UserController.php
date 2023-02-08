<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Services\UserService;
    use App\Http\Requests\CreateUserRequest;
    use App\Http\Requests\EditUserRequest;
    use Exception;
    use Illuminate\Support\Facades\Auth;

    class UserController extends Controller
    {
        private $userService;

        public function __construct()
        {
            $this->userService = new UserService();
        }

        public function index(Request $request)
        {
            try {
                $users = $this->userService->allUser($request);
            } catch (Exception $exception) {
                return back()->with('error', 'Lỗi');
            }

            return view('user.list', compact('users'));
        }

        public function create()
        {
            $classrooms = $this->userService->allClassroom();

            return view('user.create', compact('classrooms'));
        }

        public function store(CreateUserRequest $request)
        {
            try {
                $result = $this->userService->storeUser($request);

                if ($result){
                    return redirect()->route('user.list')->with('success', 'Thêm mới người dùng thành công.');
                } else {
                    return back()->with('error', 'Thêm mới người dùng k thành công.');
                }
            } catch (Exception $exception) {
                return back()->with('error', 'Lỗi');
            }
        }

        public function edit($id)
        {
            $users = $this->userService->findId($id);

            return view('user.edit', compact('users'));
        }

        public function update(EditUserRequest $request, $id)
        {
            try {
                $result = $this->userService->updateUser($request, $id);

                if ($result){
                    return redirect()->route('user.list')->with('success', 'Sửa người dùng thành công.');
                } else {
                    return back()->with('error', 'Sửa người dùng k thành công.');
                }
            } catch (Exception $exception) {
                return back()->with('error', 'Lỗi');
            }
        }

        public function delete($id)
        {
            try {
                $result = $this->userService->deleteUser($id);

                if ($result){
                    return redirect()->route('user.list')->with('success', 'Xóa người dùng thành công.');
                } else {
                    return back()->with('error', 'Xóa người dùng k thành công.');
                }
            } catch (Exception $exception) {
                return back()->with('error', 'Lỗi');
            }
        }
    }
?>
