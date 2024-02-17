<?php

namespace App\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface UserInterface
{
    /**
	 * The userLists function returns a paginated list of users with their id, firstname, lastname, email,
	 * and image.
	 * 
	 * @return LengthAwarePaginator A LengthAwarePaginator object containing a paginated list of users
	 * with the columns 'id', 'firstname', 'lastname', 'email', and 'image'. The pagination is set to
	 * display 10 users per page.
	 */
    public function userLists(): LengthAwarePaginator;

    /**
	 * This PHP function retrieves a user's details based on their user ID.
	 * 
	 * @param int $userId The `userId` parameter in the `userDetail` function is of type `int` and
	 * represents the unique identifier of the user whose details are being retrieved.
	 * 
	 * @return object|null An object representing the user with the specified `` is being returned.
	 * If no user is found with the given ID, `null` is returned.
	 */
    public function userDetail(int $userId): object|null;
}