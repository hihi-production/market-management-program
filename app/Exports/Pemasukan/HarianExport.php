<?php

namespace App\Exports\Pemasukan;

use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class HarianExport implements FromView
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Export file based filter date on view
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(): View
    {
        $filter = $this->request;

        if ($filter->has('pemasukan')) {
            $pemasukans = Pembayaran::where('tanggal', $filter->pemasukan)
                ->with('user', 'kontrak.penyewa', 'kontrak.jenisToko')
                ->get();

            $daily = Carbon::parse($filter->pemasukan)->translatedFormat('l d F Y');
        } else {
            $pemasukans = Pembayaran::whereDate('tanggal', Carbon::today())
                ->with('user', 'kontrak.penyewa', 'kontrak.jenisToko')
                ->get();

            $daily = Carbon::now()->translatedFormat('l d F Y');
        }

        return view('exports.pemasukan.harian', [
            'daily'      => $daily,
            'pemasukans' => $pemasukans,
        ]);
    }
}
