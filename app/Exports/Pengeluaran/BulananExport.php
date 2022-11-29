<?php

namespace App\Exports\Pengeluaran;

use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BulananExport implements FromView
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(): View
    {
        $filter = $this->request;

        if ($filter->has('month')) {
            $pengeluarans = Pengeluaran::whereMonth('tanggal', $filter->month)
                ->whereYear('tanggal', $filter->year)
                ->with('user')
                ->get();
        } else {
            $pengeluarans = Pengeluaran::whereMonth('tanggal', Carbon::now()->month)
                ->whereYear('tanggal', Carbon::now()->year)
                ->with('user')
                ->get();
        }

        $getMonth = $filter->month;
        $year     = $filter->year;

        if (!empty($getMonth) && !empty($year)) {
            $convertMonth = match ($getMonth) {
                '01' => 'Januari',
                '02' => 'Febuari',
                '03' => 'Maret',
                '04' => 'April',
                '05' => 'Mei',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'Agustus',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember',
            };

            $combined = $convertMonth . ' ' . $year;
        } else {
            $combined = Carbon::now()->translatedFormat('F Y');
        }

        return view('exports.pengeluaran.bulanan', [
            'combined'     => $combined,
            'pengeluarans' => $pengeluarans,
        ]);
    }
}
