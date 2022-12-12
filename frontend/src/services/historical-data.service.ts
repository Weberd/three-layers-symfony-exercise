import {HttpClient} from "@angular/common/http";
import {Injectable} from "@angular/core";
import {Observable} from "rxjs";
import {IPriceInterface} from "../interfaces/price.interface";

@Injectable()
export class HistoricalDataService {
  constructor(
    private http: HttpClient
  ) {}

  fetch(symbol: string, startDate: number, endDate: number, email: string): Observable<IPriceInterface[]> {
    return this.http.get<IPriceInterface[]>('/api/v1/historical-data',
      {
        params: {
          symbol: symbol,
          start_date: startDate,
          end_date: endDate,
          email: email
        }
      })
  }
}
