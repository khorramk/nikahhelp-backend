<?php


namespace App\Services;


use App\Enums\HttpStatusCode;
use App\Models\Admin;
use App\Models\User;
use App\Models\VerifyUser;
use App\Mail\VerifyMail as VerifyEmail;
use App\Repositories\RepresentativeInformationRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Config;
use Mail;
use Illuminate\Http\JsonResponse;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Repositories\UserRepository;
use App\Repositories\EmailVerificationRepository as EmailVerifyRepository;
use App\Repositories\RepresentativeInformationRepository as RepresentativeRepository;
use App\Transformers\CandidateTransformer;
use App\Repositories\CandidateRepository;
use DB;
use Symfony\Component\HttpFoundation\Response as FResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdminService extends ApiBaseService
{

    use CrudTrait;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var RepresentativeRepository
     */
    protected $representativeRepository;

    /**
     * @var CandidateTransformer
     */
    protected $candidateTransformer;

    /**
     * @var CandidateRepository
     */
    protected $candidateRepository;


    public function __construct(
        UserRepository $UserRepository,
        RepresentativeRepository $representativeRepository,
        CandidateTransformer $candidateTransformer,
        CandidateRepository $candidateRepository
    ) {
        $this->userRepository = $UserRepository;

        $this->representativeRepository = $representativeRepository;
        $this->candidateTransformer = $candidateTransformer;
        $this->candidateRepository = $candidateRepository;
    }


    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $data = array();
        try {
            $adminInfo = Admin::where('email', $request->input('email'))->first();
//            dd($adminInfo);

            /* Check the user is existed */
            if (empty($adminInfo)) {
                return $this->sendErrorResponse(
                    'You are not a registered you should registration first ',
                    [],
                    403
                );
            }
//            /* Check the user is not delete */
//            if ($adminInfo->status == 0) {
//                return $this->sendErrorResponse(
//                    'Your account has been deleted ( ' . $adminInfo->email . ' ), please contact us so we can assist you.',
//                    [],
//                    403
//                );
//            } elseif($adminInfo->status == 9){
//                return $this->sendErrorResponse(
//                    'Your account has been Suspended ( ' . $adminInfo->email . ' ), please contact us so we can assist you.',
//                    [],
//                    403
//                );
//            }
//
//            /* Load data input status */
//            if($adminInfo->account_type == 1){
//                $adminInfo['data_input_status'] = $adminInfo->getCandidate->data_input_status;
//                $adminInfo['per_main_image_url'] = $adminInfo->getCandidate->per_main_image_url;
//                // $adminInfo['per_main_image_url'] = $adminInfo->getCandidate->per_main_image_url;
//            }elseif ($adminInfo->account_type == 2){
//                $adminInfo['data_input_status'] = $adminInfo->getRepresentative->data_input_status;
//                $adminInfo['per_main_image_url'] = $adminInfo->getRepresentative->per_main_image_url;
//                // $adminInfo['per_main_image_url'] = $adminInfo->getRepresentative->per_main_image_url;
//            }
            /* attempt login */
//            Config::set('auth.providers.users.model', \App\Models\Admin::class);
//            dd(Config::get('auth.providers.users.model'));
            if (!$token = auth('admin')->claims(['authType' => 'admin'])->attempt($credentials)) {
//            if (!$token = JWTAuth::fromUser($user)) {
                return $this->sendErrorResponse(
                    'Invalid credentials',
                    ['detail' => 'Ensure that the email and password included in the request are correct'],
                    403
                );
            } else {
                $data['token'] = self::TokenFormater($token);
//                $data['user'] = $adminInfo;

                return $this->sendSuccessResponse($data, 'Login successfully');
            }
        } catch (JWTException $exception) {
            return $this->sendErrorResponse($exception->getMessage(), [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get the token array structure.
     *
     * @param  string  $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function TokenFormater($token)
    {
        $expireTime = auth('api')->factory()->getTTL() * 60;
        $dateTime = Carbon::now()->addSeconds($expireTime);
        $data = [
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => $dateTime,
        ];

        return $data;
    }

    /**
     * @param $request
     */
    public function userList($request)
    {
        $result = $this->userRepository->getModel()->newQuery();

        $data = $result->get();
        $data = Category::paginate(request()->all());

        return Response::json($data, 200);

        return $this->sendSuccessResponse($data, 'Data retrieved successfully', [1], HttpStatusCode::SUCCESS);
    }


    /**
     * This function use for getting user information by user id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserProfile($request)
    {
        try {
            $user = $this->userRepository->findOneByProperties([
                "id" => $request->user_id,
            ]);
            if ( ! $user) {
                return $this->sendErrorResponse('User not found.', [], HttpStatusCode::NOT_FOUND);
            } else {
                $candidate = $this->candidateRepository->findOneByProperties([
                    'user_id' => $request->user_id,
                ]);
                if ( ! $candidate) {
                    $candidateInformation = array();
                } else {
                    $candidateInformation = $this->candidateTransformer->transform($candidate);
                }

                $representativeInformation = $this->representativeRepository->findBy(['user_id' => $request->user_id]);
            }
        } catch (Exception $e) {
            return response()->json([
                'status'      => 'FAIL',
                'status_code' => $e->getStatusCode(),
                'message'     => $e->getMessage(),
                'error'       => ['details' => $e->getMessage()],
            ], $e->getStatusCode());
        }

        $data = array();
        $data['user'] = $user;
        $data['candidate_information'] = $candidateInformation;
        $data['representative_information'] = $representativeInformation;

        return $this->sendSuccessResponse($data, 'Data retrieved successfully', [], HttpStatusCode::SUCCESS);
    }


}
