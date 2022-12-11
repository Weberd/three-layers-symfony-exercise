import {Component, OnInit, ViewChild} from '@angular/core';
import {ColDef, GridApi, GridReadyEvent} from "ag-grid-community";
import {IPriceInterface} from "../../interfaces/price.interface";

import {
  ChartComponent,
  ApexAxisChartSeries,
  ApexChart,
  ApexYAxis,
  ApexXAxis,
  ApexTitleSubtitle
} from "ng-apexcharts";
import * as moment from 'moment';

export type ChartOptions = {
  series: ApexAxisChartSeries;
  chart: ApexChart;
  xaxis: ApexXAxis;
  yaxis: ApexYAxis;
  title: ApexTitleSubtitle;
};

@Component({
  selector: 'app-history-data',
  templateUrl: './history-data.component.html',
  styleUrls: ['./history-data.component.scss']
})
export class HistoryDataComponent {
  public historyData: IPriceInterface[] = [
    {
      date: 1670596200,
      open: 1.190000057220459,
      high: 1.2000000476837158,
      low: 1.159999966621399,
      close: 1.159999966621399,
      volume: 3921300,
    },
    {
      date: 1670509800,
      open: 1.190000057220459,
      high: 1.2000000476837158,
      low: 1.1399999856948853,
      close: 1.2000000476837158,
      volume: 4550800,
    },
    {
      date: 1670423400,
      open: 1.2000000476837158,
      high: 1.2400000095367432,
      low: 1.149999976158142,
      close: 1.1699999570846558,
      volume: 5036700,
    },
    {
      date: 1670337000,
      open: 1.159999966621399,
      high: 1.2100000381469727,
      low: 1.1299999952316284,
      close: 1.190000057220459,
      volume: 5987900,
    },
    {
      date: 1670250600,
      open: 1.1799999475479126,
      high: 1.2200000286102295,
      low: 1.159999966621399,
      close: 1.1799999475479126,
      volume: 3027600,
    },
    {
      date: 1669991400,
      open: 1.159999966621399,
      high: 1.2300000190734863,
      low: 1.159999966621399,
      close: 1.2200000286102295,
      volume: 1146500,
    },
    {
      date: 1669905000,
      open: 1.1799999475479126,
      high: 1.2300000190734863,
      low: 1.159999966621399,
      close: 1.190000057220459,
      volume: 8254500,
    },
    {
      date: 1669818600,
      open: 1.149999976158142,
      high: 1.1699999570846558,
      low: 1.1200000047683716,
      close: 1.149999976158142,
      volume: 1378300,
    },
    {
      date: 1669732200,
      open: 1.1399999856948853,
      high: 1.149999976158142,
      low: 1.1200000047683716,
      close: 1.1399999856948853,
      volume: 2195200,
    },
    {
      date: 1669645800,
      open: 1.149999976158142,
      high: 1.190000057220459,
      low: 1.1200000047683716,
      close: 1.1200000047683716,
      volume: 1438900,
    },
    {
      date: 1669386600,
      open: 1.1699999570846558,
      high: 1.1699999570846558,
      low: 1.149999976158142,
      close: 1.1699999570846558,
      volume: 937500,
    },
    {
      date: 1669213800,
      open: 1.2100000381469727,
      high: 1.2200000286102295,
      low: 1.149999976158142,
      close: 1.1699999570846558,
      volume: 937500,
    },
  ]

  private gridApi!: GridApi<IPriceInterface>;

  public columnDefs: ColDef[] = [
    {
      field: 'date',
      filter: false,
      valueFormatter: function dateFormatter(params: {value: number}) {
        return moment.unix(params.value).format('YYYY-MM-DD HH:mm:ss');
      }
    },
    { field: 'open' },
    { field: 'high' },
    { field: 'low' },
    { field: 'close' },
    { field: 'volume' },
  ];

  public defaultColDef: ColDef = {
    flex: 1,
    minWidth: 100,
    sortable: true,
    filter: true,
  };

  //CHART
  @ViewChild("chart") chart: ChartComponent | undefined;
  public chartOptions: ChartOptions = {
    series: [
      {
        // [open prices, high prices, low price, close price]
        // {
        //   x: new Date(1538778600000),
        //   y: [6629.81, 6650.5, 6623.04, 6633.33]
        // }
        data: []
      }
    ],
    chart: {
      type: "candlestick",
      height: 350
    },
    title: {
      text: "",
      align: "left"
    },
    xaxis: {
      type: "datetime"
    },
    yaxis: {
      tooltip: {
        enabled: true
      }
    }
  };

  onGridReady(params: GridReadyEvent) {
    this.chart?.updateSeries([{
        data: this.historyData.map(hd => {
          return {
            x: new Date(hd.date),
            // [open prices, high prices, low price, close price]
            y: [hd.open, hd.high, hd.low, hd.close]
          }
        })
      }]);
  }
}
