<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;
    use ModelTrait;

    protected $fillable = ['invoice_id','HSCode','Category','HSDesc','Quantity','UnitPrice','ItemAmount',
        'TaxRate','TaxAmount'];


    static function createInvoiceItem($data){

        $obj = self::getFactory();

        $obj->create([
            'invoice_id'=>$data['invoice_id'],
            'HSCode'=>$data['HSCode'],
            'Category'=>$data['Category'],
            'HSDesc'=>$data['HSDesc'],
            'Quantity'=>$data['Quantity'],
            'UnitPrice'=>$data['UnitPrice'],
            'ItemAmount'=>$data['ItemAmount'],
            'TaxRate'=>$data['TaxRate'],
            'TaxAmount'=>$data['TaxAmount']
        ]);

    }


}
