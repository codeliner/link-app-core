<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 06.12.14 - 21:26
 */

return array(
    'prooph.link.dashboard' => [
        'system_config_widget' => [
            'controller' => 'Prooph\Link\Application\Controller\DashboardWidget',
            'order' => 101 //100 - 200 config order range
        ]
    ],
    'router' => [
        'routes' => [
            'prooph.link' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/prooph/link',
                ],
                'may_terminate' => false,
                'child_routes' => [
                    'system_config' => [
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => [
                            'route' => '/system-config',
                            'defaults' => array(
                                'controller' => 'Prooph\Link\Application\Controller\Overview',
                                'action'     => 'show',
                            ),
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'processing_set_up' => [
                                'type' => 'Literal',
                                'options' => [
                                    'route' => '/processing-set-up',
                                    'defaults' => [
                                        'controller' => 'Prooph\Link\Application\Controller\ProcessingSetUp',
                                        'action' => 'run'
                                    ]
                                ],
                            ],
                            'change_node_name' => [
                                'type' => 'Literal',
                                'options' => [
                                    'route' => '/change-node-name',
                                    'defaults' => [
                                        'controller' => 'Prooph\Link\Application\Controller\Configuration',
                                        'action' => 'change-node-name'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
        ]
    ],
    'service_manager' => [
        'invokables' => [
            'prooph.link.app.psb.single_handle_method_invoke_strategy' => 'Prooph\Link\Application\ProophPlugin\SingleHandleMethodInvokeStrategy',
            //System config writer
            'prooph.link.system_config.config_writer' => 'Prooph\Link\Application\Service\ConfigWriter\ZendPhpArrayWriter',
            //Command handlers
            'Prooph\Link\Application\Model\ProcessingConfig\CreateDefaultConfigFileHandler' => 'Prooph\Link\Application\Model\ProcessingConfig\CreateDefaultConfigFileHandler',
            'Prooph\Link\Application\Model\ProcessingConfig\InitializeEventStoreHandler'    => 'Prooph\Link\Application\Model\ProcessingConfig\InitializeEventStoreHandler',
            'Prooph\Link\Application\Model\ProcessingConfig\ChangeNodeNameHandler'          => 'Prooph\Link\Application\Model\ProcessingConfig\ChangeNodeNameHandler',
            'Prooph\Link\Application\Model\ProcessingConfig\AddNewProcessToConfigHandler'   => 'Prooph\Link\Application\Model\ProcessingConfig\AddNewProcessToConfigHandler' ,
            'Prooph\Link\Application\Model\ProcessingConfig\ChangeProcessConfigHandler'     => 'Prooph\Link\Application\Model\ProcessingConfig\ChangeProcessConfigHandler',
            'Prooph\Link\Application\Model\ProcessingConfig\UndoSystemSetUpHandler'         => 'Prooph\Link\Application\Model\ProcessingConfig\UndoSystemSetUpHandler',
            'Prooph\Link\Application\Model\ProcessingConfig\AddConnectorToConfigHandler'    => 'Prooph\Link\Application\Model\ProcessingConfig\AddConnectorToConfigHandler',
            'Prooph\Link\Application\Model\ProcessingConfig\ChangeConnectorConfigHandler'   => 'Prooph\Link\Application\Model\ProcessingConfig\ChangeConnectorConfigHandler',
        ],
        'factories' => [
            'prooph.link.app.config_location'     => 'Prooph\Link\Application\Service\Factory\ConfigLocationFactory',
            'prooph.link.app.data_location'       => 'Prooph\Link\Application\Service\Factory\DataLocationFactory',
            'prooph.link.app.data_type_location'  => 'Prooph\Link\Application\Service\Factory\ApplicationDataTypeLocationFactory',
            'prooph.link.app.location_translator' => 'Prooph\Link\Application\SharedKernel\Factory\LocationTranslatorFactory',
            'prooph.link.app.db'                  => 'Prooph\Link\Application\Service\Factory\ApplicationDbFactory',
            'prooph.link.app.riot_tag.collection.resolver' => 'Prooph\Link\Application\Service\Factory\RiotTagCollectionResolverFactory',
            //Projections
            'prooph.link.system_config' => Prooph\Link\Application\Service\SystemConfigFactory::class,
        ],
        'aliases' => [
            'processing_config' => 'prooph.link.system_config',
        ]
    ],
    'controllers' => array(
        'invokables' => array(
            'Prooph\Link\Application\Controller\ProcessingSetUp'   => \Prooph\Link\Application\Controller\ProcessingSetUpController::class,
            'Prooph\Link\Application\Controller\Configuration'     => \Prooph\Link\Application\Controller\ConfigurationController::class,
            'Prooph\Link\Application\Controller\DashboardWidget'   => \Prooph\Link\Application\Controller\DashboardWidgetController::class,
            'Prooph\Link\Application\Controller\Overview'          => \Prooph\Link\Application\Controller\OverviewController::class,
        ),
    ),
    'prooph.psb' => [
        'command_router_map' => [
            'Prooph\Link\Application\Command\CreateDefaultProcessingConfigFile' => 'Prooph\Link\Application\Model\ProcessingConfig\CreateDefaultConfigFileHandler',
            'Prooph\Link\Application\Command\InitializeEventStore'              => 'Prooph\Link\Application\Model\ProcessingConfig\InitializeEventStoreHandler',
            'Prooph\Link\Application\Command\ChangeNodeName'                    => 'Prooph\Link\Application\Model\ProcessingConfig\ChangeNodeNameHandler',
            'Prooph\Link\Application\Command\AddNewProcessToConfig'             => 'Prooph\Link\Application\Model\ProcessingConfig\AddNewProcessToConfigHandler',
            'Prooph\Link\Application\Command\ChangeProcessConfig'               => 'Prooph\Link\Application\Model\ProcessingConfig\ChangeProcessConfigHandler',
            'Prooph\Link\Application\Command\UndoSystemSetUp'                   => 'Prooph\Link\Application\Model\ProcessingConfig\UndoSystemSetUpHandler',
            'Prooph\Link\Application\Command\AddConnectorToConfig'              => 'Prooph\Link\Application\Model\ProcessingConfig\AddConnectorToConfigHandler',
            'Prooph\Link\Application\Command\ChangeConnectorConfig'             => 'Prooph\Link\Application\Model\ProcessingConfig\ChangeConnectorConfigHandler',
        ]
    ],
    'view_manager' => [
        'template_map' => [
            'prooph/link/system-config/dashboard/widget' => __DIR__ . '/../view/system-config/dashboard/widget.phtml',
            'prooph/link/system-config/overview/show' => __DIR__ . '/../view/system-config/overview/show.phtml',
            'prooph/link/system-config/riot-tag/system-configurator' => __DIR__ . '/../view/system-config/riot-tag/system-configurator.phtml',
            'prooph/link/system-config/riot-tag/system-node-name' => __DIR__ . '/../view/system-config/riot-tag/system-node-name.phtml',
        ],
    ],
    'view_helpers' => [
        'invokables'=> [
            'riotTag' => 'Prooph\Link\Application\View\Helper\RiotTag'
        ]
    ],
    'asset_manager' => [
        'resolvers' => [
            'prooph.link.app.riot_tag.collection.resolver' => 2000
        ],
        'resolver_configs' => [
            //Riot tags are resolved by the Application\Service\RiotTagCollectionResolver
            'riot-tags' => [
                'js/prooph/link/system-config/app.js' => [
                    'prooph/link/system-config/riot-tag/system-configurator',
                    'prooph/link/system-config/riot-tag/system-node-name',
                ],
            ],
            'paths' => [
                __DIR__ . '/../public',
            ],
        ],
    ],
    'zf-content-negotiation' => [
        //Application wide selectors for the content negotiation module
        'selectors'   => [
            'Json' => [
                'ZF\ContentNegotiation\JsonModel' => [
                    'application/json',
                    'application/*+json',
                ],
            ],
        ],
        'controllers' => [
            'Prooph\Link\Application\Controller\Configuration' => 'Json',
        ],
        'accept_whitelist' => [
            'Prooph\Link\Application\Controller\Configuration' => ['application/json'],
        ],
        'content_type_whitelist' => [
            'Prooph\Link\Application\Controller\Configuration' => ['application/json'],
        ],
    ],
    'zf-api-problem' => [
        'accept_filters' => [
            'application/json',
            'application/*+json',
        ]
    ],
);
