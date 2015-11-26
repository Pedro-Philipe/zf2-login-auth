<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Users\Controller\Index' => 'Users\Controller\IndexController',
            'Users\Controller\Register' => 'Users\Controller\RegisterController',


        ),
    ),
    'router' => array(
        'routes' => array(
            'users' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/users',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Users\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    	'register' => array(
                   			'type'    => 'Segment',
                    		'may_terminate' => true,
                   			'options' => array(
                   				'route'    => '/register[/:action]',
                   				'constraints' => array(
                   					'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                   				),
                   				'defaults' => array(
                   					'controller' => 'Users\Controller\Register',
                   					'action'     => 'index',
                   				),
                   			),
                    	),


        					'default' => array(
                                'type'    => 'Segment',
                                'options' => array(
                                    'route'    => '/[:controller[/:action]]',
                                    'constraints' => array(
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                    ),
                                    'defaults' => array(
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            'view_manager' => array(
                'template_path_stack' => array(
                    'users' => __DIR__ . '/../view',
                ),
            	'template_map' => array(
            		'layout/layout'           => __DIR__ . '/../view/layout/default-layout.phtml',
            		'layout/myaccount'           => __DIR__ . '/../view/layout/myaccount-layout.phtml',
        			'active' =>true,
            	),
            ),
        	// MODULE CONFIGURATIONS
        	'module_config' => array(
        		'upload_location'           => __DIR__ . '/../data/uploads',
        	),
  );
