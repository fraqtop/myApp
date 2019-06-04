<?php


namespace App\Services;


use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class UserService implements Service
{
    public function create(Request $request): Model
    {
        $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
           'name' => $request->post('name'),
           'email' => $request->post('email'),
           'password' => \Hash::make($request->post('password'))
        ]);
        return $user;
    }

    public function get(int $id): Model
    {
        return User::find($id);
    }

    public function getAll(): Collection
    {
        return User::orderBy('created_at', 'desc')->get();
    }

    public function update(int $id, array $data)
    {
        $user = User::find($id);
        $user->update($data);
    }

    public function adjustKarma(User $user, $value)
    {
        $user->karma += $value;
        $user->save();
    }

    public function delete(Request $request)
    {
        User::find($request->route('user_id'))->delete();
    }
}