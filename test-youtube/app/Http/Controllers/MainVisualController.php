<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\v1\MainController;
use App\Http\Requests\MainUrlRequest;

class MainVisualController extends Controller
{
    public function __invoke(MainUrlRequest $request)
    {
        try{
            $mainCntroller = new MainController;
            $data = $mainCntroller->getShortUrl($request);
            if($data->getStatusCode()===200){
                return redirect()->route('home')->with(
                    [
                        'short_url' => $data->getData()->token,
                        'token_name' => $data->getData()->token_name,
                    ]
                );
            } else {
                return redirect()->route('home')->with(
                    $data->getData()
                );            
            }
        }
        catch (\Exception $e) {
            dd($e);
        }
    }
}
