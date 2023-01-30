<?php
    namespace App\Services;

    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Exception;
    use App\Facades\HelperFacade;
    use Illuminate\Support\Facades\DB;

    class UserService
    {
        public function allUser(Request $request)
        {
            $user = User::orderBy('email')
            ->where('email', 'LIKE', "%$request->email%")
            ->where('name', 'LIKE', "%$request->name%")
            ->where('address', 'LIKE', "%$request->address%")
            ->orWhere('phone', '=', "$request->phone")
            ->paginate(20);

            if ($user->count() > 0){
                return $user;
            } else {
                echo "<script>";
                echo "alert('Không có Người dùng nào phù hợp với kết quả tìm kiếm!');";
                echo "</script>";

                return User::orderBy('email')->paginate(20);
            }
        }

        public function storeUser(Request $request): User
        {
            return User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'address' => $request->address,
                'phone' => $request->phone
            ]);
        }

        public function findId($id)
        {
            return User::find($id);
        }

        public function updateUser(Request $request, $id):void
        {
            User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
            ]);
        }

        public function deleteUser($id):void
        {
            User::where('id', $id)->delete();
        }
    }
?>
