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
import {HistoricalDataService} from "../../services/historical-data.service";
import {ActivatedRoute, Params} from "@angular/router";
import {of} from "rxjs";

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
  public symbol = '';
  public startDate = 0;
  public endDate = 0;
  public email = '';

  public historyData: IPriceInterface[] = [];

  constructor(
    private historyDataService: HistoricalDataService,
    public route: ActivatedRoute
  ) {

  }

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
    this.route.params.subscribe((params: Params) => {
      this.symbol = params['symbol'];
      this.startDate = params['startDate'];
      this.endDate = params['endDate'];
      this.email = params['email'];

      this.historyDataService.fetch(this.symbol, this.startDate, this.endDate, this.email).subscribe((prices: IPriceInterface[]) => {
        this.historyData = prices;

        this.chart?.updateSeries([{
          data: prices.map((hd: IPriceInterface) => {
            return {
              x: moment.unix(hd.date).toDate(),
              // [open prices, high prices, low price, close price]
              y: [hd.open, hd.high, hd.low, hd.close]
            }
          })
        }]);
      })
    })
  }
}
