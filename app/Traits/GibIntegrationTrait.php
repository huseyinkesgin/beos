<?php

namespace App\Traits;

use App\Service\GibIntegrationService;

trait GibIntegrationTrait
{
    public function fetchInvoices($instanceIdentifier)
    {
        $gibService = new GibIntegrationService();

        try {
            $invoices = $gibService->fetchInvoices($instanceIdentifier);

            if ($invoices) {
                foreach ($invoices->Invoice as $invoice) {
                    \App\Models\Invoice::updateOrCreate(
                        ['id' => (string) $invoice->UUID],
                        [
                            'type' => (string) $invoice->InvoiceTypeCode,
                            'issue_date' => (string) $invoice->IssueDate,
                            'customer_name' => (string) $invoice->AccountingCustomerParty->Party->PartyName->Name,
                            'status' => 'bekliyor',
                        ]
                    );
                }
            }

            session()->flash('message', 'Faturalar başarıyla çekildi.');
        } catch (\Exception $e) {
            logger()->error('Fatura çekme hatası: ' . $e->getMessage());
        }
    }
}
