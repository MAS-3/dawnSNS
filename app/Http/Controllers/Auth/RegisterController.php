<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            //ルール
            'username' => 'required|string|min:4|max:25',
            'mail' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|max:255|same:password-confirm',
            'password-confirm' => 'required'
        ],[
            //カスタムエラーメッセージ
            'required' => '入力必須項目です',
            'string' => '文字を入力してください',
            'username.min' => '4文字以上で入力してください',
            'username.max' => '25文字以内で入力してください',
            'mail.unique' => '既に登録されているアドレスです',
            'mail.min' => '4文字以上で入力してください',
            'mail.max' => '255文字以内で入力してください',
            'password.min' => '4文字以上で入力してください',
            'password.max' => '255文字以内で入力してください',
            'password.same' => 'パスワード確認蘭と入力が異なります',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

// ユーザー作成処理
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }


// 新規ユーザー登録
    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();

            //バリデーション
            $val = $this->validator($data);

            if ($val->fails()) {
                //リダイレクト
                return redirect('register')
                    ->withErrors($val)
                    ->withInput();
            }else{
                //ユーザー登録処理
                $this->create($data);
                return redirect('added');
            }
        }
        return view('auth.register');
    }

    public function added(){
        $registeredUser = User::latest()
                        ->first();
        return view('auth.added',['registeredUser' => $registeredUser]);
    }
}
