<?php

namespace App\Services;

use App\Models\Project;
use App\Models\Configuration;
use App\Models\Profile;
use App\Models\UserSubscription;
use App\Models\WhatsAppMessageHistory;
use App\Models\WhatsappMessage;
use App\Models\WhatsAppMessageStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        $this->collection               = 'collection';
        $this->commonSer                = new CommonService();
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
    
    
    public function getAllProject($param)
    {
        $response                       = [
            $this->status               => false,
            $this->message              => 'Data not found...',
            $this->code                 => 404,
            $this->data                 => [],
        ];

        $result = Project::with('industry')->where('user_id', $param['user_id'])

            ->where('is_active', '1')
            ->where('status', '1');
        $result                                 = $result->simplePaginate(3);
    
        if ($result->isNotEmpty())
        {
            $result->makeHidden([
                'subscription_id',
                'is_active',
                'updated_at',
                'deleted_at',
                'status'
            ]);

            $response                       = [
                $this->status               => true,
                $this->message              => 'Successfully list get...',
                $this->code                 => 200,
                $this->data                 => [
                    $this->total            => $result->count(),
                    $this->collection       => $result->toArray(),
                ],
            ];
        }

        return $response;
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
    
    
    public function getAllDashboardData($param)
    {
        $response                       = [
            $this->status               => false,
            $this->message              => 'Data not found...',
            $this->code                 => 404,
            $this->data                 => [],
        ];


        $config                         = Configuration::with('configurationHealthStatusEntities')
                                                        ->where('user_id', $param['user_id'])
                                                        ->where('project_id', $param['project_id'])
                                                        ->where('status', '1')
                                                        ->where('is_active', '1')
                                                        ->first();

        $profile                        = Profile::where('user_id', $param['user_id'])
                                                    ->where('project_id', $param['project_id'])
                                                    ->where('is_active', '1')
                                                    ->where('status', '1')
                                                    ->first();
        $activeSubscription             = UserSubscription::where('user_id', $param['user_id'])
                                                    ->orderBy('id', 'DESC')
                                                    ->first();

        if ($config || $profile || $activeSubscription)
        {

            $data['configuration']  = $data['profile'] = $data['active_plan'] = [];

            if ($config) {
                // Hide unwanted attributes from configuration.
                $config->makeHidden([
                    'user_id',
                    'project_id',
                    'code',
                    'code_expire_at',
                    'health_status_json',
                    'profile_access',
                    'template_created',
                    'session_info_response',
                    'sdk_response',
                    'is_active',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                    'status',
                ]);

                $data['configuration']  = $config->toArray();
            }

            if ($profile) {
                // Hide unwanted attributes from profile.
                $profile->makeHidden([
                    'user_id',
                    'project_id',
                    'is_active',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                    'status',
                ]);

                $data['profile']        = $profile->toArray();
            }

            if ($activeSubscription) {
                // Hide unwanted attributes from profile.
                $activeSubscription->makeHidden([
                    'user_id',
                    'rzp_plan_id',
                    'rzp_subscription_id',
                    'rzp_payment_id',
                    'rzp_order_id',
                    'rzp_invoice_id',
                    'rzp_customer_id',
                    'amount',
                    'currency',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ]);

                $data['active_plan']    = $activeSubscription->toArray();
            }

            
            $response                   = [
                $this->status           => true,
                $this->message          => 'Successfully data get...',
                $this->code             => 200,
                $this->data             => $data,
            ];
        }

        return $response;
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
    
    
    public function getAllDashboardReport($param)
    {
        $from                           = isset($param['from']) && !empty($param['from']) ? $param['from'] : date('Y-m-01');
        $to                             = isset($param['to']) && !empty($param['to']) ? $param['to'] : date('Y-m-d');
        $user_id                        = $param['user_id'];
        $projectId                      = $param['project_id'];
        

        $configuration                  = auth('api')->user()->configuration()->where('project_id', $projectId)->first();
      
        $wabaId                         = $configuration->whatsapp_business_account_id;
        $phoneNumberId                  = $configuration->phone_number_id;

        // Fetch recipient IDs & message IDs efficiently in a single step
        $messageIds = WhatsAppMessageHistory::whereIn('recipient_id', function ($query) use ( $wabaId, $phoneNumberId) {
            $query->select('recipient_id')
                ->from('campaign_details')
                ->where([
                  
                    ['waba_id', $wabaId],
                    ['phone_number_id', $phoneNumberId]
                ]);
        })
        ->where([
           
            ['waba_id', $wabaId],
            ['phone_num_id', $phoneNumberId]
        ])
        ->pluck('message_id');

      

        // Fetch status counts and date-wise grouped counts in a single query
        $statusData = WhatsAppMessageStatus::whereIn('message_id', $messageIds)
        ->where(function ($query) use ($from, $to) {
            $query->whereBetween('created_at', [$from, $to])
                  ->orWhereBetween('delivered_at', [$from, $to])
                  ->orWhereBetween('read_at', [$from, $to]);
        })
            ->selectRaw("
                message_status, 
                COUNT(DISTINCT message_id) as count,
                CASE 
                    WHEN message_status = 'sent' THEN DATE(created_at) 
                    WHEN message_status = 'delivered' THEN DATE(delivered_at) 
                    WHEN message_status = 'read' THEN DATE(read_at) 
                    WHEN message_status = 'failed' THEN DATE(created_at)
                END as date
            ")
            ->groupBy('message_status', 'date')
            ->orderBy('date', 'asc')
            ->get();

        // Initialize default values
        $statusCounts = ['sent' => 0, 'delivered' => 0, 'read' => 0, 'failed' => 0];
        $sentDates = $deliveredDates = $readDates = $failedDates = [];
       
        // Process results
        foreach ($statusData as $row) {
            $formattedDate = Carbon::parse($row->date)->format('d M');

            // Populate status count
            $statusCounts[$row->message_status] += $row->count;

            // Populate date-wise counts
            match ($row->message_status) {
                'sent'      => $sentDates[$formattedDate] = $row->count,
                'delivered' => $deliveredDates[$formattedDate] = $row->count,
                'read'      => $readDates[$formattedDate] = $row->count,
                'failed'    => $failedDates[$formattedDate] = $row->count,
            };
        }

        // Assign extracted counts
        $sentCount = $statusCounts['sent'];
        $deliveredCount = $statusCounts['delivered'];
        $readCount = $statusCounts['read'];
        $failedCount = $statusCounts['failed'];

        // Get unique date keys for graph consistency
        $allDates = collect(array_merge(
            array_keys($sentDates),
            array_keys($deliveredDates),
            array_keys($readDates),
            array_keys($failedDates)
        ))->unique()->sort()->values()->toArray();

        // // Ensure all datasets have the same date keys
        // $finalSentDates = $this->fillMissingDates($allDates, $sentDates);
        // $finalDeliveredDates = $this->fillMissingDates($allDates, $deliveredDates);
        // $finalReadDates = $this->fillMissingDates($allDates, $readDates);
        // $finalFaildDates = $this->fillMissingDates($allDates, $failedDates);



        // Ensure all datasets have the same date keys
        $finalSentDates = collect($this->fillMissingDates($allDates, $sentDates))
            ->map(fn($count, $date) => ['date' => $date, 'count' => $count])
            ->values()
            ->toArray();

        $finalDeliveredDates = collect($this->fillMissingDates($allDates, $deliveredDates))
            ->map(fn($count, $date) => ['date' => $date, 'count' => $count])
            ->values()
            ->toArray();

        $finalReadDates = collect($this->fillMissingDates($allDates, $readDates))
            ->map(fn($count, $date) => ['date' => $date, 'count' => $count])
            ->values()
            ->toArray();

        $finalFaildDates = collect($this->fillMissingDates($allDates, $failedDates))
            ->map(fn($count, $date) => ['date' => $date, 'count' => $count])
            ->values()
            ->toArray();
        
        $response                   = [
            $this->status           => true,
            $this->message          => 'Successfully data get...',
            $this->code             => 200,
            $this->data             => [
               
                'deliveredCount'    => $deliveredCount,
                'sentCount'         => $sentCount,
                'readCount'         => $readCount,
                'failedCount'       => $failedCount,
                'sentDate'          => $finalSentDates,
                'deliveredDate'     => $finalDeliveredDates,
                'readDate'          => $finalReadDates,
                'failedDate'        => $finalFaildDates,
                
            ]
        ];

        return $response;
    }

    private function fillMissingDates(array $allDates, array $data)
    {
        $filledData = [];
        foreach ($allDates as $date) {
            $filledData[$date] = $data[$date] ?? 0; // Assign 0 if the date is missing
        }
        return $filledData;
    }
    
    
    
    

}
