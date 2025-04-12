<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Services\CommonService;
use App\Services\DashboardService;
use Log;


class DashboardLibrary
{

    public function __construct()
    {
        
        $this->commonSer                    = new CommonService();
        $this->dashboardSer                 = new DashboardService();
        $this->status                       = 'status';
        $this->message                      = 'message';
        $this->code                         = 'status_code';
        $this->error                        = 'error';
        $this->error_code                   = 'error_code';
        $this->data                         = 'data';
    }

    
    
   /**
        * @param[]
        * token
        *
        * @return 
        * 200
        * 
        * @error
        * 404/201
        * 
    **/
    
    public function projectFetch($param)
    {
        $this->commonSer->inputValidators('projectFetch', $param);
        $serviceResponse = $this->dashboardSer->getAllProject($param);
        return [
            $this->status                   => $serviceResponse[$this->status],
            $this->message                  => $serviceResponse[$this->message],
            $this->code                     => $serviceResponse[$this->code],
            $this->data                     => $serviceResponse[$this->status] ? $serviceResponse[$this->data] : [],
        ];
        
        return $return;
    }
    
   /**
        * @param[]
        * token
        *
        * @return 
        * 200
        * 
        * @error
        * 404/201
        * 
    **/
    
    public function dashboardFetch($param)
    {
        $this->commonSer->inputValidators('dashboardFetch', $param);
        $serviceResponse                    = $this->dashboardSer->getAllDashboardData($param);

        return [
            $this->status                   => $serviceResponse[$this->status],
            $this->message                  => $serviceResponse[$this->message],
            $this->code                     => $serviceResponse[$this->code],
            $this->data                     => $serviceResponse[$this->status] ? $serviceResponse[$this->data] : [],
        ];
    }
   /**
        * @param[]
        * token
        *
        * @return 
        * 200
        * 
        * @error
        * 404/201
        * 
    **/
    
    public function dashboardReportsFetch($param)
    {
        $this->commonSer->inputValidators('dashboardReportsFetch', $param);
        $serviceResponse                    = $this->dashboardSer->getAllDashboardReport($param);

        return [
            $this->status                   => $serviceResponse[$this->status],
            $this->message                  => $serviceResponse[$this->message],
            $this->code                     => $serviceResponse[$this->code],
            $this->data                     => $serviceResponse[$this->status] ? $serviceResponse[$this->data] : [],
        ];
    }



















    
    
   /**
        * @param[]
        * categoryId
        *
        * @return 
        * 200
        * 
        * @error
        * 404/201
        * 
    **/
    
    public function allCollectionGetByCategory($param)
    {
        $this->commonSer->inputValidators('allCollectionGetByCategory', $param);
        $serviceResponse = $this->dashboardSer->fetchAllCollectionByCategory($param);

        if($serviceResponse[$this->status])
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = $serviceResponse[$this->data];
        }
        else
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = [];
        }
        
        return $return;
    }
    
   
    
    
   /**
        * @method productSearch()
        * @param[]
        * keyword
        *
        * @return 
        * 200
        * 
        * @error
        * 404/201
        * 
    **/
    
    public function productSearch($param)
    {
        $this->commonSer->inputValidators('productSearch', $param);
        $serviceResponse = $this->dashboardSer->searchProductList($param);

        if($serviceResponse[$this->status])
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = $serviceResponse[$this->data];
        }
        else
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = [];
        }
        
        return $return;
    }
    
   
    
    
   /**
        * @method productByIdGet()
        * @param[]
        * productId
        *
        * @return 
        * 200
        * 
        * @error
        * 404/201
        * 
    **/
    
    public function productDetails($param)
    {
        $this->commonSer->inputValidators('productDetails', $param);
        $serviceResponse = $this->dashboardSer->fetchProductDetails($param);

        if($serviceResponse[$this->status])
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = $serviceResponse[$this->data];
        }
        else
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = [];
        }
        
        return $return;
    }
    



   /**
        * @method productByIdGet()
        * @param[]
        * productId
        *
        * @return 
        * 200
        * 
        * @error
        * 404/201
        * 
    **/
    
    public function productReviews($param)
    {
        $this->commonSer->inputValidators('productReviews', $param);
        $serviceResponse = $this->dashboardSer->fetchProductReviews($param);

        if($serviceResponse[$this->status])
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = $serviceResponse[$this->data];
        }
        else
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = $serviceResponse[$this->data];
        }

       
        return $return;
    }
    

   /**
        * @method notifyProduct()
        * @param[]
        * productId
        * name
        * mobile
        * email
        *
        * @return 
        * 200
        * 
        * @error
        * 404/201
        * 
    **/
    
    public function notifyProduct($param)
    {
        $this->commonSer->inputValidators('notifyProduct', $param);
        $serviceResponse = $this->dashboardSer->createProductNotify($param);

        if($serviceResponse[$this->status])
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = $serviceResponse[$this->data];
        }
        else
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = $serviceResponse[$this->data];
        }

       
        return $return;
    }
    
   
   





   /**
        * @method productRecommendationsGet()
        * @param[]
        * productId
        *
        * @return 
        * 200
        * 
        * @error
        * 404/201
        * 
    **/
    
    public function productRecommendationsGet($param)
    {
        $this->commonSer->inputValidators('productRecommendationsGet', $param);
        $serviceResponse = $this->dashboardSer->fetchProductRecommendations($param);

        if($serviceResponse[$this->status])
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = $serviceResponse[$this->data];
        }
        else
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = $serviceResponse[$this->data];
        }
       
        return $return;
    }
    

   /**
        * @method productStepsGet()
        * @param[]
        * productId
        *
        * @return 
        * 200
        * 
        * @error
        * 404/201
        * 
    **/
    
    public function productStepsGet($param)
    {
        $this->commonSer->inputValidators('productStepsGet', $param);
        $serviceResponse = $this->dashboardSer->fetchProductSteps($param);

        if($serviceResponse[$this->status])
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = $serviceResponse[$this->data];
        }
        else
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = $serviceResponse[$this->data];
        }
       
        return $return;
    }
    
   
    

}
