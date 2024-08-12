<div>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <select name="" class="form-control" wire:change="showGraphic($event.target.value)">
                    @foreach($years as $y)
                        <option value="{{ $y }}">{{ $y }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <div wire:ignore>
                    <div id="statistic"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        const chart = Highcharts.chart('statistic', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Grafik Pendapatan'
            },
            xAxis: {
                categories: [
                    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                ]
            },
            yAxis: {
                title: {
                    text: 'Rupiah (Rp)'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                }
            },
            series: {!! $data !!}
        });
    </script>

    <script>
        document.addEventListener('renderChart', (e) => {
            chart.update({
                series: JSON.parse(e.detail[0].item)
            })
        })

    </script>
    
@endpush
