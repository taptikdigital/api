<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\DashboardLibrary;
use App\Http\Controllers\Api\V1\BaseController;

/**
 * @group Dashboard
 *
 * APIs for managing all dashboard related 
 */


class DashboardController extends BaseController
{
    public function __construct()
    {
        $this->num_of_day                       = 1;
        $this->to_day                           = date('d-m-Y');
        
        
        $this->code                             = 'status_code';
        $this->status                           = 'status';
        $this->result                           = 'result';
        $this->message                          = 'message';
        $this->data                             = 'data';
        $this->total                            = 'total_count';
        $this->dashboardLib                     = new DashboardLibrary();
        
        
    }
    
   
    
    /**
     * getProject
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     *
     * <aside class="notice">basepath/api/v1/get-project</aside>
     * @method POST
     * @authenticated
     * @header      Authorization Bearer _token required  
     * @return \Illuminate\Http\Response
     *
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully list get...",
            "data": {
                "total_count": 1,
                "collection": {
                    "current_page": 1,
                    "data": [
                        {
                            "id": 1,
                            "user_id": 1,
                            "industry_id": 1,
                            "name": "AdsProject",
                            "slug": "adsproject",
                            "whatsapp_number": "9876543212",
                            "current_status": "created",
                            "created_at": "19-Nov-2024 06:48:10 AM",
                            "industry": {
                                "id": 1,
                                "name": "Advertisement",
                                "slug": "advertisement"
                            }
                        }
                    ],
                    "first_page_url": "BASE_URL/api/v1/get-project?page=1",
                    "from": 1,
                    "next_page_url": null,
                    "path": "BASE_URL/api/v1/get-project",
                    "per_page": 3,
                    "prev_page_url": null,
                    "to": 1
                }
            }
        }
     *
     *     
     * @response 404
     *  {
            "status": false,
            "status_code": 404,
            "message": "Data not found...",
            "data": []
        }


     * @response 401
     *  {
            "success": false,
            "status_code": 401,
            "message": "Invalid or expired token",
            "data": []
        }
     * 
     * @response 422
     *  {
            "success": false,
            "status_code": 422,
            "message": "Token not provided",
            "data": []
        }
     * 
     *
     *
     */
    
    
    
    
    public function getProject(Request $request)
    {
        $all = $request->all();

        $response = $this->dashboardLib->projectFetch($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
    
    /**
     * getDashboard
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * EX
     *  {
            "project_id":1
        }
     *
     *
     * <aside class="notice">basepath/api/v1/get-dashboard</aside>
     * @method POST
     * @authenticated
     * @header      Authorization Bearer _token required
     * @bodyParam *project_id integer required Example: 1,2,3 in JSON BODY
     * @return \Illuminate\Http\Response
     *
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully data get...",
            "data": {
                "active_plan": {
                    "id": 5,
                    "subscription_status": "active",
                    "next_payment_date": null
                },
                "profile": {
                    "id": 2,
                    "profile_picture": "PATH/profiles/468136505_2121024421690080_4247705420565344900_n.jpg",
                    "description": "All types of medical related information",
                    "address": "Rahat Road karim chak",
                    "email": "hello@medlifeinfinity.com",
                    "vertical": "HEALTH",
                    "full_vertical": "Medical and Health",
                    "about": "#medical #chemist",
                    "websites": "https://www.medlifeinfinity.com/"
                },
                "configuration": {
                    "id": 2,
                    "whatsapp_business_account_id": "509467322246054",
                    "phone_number_id": "520516084470925",
                    "display_phone_number": "918544547427",
                    "business_id": "1800111597189501",
                    "permanent_access_token": "EAAPAzbngQ3EBO6IRNdq....Ac54q8I4b1m",
                    "phone_no_pin": "n/a",
                    "phone_number_status": "n/a",
                    "wba_status": "connected",
                    "verified_name": "MedLife",
                    "quality_rating": "High",
                    "messaging_limit": "250",
                    "current_limit_tier": "TIER_250",
                    "max_daily_conversation_per_phone": null,
                    "max_phone_numbers_per_business": null,
                    "code_verification_status": null,
                    "profile_updated": "no",
                    "health_status": "LIMITED",
                    "meta_payment_configuration": "no",
                    "meta_gst_added": "no",
                    "current_status": "pending",
                    "configuration_health_status_entities": [
                        {
                            "id": 5,
                            "configuration_id": 2,
                            "entity_id": "520516084470925",
                            "entity_type": "PHONE_NUMBER",
                            "entity_status": "LIMITED",
                            "additional_info": "[\"Your display name has not been approved yet. Your message limit will increase after the display name is approved.\"]",
                            "errors": null
                        },
                        {
                            "id": 6,
                            "configuration_id": 2,
                            "entity_id": "509467322246054",
                            "entity_type": "WABA",
                            "entity_status": "AVAILABLE",
                            "additional_info": null,
                            "errors": null
                        },
                        {
                            "id": 7,
                            "configuration_id": 2,
                            "entity_id": "1800111597189501",
                            "entity_type": "BUSINESS",
                            "entity_status": "LIMITED",
                            "additional_info": null,
                            "errors": "[{\"error_code\": 141010, \"error_description\": \"The Business has not passed business verification.\", \"possible_solution\": \"Visit business settings and start or resolve the business verification request.\"}]"
                        }
                    ]
                }
            }
        }
     *
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully data get...",
            "data": {
                "active_plan": [],
                "profile": {
                    "id": 2,
                    "profile_picture": "profiles/468136505_2121024421690080_4247705420565344900_n.jpg",
                    "description": "All types of medical related information",
                    "address": "Rahat Road karim chak",
                    "email": "hello@medlifeinfinity.com",
                    "vertical": "HEALTH",
                    "full_vertical": "Medical and Health",
                    "about": "#medical #chemist",
                    "websites": "https://www.medlifeinfinity.com/"
                },
                "configuration": {
                    "id": 2,
                    "whatsapp_business_account_id": "509467322246054",
                    "phone_number_id": "520516084470925",
                    "display_phone_number": "918544547427",
                    "business_id": "1800111597189501",
                    "permanent_access_token": "EAAPAzbngQ3EBO6IRNdqlIOGCN7DyKcweTzSiXTbiartnSFBIM7ZBUNeEo7seLYLeafKpnlnJ1kZAgT4ar9LiMZAEcJ6EJ6UISRC4NrHMZAgetzrvWO1PPsgSMeJwOVJNdm5LExVAusNRIOHEHBgdesyS7fynl8smoQ6SLXE99sLslkp9Q3Ysj6IGtmMM4B9vrv55rxOXGIDGlbEQMDAZAXtbYOb0o3ZC3a4IZCIXZCDMdRbpZCCr8QZAc54q8I4b1m",
                    "phone_no_pin": "n/a",
                    "phone_number_status": "n/a",
                    "wba_status": "connected",
                    "verified_name": "MedLife",
                    "quality_rating": "High",
                    "messaging_limit": "250",
                    "current_limit_tier": "TIER_250",
                    "max_daily_conversation_per_phone": null,
                    "max_phone_numbers_per_business": null,
                    "code_verification_status": null,
                    "profile_updated": "no",
                    "health_status": "LIMITED",
                    "meta_payment_configuration": "no",
                    "meta_gst_added": "no",
                    "current_status": "pending",
                    "configuration_health_status_entities": [
                        {
                            "id": 5,
                            "configuration_id": 2,
                            "entity_id": "520516084470925",
                            "entity_type": "PHONE_NUMBER",
                            "entity_status": "LIMITED",
                            "additional_info": "[\"Your display name has not been approved yet. Your message limit will increase after the display name is approved.\"]",
                            "errors": null
                        },
                        {
                            "id": 6,
                            "configuration_id": 2,
                            "entity_id": "509467322246054",
                            "entity_type": "WABA",
                            "entity_status": "AVAILABLE",
                            "additional_info": null,
                            "errors": null
                        },
                        {
                            "id": 7,
                            "configuration_id": 2,
                            "entity_id": "1800111597189501",
                            "entity_type": "BUSINESS",
                            "entity_status": "LIMITED",
                            "additional_info": null,
                            "errors": "[{\"error_code\": 141010, \"error_description\": \"The Business has not passed business verification.\", \"possible_solution\": \"Visit business settings and start or resolve the business verification request.\"}]"
                        }
                    ]
                }
            }
        }
     *
     *
     
     * @response 404
     *  {
            "status": false,
            "status_code": 404,
            "message": "Data not found...",
            "data": []
        }


     * @response 401
     *  {
            "success": false,
            "status_code": 401,
            "message": "Invalid or expired token",
            "data": []
        }
     * 
     * @response 422
     *  {
            "success": false,
            "status_code": 422,
            "message": "Token not provided",
            "data": []
        }
     * 
     * 
     *
     *
     */
    
    
    
    
    public function getDashboard(Request $request)
    {
        $all = $request->all();

        // echo "<pre>";
        // print_r($all);
        // echo "</pre>";
        // die();

        $response = $this->dashboardLib->dashboardFetch($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    

    /**
     * getDashboardReport
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * EX
     *  {
            "project_id":1
        }
     *
     *
     * <aside class="notice">basepath/api/v1/get-dashboard-report</aside>
     * @method POST
     * @authenticated
     * @header      Authorization Bearer _token required
     * @bodyParam *project_id integer required Example: 1,2,3 in JSON BODY
     * @return \Illuminate\Http\Response
     *
     * @response 200
     * {
            "status": true,
            "status_code": 200,
            "message": "Successfully data get...",
            "data": {
                "deliveredCount": 18,
                "sentCount": 18,
                "readCount": 15,
                "failedCount": 4,
                "sentDate": [
                    {
                        "date": "14 Mar",
                        "count": 9
                    },
                    {
                        "date": "15 Feb",
                        "count": 4
                    },
                    {
                        "date": "16 Feb",
                        "count": 1
                    },
                    {
                        "date": "17 Feb",
                        "count": 1
                    },
                    {
                        "date": "24 Mar",
                        "count": 3
                    }
                ],
                "deliveredDate": [
                    {
                        "date": "14 Mar",
                        "count": 9
                    },
                    {
                        "date": "15 Feb",
                        "count": 4
                    },
                    {
                        "date": "16 Feb",
                        "count": 1
                    },
                    {
                        "date": "17 Feb",
                        "count": 1
                    },
                    {
                        "date": "24 Mar",
                        "count": 3
                    }
                ],
                "readDate": [
                    {
                        "date": "14 Mar",
                        "count": 8
                    },
                    {
                        "date": "15 Feb",
                        "count": 3
                    },
                    {
                        "date": "16 Feb",
                        "count": 1
                    },
                    {
                        "date": "17 Feb",
                        "count": 1
                    },
                    {
                        "date": "24 Mar",
                        "count": 2
                    }
                ],
                "failedDate": [
                    {
                        "date": "14 Mar",
                        "count": 1
                    },
                    {
                        "date": "15 Feb",
                        "count": 3
                    },
                    {
                        "date": "16 Feb",
                        "count": 0
                    },
                    {
                        "date": "17 Feb",
                        "count": 0
                    },
                    {
                        "date": "24 Mar",
                        "count": 0
                    }
                ]
            }
        }
     *
     * @response 200
     * {
            "status": true,
            "status_code": 200,
            "message": "Successfully data get...",
            "data": {
                "deliveredCount": 0,
                "sentCount": 0,
                "readCount": 0,
                "failedCount": 0,
                "sentDate": [],
                "deliveredDate": [],
                "readDate": [],
                "failedDate": []
            }
        } 
     *  
     *
     
     * @response 404
     *  {
            "status": false,
            "status_code": 404,
            "message": "Data not found...",
            "data": []
        }


     * @response 401
     *  {
            "success": false,
            "status_code": 401,
            "message": "Invalid or expired token",
            "data": []
        }
     * 
     * @response 422
     *  {
            "success": false,
            "status_code": 422,
            "message": "Token not provided",
            "data": []
        }
     * 
     * 
     *
     *
     */
    
    
    
    
    public function getDashboardReport(Request $request)
    {
        $all = $request->all();

        // echo "<pre>";
        // print_r($all);
        // echo "</pre>";
        // die();

        $response = $this->dashboardLib->dashboardReportsFetch($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    



    








    
    
    
}
