<?php


namespace App\Services;


use App\Models\Batch;
use App\Models\Branch;
use App\Models\Invoice;
use App\Models\InvoiceItem;

class DeviceService
{

    static function readFromDevice($ip){ ///

    }

    static function readFromJson($jsonData){


          $request = $jsonData['REQUEST'];
          $batch = $request['BATCHHEADER'];
          $NumberOfLastInvoiceSent = $batch['NumberOfLastInvoiceSent'];

          if (!Batch::hasRecord($NumberOfLastInvoiceSent)){

             $branch = Branch::getSystemBranch()->first();

             $batch['branch_id'] = $branch->id;

             Batch::createBatch($batch);


              $batchRecord = Batch::getUniqueRecord($NumberOfLastInvoiceSent);

              $invoices = $request['BATCHDETAILS']['INVOICE'];

              foreach ($invoices as $invoice){

                  if (!Invoice::hasRecord($invoice['QRCode'])){
                      $invoice['batch_id'] = $batchRecord->id;
                      Invoice::createInvoice($invoice);

                      $invoiceObj = Invoice::getUniqueRecord($invoice['QRCode']);

                      $invoiceItems = $invoice['ItemDetails'];

                      foreach ($invoiceItems as $invoiceItem){
                          $invoiceItem['invoice_id'] = $invoiceObj->id;
                          InvoiceItem::createInvoiceItem($invoiceItem);
                      }

                  }

              }


          }



    }



}
