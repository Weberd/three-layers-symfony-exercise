import { Component, OnInit } from '@angular/core';
import {FormBuilder, Validators} from "@angular/forms";
import * as moment from "moment/moment";
import {Router} from "@angular/router";

@Component({
  selector: 'app-history-data-request',
  templateUrl: './history-data-request.component.html',
  styleUrls: ['./history-data-request.component.scss']
})
export class HistoryDataRequestComponent {
  public maxEndDate = moment();

  historyRequestForm = this.formBuilder.group({
    ticker: ['', Validators.required],
    startDate: [moment().subtract(7, 'days'), []],
    endDate: [moment(), []],
    email: ['', [Validators.required, Validators.email]],
  });

  constructor(
    private formBuilder: FormBuilder,
    private router: Router
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

    this.router.navigate(['history-data'])
  }
}
