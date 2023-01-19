<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\ShortUrlRequest;
use App\Models\Link;
use Vinkla\Hashids\Facades\Hashids;

class MainController extends Controller
{
    public function getShortUrl(ShortUrlRequest $request){
      try{
        $reference = $request->validated()['reference'];

        $link = Link::firstOrCreate(
          ['url' => $reference],
          ['token' => Hashids::encode($this->mstime())],
        )->token;

        return response()->json(
            ['token' => $request->getHttpHost().'/'.$link,
             'token_name' => $link]
          ,200,[],JSON_UNESCAPED_SLASHES);
      }
      catch (\Exception $e) {
        return response()->json(['message' => $e],500);
      }
    }

    public function getLongUrl($reference){
      
      $link = Link::where('token',$reference)->firstOrFail();
    //  dd($link['url']);

      return \Redirect::to($link['url']);
    }

    private function mstime(){
      $mstime = explode(' ',microtime());
      return $mstime[1].''.(int)($mstime[0]*1000);
    }
}
