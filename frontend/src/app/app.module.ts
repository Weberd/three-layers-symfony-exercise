import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import {FormsModule, ReactiveFormsModule} from "@angular/forms";
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import {NbThemeModule, NbLayoutModule, NbDatepickerModule} from '@nebular/theme';
import { NbEvaIconsModule } from '@nebular/eva-icons';
import {NbMomentDateModule} from "@nebular/moment";
import { HistoryDataComponent } from './history-data/history-data.component';
import {AgGridModule} from "ag-grid-angular";
import { HistoryDataRequestComponent } from './history-data-request/history-data-request.component';
import {NgApexchartsModule} from "ng-apexcharts";
import {SymbolsService} from "../services/symbols.service";
import {HistoricalDataService} from "../services/historical-data.service";
import {HttpClientModule} from "@angular/common/http";

@NgModule({
  declarations: [
    AppComponent,
    HistoryDataComponent,
    HistoryDataRequestComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    BrowserAnimationsModule,
    NbThemeModule.forRoot({name: 'default'}),
    NbLayoutModule,
    NbEvaIconsModule,
    NbDatepickerModule.forRoot(),
    NbMomentDateModule,
    ReactiveFormsModule,
    AgGridModule,
    NgApexchartsModule,
    HttpClientModule,
  ],
  providers: [
    SymbolsService,
    HistoricalDataService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
