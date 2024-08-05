<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Company;
use App\Models\Counter;
use App\Models\Offer;
use App\Models\OfferDetails;
use App\Models\OrderDetails;
use App\Models\OrderPersons;
use App\Models\Orders;
use App\Models\Tour;
use App\Models\TourDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang as Lang;

abstract class ItemType
{
    const ROOM = 0;
    const TOUR = 1;
// etc.
}
class BookingController extends Controller
{
    public function BookRoom(int $id, int $cap)
    {
        if (!session()->get("SiteUser")) {
            session()->put("cartItem", [
                "ID" => $id,
                "Cap" => $cap,
                "Nights" => (session()->get("sessionArr")) ? session()->get("sessionArr")["nights"] : 7,
                "adultsNumber" => (session()->get("sessionArr")) ? session()->get("sessionArr")["adultsNumber"] : 1,
                "childNumber" => (session()->get("sessionArr")) ? session()->get("sessionArr")["childNumber"] : 0,
                "roomsNumber" => (session()->get("sessionArr")) ? session()->get("sessionArr")["roomsNumber"] : 1,
                "from_date" => (session()->get("sessionArr")) ? date_format(date_create(session()->get("sessionArr")["from_date"]), "Y-m-d") : date("Y-m-d"),
                "to_date" => (session()->get("sessionArr")) ? date_format(date_create(session()->get("sessionArr")["end_date"]), "Y-m-d") : Date("Y-m-d", strtotime('+7 days')),
                'ages' => (session()->get("sessionArr")) ? session()->get("sessionArr")["ages"] : [],
                'itemType' => 0, // Room
            ]);

            return redirect()->route("siteLogin");
        }

        $CartItem = Cart::where([["user_id", '=', session()->get("SiteUser")["ID"]], ["item_type", '=', 0]])->first();

        if ($CartItem) { // Has Room ?
            return redirect()->to("/mwakeb/room/$id/book/$cap")->with("session-warning", Lang::get('links.purchase'));
        }

        $CartItem = new Cart();
        $CartItem->user_id = session()->get("SiteUser")["ID"];
        $CartItem->room_type_cost_id = $id;
        $CartItem->room_cap = $cap;
        $CartItem->adults_count = (session()->get("sessionArr")) ? session()->get("sessionArr")["adultsNumber"] : 1;
        $CartItem->children_count = (session()->get("sessionArr")) ? session()->get("sessionArr")["childNumber"] : 0;
        $CartItem->rooms_count = (session()->get("sessionArr")) ? session()->get("sessionArr")["roomsNumber"] : 1;
        $CartItem->nights = (session()->get("sessionArr")) ? session()->get("sessionArr")["nights"] : 7;
        $CartItem->from_date = (session()->get("sessionArr")) ? date_format(date_create(session()->get("sessionArr")["from_date"]), "Y-m-d") : date("Y-m-d");
        $CartItem->to_date = (session()->get("sessionArr")) ? date_format(date_create(session()->get("sessionArr")["from_date"]), "Y-m-d") : date("Y-m-d", strtotime('+7 days'));
        $CartItem->item_type = 0;

        if (!session()->get("sessionArr") || !session()->get("sessionArr")["ages"]) {
            $CartItem->ages = null;
        } else {
            $CartItem->ages = implode(",", session()->get("sessionArr")["ages"]);
        }
        $CartItem->save();
        session()->put("hasCart", 1);

        return redirect()->to("/cart")->with("session-success", Lang::get('links.roomMsg'));

    }
    public function ExBookRoom(int $id, int $cap)
    {
        Cart::where([["user_id", '=', session()->get("SiteUser")["ID"]], ['item_type', '=', 0]])->delete();
        return $this->BookRoom($id, $cap);
    }
    public function Cart()
    {
        $BreadCrumb = [];
        $Company = Company::first();

        $Counters = Counter::get();

        $RoomCost = DB::table("cart")
            ->select(
                'cart.user_id',
                'cart.room_type_cost_id',
                'cart.id',
                'cart.room_cap',
                'cart.adults_count',
                'cart.children_count',
                'cart.rooms_count',
                'cart.nights',
                'cart.ages',
                'hotel_enoverview',
                'hotels.hotel_stars',
                'hotels.hotel_enname',
                'hotels.hotel_arname',
                'cart.id',
                'cart.from_date',
                'cart.to_date',
                'en_room_type',
                'food_bev_type',
                'ar_room_type',
                'cost',
                'single_cost',
                'double_cost',
                'triple_cost',
                'hotel_id',
                'hotel_banner',
                'countries.en_country',
                'countries.ar_country',
                'cities.en_city',
                'cities.ar_city',
                'child_free_age_from',
                'cart.item_type',
                'child_free_age_to',
                'child_age_from',
                'child_age_to',
                'child_age_cost'
            )
            ->leftJoin("room_type_costs", "room_type_costs.id", "=", "cart.room_type_cost_id")
            ->leftJoin("hotels", "hotels.id", "=", "room_type_costs.hotel_id")
            ->leftJoin("cities", "hotels.city_id", "=", "cities.id")
            ->leftJoin("countries", "countries.id", "=", "cities.country_id")
            ->leftJoin("room_types", "room_types.id", "=", "room_type_costs.room_type_id")
            ->leftJoin("food_beverages", "food_beverages.id", "=", "room_type_costs.food_beverage_id")
            ->where([["user_id", "=", session()->get("SiteUser")["ID"]], ["cart.item_type", '=', 0]])
            ->first();

        $ToursCost = DB::table("cart")
            ->select(
                'cart.user_id',
                'cart.id',
                'cart.tour_id',
                'cart.adults_count',
                'cart.children_count',
                'cart.ages',
                'en_overview',
                'banner',
                'tours.en_name',
                'tours.ar_name',
                'tours.id',
                'cart.id',
                'cart.tour_date',
                'tour_person_cost',
                'duration',
                'countries.en_country',
                'countries.ar_country',
                'cities.en_city',
                'cities.ar_city',
                'cart.item_type',
            )
            ->leftJoin("tours", "cart.tour_id", "=", "tours.id")
            ->leftJoin("cities", "tours.city_id", "=", "cities.id")
            ->leftJoin("countries", "countries.id", "=", "cities.country_id")
            ->where([["user_id", "=", session()->get("SiteUser")["ID"]], ["cart.item_type", '=', 1]])
            ->get();

        $TransferCost = DB::table("cart")
            ->select(
                'cart.user_id',
                'cart.id',
                'cart.transfer_id',
                'cart.transfer_date',
                'from_loc.location_enname as from_location_enname',
                'from_loc.location_arname as from_location_arname',
                'to_loc.location_enname as to_location_enname',
                'to_loc.location_arname as to_location_arname',
                'car_models.model_enname',
                'car_models.model_arname',
                'car_models.image',
                'car_models.capacity',
                'car_classes.class_enname',
                'car_classes.class_arname',
                'cart.item_type',
                'transfers.person_price',
            )
            ->leftJoin("transfers", "transfers.id", "=", "cart.transfer_id")
            ->leftJoin("transfer_locations as from_loc", "transfers.from_location_id", "=", "from_loc.id")
            ->leftJoin("transfer_locations as to_loc", "transfers.to_location_id", "=", "to_loc.id")
            ->leftJoin("car_models", "transfers.car_model_id", "=", "car_models.id")
            ->leftJoin("car_classes", "transfers.class_id", "=", "car_classes.id")
            ->where([["user_id", "=", session()->get("SiteUser")["ID"]], ["cart.item_type", '=', 2]])
            ->first();

        $VisasCost = DB::table("cart")
            ->select(
                'cart.user_id',
                'cart.id',
                'cart.visa_name',
                'cart.visa_phone',
                'cart.visa_email',
                'cart.visa_personal_photo',
                'cart.visa_passport_photo',
                'cart.visa_id',
                'cart.item_type',
                'visa_types.en_type',
                'visa_types.ar_type',
                'countries.en_country',
                'countries.ar_country',
                'nationalities.en_nationality',
                'nationalities.ar_nationality',
                'visas.cost',
            )
            ->leftJoin("visas", "visas.id", "=", "cart.visa_id")
            ->leftJoin("visa_types", "visa_types.id", "=", "visas.visa_type_id")
            ->leftJoin("countries", "countries.id", "=", "visa_types.country_id")
            ->leftJoin("nationalities", "nationalities.id", "=", "visas.nationality_id")
            ->where([["user_id", "=", session()->get("SiteUser")["ID"]], ["cart.item_type", '=', 3]])
            ->get();
        $GPVisasCost = DB::table("cart")
            ->select(
                'cart.user_id',
                'cart.visa_id',
                'cart.item_type',
                'visa_types.en_type',
                'visa_types.ar_type',
                'countries.en_country',
                'countries.ar_country',
                'nationalities.en_nationality',
                'nationalities.ar_nationality',
                DB::raw('COUNT(cost) as groupped_count, SUM(cost) as sum_costs')
            )
            ->leftJoin("visas", "visas.id", "=", "cart.visa_id")
            ->leftJoin("visa_types", "visa_types.id", "=", "visas.visa_type_id")
            ->leftJoin("countries", "countries.id", "=", "visa_types.country_id")
            ->leftJoin("nationalities", "nationalities.id", "=", "visas.nationality_id")
            ->where([["user_id", "=", session()->get("SiteUser")["ID"]], ["cart.item_type", '=', 3]])
            ->groupBy(
                'cart.user_id',
                'cart.visa_id',
                'cart.item_type',
                'visa_types.en_type',
                'visa_types.ar_type',
                'countries.en_country',
                'countries.ar_country',
                'nationalities.en_nationality',
                'nationalities.ar_nationality',
            )
            ->get();
        // return $GPVisasCost;
        $OffersCost = DB::table("cart")
            ->select(
                'cart.user_id',
                'cart.id',
                'cart.offer_id',
                'cart.adults_count',
                'cart.children_count',
                'cart.ages',
                'image',
                'offers.subtitle_en',
                'offers.subtitle_ar',
                'offers.id',
                'cart.id',
                'cost',
                'countries.en_country',
                'countries.ar_country',
                'cities.en_city',
                'cities.ar_city',
                'cart.item_type',
            )
            ->leftJoin("offers", "cart.offer_id", "=", "offers.id")
            ->leftJoin("cities", "offers.city_id", "=", "cities.id")
            ->leftJoin("countries", "countries.id", "=", "cities.country_id")
            ->where([["user_id", "=", session()->get("SiteUser")["ID"]], ["cart.item_type", '=', 1]])
            ->get();

        $tax_percentage = DB::table('tax')->orderBy('id', 'desc')->first()->tax_percentage; // 14% Currently
        return view(
            "website.booking",
            [
                "Company" => $Company,
                "tax_percentage" => $tax_percentage,
                "Counters" => $Counters,
                "BreadCrumb" => $BreadCrumb,
                "RoomCost" => $RoomCost,
                "ToursCost" => $ToursCost,
                "VisasCost" => $VisasCost,
                "GPVisasCost" => $GPVisasCost,
                "TransferCost" => $TransferCost,
                "OffersCost" => $OffersCost,
            ]
        );
    }
    public function Cart1()
    {

        // return date("Y-m-d", strtotime('+7 days'));
        $BreadCrumb = [];
        $Company = Company::first();

        $Counters = Counter::get();

        $RoomCost = DB::table("cart")
            ->select(
                'cart.user_id',
                'cart.room_type_cost_id',
                'cart.id',
                'cart.room_cap',
                'cart.adults_count',
                'cart.children_count',
                'cart.rooms_count',
                'cart.nights',
                'cart.ages',
                'hotel_enoverview',
                'hotels.hotel_stars',
                'hotels.hotel_enname',
                'hotels.hotel_arname',
                'cart.id',
                'cart.from_date',
                'cart.to_date',
                'en_room_type',
                'food_bev_type',
                'ar_room_type',
                'cost',
                'single_cost',
                'double_cost',
                'triple_cost',
                'hotel_id',
                'hotel_banner',
                'countries.en_country',
                'countries.ar_country',
                'cities.en_city',
                'cities.ar_city',
                'child_free_age_from',
                'cart.item_type',
                'child_free_age_to',
                'child_age_from',
                'child_age_to',
                'child_age_cost'
            )
            ->leftJoin("room_type_costs", "room_type_costs.id", "=", "cart.room_type_cost_id")
            ->leftJoin("hotels", "hotels.id", "=", "room_type_costs.hotel_id")
            ->leftJoin("cities", "hotels.city_id", "=", "cities.id")
            ->leftJoin("countries", "countries.id", "=", "cities.country_id")
            ->leftJoin("room_types", "room_types.id", "=", "room_type_costs.room_type_id")
            ->leftJoin("food_beverages", "food_beverages.id", "=", "room_type_costs.food_beverage_id")
            ->where([["user_id", "=", session()->get("SiteUser")["ID"]], ["cart.item_type", '=', 0]])
            ->first();

        $ToursCost = DB::table("cart")
            ->select(
                'cart.user_id',
                'cart.id',
                'cart.tour_id',
                'cart.adults_count',
                'cart.children_count',
                'cart.ages',
                'en_overview',
                'banner',
                'tours.en_name',
                'tours.ar_name',
                'tours.id',
                'cart.id',
                'cart.tour_date',
                'tour_person_cost',
                'duration',
                'countries.en_country',
                'countries.ar_country',
                'cities.en_city',
                'cities.ar_city',
                'cart.item_type',
            )
            ->leftJoin("tours", "cart.tour_id", "=", "tours.id")
            ->leftJoin("cities", "tours.city_id", "=", "cities.id")
            ->leftJoin("countries", "countries.id", "=", "cities.country_id")
            ->where([["user_id", "=", session()->get("SiteUser")["ID"]], ["cart.item_type", '=', 1]])
            ->get();

        $TransferCost = DB::table("cart")
            ->select(
                'cart.user_id',
                'cart.id',
                'cart.transfer_id',
                'cart.transfer_date',
                'from_loc.location_enname as from_location_enname',
                'from_loc.location_arname as from_location_arname',
                'to_loc.location_enname as to_location_enname',
                'to_loc.location_arname as to_location_arname',
                'car_models.model_enname',
                'car_models.model_arname',
                'car_models.image',
                'car_models.capacity',
                'car_classes.class_enname',
                'car_classes.class_arname',
                'cart.item_type',
                'transfers.person_price',
            )
            ->leftJoin("transfers", "transfers.id", "=", "cart.transfer_id")
            ->leftJoin("transfer_locations as from_loc", "transfers.from_location_id", "=", "from_loc.id")
            ->leftJoin("transfer_locations as to_loc", "transfers.to_location_id", "=", "to_loc.id")
            ->leftJoin("car_models", "transfers.car_model_id", "=", "car_models.id")
            ->leftJoin("car_classes", "transfers.class_id", "=", "car_classes.id")
            ->where([["user_id", "=", session()->get("SiteUser")["ID"]], ["cart.item_type", '=', 2]])
            ->first();

        $VisasCost = DB::table("cart")
            ->select(
                'cart.user_id',
                'cart.id',
                'cart.visa_name',
                'cart.visa_phone',
                'cart.visa_email',
                'cart.visa_personal_photo',
                'cart.visa_passport_photo',
                'cart.visa_id',
                'cart.item_type',
                'visa_types.en_type',
                'visa_types.ar_type',
                'countries.en_country',
                'countries.ar_country',
                'nationalities.en_nationality',
                'nationalities.ar_nationality',
                'visas.cost',
            )
            ->leftJoin("visas", "visas.id", "=", "cart.visa_id")
            ->leftJoin("visa_types", "visa_types.id", "=", "visas.visa_type_id")
            ->leftJoin("countries", "countries.id", "=", "visa_types.country_id")
            ->leftJoin("nationalities", "nationalities.id", "=", "visas.nationality_id")
            ->where([["user_id", "=", session()->get("SiteUser")["ID"]], ["cart.item_type", '=', 3]])
            ->get();
        $GPVisasCost = DB::table("cart")
            ->select(
                'cart.user_id',
                'cart.visa_id',
                'cart.item_type',
                'visa_types.en_type',
                'visa_types.ar_type',
                'countries.en_country',
                'countries.ar_country',
                'nationalities.en_nationality',
                'nationalities.ar_nationality',
                DB::raw('COUNT(cost) as groupped_count, SUM(cost) as sum_costs')
            )
            ->leftJoin("visas", "visas.id", "=", "cart.visa_id")
            ->leftJoin("visa_types", "visa_types.id", "=", "visas.visa_type_id")
            ->leftJoin("countries", "countries.id", "=", "visa_types.country_id")
            ->leftJoin("nationalities", "nationalities.id", "=", "visas.nationality_id")
            ->where([["user_id", "=", session()->get("SiteUser")["ID"]], ["cart.item_type", '=', 3]])
            ->groupBy(
                'cart.user_id',
                'cart.visa_id',
                'cart.item_type',
                'visa_types.en_type',
                'visa_types.ar_type',
                'countries.en_country',
                'countries.ar_country',
                'nationalities.en_nationality',
                'nationalities.ar_nationality',
            )
            ->get();
        // return $GPVisasCost;

        $tax_percentage = DB::table('tax')->orderBy('id', 'desc')->first()->tax_percentage; // 14% Currently
        return view(
            "website.booking",
            [
                "Company" => $Company,
                "tax_percentage" => $tax_percentage,
                "Counters" => $Counters,
                "BreadCrumb" => $BreadCrumb,
                "RoomCost" => $RoomCost,
                "ToursCost" => $ToursCost,
                "VisasCost" => $VisasCost,
                "GPVisasCost" => $GPVisasCost,
                "TransferCost" => $TransferCost,
            ]
        );
    }

