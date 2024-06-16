<!DOCTYPE html>
<html lang="en" style="background-color:darkslategray; color:antiquewhite;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Titik</title>
</head>
<body >
    @foreach($titiks as $titik)
        <button id="butTitiks"  style="position: absolute; top:{{$titik['yDot']}}px; left:{{$titik['xDot']}}px;z-index:600;">{{$titik['Nama']}}</button>
    @endforeach

    <div style="display:flex; gap:20vh; flex-direction: row; align-items:center; justify-content:center; width:100%;">
        <div id="fotoArea">
            <img src="/foto/Map.png" alt="Foto" id="foto" onclick="tandaiTitik(event)" style="display:; z-index:1 !important;">
            <img src="/foto/kosongan.png" alt="Foto" id="cekGaris" onclick="tandaiTitik(event)" style="display: none;">
        </div>
        <div style="display: flex; flex-direction:column;">
            <button class="cek" id="gantiBut" onclick="ganti('kosong')">CEK GARIS</button>
            <button class="cek" id="kembali" onclick="ganti('full')" style="display:none;">KEMBALI</button>
            <a href="/ButTitik"><button>Reset</button></a>
            <form action="/ButTitik/store" method="post">
                @csrf
                <input type="text" id="posisi_x" name="xDot" placeholder="posx">
                <input type="text" id="posisi_y" name="yDot" placeholder="posy">
                <button type="submit">Simpan</button>
            </form>
        </div>

    </div>

    <style>
        html::-webkit-scrollbar{
            width: 0;
        }
        #buttitiks{
            color:black;
            background-color: greenyellow;
            border-radius: 10px;
            /* width: 2px; */
        }
        form{
            display: flex;
            flex-direction: column;
            position: fixed;
            gap: 5px;
            top: 50vh;
            right: 10vh;
        }
        #fotoArea{
            width: 130vh;
            height: 97vh;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            z-index: 100;
        }
        #fotoArea>img{
            width: 130vh;
            height: 97vh;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            z-index: 200;
        }
        body>div>div>button, body>div>div>a>button{
            position: fixed;
            top: 10vh;
            right: 5vh;
            width: 300px;
            height: 50px;
            padding: 10px;
            border-radius: 12px;
            background-color: black;
            color: white;

        }
        body>div>div>button:active, body>div>div>a>button:active{
            background-color: grey;
            color: black;
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
