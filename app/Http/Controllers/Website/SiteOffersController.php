<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang as Lang;
use Validator;
class SiteOffersController extends Controller
{
/*

 */
public function bookOffer(Request $request)
    {

        if (!session()->get("SiteUser")) {
            $sessionOfferBook = [
                // 'ID' => $request->id,
                'offer_id' => $request->offer_id,
            ];
            session(['cartItem' => $sessionOfferBook]);

            \Log::info(\Session::get('cartItem'));

            return redirect()->route("siteLogin");
        }

        if(session()->get("SiteUser")){
            $sessionOfferBook = [
                // 'ID' => $request->id,
                'offer_id' => $request->offer_id,
            ];
            session(['cartItem' => $sessionOfferBook]);

            \Log::info(\Session::get('cartItem'));
        }else{
            return redirect("/safer/login");
        }
        $CartItem = new Cart();
        $CartItem->user_id = session()->get("SiteUser")["ID"];
        $CartItem->offer_id = $request->offer_id;
        $CartItem->adults_count = 1;
        $CartItem->tour_date = date_format(now(), "Y-m-d");
        $CartItem->item_type = 1; // -> Tour
        $CartItem->ages = null;
        $CartItem->save();
        session()->put("hasCart", 1);

        return redirect()->to("/cart")->with("session-success", "Tour is added in your cart successfully");

    }
}
