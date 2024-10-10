<?php

namespace App\Http\Controllers\Api\V1\Client;

use Carbon\Carbon;
use App\Models\Bank;
use App\Models\User;
use App\Models\Image;
use App\Models\BuyNow;
use App\Models\Client;
use App\Models\EmiDeatil;
use App\Models\FinanceType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProcessingFee;
use App\Models\SupportTicket;
use App\Traits\ResponseTrait;
use Illuminate\Http\Response;
use App\Models\Request as Req;
use App\Models\SupportMessage;
use App\Traits\FileUploadTrait;
use App\Models\AdminNotification;
use App\Http\Controllers\Controller;
use App\Notifications\RequestStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;

class ApiController extends Controller
{
    /**
     * Response trait to handle return responses.
     */
    use ResponseTrait, FileUploadTrait;

    /**
     * Send Request
     *
     * @param  mixed $request Array | []
     * @return void
     */

    public function sendRequest(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'                      => 'required|max:40',
                'email'                     => 'email|unique:requests',
                'phone'                     => 'required|unique:requests|max:10|min:10',
                'alternate_phone'           => 'required|unique:requests|max:10|min:10',
                'occupation'                => 'required|max:80',
                'adhar_card_no'             => 'required|max:12|min:12',
                'pan_card_no'               => 'required|max:10|min:10',
                'price'                     => 'required|max:10',
                'down_payment'              => 'required|max:10',
                'emi_months'                => 'required|max:2',
                'bank_id'                   => 'required|exists:banks,id',
                'finance_type_id'           => 'required|exists:finance_types,id',
            ]
        );

        if ($validator->fails()) {
            return $this->responseError($validator->errors(), 'Invalid Request !', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $request->merge(['user_id' => Auth::user()->user_id]);
        $request->merge(['sale_id' => Auth::user()->id]);
        $request->has('email') ? '' : $request->merge(['email' => str_replace(' ', '', $request->name) . '.' . $request->adhar_card_no . '@gmcredit.xyz']);

        $save = Req::create($request->all());

        $notification = [
            'user_id' =>  Auth::user()->user_id,
            'client_id' => Auth::user()->id,
            'title' => 'New Request Added !!',
            'type' => 'new_request',
            'click_url' => route('admin.request.index')
        ];
        AdminNotification::create($notification);

        return $this->responseSuccess($save, 'Request Added !!', Response::HTTP_OK);
    }

    /**
     * My Requests
     *
     * @param  mixed $request Array | []
     * @return void
     */

    public function myRequests()
    {
        $requests = Req::with('files')->where(['sale_id' => Auth::user()->id])->latest()->paginate(50);
        return $this->responseSuccess($requests, 'My Requests', Response::HTTP_OK);
    }

    /**
     * Send Request
     *
     * @param  mixed $request Array | []
     * @return void
     */

    public function buyNow(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'request_id'    => 'required|exists:requests,id',
                'bank_id'       => 'required|exists:banks,id',
                'acc_no'        => 'required|max:20|min:6',
                'ifsc_code'     => 'required|max:12|min:6',
                'imei_no'       => 'required|max:20|min:6',
                'imei_no_two'   => 'max:20|min:6',
                'device_id'     => 'max:100',
                'device_name'   => 'max:100',
            ]
        );

        if ($validator->fails()) {
            return $this->responseError($validator->errors(), 'Invalid Request !', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $request->merge(['sale_id' => Auth::user()->id]);
        $add = BuyNow::create($request->all());

        // Buy Now Added Check
        if ($add) {

            $find = Req::with(['bank', 'finance'])->find($request->request_id);
            $client = Client::whereEmail($find->email)->first();
            
            $add->finance_type_id =  $find->finance_type_id;
            $add->down_payment = $find->down_payment;
            $add->price = $find->price;

            if (!$client) {
                //Add Client
                $client_insert = [
                    'name'              => $find->name,
                    'phone'             => $find->phone,
                    'alternate_phone'   => $find->alternate_phone,
                    'occupation'        => $find->occupation,
                    'email'             => $find->email,
                    'sale_id'           => $find->sale_id,
                    'adhar_card_no'     => $find->adhar_card_no,
                    'pan_card_no'       => $find->pan_card_no,
                    'status'            => 1,
                    'password'          => Hash::make($find->adhar_card_no),
                    'type'              => 'customer',
                ];

                $client = Client::create($client_insert);
                $client_insert['password'] = $find->adhar_card_no;
                // Mail::to($find->email)->send(new CustomerRegister($client_insert));

                Image::whereRequestId($find->id)->update(['client_id' => $client->id, 'request_id' => NULL]);
            }

            $add->client_id = $client->id;
            $add->save();

            //Add Emi Data
            $dates  = self::emiRange($find->emi_months);
            $processing_fee = self::checkPriceBetween($find->finance->processingFees,  $find->price);

            $emi    = self::emiPerMonth($find->emi_months, ($find->price - $find->down_payment + $processing_fee), $find->bank->interest);
            $insert = [
                'client_id'     => $client->id,
                'buy_now_id'    => $add->id,
                'emi_amount'    => $emi
            ];

            $find->forceDelete();

            foreach ($dates as $key => $date) {
                $insert['emi_seq']      = ++$key;
                $insert['emi_month']    = $date;
                EmiDeatil::create($insert);
            }

            return $this->responseSuccess($add, 'Request Added !!', Response::HTTP_OK);
        }
        return $this->responseError([], 'Soemthing went wrong !', Response::HTTP_BAD_REQUEST);
    }

    /**
     * Send Request
     *
     * @param  mixed $request Array | []
     * @return void
     */

    public function uploadImages(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'type'          => 'required',
                'request_file'  => 'required|file|mimes:jpeg,png,jpg',
                'request_id'    => 'required_without_all:buy_now_id,client_id|exists:requests,id',
                'buy_now_id'    => 'required_without_all:request_id,client_id|exists:buy_nows,id',
                'client_id'     => 'required_without_all:request_id,buy_now_id|exists:clients,id',
            ]
        );

        if ($validator->fails()) {
            return $this->responseError($validator->errors(), 'Invalid Request !', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($request->has('request_id')) {
            if ($request->file('request_file')) {
                $file = $this->uploadFile('uploads/request/' . str_replace('_', '-', $request->type) . '/', $request->file('request_file'), false);
                $request->merge(['file' => $file]);
            }
        }

        if ($request->has('buy_now_id')) {
            if ($request->file('request_file')) {
                $file = $this->uploadFile('uploads/buynow/' . str_replace('_', '-', $request->type) . '/', $request->file('request_file'), false);
                $request->merge(['file' => $file]);
            }
        }

        if ($request->has('client_id')) {
            if ($request->file('request_file')) {
                $file = $this->uploadFile('uploads/request/' . str_replace('_', '-', $request->type) . '/', $request->file('request_file'), false);
                $request->merge(['file' => $file]);
            }
        }

        Image::create($request->all());
        return $this->responseSuccess([], 'File Uploaded !!', Response::HTTP_OK);
    }

    /**
     * Update Client Address
     *
     * @param  mixed $request Array | []
     * @return void
     */

    public function updateAddress(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'address'   => 'required|max:255',
                'lat'       => 'required|between:-90,90',
                'lng'       => 'required|between:-180,180'
            ]
        );

        if ($validator->fails()) {
            return $this->responseError($validator->errors(), 'Invalid Request !', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $requests = Client::where(['id' => Auth::user()->id])->update($request->only(['address', 'lat', 'lng']));
        return $this->responseSuccess($requests, 'Location Updated', Response::HTTP_OK);
    }

    /**
     * My Emi Details
     *
     * @param  mixed $request Array | []
     * @return void
     */

    public function myEmiDetails()
    {
        $requests = EmiDeatil::with('fines')->where(['client_id' => Auth::user()->id])->paginate(50);
        return $this->responseSuccess($requests, 'My Requests', Response::HTTP_OK);
    }

    /**
     * Banks List
     *
     * @param  mixed 
     * @return void
     */

    public function banksList()
    {
        $banks = Bank::select('id', 'title', 'interest')->whereStatus(1)->get();
        return $this->responseSuccess($banks, 'Banks List', Response::HTTP_OK);
    }

    /**
     * Finance Type List
     *
     * @param  mixed 
     * @return void
     */

    public function financeList()
    {
        $finances = FinanceType::select('id', 'title')->with('processingFees:id,finance_type_id,price,start_price,end_price')->whereStatus(1)->get();
        return $this->responseSuccess($finances, 'Finance Types', Response::HTTP_OK);
    }

    /**
     * Processing Fee List
     *
     * @param  mixed 
     * @return void
     */

    public function processingFees()
    {
        $finances = ProcessingFee::select('id', 'price', 'start_price', 'end_price', 'finance_type_id')->with('financeType:id,title')->whereStatus(1)->get();
        return $this->responseSuccess($finances, 'Processing Fees', Response::HTTP_OK);
    }

    /**
     * Support Ticket List
     *
     * @param  mixed 
     * @return void
     */

    public function supportTicketList()
    {
        $tickets = SupportTicket::with('lastMessage')->whereClientId(Auth::user()->id)->paginate(50);
        return $this->responseSuccess($tickets, 'Support Tickets', Response::HTTP_OK);
    }

    /**
     * Support Ticket Create
     *
     * @param  mixed 
     * @return void
     */

    public function supportTicketCreate(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email'         =>   'required|email|max:40',
                'subject'       =>   'required|max:250',
                'message'       =>   'required|min:1',
                'priority'      =>   'required|in:1,2,3',
            ]
        );

        if ($validator->fails()) {
            return $this->responseError($validator->errors(), 'Invalid Data !', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $insert = [
            'client_id'         => Auth::user()->id,
            'email'             => $request->email,
            'subject'           => $request->subject,
            'priority'          => $request->priority,
            'ticket'            => Str::upper(Str::random(10))
        ];

        $ticket = SupportTicket::create($insert);

        $insert_message = [
            'support_ticket_id' => $ticket->id,
            'client_id'         => Auth::user()->id,
            'message'           => $request->message,
        ];
        SupportMessage::create($insert_message);
        return $this->responseSuccess($ticket, 'Support Tickets', Response::HTTP_OK);
    }

    /**
     * Support Messagess
     *
     * @param  mixed 
     * @return void
     */

    public function supportMessages($id)
    {
        $tickets = SupportTicket::with('supportMessages')->whereClientId(Auth::user()->id)->whereId($id)->first();
        return $this->responseSuccess($tickets, 'Support Tickets', Response::HTTP_OK);
    }

    /**
     * Support Ticket Message Create
     *
     * @param  mixed 
     * @return void
     */

    public function supportTicketMessageCreate(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'support_ticket_id'     =>   'required|exists:support_tickets,id',
                'message'               =>   'required|min:1',
            ]
        );

        if ($validator->fails()) {
            return $this->responseError($validator->errors(), 'Invalid Data !', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $ticket =  SupportTicket::whereClientId(Auth::user()->id)->whereId($request->support_ticket_id)->exists();
        if ($ticket) {
            $insert_message = [
                'support_ticket_id' => $request->support_ticket_id,
                'client_id'         => Auth::user()->id,
                'message'           => $request->message,
            ];
            $message = SupportMessage::create($insert_message);

            $notification = [
                'user_id' =>  Auth::user()->user_id,
                'client_id' => Auth::user()->id,
                'title' => 'New Support Message from ' . Auth::user()->name,
                'type' => 'new_support_message',
                'click_url' => route('admin.support.message.index', base64_encode($request->support_ticket_id))
            ];
            AdminNotification::create($notification);

            return $this->responseSuccess($message, 'Support Tickets', Response::HTTP_OK);
        }
        return $this->responseError([], 'Ticket Not Found', Response::HTTP_BAD_REQUEST);
    }

    private function emiPerMonth($term, $amount, $rate)
    {
        $rate = $rate / (12 * 100);
        $emi = $amount * $rate * (pow(1 + $rate, $term) / (pow(1 + $rate, $term) - 1));
        return ceil($emi);
    }

    private function emiRange($term)
    {
        $dates = [];

        $currentDateTime = Carbon::now()->addMonth(1);
        $newDateTime = Carbon::now()->addMonth($term);

        for ($date = $currentDateTime->copy(); $date->lte($newDateTime); $date->addMonth()) {
            $dates[] = $date->format('Y-m-d');
        }
        return $dates;
    }

    function checkPriceBetween($prices, $check)
    {
        // Loop through the prices array.
        foreach ($prices as $price) {
            // Check if the price is between the start price and end price.
            if ($check >= $price->start_price && $check <= $price->end_price) {
                return $price->price;
            }
        }

        return 0;
    }

    public function isAppInstalledActive()
    {
        date_default_timezone_set('Asia/Kolkata');
        $data =  Client::whereId(auth()->user()->id)->update(['last_active' => date("Y-m-d H:i:s", time())]);
        return $this->responseSuccess($data, 'App Installed', Response::HTTP_OK);
    }

    /**
     * TEST NOTIFICATION
     *
     * @param  mixed 
     * @return void
     */

    public function notification(Request $request)
    {
        $data = ['body' => 'Hi Sahil Your request has been approved by the admin.', 'title' => 'Request Approved', 'type' => 'request_status'];
        Notification::route('fcm', $request->token)->notify(new RequestStatus($data));
        return $this->responseSuccess([], 'SENT', Response::HTTP_OK);
    }
}
