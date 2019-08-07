<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;

class ReportsController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (request('start') || request('end')) {
            $transactions = Transaction::whereBetween('created_at', [request('start'), request('end')])->get();
        } else {
            $transactions = Transaction::all();
        }
        
        return view('reports.index', compact('transactions'));
    }
}
