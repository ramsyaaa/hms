@extends('web.layouts.front')
@section('title')
    Beds Availability
@endsection
@section('content')
    <div class="services-page">
        <!-- start hero section -->
        <section class="hero-section position-relative p-t-60 border-bottom-right-rounded border-bottom-left-rounded bg-gray overflow-hidden">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 text-lg-start text-center">
                        <div class="hero-content">
                            <h1 class="mb-3 pb-1">
                               Beds Availability
                            </h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-lg-start justify-content-center mb-lg-0 mb-5">
                                    <li class="breadcrumb-item">
                                        <a href="{{ url('/') }}">
                                            {{ __('messages.web_home.home') }}
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Beds Availability
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-6 text-lg-end text-center">
                        <img src="{{ asset('web_front/images/page-banner/Services.png') }}" alt="Infy Care" class="img-fluid" />
                    </div>
                </div>
            </div>
        </section>
        <!-- end hero section -->

        <!-- start service-section -->
        <section class="service-section p-t-120 p-b-120">
            <div class="container">
                <div class="col-lg-6 text-center mx-auto">
                    <h6 class="text-primary mb-3">Beds Availability</h6>
                    <h2 class="mb-4 pb-xl-4">
                        Our Bed List Availability
                    </h2>
                </div>
                <div class="our-service">
                    <div class="row justify-content-center">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    {{-- <th scope="col">No.</th> --}}
                                    <th scope="col">Bed Type</th>
                                    <th scope="col">Bed Name</th>
                                    <th scope="col">Is Available</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $currentType = null;
                                    $rowSpan = 1;
                                @endphp
                                @foreach ($beds as $bed)
                                @if ($bed->bedType->title != $currentType)
                                    @if (!is_null($currentType))
                                    </td></tr>
                                    @endif
                                    <tr>
                                    <td rowspan="{{ $bed->bedType->beds->count() }}">{{ $bed->bedType->title }}</td>
                                    <td>{{ $bed->name }}</td>
                                    @if($bed->is_available == 1)
                                        <td style="background-color: green; color: white;">Yes</td>
                                    @else
                                        <td style="background-color: red; color: white;">No</td>
                                    @endif
                                    </tr>
                                    @php
                                    $currentType = $bed->bedType->title;
                                    @endphp
                                @else
                                    <tr>
                                        <td>{{ $bed->name }}</td>
                                        @if($bed->is_available == 1)
                                            <td style="background-color: green; color: white;">Yes</td>
                                        @else
                                            <td style="background-color: red; color: white;">No</td>
                                        @endif
                                    </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- end service-section -->
    </div>
@endsection
