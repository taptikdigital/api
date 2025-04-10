<?php

namespace App\Services;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\ProductNotify;
use App\Models\ProductImage;
use App\Models\ProductRecommendation;
use App\Models\ProductStep;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Exception;
use App\Http\Controllers\Api\V1\BaseController;
use Log;
use App\Services\CommonService;



class DashboardService
{

    public function __construct()
    {
        $this->status                   = 'status';
        $this->message                  = 'message';
        $this->code                     = 'status_code';
        $this->data                     = 'data';
        $this->total                    = 'total_count';
        $this->commonSer                = new CommonService();
    }

    
    /**
        * @param[]
        * userId
        *
        * @return 
        * 200
        * 
        * @error
        * 404/201
        * 
    **/
    
    
    public function getAllCategoryList()
    {
        $return[$this->status]                  = false;
        $return[$this->message]                 = 'List not found...';
        $return[$this->code]                    = 404;
        $return[$this->data]                    = [];
        try{
            $result                             = Category::all();
            if($result->isNotEmpty())
            {
                $result = $result->map(function ($item) {
                    unset($item['created_at']);
                    return $item;
                })->toArray();
                $return[$this->status]          = true;
                $return[$this->message]         = 'Successfully list found...';
                $return[$this->code]            = 200;
                $return[$this->data]            = $result;
            }
        }
        catch (Exception $e) {
            $except['status']                   = false;
            $except['error'][]                  = 'Exception Error...';
            $except['message']                  = $e;
            $exception                          = new BaseController();
            $exception                          = $exception->throwExceptionError($except, 500);
            return $except;
        }
        return $return;
    }
    
    

    
    /**
        * @param[]
        * 
        * @return 
        * 200
        * 
        * @error
        * 404/201
        * 
    **/
    
    
    public function getAllDashboardData()
    {
        $response = [
            $this->status  => false,
            $this->message => 'Data not found...',
            $this->code    => 404,
            $this->data    => [],
        ];

        $products = Product::with(['discount', 
            'productSku' => function ($query) {
                $query->where('is_live', 1)
                        ->where('status', 1);
            }, 
            'productSku.units', 'category'])
            ->with('overAllReviews')
            ->where('status', '1')
            ->where('is_live', '1')
            ->get();

        $banners = Banner::where('is_live', '1')->where('status', '1')
            ->orderBy('name', 'asc')->get();

        $category = Category::where('is_live', '1')->where('status', '1')
            ->orderBy('name', 'asc')->get();

        if ($products->isNotEmpty() || $banners->isNotEmpty() || $category->isNotEmpty()) 
        {

            // Add the dynamically field 'out of stock' to each product's variants 
            $products->each(function ($product) {
                // Assume out_of_stock is true by default
                $outOfStock = true;
            
                // Check if any sku has quantity greater than 0
                foreach ($product->productSku as $val) {
                    if ($val->quantity > 0) {
                        // If any sku has quantity > 0, set out_of_stock to false
                        $outOfStock = false;
                        // No need to continue checking other skus
                        break;
                    }                    
                }
            
                // Set the out_of_stock property for the product
                $product->out_of_stock = $outOfStock;

                if (count($product->overAllReviews) > 0) {
                    $product->overAllReviews[0]->rating = round($product->overAllReviews[0]->rating, 2);
                }
            });


            $products->makeHidden([
                'description',
                'highlight',
                'ingredient',
                'nutritional_information',
                'dietary_preference',
                'other_feature',
                'spice_level',
                'meta_title',
                'meta_description',
                'meta_keyword',
                'created_at'
            ]);

            
            
            // Group products by category_id and keep safe from category_id as a key
            $groupedProducts = $products->groupBy('category_id')->map(function ($products) {
                return $products->map(function ($product) {
                    return $product;
                });
            })->values(); // This will reset the keys

            $constant = config('constants.meta_data');
            $metaData                             = [
                'title'                  => $constant['title'],
                'meta_title'             => $constant['meta_title'],
                'meta_description'       => $constant['meta_description'],
                'meta_keywords'          => $constant['meta_keywords'],
                'meta_site_name'         => $constant['meta_site_name'],
                'meta_site_url'          => $constant['meta_site_url'],
                'type'                   => $constant['type'],
                'img_url'                => $constant['meta_img'],
            ];
            
            $response[$this->status]              = true;
            $response[$this->message]             = 'Successfully data get...';
            $response[$this->code]                = 200;
            $response[$this->data]['banners']     = $banners->toArray();
            $response[$this->data]['category']    = $category->toArray();
            $response[$this->data]['collections'] = $groupedProducts->toArray();
            $response[$this->data]['metadata']    = $metaData;
        }

        return $response;
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
    
    
    public function fetchAllCollectionByCategory($param)
    {
        $response = [
            $this->status                       => false,
            $this->message                      => 'Data not found...',
            $this->code                         => 404,
            $this->data                         => [],
        ];

        $result                                 = Product::with(['discount',
                                                        'productSku' => function ($query) {
                                                            $query->where('is_live', 1)
                                                                    ->where('status', 1);
                                                        }, 
                                                        'productSku.units', 'category'])
                                                        ->with('overAllReviews')
                                                        ->where('category_id', $param['category_id'])
                                                        ->where('is_live', 1)
                                                        ->where('status', 1)
                                                        ->orderBy('name', 'asc');
        $total_count                            = $result->count();
        $result                                 = $result->simplePaginate(12);
        
        if ($result->isNotEmpty())
        {
            
            // Add the dynamically field 'out of stock' to each product's variants 
            $result->each(function ($product) {
                // Assume out_of_stock is true by default
                $outOfStock = true;
            
                // Check if any sku has quantity greater than 0
                foreach ($product->productSku as $val) {
                    if ($val->quantity > 0) {
                        // If any sku has quantity > 0, set out_of_stock to false
                        $outOfStock = false;
                        // No need to continue checking other skus
                        break;
                    }
                }
            
                // Set the out_of_stock property for the product
                $product->out_of_stock = $outOfStock;
                if (count($product->overAllReviews) > 0) {
                    $product->overAllReviews[0]->rating = round($product->overAllReviews[0]->rating, 2);
                }
            });

            
            $result->makeHidden([
                'description',
                'highlight',
                'ingredient',
                'nutritional_information',
                'dietary_preference',
                'other_feature',
                'spice_level',
                'meta_title',
                'meta_description',
                'meta_keyword',
                'created_at'
            ]);

            $response[$this->status]            = true;
            $response[$this->message]           = 'Successfully list get...';
            $response[$this->code]              = 200;
            $response[$this->data]              = $result->toArray();
        }
        
        return $response;
    }
    
    
    
    /**
        * @method searchProductList
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
    
    
    public function searchProductList($param)
    {
        $response = [
            $this->status   => false,
            $this->message  => 'Data not found...',
            $this->code     => 404,
            $this->data     => [],
        ];

        $result = Product::with(['discount', 
        'productSku' => function ($query) {
            $query->where('is_live', 1)
                    ->where('status', 1);
        }, 
        'productSku.units', 'category'])
        ->with('overAllReviews');

        if ($param['keyword']) {
            $result->where(function ($query) use ($param) {
                $query->where('name', 'like', '%' . $param['keyword'] . '%')
                    ->orWhere('description', 'like', '%' . $param['keyword'] . '%')
                    ->orWhere('type', 'like', '%' . $param['keyword'] . '%');
                    // ->orWhere('amount', 'like', '%' . $param['keyword'] . '%');
            });
        }

        $result->where('is_live', 1);

        $total_count = $result->count();
        $result = $result->simplePaginate(12);

        if ($result->isNotEmpty()) {

            // Add the dynamically field 'out of stock' to each product's variants 
            $result->each(function ($product) {
                // Assume out_of_stock is true by default
                $outOfStock = true;
            
                // Check if any sku has quantity greater than 0
                foreach ($product->productSku as $val) {
                    if ($val->quantity > 0) {
                        // If any sku has quantity > 0, set out_of_stock to false
                        $outOfStock = false;
                        // No need to continue checking other skus
                        break;
                    }
                }
            
                // Set the out_of_stock property for the product
                $product->out_of_stock = $outOfStock;
                if (count($product->overAllReviews) > 0) {
                    $product->overAllReviews[0]->rating = round($product->overAllReviews[0]->rating, 2);
                }
            });

            $result->makeHidden([
                'description',
                'highlight',
                'ingredient',
                'nutritional_information',
                'dietary_preference',
                'other_feature',
                'spice_level',
                'meta_title',
                'meta_description',
                'meta_keyword',
                'created_at'
            ]);
            
            $response[$this->status]  = true;
            $response[$this->message] = 'Successfully list get...';
            $response[$this->code]    = 200;
            $response[$this->data]    = $result->toArray();
        }

        return $response;
    }
    
    
    
    
    /**
        * @method fetchProductDetails
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



    public function fetchProductDetails($param)
    {
        $response = [
            $this->status => false,
            $this->message => 'Data not found...',
            $this->code => 404,
            $this->data => [],
        ];

        $result = Product::with(['discount', 
            'productSku' => function ($query) {
                $query->where('is_live', 1)
                        ->where('status', 1);
            }, 
            'productSku.units', 'category', 'images'])
            ->where('slug', $param['p_id'])
            ->where('is_live', 1)
            ->first();

        if ($result) {

            // Fix: Make sure to load the relationships before transforming to array
            $result->load('category');
            
            // Add the dynamically field 'out of stock' to each product's variants             
            // Assume out_of_stock is true by default
            $outOfStock = true;
        
            // Check if any sku has quantity greater than 0
            foreach ($result->productSku as $val) {
                if ($val->quantity > 0) {
                    // If any sku has quantity > 0, set out_of_stock to false
                    $outOfStock = false;
                    // No need to continue checking other skus
                    break;
                }
            }
        
            // Set the out_of_stock property for the product
            $result->out_of_stock = $outOfStock;


            $resultArray = $result->toArray();

            // Extracting main image
            $mainImage = $resultArray['image'];

            // Removing the main image from the images array
            $images = $resultArray['images'];
            $filteredImages = array_filter($images, function ($image) use ($mainImage) {
                return $image['image'] !== $mainImage;
            });

            // Prepending the main image to the images array
            array_unshift($filteredImages, ['id' => 0, 'product_id' => $resultArray['id'],'image' => $mainImage]);

            // Updating the images property with the modified array
            $resultArray['images'] = $filteredImages;

            $result->makeHidden(['created_at']);

            $response[$this->status] = true;
            $response[$this->message] = 'Successfully list get...';
            $response[$this->code] = 200;
            $response[$this->data] = [
                
                // 'description' => collect($result->toArray())
                'description' => $resultArray
            ];
        }

        return $response;
    }
    
    
    
    
    
    
    /**
        * @method fetchProductReviews
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



    public function fetchProductReviews($param)
    {
        $response[$this->status]                    = true;
        $response[$this->message]                   = 'Reviews not available...';
        $response[$this->code]                      = 200;
        $response[$this->data]                      = [
            'average_rating'                        => 0,
            'reviews_by_rating'                     => 0,
            'total'                                 => 0,
            'reviews'                               => [],
        ];

        $result                                     = ProductReview::with('user:id,name')
                                                        ->where('product_id', $param['product_id'])
                                                        ->whereNotNull('comment')
                                                        ->where('is_live', 1)
                                                        ->orderBy('id', 'DESC');
        $reviews                                    = $result->get();
        $total_count                                = $reviews->count();

        if (count($reviews)>0) {

            $result                                     = $result->simplePaginate(20);
            $averageRating                              = $result->avg('rating');
            $reviewsByRating                            = [];
            for ($i = 1; $i <= 5; $i++) {
                $reviewsByRating[$i]                    = $reviews->where('rating', $i)->count();
            }            
            // Arrange the array in descending order of ratings
            krsort($reviewsByRating);
            $result->makeHidden(['user_id','product_id']);

            $response[$this->status]                    = true;
            $response[$this->message]                   = 'Successfully list get...';
            $response[$this->code]                      = 200;
            $response[$this->data]                      = [
                'average_rating'                        => round($averageRating,1) ?? 0,
                'reviews_by_rating'                     => $reviewsByRating,
                'total'                                 => $total_count,
                'reviews'                               => $result->toArray()
            ];
        }


        return $response;
    }
    
    
    /**
        * @method createProductNotify
        * @param[]
        * productId
        * name
        * email
        * mobile
        * 
        * @return 
        * 200
        * 
        * @error
        * 404/201
        * 
    **/



    public function createProductNotify($param)
    {
        // Default response structure
        $response = [
            $this->status => false,
            $this->message => 'Oops, something went wrong...',
            $this->code => 500,
            $this->data => [],
        ];

        if (!empty($param['product_id'])) {

            try {
                // Begin the database transaction
                \DB::beginTransaction();

                // Create the order Review
                $order = ProductNotify::create([
                    'product_id'            => $param['product_id'],
                    'name'                  => $param['name'],
                    'mobile'                => $param['mobile'],
                    'email'                 => $param['email_id'],
                    'created_at'            => now(),
                    'updated_at'            => now(),
                ]);


                // Commit the transaction
                \DB::commit();

                $response = [
                    $this->status => true,
                    $this->message => 'Successfully your request submitted...',
                    $this->code => 200,
                    $this->data => [],
                ];
            } catch (\Exception $e) {
                \DB::rollBack();
                $response = [
                    $this->status => false,
                    $this->message => 'Oops, please try again...',
                    $this->code => 500,
                    'error' => 'Exception Error...',
                    'exception' => $e->getMessage(),
                ];

                $exception                  = new BaseController();
                $exception                  = $exception->throwExceptionError($response, 500);
            }
        }

        return $response;
    }
    
    
    






    
    /**
        * @method fetchProductRecommendations
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



    public function fetchProductRecommendations($param)
    {
        $response[$this->status]                    = true;
        $response[$this->message]                   = 'Recommendation not available...';
        $response[$this->code]                      = 404;
        $response[$this->data]                      = [];

        $result                                     = ProductRecommendation::where('product_id', $param['product_id'])
                                                        ->where('is_live', 1)
                                                        ->orderBy('id', 'DESC')
                                                        ->get();
        

        if (count($result)>0) {


            $result->makeHidden(['product_id']);


            foreach ($result as $key => $value) {
                if($value->type == 'video')
                {
                    $videoOutPutPath                            = config('app.recommendation_video_url');
                    $value->video_url  = $videoOutPutPath.'/'.$value->unique_code.'/master.m3u8';
                }  
            }

            $response[$this->status]                    = true;
            $response[$this->message]                   = 'Successfully list get...';
            $response[$this->code]                      = 200;
            $response[$this->data]                      = $result->toArray();
        }


        return $response;
    }
    
    
    /**
        * @method fetchProductSteps
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



    public function fetchProductSteps($param)
    {
        $response[$this->status]                    = true;
        $response[$this->message]                   = 'Steps not available...';
        $response[$this->code]                      = 404;
        $response[$this->data]                      = [];

        $result                                     = ProductStep::where('product_id', $param['product_id'])
                                                        ->where('is_live', 1)
                                                        ->orderBy('id', 'DESC')
                                                        ->get();
        if (count($result)>0) {

            $result->makeHidden(['product_id']);

            $response[$this->status]                    = true;
            $response[$this->message]                   = 'Successfully list get...';
            $response[$this->code]                      = 200;
            $response[$this->data]                      = $result->toArray();
        }


        return $response;
    }
    


}
