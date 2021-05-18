<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class BlockController extends Controller
{
    public function main()
    {
        $start = 0;
        $limit = 100;
        $blockNumber = 0;
        return view('blockExplorer_main', compact('start', 'limit', 'blockNumber' ));
        // return view('blockExplorer_main', compact('start', 'limit' ));
    }
    
    public function prevMain(Request $request)
    {
        // dd($request->latestBlock);
        $start = $request->start;
        $limit = $request->limit;
        $blockNumber = $request->latestBlock;
        // $blockNumber = $request->then(function ($data)
        // {
        //     $blockNumber = $data->latestBlock;
        //     dd($data);
        //     return $blockNumber;
        // });
        // dd($blockNumber);
        return view('blockExplorer_main', compact('start', 'limit', 'blockNumber' ));
        // return view('blockExplorer_main', compact('start', 'limit' ));
    }

    public function viewBlock($blockHash)
    {
        return view('viewBlock', ['blockHash' => $blockHash ]);
    }

    public function viewTxn(Request $req)
    {
        $txnHash = $req ->txnHash;

        return view('viewTransaction', compact('txnHash'));
    }
}
