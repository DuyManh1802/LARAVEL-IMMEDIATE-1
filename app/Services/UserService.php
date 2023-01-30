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
            $user = User::orderBy('email');

            if (isset($request->email)){
                $user = $user->where('email', 'LIKE', "%$request->email%");
            }

            if (isset($request->name)){
                $user = $user->where('name', 'LIKE', "%$request->name%");
            }

            if (isset($request->address)){
                $user = $user->where('address', 'LIKE', "%$request->address%");
            }

            if (isset($request->phone)){
                $user = $user->where('phone', '=', "$request->phone");
            }

            return $user->paginate(20);
        }

        public function storeUser(Request $request)
        {
            try {
                DB::beginTransaction();

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'address' => $request->address,
                    'phone' => $request->phone
                ]);

                DB::commit();
            } catch (Exception $ex){
                dd($ex);
                DB::rollBack();
            }

            return $user;
        }

        public function findId($id)
        {
            return User::find($id);
        }

        public function updateUser(Request $request, $id)
        {
            try {
                DB::beginTransaction();

                $user = User::find($id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'address' => $request->address,
                    'phone' => $request->phone,
                ]);

                DB::commit();
            } catch (Exception $ex){
                dd($ex);
                DB::rollBack();
            }

            return $user;
        }

        public function deleteUser($id)
        {
            try {
                DB::beginTransaction();

                $user = User::find($id)->delete();

                DB::commit();
            } catch (Exception $ex){
                dd($ex);
                DB::rollBack();
            }

            return $user;
        }
    }
?>
