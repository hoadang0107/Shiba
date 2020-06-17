<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;
use Kreait\Firebase\ServiceAccount;

class RestaurantController extends BaseController
{
	public function getRestaurant(Request $request){
        	$resRef = $this->database->getReference('restaurants')
            ->orderByChild('id')
            ->equalTo($request->id)
            ->getSnapshot()
            ->getValue();
		return view('page.restaurant', compact('resRef'));
	}
	public function index(){
		 $resRef = null;
		 try {
             $resRef = $this->database->getReference('restaurants');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
        $restaurants = $resRef->getValue();
        foreach ($restaurants as $restaurant) {
        	$all_res[] = $restaurant;
        }
        return view('page.Homepage', compact('all_res'));
    }
    //
}
