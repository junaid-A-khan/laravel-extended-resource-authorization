<?php

    namespace ExtendedResourceAuthorization\Auth;

    use Illuminate\Foundation\Auth\User as Authenticatable;
    use ExtendedResourceAuthorization\Traits\HasExtendedResourceAuthorization;

    class User extends Authenticatable
    {
        use HasExtendedResourceAuthorization;
    }
