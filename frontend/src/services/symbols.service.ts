import {HttpClient} from "@angular/common/http";
import {Injectable} from "@angular/core";
import {Observable} from "rxjs";

@Injectable()
export class SymbolsService {
  constructor(
    private http: HttpClient
  ) {}

  fetch(): Observable<string[]> {
    return this.http.get<string[]>('/api/v1/symbols')
  }
}
