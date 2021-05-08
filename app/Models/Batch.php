<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;
    use ModelTrait;

    protected $fillable = ['branch_id','DateOfTransmission','DateOfTransaction','NumberOfLastInvoiceSent',
        'PINOfSupplier','MiddlewareSerialNumber','NumberOfInvoiceRecords'];

    static function createBatch($data){
        $obj = self::getFactory();
        $obj = $obj->create([
            'DateOfTransmission'=>$data['DateOfTransmission'],
            'DateOfTransaction'=>$data['DateOfTransaction'],
            'NumberOfLastInvoiceSent'=>$data['NumberOfLastInvoiceSent'],
            'PINOfSupplier'=>$data['PINOfSupplier'],
            'MiddlewareSerialNumber'=>$data['MiddlewareSerialNumber'],
            'NumberOfInvoiceRecords'=>$data['NumberOfInvoiceRecords'],
        ]);
        return $obj;
    }

    static function hasRecord($NumberOfLastInvoiceSent){
        return self::fetch()->where('NumberOfLastInvoiceSent',$NumberOfLastInvoiceSent)->exists();
    }

    static function getUniqueRecord($NumberOfLastInvoiceSent){
        return self::fetch()->where('NumberOfLastInvoiceSent',$NumberOfLastInvoiceSent)->first();
    }


}
