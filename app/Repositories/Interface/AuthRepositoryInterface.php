<?php

namespace App\Repositories\Interface;

interface AuthRepositoryInterface
{
    // for admins
    public function login( $request, $guard);
    public function form();
    public function logout($guard);

    // for customers
    public function customer_login_form();
    public function customer_register_form();
    public function customer_login( $request, $guard);
    public function customer_logout($guard);
    public function registerUser($request);
}