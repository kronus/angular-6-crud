import { ActivatedRoute } from '@angular/router';
import { Component, OnInit } from '@angular/core';
import { CoinService } from './../../service/coin.service';
import { FormGroup,  FormBuilder,  Validators } from '@angular/forms';

@Component({
  selector: 'app-edit',
  templateUrl: './edit.component.html',
  styleUrls: ['./edit.component.css']
})
export class EditComponent implements OnInit {

  title = 'Edit Coin';
  angForm: FormGroup;
  coin = {};
  constructor(private coinservice: CoinService, private fb: FormBuilder, private route: ActivatedRoute) {
    this.createForm();
  }
  getCoinDetails(id) {
    this.coinservice.getCoin(id)
      .subscribe(data => {
        // console.log(data);
        this.coin = data;

      });
  }
  createForm() {
    this.angForm = this.fb.group({
      name: ['', Validators.required ],
      price: ['', Validators.required ]
    });
  }
  showMsg(msg) {
    console.log(this.route.snapshot.params['id'], this.route.snapshot.params['name'], this.route.snapshot.params['price']);
  }
  ngOnInit() {
    this.getCoinDetails(this.route.snapshot.params['id']);
  }
  updateCoin(id, name, price) {
      this.coinservice.updateCoin(id, name, price);
  }
  deleteCoin(id) {
    this.coinservice.deleteCoin(id);
  }
}
