<?php

return [
    "rules" => [
        'user_id'               => "bail|required|numeric|regex:/^\d{1,15}?$/|exists:users,id",
        'project_id'            => "bail|required|numeric|regex:/^\d{1,15}?$/",
        
        'name'                  => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'first_name'            => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'last_name'             => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'address'               => "bail|required|regex:/^[a-zA-Z\., ]*$/|min:3|max:255",
        'keyword'               => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'street'                => "bail|required|regex:/^[a-zA-Z\., ]*$/|min:3|max:255",
        'landmark'              => "bail|required|regex:/^[a-zA-Z\., ]*$/|min:3|max:255",
        'city'                  => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'state'                 => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'country'               => "bail|required|regex:/^[a-z A-Z\.]*$/|min:2|max:120",
        'zip'                   => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'location'              => "bail|required|string|in:home,work,others",
        'payment_mode'          => "bail|required|string|in:online,cod",
        'transaction_id'        => 'required_if:payment_mode,online|string|',
        'email'                 => "bail|required|email|unique:users",
        'email_id'              => "bail|required|email",
        'token'                 => "bail|required|string",
        'message'               => "bail|required|string",
        'description'           => "bail|required|string",
        'comments'              => "bail|required|string",
        'six_digit_code'        => "required|numeric|digits:6",
        'mobile'                => "required|numeric|regex:/^[6-9]\d{9}$/",
        'mobile_no'             => "required|numeric|regex:/^[6-9]\d{9}$/",
        'password'              => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        'current_password'      => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        'new_password'          => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        'retype_password'       => 'required|same:new_password',
        
        
        
    ],


    "api_validations" =>[
        
        



        /*
            Login, Register, Forgot, Change forgot
        
        */

        
        "userLogin" => [
            "required" => [
                "email_id",
                "password"
            ],
            "optional" => [
            ]
        ], 
        "refresh" => [
            "required" => [
                "token",
                "password"
            ],
            "optional" => [
            ]
        ], 

        "forgotPass" => [
            "required" => [
                "email_id",
            ],
            "optional" => [
            ]
        ], 

        

        /**
         * 
         *  Dashboard 
         * 
         */

         

        "projectFetch" => [
            "required" => [
                "user_id",
            ],
            "optional" => [
            ]
        ], 

        "dashboardFetch" => [
            "required" => [
                "user_id", "project_id"
            ],
            "optional" => [
            ]
        ], 
        "dashboardReportsFetch" => [
            "required" => [
                "user_id", "project_id"
            ],
            "optional" => [
            ]
        ], 



        /*
            ContactUs Code
        */
        
        "contactToUs" => [
            "required" => [
                "name", "email_id", "mobile_no", "message"
            ],
            "optional" => [
            ]
        ], 


        /*
            Replace Order
        */
        
        "requestOrderReplace" => [
            "required" => [
                "name", "email_id", "mobile_no", "order_number",
                "packaging_intact", "problem_facing", "other_message", "description"
            ],
            "optional" => [
            ]
        ],         

        
        /*
            Payment Related Code
        */
        
        "paymentStatusCheck" => [
            "required" => [
                "user_id", "transaction_id"
            ],
            "optional" => [
            ]
        ],               

        /*
            Annas Code
        */
        "totalAnnasGet" => [
            "required" => [
                "user_id"
            ],
            "optional" => [
            ]
        ], 
        "annaHistoryGet" => [
            "required" => [
                "user_id"
            ],
            "optional" => [
            ]
        ], 

        

        /**
         * 
         *  Blog
         */


        "blogByIdGet" => [
            "required" => [
                "blog_id"
            ],
            "optional" => [
            ]
        ], 
        "blogSearch" => [
            "required" => [
                "keyword"
            ],
            "optional" => [
            ]
        ],
        "likeBlog" => [
            "required" => [
                'blog_id', 'user_id'
            ],
            "optional" => [
            ]
        ],
        "dislikeBlog" => [
            "required" => [
                'blog_id', 'user_id'
            ],
            "optional" => [
            ]
        ],
        "blogCommentCreate" => [
            "required" => [
                'blog_id', 'user_id', 'comments'
            ],
            "optional" => [
            ]
        ],
        
        "blogCommentsByIdGet" => [
            "required" => [
                'blog_id'
            ],
            "optional" => [
            ]
        ],



        /*
            Order Code
        */
        "orderCreate" => [
            "required" => [
                "user_id", "transaction_id", "all_product", "address_id", "payment_mode", "is_annas_used", "annas_amount"
            ],
            "optional" => [
            ]
        ], 

        "orderGet" => [
            "required" => [
                "user_id"
            ],
            "optional" => [
            ]
        ],         

        "productGetByOrder" => [
            "required" => [
                "user_id", "order_no"
            ],
            "optional" => [
            ]
        ],         

        "orderReview" => [
            "required" => [
                "user_id", "product_id", "rating"
            ],
            "optional" => [
            ]
        ],         
        




        /*
            User Profile
        */
        "userProfileGet" => [
            "required" => [
                "user_id"
            ],
            "optional" => [
            ]
        ], 
        "passwordChange" => [
            "required" => [
                "user_id", 'current_password', 'new_password', 'retype_password'
            ],
            "optional" => [
            ]
        ],
        
         
        /*
            Dasboard
        */
        "allCollectionGetByCategory" => [
            "required" => [
                "category_id"
            ],
            "optional" => [
            ]
        ],
        "productSearch" => [
            "required" => [
                "keyword"
            ],
            "optional" => [
            ]
        ],
        "productDetails" => [
            "required" => [
                "p_id"
            ],
            "optional" => [
            ]
        ],
        "productReviews" => [
            "required" => [
                "product_id"
            ],
            "optional" => [
            ]
        ],
        "notifyProduct" => [
            "required" => [
                "product_id", "name", "email_id", "mobile"
            ],
            "optional" => [
            ]
        ],
        "productRecommendationsGet" => [
            "required" => [
                "product_id"
            ],
            "optional" => [
            ]
        ],
        "productStepsGet" => [
            "required" => [
                "product_id"
            ],
            "optional" => [
            ]
        ],
        
        

       

    ],
];
