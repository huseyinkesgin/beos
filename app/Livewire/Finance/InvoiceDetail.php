<?php

namespace App\Livewire\Finance;

use App\Models\Invoice;
use Livewire\Component;

class InvoiceDetail extends Component
{

    public $invoice;

    protected $listeners = ['showInvoiceDetail' => 'loadInvoice'];

    public function loadInvoice($invoiceId)
    {
        $this->invoice = Invoice::find($invoiceId);
    }


    public function render()
    {
        return view('admin.finance.invoice-detail');
    }
}
