<!DOCTYPE html>
<html lang="en" style="background-color:darkslategray; color:antiquewhite;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Titik</title>
</head>
<body >
    @for($i=$start;$i<$end;$i++)
        <button id="butTitiks" class="Tititik" onclick="isi('{{$titiks[$i]['Nama']}}')" style="position: absolute; top:{{$titiks[$i]['yDot']}}px; left:{{$titiks[$i]['xDot']}}px; z-index:400;"><p>{{$titiks[$i]['Nama']}}</p></button>
    @endfor
        <svg class="lines" width="130vh" height="97vh" style="border:1px white solid; position:fixed; z-index:300;">
        @foreach($lines as $line)
            <line x1="{{(($line->x1)-362)}}" y1="{{$line->y1-10}}" x2="{{(($line->x2)-362)}}" y2="{{$line->y2-10}}" style="stroke: blue ;stroke-width:2;" />
        @endforeach
        </svg>

    <div style="display:flex; gap:20vh; flex-direction: row; align-items:center; justify-content:center; width:100%;">
        <div id="fotoArea">
            <img src="/foto/Map.png" alt="Foto" id="foto" onclick="tandaiTitik(event)" style="display:; z-index:1 !important;">

        </div>
        <div style="display: flex; flex-direction:column;">
            <button class="cek" id="gantiBut" onclick="ganti('kosong')">CEK GARIS</button>
            <button class="cek" id="kembali" onclick="ganti('full')" style="display:none;">KEMBALI</button>
            <a href="/new"><button>Reset</button></a>
            <form action="/setinfo/store/{{$siapa}}" method="post" id="myform">
                @csrf
                <input type="text" id = "titik"name="titik" placeholder="Klik Tombol">
                <input type="text" id="namaHewan" name="NamaHewan" placeholder="Klik Hewan">
                <button type="submit">Simpan</button>
            </form>
        </div>
    </div>
    <div class="hewan">
        <p>NAMA HEWAN / TEMPAT</p>
        <input type="text" name="" id="searches" oninput="cari()" placeholder="Ketik Disini..">
        <hr style="width:100%;">
        <div #cari4>
            @foreach($hewans as $hew)
            <button onclick="isiHewan('{{$hew->namaHewan}}')">{{$hew->namaHewan}}</button>
            @endforeach
        </div>

    </div>
    <div class="detilinfo">
        @foreach($arys as $ary)
        <div id="info{{$ary[0]}}" class="infoses" style="display:none;">
            @if(count($ary[1])>0)
            <p style="font-size:15px;">Detil info Untuk Titik {{$ary[0]}}</p>

            <div>
                <br>
                @foreach($ary[1] as $ar)
                    <p>- {{$ar}}</p>
                @endforeach
            </div>
            @else
            <p style="font-size:15px;">Belum ada Detil Untuk Titik {{$ary[0]}}</p>

            @endif
        </div>
        @endforeach
    </div>
    <!-- <div>
        <p>daftar Hewan atau Tempat yang dekat</p>

    </div> -->
    <style>
        .hewan {
            position: relative;
            width: 15%; /* Sesuaikan lebar sesuai kebutuhan */
            display: flex;
            flex-direction: column;
            gap: 10px;
            left:3vh;
            flex-wrap: wrap; /* Untuk menangani responsifitas */
            background-color: #333;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            padding-bottom: 10px;
            /* height: 650px; */
        }
        .hewan>input{
            padding: 10px;
            border-radius: 12px;
            border: none;
            outline: none;
            width: 80%;
        }
        .hewan>div{
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            padding: 10px;
            overflow-y: auto;
            height: 580px;
            gap: 10px;
            border-radius: 12px;
        }
        .hewan>div::-webkit-scrollbar{
            width: 5px;

        }
        .hewan>div>button{
            background-color: white;
            color: blue;
            width: fit-content;
            border: none;
            outline: none;
        }
        .hewan>div>button:hover{
            background-color: #355c7d;
            color: white;
        }
    </style>


        <style>
            .detilinfo{
                position: absolute;
                top: 30%;
                left: 85%;
                width: 10%;
                background-color: #333;
                padding: 4px;

            }
            .detilinfo>div{
                display: flex;
                flex-direction: column;
                /* flex-wrap: wrap; */
                gap: 10% 10px;
                /* border: 5px black solid; */
                width: 100%;
            }
            .detilinfo>div>*{
                /* border: 1px black solid; */
                /* background-color: #f2f2f2; */
                padding: 2px 2px;
                margin: 2px 0;
                color: white;
                width: fit-content;
            }
        </style>

    <style>
        .lines{
            width: 130vh;
            height: 97vh;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
        }
        .navbar{
            display: flex;
            flex-direction: column;
            position: fixed;
            right: 2vh;
            top:2vh;
        }
        .navbar>a{

        }
        html::-webkit-scrollbar{
            width: 0;
        }
        #butTitiks{

            color:white;
            background-color: greenyellow;
            -webkit-text-stroke: 0.6px black;
            -webkit-text-stroke-width: 0.3px;
            font-size: 12px;
            width: 10px;
            height: 10px;
            padding: 0 0;
            margin: 0 0;
        }


        .Tititik{

        }

        form{
            display: flex;
            flex-direction: column;
            position: fixed;
            gap: 5px;
            top: 10vh;
            right: 10vh;
            z-index: 900;

        }
        #fotoArea{
            width: 130vh;
            height: 97vh;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
        }
        #fotoArea>img{
            width: 130vh;
            height: 97vh;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
        }
        body>div>div>button, body>div>div>a>button{
            width: 300px;
            height: 50px;
            padding: 10px;
            border-radius: 12px;
            background-color:cadetblue;

        }
        body>div>*{
            /* border: 1px white solid; */
        }
        form input {
            width: 20vh;
            border-radius: 3px;
            background-color: #f2f2f2;
            color: #333;
            padding: 8px;
            border: 1px solid #ccc;
            transition: border-color 0.3s ease; /* Transisi untuk perubahan warna border */
        }

