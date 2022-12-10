import { Component } from '@angular/core';
import * as moment from 'moment';
import {FormBuilder, FormControl, Validators} from "@angular/forms";
import {DateValidator} from "../validators/date.validator";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  maxEndDate = moment();

  historyRequestForm = this.formBuilder.group({
    ticker: ['', Validators.required],
    startDate: [moment().subtract(7, 'days'), [Validators.required, DateValidator.dateValidator]],
    endDate: [moment(), [Validators.required, DateValidator.dateValidator]],
    email: ['', Validators.required, Validators.email],
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

  dateValidator(control: FormControl): { [p: string]: boolean } | null {
    if (control.value) {
      const date = moment(control.value);
      const today = moment();

      if (date.isBefore(today)) {
        return { 'invalidDate': true }
      }
    }
    return null;
  }
}
