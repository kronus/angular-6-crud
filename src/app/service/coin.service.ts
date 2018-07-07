import { Injectable } from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';
import { map } from 'rxjs/operators';
import { Observable } from 'rxjs';
import {headersToString} from 'selenium-webdriver/http';

const httpOptions = {
  headers: new HttpHeaders({'Content-Type': 'application/json'})
};

const apiLinkLoc = 'http://localhost/ng6crud';
const apiLinkProd = 'http://kronusproductions.com/v2018/ng6crud';

@Injectable()
export class CoinService {

  constructor(private http: HttpClient, private router: Router) {}

  addCoin(name, price) {
    const obj = {
      name: name,
      price: price
    };

    const uri = apiLinkProd + '/api/post-coins/' + name + '/' + price;

    this
      .http
      .get(uri)
      .pipe(
        catchError(this.handleError), // then handle the error
        map(res => {
          // console.log(res);
        })
      )
      .subscribe(res =>
        this.router.navigate(['/index'])
      );
  }

  getCoins() {
    const uri = apiLinkProd + '/api/get-coins/';
    return this
              .http
              .get(uri);
  }

  getCoin(id: string): Observable<any> {
    const url = apiLinkProd + '/api/get-coins-id/' + id;
    return this
      .http
      .get(url, httpOptions)
      .pipe(
        map(this.extractData),
        catchError(this.handleError)
      );
  }

  updateCoin(id, name, price) {
    const uri = apiLinkProd + '/api/put-coins/' + id + '/' + name + '/' + price;

    const obj = {
      id: id,
      name: name,
      price: price
    };
    this
      .http
      .get(uri)
      .pipe(
        catchError(this.handleError), // then handle the error
        map(res => {
          // console.log(res);
        })
      )
      .subscribe(res => console.log());
    this.router.navigate(['/index']);
  }

  deleteCoin(id) {
    const uri = apiLinkProd + '/api/delete-coins/' + id;
    // console.log('gets to deleteCoin in services url: ' + uri);
      this
          .http
          .get(uri)
          .subscribe(res => {
            this.router.navigate(['/index']);
          });
  }

  private extractData(res: Response) {
    const body = res;
    return body || { };
  }

  private handleError(error: HttpErrorResponse) {
    if (error.error instanceof ErrorEvent) {
      // A client-side or network error occurred. Handle it accordingly.
      console.error('An error occurred:', error.error.message);
    } else {
      // The backend returned an unsuccessful response code.
      // The response body may contain clues as to what went wrong,
      console.error(
        `Backend returned code ${error.status}, ` +
        `body was: ${error.error}`);
    }
    // return an observable with a user-facing error message
    return throwError(
      'Something happened; please try again later.');
  }
}
