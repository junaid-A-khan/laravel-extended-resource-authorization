<?php
    /**
     * Created by IntelliJ IDEA.
     * User: junaidahmadkhan
     * Date: 7/3/19
     * Time: 2:44 PM
     */

    namespace ExtendedResourceAuthorization\Auth\Access;


    use Illuminate\Support\Str;


    trait AuthorizesRequests
    {
        /**
         * Authorize a resource action based on the incoming request.
         *
         * @param  string  $model
         * @param  string|null  $parameter
         * @param  array  $options
         * @param  \Illuminate\Http\Request|null  $request
         * @param  array $extendedResourceAbilities
         * @param  array $extendedResourceMethodsWithoutModel
         * @return void
         */
        public function authorizeResource($model, $parameter = null, array $options = [], $request = null, array $extendedResourceAbilities = [], array $extendedResourceMethodsWithoutModel = [])
        {
            $parameter = $parameter ?: Str::snake(class_basename($model));

            $middleware = [];

            foreach ($this->resourceAbilityMap(!empty($extendedResourceAbilities) ? $extendedResourceAbilities : $model::$extendedResourceAbilities) as $method => $ability) {
                $modelName = in_array($method, $this->resourceMethodsWithoutModels(!empty($extendedResourceMethodsWithoutModel) ? $extendedResourceMethodsWithoutModel : $model::$extendedResourceMethodsWithoutModel)) ? $model : $parameter;

                $middleware["can:{$ability},{$modelName}"][] = $method;
            }

            foreach ($middleware as $middlewareName => $methods) {
                $this->middleware($middlewareName, $options)->only($methods);
            }
        }

        /**
         * Get the map of resource methods to ability names.
         * @param array $extendedResourceAbilities
         * @return array
         */
        protected function resourceAbilityMap(array $extendedResourceAbilities)
        {
            return array_merge ( [
                                     'show' => 'view',
                                     'create' => 'create',
                                     'store' => 'create',
                                     'edit' => 'update',
                                     'update' => 'update',
                                     'destroy' => 'delete',
                                 ],$extendedResourceAbilities
            );
        }

        /**
         * Get the list of resource methods which do not have model parameters.
         * @param array $extendedResourceMethodsWithoutModel
         * @return array
         */
        protected function resourceMethodsWithoutModels(array $extendedResourceMethodsWithoutModel)
        {
            return array_merge ( ['index', 'create', 'store'],$extendedResourceMethodsWithoutModel);
        }
    }
