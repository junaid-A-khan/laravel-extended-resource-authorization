<?php
    /**
     * Created by IntelliJ IDEA.
     * User: junaidahmadkhan
     * Date: 7/3/19
     * Time: 2:51 PM
     */

    namespace ExtendedResourceAuthorization;

    use \App\Http\Controllers\Controller as BaseController;
    use ExtendedResourceAuthorization\Auth\Access\AuthorizesRequests;

    class Controller extends BaseController
    {
        use AuthorizesRequests;
    }
