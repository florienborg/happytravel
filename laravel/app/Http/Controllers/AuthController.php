<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }  
      
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('happy_travel')
                        ->withSuccess('Inicio de sesión exitoso');
        }
  
        return redirect("auth.login")->withSuccess('Los detalles de inicio de sesión no son válidos');

       
    }

    public function register()
    {
        return view('auth.register');
    }
      
    public function customRegister(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $user = $this->create($data);

        if ($user) {
            Auth::login($user);
            return redirect()->route('happy_travel.index')->withSuccess('Te has registrado exitosamente');
        } else {
            return redirect()->route('register')->with('error', 'Hubo un problema al registrarte');
        }
    }
         

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    
    public function signOut() {
        Auth::logout();
        return redirect()->route('happy_travel.index');
    }
}
