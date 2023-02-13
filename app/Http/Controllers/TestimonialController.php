<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestimonialRequest;
use App\Models\Testimonial;
use App\Repositories\TestimonialRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

/**
 * Class TestimonialController
 */
class TestimonialController extends AppBaseController
{
    /**
     * @var testimonialRepository
     */
    private $testimonialRepository;

    /**
     * TestimonialController constructor.
     *
     * @param  TestimonialRepository  $testimonialRepository
     */
    public function __construct(TestimonialRepository $testimonialRepository)
    {
        $this->testimonialRepository = $testimonialRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return Application|Factory|View|Response
     *
     * @throws Exception
     */
    public function index()
    {
        return view('testimonials.index');
    }

    /**
     * Store a newly created Testimonial in storage.
     *
     * @param  TestimonialRequest  $request
     * @return JsonResponse
     */
    public function store(TestimonialRequest $request)
    {
        try {
            $input = $request->all();
            $this->testimonialRepository->store($input);

            return $this->sendSuccess(__('messages.testimonials').' '.__('messages.common.saved_successfully'));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified Testimonial.
     *
     * @param  Testimonial  $testimonial
     * @return JsonResponse
     */
    public function edit(Testimonial $testimonial)
    {
        return $this->sendResponse($testimonial, 'Testimonial retrieved successfully.');
    }

    /**
     * @param  Testimonial  $testimonial
     * @param  TestimonialRequest  $request
     * @return JsonResponse
     */
    public function update(Testimonial $testimonial, TestimonialRequest $request)
    {
        try {
            $this->testimonialRepository->updateTestimonial($request->all(), $testimonial->id);

            return $this->sendSuccess(__('messages.testimonials').' '.__('messages.common.updated_successfully'));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * @param  Testimonial  $testimonial
     * @return JsonResponse
     */
    public function show(Testimonial $testimonial)
    {
        return $this->sendResponse($testimonial, 'Testimonial retrieved successfully.');
    }

    /**
     * Remove the specified Testimonial from storage.
     *
     * @param  Testimonial  $testimonial
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(Testimonial $testimonial)
    {
        try {
            $this->testimonialRepository->deleteTestimonial($testimonial);

            return $this->sendSuccess(__('messages.testimonials').' '.__('messages.common.deleted_successfully'));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
}
