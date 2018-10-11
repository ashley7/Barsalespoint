<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
 

    use RegistersUsers;

   
    protected $redirectTo = '/home';

    
    public function __construct()
    {
        $this->middleware('guest');
    }

   
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',           
            'password' => 'required|string|min:6|confirmed',
            'phone_number'=>'required|unique:users'
        ]);
    }
 
    protected function create(array $data)
    {
        $save_user=new User();
        $save_user->name=$data['name'];     
        $save_user->phone_number=$data['phone_number'];     
        $save_user->password=bcrypt($data['password']);
        try {
            $save_user->save();
            return User::find($save_user->id);         
        } catch (\Exception $e) {
         echo  $e->getMessage();   
         exit();
        }       
    }
}