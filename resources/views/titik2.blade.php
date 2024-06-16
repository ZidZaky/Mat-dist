<!DOCTYPE html>
<html lang="en" style="background-color:darkslategray; color:antiquewhite;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Titik</title>
</head>
<body >
    @foreach($titiks as $titik)

        <button id="butTitiks" class="Tititik" onclick="isi({{$titik['xDot']}},{{$titik['yDot']}},'{{$titik['Nama']}}')" style="position: absolute; top:{{$titik['yDot']}}px; left:{{$titik['xDot']}}px;z-index:400;"><p>{{$titik['Nama']}}</p></button>
    @endforeach
        <svg class="lines" width="130vh" height="97vh" style="border:1px white solid; position:fixed; z-index:300;">
        @foreach($lines as $line)
            <line x1="{{(($line->x1)-362)}}" y1="{{$line->y1-10}}" x2="{{(($line->x2)-362)}}" y2="{{$line->y2-10}}" style="stroke: blue ;stroke-width:2;" />
        @endforeach
        </svg>

    <div style="display:flex; gap:20vh; flex-direction: row; align-items:center; justify-content:center; width:100%;">
        <div id="fotoArea">
            <img src="/foto/Map.png" alt="Foto" id="foto" onclick="tandaiTitik(event)" style="display:; z-index:1 !important;">
            <img src="/foto/kosongan.png" alt="Foto" id="cekGaris" onclick="tandaiTitik(event)" style="display: none;">
        </div>
        <div style="display: flex; flex-direction:column;">
            <button class="cek" id="gantiBut" onclick="ganti('kosong')">CEK GARIS</button>
            <button class="cek" id="kembali" onclick="ganti('full')" style="display:none;">KEMBALI</button>
            <a href="/new"><button>Reset</button></a>
            <form action="/titik/store" method="post">
                @csrf
                <input type="text" id="garisAwal" name="namaAwal" placeholder="TitikAwal">
                <input type="text" id="garisAkhir" name="namaAkhir" placeholder="TitikAkhir">
                <input type="text" id="posisi_x" name="posisi_x" placeholder="posx" disabled style="display:none;">
                <input type="text" id="posisi_y" name="posisi_y" placeholder="posy" disabled style="display:none;">
                <input type="text" id="x1" name="garisx1" placeholder="x1" >
                <input type="teaxt" id="y1" name="garisy1" placeholder="y1" >
                <input type="text" id="x2" name="garisx2" placeholder="x2" >
                <input type="text" id="y2" name="garisy2" placeholder="y2" >
                <input type="text" id="totalJarak" name="totalJarak" placeholder="total jarak" >
                <button type="submit">Simpan</button>
            </form>
        </div>
        <div class="navbar">
            <a href="/ButTitik"><button>BUAT BUTTON</button></a>
            <a href="/new"><button>BUAT LINE</button></a>
        </div>
    </div>

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
            -webkit-text-stroke: 0.3px black;
            font-size: 10px;
            width: 10px;
            height: 10px;
            padding: 0 0;
            margin: 0 0;
        }
        #buttitiks>p{
            padding: 0 0;
            margin: 0 0;
            font-size: 5px;
        }
        .Tititik{

        }

        form{
            display: flex;
            flex-direction: column;
            position: fixed;
            gap: 5px;
            top: 50vh;
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
        form>input{
            width: 10vh;
            border-radius: 3px;
            text-decoration: none;
            outline: none;
            border: none;
        }
    </style>

    <script>
        // console.log("tinggi : "+document.getElementById('foto').offsetHeight)
        let press = 0;
        function isi(x,y,nama){
                console.log('nama : ',nama);
                let tAw = document.getElementById('garisAwal');
                let tAk = document.getElementById('garisAkhir');
                let x1 = document.getElementById('x1');
                let y1 = document.getElementById('y1');
                let x2 = document.getElementById('x2');
                let y2 = document.getElementById('y2');
                let jrk = document.getElementById('totalJarak');
            console.log('x: ',x,", y: ",y);
            if(press==0){
                x1.value=x;
                y1.value=y;
                tAw.value=nama;
            }
            else{
                x2.value=x;
                y2.value=y;
                tAk.value=nama;
                let ray1 = [];
                let ray2 = [];
                ray1.push(x1.value,y1.value);
                ray2.push(x2.value,y2.value);

                console.log(ray1);
                console.log(ray2);
                let result = hitung(ray1, ray2);
                console.log('hasil : ',result);
                jrk.value = result;
            }
            press = press+1;
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
