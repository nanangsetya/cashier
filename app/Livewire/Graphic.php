<?php

namespace App\Livewire;

use App\Models\Transaction;
use App\Models\Type;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Graphic extends Component
{
    public $data, $years;

    public function mount()
    {
        $this->data = $this->count();
        $this->years = $this->getYears();
    }

    public function render()
    {
        return view('livewire.graphic');
    }

    function getYears()
    {
        return Transaction::select(DB::raw('YEAR(created_at) as year'))->distinct()->orderBy('year','desc')->get()->pluck('year');
    }

    function count($year = null)
    {
        // Get the current year
        $currentYear = now()->year;
        if ($year) {
            $currentYear = $year;
        }

        // Get all dynamic types from the jenis table
        $jenisTypes = Type::get();

        // Perform the query
        $results = DB::table('details')
            ->select(
                DB::raw('MONTH(details.created_at) as month'),
                'type_id',
                DB::raw('sum(qty*details.price) as total')
            )
            ->whereYear('details.created_at', $currentYear)
            ->join('products', 'details.product_id', '=', 'products.id')
            ->join('types', 'products.type_id', '=', 'types.id')
            ->groupBy(DB::raw('MONTH(details.created_at)'), 'type_id')
            ->get();

        // Initialize arrays to hold the totals for each jenis
        $totals = [];
        foreach ($jenisTypes as $jenis) {
            $totals[$jenis->id] = array_fill(0, 12, 0);
        }

        // Process the query results
        foreach ($results as $result) {
            $totals[$result->type_id][$result->month - 1] = (int)$result->total;
        }

        // Format the results to include the jenis name
        $data = [];
        foreach ($jenisTypes as $jenis) {
            $data[] = [
                'name' => $jenis->name,
                'data' => $totals[$jenis->id]
            ];
        }

        $total = [];
        foreach ($data as $d) {
            foreach ($d['data'] as $key => $value) {
                if (isset($total[$key])) {
                    $total[$key] += $value;
                } else {
                    $total[$key] = $value;
                }
            }
        }
        $data[] = ['name' => 'Total', 'data' => $total];

        return json_encode($data);
    }

    #[On('showGraphic')]
    public function showGraphic($year)
    {
        $this->dispatch('renderChart', ['item' => $this->count($year)]);
    }
}
