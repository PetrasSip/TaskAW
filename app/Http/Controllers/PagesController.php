<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function index()
    {
        $set = new Setting();
        $generateRandomVat = random_int(15, 99);
        $oldVat = $set->getVATSize();
        $set->saveVAT($generateRandomVat);
        $newVat = $set->getVATSize();
        return  'OLD VAT value: '.$oldVat.'<br />New VAT value: '.$newVat. "<br /> REFRESH TO CHANGE";
    }
}
