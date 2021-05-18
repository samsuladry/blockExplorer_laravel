@extends('layouts.layout')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="search">
     <form id="target" method="get" action="{{ route('viewTransaction') }}">
        @csrf
        <input type="text" name="txnHash" placeholder="Search" id="txn-input"/>
        <input id="submit" type="submit" onclick="sendTxnHash">
      </form>
</div>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col" class="text-center">Block Number</th>
            <th scope="col" class="text-center">Block Hash</th>
            <th scope="col" class="text-center">Timestamp</th>
            {{-- <th scope="col" class="text-center">Transaction Hash</th> --}}
            
            
        </tr>
    </thead>

    <tbody>

    </tbody>
</table>

<h1>{{ $limit }}</h1>
<h1>{{ $start }}</h1>
<h1>{{ $blockNumber }}</h1>
{{-- <h1> {{!! $limit !!}}</h1> --}}

<form id="previousForm" action="{{ route('main.prev') }}" method="get">
    <input id="limit" name="limit"  type="hidden">
    <input id="start" name="start" type="hidden">
    <input id="latestBlock" name="latestBlock" type="hidden">
    <button type="button" id="previous">Previous</button>
    <button type="button" id="latest">Latest</button>
</form>


<script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
{{-- <script type="module" src={{asset('js/web3.js')}}></script> --}}
{{-- <script type="module" src={{asset('js/unixToDate.js')}}></script> --}}
<script type="module">
    // import web3 from '/js/web3.js';
    import unixToDate from '/js/unixToDate.js'
    import web3 from '/js/web3.js'

    let limit = {{ $limit }};
    let start = {{ $start }};
    let latestBlock = web3.eth.getBlockNumber().then( res => 
    {
        return res 
    })

    // latestBlock.then(res =>
    // {
    //     console.log('This ',res)
    // })

    let blockBaru = {{ $blockNumber }}
    // console.log("Latest Block luar", latestBlock)
    // let limit = 100;
    // let start  = 0;
    // let _token   = $('meta[name="csrf-token"]').attr('content');
    let txnHash = document.getElementById("txn-input")
    // var latest = document.getElementById('latest')
    // var previous = document.getElementById('previous')

    $("#previous").on("click", function()
    {
        limit += 100
        start += 0
        document.getElementById("limit").value = limit
        document.getElementById("start").value = start
        document.getElementById("latestBlock").value = 1
        console.log('dalam previous', limit)
        $("#previousForm").submit()
    
    })

    $("#latest").on("click", function()
    {
        if(limit <= 100 | start == 0)
        {
            alert("This is the latest page.")

        }
        else
        {
            limit = limit - 100
            start = start - 20
            document.getElementById("limit").value = limit
            document.getElementById("start").value = start
            document.getElementById("latestBlock").value = 1
            console.log('dalam latest ', limit)
            $("#previousForm").submit()
        }
        
    })

    

    // $( "#previous" ).click(addPrev());
    console.log('limit',limit)

    

    function sendTxnHash()
    {
        // document.getElementById('target').submit();
        // console.log(txnHash)
        $("#target").submit()

    }

    async function listBlock()
    {
        if(blockBaru == 0)
        {
            let latestBlock = await web3.eth.getBlockNumber()
            // let number1 = await web3.eth.getBlockNumber()
            // let latestBlock = Math.round(number1/1000)*1000
            console.log(Math.round((latestBlock/100) - 0.5)*100)
            
            // console.log("test: ", latestBlock)
            for(start; start<limit; start++)
            {
                var block = await web3.eth.getBlock(latestBlock - start)
                var blockNumber = block.number;
                var blockHash = block.hash;
                var t = block.timestamp;
                var time = unixToDate(t);
                // let x = window.location.href = "";

                // var transactionHash = block.transactions
                // console.log("Block " + time)
                $('tbody').append("<tr><td>" + blockNumber + "</td><td> <a href='/viewBlock/"+ blockHash + "'>" + blockHash + "</a></td><td>" + time + "</td></tr>")
            }
        }
        else if(blockBaru == 1)
        {
            let number = await web3.eth.getBlockNumber()
            // let number = 9306920
            let latestBlock = await Math.round((number/100) - 0.5)*100
            console.log(number)
            console.log(latestBlock)
            console.log(number-latestBlock)
            // console.log("test: ", latestBlock)
            let diff = number-latestBlock
            if(diff < 5 & diff > 0)
            {
                // startTemp += min
                for(start; start<limit; start++)
                {
                    var block = await web3.eth.getBlock(((number + 100) - start) - diff)
                    var blockNumber = block.number;
                    var blockHash = block.hash;
                    var t = block.timestamp;
                    var time = unixToDate(t);
                    // let x = window.location.href = "";

                    // var transactionHash = block.transactions
                    // console.log("Block " + time)
                    $('tbody').append("<tr><td>" + blockNumber + "</td><td> <a href='/viewBlock/"+ blockHash + "'>" + blockHash + "</a></td><td>" + time + "</td></tr>")
                }
            }
            else if (diff >= 5)
            {
                for(start; start<limit; start++)
                {
                    var block = await web3.eth.getBlock((latestBlock + 100) - start)
                    var blockNumber = block.number;
                    var blockHash = block.hash;
                    var t = block.timestamp;
                    var time = unixToDate(t);
                    // let x = window.location.href = "";

                    // var transactionHash = block.transactions
                    // console.log("Block " + time)
                    $('tbody').append("<tr><td>" + blockNumber + "</td><td> <a href='/viewBlock/"+ blockHash + "'>" + blockHash + "</a></td><td>" + time + "</td></tr>")
                }
            }
            else
            {
                for(start; start<limit; start++)
                {
                    var block = await web3.eth.getBlock(latestBlock - start)
                    var blockNumber = block.number;
                    var blockHash = block.hash;
                    var t = block.timestamp;
                    var time = unixToDate(t);
                    // let x = window.location.href = "";

                    // var transactionHash = block.transactions
                    // console.log("Block " + time)
                    $('tbody').append("<tr><td>" + blockNumber + "</td><td> <a href='/viewBlock/"+ blockHash + "'>" + blockHash + "</a></td><td>" + time + "</td></tr>")
                }
            }
            
        }
        

            // web3.eth.getBlock(latestBlock - start)
            //             .then(res =>
            //             {
            //                 var blockNumber = res.number;
            //                 var blockHash = res.hash;
            //                 var t = res.timestamp;
            //                 var time = unixToDate(t);
            //                 // let x = window.location.href = "";

            //                 // var transactionHash = block.transactions
            //                 // console.log("Block " + time)
            //                 $('tbody').append("<tr><td>" + blockNumber + "</td><td> <a href='/viewBlock/"+ blockHash + "'>" + blockHash + "</a></td><td>" + time + "</td></tr>")
            //             })
        // }

    }
    // setTimeout(listBlock, 5000);
    listBlock()


    // web3.eth.getBlockNumber()
    //     .then(res =>
    //     {
    //         for(start; start<limit; start++)
    //     {
    //         web3.eth.getBlock(res - start)
    //                     .then(res =>
    //                     {
    //                         var blockNumber = res.number;
    //                         var blockHash = res.hash;
    //                         var t = res.timestamp;
    //                         var time = unixToDate(t);
    //                         // let x = window.location.href = "";

    //                         // var transactionHash = block.transactions
    //                         // console.log("Block " + time)
    //                         $('tbody').append("<tr><td>" + blockNumber + "</td><td> <a href='/viewBlock/"+ blockHash + "'>" + blockHash + "</a></td><td>" + time + "</td></tr>")
    //                     })
            
    //     }
    //     })


</script>
@endsection
