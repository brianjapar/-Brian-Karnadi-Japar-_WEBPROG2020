<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index(){
      $data_item = Item::all();
      return view('home',compact('data_item'));
  }
}
