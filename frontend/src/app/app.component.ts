import { Component } from '@angular/core';
import * as moment from 'moment';
import {FormBuilder, Validators} from "@angular/forms";
import {momentDateValidator} from "../validators/momentDateValidator";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  maxEndDate = moment();

  historyRequestForm = this.formBuilder.group({
    ticker: ['', Validators.required],
    startDate: [moment().subtract(7, 'days'), []],
    endDate: [moment(), []],
    email: ['', [Validators.required, Validators.email]],
  });

  constructor(private formBuilder: FormBuilder) {}

  get f() { return this.historyRequestForm.controls; }

  touchedAndInvalid(): boolean {
    return this.historyRequestForm.invalid && (this.historyRequestForm.dirty || this.historyRequestForm.touched)
  }

  onSubmit(): void {
    this.historyRequestForm.markAllAsTouched();

    if (this.historyRequestForm.invalid) {
      return
    }
  }
}
