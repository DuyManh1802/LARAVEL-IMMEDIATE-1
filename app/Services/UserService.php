<?php
    namespace App\Services;

    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;

    class UserService
    {
        public function allUser()
        {
            return User::orderBy('email')->paginate(20);
            // return User::onlyTrashed()->paginate(20);
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