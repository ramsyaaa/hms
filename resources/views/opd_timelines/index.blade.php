<div class="card mb-5 mb-xl-10 p-9">
    <div class="card-title">
        @if(Auth::user()->hasRole('Admin'))
            <a href="javascript:void(0)" class="btn btn-primary float-end" data-bs-toggle="modal"
               data-bs-target="#addOpdTimelineModal">
                {{ __('messages.ipd_patient_timeline.new_ipd_timeline') }}
            </a>
        @endif
    </div>
    @if(Auth::user()->hasRole('Admin'))
        <div class="timeline-spacer"></div>
    @endif
    <div class="timeline-container">
        @forelse($opdTimelines as $opdTimeline)
            <div class="timeline-item row" date-is="{{ date('jS M, Y', strtotime($opdTimeline->date)) }}">
                <div class="col-md-9">
                    <h3>{{ $opdTimeline->title }}</h3>
                    <p>{!! !empty($opdTimeline->description) ? nl2br(e($opdTimeline->description)) : __('messages.common.n/a') !!}</p>
                </div>
                <div class="text-end bottom-sm mb-5 col-md-3">
                    @if($opdTimeline->opd_timeline_document_url != '')
                        <a data-turbo="false" title="download"
                           class="btn px-1 text-info fs-2"
                           href="{{ url('opd-timelines-download'.'/'.$opdTimeline->id) }}"
                           target="_blank">
                            <i class="fa fa-download action-icon"></i>
                        </a>
                    @endif
                    @if(Auth::user()->hasRole('Admin'))
                        <a title="<?php echo __('messages.common.edit') ?>" data-timeline-id="{{ $opdTimeline->id }}"
                           class="btn px-1 text-primary fs-2 edit-OpdTimeline-btn">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="javascript:void(0)" title="<?php echo __('messages.common.delete') ?>"
                           data-timeline-id="{{ $opdTimeline->id }}"
                           class="delete-OpdTimeline-btn btn px-1 text-danger fs-2">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    @endif
                </div>
            </div>
        @empty
            <div class="timeline-item timeline-spacer">
                <h3 class="my-0">{{ __('messages.ipd_patient_timeline.no_timeline_found') }}</h3>
            </div>
        @endforelse
    </div>
</div>