    public function DeleteCartItem(int $id)
    {
        $Cart = Cart::find($id);
        $Cart->delete();
        session()->forget("hasCart");

        return redirect()->back();
    }
    public function DeleteVisa()
    {
        $Cart = Cart::where([["user_id", '=', session()->get("SiteUser")["ID"]], ["item_type", '=', 3]]);
        $Cart->delete();

        return redirect()->back();
    }

    public function MakeOrder(Request $request)
    {
       // return $request;
        $BreadCrumb = [];
        $Company = Company::first();

        $Counters = Counter::get();
        DB::beginTransaction();
        $RoomDetail = null;
        $order = null;
        try {
            $order = new Orders();
            $order->user_id = session()->get("SiteUser")["ID"];
            $order->tax_percentage = $request->tax_percentage;
            $order->save();
            /**
             *
             *  Tours Section
             *
             */

            /**
             *
             *  Offers Section
             *
             * {"_token":"bbrdjef0gEbWG28tGVYkvsncGgajJ0bsDaFuTpYr","offer_adults_name":[["sabreen"],["sabreen"]],
             * "offer_adults_mobile":[["01245678935"],["01147041564"]],
             * "offer_adults_email":[["admin@system.com"],["admin@system.com"]],
             * "offer_notes":["cxc","vv"],"offer_id":["7","6"],
             * "offer_total_cost":["150","350"],
             * "offer_cost":["150","350"],
             * "BeforeT":"500.00"}
             */
            if ($request->offer_adults_count && count($request->offer_id) > 0) {
                for ($i = 0; $i < count($request->offer_id); $i++) {
                    $orderDetails = new OrderDetails();
                    $orderDetails->order_id = $order->id;
                    $orderDetails->holder_name = $request->offer_adults_name[$i][0];
                    $orderDetails->holder_mobile = $request->offer_adults_mobile[$i][0];
                    $orderDetails->notes = $request->offer_notes[$i];
                    $orderDetails->detail_type = 5; // Offer Type Option [5]
                    $orderDetails->holder_email = $request->offer_adults_email[$i][0];
                    //add status column
                    $orderDetails->status_id = 1;
                    $orderDetails->save();

                    $refOffer = Offer::find((int) $request->offer_id[$i]);
                    $TotalPaidPersons = $request->offer_adults_count[$i];

                    $OfferElem = new OfferDetails();
                    $OfferElem->order_details_id = $orderDetails->id;
                    $OfferElem->offer_id = (int) $request->offer_id[$i];
                    $OfferElem->offer_title = $refOffer->subtitle_ar;
                    $OfferElem->offer_image = $refOffer->image;
                    $OfferElem->total_cost = (float) $request->offer_cost[$i] ; // Before Tax
                    $OfferElem->offer_cost = ((float) $request->offer_cost[$i]); // Before Tax
                    $OfferElem->save();
                }

            }

            // return "passed";

            $Cart = Cart::where("user_id", "=", session()->get("SiteUser")["ID"]);
            $Cart->delete();
            session()->forget("hasCart");

            DB::commit();

            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            throw $e;
            return redirect()->back()->with("session-danger", Lang::get('links.contpurchase'));
        }

        return redirect()->to("/mwakeb/OrderPlacement/$order->id");
    }

    public function SuccessOrder(int $id)
    {
        $order = Orders::find($id);
        // return $order->order_details[1]->tours_details[0];
        $Cost = 0;
        foreach ($order->order_details as $index => $item) {
            if ($item->detail_type == 0) // Room
            {
                $Cost += $item->room_details[0]->total_cost;
            } else if ($item->detail_type == 1) { // Tour
                $Cost += $item->tours_details[0]->total_cost;
            } else if ($item->detail_type == 2) { // Transfer
                $Cost += $item->transfer_details[0]->transfer_total_cost;
            } else if ($item->detail_type == 3) { // Visa
                $Cost += $item->visa_details[0]->visa_cost; // To be completed
            }
            else if ($item->detail_type == 5) { // offer
                $Cost += $item->offers_details[0]->total_cost; // To be completed
            }
        }
        $BreadCrumb = [];
        $Company = Company::first();

        $Counters = Counter::get();
        return view(
            "website.bookingSuccess",
            [
                "Company" => $Company,
                "Counters" => $Counters,
                "BreadCrumb" => $BreadCrumb,
                "Order" => $order,
                "Cost" => $Cost, // Before Tax
            ]
        );
    }
}
