import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {HistoryDataComponent} from "./history-data/history-data.component";
import {HistoryDataRequestComponent} from "./history-data-request/history-data-request.component";

const routes: Routes = [
  {
    path: 'history-data-request',
    component: HistoryDataRequestComponent,
  },
  {
    path: 'history-data',
    component: HistoryDataComponent
  },
  {
    path: '',
    pathMatch: 'full',
    redirectTo: 'history-data-request'
  },
  { path: '**', redirectTo: 'history-data-request' },
];

@NgModule({
  imports: [RouterModule.forRoot(routes )],
  exports: [RouterModule]
})
export class AppRoutingModule { }
