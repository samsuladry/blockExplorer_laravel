@extends('layouts.layout')

@section('content')

<div class="container">

    <div class="table-responsive-sm">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th colspan="2">
                        <h1>
                            Block Detail
                        </h1>
                    </th>
                <tr>
            </thead>
            <tbody>
                <!-- start of row -->
                <tr>
                    <th class="table-secondary">Block No.</th>
                    <td id="blockNumber" class="text-left"></td>
                </tr>
                 <!-- end of row -->
                <tr>
                    <th class="table-secondary">Block Hash</th>
                    <td id="blockHash" class="text-left"></td>
                </tr>
                
                <tr>
                    <th class="table-secondary">Timestamp</th>
                    <td id="time" class="text-left"></td>
                </tr>
                
                <tr>
                    <th class="table-secondary">Miner</th>
                    <td id="miner" class="text-left"></td>
                </tr>
                
                <tr>
                    <th class="table-secondary">Difficulty</th>
                    <td id="difficulty" class="text-left"></td>
                </tr>
                
                <tr>
                    <th class="table-secondary">Size</th>
                    <td id="size" class="text-left"></td>
                </tr>
                
                <tr>
                    <th class="table-secondary">Gas Used</th>
                    <td id="gasUsed" class="text-left"></td>
                </tr>

                <tr>
                    <th class="table-secondary">Number</th>
                    <td id="number" class="text-left"></td>
                </tr>
            </tbody>
          </table>
          
          <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th colspan="2">
                        <h1>
                            List of Transactions in Block
                        </h1>
                    </th>
                <tr>
            </thead>
            <tbody id="transList" class="text-left">

            </tbody>
          </table>
    </div>

</div>
</div>

{{-- <script type="module" src={{asset('js/viewBlock.js')}}></script> --}}
<script type="module">
    import unixToDate from '/js/unixToDate.js'
    import web3 from '/js/web3.js'
    // const web3 = new Web3('https://ropsten.infura.io/v3/6abc6ef995814f84950059729182f065');

    
    async function view()
    {
        // let block = '{{$blockHash}}'
        var block = await web3.eth.getBlock('{{$blockHash}}')
        document.getElementById("blockNumber").innerHTML = block.number;
        document.getElementById("blockHash").innerHTML = block.hash;
        var t = block.timestamp;
        document.getElementById("time").innerHTML = unixToDate(t);
        document.getElementById("miner").innerHTML = block.miner;
        document.getElementById("difficulty").innerHTML = block.difficulty;
        document.getElementById("size").innerHTML = block.size;
        document.getElementById("gasUsed").innerHTML = block.gasUsed;
        document.getElementById("number").innerHTML = block.number;
        let blockTrans = block.transactions;

        // console.log(block)
        for(var i=0; i<blockTrans.length; i++)
        {
            $("#transList").append("<tr><td> <a href='/viewTransaction?txnHash=" + blockTrans [i] + "'>" + blockTrans [i] + "</a></td><tr>")
            // $("#transList").append("<tr><td> <a href='/viewTransaction?txnHash=" + blockTrans [i] + "'>" + blockTrans [i] + "</a></td><td><button class='clipborad' id='copy-button' data-clipboard-target='" + blockTrans[i] + "'>Copy</button><td></td><tr>")
            
        }
        
        // $( document ).ready(function() 
        // {
        // var clipboard = new Clipboard('.clipboard');
        // });
    }
    view()

    // $("#transList").append("<tr><td> <a href='/viewTransaction?txnHash=" + blockTrans [i] + "'>" + blockTrans [i] + "</a></td><td><button class='button' id='copy-button' data-clipboard-target='" + blockTrans[i] + "'>Copy</button>" + "</td><tr>")
    // $(function() 
    // {
    //     new Clipboard('#copy-button');
    // });
   


</script>
@endsection

