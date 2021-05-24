<?php

namespace Concrete\Package\Ht7C5Base\Services;

use \InvalidArgumentException;
use \Doctrine\ORM\EntityManagerInterface;

//use \Concrete\Core\User\User;
//use \Concrete\Core\User\Group\Group;
//use \Concrete\Core\User\Group\GroupList;

class UserBase extends AbstractService
{

    /**
     * Create a user name from the email address.
     *
     * This method will remove all chars other than numbers and alphabetical.
     * Additionally the user id will be added to the end of the string to make
     * sure, the user name is unique.
     *
     * The additional user id at the end can be deactivated as following:
     * <code>misc.register.username.unique = false</code>.
     *
     * @param   string      $uEmail
     * @return  string
     */
    public function createUsernameFromEmail($uEmail, $isUnique = true)
    {
        if (empty($uEmail)) {
            $e = 'The email address must not be empty.';

            throw new InvalidArgumentException($e);
        }

        $maxUId = '';
        $email = $this->prepareEmail($uEmail);

        if ($isUnique) {
            $maxUId = $this->getMaxId();
        }

        return preg_replace('/[^a-z0-9]/', '', $email) . $maxUId;
    }

    /**
     * Get the max id of user ids from the c5 db.
     *
     * This method makes a lookup for the auto increment value of the user table.
     *
     * @return  int
     */
    public function getMaxId()
    {
        $db = $this->app->make(EntityManagerInterface::class)
                ->getConnection();

        $sql = 'SELECT AUTO_INCREMENT '
                . 'FROM INFORMATION_SCHEMA.TABLES '
                . 'WHERE TABLE_SCHEMA = ? '
                . 'AND TABLE_NAME = ?';

        $parameters = [
            $db->getDatabase(),
            'Users'
        ];

        return (int) $db->getOne($sql, $parameters);
    }

    public function getPattern()
    {
        $pattern = '/';
        $pattern .= '/';
    }

    protected function prepareEmail($uEmail)
    {
        return strtolower($uEmail);
    }

}
