<?php
namespace Eugen\Cstat\Controllers;
/**
 * Created by PhpStorm.
 * User: evgen
 * Date: 01.05.2017
 * Time: 14:21
 */
use App\Http\Controllers\Controller;
use Eugen\Cstat\Models\Cstatcounteralldays;
use Eugen\Cstat\Cstat;
use Illuminate\Http\Request;
use Session;
class CstatController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {
        $cstat=new Cstat();
        $last30Days=null;
        $unidays=null;
        $alldays=null;
        $unidaysarr=null;
        $alldaysarr=null;
        $max=0;//максимальна к-сть відвідувачів
        $datas = Cstatcounteralldays::orderBy('id', 'desc')->take(30)->get();
        foreach ($datas as $data) {
            strtok($data->id,'-');
            strtok('-');
            $last30Days[]=strtok(' ');
            $unidays[]=$data->unidays;
            $alldays[]=$data->alldays;
            if($max<$data->alldays)$max=$data->alldays;
        }
        //встановлення коефіцієнта маштабування k
        $k=0;
        if($max>300)
            do{
                $k+=1;
                $max=$max-300;
            }while ($max>0);
        else
            do{
                $k+=0.1;
                $max=$max-30;
            }while ($max>0);

        $n=count($last30Days);//к-сть днів для відображення якщо менше 30
        if($n){
            $y=350;
            $x=620;
            $h=300;
            $w=600;
            $alldays=array_reverse($alldays);
            $unidays=array_reverse($unidays);

//загальні відвідувачі
            $xx=20;
            for($i=0;$i<$n-1;$i++)
            {
                $x1=$xx;
                $xx+=20;
                $x2=$xx;
                $y1=$h-$alldays[$i]/$k;
                $y2=$h-$alldays[$i+1]/$k;
                $alldaysarr['x1'][]=$x1;
                $alldaysarr['x2'][]=$x2;
                $alldaysarr['y1'][]=$y1;
                $alldaysarr['y2'][]=$y2;
                $alldaysarr['alldays'][]=$alldays[$i];
            }
            $alldaysarr['alldays'][]=$alldays[$i];

//унікальні відвідувачі
            $xx=20;
            for($i=0;$i<$n-1;$i++)
            {
                $x1=$xx;
                $xx+=20;
                $x2=$xx;
                $y1=$h-$unidays[$i]/$k;
                $y2=$h-$unidays[$i+1]/$k;
                $unidaysarr['x1'][]=$x1;
                $unidaysarr['x2'][]=$x2;
                $unidaysarr['y1'][]=$y1;
                $unidaysarr['y2'][]=$y2;
                $unidaysarr['unidays'][]=$unidays[$i];
            }
            $unidaysarr['unidays'][]=$unidays[$i];
            $last30Days=array_reverse($last30Days);
        }


        $datas['last30Days']=json_encode($last30Days);
        $datas['unidays']=json_encode($unidaysarr);
        $datas['alldays']=json_encode($alldaysarr);
        $datas['counterinitialdata']=strtok($cstat->getCstatcounterInitialData(),' ');
        $datas['counterdatas']=$cstat->getCstatcounterDatas();
        $datas['counterinsite']=$cstat->getCstatinsite();
        $datas['countervisitors']=$cstat->getCstatvisitors();
        $datas['k']=$k;

        return view('cstat::cstat')->with('datas',$datas);
    }

    public static function getSesid()
    {
        return Session::getId();
    }

}