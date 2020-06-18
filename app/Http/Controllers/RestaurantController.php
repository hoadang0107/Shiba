<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;
use Kreait\Firebase\ServiceAccount;

class RestaurantController extends BaseController
{
	public function getRestaurant($id){
        $resRef = $this->database->getReference('restaurants')
            ->orderByChild('id')
            ->equalTo($id)
            ->getSnapshot()
            ->getValue();
        //$res = reset($resRef);
        //echo $res['name'];
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
