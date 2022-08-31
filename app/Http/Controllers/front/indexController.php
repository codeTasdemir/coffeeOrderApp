<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Coffee;
use App\Models\CoffeeCategory;
use App\Models\Milk;
use App\Models\Size;
use App\Models\Sugar;
use App\Models\Syrup;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use function GuzzleHttp\Promise\all;

class indexController extends Controller
{
    public function index()
    {
        $coffeeCategory = CoffeeCategory::all();
        return view('front.index',compact('coffeeCategory'));
    }

    public function getCoffees(Request $request)
    {
        $coffees = Coffee::where('catId',$request->catId)->get();


        return response()->json(['data'=>['coffees'=>$coffees]]);
    }

    public function getCoffeeCustomizations(Request $request){
        $coffees = Coffee::where('id',$request->coffeeId)->get();

        foreach($coffees as $coffee)
        {
            $allMilkIds = $coffee->milks;
            $allSyrupIds = $coffee->syrups;
            $allSugarIds = $coffee->sugars;
            $allSizeIds = $coffee->sizes;
        }


        if (!empty($coffee)){
            $selectedMilks = Milk::whereIn('id',$allMilkIds)->get();
            $selectedSugars = Sugar::whereIn('id',$allSugarIds)->get();
            $selectedSyrups = Syrup::whereIn('id',$allSyrupIds)->get();
            $selectedSizes = Size::whereIn('id',$allSizeIds)->get();
        }else{
            $selectedMilks = null;
            $selectedSyrups = null;
            $selectedSugars = null;
            $selectedSizes = null;
        }

        return response()->json(['choiceDatas'=>['selectedMilks'=>$selectedMilks,'selectedSyrups'=>$selectedSyrups,'selectedSugars'=>$selectedSugars,'selectedSizes'=>$selectedSizes]]);

    }
    public function getChoises($parameter){
        $result= [];
        for ($i=0; $i < $parameter->count();  $i++) {
            array_push($result,$parameter[$i]->name);
        }
        return $result;
    }

    public function getSelectedValues(Request $request)
    {
        $coffees = Coffee::where('id',$request->coffeeName)->get();

        foreach($coffees as $coffee)
        {
            $coffeeName = $coffee->name;
            $allMilkIds = $coffee->milks;
            $allSyrupIds = $coffee->syrups;
            $allSugarIds = $coffee->sugars;
            $allSizeIds = $coffee->sizes;

            $selectedMilks = Milk::whereIn('id',$allMilkIds)->get()->collect();
            $selectedSugars = Sugar::whereIn('id',$allSugarIds)->get()->collect();
            $selectedSyrups = Syrup::whereIn('id',$allSyrupIds)->get()->collect();
            $selectedSizes = Size::whereIn('id',$allSizeIds)->get()->collect();
        }

        if (!empty($coffee)){
            $selectedMilks = Milk::whereIn('id',$allMilkIds)->get();
            $selectedSugars = Sugar::whereIn('id',$allSugarIds)->get();
            $selectedSyrups = Syrup::whereIn('id',$allSyrupIds)->get();
            $selectedSizes = Size::whereIn('id',$allSizeIds)->get();
        }else{
            $selectedMilks = null;
            $selectedSyrups = null;
            $selectedSugars = null;
            $selectedSizes = null;
        }

        $coffeeOrder = [
            'customer_name'=>$request->name,
            'coffee_name'=>$coffeeName,
            'milk_choises'=>$this->getChoises($selectedMilks),
            'syrup_choises'=>$this->getChoises($selectedSyrups),
            'sugar_choises'=>$this->getChoises($selectedSugars),
            'size_choises'=>$selectedSizes[0]->name,
        ];

        $coffeeOrderToText = "Musteri Adi : " .$request->name ."<br>".
            "Kahve Adi : ".$coffeeOrder['coffee_name']. "<br>".
            "Sut Secimleri : ".json_encode($coffeeOrder['milk_choises']) . "<br>".
            "Surup Secimleri : " .json_encode($coffeeOrder['syrup_choises']) . "<br>".
            "Seker Secimleri : " .json_encode($coffeeOrder['sugar_choises']) . "<br>".
            "Boy Secimi : " .$coffeeOrder['size_choises']. "<br>";

        $finallyToString = json_encode(strip_tags(utf8_decode($coffeeOrderToText)));
        $qrCode = QrCode::size(400)->generate($finallyToString);
        return response($qrCode);

    }

}

