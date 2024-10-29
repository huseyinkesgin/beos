<div>
    @if($invoice)
        <h3 class="mb-4 text-xl font-bold">{{ ucfirst($invoice->type) }} Fatura Detayları</h3>
        <p><strong>Fatura No:</strong> {{ $invoice->id }}</p>
        <p><strong>Fatura Türü:</strong> {{ ucfirst($invoice->type) }}</p>
        <p><strong>Müşteri:</strong> {{ $invoice->customer_name }}</p>
        <p><strong>Durum:</strong> {{ ucfirst($invoice->status) }}</p>
    @else
        <p>Fatura bilgisi bulunamadı.</p>
    @endif
</div>
