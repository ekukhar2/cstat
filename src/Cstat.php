<?php
/**
 * Created by PhpStorm.
 * User: evgen
 * Date: 01.05.2017
 * Time: 13:12
 */

namespace Eugen\Cstat;

use Eugen\Cstat\Models\Cstatcounter;
use Eugen\Cstat\Models\Cstatcounteralldays;
use Eugen\Cstat\Models\Cstatvisitors;
use Eugen\Cstat\Models\Cstatinsite;
use Carbon\Carbon;
use Session;

class Cstat
{
    protected $routeName;
    public $request_uri;
    public $remote_addr;
    public $tz='Europe/Kiev';
    public $timestamp;
    public $visitorsTimeLive=3600;//time in seconds
    public $visitorsid;
    public $sesid;
    public function __construct(){
        $this->routeName = \Route::currentRouteName();
        if($this->routeName){
            $this->sesid=Session::getId();
            $this->visitorsid=rand();
            $this->timestamp=time();
            //echo rand();
            $this->request_uri=urldecode($_SERVER['REQUEST_URI']);
            if($this->request_uri=='/')$this->request_uri='/main';
            //$this->request_uri=$this->routeName;
            $this->remote_addr=$_SERVER['REMOTE_ADDR'];
            $this->checkDataInTableCstatcounter();
            $this->updateCstatcounterAlluser();
            $this->updateCstatcounterPagename();
            $this->isertInsite();
            $this->isertVisitors();
            $this->clearVisitors();
            $this->clearInsite();
        }
    }

    public function isertInsite(){
        $data = Cstatinsite::where('id',$this->sesid)->first();
        //dd($data);
        if ($data){
            Cstatinsite::where('id',$this->sesid)->update(['self'=>$this->request_uri,'times'=>$this->timestamp]);
        }
        else Cstatinsite::firstOrCreate(['id' => $this->sesid,'remote'=>$this->remote_addr,'self'=>$this->request_uri,'times'=>$this->timestamp]);

    }
    public function isertVisitors(){
        $data = Cstatvisitors::firstOrCreate(['id' => $this->visitorsid,'remote'=>$this->remote_addr,'self'=>$this->request_uri]);
    }
    public function updateCstatcounterAlluser(){

        $data = Cstatcounter::where('id', 'alluser')->first();
        $data->today=$data->today+1;
        $data->alld=$data->alld+1;
        $data->save();
    }
    public function updateCstatcounterUniuser(){

        $data = Cstatcounter::where('id', 'uniuser')->first();
        $data->today=$data->today+1;
        $data->alld=$data->alld+1;
        $data->save();
    }
    public function updateCstatcounterPagename(){
        $data = Cstatcounter::firstOrNew(['id' => $this->routeName]);
        $data->today=$data->today+1;
        $data->alld=$data->alld+1;
        $data->save();
    }
    public function checkDataInTableCstatcounter(){
        $curdate=Carbon::today($this->tz);
        $tabdateuniuser=Cstatcounter::where('id', 'uniuser')->first();
        if($curdate!=$tabdateuniuser->todaydate){
            $tabdatealluser=Cstatcounter::where('id', 'alluser')->first();
            $this->updateCstatcounteralldays($tabdateuniuser->todaydate,$tabdateuniuser->today,$tabdatealluser->today);
            $tabdateuniuser->todaydate=$curdate;
            $tabdateuniuser->save();
            $this->clearCstatcounterTodayData();
        }
    }
    public function updateCstatcounteralldays($date,$uniuser,$alluser){
        $data = Cstatcounteralldays::firstOrNew(['id' => $date]);
        $data->unidays=$uniuser;
        $data->alldays=$alluser;
        $data->save();
    }
    public function clearCstatcounterTodayData(){
        $datas = Cstatcounter::all();
        foreach ($datas as $data) {
            Cstatcounter::where('id',$data->id)->update(['today'=>0,'tomorrow'=>$data->today]);
        }
    }
    public function clearVisitors(){
        $datas = Cstatvisitors::all();
        foreach ($datas as $data) {
            $res=$this->timestamp - $data->created_at->timestamp;
            if($res>=$this->visitorsTimeLive)Cstatvisitors::where('id', $data->id)->delete();
        }
    }
    public function clearInsite(){
        $tm0=900;// 15 minut
        $datas = Cstatinsite::all();
        foreach ($datas as $data) {
            $res=$this->timestamp-$data->times;
            if($res>=$tm0){
                Cstatinsite::where('id', $data->id)->delete();
                $this->updateCstatcounterUniuser();
            }
        }
    }
    public function getCstatcounterInitialData(){

        $data = Cstatcounter::where('id', 'alluser')->first();
        return $data->created_at;
    }
    public function getCstatcounterDatas(){
        return Cstatcounter::all();
    }
    public function getCstatinsite(){
        return Cstatinsite::orderBy('times', 'desc')->get();
    }
    public function getCstatvisitors(){
        return Cstatvisitors::orderBy('id', 'desc')->get();
    }

}//end class