form input:focus {
    border-color: dodgerblue; /* Warna border saat mendapatkan fokus */
}

    </style>

    <script>
        function cari() {
            let buttons = document.querySelectorAll('.hewan>div>button');
            let isi = document.getElementById('searches');
            // console.log("a0");

            buttons.forEach(function(a){
                a.style.display = 'none';
                if(a.textContent.toLowerCase().includes(isi.value.toLowerCase())){
                    a.style.display = "";
                }
                // console.log(a.textContent);
            })
            if(isi.value==''){
                buttons.forEach(function(a){
                    a.style.display='';
                })
            }
        }


        // console.log("tinggi : "+document.getElementById('foto').offsetHeight)
        function isiHewan(hewan){
                // console.log('nama : ',hewan);
            let inp = document.getElementById('namaHewan');
            let isi = document.getElementById('searches');
            let buttons = document.querySelectorAll('.hewan>div>button');
            buttons.forEach(function(b){
                b.style.display="";
            })
            if(inp.value==""){
                inp.value=hewan;
            }
            else{
                inp.value=inp.value+","+hewan;
            }

        }
        document.addEventListener('keydown', function(e){
            if(e.key === 'Enter'){
                e.preventDefault();
                let form =document.getElementById('myform');
                form.submit();
            }
        })
        function isi(nama){
                // console.log('nama : ',nama);
                let inptitik = document.getElementById('titik');
                inptitik.value = nama;
                let infoses = document.getElementsByClassName('infoses');

                // Convert infoses to an array using Array.from
                Array.from(infoses).forEach(function(a) {
                    a.style.display = "none";
                    // console.log(a.textContent);
                });

                let dtl = 'info'+nama;
                // console.log(dtl);
                let inpdetil = document.getElementById(dtl);
                if(inpdetil){
                    console.log('ada');
                }
                else{
                    console.log('tida ada');

                }
                // console.log(inpdetil.textContent);
                inpdetil.style.display="flex";

            // console.log('x: ',x,", y: ",y);

        }

        let titik = [];
        function ganti(what){
            let buttonGanti = document.getElementById('gantiBut');
            let buttonBack = document.getElementById('kembali');
            let full = document.getElementById('foto');
            let kosong = document.getElementById('cekGaris');

            if(what=='kosong'){
                full.style.display = "none";
                buttonGanti.style.display="none";
                kosong.style.display = "";
                buttonBack.style.display="";
            }
            else{
                full.style.display = "";
                buttonGanti.style.display="";
                kosong.style.display = "none";
                buttonBack.style.display="none";
            }
        }
        function tandaiTitik(event) {
            let x = event.offsetX;
            let y = event.offsetY;

            let posisiXInput = document.getElementById('posisi_x');
            let posisiYInput = document.getElementById('posisi_y');
            posisiXInput.value = x;
            posisiYInput.value = y;

            let ctx = document.getElementById('foto').getContext('2d');
            ctx.beginPath();
            ctx.arc(x, y, 3, 0, 2 * Math.PI);
            ctx.fillStyle = 'red';
            ctx.fill();
        }
        function hitung(point1,point2){
              // Extract coordinates
            let u1 = Object.values(point1);
            let u2 = Object.values(point2);
            // let u1 = point1;
            // let u2 = point2;
            const x1 = u1[0];
            const y1 = u1[1];
            const x2 = u2[0];
            const y2 = u2[1];

            // Calculate the differences
            const dx = x2 - x1;
            const dy = y2 - y1;

            // Calculate the Euclidean distance
            const distance = Math.sqrt(dx * dx + dy * dy);
            console.log('distance : '+distance);
            return distance;

        };


    </script>
</body>
</html>
