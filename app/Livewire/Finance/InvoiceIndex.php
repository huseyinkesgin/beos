<?php

namespace App\Livewire\Finance;

use App\Models\Invoice;
use Livewire\Component;
use App\Traits\GibIntegrationTrait;

class InvoiceIndex extends Component
{
    use GibIntegrationTrait;

    public $type = 'all'; // Temel, Ticari veya Tümü

    public function mount()
    {
        $instanceIdentifier = '190'; // Vergi Kimlik Numarası (örnek)
        $this->fetchInvoices($instanceIdentifier);
    }

    public function render()
    {
        $invoices = Invoice::when($this->type != 'all', function ($query) {
            return $query->where('type', $this->type);
        })->get();

        return view('admin.finance.invoice-index', ['invoices' => $invoices]);
    }
}
