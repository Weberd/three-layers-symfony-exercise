import {FormControl, ValidationErrors} from "@angular/forms";
import * as moment from "moment";

export const momentDateValidator = (control: FormControl): ValidationErrors | null => {
  if (control.value) {
    if (!control.value.isValid()) {
      return { 'invalidDate': true }
    }
  }

  return null;
};
