<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\admin;
use App\Models\User;
use App\Repositories\adminRepository;
use Laracasts\Flash\Flash;

class adminController extends AppBaseController
{
    /** @var adminRepository */
    private $adminRepository;

    public function __construct(adminRepository $adminRepo)
    {
        $this->adminRepository = $adminRepo;
    }

    /**
     * Display a listing of the admin.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admins.index');
    }

    /**
     * Show the form for creating a new admin.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $bloodGroup = getBloodGroups();

        return view('admins.create', compact('bloodGroup'));
    }

    /**
     * Store a newly created admin in storage.
     *
     * @param  CreateAdminRequest  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateAdminRequest $request)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;

        $this->adminRepository->store($input);

        Flash::success(__('messages.admin').' '.__('messages.common.saved_successfully'));

        return redirect(route('admins.index'));
    }

    /**
     * Display the specified admin.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function show($id)
    {
        $admin = $this->adminRepository->find($id);
//        $admin = admin::where('id', $id)->with('user')->first();

        if (empty($admin) && $admin->owner_type != \App\Models\admin::class) {
            return view('errors.404');
        } else {
            return view('admins.show')->with('admin', $admin);
        }
//        dd(empty($admin) && $admin->owner_type != 'App\Models\admin');
//        if ($admin->user->owner_type != 'App\Models\admin') {
//        if ($admin->owner_type != 'App\Models\admin') {
//            return view('errors.404');
//        } else {
//
//        }
    }

    /**
     * Show the form for editing the specified admin.
     *
     * @param  \App\Models\User  $admin
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(User $admin)
    {
        $bloodGroup = getBloodGroups();

        if (empty($admin) && $admin->owner_type != \App\Models\admin::class) {
            return view('errors.404');
        } else {
            return view('admins.edit', compact('admin', 'bloodGroup'));
        }
    }

    /**
     * Update the specified admin in storage.
     *
     * @param  \App\Models\User  $admin
     * @param  UpdateAdminRequest  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(User $admin, UpdateAdminRequest $request)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;

        $admin = $this->adminRepository->update($admin, $input);

        Flash::success(__('messages.admin').' '.__('messages.common.updated_successfully'));

        return redirect(route('admins.index'));
    }

    /**
     * Remove the specified admin from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Exception
     */
    public function destroy(User $admin): \Illuminate\Http\JsonResponse
    {
        if (empty($admin) && $admin->owner_type != \App\Models\admin::class) {
            return $this->sendError(__('messages.admin').' '.__('messages.common.not_found'));
        } else {
            $admin->delete();

            return $this->sendSuccess(__('messages.admin').' '.__('messages.common.deleted_successfully'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function activeDeactiveStatus($id): \Illuminate\Http\JsonResponse
    {
        $admin = User::findOrFail($id);

        if (empty($admin) && $admin->owner_type != \App\Models\admin::class) {
            return $this->sendError(__('messages.admin').' '.__('messages.common.not_found'));
        } else {
            $status = ! $admin->status;
            $admin->update(['status' => $status]);

            return $this->sendSuccess(__('messages.common.status_updated_successfully'));
        }
    }
}
