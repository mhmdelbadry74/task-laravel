<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PersonData;
class PersonController extends Controller
{
    //
/**
 * class include create person / get person by id / get berson by date
 *
 */
    public function createPerson(Request $request){
        $validators = Validator()->make($request->all(),[
            'name'=>'required',
            'date'=>'required',
            'longitude'=>'required',
            'latitude'=>'required',
        ]);

        if ($validators->fails()) {
            return responsejson(0,'faild',$validators->errors());
        }

        $person = PersonData::create($request->all());
           $person->save();
        return responsejson(1,'تم الاضافة بنجاح ',$person);

    }


    // function get data with id


    public function getOnePerson(Request $request){

        $validators = Validator()->make($request->all(),[
            'id'=>'required',

        ]);

        if ($validators->fails()) {
            return responsejson(0,'faild',$validators->errors());
        }
        $name= PersonData::where('id',$request->id)->pluck('name')->all();
        $explode_name = explode(" ",$name[0]);
        $get_person = PersonData::select('date','longitude','latitude')->where('id',$request->id)->get();
        return responsejson(1,'تم  العرض بنجاح ',[
            'kid_name' => $explode_name[0],
            'father_name' => $explode_name[1],
            'granfather_name' => $explode_name[2],
            'data' => $get_person
        ]);

    }
    // function to get data with date

    public function getBetwen(Request $request){
        $person_name =PersonData::where('date',$request->date2)->orWhere('date',$request->date)->pluck('name')->all();
        $person = PersonData::select('date','longitude','latitude')
        ->where('date',$request->date2)->orWhere('date',$request->date)
        ->get();
        $name = $person_name[0];
        $explode_name = explode(" ",$name);

    return responsejson(1,'تم العرض بنجاح ',[
        'kid_name' => $explode_name[0],
        'father_name' => $explode_name[1],
        'grandfather_name' => $explode_name[2],
        'data' => $person
    ]);
    }
}
