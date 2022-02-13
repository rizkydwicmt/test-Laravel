<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Transaksi;
use App\Models\BackupTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class TransaksiController extends Controller
{
    public function get(Request $request)
    {
        $data = Transaksi::where('reff' , '=', $request->reff)->get();

        if(sizeof($data) == 0 ) return $this->failure('Data transaksi tidak ditemukan', [], GAGAL_PAYMENT);
        if(sizeof($data) > 1) return $this->failure('Reff double payment', [], GAGAL_PAYMENT);

        BackupTransaksi::insert([
            'name' => $data[0]->name,
            'hp' => $data[0]->hp,
            'code' => $data[0]->code,
            'reff' => $data[0]->reff,
            'amount' => $data[0]->amount,
            'expired' => $data[0]->expired,
            'created_by' => $data[0]->created_by,
            'created_at' => $data[0]->created_at,
        ]);

        $result = [
            'amount' => $data[0]->amount,
            'reff' => $data[0]->reff,
            'name' => $data[0]->name,
            'code' => $data[0]->code,
            'status' => $data[0]->status,
        ];
        return response()->json($result);

    }

    public function getStatus(Request $request)
    {
        $data = Transaksi::select('amount', 'reff', 'expired', 'paid', 'name', 'code', 'status')->where('reff' , '=', $request->reff)->get();

        if(sizeof($data) == 0 ) return $this->failure('Data transaksi tidak ditemukan', [], GAGAL_PAYMENT);

        return response()->json($data);

    }

    public function save(Request $request)
    {
        //cek validasi
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:1',
            'reff' => 'required|numeric|min:1',
            'expired' => 'required|date|after:tomorrow',
            'name' => 'required|string',
            'hp' => 'required|string|min:10',
        ]);
        if ($validator->fails()) {
            return $this->failure($validator->errors());
        }

        $request->merge([
            'amount' => $request->amount + PAYMENT_FEE,
            'code' => PREFIX_PAYMENT_CODE . $request->hp,
            'status' => 'paid',
            'created_by' => '1',
        ]);

        $data = Transaksi::create($request->all());

        $result = [
            'amount' => $data->amount,
            'reff' => $data->reff,
            'expired' => $data->expired,
            'name' => $data->name,
            'code' => $data->code,
        ];

        return response()->json($result);
    }
}
