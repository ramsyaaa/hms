<div id="showUser" class="modal fade side-fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.user.user_details') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-6 mb-5">
                        <label for="userProfilePicture"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.profile.profile').(':') }}</label><br>
                        <div class="image image-circle image-small me-3">
                            <img id="showUserProfilePicture" src="#" alt="image"
                                 class="fs-5 text-gray-800 showSpan object-fit-cover">
                        </div>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="first_name"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.user.first_name').(':') }}</label><br>
                        <span id="showUserFirst_name"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="last_name"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.user.last_name').(':') }}</label><br>
                        <span id="showUserLast_name"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="userEmail"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.user.email').(':') }}</label><br>
                        <span id="showUserEmail"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="role"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.sms.role').(':') }}</label><br>
                        <span id="showUserRole"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="userPhone"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.user.phone').(':') }}</label><br>
                        <span id="showUserPhone"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="userGender"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.user.gender').(':') }}</label><br>
                        <span id="showUserGender"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="userDob"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.user.dob').(':') }}</label><br>
                        <span id="showUserDob"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="showUserStatus"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.user.status').(':') }}</label><br>
                        <span id="showUserStatus"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="created_on"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.created_on').(':') }}</label><br>
                        <span id="showUserCreated_on"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="updated_on"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.last_updated').(':') }}</label><br>
                        <span id="showUserUpdated_on"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
