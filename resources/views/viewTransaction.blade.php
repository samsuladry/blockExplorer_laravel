@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="top-label">
        <h1 style="margin-bottom: 20px;">Transaction</h1>
    </div>
    <div class="table-responsive-sm">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th colspan="3" style="text-align: center;">Summary</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th class="table-secondary">Status</th>
                    <td class="text-left" id="status"></td>
                </tr>
                <!-- start of row -->
                <tr>
                    <th class="table-secondary">Transaction Hash</th>
                    <td class="text-left" id="txnHash"></td>
                </tr>
                <!-- end of row -->
                <tr>
                    <th class="table-secondary">Transaction Index</th>
                    <td class="text-left" id="txnIndex">12</td>
                </tr>

                <tr>
                    <th class="table-secondary">Block Hash</th>
                    <td class="text-left" id="blockHash"></td>
                </tr>

                <tr>
                    <th class="table-secondary">Block Number</th>
                    <td class="text-left" id="blockNo"></td>
                </tr>

                <tr>
                    <th class="table-secondary">Sender</th>
                    <td class="text-left" id="sender"></td>
                </tr>

                <tr>
                    <th class="table-secondary">Recipient/Contract Address</th>
                    <td class="text-left" id="contractAddress"></td>
                </tr>

                <tr>
                    <th class="table-secondary">Cumulative Gas Used</th>
                    <td class="text-left" id="cumGasUsed"></td>
                </tr>

                <tr>
                    <th class="table-secondary">Content</th>
                    <td class="text-left" id="content"></td>
                </tr>
                                                    
            </tbody>
          </table>
    </div>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
<script src="https://cdn.ethers.io/lib/ethers-5.0.umd.min.js" type="application/javascript"></script>
{{-- <script type="module" src={{asset('js/web3.js')}}></script> --}}
{{-- <script type="module" src={{asset('js/unixToDate.js')}}></script> --}}
<script type="module">
    // import web3 from '/js/web3.js';
    import unixToDate from '/js/unixToDate.js'
    import web3 from '/js/web3.js'
    // const web3 = new Web3('https://ropsten.infura.io/v3/6abc6ef995814f84950059729182f065');

    let txnHash = "{{$txnHash}}"
    async function receipt()
    {
        let res = await web3.eth.getTransactionReceipt(txnHash)
        let cont = await getContentFromTxnHash()
        document.getElementById("status").innerHTML = res.status
        document.getElementById("txnHash").innerHTML = res.transactionHash;
        document.getElementById("txnIndex").innerHTML = res.transactionIndex
        $("#blockHash").append("<tr><td> <a href='/viewBlock/"+ res.blockHash + "'>" + res.blockHash + "</a></td><tr>" )
        document.getElementById("blockNo").innerHTML = res.blockNumber
        document.getElementById("sender").innerHTML = res.from
        document.getElementById("contractAddress").innerHTML = res.to
        document.getElementById("cumGasUsed").innerHTML = res.cumulativeGasUsed
        document.getElementById("content").innerHTML = cont
        
        // document.getElementById("blockHash").innerHTML = res.blockHash
        // console.log(res)
    }
    receipt()

    async function getContentFromTxnHash()
    {
        let transaction =await web3.eth.getTransaction(txnHash)
        let input = await web3.utils.toAscii(transaction.input)
        return input
    }

</script>
@endsection