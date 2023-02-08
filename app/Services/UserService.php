<?php
    namespace App\Services;

    use App\Models\User;
    use App\Models\Classroom;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Exception;
    use Illuminate\Support\Facades\DB;
    use App\Mail\WelcomeEmail;
    use Illuminate\Support\Facades\Mail;
    use App\Events\CreatedUser;
    class UserService
    {
        public function allUser(Request $request)
        {
            $user = User::orderBy('email');

            return $user->searchEmail($request)->searchName($request)->searchAddress($request)->searchPhone($request)->paginate(20);
        }

        public function storeUser(Request $request)
        {
            try {
                DB::beginTransaction();

                $user = User::create([
                    'classroom_id' => $request->classroom_id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'role' => $request->role
                ]);

                event(new CreatedUser($user));

                DB::commit();
            } catch (Exception $ex){
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
                    'role' => $request->role
                ]);

                DB::commit();
            } catch (Exception $ex){
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
                DB::rollBack();
            }

            return $user;
        }

        public function allClassroom()
        {
            return Classroom::all();
        }
    }
?>