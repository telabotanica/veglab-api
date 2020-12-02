<?php

namespace App\Security\User;

/** 
 * Thrown when trying to access a "must be logged" part of the app 
 * without the user being logged in.
 */
class UnloggedAccessException  extends \Exception {

}
