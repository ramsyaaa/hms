<?php

namespace App\Http\Controllers;

use App\Exports\PackageExport;
use App\Http\Requests\CreatePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Models\Package;
use App\Models\PatientAdmission;
use App\Repositories\PackageRepository;
use DB;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PackageController extends AppBaseController
{
    /** @var PackageRepository */
    private $packageRepository;

    public function __construct(PackageRepository $packageRepo)
    {
        $this->packageRepository = $packageRepo;
    }

    /**
     * Display a listing of the Package.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        return view('packages.index');
    }

    /**
     * Show the form for creating a new Package.
     *
     * @return Factory|View
     */
    public function create()
    {
        $servicesList = $this->packageRepository->getServicesList();
        $services = $this->packageRepository->getServices();

        return view('packages.create', compact('services', 'servicesList'));
    }

    /**
     * Store a newly created Package in storage.
     *
     * @param  CreatePackageRequest  $request
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function store(CreatePackageRequest $request)
    {
        try {
            DB::beginTransaction();
            $package = $this->packageRepository->store($request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($package, __('messages.package.package').' '.__('messages.common.saved_successfully'));
    }

    /**
     * @param  Package  $package
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function show(Package $package)
    {
        $package = Package::with(['packageServicesItems.service'])->find($package->id);

        return view('packages.show')->with('package', $package);
    }

    /**
     * Show the form for editing the specified Package.
     *
     * @param  Package  $package
     * @return Factory|View
     */
    public function edit(Package $package)
    {
        $package->packageServicesItems;
        $servicesList = $this->packageRepository->getServicesList();
        $services = $this->packageRepository->getServices();

        return view('packages.edit', compact('services', 'package', 'servicesList'));
    }

    /**
     * @param  Package  $package
     * @param  UpdatePackageRequest  $request
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function update(Package $package, UpdatePackageRequest $request)
    {
        try {
            DB::beginTransaction();
            $package = $this->packageRepository->updatePackage($package->id, $request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($package, __('messages.package.package').' '.__('messages.common.updated_successfully'));
    }

    /**
     * Remove the specified Package from storage.
     *
     * @param  Package  $package
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(Package $package)
    {
        $packageModel = [
            PatientAdmission::class,
        ];
        $result = canDelete($packageModel, 'package_id', $package->id);
        if ($result) {
            return $this->sendError(__('messages.package.package').' '.__('messages.common.cant_be_deleted'));
        }
        $this->packageRepository->delete($package->id);

        return $this->sendSuccess(__('messages.package.package').' '.__('messages.common.deleted_successfully'));
    }

    /**
     * @return BinaryFileResponse
     */
    public function packageExport()
    {
        return Excel::download(new PackageExport, 'packages-'.time().'.xlsx');
    }
}
