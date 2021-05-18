<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Block Explorer</title>
    <link rel="shortcut icon" href={{asset('img/iiumlogo_Whl_icon.ico')}} />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <style>
        body
        {
            padding-top: 15x;
        }
        h1
        {
            margin: 15px 0px;
        }
    </style>


</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <a href="/"><img src={{asset('img/IIUMlogo.png')}} alt="logo"></a>
                <h1>IIUM's Escroll Block Explorer</h1>
                @yield('content')
                {{-- @php
                    dd(asset("image"));
                @endphp --}}
  
                <footer class="text-center">
                    Copyright 2020 UniDLT
                </footer>
            </div>
        </div>
    </div>
    
</body>

<script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.6/dist/clipboard.min.js"></script> --}}
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

</html>