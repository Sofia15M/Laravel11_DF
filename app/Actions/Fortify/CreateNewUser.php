<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Http\UploadedFile;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string|UploadedFile>  $input
     */
    public function create(array $input): User
    {
        // Validar los datos de entrada
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'foto_user' => ['required', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'id_rol' => ['required', 'integer'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // Manejar la carga de la imagen
        /** @var \Illuminate\Http\UploadedFile $foto_user */
        $foto_user = $input['foto_user'];
        $foto_user_path = $foto_user->store('profile_pictures', 'public');

        // Crear el nuevo usuario y devolverlo
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'foto_user' => $foto_user_path, // Guarda la ruta de la imagen
            'id_rol' => $input['id_rol'], // Guarda el id del rol
        ]);
    }
}
