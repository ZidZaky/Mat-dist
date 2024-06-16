<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Titik;
use App\Models\butTitik;
use Illuminate\Support\Facades\DB;

class TitikController extends Controller
{
    public $hitung=0;
    public function index()
    {
        $titiks = ButTitik::all();
        $Lines = $this->CallAllLine();
        return view('titik2',['titiks'=>$titiks,'lines'=>$Lines]);
    }
    public function all(){
        $lines = $this->CallAllLine();
        return $lines;
    }

    public function store(Request $request)
{

    // dd($request->garisx1);
    // Simpan hanya nama dan jarak dalam database
    $request->validate([
        'namaAwal' => 'required',
        'namaAkhir' => 'required',
        'totalJarak' => 'required'

    ]);
    $titik = new Titik;
    $titik->TitikAwal = $request->namaAwal;
    $titik->TitikAkhir = $request->namaAkhir;
    $titik->jarak = $request->totalJarak;
    $titik->save();

    return redirect('/new');
}

    public function hitungJarak()
    {
        $titiks = Titik::orderBy('id', 'asc')->get();
        $jarak_total = 0;

        for ($i = 0; $i < count($titiks) - 1; $i++) {
            $jarak = sqrt(pow(($titiks[$i + 1]->posisi_x - $titiks[$i]->posisi_x), 2) + pow(($titiks[$i + 1]->posisi_y - $titiks[$i]->posisi_y), 2));
            $jarak_total += $jarak;
        }

        // Konversi piksel ke sentimeter (diasumsikan 1 piksel = 1 cm)
        $jarak_total_cm = $jarak_total;

        return $jarak_total_cm;
    }
    public function CallAllLine(){
        $result = DB::table('titiks as q')->select(
            'q.TitikAwal','d.xDot as x1','d.yDot as y1','q.TitikAkhir','e.xDot as x2','e.yDOt as y2','q.jarak as jarak'
        )->join('but_titiks as d','d.Nama','=','q.TitikAwal')->join('but_titiks as e','e.Nama','=','q.TitikAkhir')->get();
        // dd($result);

        return $result;
    }


    public function AllLineArray(){
        // CONTOH ARRAY
        // $routes = array(
        //     array('a', 'b'),
        //     array('b', 'c'),
        //     array('b', 'd'),
        //     array('c', 'e'),
        //     array('d', 'e'),
        //     array('e', 'm')
        // );
        // dd($routes);
        // convert data sql to that shape
        $ary = [];
        $all = $this->CallAllLine();
        // dd($all);
        // $toArry = get_object_vars($all);
        // dd(count($all));
        // dd($all[0]);
        $pjg = count($all);
        for($s=0;$s<$pjg;$s++){
            array_push($ary,array());
            array_push($ary[$s],$all[$s]->TitikAwal);
            array_push($ary[$s],$all[$s]->TitikAkhir);
            array_push($ary[$s],$all[$s]->jarak);

        }
        return $ary;

    }
    // public function tess(){
    //     $f = $this->LookTetangga("r",[]);
    // }




    public function FindRute($tujuan,$Awal){
        set_time_limit(500);

        // Definisikan data

        // Definisikan data garis-garis yang xtersedia


        // Panggil fungsi untuk mencari 5 jalur terpendek dari titik AA ke titik BN
        $lines = $this->AllLineArray();
        $shortestPaths = $this->findShortestPaths($lines, $tujuan, $Awal);
        // dd($shortestPaths);
        $datajrk = [];
        $htg9 = 0;
        foreach($shortestPaths as $one){
            array_push($datajrk,0);
            // dd(count($one));
            for($y=0;$y<count($one);$y++){

                if($y!=count($one)-1){
                    $jrk = $this->brpjrk($one[$y],$one[$y+1]);
                    $datajrk[$htg9]=$datajrk[$htg9]+$jrk[0]->jarak;
                }


            }
            $htg9 = $htg9+1;
        }

        $back = [];
        foreach($shortestPaths as $rute){
            $ary = [];
            array_push($ary, $rute);
            array_push($back, $ary);
        }
        for($y=0;$y<count($datajrk);$y++){
            array_push($back[$y],$datajrk[$y]);
        }

        // dd($back);
        $trullyBack = [];
        $rilback = 0;
        $index = 0;
        $itg = 0;
        foreach($back as $b){
            if($rilback==0){
                $rilback = $b[1];
                $index = $itg;
            }
            elseif($rilback>$b[1]){
                $rilback = $b[1];
                $index = $itg;
            }
            $itg = $itg+1;
        }
        // dd($rilback);
        // return $rilback;
        // dd($rilback,$index,$shortestPaths[$index]);
        array_push($trullyBack,$rilback);
        array_push($trullyBack,$shortestPaths[$index]);
        // dd($trullyBack);
        return $trullyBack;


        // dd($datajrk);
        // $this->brpjrk("AX","AT");


    }
    public function findShortestPaths($lines, $start, $end) {
        // Inisialisasi antrian prioritas dengan jalur awal
        $queue = [[$start]];
        $shortestPaths = [];

        // Selama antrian tidak kosong dan belum menemukan jalur terpendek
        while (!empty($queue) && count($shortestPaths) < 1) {
            // Ambil jalur pertama dari antrian
            $path = array_shift($queue);
            $currentNode = end($path);

            // Jika jalur saat ini mencapai titik akhir
            if ($currentNode == $end) {
                // Tambahkan jalur ke daftar jalur terpendek
                $shortestPaths[] = $path;
                continue;
            }

            // Loop melalui semua garis
            foreach ($lines as $line) {
                // Jika titik awal garis sama dengan titik saat ini
                if ($line[0] == $currentNode && !in_array($line[1], $path)) {
                    // Buat salinan jalur saat ini dan tambahkan titik akhir garis
                    $newPath = $path;
                    $newPath[] = $line[1];
                    // Tambahkan jalur baru ke antrian prioritas
                    $queue[] = $newPath;
                }
                // Jika titik akhir garis sama dengan titik saat ini (untuk garis yang dapat berbalik)
                elseif ($line[1] == $currentNode && !in_array($line[0], $path)) {
                    // Buat salinan jalur saat ini dan tambahkan titik awal garis
                    $newPath = $path;
                    $newPath[] = $line[0];
                    // Tambahkan jalur baru ke antrian prioritas
                    $queue[] = $newPath;
                }
            }

            // Urutkan antrian prioritas berdasarkan panjang jalur (semakin pendek, semakin awal)
            usort($queue, function($a, $b) {
                return count($a) <=> count($b);
            });
        }

        return $shortestPaths;
    }

