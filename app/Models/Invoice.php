<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    use ModelTrait;

    protected $fillable = ['batch_id','TraderSystemInvoiceNumber','MiddlewareInvoiceNumber','RelevantInvoiceNumber','InvoiceDate',
        'PINOfBuyer','Discount','InvoiceType','InvoiceCategory','TotalInvoiceAmount','TotalTaxableAmount','TotalTaxAmount',
        'ExemptionNumber','QRCode'];


    static function hasRecord($QRCode){
        return self::fetch()->where('QRCode',$QRCode)->exists();
    }

    static function getUniqueRecord($QRCode){
        return self::fetch()->where('QRCode',$QRCode)->first();
    }


    static function createInvoice($data){
      $obj = self::getFactory();

      $obj = $obj->create([
          'batch_id'=>$data['batch_id'],
          'TraderSystemInvoiceNumber'=>$data['TraderSystemInvoiceNumber'],
          'MiddlewareInvoiceNumber'=>$data['MiddlewareInvoiceNumber'],
          'RelevantInvoiceNumber'=>$data['RelevantInvoiceNumber'],
          'InvoiceDate'=>$data['InvoiceDate'],
          'PINOfBuyer'=>$data['PINOfBuyer'],
          'InvoiceType'=>$data['InvoiceType'],
          'InvoiceCategory'=>$data['InvoiceCategory'],
          'TotalInvoiceAmount'=>$data['TotalInvoiceAmount'],
          'TotalTaxableAmount'=>$data['TotalTaxableAmount'],
          'TotalTaxAmount'=>$data['TotalTaxAmount'],
          'ExemptionNumber'=>$data['ExemptionNumber'],
          'QRCode'=>$data['QRCode'],
          'Discount'=>$data['Discount']
      ]);

      return $obj;

    }



}
