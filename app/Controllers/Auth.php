<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class Auth extends BaseController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function signIn(): string
    {
        $data = [
            "title" => "Login"
        ];

        return view("auth/sign-in", $data);
    }

    public function handleSignIn()
    {
        $rules = [
            "username"  => "required",
            "password"  => "required"
        ];
        if (!$this->validate($rules)) return redirect()->back()->withInput()->with("errors", $this->validator->getErrors());

        $user = $this->userModel->where("username", $this->request->getPost("username"))->first();
        $validPassword = password_verify($this->request->getPost("password"), $user["password"]);

        if (!$validPassword) return redirect()->back()->withInput()->with("message", [
            "text"  => "Username atau Password salah",
            "icon"  => "warning"
        ]);

        $user = $this->userModel->select(["id", "username", "name", "role"])->find($user["id"]);

        $data = [
            "user"   => $user,
            "sign-in" => true
        ];
        session()->set($data);

        switch ($user["role"]) {
            case "admin":
                return redirect()->to("/dashboard");

            case "customer":
                return redirect()->to("/");
        }
    }

    public function signUp()
    {
        $data = [
            "title" => "Register"
        ];

        return view("auth/sign-up", $data);
    }

    public function handleSignUp()
    {
        $rules = [
            "name"      => "required",
            "username"  => "required|is_unique[users.username]",
            "password"  => "required|min_length[8]"
        ];
        if (!$this->validate($rules)) return redirect()->back()->withInput()->with("errors", $this->validator->getErrors());

        $data = $this->validator->getValidated();
        $data["password"] = password_hash($data["password"], PASSWORD_BCRYPT);

        $this->userModel->insert($data);
        $message = [
            "icon"  => "success",
            "text"  => "Registrasi berhasil"
        ];
        return redirect()->to("/sign-in")->with("message", $message);
    }

    public function signOut()
    {
        $role = session("user.role");
        session()->destroy();

        switch ($role) {
            case "admin":
                return redirect()->to("/sign-in");

            case "customer":
                return redirect()->to("/");
        }
    }
}
