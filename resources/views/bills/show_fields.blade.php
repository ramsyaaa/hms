<div class="d-flex align-items-center pb-10">
    <img alt="Logo" src="{{ getLogoUrl() }}" height="100px" width="100px">
    <a target="_blank" href="{{ route('bills.pdf',['bill' => $bill->id]) }}" class="btn btn-success ms-auto text-white">{{ __('messages.bill.print_bill') }}</a>
</div>
<div class="m-0">
    <div class="fs-3 text-gray-800 mb-8">Bill #{{ $bill->bill_id }}</div>
    <div class="row g-5 mb-11">
        <div class="col-sm-3">
            <div class="pb-2 fs-5 text-gray-600">{{ __('messages.case.patient').':' }}</div>
            <div class="fs-5 text-gray-800">{{ $bill->patient->patientUser->full_name }}</div>
        </div>
        <div class="col-sm-3">
            <div class="pb-2 fs-5 text-gray-600">{{ __('messages.bill.bill_date').':' }}</div>
            <div class="fs-5 text-gray-800">{{ \Carbon\Carbon::parse($bill->bill_date)->translatedFormat('jS M, Y') }}</div>
        </div>
        <div class="col-sm-3">
            <div class="pb-2 fs-5 text-gray-600">{{ __('messages.bill.admission_id').':' }}</div>
            <div class="fs-5 text-gray-800">{{ $bill->patientAdmission ? $bill->patient_admission_id : __('messages.common.n/a') }}</div>
        </div>
        <div class="col-sm-3">
            <div class="pb-2 fs-5 text-gray-600">{{ __('messages.bill.patient_email').':' }}</div>
            <div class="fs-5 text-gray-800">{{ $bill->patient->patientUser->email }}</div>
        </div>
    </div>
    <div class="row g-5 mb-11">
        <div class="col-sm-3">
            <div class="pb-2 fs-5 text-gray-600">{{ __('messages.bill.patient_cell_no').':' }}</div>
            <div class="fs-5 text-gray-800">{{ !empty($bill->patient->patientUser->phone) ? $bill->patient->patientUser->phone : __('messages.common.n/a') }}</div>
        </div>
        <div class="col-sm-3">
            <div class="pb-2 fs-5 text-gray-600">{{ __('messages.bill.patient_gender').':' }}</div>
            <div class="fs-5 text-gray-800">{{ (!$bill->patient->patientUser->gender) ? __('messages.user.male') : __('messages.user.female') }}</div>
        </div>
        <div class="col-sm-3">
            <div class="pb-2 fs-5 text-gray-600">{{ __('messages.bill.patient_dob').':' }}</div>
            <div class="fs-5 text-gray-800">{{ (!empty($bill->patient->patientUser->dob)) ? \Carbon\Carbon::parse($bill->patient->patientUser->dob)->translatedFormat('jS M, Y') : __('messages.common.n/a') }}</div>
        </div>
        <div class="col-sm-3">
            <div class="pb-2 fs-5 text-gray-600">{{ __('messages.case.doctor').':' }}</div>
            <div class="fs-5 text-gray-800">{{ $bill->patientAdmission ? $bill->patientAdmission->doctor->doctorUser->full_name : __('messages.common.n/a') }}</div>
        </div>
    </div>
    <div class="row g-5 mb-11">
        <div class="col-sm-3">
            <div class="pb-2 fs-5 text-gray-600">{{ __('messages.bill.admission_date').':' }}</div>
            <div class="fs-5 text-gray-800">{{ $bill->patientAdmission ? \Carbon\Carbon::parse($bill->patientAdmission->admission_date)->translatedFormat('jS M, Y') : __('messages.common.n/a') }}</div>
        </div>
        <div class="col-sm-3">
            <div class="pb-2 fs-5 text-gray-600">{{ __('messages.bill.discharge_date').':' }}</div>
            <div class="fs-5 text-gray-800">{{ !empty($bill->patientAdmission->discharge_date)?\Carbon\Carbon::parse($bill->patientAdmission->discharge_date)->translatedFormat('jS M, Y'):'N/A' }}</div>
        </div>
        <div class="col-sm-3">
            <div class="pb-2 fs-5 text-gray-600">{{ __('messages.bill.package_name').':' }}</div>
            <div class="fs-5 text-gray-800">{{ !empty($bill->patientAdmission->package->name)?$bill->patientAdmission->package->name:'N/A' }}</div>
        </div>
        <div class="col-sm-3">
            <div class="pb-2 fs-5 text-gray-600">{{ __('messages.bill.insurance_name').':' }}</div>
            <div class="fs-5 text-gray-800">{{ !empty($bill->patientAdmission->insurance->name)?$bill->patientAdmission->insurance->name:'N/A' }}</div>
        </div>
    </div>
    <div class="row g-5 mb-11">
        <div class="col-sm-3">
            <div class="pb-2 fs-5 text-gray-600">{{ __('messages.bill.total_days').':' }}</div>
            <div class="fs-5 text-gray-800">{{ $bill->totalDays }}</div>
        </div>
        <div class="col-sm-3">
            <div class="pb-2 fs-5 text-gray-600">{{ __('messages.bill.policy_no').':' }}</div>
            <div class="fs-5 text-gray-800">{{ !empty($bill->patientAdmission->policy_no) ? $bill->patientAdmission->policy_no : __('messages.common.n/a') }}</div>
        </div>
        <div class="col-sm-3">
            <div class="pb-2 fs-5 text-gray-600">{{ __('messages.common.created_on').':' }}</div>
            <div class="fs-5 text-gray-800">{{ $bill->created_at->diffForHumans() }}</div>
        </div>
        <div class="col-sm-3">
            <div class="pb-2 fs-5 text-gray-600">{{ __('messages.common.last_updated').':' }}</div>
            <div class="fs-5 text-gray-800">{{ $bill->created_at->diffForHumans() }}</div>
        </div>
    </div>
    <div class="flex-grow-1">
            <table class="table border-bottom-2">
                <thead>
                <tr class="border-bottom fs-6 fw-bolder text-muted">
                    <th class="min-w-175px pb-2">{{ __('messages.bill.item_name') }}</th>
                    <th class="min-w-70px text-end pb-2">{{ __('messages.bill.qty') }}</th>
                    <th class="min-w-70px text-end pb-2">{{ __('messages.bill.price') }}</th>
                    <th class="min-w-80px text-end pb-2">{{ __('messages.bill.amount') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bill->billItems as $index => $billItem)
                    <tr class="text-gray-700 fs-5 text-end">
                        <td class="d-flex align-items-center pt-6">{{ $billItem->item_name }}</td>
                        <td class="pt-6">{{ $billItem->qty }}</td>
                        <td class="pt-6">
                            {{ checkNumberFormat($billItem->price, strtoupper($bill->currency_symbol ?? getCurrentCurrency())) }}
                        </td>
                        <td class="pt-6">
                            {{ checkNumberFormat($billItem->amount, strtoupper($bill->currency_symbol ?? getCurrentCurrency())) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
    </div>
    <div class="d-flex justify-content-end">
        <div class="mw-300px">
            <div class="d-flex flex-stack">
                <div class="fw-bold pe-10 text-gray-600 fs-7">{{ __('messages.bill.total_amount').(':') }}</div>
                <div class="text-end fs-5 text-gray-800">
{{--                    {{ checkValidCurrency($bill->currency_symbol ?? getCurrentCurrency()) ? moneyFormat($bill->amount, strtoupper($bill->currency_symbol ?? getCurrentCurrency())) : number_format($bill->amount).''.($bill->currency_symbol ?? getCurrencySymbol()) }}--}}
                    {{ checkNumberFormat($bill->amount, strtoupper($bill->currency_symbol ?? getCurrentCurrency())) }}
                </div>
            </div>
        </div>
    </div>
</div>