    public function findHamiltonianPath($graph, $start) {
        $path = [];
        $visited = [];

        // Initialize the path and visited array
        foreach ($graph as $vertex => $edges) {
            $visited[$vertex] = false;
        }

        // Start from the initial vertex
        $path[] = $start;
        $visited[$start] = true;

        // Call the utility function to find the Hamiltonian Path
        if ($this->hamiltonianPathUtil($graph, $path, $visited, count($graph))) {
            return $path;
        } else {
            return null; // No Hamiltonian Path found
        }
    }

    private function hamiltonianPathUtil($graph, &$path, &$visited, $totalVertices) {
        // Base case: If the path contains all vertices, return true
        if (count($path) == $totalVertices) {
            return true;
        }

        // Get the last vertex in the current path
        $currentVertex = end($path);

        // Explore all adjacent vertices
        foreach ($graph[$currentVertex] as $adjacent) {
            if (!$visited[$adjacent]) {
                // Mark the vertex as visited and add it to the path
                $visited[$adjacent] = true;
                $path[] = $adjacent;

                // Recursively call the utility function to continue the path
                if ($this->hamiltonianPathUtil($graph, $path, $visited, $totalVertices)) {
                    return true;
                }

                // Backtrack: Remove the vertex from the path and mark it as unvisited
                array_pop($path);
                $visited[$adjacent] = false;
            }
        }

        return false;
    }

    public function go(){
        $this->getLiness("CK","CL");
    }
    public function brpjrk($dtitikAwal, $dtitikAkhir)
    {
        $results = DB::table('titiks')
            ->where(function($query) use ($dtitikAwal, $dtitikAkhir) {
                $query->where('TitikAwal', $dtitikAwal)
                      ->where('TitikAkhir', $dtitikAkhir);
            })
            ->orWhere(function($query) use ($dtitikAwal, $dtitikAkhir) {
                $query->where('TitikAwal', $dtitikAkhir)
                      ->where('TitikAkhir', $dtitikAwal);
            })
            ->get();
            // dd($results);
        return $results;
    }





    public function teslagi(){
        // $this->CB("AA","BN");
        // $this->CallAllLine();
        $this->apanih();
        // $this->AllLineArray();
    }

    public function getLiness($titikAwals,$titikAkhirs){
        $results = Titik::select('TitikAwal as t1', 'bt1.xDot as x1', 'bt1.yDot as y1', 'TitikAkhir as t2', 'bt2.xDot as x2', 'bt2.yDot as y2','jarak as Jarak')
        ->join('but_titiks as bt1', 'bt1.Nama', '=', 'TitikAwal')
        ->join('but_titiks as bt2', 'bt2.Nama', '=', 'TitikAkhir')
        ->where(function ($query) use ($titikAwals, $titikAkhirs) {
            $query->where('TitikAwal', '=', $titikAwals)
                  ->where('TitikAkhir', '=', $titikAkhirs);
        })
        ->orWhere(function ($query) use ($titikAwals, $titikAkhirs) {
            $query->where('TitikAwal', '=', $titikAkhirs)
                  ->where('TitikAkhir', '=', $titikAwals);
        })
        ->get();
    // dd($results);
    // dd($results);
    $back = [];
    if($results[0]->t1==$titikAwals){
        array_push($back,$results[0]->t1);
        array_push($back,$results[0]->x1);
        array_push($back,$results[0]->y1);
        array_push($back,$results[0]->t2);
        array_push($back,$results[0]->x2);
        array_push($back,$results[0]->y2);

    }
    else{
        array_push($back,$results[0]->t2);
        array_push($back,$results[0]->x2);
        array_push($back,$results[0]->y2);
        array_push($back,$results[0]->t1);
        array_push($back,$results[0]->x1);
        array_push($back,$results[0]->y1);

    }
    // dd($back."back");
    return $back;
    }
}



