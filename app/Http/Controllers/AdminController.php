<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin;
use App\Http\Requests\AdminRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function Admin(AdminRequest $adminRequest){
        Product::create([
            'name'=>$adminRequest->name,
            'family'=>$adminRequest->family,
            'email'=>$adminRequest->email,
            'national_code'=>$adminRequest->national_code,
            'phone'=>$adminRequest->phone,
            'birthday_date'=>$adminRequest->birthday_date,
            'address'=>$adminRequest->address
        ]);
    }
}
