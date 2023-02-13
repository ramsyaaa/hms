<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Patient;
use App\Models\PatientAdmission;
use App\Models\PatientCase;
use App\Repositories\DocumentRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DocumentAPIController extends AppBaseController
{
    /** @var DocumentRepository */
    private $documentRepository;

    public function __construct(DocumentRepository $documentRepo)
    {
        $this->documentRepository = $documentRepo;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        if (! getLoggedinPatient()) {
            $documents = Document::whereHas('patient.patientUser')->with('documentType', 'patient.patientUser',
                'media')->orderBy('id', 'desc')->get();
        } else {
            $patientId = Patient::where('user_id', getLoggedInUserId())->first();
            $documents = Document::whereHas('patient.patientUser')->with('documentType', 'patient.patientUser',
                'media')->orderBy('id', 'desc')->select('documents.*')->where('patient_id', $patientId->id)->get();
        }
        $data = [];
        foreach ($documents as $document) {
            $data[] = $document->prepareDocument();
        }

        return $this->sendResponse($data, 'Document Retrieved Successfully');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDocumentTypes(): \Illuminate\Http\JsonResponse
    {
        $document_type = DocumentType::select(['id', 'name'])->orderBy('id', 'desc')->get();

        return $this->sendResponse($document_type, 'Document Retrieved Successfully');
    }

    /**
     * @param  \App\Http\Requests\CreateDocumentRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();
        $request->validate([
            'title'            => 'required',
            'document_type_id' => 'required|gt:0',
        ]);
        $this->documentRepository->store($input);

        return $this->sendSuccess('Document created successfully');
    }

    /**
     * @param  \App\Http\Requests\UpdateDocumentRequest  $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();
        $request->validate([
            'title'            => 'required',
            'document_type_id' => 'required|gt:0',
        ]);
        if (getLoggedinPatient()) {
            $input['patient_id'] = getLoggedInUser()->owner_id;
            $documents = Document::where('id', $id)->where('patient_id', getLoggedInUser()->owner_id)->first();
            if (! $documents) {
                return $this->sendError('Document not found');
            }
            $this->documentRepository->updateDocument($input, $id);
        } else {
            $documents = Document::where('id', $id)->first();
            $this->documentRepository->updateDocument($input, $id);
        }
        if (! $documents) {
            return $this->sendError('Document not found');
        }

        return $this->sendSuccess('Document updated successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        if (getLoggedinPatient()) {
            $documents = Document::where('id', $id)->where('patient_id', getLoggedInUser()->owner_id)->first();
        } else {
            $documents = Document::where('id', $id)->first();
        }

        if (! $documents) {
            return $this->sendError('Document not found');
        }
        $this->documentRepository->deleteDocument($id);

        return $this->sendSuccess('Document deleted successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function downloadDocs($id): \Illuminate\Http\JsonResponse
    {
        $document = Document::where('id', $id)->first();
        if (! $document) {
            return $this->sendError('Document not found');
        }
        $documentMedia = $document->media[0];

        $url = $documentMedia->getUrl();

        return $this->sendResponse($url ?? '', 'Document download URL');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPatientList(): \Illuminate\Http\JsonResponse
    {
        $patientCase = PatientCase::with('patient.patientUser')->where('doctor_id', '=',
            getLoggedInUser()->owner_id)->where('status', '=', 1)->get()->pluck('patient.user_id', 'id');

        $patientAdmission = PatientAdmission::with('patient.patientUser')->where('doctor_id', '=',
            getLoggedInUser()->owner_id)->where('status', '=', 1)->get()->pluck('patient.user_id', 'id');

        $arrayMerge = array_merge($patientAdmission->toArray(), $patientCase->toArray());
        $patientIds = array_unique($arrayMerge);

        $patients = Patient::with('patientUser')->whereIn('user_id', $patientIds)
            ->whereHas('patientUser', function (Builder $query) {
                $query->where('status', 1);
            })->get();

        $data = [];
        foreach ($patients as $patient) {
            $data[] = $patient->prepareData();
        }

        return $this->sendResponse($data, 'Document Retrieved Successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id): \Illuminate\Http\JsonResponse
    {
        if (getLoggedinPatient()) {
            $document = Document::where('id', $id)->where('patient_id', getLoggedInUser()->owner_id)->first();
        } else {
            $document = Document::where('id', $id)->first();
        }

        if (! $document) {
            return $this->sendError('Document not found');
        }

        return $this->sendResponse($document->prepareDocument(), 'Document Retrieved Successfully.');
    }
}
