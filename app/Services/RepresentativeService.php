<?php

namespace App\Services;

use App\Enums\HttpStatusCode;
use App\Helpers\Notificationhelpers;
use App\Http\Requests\Representative\ContactInformationRequest;
use App\Models\CandidateImage;
use App\Models\Occupation;
use App\Models\RepresentativeInformation;
use App\Models\TicketSubmission;
use App\Models\User;
use App\Repositories\CandidateRepository;
use App\Repositories\CountryRepository;
use App\Repositories\RepresentativeInformationRepository as RepresentativeRepository;
use App\Traits\CrudTrait;
use App\Transformers\RepresentativeTransformer;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as FResponse;

class RepresentativeService extends ApiBaseService
{
    use CrudTrait;

    const DOCUMENT_TYPE = [
        '0' => 'Driving license',
        '1' => 'Passport',
        '2' => 'National id card',
        '3' => 'Residence permit',
    ];

    const INFORMATION_FETCHED_SUCCESSFULLY = 'Information fetched Successfully!';

    const INFORMATION_UPDATED_SUCCESSFULLY = 'Information updated Successfully!';

    const IMAGE_DELETED_SUCCESSFULLY = 'Image Deleted successfully!';

    protected RepresentativeRepository $representativeRepository;

    protected \App\Repositories\CountryRepository $countryRepository;

    private \App\Transformers\RepresentativeTransformer $representativeTransformer;

    private \App\Repositories\CandidateRepository $candidateRepository;

    public function __construct(
        CandidateRepository $candidateRepository,
        RepresentativeRepository $representativeRepository,
        CountryRepository $countryRepository,
        RepresentativeTransformer $representativeTransformer
    ) {
        $this->representativeRepository = $representativeRepository;
        $this->countryRepository = $countryRepository;
        $this->representativeTransformer = $representativeTransformer;
        $this->candidateRepository = $candidateRepository;
    }

