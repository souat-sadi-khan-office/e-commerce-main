<?php

namespace App\Repositories\Interface;

interface AuthRepositoryInterface
{
    public function login( $request, $guard);
    public function form();
    public function logout($guard);
}