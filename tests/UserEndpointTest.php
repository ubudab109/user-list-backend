<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;

class UserEndpointTest extends TestCase
{
    use DatabaseMigrations;

    public function testGetUserLists()
    {
        $response = $this->json('GET', "/api/users");
        $response->seeStatusCode(200)
                 ->seeJsonStructure([
                     'status',
                     'message',
                     'data' => [
                        'pagination' => [
                            'total',
                            'showed',
                            'per_page',
                            'current_page',
                            'last_page',
                            'from',
                            'to'
                        ],
                        'data' => [
                            '*' => [
                                'id',
                                'firstname',
                                'lastname',
                                'email',
                                'image',
                                'fullname'
                            ]
                        ]
                      ],
                 ]);
    }

    public function testGetUserDetails()
    {
        $user = $this->createTestUser();
        $response = $this->json('GET', "/api/users/$user->id");
        $response->seeStatusCode(200)
                 ->seeJson([
                     'status' => 200,
                     'message' => 'Data fetched successfully',
                     'data' =>[
                        'id' => $user->id,
                        'firstname' => $user->firstname,
                        'lastname' => $user->lastname,
                        'image' => $user->image,
                        'email' => $user->email,
                        'created_at' => $user->created_at,
                        'updated_at' => $user->updated_at,
                        'fullname' => $user->fullname
                     ],
                 ]);
    }

    public function testNotFoundGetUserDetails()
    {
        $response = $this->json('GET', "/api/users/99999999999");
        $response->seeStatusCode(200)
                 ->seeJson([
                     'status' => 404,
                     'message' => "Data not found or already deleted",
                     'data' => null,
                 ]);
    }
}
