<?php
    /**
     * Created by IntelliJ IDEA.
     * User: junaidahmadkhan
     * Date: 7/3/19
     * Time: 2:44 PM
     */

    namespace ExtendedResourceAuthorization\Auth\Access;


    use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    use Illuminate\Support\Str;


    trait ExtendedAuthorizesRequests
    {
        use AuthorizesRequests;

        /**
         * Authorize a resource action based on the incoming request.
         *
         * @param  string                        $model
         * @param  string|null                   $parameter
         * @param  array                         $options
         * @param  \Illuminate\Http\Request|null $request
         * @param  array                         $extendedResourceAbilities
         * @param  array                         $extendedResourceMethodsWithoutModels
         * @return void
         */
        public function authorizeResource ( $model, $parameter = null, array $options = [], $request = null, array $extendedResourceAbilities = [], array $extendedResourceMethodsWithoutModels = [] )
        {
            $parameter = $parameter ? : Str::snake ( class_basename ( $model ) );

            $middleware = [];

            foreach ( $this->resourceAbilityMap ( !empty( $extendedResourceAbilities ) ? $extendedResourceAbilities : property_exists ( $model, 'extendedResourceAbilities' ) ? $model::$extendedResourceAbilities : $extendedResourceAbilities ) as $method => $ability ) {
                $modelName = in_array ( $method, $this->resourceMethodsWithoutModels ( !empty( $extendedResourceMethodsWithoutModels ) ? $extendedResourceMethodsWithoutModels : property_exists ( $model, 'extendedResourceMethodsWithoutModels' ) ? $model::$extendedResourceMethodsWithoutModels : $extendedResourceMethodsWithoutModels ) ) ? $model : $parameter;

                $middleware[ "can:{$ability},{$modelName}" ][] = $method;
            }

            foreach ( $middleware as $middlewareName => $methods ) {
                $this->middleware ( $middlewareName, $options )->only ( $methods );
            }
        }

        /**
         * Get the map of resource methods to ability names.
         *
         * @param array $extendedResourceAbilities
         * @return array
         */
        protected function resourceAbilityMap ( array $extendedResourceAbilities )
        {
            return array_merge ( [
                                     'index'   => 'viewAny',
                                     'show'    => 'view',
                                     'create'  => 'create',
                                     'store'   => 'create',
                                     'edit'    => 'update',
                                     'update'  => 'update',
                                     'destroy' => 'delete',
                                 ], $extendedResourceAbilities
            );
        }

        /**
         * Get the list of resource methods which do not have model parameters.
         *
         * @param array $extendedResourceMethodsWithoutModels
         * @return array
         */
        protected function resourceMethodsWithoutModels ( array $extendedResourceMethodsWithoutModels )
        {
            return array_merge ( [ 'index', 'create', 'store' ], $extendedResourceMethodsWithoutModels );
        }
    }
