<?php

namespace App\Livewire;

use App\Models\Detail;
use App\Models\Transaction as ModelsTransaction;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\On;

class Transaction extends Component
{
    public $data, $years, $months, $year, $month;

    public function mount()
    {
        $this->month = date('n');
        $this->year = date('Y');
        $this->months = $this->getMonths();
        $this->years = $this->getYears();
        $this->data = $this->getData();
    }

    function getData($month = null, $year = null)
    {
        if (!$month) {
            $month = date('m');
        }
        if (!$year) {
            $year = date('Y');
        }
        return Detail::whereMonth('created_at', $month)->whereYear('created_at', $year)->orderBy('created_at', 'desc')->get();
    }

    function getMonths()
    {
        $month = [];
        for ($i = 1; $i < 13; $i++) {
            $month[$i] = date('F', mktime(0, 0, 0, $i, 10));
        }
        return $month;
    }

    function getYears()
    {
        return ModelsTransaction::select(DB::raw('YEAR(created_at) as year'))->distinct()->orderBy('year', 'desc')->get()->pluck('year');
    }

    public function render()
    {
        return view('livewire.transaction');
    }

    #[On('showTable')]
    public function showTable()
    {
        $data = $this->getData($this->month, $this->year);
        $datas = [];
        foreach ($data as $d) {
            $datas[] = [
                date('Y-m-d H:i:s', strtotime($d->created_at)),
                $d->product->name,
                number_format($d->qty, 0, ",", "."),
                number_format($d->price, 0, ",", "."),
                number_format($d->price * $d->qty, 0, ",", ".")
            ];
        }
        $this->dispatch('renderTable', ['item' => json_encode($datas)]);
    }
}
