<div>
    <div class="flex items-center mb-4">
        <select wire:model="type" class="form-select">
            <option value="all">Tüm Faturalar</option>
            <option value="temel">Temel Fatura</option>
            <option value="ticari">Ticari Fatura</option>
        </select>

        <button wire:click="fetchInvoices" class="ml-4 btn btn-primary">
            Faturaları Yenile
        </button>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2">Fatura No</th>
                <th class="py-2">Tür</th>
                <th class="py-2">Tarih</th>
                <th class="py-2">Durum</th>
                <th class="py-2">Detay</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->id }}</td>
                    <td>{{ ucfirst($invoice->type) }}</td>
                    <td>{{ $invoice->issue_date }}</td>
                    <td>{{ ucfirst($invoice->status) }}</td>
                    <td>
                        <button wire:click="$emit('showInvoiceDetail', '{{ $invoice->id }}')" class="text-blue-500">Görüntüle</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
