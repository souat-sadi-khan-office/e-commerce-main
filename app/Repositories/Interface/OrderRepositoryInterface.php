<?php

namespace App\Repositories\Interface;

interface OrderRepositoryInterface
{
 public function index($request);
 public function store($request);
 public function indexDatatable($request);
}