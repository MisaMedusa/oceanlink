<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Groupapplication;
use App\Payment;
use App\Cheque;
use App\Enrollee;
use App\Account;
use Carbon\Carbon;
use App\Classdetail;
use PDF;
use Terbilang;
class CollectionController extends Controller
{
    //single
    public function viewSCollection(){
        $payment = Payment::all();
        $class = Classdetail::all();
        $classes = Classdetail::all();
        return view('admin.collection.single.collection',compact('class','payment','classes'));
    }


    public function insertSCollection(Request $request){
        $payment = new Payment;
        $payment->amount = $request->amount;
        $payment->amountChange = $request->amount - $request->amountPay;
        $payment->paymentType = 1;
        $payment->paymentDate = Carbon::parse($request->paymentDate)->format('y-m-d');
        $payment->paymentNumber =  $request->paymentNumber;
        $payment->account_id = $request->account_id;
        $payment->save();
        $account = Account::find($request->account_id);

        if($account->paymentMode == 1){
            $balance = $account->balance - $request->amountPay;
            $account->balance = $balance;
            $account->paymentMode = 2;
            $account->save();
        }
        else{
            $account->balance = 0;
            $account->save();
        }

        $enrollee = Enrollee::find($request->enrollee_id);
        $enrollee->status_id = 2;
        $enrollee->save();

        $account = Payment::all();
        $account = $account->last();
        $money = Terbilang::make($account->amount - $account->amountChange,' PESO ONLY');
        $pdf = PDF::loadView('pdf/receipt',['payment'=>$account,'money'=>$money]);
        return $pdf->download('pdf.pdf');
        return redirect()->to('/collection/single');
    }

    //group
    public function viewCollection(){
    	$payment = Payment::all();
    	$gapp = Groupapplication::all()->where('active','=',1);
    	return view('admin.collection.group.collection',compact('gapp','payment'));
    }

    public function insertInCashCollection(Request $request){
    	$payment = new Payment;
    	$payment->amount = $request->amount;
        $payment->amountChange = $request->amount - $request->amountPay;
    	$payment->paymentType = 1;
    	$payment->paymentDate = Carbon::parse($request->paymentDate)->format('y-m-d');
    	$payment->paymentNumber = $request->paymentNumber;
    	$payment->account_id = $request->account_id;
    	$payment->save();

    	$account = Account::find($request->account_id);
        if($account->paymentMode == 1){
            $balance = $account->balance - $request->amountPay;
            $account->balance = $balance;
            $account->paymentMode = 2;
            $account->save();
        }
        else{
            $account->balance = 0;
            $account->save();
        }

    	$gapp = Groupapplication::find($request->groupapplication_id);
    	foreach ($gapp->groupdetail as $detail ) {
    		$enrollee = Enrollee::find($detail->enrollee_id);
    		$enrollee->status_id = 2;
    		$enrollee->save();
    	}
        $account = Payment::all();
        $account = $account->last();
        $money = Terbilang::make($account->amount - $account->amountChange,' PESO ONLY');
        $pdf = PDF::loadView('pdf/greceipt',['payment'=>$account,'money'=>$money]);
        return $pdf->download('pdf.pdf');
    	return redirect('/collection/group');
    }

    public function insertCheckCollection(Request $request){
    	$payment = new Payment;
    	$payment->amount = $request->amount;
        $payment->amountChange = 0;
    	$payment->paymentType = 1;
    	$payment->paymentDate = Carbon::parse($request->paymentDate)->format('y-m-d');
    	$payment->paymentNumber = $request->paymentNumber;
    	$payment->account_id = $request->account_id;
    	$payment->save();
    	$payment = Payment::all();
    	$payment = $payment->last();

    	$cheque = new Cheque;
    	$cheque->accountNumber = $request->accountNumber;
    	$cheque->accountName = $request->accountName;
    	$cheque->checkNumber = $request->checkNumber;
    	$cheque->rtNumber = $request->rtNumber;
    	$cheque->payment_id = $payment->id;
    	$cheque->save();

    	$account = Account::find($request->account_id);
        if($account->paymentMode == 1){
            $balance = $account->balance - $request->amountPay;
            $account->balance = $balance;
            $account->paymentMode = 2;
            $account->save();
        }
        else{
            $account->balance = 0;
            $account->save();
        }

    	$gapp = Groupapplication::find($request->groupapplication_id);
    	foreach ($gapp->groupdetail as $detail ) {
    		$enrollee = Enrollee::find($detail->enrollee_id);
    		$enrollee->status_id = 2;
    		$enrollee->save();
    	}
        $account = Payment::all();
        $account = $account->last();
        $money = Terbilang::make($account->amount - $account->amountChange,' PESO ONLY');
        $pdf = PDF::loadView('pdf/greceipt',['payment'=>$account,'money'=>$money]);
        return $pdf->download('pdf.pdf');
        return redirect('/collection/group');
    }

    public function viewHistory(){
        $payment = Payment::all();
        return view('admin.collection.history',compact('payment'));

    }

    public function printReceipt(){
        $pdf = PDF::loadView('pdf/receipt');
        return $pdf->download('pdf.pdf');
        return redirect('/collection/single');
    }
}
