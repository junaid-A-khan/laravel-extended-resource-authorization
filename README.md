### Installation PHP >=7.4
    composer require junaid-ahmad-khan/laravel-extended-resource-authorization
---

### Installation PHP <7.3
    composer require junaid-ahmad-khan/laravel-extended-resource-authorization:1.5
---

### Description
This package provides an easy way to authorize custom methods when using
    
    class UserController extends Controller{
    
        public function __construct(){
            $this->authorizeResource(User::class,'user');
        }
    }
which only works for default resource routes show, create, edit, store, update and destroy


### Simple Usage
#### Step 1:
First you will need to remove AuthorizesRequests trait and add/use ExtendedAuthorizesRequest trait in your app/Http/Controllers/Controller.php
 
    <?php
    
    namespace App\Http\Controllers;
    
    use Illuminate\Foundation\Bus\DispatchesJobs;
    use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Foundation\Validation\ValidatesRequests;
    use ExtendedResourceAuthorization\Auth\Access\ExtendedAuthorizesRequests;
    
    class Controller extends BaseController
    {
        use ExtendedAuthorizesRequests, DispatchesJobs, ValidatesRequests;
    }
 


#### Note:
There are 2 arguments that can be passed through controller i.e.

    $extendedResourceAbilities = [
                        'controller_resource_method_name' => 'policy_resource_ability_name',
                        'custom_resource_method' => 'custom_resource_method_policy',
                        'custom_resource_method_without_model' => 'custom_resource_method_without_model'
                    ];
    
    $extendResourceMethodsWithoutModels = ['custom_resource_method_without_model'];
    
###### and
There are 2 properties which can be set on the respective model i.e.
 
    /**
    * The extended resource abilities which should be authorized when using authorizeResource
    *
    * @var array
    */
    public static $extendedResourceAbilities = [
                                      'controller_resource_method_name' => 'policy_resource_ability_name',
                                      'custom_resource_method' => 'custom_resource_method_policy',
                                      'custom_resource_method_without_model' => 'custom_resource_method_without_model'
                                  ];

    /**
    * The extended resource methods without models which should be authorized when using authorizeResource
    *
    * @var array
    */
    public static $extendResourceMethodsWithoutModels = ['custom_resource_method_without_model'];

 ##### Use Through Controller: 
 Pass both arguments through controller
 
    class BookController extends Controller{
    
            public function __construct(){
            
                $extendedResourceAbilities = [
                    'controller_resource_method_name' => 'policy_resource_ability_name',
                    'custom_resource_method' => 'custom_resource_method_policy',
                    'custom_resource_method_without_model' => 'custom_resource_method_without_model'
                ];
                
                $extendResourceMethodsWithoutModels = ['custom_resource_method_without_model'];
                
                $this->authorizeResource(Book::class,'book',[],null,$extendedResourceAbilities,$extendedResourceMethodsWithoutModels);
            }
        } 
 
 ##### Use Through Model:
You will need to change in every model you create

    Illuminate\Database\Eloquent\Model
    
to

    ExtendedResourceAuthorization\Model 
 
Define both properties in the model 
   
    class Book extends Model {
    
        /**
            * The extended resource abilities which should be authorized when using authorizeResource
            *
            * @var array
            */
            public static $extendedResourceAbilities = [
                                              'controller_resource_method_name' => 'policy_resource_ability_name',
                                              'custom_resource_method' => 'custom_resource_method_policy',
                                              'custom_resource_method_without_model' => 'custom_resource_method_without_model'
                                          ];
                                          
        
            /**
            * The extended resource methods without models which should be authorized when using authorizeResource
            *
            * @var array
            */
            public static $extendResourceMethodsWithoutModels = ['custom_resource_method_without_model'];
            
    }
    
    
    
If you are using laravel default auth and User model then you need to change
   
    use Illuminate\Foundation\Auth\User as Authenticatable;

to
    
    use ExtendedResourceAuthorization\User as Authenticatable;

By completing <b>Step 1</b> you can use this by <i><b>Use Through Controller</b></i>
    
### Precedence
<i><b>Use Through Controller</b></i> takes precedence over <i><b>Use Through Model</b></i>


### Advance Usage
You can explore the package and use traits provided by the package i.e. AuthorizesRequest, HasExtendedResourceAuthorization, for controller and model respectively

### License
The MIT License (MIT). Please see [License File](https://github.com/junaid-A-khan/laravel-extended-resource-authorization/blob/master/LICENSE.md)  for more information.

 
