<!DOCTYPE html>
<html lang="en" style="background-color:darkslategray; color:antiquewhite;">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Program Titik</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    <body>

            @for($k=0;$k<count($show[1]);$k++)
                @if($k==0)
                <svg id="pinstart" xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="-0.5 0 25 25" fill="green" style="position: absolute; top:{{$show[1][$k][2]-30}}px; left:{{$show[1][$k][1]-15+20}}px; z-index:450;">
                    <path d="M3 11.3201C3 8.93312 3.94822 6.64394 5.63605 4.95612C7.32387 3.26829 9.61305 2.32007 12 2.32007C14.3869 2.32007 16.6762 3.26829 18.364 4.95612C20.0518 6.64394 21 8.93312 21 11.3201" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M3 11.3201C3 17.4201 9.76 22.3201 12 22.3201C14.24 22.3201 21 17.4201 21 11.3201" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 15.3201C14.2091 15.3201 16 13.5292 16 11.3201C16 9.11093 14.2091 7.32007 12 7.32007C9.79086 7.32007 8 9.11093 8 11.3201C8 13.5292 9.79086 15.3201 12 15.3201Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                @endif
                @if($k!=count($show[1])-1)
                    <button id="ruteTitiks" class="titikRute"  style="position: absolute; top:{{$show[1][$k][2]}}px; left:{{$show[1][$k][1]+20}}px; z-index:400;"><p>{{$show[1][$k][0]}}</p></button>
                @else
                    <button id="ruteTitiks" class="titikRute"  style="position: absolute; top:{{$show[1][$k][2]}}px; left:{{$show[1][$k][1]+20}}px; z-index:400;"><p>{{$show[1][$k][0]}}</p></button>
                    <button id="ruteTitiks" class="titikRute"  style="position: absolute; top:{{$show[1][$k][5]}}px; left:{{$show[1][$k][4]+20}}px; z-index:400;"><p>{{$show[1][$k][3]}}</p></button>
                    <svg id="pinstart" xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="-0.5 0 25 25" fill="blue" style="position: absolute; top:{{$show[1][$k][5]-30}}px; left:{{$show[1][$k][4]-15+20}}px; z-index:450;">
                        <path d="M3 11.3201C3 8.93312 3.94822 6.64394 5.63605 4.95612C7.32387 3.26829 9.61305 2.32007 12 2.32007C14.3869 2.32007 16.6762 3.26829 18.364 4.95612C20.0518 6.64394 21 8.93312 21 11.3201" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M3 11.3201C3 17.4201 9.76 22.3201 12 22.3201C14.24 22.3201 21 17.4201 21 11.3201" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 15.3201C14.2091 15.3201 16 13.5292 16 11.3201C16 9.11093 14.2091 7.32007 12 7.32007C9.79086 7.32007 8 9.11093 8 11.3201C8 13.5292 9.79086 15.3201 12 15.3201Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                @endif
            @endfor

            <svg class="lines" width="130vh" height="97vh" style="border:1px white solid; position:fixed; z-index:300;">
                @foreach($show[1] as $line)
                <line x1="{{(($line[1])-362+10)}}" y1="{{$line[2]-10}}" x2="{{(($line[4])-362+10)}}" y2="{{$line[5]-10}}" style="stroke: blue ;stroke-width:2;" />
                @endforeach
            </svg>



        <div style="display:flex; gap:20vh; flex-direction: row; align-items:center; justify-content:center; width:100%;">
            <div id="fotoArea">
                <img src="/foto/Map.png" alt="Foto" id="foto" onclick="tandaiTitik(event)" style="display:; z-index:1 !important;">

            </div>

        </div>


        <!-- <div>
            <p>daftar Hewan atau Tempat yang dekat</p>

        </div> -->

    </body>
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
            #ruteTitiks{

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
            #butTitiks{

                color:white;
                background-color: grey;
                -webkit-text-stroke: 0.6px black;
                -webkit-text-stroke-width: 0.3px;
                font-size: 12px;
                width: 10px;
                height: 10px;
                padding: 0 0;
                margin: 0 0;
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
</html>
