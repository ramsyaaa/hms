<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="enquiryOverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('name', __('messages.enquiry.name').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800">{{ $enquiry->full_name}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('email', __('messages.enquiry.email').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800">{{$enquiry->email}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('contact', __('messages.enquiry.contact').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800">{{$enquiry->contact_no}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('type', __('messages.enquiry.type').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800">{{ $enquiry->enquiry_type}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('view_by', __('messages.enquiry.viewed_by').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800">{{ (isset($enquiry->viewed_by)) ? $enquiry->user->full_name : __('messages.enquiry.not_viewed')}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('status', __('messages.common.status').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <p class="m-0">
                                    <span class="badge fs-6 bg-light-{{!empty($enquiry->status) ? 'success' : 'danger'}}">{{($enquiry->status) ? __('messages.enquiry.read') : __('messages.enquiry.unread')}}</span>
                                </p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('created_at', __('messages.common.created_on').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800" title="{{ isset($enquiry->created_at)  ? date('jS M, Y', strtotime($enquiry->created_at)) : '' }}">{{ isset($enquiry->created_at)  ? $enquiry->created_at->diffForHumans() : 'N/A'}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('updated_at', __('messages.common.updated_at').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800" title="{{ date('jS M, Y', strtotime($enquiry->updated_at)) }}">{{ $enquiry->updated_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-12 d-flex flex-column">
                                {{ Form::label('message', __('messages.enquiry.message').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800">{!! nl2br(e($enquiry->message)) !!}</span>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
