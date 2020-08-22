<?php

namespace App\Repositories;

use App\Models\User;

class  UserRepository extends AbstractRepository
{
    protected $model = User::class;

    public function allNotLoggedIn ()
    {
        return $this->model->whereNotIn('id', [auth()->user()->id])->orderBy('name','asc')->get();
    }

    public function store($data)
    {
        return $this->model->create(array_merge($data->all(), ['password' =>bcrypt($data->password)]));
    }

    public function update($data, $id)
    {
        $user = $this->model->find($id);
        return $user->update(array_merge($data->all(), ['password' =>bcrypt($data->password)]));
    }

    public function userData ($id)
    {
        $user = $this->model->find($id);
        return [
            "id" => (string) $user->id,
            "name" => $user->name,
            "email" => $user->email,
            "photoUrl" => "https://i.ibb.co/cYDxzms/photo.png",
        ];
    }
}
