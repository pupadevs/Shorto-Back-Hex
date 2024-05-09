<?php 

declare(strict_types=1);

namespace Source\User\Domain\Interfaces;

use Source\User\Domain\Entity\UserLog;


interface UserLogRepositoryInterface{

    /**
     * Method to insert user log
     * @param UserLog $event
     */
    public function insertLogUserCreation(UserLog $event);
/**
 * Method to insert user log
 * @param UserLog $event
 */
    public function insertLogUserUpdate(UserLog $event);

    public function save(UserLog $event);


}