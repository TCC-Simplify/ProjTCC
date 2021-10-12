<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();
        /*try{

            $dados = $input->validate([
                'cpf' => 'required|cpf',
                // outras validações aqui
            ]);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
        }*/

        $id = session()->get('id_empresa');

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'cpf' => $input['cpf'],
            'dt_nasc' => $input['dt_nasc'],
            'funcao' => $input['funcao'],
            'permissao' => $input['permissao'],
            'password' => Hash::make($input['password']),
            'ativo'=> 's', 
            'empresa' => $id,
            'aux' => 1,
            'equipe' => 0
        ]);

    }

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function store(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();
        /*try{

            $dados = $input->validate([
                'cpf' => 'required|cpf',
                // outras validações aqui
            ]);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
        }*/

        $id = session()->get('id_empresa');

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'cpf' => $input['cpf'],
            'dt_nasc' => $input['dt_nasc'],
            'funcao' => $input['funcao'],
            'permissao' => $input['permissao'],
            'password' => Hash::make($input['password']),
            'ativo'=> 's', 
            'empresa' => $id,
            'aux' => 1,
            'equipe' => 0
        ]);
    }
}
