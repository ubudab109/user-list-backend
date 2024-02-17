<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaginationResource;
use App\Interfaces\UserInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserController extends Controller
{

    /**
     * @var UserInterface $userRepository
     * 
     */
    private $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * The index function returns a JSON response with user lists paginated using PaginationResource.
     * 
     * @return JsonResponse A JsonResponse object is being returned. The response contains a status
     * code of 200 (HTTP_OK), a success message 'Data fetched successfully', and the data which is a
     * PaginationResource object containing user lists fetched from the userRepository.
     */
    public function index(): JsonResponse
    {
        $pagination = new PaginationResource($this->userRepository->userLists());
        return response()->json([
            'status'    => Response::HTTP_OK,
            'message'   => 'Data fetched successfully',
            'data'      => $pagination
        ]);
    }

    /**
     * The function `show` retrieves user details and returns a JSON response with status and message.
     * 
     * @param int $id the id of user
     * 
     * @return JsonResponse The `show` function returns a JSON response with the status, message, and
     * data. If the data for the specified user is found, it returns a response with status 200
     * (HTTP_OK) and the fetched data. If the data is not found or has been deleted, it returns a
     * response with status 404 (HTTP_NOT_FOUND) and a message indicating that the data was not found
     * or
     */
    public function show(int $id): JsonResponse
    {
        $data = $this->userRepository->userDetail($id);

        if (!$data) {
            return response()->json([
                'status'  => Response::HTTP_NOT_FOUND,
                'message' => 'Data not found or already deleted',
                'data'    => null
            ]);
        }

        return response()->json([
            'status'  => Response::HTTP_OK,
            'message' => 'Data fetched successfully',
            'data'    => $data,
        ]);
    }
}