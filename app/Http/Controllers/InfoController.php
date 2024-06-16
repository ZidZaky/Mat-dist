<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ButTitikController;
use App\Http\Controllers\HewanController;
use App\Http\Controllers\TitikController;
use App\Models\info;

class InfoController extends Controller
{
    public function index($siapa)
    {
        $ButTitiks = new ButTitikController();
        $titikss = new TitikController();
        $hew = new HewanController();
        $Lines = $titikss->all();
        $hewans = $hew->all();
        // dd($titiks);
        $titiks= $ButTitiks->all();
        $arys = $this->GetAllInfo();
        $start = 0;
        $end = 0;
        if($siapa =='all'){
            $start = 0;
            $end = count($titiks);
            return view('setInfo',['titiks'=>$titiks,'lines'=>$Lines,'hewans'=>$hewans,'arys'=>$arys,'start'=>$start,'end'=>$end,'siapa'=>$siapa]);
        }
        elseif($siapa=='dika'){
            $start = 0;
            $end = 69;
            return view('setInfo',['titiks'=>$titiks,'lines'=>$Lines,'hewans'=>$hewans,'arys'=>$arys,'start'=>$start,'end'=>$end,'siapa'=>$siapa]);
        }
        elseif($siapa=='ageng'){
            $start = 69;
            $end = 138;
            return view('setInfo',['titiks'=>$titiks,'lines'=>$Lines,'hewans'=>$hewans,'arys'=>$arys,'start'=>$start,'end'=>$end,'siapa'=>$siapa]);
        }
    }
    public function final(){
        $ButTitiks = new ButTitikController();
        $titikss = new TitikController();
        $hew = new HewanController();
        $info = new InfoController();
        $Lines = $titikss->all();
        $hewans = $hew->all();
        // dd($titiks);
        $titiks= $ButTitiks->all();
        $arys = $info->GetAllInfo();
        $butInfo = $ButTitiks->GetTitikBut();
        // dd($titiks,$arys,$butInfo);
        // dd($titiks);
        return view('finalPage',['titiks'=>$titiks,'lines'=>$Lines,'hewans'=>$hewans,'arys'=>$arys,'butInfos'=>$butInfo,'butfill'=>[]]);
    }
    public function Rute(Request $request)
    {
        // dd($request);
        // dd($request->garisx1);
        // Simpan hanya nama dan jarak dalam database
        $request->validate([
            'inpTujuan' => 'required',
            'inpAwal' => 'required'

        ]);
        $tujuan = $this->getTitikTujuan($request->inpTujuan);
        $tc = new TitikController();
        $finalResult = [];
        $hasils = [];
        $shortest = 0;
        $index = 0;
        $itg = 0;
        foreach($tujuan as $tuju){
            $jarak = $tc->FindRute($tuju,$request->inpAwal);
            array_push($hasils, $jarak);
            if($shortest==0){
                $shortest = $jarak[0];
                $index = $itg;
            }
            elseif($shortest>$jarak[0]){
                $shortest=$jarak[0];
                $index = $itg;
            }
            $itg = $itg+1;
        }
        // dd("hasil",$hasils,"tujuan",$tujuan,"awal",$request->inpAwal,"akhir",$request->inpTujuan);

        array_push($finalResult,$hasils[$index]);
        // dd($finalResult[0][1]);
        $back = [];
        array_push($back,$finalResult[0][0]);
        $dataLines = [];
        for($q=(count($finalResult[0][1])-1);$q>=0;$q--){
            if($q!=0){
                // echo $q." ".$q-1;
                $dataline = $tc->getLiness($finalResult[0][1][$q],$finalResult[0][1][$q-1]);
                // dd($dataline);
                array_push($dataLines,$dataline);
            }
        }
        array_push($back,$dataLines);


        //persiapan masuk page
        $ButTitiks = new ButTitikController();
        $titikss = new TitikController();
        $hew = new HewanController();
        $Lines = $titikss->all();
        $hewans = $hew->all();
        // dd($titiks);
        $titiks= $ButTitiks->all();
        $arys = $this->GetAllInfo();
        $ShowLines = $back;

        return view('rute',['show' => $ShowLines,'Lines'=>$Lines]);



    }



    public function getTitikTujuan($lokasi){
        $titik = Info::select('Titik')
            ->where('Lokasi_atau_hewan', $lokasi)
            ->get();
        // dd($titik);
        $ary=[];
        foreach($titik as $ti){
            array_push($ary,$ti->Titik);
        }
        return $ary;
    }
    public function store(Request $request,$siapa)
    {
        // dd($request);
        // dd($request->garisx1);
        // Simpan hanya nama dan jarak dalam database
        $request->validate([
            'titik' => 'required',
            'NamaHewan' => 'required'

        ]);
        $arry = explode(",",$request->NamaHewan);
        // dd($arry);
        foreach($arry as $r){
            $titik = new info();
            $titik->Titik = $request->titik;
            $titik->Lokasi_atau_hewan = $r;
            $titik->save();
        }


        return redirect('/setinfo/'.$siapa);
    }
    public function cek(){
        // $this->getinfo('tes');
        $this->GetAllInfo();
    }

    public function GetAllInfo(){
        $ButTitiks = new ButTitikController();
        $titikss = new TitikController();
        $hew = new HewanController();
        $Lines = $titikss->all();
        $hewans = $hew->all();
        // dd($titiks);
        $titiks= $ButTitiks->all();
        // dd($titiks);
        $arys = [];
        foreach($titiks as $titik){
            $ary = [];
            array_push($ary,$titik->Nama);
            $isi = $this->getinfo($titik->Nama);
            array_push($ary,$isi);
            array_push($arys, $ary);
        }
        // dd($arys);
        return $arys;


    }
    public function getinfo($titik){
        $results = Info::where('Titik', $titik)
                    ->orderBy('Lokasi_atau_hewan', 'asc')
                    ->pluck('Lokasi_atau_hewan');

        // dd($titik,$results);
        $ary = [];
        // dd(count($ary));
        if(count($results)>0){
            foreach($results as $a){
                array_push($ary,$a);
            }
        }
        return $ary;
    }
}
