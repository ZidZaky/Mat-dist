<html>
    <head>

    </head>
    <body>
        <div>
            <a href="/denah"><button><p>Denah</p></button></a>
            <a href="/denah2"><button><p>Hamilton</p></button></a>
            <a href="/ButTitik"><button><p>Buat Titik</p></button></a>
            <a href="/new"><button><p>Buat Garis</p></button></a>
            <a href="/setinfo/all"><button><p>Beri Nama</p></button></a>
        </div>

    </body>
    <style>
        body{
            background-color:darkolivegreen;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20vh;
        }
        body>div{
            display: flex;
            flex-direction: column;
            gap: 3vh;
            align-items: center;
            justify-content: center;
        }
        body>div>a>button{
            width: fit-content;
            padding: 5vh;
            border-radius: 20px;
            border: none;
            box-shadow: h-offset v-offset blur-radius spread-radius color 4px black;
            background-color: white
        }

        body>div>a>button>p{
            padding: 0 0;
            margin: 0 0;
            font-size: 5vh;
        }
        body>div>a>button:active{
            background-color: grey;
        }
    </style>
</html>
