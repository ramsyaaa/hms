@extends('layouts.app')
@section('title')
    {{ __('messages.dashboard.dashboard') }}
@endsection
@section('page_css')
    {{--        <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.css') }}">--}}
    {{--        <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">--}}
@endsection
@section('css')
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/detail-header.css') }}">--}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="row">
                        @if($modules['Invoices'] == true)
                            {{-- Invoices Widget --}}
                            <div class="col-xxl-3 col-xl-4 col-sm-6 widget">
                                <a class="text-decoration-none" href="{{ route('invoices.index') }}">
                                    <div class="bg-primary shadow-md rounded-10 p-xxl-10 px-5 py-10 d-flex align-items-center justify-content-between my-sm-3 my-2">
                                        <div class="bg-cyan-300 widget-icon rounded-10 me-2 d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-money-check fs-1-xl text-white"></i>
                                        </div>
                                        <div class="text-end text-white">
                                            <h2 class="fs-1-xxl fw-bolder text-white">{{getCurrencySymbol()}} {{ formatCurrency($data['invoiceAmount']) }}</h2>
                                            <h3 class="mb-0 fs-5 fw-light">{{ __('messages.dashboard.total_invoices') }}</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        @if($modules['Bills'])
                            {{-- Bills Widget --}}
                            <div class="col-xxl-3 col-xl-4 col-sm-6 widget">
                                <a href="{{ route('bills.index') }}" class="text-decoration-none">
                                    <div class="bg-success shadow-md rounded-10 p-xxl-10 px-5 py-10 d-flex align-items-center justify-content-between my-sm-3 my-2">
                                        <div class="bg-green-300 widget-icon rounded-10 me-2  d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-money-bill fs-1-xl text-white"></i>
                                        </div>
                                        <div class="text-end text-white">
                                            <h2 class="fs-1-xxl fw-bolder text-white">{{getCurrencySymbol()}} {{ formatCurrency($data['billAmount']) }}</h2>
                                            <h3 class="mb-0 fs-5 fw-light">{{ __('messages.dashboard.total_bills') }}</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        @if($modules['Payments'] == true)
                            {{-- Payments Widget --}}
                            <div class="col-xxl-3 col-xl-4 col-sm-6 widget">
                                <a href="{{ route('payments.index') }}" class="text-decoration-none">
                                    <div class="bg-info shadow-md rounded-10 p-xxl-10 px-5 py-10 d-flex align-items-center justify-content-between my-sm-3 my-2">
                                        <div class="bg-blue-300 widget-icon rounded-10 me-2 d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-money-bill fs-1-xl text-white"></i>
                                        </div>
                                        <div class="text-end text-white">
                                            <h2 class="fs-1-xxl fw-bolder text-white">{{getCurrencySymbol()}} {{ formatCurrency($data['paymentAmount']) }}</h2>
                                            <h3 class="mb-0 fs-5 fw-light">{{ __('messages.dashboard.total_payments') }}</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        @if($modules['Advance Payments'] == true)
                            {{-- Advance Payments Widget --}}
                            <div class="col-xxl-3 col-xl-4 col-sm-6 widget">
                                <a href="{{ route('advanced-payments.index') }}" class="text-decoration-none">
                                    <div class="bg-warning shadow-md rounded-10 p-xxl-10 px-5 py-10 d-flex align-items-center justify-content-between my-sm-3 my-2">
                                        <div class="bg-yellow-300 widget-icon rounded-10 me-2 d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-money-bill fs-1-xl text-white"></i>
                                        </div>
                                        <div class="text-end text-white">
                                            <h2 class="fs-1-xxl fw-bolder text-white">{{getCurrencySymbol()}} {{ formatCurrency($data['advancePaymentAmount']) }}</h2>
                                            <h3 class="mb-0 fs-5 fw-light">{{ __('messages.dashboard.total_advance_payments') }}</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        @if($modules['Doctors'] == true)
                            {{-- Doctors Widget --}}
                            <div class="col-xxl-3 col-xl-4 col-sm-6 widget">
                                <a href="{{ route('doctors.index') }}" class="text-decoration-none">
                                    <div class="bg-secondary shadow-md rounded-10 p-xxl-10 px-5 py-10 d-flex align-items-center justify-content-between my-sm-3 my-2">
                                        <div class="bg-gray-600 widget-icon rounded-10 me-2 d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-user fs-1-xl text-white"></i>
                                        </div>
                                        <div class="text-end text-white">
                                            <h2 class="fs-1-xxl fw-bolder text-white">{{ $data['doctors'] }}</h2>
                                            <h3 class="mb-0 fs-5 fw-light">{{ __('messages.dashboard.doctors') }}</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        @if($modules['Patients'] == true)
                            {{-- Patients Widget --}}
                            <div class="col-xxl-3 col-xl-4 col-sm-6 widget">
                                <a href="{{ route('patients.index') }}" class="text-decoration-none">
                                    <div class="bg-danger shadow-md rounded-10 p-xxl-10 px-5 py-10 d-flex align-items-center justify-content-between my-sm-3 my-2">
                                        <div class="bg-red-300 widget-icon rounded-10 me-2 d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-user fs-1-xl text-white"></i>
                                        </div>
                                        <div class="text-end text-white">
                                            <h2 class="fs-1-xxl fw-bolder text-white">{{ $data['patients'] }}</h2>
                                            <h3 class="mb-0 fs-5 fw-light">{{ __('messages.dashboard.patients') }}</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        @if($modules['Nurses'] == true)
                            {{-- Nurses Widget --}}
                            <div class="col-xxl-3 col-xl-4 col-sm-6 widget">
                                <a href="{{ route('nurses.index') }}" class="text-decoration-none">
                                    <div class="bg-secondary shadow-md rounded-10 p-xxl-10 px-5 py-10 d-flex align-items-center justify-content-between my-sm-3 my-2">
                                        <div class="bg-gray-700 widget-icon rounded-10 me-2  d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-user-nurse fs-1-xl text-white"></i>
                                        </div>
                                        <div class="text-end text-white">
                                            <h2 class="fs-1-xxl fw-bolder text-white">{{ $data['nurses'] }}</h2>
                                            <h3 class="mb-0 fs-5 fw-light">{{ __('messages.nurses') }}</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        @if($modules['Beds'] == true)
                            {{-- Avaiable Beds Widget --}}
                            <div class="col-xxl-3 col-xl-4 col-sm-6 widget">
                                <a href="{{ route('beds.index') }}" class="text-decoration-none">
                                    <div class="bg-primary shadow-md rounded-10 p-xxl-10 me-2  px-5 py-10 d-flex align-items-center justify-content-between my-sm-3 my-2">
                                        <div class="bg-cyan-700 widget-icon rounded-10 d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-bed fs-1-xl text-white"></i>
                                        </div>
                                        <div class="text-end text-white">
                                            <h2 class="fs-1-xxl fw-bolder text-white">{{ $data['availableBeds'] }}</h2>
                                            <h3 class="mb-0 fs-5 fw-light">{{ __('messages.dashboard.available_beds') }}</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-xxl-7 col-12 mb-7 mb-xxl-0">
                    <div class="card">
                        <div class="card-header pb-0 px-10">
                            <h3 class="mb-0">
                                {{ __('messages.enquiries') }}
                            </h3>
                        </div>
                        <div class="card-body pt-7">
                            @if(count($data['enquiries']) > 0)
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ __('messages.enquiry.name') }}</th>
                                        <th scope="col">{{ __('messages.enquiry.email') }}</th>
                                        <th scope="col" class="text-center text-muted">{{ __('messages.common.created_on') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-gray-600 fw-bold">
                                    @foreach($data['enquiries'] as $enquiry)
                                        <tr>
                                            <td>
                                                <a href="{{ route('enquiry.show' , $enquiry->id) }}"
                                                   class="text-primary-800 text-decoration-none mb-1 fs-6">{{ $enquiry->full_name }}</a>
                                            </td>
                                            <td class="text-start">
                                                            <span
                                                                    class="text-muted fw-bold d-block">{{ $enquiry->email }}</span>
                                            </td>
                                            <td class="text-center text-muted fw-bold">
                                                            <span class="badge bg-light-info">
                                                            {{ \Carbon\Carbon::parse($enquiry->created_at)->translatedFormat('jS M, Y') }}
                                                            </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h4 class="mb-0 text-center fs-2">{{ __('messages.dashboard.no_enquiries_yet') }}</h4>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xxl-5 col-12">
                    <div class="card">
                        <div class="card-header pb-0 px-10">
                            <h3 class="mb-0">
                                {{ __('messages.dashboard.notice_boards') }}
                            </h3>
                        </div>
                        <div class="card-body pt-7 pb-2">
                            @if(count($data['noticeBoards']) > 0)
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ __('messages.dashboard.title') }}</th>
                                        <th scope="col" class="text-center">{{ __('messages.common.created_on') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-gray-600 fw-bold">
                                    @foreach($data['noticeBoards'] as $noticeBoard)
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0)" data-id="{{$noticeBoard->id}}"
                                                   class="text-decoration-none notice-board-view-btn">{{ Str::limit($noticeBoard->title, 32,'...') }}</a>
                                            </td>
                                            <td class="text-center">
                                                        <span class="badge bg-light-info">
                                                            {{ \Carbon\Carbon::parse($noticeBoard->created_at)->translatedFormat('jS M, Y') }}
                                                        </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h2 class="mb-0 text-center fs-2">No Notice Boards yet..</h2>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- Income & Expense Chart--}}
            {{--            <div class="row">--}}
            {{--                <div class="col-lg-12">--}}
            {{--                    <div class="card">--}}
            {{--                        <div class="card-body">--}}
            {{--                            <div class="row justify-content-between">--}}
            {{--                                <div class="col-sm-6 col-md-6 col-lg-6 pt-2">--}}
            {{--                                    <h5>{{ __('messages.dashboard.income_and_expense_report') }}</h5>--}}
            {{--                                </div>--}}
            {{--                                <div class="col-md-3">--}}
            {{--                                    <div id="time_range" class="time_range d-flex">--}}
            {{--                                        <i class="far fa-calendar-alt"--}}
            {{--                                           aria-hidden="true"></i>&nbsp;&nbsp;<span></span>--}}
            {{--                                        <b class="caret"></b>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="table-responsive-sm">--}}
            {{--                                <div class="pt-2">--}}
            {{--                                    <canvas id="daily-work-report" class="mh-400px"></canvas>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}

            {{Form::hidden('incomeExpenseReportUrl',route('income-expense-report'),['id'=>'dashboardIncomeExpenseReportUrl','class'=>'incomeExpenseReportUrl'])}}
            {{Form::hidden('currentCurrencyName',getCurrencySymbol(),['id'=>'dashboardCurrentCurrencyName','class'=>'currentCurrencyName'])}}
            {{--                        {{Form::hidden('currencies',json_encode($data['currency']),['id'=>'createBillDate','class'=>'currencies'])}}--}}
            {{Form::hidden('income_and_expense_reports',__('messages.dashboard.income_and_expense_reports'),['id'=>'dashboardIncome_and_expense_reports','class'=>'income_and_expense_reports'])}}
            {{Form::hidden('defaultAvatarImageUrl',asset('assets/img/avatar.png'),['id'=>'dashboardDefaultAvatarImageUrl','class'=>'defaultAvatarImageUrl'])}}
            {{Form::hidden('noticeBoardUrl',url('notice-boards'),['id'=>'dashboardNoticeBoardUrl','class'=>'noticeBoardUrl'])}}

        </div>
        @include('employees.notice_boards.show_modal')
    </div>
@endsection
{{--    <script src="{{mix('assets/js/dashboard/dashboard.js')}}"></script>--}}
{{--    <script src="{{mix('assets/js/custom/input_price_format.js')}}"></script>--}}
