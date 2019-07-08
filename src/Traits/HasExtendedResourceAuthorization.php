<?php
    /**
     * Created by IntelliJ IDEA.
     * User: junaidahmadkhan
     * Date: 7/2/19
     * Time: 8:08 PM
     */

    namespace ExtendedResourceAuthorization\Traits;


    trait HasExtendedResourceAuthorization
    {
        /**
         * The extended resource abilities which should be authorized when using authorizeResource
         *
         * @var array
         */
        public static $extendedResourceAbilities = [];

        /**
         * The extended resource methods without models which should be authorized when using authorizeResource
         *
         * @var array
         */
        public static $extendedResourceMethodsWithoutModel = [];

    }
