import { Component, OnInit } from '@angular/core';
import {FormBuilder, Validators} from "@angular/forms";
import * as moment from "moment/moment";
import {Router} from "@angular/router";
import {SymbolsService} from "../../services/symbols.service";

@Component({
  selector: 'app-history-data-request',
  templateUrl: './history-data-request.component.html',
  styleUrls: ['./history-data-request.component.scss']
})
export class HistoryDataRequestComponent {
  public maxEndDate = moment();
  public symbols$ = this.symbolsService.fetch();

  historyRequestForm = this.formBuilder.group({
    ticker: ['', Validators.required],
    startDate: [moment().subtract(7, 'days'), []],
    endDate: [moment(), []],
    email: ['', [Validators.required, Validators.email]],
  });

  constructor(
    private formBuilder: FormBuilder,
    private router: Router,
    private symbolsService: SymbolsService
  ) {}

  get f() { return this.historyRequestForm.controls; }

  touchedAndInvalid(): boolean {
    return this.historyRequestForm.invalid && (this.historyRequestForm.dirty || this.historyRequestForm.touched)
  }

  onSubmit(): void {
    this.historyRequestForm.markAllAsTouched();

    if (this.historyRequestForm.invalid) {
      return
    }

    const dto = this.historyRequestForm.getRawValue();

    dto.startDate?.set({hour:0,minute:0,second:0,millisecond:0})
    dto.endDate?.set({hour:23,minute:59,second:59,millisecond:999})

    this.router.navigate([
      'history-data',
      dto.ticker,
      dto.startDate?.unix(),
      dto.endDate?.unix(),
      dto.email
    ])
  }
}
