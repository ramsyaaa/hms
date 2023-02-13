<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDocumentTypeRequest;
use App\Http\Requests\UpdateDocumentTypeRequest;
use App\Models\Document;
use App\Models\DocumentType;
use App\Repositories\DocumentTypeRepository;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DocumentTypeController extends AppBaseController
{
    /** @var DocumentTypeRepository */
    private $documentTypeRepository;

    public function __construct(DocumentTypeRepository $documentTypeRepo)
    {
        $this->documentTypeRepository = $documentTypeRepo;
    }

    /**
     * Display a listing of the DocumentType.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        return view('document_types.index');
    }

    /**
     * Store a newly created DocumentType in storage.
     *
     * @param  CreateDocumentTypeRequest  $request
     * @return JsonResponse
     */
    public function store(CreateDocumentTypeRequest $request)
    {
        $input = $request->all();

        $this->documentTypeRepository->create($input);

        return $this->sendSuccess(__('messages.document.document_type').' '.__('messages.common.saved_successfully'));
    }

    /**
     * @param  DocumentType  $documentType
     * @return Factory|View
     */
    public function show(DocumentType $documentType)
    {
        $documents = $documentType->documents;
        if (! getLoggedInUser()->hasRole('Admin')) {
            $documents = Document::whereUploadedBy(getLoggedInUser()->id)->whereDocumentTypeId($documentType->id)->get();
        }

        return view('document_types.show', compact('documentType', 'documents'));
    }

    /**
     * Show the form for editing the specified DocumentType.
     *
     * @param  DocumentType  $documentType
     * @return JsonResponse
     */
    public function edit(DocumentType $documentType)
    {
        return $this->sendResponse($documentType, 'Document Type retrieved successfully.');
    }

    /**
     * Update the specified DocumentType in storage.
     *
     * @param  DocumentType  $documentType
     * @param  UpdateDocumentTypeRequest  $request
     * @return JsonResponse
     */
    public function update(DocumentType $documentType, UpdateDocumentTypeRequest $request)
    {
        $this->documentTypeRepository->update($request->all(), $documentType->id);

        return $this->sendSuccess(__('messages.document.document_type').' '.__('messages.common.updated_successfully'));
    }

    /**
     * Remove the specified DocumentType from storage.
     *
     * @param  DocumentType  $documentType
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(DocumentType $documentType)
    {
        $documentTypeModel = [
            Document::class,
        ];
        $result = canDelete($documentTypeModel, 'document_type_id', $documentType->id);
        if ($result) {
            return $this->sendError(__('messages.document.document_type').' '.__('messages.common.cant_be_deleted'));
        }
        $this->documentTypeRepository->delete($documentType->id);

        return $this->sendSuccess(__('messages.document.document_type').' '.__('messages.common.deleted_successfully'));
    }
}
