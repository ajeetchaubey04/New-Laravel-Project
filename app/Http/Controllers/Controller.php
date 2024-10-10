<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home(Request $request)
    {
        $data = self::common();
        $data['products'] = Product::all();
        return view('index', $data);
    }

    public static function common()
    {
        // Logic for common data
        return ['key' => 'value']; // Replace this with your actual data
    }

    public function aboutUs(Request $request){

        return view('aboutus');
    }

    public function blogs(Request $request){


        return view('blogs');
    }

    public function services(Request $request){


        return view('services');
    }
    public function contact(Request $request){

        return view('contact');
    }
}
