<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Api\V1\BaseController;
use Log;
use Validator;
use App\Models\User;
use App\Models\Coupon;
use App\Models\UserAnna;
use App\Models\UserAnnaHistory;

use App\Exceptions;
use Illuminate\Support\Facades\Hash;


class UserService
{

    public function __construct()
    {
        $this->status                       = 'status';
        $this->message                      = 'message';
        $this->code                         = 'status_code';
        $this->data                         = 'data';
        $this->total                        = 'total_count';
       

    }
    
   



    /**
        * Annas Code
        * method fetchAllUser()
        * 
        * @param[]
        * NA
        * 
        * @condition
        * is_active = 1
        * status = 1
        * 
        * 
        * 
        * @return 
        * 200
        * 
        * @error
        * 404
        * 
    **/
    
    
    public static function fetchAllUser()
    {
        return User::where('is_live', 1)
            ->where('status', 1)
            ->get();
    }
    
    public static function fetchUserNameById($id)
    {
        return User::where('is_live', 1)
            ->where('id', $id)
            ->where('status', 1)
            ->first();
    }

    public static function fetchUserByMobile($mobile)
    {
        return User::where('is_live', 1)
            ->where('mobile', $mobile)
            ->where('status', 1)
            ->first();
    }







}
