<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\inventory;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use Auth;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function buy(Request $request, inventory $inventory){
        $request->validate([
            'buy_amount'=> 'required',
        ]);

        $buyAmount = $request->buy_amount;

        if($inventory->amount < $buyAmount){
            return redirect()->back()->with('error', 'Not enough stock');   
        }

        DB::beginTransaction();

        try{
            $total = $inventory->price * $buyAmount;
            $transactionHeader = TransactionHeader::create([
                'user_id' => Auth::id(),
                'total' => $total,
            ]);

            TransactionDetail::create([
                'transaction_header_id' => $transactionHeader->id,
                'inventories_id' => $inventory->id,
                'amount' => $buyAmount,
                'price' => $inventory->price,
                'address' => Auth::user()->address,
                'postal' => Auth::user()->postal,
            ]);

            $inventory->amount -= $buyAmount;

            if($inventory->amount === 0){
                $inventory->delete();
            } else {
                $inventory->save();
            }

            DB::commit();
            return redirect()->route('user.dashboard');
        } catch (\Throwable $th){
            DB::rollback();
            return redirect()->route('user.dashboard');
            // dd($th->getMessage());
        }
    }

    public function history(){
        $transactions = TransactionHeader::with('transactionDetails.inventory')->where('user_id', Auth::id())->get();
        return view('user.history', compact('transactions'));
    }
}
