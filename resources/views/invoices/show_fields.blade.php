<div class="row">
    <div class="col-xxl-8">
        <div class="row">
            <div class="col-lg-5 col-md-6">
                <div class="d-flex align-items-center mb-md-10 mb-5">
                    <div class="image image-circle image-small">
                        <img alt="Logo" src="{{ getLogoUrl() }}" height="100px" width="100px">
                    </div>
                    <h3 class="ps-7">Invoice #{{ $invoice->invoice_id }}</h3>
                </div>
            </div>
            <div class="col-lg-4 col-md-3 col-6">
                <div class="d-flex flex-column mb-md-10 mb-5 mt-3 mt-md-0">
                    <label for="name"
                           class="pb-2 fs-5 text-gray-600">{{ __('messages.invoice.invoice_date').':' }}</label>
                    <span class="fs-5 text-gray-800">{{ \Carbon\Carbon::parse($invoice->invoice_date)->translatedFormat('jS M, Y') }}</span>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <a target="_blank" href="{{ route('invoices.pdf',['invoice' => $invoice->id]) }}"
                   class="btn btn-success text-white">
                    {{ __('messages.invoice.print_invoice') }}
                </a>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="d-flex flex-column mb-md-10 mb-5">
                    <label for="name" class="pb-2 fs-5 text-gray-600">Issue For:</label>
                    <span class="fs-5 text-gray-800 mb-3">{{ $invoice->patient->patientUser->full_name }}</span>
                    <p class="text-gray-700 fs-5 mb-0">
                    @if(isset($invoice->patient->address) && !empty($invoice->patient->address))
                        {{ ucfirst($invoice->patient->address->address1) .' '. ucfirst($invoice->patient->address->address2) .', ' . ucfirst($invoice->patient->address->city) .' '. $invoice->patient->address->zip }}
                    @else
                        {{ __('messages.common.n/a') }}
                    @endif</div>
                </p>
            </div>
            <div class="col-md-2 col-md-6">
                <div class="d-flex flex-column mb-md-10 mb-5">
                    <label for="name" class="pb-2 fs-5 text-gray-600">Issue For:</label>
                    <span class="fs-5 text-gray-800 mb-3">{{ getAppName() }}</span>
                    <p class="text-gray-700 fs-5 mb-0">
                    {{ ($hospitalAddress=="") ? __('messages.common.n/a') : $hospitalAddress }}
                </div>
            </div>

            <div class="col-12">
                <table class="table table-striped box-shadow-none mt-4">
                    <thead>
                    <tr class="border-bottom fs-6  text-muted">
                        <th class="pb-2">{{ __('messages.account.account') }}</th>
                        <th class="pb-2">{{ __('messages.invoice.description') }}</th>
                        <th class="text-end pb-2">{{ __('messages.invoice.qty') }}</th>
                        <th class="text-end pb-2">{{ __('messages.invoice.price') }}</th>
                        <th class="text-end pb-2">{{ __('messages.invoice.amount') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoice->invoiceItems as $index => $invoiceItem)
                        <tr class="text-end">
                            <td class="pt-6 text-start">{{ $invoiceItem->account->name }}</td>
                            <td class="pt-6 text-start">{!! ($invoiceItem->description != '')?nl2br(e($invoiceItem->description)):'N/A' !!}</td>
                            <td class="pt-6">{{ $invoiceItem->quantity }}</td>
                            <td class="pt-6">
                                {{ checkNumberFormat($invoiceItem->price, strtoupper($invoiceItem->currency_symbol ?? getCurrentCurrency())) }}
                            </td>
                            <td class="pt-6 text-dark">
                                {{ checkNumberFormat($invoiceItem->total, strtoupper($invoiceItem->currency_symbol ?? getCurrentCurrency())) }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-5 ms-lg-auto mt-4">
                <div class="border-top">
                    <table class="table table-borderless {{ getLoggedInUser()->thememode ? '' : 'bg-white' }} box-shadow-none mb-0 mt-5">
                        <tbody class="{{ getLoggedInUser()->thememode ? '' : 'bg-white' }}">
                        <tr>
                            <td class="{{ getLoggedInUser()->thememode ? '' : 'bg-white' }} ps-0">{{ __('messages.invoice.sub_total').(':') }}</td>
                            <td class="{{ getLoggedInUser()->thememode ? '' : 'bg-white' }} text-gray-900 text-end pe-0">
                                {{ checkNumberFormat($invoice->amount, strtoupper($invoice->currency_symbol ?? getCurrentCurrency())) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="{{ getLoggedInUser()->thememode ? '' : 'bg-white' }} ps-0">{{ __('messages.invoice.discount').(':') }}</td>
                            <td class="{{ getLoggedInUser()->thememode ? '' : 'bg-white' }} text-gray-900 text-end pe-0">
                                {{ checkNumberFormat($invoice->amount * $invoice->discount / 100, strtoupper($invoice->currency_symbol ?? getCurrentCurrency())) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="{{ getLoggedInUser()->thememode ? '' : 'bg-white' }} ps-0">{{ __('messages.invoice.total').(':') }}</td>
                            <td class="{{ getLoggedInUser()->thememode ? '' : 'bg-white' }} text-gray-900 text-end pe-0">
                                {{ checkNumberFormat($invoice->amount - ($invoice->amount * $invoice->discount / 100), strtoupper($invoice->currency_symbol ?? getCurrentCurrency())) }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-4">
        <div class="bg-light-100 rounded-15 p-md-7 p-5 h-100 mt-xxl-0 mt-5 col-xxl-9 ms-xxl-auto">
            <div class="mb-8">
                @if($invoice->status == \App\Models\Invoice::PENDING)
                    <span class="badge bg-light-warning">Pending Payment</span>
                @elseif($invoice->status == \App\Models\Invoice::PAID)
                    <span class="badge bg-light-success me-2">Paid</span>
                @endif
            </div>
            <h6 class="mb-5">PATIENT OVERVIEW</h6>
            <div class="mb-6">
                <div class="pb-2 fs-5 text-gray-600 fs-7">{{ __('messages.death_report.patient_name') }}</div>
                <div class="fs-5 text-gray-900">
                    <a href="{{ route('patients.show', ['patient' => $invoice->patient->id]) }}"
                       class="link-primary fs-5 text-decoration-none">{{ $invoice->patient->patientUser->full_name }}</a>
                </div>
            </div>
            <div class="mb-6">
                <div class="pb-2 fs-5 text-gray-600 fs-7">{{ __('messages.bill.patient_email') }}</div>
                <div class="fs-5 text-gray-900">{{ $invoice->patient->patientUser->email }}</div>
            </div>
            <div class="mb-6">
                <div class="pb-2 fs-5 text-gray-600">{{ __('messages.bill.patient_gender') }}</div>
                <div class="fs-5 text-gray-900">{{ $invoice->patient->patientUser->gender == 1 ? __('messages.user.female'): __('messages.user.male') }}</div>
            </div>
        </div>
    </div>
</div>