    /**
     * @return JsonResponse
     */
    public function storeScreenName($request)
    {
        try {
            $userId = self::getUserId();
            $checkRepresentative = $this->representativeRepository->findOneByProperties([
                'user_id' => $userId,
            ]);
            if ($checkRepresentative) {
                return $this->sendErrorResponse('Representative Information Already Exists', [], FResponse::HTTP_CONFLICT);
            }
            $request['user_id'] = $userId;
            $representative = $this->representativeRepository->save($request);
            if ($representative) {
                $userInfo = User::find($userId);
                if ($userInfo) {
                    $userInfo->full_name = trim($request['first_name']).' '.trim($request['last_name']);
                    $userInfo->save();
                }

                return $this->sendSuccessResponse($representative->toArray(), 'Information save Successfully!', [], HttpStatusCode::CREATED->value);
            } else {
                return $this->sendErrorResponse('Something went wrong. try again later', [], FResponse::HTTP_BAD_REQUEST);
            }
        } catch (Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage());
        }

    }

    public function getRepresentativeProfileInfo($userId)
    {
        try {
            $representativeInformation = $this->representativeRepository->findOneByProperties([
                'user_id' => $userId,
            ]);

            if (! $representativeInformation) {
                throw (new ModelNotFoundException)->setModel(get_class($this->representativeRepository->getModel()), $userId);
            }
            $data = $this->representativeTransformer->profileInfo($representativeInformation);

            return $this->sendSuccessResponse($data, self::INFORMATION_FETCHED_SUCCESSFULLY);

        } catch (Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage());
        }

    }

    public function getRepresentativeInfo()
    {
        try {
            $userId = self::getUserId();
            $representativeInformation = $this->representativeRepository->findOneByProperties([
                'user_id' => $userId,
            ]);

            if (! $representativeInformation) {
                throw (new ModelNotFoundException)->setModel(get_class($this->representativeRepository->getModel()), $userId);
            }
            $data = $this->representativeTransformer->transform($representativeInformation);

            return $this->sendSuccessResponse($data, self::INFORMATION_FETCHED_SUCCESSFULLY);

        } catch (Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage());
        }

    }

    /**
     * @return JsonResponse
     */
    public function storeEssentialInformation(ContactInformationRequest $request)
    {
        try {
            $userId = self::getUserId();
            $representativeInformation = $this->representativeRepository->findOneByProperties([
                'user_id' => $userId,
            ]);
            if (! $representativeInformation) {
                return $this->sendErrorResponse('Representative information is Not fund', [], HttpStatusCode::NOT_FOUND->value);
            }
            $request['user_id'] = $userId;
            $representative = $representativeInformation->update($request->all());
            if ($representative) {
                return $this->sendSuccessResponse($representativeInformation->toArray(), 'Information save Successfully!', [], HttpStatusCode::CREATED->value);
            } else {
                return $this->sendErrorResponse('Something went wrong. try again later', [], FResponse::HTTP_BAD_REQUEST);
            }
        } catch (Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage());
        }

    }

    /**
     * @return JsonResponse
     */
    public function storeContactInformation($request)
    {
        try {
            $userId = self::getUserId();
            $representativeInfomation = $this->representativeRepository->findOneByProperties([
                'user_id' => $userId,
            ]);
            if (! $representativeInfomation) {
                return $this->sendErrorResponse('Representative information  Not fund', [], HttpStatusCode::NOT_FOUND->value);
            }
            $request['user_id'] = $userId;
            $request['per_gender'] = $representativeInfomation->per_gender && $representativeInfomation->data_input_status == 5 ? $representativeInfomation->per_gender : $request['per_gender'];
            $request['dob'] = $representativeInfomation->dob && $representativeInfomation->data_input_status == 5 ? $representativeInfomation->dob : $request['dob'];
            $representative = $representativeInfomation->update($request);
            if ($representative) {
                return $this->sendSuccessResponse($representativeInfomation->toArray(), 'Information save Successfully!', [], HttpStatusCode::CREATED->value);
            } else {
                return $this->sendErrorResponse('Something went wrong. try again later', [], FResponse::HTTP_BAD_REQUEST);
            }
        } catch (Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage());
        }

    }

    public function getRepresentativeInformation(): JsonResponse
    {
        $userId = self::getUserId();
        $representativeInformation = $this->representativeRepository->findOneByProperties(['user_id' => $userId]);

        if (! $representativeInformation) {
            throw (new ModelNotFoundException)->setModel(get_class($this->representativeRepository->getModel()), [$userId]);
        }
        $data = $this->representativeTransformer->transform($representativeInformation);
        $data['countries'] = $this->countryRepository->findAll()->where('status', '=', 1);
        $data['occupations'] = Occupation::all();

        return $this->sendSuccessResponse($data, self::INFORMATION_FETCHED_SUCCESSFULLY);

    }

    /**
     * @return JsonResponse
     */
    public function storeVerifyIdentity($request)
    {

        $requestData = $request->all();
        if (! empty($request['ver_document_frontside'])) {
            $image = $this->uploadImageThrowGuzzle('ver_document_frontside', $request->file('ver_document_frontside'));
            $requestData['ver_document_frontside'] = $image->ver_document_frontside;
        }
        if (! empty($request['ver_document_backside'])) {
            $image = $this->uploadImageThrowGuzzle('ver_document_backside', $request->file('ver_document_backside'));
            $requestData['ver_document_backside'] = $image->ver_document_backside;
        }

        Log::info($requestData);

        try {
            $userId = self::getUserId();
            $representativeInformation = RepresentativeInformation::where('user_id', $userId)->first();

            if (! $representativeInformation) {
                return $this->sendErrorResponse('Representative information is Not fund', [], HttpStatusCode::NOT_FOUND->value);
            }

            Log::info('message');

            $representative = $representativeInformation->update($requestData);

            $data = $this->representativeTransformer->transformVerificationInformation($representativeInformation);

            Log::info($data);
            if ($representative) {

                return $this->sendSuccessResponse($data, 'Information save Successfully!', [], HttpStatusCode::CREATED->value);
            } else {
                return $this->sendErrorResponse('Something went wrong. try again later', [], FResponse::HTTP_BAD_REQUEST);
            }
        } catch (Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage());
        }
    }

    /**
     * @return JsonResponse
     */
    public function imageUpload($request)
    {

        try {
            DB::beginTransaction();
            $representative = $request->only(RepresentativeInformation::IMAGE_UPLOAD_INFO);

            if (! empty($request->input('per_avatar_url'))) {
                // code...
                $representative['per_avatar_url'] = $request->input('per_avatar_url');

            }

            if (! empty($request->input('per_main_image_url'))) {
                // code...
                $representative['per_main_image_url'] = $request->input('per_main_image_url');

            }
            $userId = self::getUserId();
            $representativeInformation = $this->representativeRepository->findOneByProperties([
                'user_id' => $userId,
            ]);
            if (! $representativeInformation) {
                return $this->sendErrorResponse('Representative information is Not fund', [], HttpStatusCode::NOT_FOUND->value);
            }

            $representative = $representativeInformation->fill($representative)->toArray();

            if ($representativeInformation->isDirty(['per_avatar_url', 'per_main_image_url'])) {
                $representativeInformation->user->status = 2;
                $representativeInformation->user->save();
            }

            $representative = $representativeInformation->update($representative);
            $data = $this->representativeTransformer->transformGallery($representativeInformation);

            DB::commit();

            Notificationhelpers::add('Picture update successfully complete', 'single', null, $userId);
            if ($representative) {
                return $this->sendSuccessResponse($data, 'Information save Successfully!', [], HttpStatusCode::CREATED->value);
            } else {
                return $this->sendErrorResponse('Something went wrong. try again later', [], FResponse::HTTP_BAD_REQUEST);
            }
        } catch (Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage());
        }
    }

    public function removeImage(int $imageType)
    {
        $userId = self::getUserId();
        try {

            $uploaded = [];
            $representative = $this->representativeRepository->findOneByProperties([
                'user_id' => $userId,
            ]);

            if ($imageType == 0) {
                $representative->per_avatar_url = null;
                $this->deleteImageGuzzle('per_avatar_url');
                $representative->save();
                $uploaded[] = 0;
            }

            if ($imageType === 1) {
                $representative->per_main_image_url = null;
                $this->deleteImageGuzzle('per_main_image_url');
                $representative->save();
                $uploaded[] = 1;
            }

            if (count($uploaded)) {
                return $this->sendSuccessResponse([], self::IMAGE_DELETED_SUCCESSFULLY);
            }

            throw new \Error('provide image type');
        } catch (Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage());
        }
    }

    public function allTickets(Request $request, $id)
    {
        try {
            $ticket = TicketSubmission::where('user_id', $id)->with('processTicket')->get();

            return $this->sendSuccessResponse($ticket, 'Success');
        } catch (Exception $exception) {
            return $this->sendErrorResponse($exception, $exception->getMessage(), HttpStatusCode::INTERNAL_ERROR->value);
        }
    }

    /**
     * @param  Request  $request
     * @return array
     */
    private function uploadFile($request, $imageName = null)
    {
        $requestFile = $request[$imageName];
        $file = 'Representative-profile-'.self::getUserId();
        $image_type = $imageName;
        $disk = config('filesystems.default', 'local');
        $status = $requestFile->storeAs($file, $image_type.'-'.date('Ymd').'-'.$requestFile->getClientOriginalName(), $disk);

        return [
            CandidateImage::IMAGE_PATH => $status,
            CandidateImage::IMAGE_DISK => $disk,
        ];

    }

    /**
     * @return JsonResponse
     */
    public function finalSubmit($request)
    {
        try {
            $userId = self::getUserId();
            $representativeInfomation = $this->representativeRepository->findOneByProperties([
                'user_id' => $userId,
            ]);
            if (! $representativeInfomation) {
                return $this->sendErrorResponse('Representative information is Not fund', [], HttpStatusCode::NOT_FOUND->value);
            }
            $request['user_id'] = $userId;
            $representative = $representativeInfomation->update($request);
            if ($representative) {
                return $this->sendSuccessResponse($representativeInfomation->toArray(), 'Information save Successfully!', [], HttpStatusCode::CREATED->value);
            } else {
                return $this->sendErrorResponse('Something went wrong. try again later', [], FResponse::HTTP_BAD_REQUEST);
            }
        } catch (Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage());
        }
    }

    /**
     * This function is for update Representative info status ( DB field representative_information.data_input_status ) update
     */
    public function updateInfoStatus(Request $request): JsonResponse
    {

        $userId = self::getUserId();

        try {
            $representative = $this->representativeRepository->findOneByProperties([
                'user_id' => $userId,
            ]);

            if (! $representative) {
                throw (new ModelNotFoundException)->setModel(get_class($this->representativeRepository->getModel()), $userId);
            }

            DB::beginTransaction();
            $info['data_input_status'] = $request->data_input_status;
            $representative->update($info);

            $candidate_basic_info = $this->representativeTransformer->transformPersonalBasic($representative);
            DB::commit();

            return $this->sendSuccessResponse($candidate_basic_info, self::INFORMATION_UPDATED_SUCCESSFULLY);
        } catch (Exception $exception) {
            DB::rollBack();

            return $this->sendErrorResponse($exception->getMessage());
        }

    }

    /**
     * @return \App\Services\JsonResponse|\Illuminate\Http\Response
     */
    public function representativeStatus()
    {
        $userId = self::getUserId();

        try {
            $representative = $this->representativeRepository->findOneByProperties([
                'user_id' => $userId,
            ]);

            if (! $representative) {
                throw (new ModelNotFoundException)->setModel(get_class($this->representativeRepository->getModel()), $userId);
            }

            $activeTeam = $representative->active_team;

            if (! $activeTeam) {
                throw new Exception('Team not found, Please create team first');
            }
            $authUser = $activeTeam->candidateOfTeam();

            $candidates = $this->candidateRepository->getModel();

            /* FILTER -  by representative block list  */
            $userInfo['blockList'] = $representative->blockList->pluck('user_id')->toArray();

            /* FILTER - Own along with team member and block list candidate  */
            $activeTeamUserIds = $activeTeam->team_members->pluck('user_id')->toArray();

            /* FILTER - Remove Team users already in connected list (pending, connected or rejected)  */
            $connectFromMembersId = $activeTeam->sentRequestMembers->pluck('user_id')->toArray();
            $connectToMembersId = $activeTeam->receivedRequestMembers->pluck('user_id')->toArray();

            /* FILTER - Gender  */
            $gender = $authUser->gender == 1 ? 2 : 1;

            /* FILTER - Age  */
            $dateRange['max'] = Carbon::now()->subYears($authUser->max_age);
            $dateRange['min'] = Carbon::now()->subYears($authUser->mim_age);

            /* FILTER - Height  */
            $heightRange['min'] = $authUser->min_height;
            $heightRange['max'] = $authUser->max_height;

            /* FILTER - Ethnicity  */
            $ethnicity = $authUser->ethnicity;

            $exceptIds = array_unique(array_merge($userInfo['blockList'], $activeTeamUserIds, $connectFromMembersId, $connectToMembersId));
            $filter = $candidates->with('user')
                ->where('data_input_status', '>', 2)
                ->whereNotIn('user_id', $exceptIds)
                ->whereNotIn('per_current_residence_country', $authUser->bloked_countries->pluck('id')->toArray())
                ->where('per_gender', $gender)
                ->whereBetween('dob', [$dateRange])
                ->whereBetween('per_height', [$heightRange])
                ->where('per_ethnicity', $ethnicity);

            $result['suggestion'] = $filter->count();
            $result['newSuggestion'] = $filter->whereHas('user', function ($q) {
                $q->where('created_at', '>', Carbon::now()->subDays(3)); // User Register within 3 days
            })->count();

            $result['teamListed'] = $activeTeam->teamListedUser->count();
            $result['shortListed'] = $authUser->shortList->count();
            $connectFromCount = $activeTeam->sentRequest->count();
            $connectToCount = $activeTeam->receivedRequest->count();
            $result['connected'] = $connectFromCount + $connectToCount;
            $result['requestReceive'] = $connectFromCount;
            $result['requestSend'] = $connectToCount;

            return $this->sendSuccessResponse($result, 'Candidates Status fetched successfully');
        } catch (Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage());
        }
    }
}
