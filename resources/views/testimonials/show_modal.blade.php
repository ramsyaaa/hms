<div id="show_testimonials" class="modal fade side-fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{ __('messages.testimonial.testimonial_detail') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-12 mb-5">
                        <label for="userProfilePicture"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.profile.profile').(':') }}</label><br>
                        <div class="image image-circle image-small">
                            <img id="userProfilePicture" src="#" alt="image"
                                 class="fs-5 text-gray-800 showSpan object-fit-cover">
                        </div>
                    </div>
                    <div class="form-group col-12 mb-5">
                        <label for="name"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.user.name').(':') }}</label><br>
                        <span id="showTestimonialName" class="fs-5 text-gray-800 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-12 mb-5">
                        <label for="description"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.description').(':') }}</label><br>
                        <span id="showTestimonialDescription" class="fs-5 text-gray-800 text-gray-800 showSpan"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
