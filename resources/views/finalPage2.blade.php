<!DOCTYPE html>
<html lang="en" style="background-color:white;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Titik</title>
</head>
<body >
        <div class="searchArea" >
            <div class="SearchFirst" id="tb1">
                    <div class="searchbar">
                        <input type="text" class="cari" oninput="search1()" id="cari1" placeholder="Cari Tujuan">
                    </div>
                    <div class="content" id="content1">
                    <?php $butfill = []; ?>

                        @foreach($butInfos as $inf)
                            @foreach($inf[1] as $in)
                                @if(!in_array($in,$butfill))
                                <?php array_push($butfill, $in); ?>
                                    <button onclick="fillTujuan('{{$in}}')">{{$in}}</button>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
            </div>
            <div class="SearchLast" id="tb2" style="display:none;">
                    <div class="searchbar">
                        <input type="text" class="cari" oninput="search2()" id="cari2" placeholder="Cari Titik Anda Berada">
                    </div>
                    <div class="content" id="content2">
                    <?php $butfill = []; ?>
                        @foreach($titiks as $titik)
                                    <button onclick="fillAsal('{{$titik->Nama}}')">{{$titik->Nama}}</button>
                        @endforeach


                    </div>
            </div>

        </div>
        <div class="detilview">

                <form action="/closest-Route2" method="post">
                        @csrf
                    <div>
                        <label for="">Lokasi apa yang ingin anda Tuju?</label>
                        <input type="text" name="inpTujuan" onclick="showtable('tujuan')" id="tableTujuan" value="" placeholder="klik untuk memilih">
                    </div>
                    <div>
                        <label for="">Dimana Lokasi Anda berada Saat ini?</label>
                        <input type="text" name="inpAwal" onclick="showtable('awal')" id="tableAsal" value="" placeholder="klik untuk memilih">
                    </div>
                    <input type="submit" value="Cari Rute">


                </form>
        </div>
        <div class="moreDetil">

        </div>

        <div class="denah">
            <div class="butArea" style="">
            <?php $butfill = []; ?>

                @foreach($titiks as $titik)

                            <button id="butTitiks" class="Tititik" onclick="isi('{{$titik['Nama']}}')" style="background-color: blue; position: absolute; top:{{($titik['yDot']+3)}}px; left:{{($titik['xDot']+20)}}px; z-index:450;"><p>{{$titik['Nama']}}</p></button>

                @endforeach
            </div>

            <div style="display:flex; gap:20vh; flex-direction: row; align-items:center; justify-content:center; width:100%;">
                <div id="fotoArea">
                    <img src="/foto/Map.png" alt="Foto" id="foto" onclick="tandaiTitik(event)" style="display:; z-index:-100 !important;">

                </div>
            </div>
        </div>
    <!-- <div>
        <p>daftar Hewan atau Tempat yang dekat</p>

    </div> -->
    <style>
        .moreDetil{
            position: fixed;
            /* left: 2vh; */
            right: 2vh;
            display: flex;
            flex-direction: column;
            gap: 10px 10px;
            top :50%;
            transform: translateY(-50%);
            width: 17%;
            height: 800px;
            z-index: 200;
            border-radius: 12px;
            background-color: #333;
        }
    </style>
    <style>
        .detilview{
            position: fixed;
            left: 2vh;
            display: flex;
            flex-direction: column;
            gap: 10px 10px;
            top :2%;
            /* transform: translateY(-50%); */
            width: 17%;
            height: 400px;
            z-index: 200;
            border-radius: 12px;
            background-color: #333;

        }
        form{
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        form>*{
            width: 80%;
            height: 25%;
        }
        form>div{
            display: flex;
            flex-direction: column;
            gap: 10px;
            color: White;
            font-size: 20px;
        }
        form>div>input{
            padding: 10px;
            border-radius: 10px;
            border: none;
            outline: none;
            font-size: 14px;
            font-weight: 400;
        }
        form>div>input:active{
            border: none;
            outline: none;
        }
        form>div>input::placeholder{
            font-size: 14px;
        }
        form>input{
            height: 10%;
            border-radius: 10px;
            border: none;
            outline: none;
            background-color: #007BFF;
            color: whitesmoke;
        }
        form>input:active{
            border: none;
            outline: none;
        }
        form>input:hover{
            background-color: #0056b3;
        }



    </style>
    <style>
        .searchArea{
            position: fixed;
            left: 2vh;
            display: flex;
            flex-direction: column;
            gap: 10px 10px;
            top :95%;
            transform: translateY(-50%);
            width: 17%;
            height: 800px;
            z-index: 200;
            /* display: none; */
            /* border: 1px black solid; */
        }


        .SearchFirst,.SearchLast{
            width: 100%;
            height: 50%;
            background-color: #333;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            /* border: red 1px solid; */
            align-items: center;
        }
        .searchbar{
            /* border: 1px white solid; */
            height: 20%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .cari{
            width: 80%;
            height: 30px;
            padding: 10px;
            border-radius: 12px;
            border: none;
            outline: nones;
            font-size: 18px;
        }
        .cari::placeholder{
            font-size: 18px;
        }
        .cari:active{
            outline: none;
            border: none;
        }
        .cari:hover{
            outline: none;
            border: none;
        }
        .content{
            display: flex;
            flex-direction: row;
            /* align-items:center; */
            justify-content:left;
            flex-wrap: wrap;
            /* max-width: 30px; */
            width: 80%;
            height: 65%;
            gap: 10px; /* Space between buttons */
            padding: 20px; /* Padding around the content */
            /* background-color: white;  */
            /* border: 1px white solid; */
            overflow-y: auto;
        }
        .content::-webkit-scrollbar{
            width: 4px;
            border-radius: 2px;
            /* background-color: black; */
            border: 2px;
            color: white;
        }
        .content button {
            padding: 10px 10px;
            height: 45px;
            border: none; /* Remove default button border */
            border-radius: 5px; /* Rounded corners */
            background-color: white; /* Button background color */
            color: #007BFF; /* Text color */
            font-size: 16px; /* Font size */
            cursor: pointer; /* Pointer cursor on hover */
            transition: background-color 0.0s;
            width:fit-content; /* Smooth transition for background color */
        }

        .content button:hover {
            color: white;
            font-weight: 400;
            background-color: #0056b3; /* Darker background color on hover */
        }
    </style>


    <style>
        .hewan {
        position: relative;
        width: 10%; /* Sesuaikan lebar sesuai kebutuhan */
        display: flex;
        gap: 10px;
        flex-wrap: wrap; /* Untuk menangani responsifitas */
        }

        .button-tooltip {
            position: absolute;
            top: -30px; /* Adjust this value to position the text as desired */
            left: 50%;
            transform: translateX(-50%);
            background-color: #fff;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: none;
        }

        .hewan button:hover + .button-tooltip {
            display: block;
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
            /* background-color: greenyellow; */
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
            border-radius: 20px;
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




    </style>
    <script>
        function fillTujuan(tujuan){
            console.log(tujuan);
            let inp = document.getElementById('tableTujuan');
            console.log('isi '+inp.value);
            inp.value = tujuan;
        }
        function fillAsal(tujuan){
            console.log(tujuan);
            let inp = document.getElementById('tableAsal');
            inp.value = tujuan;
        }
        function showtable(tujuanOrAwal){
            let tT = document.getElementById('tb1');
            let tA = document.getElementById('tb2');
            tT.style.display='none';
            tA.style.display='none';
            if(tujuanOrAwal=='tujuan'){
                tT.style.display='';
            }
            else{
                tA.style.display='';
            }
        }
        function search1(){
            let but = document.querySelectorAll(`#content1>button`)
            but.forEach(function(a){
            let isi = document.getElementById('cari1');
                a.style.display = 'none';
                if(a.textContent.toLowerCase().includes(isi.value.toLowerCase())){
                    a.style.display = "";
                }
                // console.log(a.textContent);
            })
        }

        function search2(){
            let but = document.querySelectorAll(`#content2>button`)
            but.forEach(function(a){
            let isi = document.getElementById('cari2');
                a.style.display = 'none';
                if(a.textContent.toLowerCase().includes(isi.value.toLowerCase())){
                    a.style.display = "";
                }
                // console.log(a.textContent);
            })
        }
        // function setupFilter(inputId, contentClass) {
        //     document.getElementById(inputId).addEventListener('input', function() {
        //         const searchQuery = this.value.toLowerCase();
        //         const buttons = document.querySelectorAll(`#$content>button`);


        //         buttons.forEach(button => {
        //             const buttonText = button.textContent.toLowerCase();
        //             if (buttonText.includes(searchQuery)) {
        //                 button.style.display = '';
        //             } else {
        //                 button.style.display = 'none';
        //             }
        //         });
        //     });
        // }
    </script>
    <script>

        // document.querySelector('.cari').addEventListener('input', function() {
        //         const searchQuery = this.value.toLowerCase();
        //         const buttons = document.querySelectorAll('.content button');

        //         buttons.forEach(button => {
        //             const buttonText = button.textContent.toLowerCase();
        //             if (buttonText.includes(searchQuery)) {
        //                 button.style.display = '';
        //             } else {
        //                 button.style.display = 'none';
        //             }
        //         });
        //     });
        // console.log("tinggi : "+document.getElementById('foto').offsetHeight)
        function isiHewan(hewan){
                // console.log('nama : ',hewan);
            let inp = document.getElementById('namaHewan');
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
