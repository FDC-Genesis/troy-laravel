<?php

namespace Entities\Model;

use Core\Model\AppModel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends AppModel implements Authenticatable
{
    use HasFactory;

    // Implement required methods for Authenticatable
    public function getAuthIdentifierName()
    {
        return 'email'; // The column that you use as the identifier
    }

    public function getAuthIdentifier()
    {
        return $this->getAttribute($this->getAuthIdentifierName());
    }

    public function getAuthPassword()
    {
        return $this->password; // The column that stores the password
    }

    // Remember me methods
    public function getRememberToken()
    {
        return $this->remember_token; // Ensure you have this column in your database
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value; // Set the token value
    }

    public function getRememberTokenName()
    {
        return 'remember_token'; // The name of the column that stores the token
    }
}
