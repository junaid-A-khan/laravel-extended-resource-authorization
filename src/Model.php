<?php
    /**
     * Created by IntelliJ IDEA.
     * User: junaidahmadkhan
     * Date: 7/3/19
     * Time: 2:36 PM
     */

    namespace ExtendedResourceAuthorization;

    use ExtendedResourceAuthorization\Traits\HasExtendedResourceAuthorization;
    use Illuminate\Database\Eloquent\Model as BaseModel;

    class Model extends BaseModel
    {
        use HasExtendedResourceAuthorization;
    }
