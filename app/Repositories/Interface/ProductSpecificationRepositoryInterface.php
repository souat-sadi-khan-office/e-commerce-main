<?php

namespace App\Repositories\Interface;

interface ProductSpecificationRepositoryInterface
{
 public function index();
 public function show($models);
 public function delete($id);
 public function updatestatus($id);
 public function updateposition($request,$id);
 public function indexview($data);
}