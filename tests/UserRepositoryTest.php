<?php

namespace Tests;

use App\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
class UserRepositoryTest extends TestCase
{
    private $userRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
        $this->userRepository = new UserRepository(new User);
    }

    public function testUserListsReturnsLengthAwarePaginator()
    {
        $result = $this->userRepository->userLists();
        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
    }

    public function testUserDetailReturnsUserModel()
    {
        $user = $this->createTestUser();
        $result = $this->userRepository->userDetail($user->id);
        $this->assertInstanceOf(User::class, $result);
    }
}
