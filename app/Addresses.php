<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addresses extends Model {

 public $table = "addresses";
 protected $fillable = [
  'first_name',
  'last_name',
  'email',
  'sec_email',
  'fb_account_url',
  'prim_phone',
  'sec_phone',
  'city',
  'country',
  'street',
  'home',
  'address2'
 ];
}
