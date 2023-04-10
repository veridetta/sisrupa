<?php

namespace App\Actions\Fortify;

use App\Models\pedagang;
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
        //dd($input);
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'], 
            'password' => $this->passwordRules(),
            //'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();
        $id=NULL;
        $user = User::updateOrCreate([
            'id' => $id
        ], [
            'username' => $input['username'],
            'email' => $input['email'],
            'name' => $input['name'],
            'password' => Hash::make($input['password']),
            'role'=>'pedagang'
        ]);
        if($user){
          $pedagang=pedagang::updateOrCreate([
            'id'=>$id],
            [
            'ttl' => $input['ttl'],
            'telp' => $input['telp'],
            'alamat' => $input['alamat'],
            'jk' => $input['jk'],
            'id_users'=>$user->id,
            'jenis' => $input['jenis'],
            'status' => '0'
            ]);
        }
        return $user;
    }
}
