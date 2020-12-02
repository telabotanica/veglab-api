<?php

namespace ContainerVfovuPi;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/*
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 *
 * @final
 */
class srcApp_KernelProdContainer extends Container
{
    private $buildParameters;
    private $containerDir;
    private $targetDir;
    private $parameters = [];
    private $getService;

    public function __construct(array $buildParameters = [], $containerDir = __DIR__)
    {
        $this->getService = \Closure::fromCallable([$this, 'getService']);
        $this->buildParameters = $buildParameters;
        $this->containerDir = $containerDir;
        $this->targetDir = \dirname($containerDir);
        $this->parameters = $this->getDefaultParameters();

        $this->services = $this->privates = [];
        $this->syntheticIds = [
            'kernel' => true,
        ];
        $this->methodMap = [
            'doctrine' => 'getDoctrineService',
            'doctrine.dbal.default_connection' => 'getDoctrine_Dbal_DefaultConnectionService',
            'doctrine.orm.default_entity_manager' => 'getDoctrine_Orm_DefaultEntityManagerService',
            'event_dispatcher' => 'getEventDispatcherService',
            'filesystem' => 'getFilesystemService',
            'fos_elastica.client.default' => 'getFosElastica_Client_DefaultService',
            'fos_elastica.finder.biblio_phytos.biblio_phyto' => 'getFosElastica_Finder_BiblioPhytos_BiblioPhytoService',
            'fos_elastica.finder.observers.observer' => 'getFosElastica_Finder_Observers_ObserverService',
            'fos_elastica.finder.occurrences.occurrence' => 'getFosElastica_Finder_Occurrences_OccurrenceService',
            'fos_elastica.finder.photos.photo' => 'getFosElastica_Finder_Photos_PhotoService',
            'fos_elastica.finder.tables.table' => 'getFosElastica_Finder_Tables_TableService',
            'fos_elastica.index.biblio_phytos' => 'getFosElastica_Index_BiblioPhytosService',
            'fos_elastica.index.biblio_phytos.biblio_phyto' => 'getFosElastica_Index_BiblioPhytos_BiblioPhytoService',
            'fos_elastica.index.observers' => 'getFosElastica_Index_ObserversService',
            'fos_elastica.index.observers.observer' => 'getFosElastica_Index_Observers_ObserverService',
            'fos_elastica.index.occurrences' => 'getFosElastica_Index_OccurrencesService',
            'fos_elastica.index.occurrences.occurrence' => 'getFosElastica_Index_Occurrences_OccurrenceService',
            'fos_elastica.index.photos' => 'getFosElastica_Index_PhotosService',
            'fos_elastica.index.photos.photo' => 'getFosElastica_Index_Photos_PhotoService',
            'fos_elastica.index.tables' => 'getFosElastica_Index_TablesService',
            'fos_elastica.index.tables.table' => 'getFosElastica_Index_Tables_TableService',
            'fos_elastica.manager.orm' => 'getFosElastica_Manager_OrmService',
            'fos_elastica.repository_manager' => 'getFosElastica_RepositoryManagerService',
            'http_kernel' => 'getHttpKernelService',
            'liip_imagine.cache.manager' => 'getLiipImagine_Cache_ManagerService',
            'liip_imagine.cache.resolver.default' => 'getLiipImagine_Cache_Resolver_DefaultService',
            'liip_imagine.cache.resolver.no_cache_web_path' => 'getLiipImagine_Cache_Resolver_NoCacheWebPathService',
            'liip_imagine.cache.signer' => 'getLiipImagine_Cache_SignerService',
            'request_stack' => 'getRequestStackService',
            'router' => 'getRouterService',
            'security.authorization_checker' => 'getSecurity_AuthorizationCheckerService',
            'security.token_storage' => 'getSecurity_TokenStorageService',
            'serializer' => 'getSerializerService',
            'translator' => 'getTranslatorService',
            'twig' => 'getTwigService',
            'validator' => 'getValidatorService',
            'vich_uploader.templating.helper.uploader_helper' => 'getVichUploader_Templating_Helper_UploaderHelperService',
            'vich_uploader.upload_handler' => 'getVichUploader_UploadHandlerService',
        ];
        $this->fileMap = [
            'App\\Controller\\Celv2Controller' => 'getCelv2ControllerService.php',
            'App\\Controller\\CreatePdfFileAction' => 'getCreatePdfFileActionService.php',
            'App\\Controller\\CreatePhotoAction' => 'getCreatePhotoActionService.php',
            'App\\Controller\\CreateProfileAction' => 'getCreateProfileActionService.php',
            'App\\Controller\\ExportOccurrenceAction' => 'getExportOccurrenceActionService.php',
            'App\\Controller\\ImportOccurrenceAction' => 'getImportOccurrenceActionService.php',
            'App\\Controller\\NgClientController' => 'getNgClientControllerService.php',
            'App\\Controller\\OccurrenceBulkAction' => 'getOccurrenceBulkActionService.php',
            'App\\Controller\\PhotoBulkAction' => 'getPhotoBulkActionService.php',
            'App\\Controller\\PhotoTagTreeApiController' => 'getPhotoTagTreeApiControllerService.php',
            'App\\Controller\\PlantnetProxyController' => 'getPlantnetProxyControllerService.php',
            'App\\Controller\\RotatePhotoController' => 'getRotatePhotoControllerService.php',
            'App\\Controller\\ServeZippedPhotosAction' => 'getServeZippedPhotosActionService.php',
            'App\\Controller\\UserOccurrenceTagTreeApiController' => 'getUserOccurrenceTagTreeApiControllerService.php',
            'Liip\\ImagineBundle\\Controller\\ImagineController' => 'getImagineControllerService.php',
            'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController' => 'getRedirectControllerService.php',
            'Symfony\\Bundle\\FrameworkBundle\\Controller\\TemplateController' => 'getTemplateControllerService.php',
            'Vich\\UploaderBundle\\Naming\\OrignameNamer.media_object' => 'getOrignameNamer_MediaObjectService.php',
            'api_platform.action.documentation' => 'getApiPlatform_Action_DocumentationService.php',
            'api_platform.action.entrypoint' => 'getApiPlatform_Action_EntrypointService.php',
            'api_platform.action.exception' => 'getApiPlatform_Action_ExceptionService.php',
            'api_platform.action.not_found' => 'getApiPlatform_Action_NotFoundService.php',
            'api_platform.action.placeholder' => 'getApiPlatform_Action_PlaceholderService.php',
            'api_platform.jsonld.action.context' => 'getApiPlatform_Jsonld_Action_ContextService.php',
            'api_platform.swagger.action.ui' => 'getApiPlatform_Swagger_Action_UiService.php',
            'cache.app' => 'getCache_AppService.php',
            'cache.app_clearer' => 'getCache_AppClearerService.php',
            'cache.global_clearer' => 'getCache_GlobalClearerService.php',
            'cache.system' => 'getCache_SystemService.php',
            'cache.system_clearer' => 'getCache_SystemClearerService.php',
            'cache_clearer' => 'getCacheClearerService.php',
            'cache_warmer' => 'getCacheWarmerService.php',
            'console.command.public_alias.api_platform.json_schema.json_schema_generate_command' => 'getConsole_Command_PublicAlias_ApiPlatform_JsonSchema_JsonSchemaGenerateCommandService.php',
            'console.command.public_alias.api_platform.swagger.command.swagger_command' => 'getConsole_Command_PublicAlias_ApiPlatform_Swagger_Command_SwaggerCommandService.php',
            'console.command_loader' => 'getConsole_CommandLoaderService.php',
            'container.env_var_processors_locator' => 'getContainer_EnvVarProcessorsLocatorService.php',
            'enqueue.client.default.producer' => 'getEnqueue_Client_Default_ProducerService.php',
            'enqueue_elastica.queue_pager_perister' => 'getEnqueueElastica_QueuePagerPeristerService.php',
            'error_controller' => 'getErrorControllerService.php',
            'form.factory' => 'getForm_FactoryService.php',
            'form.type.file' => 'getForm_Type_FileService.php',
            'fos_elastica.config_manager' => 'getFosElastica_ConfigManagerService.php',
            'fos_elastica.config_manager.index_templates' => 'getFosElastica_ConfigManager_IndexTemplatesService.php',
            'fos_elastica.filter_objects_listener' => 'getFosElastica_FilterObjectsListenerService.php',
            'fos_elastica.in_place_pager_persister' => 'getFosElastica_InPlacePagerPersisterService.php',
            'fos_elastica.index_manager' => 'getFosElastica_IndexManagerService.php',
            'fos_elastica.index_template_manager' => 'getFosElastica_IndexTemplateManagerService.php',
            'fos_elastica.object_persister.biblio_phytos.biblio_phyto' => 'getFosElastica_ObjectPersister_BiblioPhytos_BiblioPhytoService.php',
            'fos_elastica.object_persister.observers.observer' => 'getFosElastica_ObjectPersister_Observers_ObserverService.php',
            'fos_elastica.object_persister.occurrences.occurrence' => 'getFosElastica_ObjectPersister_Occurrences_OccurrenceService.php',
            'fos_elastica.object_persister.photos.photo' => 'getFosElastica_ObjectPersister_Photos_PhotoService.php',
            'fos_elastica.object_persister.tables.table' => 'getFosElastica_ObjectPersister_Tables_TableService.php',
            'fos_elastica.pager_persister_registry' => 'getFosElastica_PagerPersisterRegistryService.php',
            'fos_elastica.pager_provider.biblio_phytos.biblio_phyto' => 'getFosElastica_PagerProvider_BiblioPhytos_BiblioPhytoService.php',
            'fos_elastica.pager_provider.observers.observer' => 'getFosElastica_PagerProvider_Observers_ObserverService.php',
            'fos_elastica.pager_provider.occurrences.occurrence' => 'getFosElastica_PagerProvider_Occurrences_OccurrenceService.php',
            'fos_elastica.pager_provider.photos.photo' => 'getFosElastica_PagerProvider_Photos_PhotoService.php',
            'fos_elastica.pager_provider.tables.table' => 'getFosElastica_PagerProvider_Tables_TableService.php',
            'fos_elastica.pager_provider_registry' => 'getFosElastica_PagerProviderRegistryService.php',
            'fos_elastica.paginator.subscriber' => 'getFosElastica_Paginator_SubscriberService.php',
            'fos_elastica.persister_registry' => 'getFosElastica_PersisterRegistryService.php',
            'fos_elastica.resetter' => 'getFosElastica_ResetterService.php',
            'fos_elastica.template_resetter' => 'getFosElastica_TemplateResetterService.php',
            'jms_serializer' => 'getJmsSerializerService.php',
            'jms_serializer.array_collection_handler' => 'getJmsSerializer_ArrayCollectionHandlerService.php',
            'jms_serializer.constraint_violation_handler' => 'getJmsSerializer_ConstraintViolationHandlerService.php',
            'jms_serializer.datetime_handler' => 'getJmsSerializer_DatetimeHandlerService.php',
            'jms_serializer.deserialization_context_factory' => 'getJmsSerializer_DeserializationContextFactoryService.php',
            'jms_serializer.doctrine_proxy_subscriber' => 'getJmsSerializer_DoctrineProxySubscriberService.php',
            'jms_serializer.form_error_handler' => 'getJmsSerializer_FormErrorHandlerService.php',
            'jms_serializer.json_deserialization_visitor' => 'getJmsSerializer_JsonDeserializationVisitorService.php',
            'jms_serializer.json_serialization_visitor' => 'getJmsSerializer_JsonSerializationVisitorService.php',
            'jms_serializer.metadata_driver' => 'getJmsSerializer_MetadataDriverService.php',
            'jms_serializer.object_constructor' => 'getJmsSerializer_ObjectConstructorService.php',
            'jms_serializer.php_collection_handler' => 'getJmsSerializer_PhpCollectionHandlerService.php',
            'jms_serializer.serialization_context_factory' => 'getJmsSerializer_SerializationContextFactoryService.php',
            'jms_serializer.twig_extension.serializer_runtime_helper' => 'getJmsSerializer_TwigExtension_SerializerRuntimeHelperService.php',
            'jms_serializer.xml_deserialization_visitor' => 'getJmsSerializer_XmlDeserializationVisitorService.php',
            'jms_serializer.xml_serialization_visitor' => 'getJmsSerializer_XmlSerializationVisitorService.php',
            'jms_serializer.yaml_serialization_visitor' => 'getJmsSerializer_YamlSerializationVisitorService.php',
            'liip_imagine.binary.loader.default' => 'getLiipImagine_Binary_Loader_DefaultService.php',
            'liip_imagine.config.stack_collection' => 'getLiipImagine_Config_StackCollectionService.php',
            'liip_imagine.data.manager' => 'getLiipImagine_Data_ManagerService.php',
            'liip_imagine.filter.loader.downscale' => 'getLiipImagine_Filter_Loader_DownscaleService.php',
            'liip_imagine.filter.loader.fixed' => 'getLiipImagine_Filter_Loader_FixedService.php',
            'liip_imagine.filter.loader.flip' => 'getLiipImagine_Filter_Loader_FlipService.php',
            'liip_imagine.filter.loader.grayscale' => 'getLiipImagine_Filter_Loader_GrayscaleService.php',
            'liip_imagine.filter.loader.interlace' => 'getLiipImagine_Filter_Loader_InterlaceService.php',
            'liip_imagine.filter.loader.resample' => 'getLiipImagine_Filter_Loader_ResampleService.php',
            'liip_imagine.filter.loader.rotate' => 'getLiipImagine_Filter_Loader_RotateService.php',
            'liip_imagine.filter.manager' => 'getLiipImagine_Filter_ManagerService.php',
            'routing.loader' => 'getRouting_LoaderService.php',
            'security.authentication_utils' => 'getSecurity_AuthenticationUtilsService.php',
            'security.csrf.token_manager' => 'getSecurity_Csrf_TokenManagerService.php',
            'security.password_encoder' => 'getSecurity_PasswordEncoderService.php',
            'services_resetter' => 'getServicesResetterService.php',
            'session' => 'getSessionService.php',
            'twig.controller.exception' => 'getTwig_Controller_ExceptionService.php',
            'twig.controller.preview_error' => 'getTwig_Controller_PreviewErrorService.php',
            'vich_uploader.directory_namer_subdir' => 'getVichUploader_DirectoryNamerSubdirService.php',
            'vich_uploader.download_handler' => 'getVichUploader_DownloadHandlerService.php',
            'vich_uploader.form.type.file' => 'getVichUploader_Form_Type_FileService.php',
            'vich_uploader.form.type.image' => 'getVichUploader_Form_Type_ImageService.php',
            'vich_uploader.mappings.media_object.directory_namer' => 'getVichUploader_Mappings_MediaObject_DirectoryNamerService.php',
            'vich_uploader.mappings.media_object.namer' => 'getVichUploader_Mappings_MediaObject_NamerService.php',
            'vich_uploader.namer_base64' => 'getVichUploader_NamerBase64Service.php',
            'vich_uploader.namer_directory_current_date_time' => 'getVichUploader_NamerDirectoryCurrentDateTimeService.php',
            'vich_uploader.namer_directory_property' => 'getVichUploader_NamerDirectoryPropertyService.php',
            'vich_uploader.namer_hash' => 'getVichUploader_NamerHashService.php',
            'vich_uploader.namer_origname' => 'getVichUploader_NamerOrignameService.php',
            'vich_uploader.namer_property' => 'getVichUploader_NamerPropertyService.php',
            'vich_uploader.namer_uniqid' => 'getVichUploader_NamerUniqidService.php',
        ];
        $this->aliases = [
            'ApiPlatform\\Core\\Action\\NotFoundAction' => 'api_platform.action.not_found',
            'api_platform.action.delete_item' => 'api_platform.action.placeholder',
            'api_platform.action.get_collection' => 'api_platform.action.placeholder',
            'api_platform.action.get_item' => 'api_platform.action.placeholder',
            'api_platform.action.get_subresource' => 'api_platform.action.placeholder',
            'api_platform.action.patch_item' => 'api_platform.action.placeholder',
            'api_platform.action.post_collection' => 'api_platform.action.placeholder',
            'api_platform.action.put_item' => 'api_platform.action.placeholder',
            'database_connection' => 'doctrine.dbal.default_connection',
            'doctrine.orm.entity_manager' => 'doctrine.orm.default_entity_manager',
            'fos_elastica.client' => 'fos_elastica.client.default',
            'fos_elastica.index' => 'fos_elastica.index.occurrences',
            'fos_elastica.manager' => 'fos_elastica.manager.orm',
            'liip_imagine.controller' => 'Liip\\ImagineBundle\\Controller\\ImagineController',
        ];

        $this->privates['service_container'] = function () {
            include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/HttpKernelInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/KernelInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/RebootableInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/TerminableInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/Kernel.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Kernel/MicroKernelTrait.php';
            include_once \dirname(__DIR__, 4).'/src/Kernel.php';
            include_once \dirname(__DIR__, 4).'/src/EventListener/XcountResponseListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Controller/ControllerNameParser.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/ControllerMetadata/ArgumentMetadataFactoryInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/ControllerMetadata/ArgumentMetadataFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/event-dispatcher/EventSubscriberInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/EventListener/ResponseListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/EventListener/StreamedResponseListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/EventListener/LocaleListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/EventListener/ValidateRequestListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/EventListener/ResolveControllerNameSubscriber.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/dependency-injection/ParameterBag/ParameterBagInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/dependency-injection/ParameterBag/ParameterBag.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/dependency-injection/ParameterBag/FrozenParameterBag.php';
            include_once \dirname(__DIR__, 4).'/vendor/psr/container/src/ContainerInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/dependency-injection/ParameterBag/ContainerBagInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/dependency-injection/ParameterBag/ContainerBag.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/event-dispatcher-contracts/EventDispatcherInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/event-dispatcher/EventDispatcherInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/event-dispatcher/EventDispatcher.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/HttpKernel.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/Controller/ControllerResolverInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/Controller/ControllerResolver.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/Controller/ContainerControllerResolver.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Controller/ControllerResolver.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/Controller/ArgumentResolverInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/Controller/ArgumentResolver.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/http-foundation/RequestStack.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/filesystem/Filesystem.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/config/ConfigCacheFactoryInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/config/ResourceCheckerConfigCacheFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/EventListener/LocaleAwareListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/psr/cache/src/CacheItemPoolInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/cache/Adapter/AdapterInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/cache-contracts/CacheInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/psr/log/Psr/Log/LoggerAwareInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/service-contracts/ResetInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/cache/ResettableInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/psr/log/Psr/Log/LoggerAwareTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/cache/Traits/AbstractTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/cache/Traits/AbstractAdapterTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/cache-contracts/CacheTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/cache/Traits/ContractsTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/cache/Adapter/AbstractAdapter.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/cache/Marshaller/MarshallerInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/cache/Marshaller/DefaultMarshaller.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/cache/PruneableInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/cache/Traits/FilesystemCommonTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/cache/Traits/FilesystemTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/cache/Adapter/FilesystemAdapter.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/property-access/PropertyAccessorInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/property-access/PropertyAccessor.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/EventListener/AbstractSessionListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/EventListener/SessionListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/service-contracts/ServiceProviderInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/service-contracts/ServiceLocatorTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/dependency-injection/ServiceLocator.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/validator/Mapping/Factory/MetadataFactoryInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/validator/Validator/ValidatorInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/validator/ValidatorBuilderInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/validator/ValidatorBuilder.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/validator/Validation.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/validator/ConstraintValidatorFactoryInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/validator/ContainerConstraintValidatorFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/translation-contracts/LocaleAwareInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/translation/TranslatorInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/translation-contracts/TranslatorInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/validator/Util/LegacyTranslatorProxy.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/cache/Traits/ProxyTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/cache/Traits/PhpArrayTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/cache/Adapter/PhpArrayAdapter.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/validator/ObjectInitializerInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/doctrine-bridge/Validator/DoctrineInitializer.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/validator/Mapping/Loader/LoaderInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/validator/Mapping/Loader/AutoMappingTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/validator/Mapping/Loader/PropertyInfoLoader.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/doctrine-bridge/Validator/DoctrineLoader.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/EventListener/DebugHandlersListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/psr/log/Psr/Log/LoggerInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/monolog/monolog/src/Monolog/ResettableInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/monolog/monolog/src/Monolog/Logger.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/Log/DebugLoggerInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/monolog-bridge/Logger.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/Debug/FileLinkFormatter.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/stopwatch/Stopwatch.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/routing/RequestContext.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/EventListener/RouterListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/annotations/lib/Doctrine/Common/Annotations/Reader.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/annotations/lib/Doctrine/Common/Annotations/AnnotationReader.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/annotations/lib/Doctrine/Common/Annotations/AnnotationRegistry.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/SerializerInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Normalizer/NormalizerInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Normalizer/ContextAwareNormalizerInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Normalizer/DenormalizerInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Normalizer/ContextAwareDenormalizerInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Encoder/EncoderInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Encoder/ContextAwareEncoderInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Encoder/DecoderInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Encoder/ContextAwareDecoderInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Serializer.php';
            include_once \dirname(__DIR__, 4).'/src/Serializer/GeoJsonOccurrenceNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/SerializerAwareInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Normalizer/CacheableSupportsMethodInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Normalizer/ObjectToPopulateTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/SerializerAwareTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Normalizer/AbstractNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Normalizer/AbstractObjectNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Util/ClassInfoTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Serializer/ContextTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Serializer/InputOutputMetadataTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Serializer/AbstractItemNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Serializer/ItemNormalizer.php';
            include_once \dirname(__DIR__, 4).'/src/Serializer/JsonPatchOccurrenceNormalizer.php';
            include_once \dirname(__DIR__, 4).'/src/Serializer/PdfOccurrenceNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Swagger/Serializer/ApiGatewayNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Api/FilterLocatorTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Swagger/Serializer/DocumentationNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/PathResolver/OperationPathResolverInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Bridge/Symfony/Routing/RouterOperationPathResolver.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/JsonApi/Serializer/ConstraintViolationListNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/NameConverter/NameConverterInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/NameConverter/AdvancedNameConverterInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/JsonApi/Serializer/ReservedAttributeNameConverter.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Serializer/AbstractConstraintViolationListNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Hydra/Serializer/ConstraintViolationListNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Problem/Serializer/ConstraintViolationListNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Problem/Serializer/ErrorNormalizerTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/JsonApi/Serializer/ErrorNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/JsonApi/Serializer/EntrypointNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Hydra/Serializer/DocumentationNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Hydra/Serializer/EntrypointNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Hydra/Serializer/ErrorNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Hal/Serializer/EntrypointNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Problem/Serializer/ErrorNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Normalizer/ProblemNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Serializer/CacheKeyTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/JsonApi/Serializer/ItemNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/JsonLd/Serializer/JsonLdContextTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/JsonLd/Serializer/ItemNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Hal/Serializer/ItemNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Normalizer/JsonSerializableNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Normalizer/DateTimeNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Normalizer/ConstraintViolationListNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Normalizer/DateTimeZoneNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Normalizer/DateIntervalNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Normalizer/DataUriNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Normalizer/NormalizerAwareInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Normalizer/NormalizerAwareTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Serializer/AbstractCollectionNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/JsonApi/Serializer/CollectionNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Hydra/Serializer/CollectionFiltersNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Hydra/Serializer/PartialCollectionViewNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Hydra/Serializer/CollectionNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Hal/Serializer/CollectionNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Normalizer/ArrayDenormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/JsonApi/Serializer/ObjectNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Normalizer/ObjectNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Mapping/ClassDiscriminatorResolverInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Mapping/ClassDiscriminatorFromClassMetadata.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/JsonLd/Serializer/ObjectNormalizer.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Hal/Serializer/ObjectNormalizer.php';
            include_once \dirname(__DIR__, 4).'/src/Serializer/GeoJsonOccurrenceEncoder.php';
            include_once \dirname(__DIR__, 4).'/src/Serializer/JsonPatchOccurrenceEncoder.php';
            include_once \dirname(__DIR__, 4).'/src/Serializer/PdfOccurrenceEncoder.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Encoder/NormalizationAwareInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Encoder/XmlEncoder.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Encoder/JsonEncoder.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Encoder/YamlEncoder.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Encoder/CsvEncoder.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Serializer/JsonEncoder.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Mapping/Factory/ClassMetadataFactoryInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Mapping/Factory/ClassResolverTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Mapping/Factory/CacheClassMetadataFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Mapping/Factory/ClassMetadataFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Mapping/Loader/LoaderInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Mapping/Loader/LoaderChain.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/Mapping/Loader/AnnotationLoader.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/serializer/NameConverter/MetadataAwareNameConverter.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/property-info/PropertyTypeExtractorInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/property-info/PropertyDescriptionExtractorInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/property-info/PropertyAccessExtractorInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/property-info/PropertyListExtractorInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/property-info/PropertyInfoExtractorInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/property-info/PropertyInitializableExtractorInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/property-info/PropertyInfoCacheExtractor.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/property-info/PropertyInfoExtractor.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/web-link/EventListener/AddLinkHeaderListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/mime/MimeTypeGuesserInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/mime/MimeTypesInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/mime/MimeTypes.php';
            include_once \dirname(__DIR__, 4).'/vendor/twig/twig/src/Environment.php';
            include_once \dirname(__DIR__, 4).'/vendor/twig/twig/src/Loader/LoaderInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/twig/twig/src/Loader/ExistsLoaderInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/twig/twig/src/Loader/SourceContextLoaderInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/twig/twig/src/Loader/FilesystemLoader.php';
            include_once \dirname(__DIR__, 4).'/vendor/twig/twig/src/Extension/ExtensionInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/twig/twig/src/Extension/AbstractExtension.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/twig-bridge/Extension/CsrfExtension.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/twig-bridge/Extension/TranslationExtension.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/twig-bridge/Extension/AssetExtension.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/asset/Packages.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/asset/PackageInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/asset/Package.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/asset/PathPackage.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/asset/VersionStrategy/VersionStrategyInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/asset/VersionStrategy/EmptyVersionStrategy.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/asset/Context/ContextInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/asset/Context/RequestStackContext.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/twig-bridge/Extension/CodeExtension.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/twig-bridge/Extension/RoutingExtension.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/twig-bridge/Extension/YamlExtension.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/twig-bridge/Extension/StopwatchExtension.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/twig-bridge/Extension/ExpressionExtension.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/twig-bridge/Extension/HttpKernelExtension.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/twig-bridge/Extension/HttpFoundationExtension.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/http-foundation/UrlHelper.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/twig-bridge/Extension/WebLinkExtension.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/twig-bridge/Extension/FormExtension.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/twig-bridge/Extension/LogoutUrlExtension.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/twig-bridge/Extension/SecurityExtension.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/doctrine-bundle/Twig/DoctrineExtension.php';
            include_once \dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Twig/Extension/UploaderExtension.php';
            include_once \dirname(__DIR__, 4).'/vendor/jms/serializer/src/JMS/Serializer/Twig/SerializerRuntimeExtension.php';
            include_once \dirname(__DIR__, 4).'/vendor/liip/imagine-bundle/Templating/FilterTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/liip/imagine-bundle/Templating/FilterExtension.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/twig-bridge/AppVariable.php';
            include_once \dirname(__DIR__, 4).'/vendor/twig/twig/src/RuntimeLoader/RuntimeLoaderInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/twig/twig/src/RuntimeLoader/ContainerRuntimeLoader.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/twig-bundle/DependencyInjection/Configurator/EnvironmentConfigurator.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/security/Core/Authorization/AuthorizationCheckerInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/security/Core/Authorization/AuthorizationChecker.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/security/Core/Authentication/Token/Storage/TokenStorageInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/service-contracts/ServiceSubscriberInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/security/Core/Authentication/Token/Storage/UsageTrackingTokenStorage.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/security/Core/Authentication/Token/Storage/TokenStorage.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/security/Core/Security.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/security/Core/Authentication/AuthenticationManagerInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/security/Core/Authentication/AuthenticationProviderManager.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/security/Core/Authentication/AuthenticationTrustResolverInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/security/Core/Authentication/AuthenticationTrustResolver.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/expression-language/ExpressionLanguage.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/security/Core/Authorization/ExpressionLanguage.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/security/Core/Authorization/AccessDecisionManagerInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/security/Core/Authorization/AccessDecisionManager.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/security/Core/Role/RoleHierarchyInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/security/Core/Role/RoleHierarchy.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/security/Http/Firewall.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/security-bundle/EventListener/FirewallListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/security/Http/FirewallMapInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/security-bundle/Security/FirewallMap.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/security/Http/Logout/LogoutUrlGenerator.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/security/Http/RememberMe/ResponseListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/nelmio/cors-bundle/EventListener/CorsListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/nelmio/cors-bundle/Options/ResolverInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/nelmio/cors-bundle/Options/Resolver.php';
            include_once \dirname(__DIR__, 4).'/vendor/nelmio/cors-bundle/Options/ProviderInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/nelmio/cors-bundle/Options/ConfigProvider.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/persistence/lib/Doctrine/Persistence/ConnectionRegistry.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/persistence/lib/Doctrine/Persistence/ManagerRegistry.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/persistence/lib/Doctrine/Persistence/AbstractManagerRegistry.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/doctrine-bridge/ManagerRegistry.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/doctrine-bundle/Registry.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/dbal/lib/Doctrine/DBAL/Driver/Connection.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/dbal/lib/Doctrine/DBAL/Connection.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/doctrine-bundle/ConnectionFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/dbal/lib/Doctrine/DBAL/Configuration.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/event-manager/lib/Doctrine/Common/EventManager.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/doctrine-bridge/ContainerAwareEventManager.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/event-manager/lib/Doctrine/Common/EventSubscriber.php';
            include_once \dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/EventListener/Doctrine/BaseListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/EventListener/Doctrine/CleanListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Adapter/AdapterInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Adapter/ORM/DoctrineORMAdapter.php';
            include_once \dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/EventListener/Doctrine/RemoveListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/EventListener/Doctrine/UploadListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/persistence/lib/Doctrine/Persistence/ObjectManager.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/orm/lib/Doctrine/ORM/EntityManagerInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/orm/lib/Doctrine/ORM/EntityManager.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/orm/lib/Doctrine/ORM/Configuration.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/cache/lib/Doctrine/Common/Cache/Cache.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/cache/lib/Doctrine/Common/Cache/FlushableCache.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/cache/lib/Doctrine/Common/Cache/ClearableCache.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/cache/lib/Doctrine/Common/Cache/MultiGetCache.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/cache/lib/Doctrine/Common/Cache/MultiDeleteCache.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/cache/lib/Doctrine/Common/Cache/MultiPutCache.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/cache/lib/Doctrine/Common/Cache/MultiOperationCache.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/cache/lib/Doctrine/Common/Cache/CacheProvider.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/cache/DoctrineProvider.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/persistence/lib/Doctrine/Persistence/Mapping/Driver/MappingDriver.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/persistence/lib/Doctrine/Persistence/Mapping/Driver/MappingDriverChain.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/persistence/lib/Doctrine/Persistence/Mapping/Driver/AnnotationDriver.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/AnnotationDriver.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/NamingStrategy.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/UnderscoreNamingStrategy.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/QuoteStrategy.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/DefaultQuoteStrategy.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/EntityListenerResolver.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/doctrine-bundle/Mapping/EntityListenerServiceResolver.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/doctrine-bundle/Mapping/ContainerEntityListenerResolver.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/orm/lib/Doctrine/ORM/Repository/RepositoryFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/doctrine-bundle/Repository/ContainerRepositoryFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/doctrine-bundle/ManagerConfigurator.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Api/ResourceClassResolverInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Api/ResourceClassResolver.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/routing/RequestContextAwareInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/routing/Matcher/UrlMatcherInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/routing/Generator/UrlGeneratorInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/routing/RouterInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Api/UrlGeneratorInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Bridge/Symfony/Routing/Router.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Api/IriConverterInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Util/ResourceClassInfoTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/DataProvider/OperationDataProviderTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Bridge/Symfony/Routing/IriConverter.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Bridge/Symfony/Routing/RouteNameResolverInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Cache/CachedTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Bridge/Symfony/Routing/CachedRouteNameResolver.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Bridge/Symfony/Routing/RouteNameResolver.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Serializer/SerializerContextBuilderInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Serializer/SerializerFilterContextBuilder.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Serializer/SerializerContextBuilder.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/PathResolver/CustomOperationPathResolver.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/PathResolver/OperationPathResolver.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Operation/PathSegmentNameGeneratorInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Operation/UnderscorePathSegmentNameGenerator.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/EventListener/AddFormatListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/willdurand/negotiation/src/Negotiation/AbstractNegotiator.php';
            include_once \dirname(__DIR__, 4).'/vendor/willdurand/negotiation/src/Negotiation/Negotiator.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Util/CloneTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Resource/ToggleableOperationAttributeTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/EventListener/ReadListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/DataProvider/CollectionDataProviderInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/DataProvider/ContextAwareCollectionDataProviderInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/DataProvider/ChainCollectionDataProvider.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/EventListener/DeserializeListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Api/IdentifiersExtractorInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Api/CachedIdentifiersExtractor.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Api/IdentifiersExtractor.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Identifier/IdentifierConverterInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Identifier/ContextAwareIdentifierConverterInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Identifier/IdentifierConverter.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Operation/Factory/SubresourceOperationFactoryInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Operation/Factory/CachedSubresourceOperationFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Operation/Factory/SubresourceOperationFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/DataProvider/ItemDataProviderInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/DataProvider/ChainItemDataProvider.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/DataProvider/SubresourceDataProviderInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/DataProvider/ChainSubresourceDataProvider.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Resource/Factory/ResourceNameCollectionFactoryInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Resource/Factory/CachedResourceNameCollectionFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Resource/Factory/ExtractorResourceNameCollectionFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Resource/Factory/AnnotationResourceNameCollectionFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Resource/Factory/ResourceMetadataFactoryInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Resource/Factory/CachedResourceMetadataFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Resource/Factory/FormatsResourceMetadataFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Resource/Factory/OperationResourceMetadataFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Util/AnnotationFilterExtractorTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Resource/Factory/AnnotationResourceFilterMetadataFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Resource/Factory/ShortNameResourceMetadataFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Resource/Factory/PhpDocResourceMetadataFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Resource/Factory/InputOutputResourceMetadataFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Resource/Factory/ExtractorResourceMetadataFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Resource/Factory/AnnotationResourceMetadataFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Property/Factory/PropertyNameCollectionFactoryInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Property/Factory/CachedPropertyNameCollectionFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Property/Factory/ExtractorPropertyNameCollectionFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Property/Factory/InheritedPropertyNameCollectionFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Bridge/Symfony/PropertyInfo/Metadata/Property/PropertyInfoPropertyNameCollectionFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Property/Factory/PropertyMetadataFactoryInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Property/Factory/CachedPropertyMetadataFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Bridge/Symfony/Validator/Metadata/Property/ValidatorPropertyMetadataFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Property/Factory/ExtractorPropertyMetadataFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Property/Factory/AnnotationPropertyMetadataFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Property/Factory/AnnotationSubresourceMetadataFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Property/Factory/SerializerPropertyMetadataFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Bridge/Doctrine/Orm/Metadata/Property/DoctrineOrmPropertyMetadataFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Property/Factory/InheritedPropertyMetadataFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Bridge/Symfony/PropertyInfo/Metadata/Property/PropertyInfoPropertyMetadataFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Extractor/ExtractorInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Extractor/AbstractExtractor.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Extractor/XmlExtractor.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Metadata/Extractor/YamlExtractor.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/JsonSchema/TypeFactoryInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/JsonSchema/TypeFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Bridge/Symfony/Bundle/EventListener/SwaggerUiListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/JsonApi/EventListener/TransformPaginationParametersListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/JsonApi/EventListener/TransformSortingParametersListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/JsonApi/EventListener/TransformFieldsetsParametersListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/JsonApi/EventListener/TransformFilteringParametersListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/JsonLd/ContextBuilderInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/JsonLd/AnonymousContextBuilderInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/JsonLd/ContextBuilder.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Util/CorsTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Hydra/EventListener/AddLinkHeaderListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/JsonSchema/SchemaFactoryInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Hydra/JsonSchema/SchemaFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/JsonSchema/SchemaFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/HttpCache/EventListener/AddHeadersListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Filter/QueryParameterValidateListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Security/EventListener/DenyAccessListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Security/ResourceAccessCheckerInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Security/ResourceAccessChecker.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/expression-language/ExpressionFunctionProviderInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Security/Core/Authorization/ExpressionLanguageProvider.php';
            include_once \dirname(__DIR__, 4).'/vendor/friendsofsymfony/elastica-bundle/src/Manager/RepositoryManagerInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/friendsofsymfony/elastica-bundle/src/Manager/RepositoryManager.php';
            include_once \dirname(__DIR__, 4).'/vendor/ruflin/elastica/lib/Elastica/Client.php';
            include_once \dirname(__DIR__, 4).'/vendor/friendsofsymfony/elastica-bundle/src/Elastica/Client.php';
            include_once \dirname(__DIR__, 4).'/vendor/ruflin/elastica/lib/Elastica/SearchableInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/ruflin/elastica/lib/Elastica/Index.php';
            include_once \dirname(__DIR__, 4).'/vendor/friendsofsymfony/elastica-bundle/src/Elastica/Index.php';
            include_once \dirname(__DIR__, 4).'/vendor/ruflin/elastica/lib/Elastica/Type.php';
            include_once \dirname(__DIR__, 4).'/vendor/friendsofsymfony/elastica-bundle/src/Doctrine/RepositoryManager.php';
            include_once \dirname(__DIR__, 4).'/vendor/friendsofsymfony/elastica-bundle/src/Finder/FinderInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/friendsofsymfony/elastica-bundle/src/Finder/PaginatedFinderInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/friendsofsymfony/elastica-bundle/src/Finder/TransformedFinder.php';
            include_once \dirname(__DIR__, 4).'/vendor/friendsofsymfony/elastica-bundle/src/Transformer/ElasticaToModelTransformerInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/friendsofsymfony/elastica-bundle/src/Transformer/AbstractElasticaToModelTransformer.php';
            include_once \dirname(__DIR__, 4).'/vendor/friendsofsymfony/elastica-bundle/src/Doctrine/AbstractElasticaToModelTransformer.php';
            include_once \dirname(__DIR__, 4).'/vendor/friendsofsymfony/elastica-bundle/src/Doctrine/ORM/ElasticaToModelTransformer.php';
            include_once \dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Storage/StorageInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Storage/AbstractStorage.php';
            include_once \dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Storage/FileSystemStorage.php';
            include_once \dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Metadata/MetadataReader.php';
            include_once \dirname(__DIR__, 4).'/vendor/jms/metadata/src/Metadata/MetadataFactoryInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/jms/metadata/src/Metadata/AdvancedMetadataFactoryInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/jms/metadata/src/Metadata/MetadataFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/jms/metadata/src/Metadata/Driver/DriverInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/jms/metadata/src/Metadata/Driver/AdvancedDriverInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/jms/metadata/src/Metadata/Driver/DriverChain.php';
            include_once \dirname(__DIR__, 4).'/vendor/jms/metadata/src/Metadata/Driver/AbstractFileDriver.php';
            include_once \dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Metadata/Driver/XmlDriver.php';
            include_once \dirname(__DIR__, 4).'/vendor/jms/metadata/src/Metadata/Driver/FileLocatorInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/jms/metadata/src/Metadata/Driver/AdvancedFileLocatorInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/jms/metadata/src/Metadata/Driver/FileLocator.php';
            include_once \dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Metadata/Driver/AnnotationDriver.php';
            include_once \dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Metadata/Driver/YamlDriver.php';
            include_once \dirname(__DIR__, 4).'/vendor/jms/metadata/src/Metadata/Cache/CacheInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/jms/metadata/src/Metadata/Cache/FileCache.php';
            include_once \dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Mapping/PropertyMappingFactory.php';
            include_once \dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Handler/AbstractHandler.php';
            include_once \dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Handler/UploadHandler.php';
            include_once \dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Injector/FileInjectorInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Injector/FileInjector.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/templating/Helper/HelperInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/templating/Helper/Helper.php';
            include_once \dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Templating/Helper/UploaderHelper.php';
            include_once \dirname(__DIR__, 4).'/vendor/sensio/framework-extra-bundle/src/EventListener/ControllerListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/sensio/framework-extra-bundle/src/EventListener/ParamConverterListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/sensio/framework-extra-bundle/src/Request/ParamConverter/ParamConverterManager.php';
            include_once \dirname(__DIR__, 4).'/vendor/sensio/framework-extra-bundle/src/Request/ParamConverter/ParamConverterInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/sensio/framework-extra-bundle/src/Request/ParamConverter/DoctrineParamConverter.php';
            include_once \dirname(__DIR__, 4).'/vendor/sensio/framework-extra-bundle/src/Request/ParamConverter/DateTimeParamConverter.php';
            include_once \dirname(__DIR__, 4).'/vendor/sensio/framework-extra-bundle/src/EventListener/TemplateListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/sensio/framework-extra-bundle/src/Templating/TemplateGuesser.php';
            include_once \dirname(__DIR__, 4).'/vendor/sensio/framework-extra-bundle/src/EventListener/HttpCacheListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/sensio/framework-extra-bundle/src/EventListener/SecurityListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/sensio/framework-extra-bundle/src/Security/ExpressionLanguage.php';
            include_once \dirname(__DIR__, 4).'/vendor/sensio/framework-extra-bundle/src/EventListener/IsGrantedListener.php';
            include_once \dirname(__DIR__, 4).'/vendor/sensio/framework-extra-bundle/src/Request/ArgumentNameConverter.php';
            include_once \dirname(__DIR__, 4).'/vendor/monolog/monolog/src/Monolog/Handler/HandlerInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/monolog/monolog/src/Monolog/Handler/AbstractHandler.php';
            include_once \dirname(__DIR__, 4).'/vendor/monolog/monolog/src/Monolog/Handler/FingersCrossedHandler.php';
            include_once \dirname(__DIR__, 4).'/vendor/monolog/monolog/src/Monolog/Handler/AbstractProcessingHandler.php';
            include_once \dirname(__DIR__, 4).'/vendor/monolog/monolog/src/Monolog/Handler/StreamHandler.php';
            include_once \dirname(__DIR__, 4).'/vendor/monolog/monolog/src/Monolog/Handler/FingersCrossed/ActivationStrategyInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/monolog/monolog/src/Monolog/Handler/FingersCrossed/ErrorLevelActivationStrategy.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/monolog-bridge/Handler/FingersCrossed/NotFoundActivationStrategy.php';
            include_once \dirname(__DIR__, 4).'/vendor/monolog/monolog/src/Monolog/Processor/ProcessorInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/monolog/monolog/src/Monolog/Processor/PsrLogMessageProcessor.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/monolog-bridge/Handler/ConsoleHandler.php';
            include_once \dirname(__DIR__, 4).'/vendor/monolog/monolog/src/Monolog/Handler/FilterHandler.php';
            include_once \dirname(__DIR__, 4).'/vendor/liip/imagine-bundle/Imagine/Cache/Resolver/ResolverInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/liip/imagine-bundle/Imagine/Cache/Resolver/WebPathResolver.php';
            include_once \dirname(__DIR__, 4).'/vendor/liip/imagine-bundle/Imagine/Cache/CacheManager.php';
            include_once \dirname(__DIR__, 4).'/vendor/liip/imagine-bundle/Imagine/Filter/FilterConfiguration.php';
            include_once \dirname(__DIR__, 4).'/vendor/liip/imagine-bundle/Imagine/Cache/Resolver/NoCacheWebPathResolver.php';
            include_once \dirname(__DIR__, 4).'/vendor/liip/imagine-bundle/Imagine/Cache/SignerInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/liip/imagine-bundle/Imagine/Cache/Signer.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/translation/TranslatorBagInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/translation/Translator.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/CacheWarmer/WarmableInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Translation/Translator.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/translation/Formatter/MessageFormatterInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/translation/Formatter/IntlFormatterInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/translation/Formatter/ChoiceMessageFormatterInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/translation/Formatter/MessageFormatter.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/translation-contracts/TranslatorTrait.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/translation/IdentityTranslator.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/routing/Matcher/RequestMatcherInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/routing/Router.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/dependency-injection/ServiceSubscriberInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/DependencyInjection/CompatibilityServiceSubscriberInterface.php';
            include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Routing/Router.php';
            include_once \dirname(__DIR__, 4).'/vendor/doctrine/annotations/lib/Doctrine/Common/Annotations/CachedReader.php';
        };
    }

    public function compile(): void
    {
        throw new LogicException('You cannot compile a dumped container that was already compiled.');
    }

    public function isCompiled(): bool
    {
        return true;
    }

    public function getRemovedIds(): array
    {
        return require $this->containerDir.\DIRECTORY_SEPARATOR.'removed-ids.php';
    }

    protected function load($file, $lazyLoad = true)
    {
        return require $this->containerDir.\DIRECTORY_SEPARATOR.$file;
    }

    /*
     * Gets the public 'doctrine' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Registry
     */
    protected function getDoctrineService()
    {
        return $this->services['doctrine'] = new \Doctrine\Bundle\DoctrineBundle\Registry($this, $this->parameters['doctrine.connections'], $this->parameters['doctrine.entity_managers'], 'default', 'default');
    }

    /*
     * Gets the public 'doctrine.dbal.default_connection' shared service.
     *
     * @return \Doctrine\DBAL\Connection
     */
    protected function getDoctrine_Dbal_DefaultConnectionService()
    {
        $a = new \Symfony\Bridge\Doctrine\ContainerAwareEventManager(new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($this->getService, [
            'app.event.listener.occurrence.event.listener' => ['privates', 'app.event.listener.occurrence.event.listener', 'getApp_Event_Listener_Occurrence_Event_ListenerService.php', true],
            'app.event.listener.occurrence.user.occurrence.tag.relation.event.listener' => ['privates', 'app.event.listener.occurrence.user.occurrence.tag.relation.event.listener', 'getApp_Event_Listener_Occurrence_User_Occurrence_Tag_Relation_Event_ListenerService.php', true],
            'app.event.listener.owned.entity.event.listener' => ['privates', 'app.event.listener.owned.entity.event.listener', 'getApp_Event_Listener_Owned_Entity_Event_ListenerService.php', true],
            'app.event.listener.pdf.file.event.listener' => ['privates', 'app.event.listener.pdf.file.event.listener', 'getApp_Event_Listener_Pdf_File_Event_ListenerService.php', true],
            'app.event.listener.photo.event.listener' => ['privates', 'app.event.listener.photo.event.listener', 'getApp_Event_Listener_Photo_Event_ListenerService.php', true],
            'app.event.listener.photo.photo.tag.relation.event.listener' => ['privates', 'app.event.listener.photo.photo.tag.relation.event.listener', 'getApp_Event_Listener_Photo_Photo_Tag_Relation_Event_ListenerService.php', true],
            'app.event.listener.timestamped.entity.event.listener' => ['privates', 'app.event.listener.timestamped.entity.event.listener', 'getApp_Event_Listener_Timestamped_Entity_Event_ListenerService.php', true],
            'doctrine.orm.default_listeners.attach_entity_listeners' => ['privates', 'doctrine.orm.default_listeners.attach_entity_listeners', 'getDoctrine_Orm_DefaultListeners_AttachEntityListenersService.php', true],
            'fos_elastica.listener.biblio_phytos.biblio_phyto' => ['privates', 'fos_elastica.listener.biblio_phytos.biblio_phyto', 'getFosElastica_Listener_BiblioPhytos_BiblioPhytoService.php', true],
            'fos_elastica.listener.observers.observer' => ['privates', 'fos_elastica.listener.observers.observer', 'getFosElastica_Listener_Observers_ObserverService.php', true],
            'fos_elastica.listener.occurrences.occurrence' => ['privates', 'fos_elastica.listener.occurrences.occurrence', 'getFosElastica_Listener_Occurrences_OccurrenceService.php', true],
            'fos_elastica.listener.photos.photo' => ['privates', 'fos_elastica.listener.photos.photo', 'getFosElastica_Listener_Photos_PhotoService.php', true],
            'fos_elastica.listener.tables.table' => ['privates', 'fos_elastica.listener.tables.table', 'getFosElastica_Listener_Tables_TableService.php', true],
        ], [
            'app.event.listener.occurrence.event.listener' => '?',
            'app.event.listener.occurrence.user.occurrence.tag.relation.event.listener' => '?',
            'app.event.listener.owned.entity.event.listener' => '?',
            'app.event.listener.pdf.file.event.listener' => '?',
            'app.event.listener.photo.event.listener' => '?',
            'app.event.listener.photo.photo.tag.relation.event.listener' => '?',
            'app.event.listener.timestamped.entity.event.listener' => '?',
            'doctrine.orm.default_listeners.attach_entity_listeners' => '?',
            'fos_elastica.listener.biblio_phytos.biblio_phyto' => '?',
            'fos_elastica.listener.observers.observer' => '?',
            'fos_elastica.listener.occurrences.occurrence' => '?',
            'fos_elastica.listener.photos.photo' => '?',
            'fos_elastica.listener.tables.table' => '?',
        ]));

        $b = new \Vich\UploaderBundle\Adapter\ORM\DoctrineORMAdapter();
        $c = ($this->privates['vich_uploader.metadata_reader'] ?? $this->getVichUploader_MetadataReaderService());
        $d = ($this->services['vich_uploader.upload_handler'] ?? $this->getVichUploader_UploadHandlerService());

        $a->addEventSubscriber(new \Vich\UploaderBundle\EventListener\Doctrine\CleanListener('media_object', $b, $c, $d));
        $a->addEventSubscriber(new \Vich\UploaderBundle\EventListener\Doctrine\RemoveListener('media_object', $b, $c, $d));
        $a->addEventSubscriber(new \Vich\UploaderBundle\EventListener\Doctrine\UploadListener('media_object', $b, $c, $d));
        $a->addEventListener([0 => 'prePersist'], 'app.event.listener.occurrence.event.listener');
        $a->addEventListener([0 => 'preUpdate'], 'app.event.listener.occurrence.event.listener');
        $a->addEventListener([0 => 'preRemove'], 'app.event.listener.occurrence.event.listener');
        $a->addEventListener([0 => 'prePersist'], 'app.event.listener.photo.event.listener');
        $a->addEventListener([0 => 'postPersist'], 'app.event.listener.photo.event.listener');
        $a->addEventListener([0 => 'prePersist'], 'app.event.listener.pdf.file.event.listener');
        $a->addEventListener([0 => 'prePersist'], 'app.event.listener.owned.entity.event.listener');
        $a->addEventListener([0 => 'prePersist'], 'app.event.listener.timestamped.entity.event.listener');
        $a->addEventListener([0 => 'preUpdate'], 'app.event.listener.timestamped.entity.event.listener');
        $a->addEventListener([0 => 'postPersist'], 'app.event.listener.photo.photo.tag.relation.event.listener');
        $a->addEventListener([0 => 'postRemove'], 'app.event.listener.photo.photo.tag.relation.event.listener');
        $a->addEventListener([0 => 'postPersist'], 'app.event.listener.occurrence.user.occurrence.tag.relation.event.listener');
        $a->addEventListener([0 => 'postRemove'], 'app.event.listener.occurrence.user.occurrence.tag.relation.event.listener');
        $a->addEventListener([0 => 'loadClassMetadata'], 'doctrine.orm.default_listeners.attach_entity_listeners');
        $a->addEventListener([0 => 'postPersist'], 'fos_elastica.listener.occurrences.occurrence');
        $a->addEventListener([0 => 'postUpdate'], 'fos_elastica.listener.occurrences.occurrence');
        $a->addEventListener([0 => 'preRemove'], 'fos_elastica.listener.occurrences.occurrence');
        $a->addEventListener([0 => 'postFlush'], 'fos_elastica.listener.occurrences.occurrence');
        $a->addEventListener([0 => 'postPersist'], 'fos_elastica.listener.photos.photo');
        $a->addEventListener([0 => 'postUpdate'], 'fos_elastica.listener.photos.photo');
        $a->addEventListener([0 => 'preRemove'], 'fos_elastica.listener.photos.photo');
        $a->addEventListener([0 => 'postFlush'], 'fos_elastica.listener.photos.photo');
        $a->addEventListener([0 => 'postPersist'], 'fos_elastica.listener.tables.table');
        $a->addEventListener([0 => 'postUpdate'], 'fos_elastica.listener.tables.table');
        $a->addEventListener([0 => 'preRemove'], 'fos_elastica.listener.tables.table');
        $a->addEventListener([0 => 'postFlush'], 'fos_elastica.listener.tables.table');
        $a->addEventListener([0 => 'postPersist'], 'fos_elastica.listener.observers.observer');
        $a->addEventListener([0 => 'postUpdate'], 'fos_elastica.listener.observers.observer');
        $a->addEventListener([0 => 'preRemove'], 'fos_elastica.listener.observers.observer');
        $a->addEventListener([0 => 'postFlush'], 'fos_elastica.listener.observers.observer');
        $a->addEventListener([0 => 'postPersist'], 'fos_elastica.listener.biblio_phytos.biblio_phyto');
        $a->addEventListener([0 => 'postUpdate'], 'fos_elastica.listener.biblio_phytos.biblio_phyto');
        $a->addEventListener([0 => 'preRemove'], 'fos_elastica.listener.biblio_phytos.biblio_phyto');
        $a->addEventListener([0 => 'postFlush'], 'fos_elastica.listener.biblio_phytos.biblio_phyto');

        return $this->services['doctrine.dbal.default_connection'] = (new \Doctrine\Bundle\DoctrineBundle\ConnectionFactory($this->parameters['doctrine.dbal.connection_factory.types']))->createConnection(['driver' => 'pdo_mysql', 'charset' => 'utf8mb4', 'url' => $this->getEnv('resolve:DATABASE_URL'), 'host' => 'localhost', 'port' => NULL, 'user' => 'root', 'password' => NULL, 'driverOptions' => [], 'serverVersion' => '5.7', 'defaultTableOptions' => ['charset' => 'utf8mb4', 'collate' => 'utf8mb4_unicode_ci']], new \Doctrine\DBAL\Configuration(), $a, ['enum' => 'string']);
    }

    /*
     * Gets the public 'doctrine.orm.default_entity_manager' shared service.
     *
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getDoctrine_Orm_DefaultEntityManagerService($lazyLoad = true)
    {
        $a = new \Doctrine\ORM\Configuration();

        $b = new \Symfony\Component\Cache\DoctrineProvider(($this->privates['doctrine.system_cache_pool'] ?? $this->getDoctrine_SystemCachePoolService()));
        $c = new \Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain();

        $d = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver(($this->privates['annotations.cached_reader'] ?? $this->getAnnotations_CachedReaderService()), $this->parameters['api_platform.resource_class_directories']);

        $c->addDriver($d, 'App\\Entity');
        $c->addDriver($d, 'Vich\\UploaderBundle\\Entity');

        $a->setEntityNamespaces(['App' => 'App\\Entity', 'VichUploaderBundle' => 'Vich\\UploaderBundle\\Entity']);
        $a->setMetadataCacheImpl($b);
        $a->setQueryCacheImpl($b);
        $a->setResultCacheImpl(new \Symfony\Component\Cache\DoctrineProvider(($this->privates['doctrine.result_cache_pool'] ?? $this->getDoctrine_ResultCachePoolService())));
        $a->setMetadataDriverImpl($c);
        $a->setProxyDir(($this->targetDir.''.'/doctrine/orm/Proxies'));
        $a->setProxyNamespace('Proxies');
        $a->setAutoGenerateProxyClasses(false);
        $a->setClassMetadataFactoryName('Doctrine\\ORM\\Mapping\\ClassMetadataFactory');
        $a->setDefaultRepositoryClassName('Doctrine\\ORM\\EntityRepository');
        $a->setNamingStrategy(new \Doctrine\ORM\Mapping\UnderscoreNamingStrategy());
        $a->setQuoteStrategy(new \Doctrine\ORM\Mapping\DefaultQuoteStrategy());
        $a->setEntityListenerResolver(new \Doctrine\Bundle\DoctrineBundle\Mapping\ContainerEntityListenerResolver($this));
        $a->setRepositoryFactory(new \Doctrine\Bundle\DoctrineBundle\Repository\ContainerRepositoryFactory(new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($this->getService, [
            'App\\Repository\\BiblioPhytoRepository' => ['privates', 'App\\Repository\\BiblioPhytoRepository', 'getBiblioPhytoRepositoryService.php', true],
            'App\\Repository\\ObserverRepository' => ['privates', 'App\\Repository\\ObserverRepository', 'getObserverRepositoryService.php', true],
            'App\\Repository\\OccurrenceRepository' => ['privates', 'App\\Repository\\OccurrenceRepository', 'getOccurrenceRepositoryService.php', true],
            'App\\Repository\\PdfFileRepository' => ['privates', 'App\\Repository\\PdfFileRepository', 'getPdfFileRepositoryService.php', true],
            'App\\Repository\\PhotoRepository' => ['privates', 'App\\Repository\\PhotoRepository', 'getPhotoRepositoryService.php', true],
            'App\\Repository\\PhotoTagRepository' => ['privates', 'App\\Repository\\PhotoTagRepository', 'getPhotoTagRepositoryService.php', true],
            'App\\Repository\\SyeRepository' => ['privates', 'App\\Repository\\SyeRepository', 'getSyeRepositoryService.php', true],
            'App\\Repository\\SyntheticColumnRepository' => ['privates', 'App\\Repository\\SyntheticColumnRepository', 'getSyntheticColumnRepositoryService.php', true],
            'App\\Repository\\SyntheticItemRepository' => ['privates', 'App\\Repository\\SyntheticItemRepository', 'getSyntheticItemRepositoryService.php', true],
            'App\\Repository\\TableRepository' => ['privates', 'App\\Repository\\TableRepository', 'getTableRepositoryService.php', true],
            'App\\Repository\\TableRowDefinitionRepository' => ['privates', 'App\\Repository\\TableRowDefinitionRepository', 'getTableRowDefinitionRepositoryService.php', true],
            'App\\Repository\\UserOccurrenceTagRepository' => ['privates', 'App\\Repository\\UserOccurrenceTagRepository', 'getUserOccurrenceTagRepositoryService.php', true],
        ], [
            'App\\Repository\\BiblioPhytoRepository' => '?',
            'App\\Repository\\ObserverRepository' => '?',
            'App\\Repository\\OccurrenceRepository' => '?',
            'App\\Repository\\PdfFileRepository' => '?',
            'App\\Repository\\PhotoRepository' => '?',
            'App\\Repository\\PhotoTagRepository' => '?',
            'App\\Repository\\SyeRepository' => '?',
            'App\\Repository\\SyntheticColumnRepository' => '?',
            'App\\Repository\\SyntheticItemRepository' => '?',
            'App\\Repository\\TableRepository' => '?',
            'App\\Repository\\TableRowDefinitionRepository' => '?',
            'App\\Repository\\UserOccurrenceTagRepository' => '?',
        ])));

        $this->services['doctrine.orm.default_entity_manager'] = $instance = \Doctrine\ORM\EntityManager::create(($this->services['doctrine.dbal.default_connection'] ?? $this->getDoctrine_Dbal_DefaultConnectionService()), $a);

        (new \Doctrine\Bundle\DoctrineBundle\ManagerConfigurator([], []))->configure($instance);

        return $instance;
    }

    /*
     * Gets the public 'event_dispatcher' shared service.
     *
     * @return \Symfony\Component\EventDispatcher\EventDispatcher
     */
    protected function getEventDispatcherService()
    {
        $this->services['event_dispatcher'] = $instance = new \Symfony\Component\EventDispatcher\EventDispatcher();

        $instance->addListener('kernel.response', [0 => function () {
            return ($this->privates['app.event.listener.xcount.response.listener'] ?? $this->getApp_Event_Listener_Xcount_Response_ListenerService());
        }, 1 => 'onKernelResponse'], 0);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['nelmio_cors.cors_listener'] ?? $this->getNelmioCors_CorsListenerService());
        }, 1 => 'onKernelRequest'], 250);
        $instance->addListener('kernel.response', [0 => function () {
            return ($this->privates['nelmio_cors.cors_listener'] ?? $this->getNelmioCors_CorsListenerService());
        }, 1 => 'onKernelResponse'], 0);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['api_platform.listener.request.add_format'] ?? $this->getApiPlatform_Listener_Request_AddFormatService());
        }, 1 => 'onKernelRequest'], 7);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['api_platform.listener.request.read'] ?? $this->getApiPlatform_Listener_Request_ReadService());
        }, 1 => 'onKernelRequest'], 4);
        $instance->addListener('kernel.view', [0 => function () {
            return ($this->privates['api_platform.listener.view.write'] ?? $this->load('getApiPlatform_Listener_View_WriteService.php'));
        }, 1 => 'onKernelView'], 32);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['api_platform.listener.request.deserialize'] ?? $this->getApiPlatform_Listener_Request_DeserializeService());
        }, 1 => 'onKernelRequest'], 2);
        $instance->addListener('kernel.view', [0 => function () {
            return ($this->privates['api_platform.listener.view.serialize'] ?? $this->load('getApiPlatform_Listener_View_SerializeService.php'));
        }, 1 => 'onKernelView'], 16);
        $instance->addListener('kernel.view', [0 => function () {
            return ($this->privates['api_platform.listener.view.respond'] ?? $this->load('getApiPlatform_Listener_View_RespondService.php'));
        }, 1 => 'onKernelView'], 8);
        $instance->addListener('kernel.exception', [0 => function () {
            return ($this->privates['api_platform.listener.exception.validation'] ?? $this->load('getApiPlatform_Listener_Exception_ValidationService.php'));
        }, 1 => 'onKernelException'], 0);
        $instance->addListener('kernel.exception', [0 => function () {
            return ($this->privates['api_platform.listener.exception'] ?? $this->load('getApiPlatform_Listener_ExceptionService.php'));
        }, 1 => 'onKernelException'], -96);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['api_platform.swagger.listener.ui'] ?? ($this->privates['api_platform.swagger.listener.ui'] = new \ApiPlatform\Core\Bridge\Symfony\Bundle\EventListener\SwaggerUiListener()));
        }, 1 => 'onKernelRequest'], 0);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['api_platform.jsonapi.listener.request.transform_pagination_parameters'] ?? ($this->privates['api_platform.jsonapi.listener.request.transform_pagination_parameters'] = new \ApiPlatform\Core\JsonApi\EventListener\TransformPaginationParametersListener()));
        }, 1 => 'onKernelRequest'], 5);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['api_platform.jsonapi.listener.request.transform_sorting_parameters'] ?? ($this->privates['api_platform.jsonapi.listener.request.transform_sorting_parameters'] = new \ApiPlatform\Core\JsonApi\EventListener\TransformSortingParametersListener('order')));
        }, 1 => 'onKernelRequest'], 5);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['api_platform.jsonapi.listener.request.transform_fieldsets_parameters'] ?? $this->getApiPlatform_Jsonapi_Listener_Request_TransformFieldsetsParametersService());
        }, 1 => 'onKernelRequest'], 5);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['api_platform.jsonapi.listener.request.transform_filtering_parameters'] ?? ($this->privates['api_platform.jsonapi.listener.request.transform_filtering_parameters'] = new \ApiPlatform\Core\JsonApi\EventListener\TransformFilteringParametersListener()));
        }, 1 => 'onKernelRequest'], 5);
        $instance->addListener('kernel.response', [0 => function () {
            return ($this->privates['api_platform.hydra.listener.response.add_link_header'] ?? $this->getApiPlatform_Hydra_Listener_Response_AddLinkHeaderService());
        }, 1 => 'onKernelResponse'], 0);
        $instance->addListener('kernel.response', [0 => function () {
            return ($this->privates['api_platform.http_cache.listener.response.configure'] ?? $this->getApiPlatform_HttpCache_Listener_Response_ConfigureService());
        }, 1 => 'onKernelResponse'], -1);
        $instance->addListener('kernel.view', [0 => function () {
            return ($this->privates['api_platform.listener.view.validate'] ?? $this->load('getApiPlatform_Listener_View_ValidateService.php'));
        }, 1 => 'onKernelView'], 64);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['api_platform.listener.view.validate_query_parameters'] ?? $this->getApiPlatform_Listener_View_ValidateQueryParametersService());
        }, 1 => 'onKernelRequest'], 16);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['api_platform.security.listener.request.deny_access'] ?? $this->getApiPlatform_Security_Listener_Request_DenyAccessService());
        }, 1 => 'onSecurity'], 3);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['api_platform.security.listener.request.deny_access'] ?? $this->getApiPlatform_Security_Listener_Request_DenyAccessService());
        }, 1 => 'onSecurityPostDenormalize'], 1);
        $instance->addListener('elastica.index.index_post_populate', [0 => function () {
            return ($this->privates['fos_elastica.populate_listener'] ?? $this->load('getFosElastica_PopulateListenerService.php'));
        }, 1 => 'onPostIndexPopulate'], -9999);
        $instance->addListener('kernel.response', [0 => function () {
            return ($this->privates['response_listener'] ?? ($this->privates['response_listener'] = new \Symfony\Component\HttpKernel\EventListener\ResponseListener('UTF-8')));
        }, 1 => 'onKernelResponse'], 0);
        $instance->addListener('kernel.response', [0 => function () {
            return ($this->privates['streamed_response_listener'] ?? ($this->privates['streamed_response_listener'] = new \Symfony\Component\HttpKernel\EventListener\StreamedResponseListener()));
        }, 1 => 'onKernelResponse'], -1024);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['locale_listener'] ?? $this->getLocaleListenerService());
        }, 1 => 'setDefaultLocale'], 100);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['locale_listener'] ?? $this->getLocaleListenerService());
        }, 1 => 'onKernelRequest'], 16);
        $instance->addListener('kernel.finish_request', [0 => function () {
            return ($this->privates['locale_listener'] ?? $this->getLocaleListenerService());
        }, 1 => 'onKernelFinishRequest'], 0);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['validate_request_listener'] ?? ($this->privates['validate_request_listener'] = new \Symfony\Component\HttpKernel\EventListener\ValidateRequestListener()));
        }, 1 => 'onKernelRequest'], 256);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['.legacy_resolve_controller_name_subscriber'] ?? $this->get_LegacyResolveControllerNameSubscriberService());
        }, 1 => 'resolveControllerName'], 24);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['locale_aware_listener'] ?? $this->getLocaleAwareListenerService());
        }, 1 => 'onKernelRequest'], 15);
        $instance->addListener('kernel.finish_request', [0 => function () {
            return ($this->privates['locale_aware_listener'] ?? $this->getLocaleAwareListenerService());
        }, 1 => 'onKernelFinishRequest'], -15);
        $instance->addListener('console.error', [0 => function () {
            return ($this->privates['console.error_listener'] ?? $this->load('getConsole_ErrorListenerService.php'));
        }, 1 => 'onConsoleError'], -128);
        $instance->addListener('console.terminate', [0 => function () {
            return ($this->privates['console.error_listener'] ?? $this->load('getConsole_ErrorListenerService.php'));
        }, 1 => 'onConsoleTerminate'], -128);
        $instance->addListener('console.error', [0 => function () {
            return ($this->privates['console.suggest_missing_package_subscriber'] ?? ($this->privates['console.suggest_missing_package_subscriber'] = new \Symfony\Bundle\FrameworkBundle\EventListener\SuggestMissingPackageSubscriber()));
        }, 1 => 'onConsoleError'], 0);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['session_listener'] ?? $this->getSessionListenerService());
        }, 1 => 'onKernelRequest'], 128);
        $instance->addListener('kernel.response', [0 => function () {
            return ($this->privates['session_listener'] ?? $this->getSessionListenerService());
        }, 1 => 'onKernelResponse'], -1000);
        $instance->addListener('kernel.finish_request', [0 => function () {
            return ($this->privates['session_listener'] ?? $this->getSessionListenerService());
        }, 1 => 'onFinishRequest'], 0);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['debug.debug_handlers_listener'] ?? $this->getDebug_DebugHandlersListenerService());
        }, 1 => 'configure'], 2048);
        $instance->addListener('console.command', [0 => function () {
            return ($this->privates['debug.debug_handlers_listener'] ?? $this->getDebug_DebugHandlersListenerService());
        }, 1 => 'configure'], 2048);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['router_listener'] ?? $this->getRouterListenerService());
        }, 1 => 'onKernelRequest'], 32);
        $instance->addListener('kernel.finish_request', [0 => function () {
            return ($this->privates['router_listener'] ?? $this->getRouterListenerService());
        }, 1 => 'onKernelFinishRequest'], 0);
        $instance->addListener('kernel.exception', [0 => function () {
            return ($this->privates['router_listener'] ?? $this->getRouterListenerService());
        }, 1 => 'onKernelException'], -64);
        $instance->addListener('kernel.response', [0 => function () {
            return ($this->privates['web_link.add_link_header_listener'] ?? ($this->privates['web_link.add_link_header_listener'] = new \Symfony\Component\WebLink\EventListener\AddLinkHeaderListener()));
        }, 1 => 'onKernelResponse'], 0);
        $instance->addListener('kernel.exception', [0 => function () {
            return ($this->privates['twig.exception_listener'] ?? $this->load('getTwig_ExceptionListenerService.php'));
        }, 1 => 'logKernelException'], 0);
        $instance->addListener('kernel.exception', [0 => function () {
            return ($this->privates['twig.exception_listener'] ?? $this->load('getTwig_ExceptionListenerService.php'));
        }, 1 => 'onKernelException'], -128);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['security.firewall'] ?? $this->getSecurity_FirewallService());
        }, 1 => 'configureLogoutUrlGenerator'], 8);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['security.firewall'] ?? $this->getSecurity_FirewallService());
        }, 1 => 'onKernelRequest'], 8);
        $instance->addListener('kernel.finish_request', [0 => function () {
            return ($this->privates['security.firewall'] ?? $this->getSecurity_FirewallService());
        }, 1 => 'onKernelFinishRequest'], 0);
        $instance->addListener('kernel.response', [0 => function () {
            return ($this->privates['security.rememberme.response_listener'] ?? ($this->privates['security.rememberme.response_listener'] = new \Symfony\Component\Security\Http\RememberMe\ResponseListener()));
        }, 1 => 'onKernelResponse'], 0);
        $instance->addListener('elastica.pager_persister.pre_insert_objects', [0 => function () {
            return ($this->services['fos_elastica.filter_objects_listener'] ?? $this->load('getFosElastica_FilterObjectsListenerService.php'));
        }, 1 => 'filterObjects'], 0);
        $instance->addListener('kernel.controller', [0 => function () {
            return ($this->privates['sensio_framework_extra.controller.listener'] ?? $this->getSensioFrameworkExtra_Controller_ListenerService());
        }, 1 => 'onKernelController'], 0);
        $instance->addListener('kernel.controller', [0 => function () {
            return ($this->privates['sensio_framework_extra.converter.listener'] ?? $this->getSensioFrameworkExtra_Converter_ListenerService());
        }, 1 => 'onKernelController'], 0);
        $instance->addListener('kernel.controller', [0 => function () {
            return ($this->privates['sensio_framework_extra.view.listener'] ?? $this->getSensioFrameworkExtra_View_ListenerService());
        }, 1 => 'onKernelController'], -128);
        $instance->addListener('kernel.view', [0 => function () {
            return ($this->privates['sensio_framework_extra.view.listener'] ?? $this->getSensioFrameworkExtra_View_ListenerService());
        }, 1 => 'onKernelView'], 0);
        $instance->addListener('kernel.controller', [0 => function () {
            return ($this->privates['sensio_framework_extra.cache.listener'] ?? ($this->privates['sensio_framework_extra.cache.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\HttpCacheListener()));
        }, 1 => 'onKernelController'], 0);
        $instance->addListener('kernel.response', [0 => function () {
            return ($this->privates['sensio_framework_extra.cache.listener'] ?? ($this->privates['sensio_framework_extra.cache.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\HttpCacheListener()));
        }, 1 => 'onKernelResponse'], 0);
        $instance->addListener('kernel.controller_arguments', [0 => function () {
            return ($this->privates['sensio_framework_extra.security.listener'] ?? $this->getSensioFrameworkExtra_Security_ListenerService());
        }, 1 => 'onKernelControllerArguments'], 0);
        $instance->addListener('kernel.controller_arguments', [0 => function () {
            return ($this->privates['framework_extra_bundle.event.is_granted'] ?? $this->getFrameworkExtraBundle_Event_IsGrantedService());
        }, 1 => 'onKernelControllerArguments'], 0);
        $instance->addListener('console.command', [0 => function () {
            return ($this->privates['monolog.handler.console'] ?? $this->getMonolog_Handler_ConsoleService());
        }, 1 => 'onCommand'], 255);
        $instance->addListener('console.terminate', [0 => function () {
            return ($this->privates['monolog.handler.console'] ?? $this->getMonolog_Handler_ConsoleService());
        }, 1 => 'onTerminate'], -255);
        $instance->addListener('kernel.terminate', [0 => function () {
            return ($this->privates['enqueue.client.default.flush_spool_producer_listener'] ?? $this->load('getEnqueue_Client_Default_FlushSpoolProducerListenerService.php'));
        }, 1 => 'flushMessages'], 0);
        $instance->addListener('console.terminate', [0 => function () {
            return ($this->privates['enqueue.client.default.flush_spool_producer_listener'] ?? $this->load('getEnqueue_Client_Default_FlushSpoolProducerListenerService.php'));
        }, 1 => 'flushMessages'], 0);
        $instance->addListener('elastica.pager_persister.pre_persist', [0 => function () {
            return ($this->privates['enqueue_elastica.purge_populate_queue_listener'] ?? $this->load('getEnqueueElastica_PurgePopulateQueueListenerService.php'));
        }, 1 => 'purgePopulateQueue'], 0);

        return $instance;
    }

    /*
     * Gets the public 'filesystem' shared service.
     *
     * @return \Symfony\Component\Filesystem\Filesystem
     */
    protected function getFilesystemService()
    {
        return $this->services['filesystem'] = new \Symfony\Component\Filesystem\Filesystem();
    }

    /*
     * Gets the public 'fos_elastica.client.default' shared service.
     *
     * @return \FOS\ElasticaBundle\Elastica\Client
     */
    protected function getFosElastica_Client_DefaultService()
    {
        $this->services['fos_elastica.client.default'] = $instance = new \FOS\ElasticaBundle\Elastica\Client(['connections' => [0 => ['host' => $this->getEnv('FOS_ELASTICA_CLIENTS_DEFAULT_HOST'), 'port' => $this->getEnv('FOS_ELASTICA_CLIENTS_DEFAULT_PORT'), 'http_error_codes' => [0 => 400, 1 => 403, 2 => 404], 'ssl' => false, 'logger' => false, 'compression' => false, 'headers' => [], 'curl' => [], 'retryOnConflict' => 0, 'persistent' => true]], 'connectionStrategy' => 'Simple'], '');

        $instance->setStopwatch(($this->privates['debug.stopwatch'] ?? ($this->privates['debug.stopwatch'] = new \Symfony\Component\Stopwatch\Stopwatch(true))));

        return $instance;
    }

    /*
     * Gets the public 'fos_elastica.finder.biblio_phytos.biblio_phyto' shared service.
     *
     * @return \FOS\ElasticaBundle\Finder\TransformedFinder
     */
    protected function getFosElastica_Finder_BiblioPhytos_BiblioPhytoService()
    {
        $a = new \FOS\ElasticaBundle\Doctrine\ORM\ElasticaToModelTransformer(($this->services['doctrine'] ?? $this->getDoctrineService()), 'App\\Entity\\BiblioPhyto', ['ignore_missing' => true, 'hints' => [], 'hydrate' => true, 'query_builder_method' => 'createQueryBuilder', 'identifier' => 'id']);
        $a->setPropertyAccessor(($this->privates['fos_elastica.property_accessor'] ?? ($this->privates['fos_elastica.property_accessor'] = new \Symfony\Component\PropertyAccess\PropertyAccessor(false, false))));

        return $this->services['fos_elastica.finder.biblio_phytos.biblio_phyto'] = new \FOS\ElasticaBundle\Finder\TransformedFinder(($this->services['fos_elastica.index.biblio_phytos.biblio_phyto'] ?? $this->getFosElastica_Index_BiblioPhytos_BiblioPhytoService()), $a);
    }

    /*
     * Gets the public 'fos_elastica.finder.observers.observer' shared service.
     *
     * @return \FOS\ElasticaBundle\Finder\TransformedFinder
     */
    protected function getFosElastica_Finder_Observers_ObserverService()
    {
        $a = new \FOS\ElasticaBundle\Doctrine\ORM\ElasticaToModelTransformer(($this->services['doctrine'] ?? $this->getDoctrineService()), 'App\\Entity\\Observer', ['ignore_missing' => true, 'hints' => [], 'hydrate' => true, 'query_builder_method' => 'createQueryBuilder', 'identifier' => 'id']);
        $a->setPropertyAccessor(($this->privates['fos_elastica.property_accessor'] ?? ($this->privates['fos_elastica.property_accessor'] = new \Symfony\Component\PropertyAccess\PropertyAccessor(false, false))));

        return $this->services['fos_elastica.finder.observers.observer'] = new \FOS\ElasticaBundle\Finder\TransformedFinder(($this->services['fos_elastica.index.observers.observer'] ?? $this->getFosElastica_Index_Observers_ObserverService()), $a);
    }

    /*
     * Gets the public 'fos_elastica.finder.occurrences.occurrence' shared service.
     *
     * @return \FOS\ElasticaBundle\Finder\TransformedFinder
     */
    protected function getFosElastica_Finder_Occurrences_OccurrenceService()
    {
        $a = new \FOS\ElasticaBundle\Doctrine\ORM\ElasticaToModelTransformer(($this->services['doctrine'] ?? $this->getDoctrineService()), 'App\\Entity\\Occurrence', ['ignore_missing' => true, 'hints' => [], 'hydrate' => true, 'query_builder_method' => 'createQueryBuilder', 'identifier' => 'id']);
        $a->setPropertyAccessor(($this->privates['fos_elastica.property_accessor'] ?? ($this->privates['fos_elastica.property_accessor'] = new \Symfony\Component\PropertyAccess\PropertyAccessor(false, false))));

        return $this->services['fos_elastica.finder.occurrences.occurrence'] = new \FOS\ElasticaBundle\Finder\TransformedFinder(($this->services['fos_elastica.index.occurrences.occurrence'] ?? $this->getFosElastica_Index_Occurrences_OccurrenceService()), $a);
    }

    /*
     * Gets the public 'fos_elastica.finder.photos.photo' shared service.
     *
     * @return \FOS\ElasticaBundle\Finder\TransformedFinder
     */
    protected function getFosElastica_Finder_Photos_PhotoService()
    {
        $a = new \FOS\ElasticaBundle\Doctrine\ORM\ElasticaToModelTransformer(($this->services['doctrine'] ?? $this->getDoctrineService()), 'App\\Entity\\Photo', ['hints' => [], 'hydrate' => true, 'ignore_missing' => false, 'query_builder_method' => 'createQueryBuilder', 'identifier' => 'id']);
        $a->setPropertyAccessor(($this->privates['fos_elastica.property_accessor'] ?? ($this->privates['fos_elastica.property_accessor'] = new \Symfony\Component\PropertyAccess\PropertyAccessor(false, false))));

        return $this->services['fos_elastica.finder.photos.photo'] = new \FOS\ElasticaBundle\Finder\TransformedFinder(($this->services['fos_elastica.index.photos.photo'] ?? $this->getFosElastica_Index_Photos_PhotoService()), $a);
    }

    /*
     * Gets the public 'fos_elastica.finder.tables.table' shared service.
     *
     * @return \FOS\ElasticaBundle\Finder\TransformedFinder
     */
    protected function getFosElastica_Finder_Tables_TableService()
    {
        $a = new \FOS\ElasticaBundle\Doctrine\ORM\ElasticaToModelTransformer(($this->services['doctrine'] ?? $this->getDoctrineService()), 'App\\Entity\\Table', ['ignore_missing' => true, 'hints' => [], 'hydrate' => true, 'query_builder_method' => 'createQueryBuilder', 'identifier' => 'id']);
        $a->setPropertyAccessor(($this->privates['fos_elastica.property_accessor'] ?? ($this->privates['fos_elastica.property_accessor'] = new \Symfony\Component\PropertyAccess\PropertyAccessor(false, false))));

        return $this->services['fos_elastica.finder.tables.table'] = new \FOS\ElasticaBundle\Finder\TransformedFinder(($this->services['fos_elastica.index.tables.table'] ?? $this->getFosElastica_Index_Tables_TableService()), $a);
    }

    /*
     * Gets the public 'fos_elastica.index.biblio_phytos' shared service.
     *
     * @return \FOS\ElasticaBundle\Elastica\Index
     */
    protected function getFosElastica_Index_BiblioPhytosService()
    {
        return $this->services['fos_elastica.index.biblio_phytos'] = ($this->services['fos_elastica.client.default'] ?? $this->getFosElastica_Client_DefaultService())->getIndex('vl_biblio_phytos');
    }

    /*
     * Gets the public 'fos_elastica.index.biblio_phytos.biblio_phyto' shared service.
     *
     * @return \Elastica\Type
     */
    protected function getFosElastica_Index_BiblioPhytos_BiblioPhytoService()
    {
        return $this->services['fos_elastica.index.biblio_phytos.biblio_phyto'] = ($this->services['fos_elastica.index.biblio_phytos'] ?? $this->getFosElastica_Index_BiblioPhytosService())->getType('biblio_phyto');
    }

    /*
     * Gets the public 'fos_elastica.index.observers' shared service.
     *
     * @return \FOS\ElasticaBundle\Elastica\Index
     */
    protected function getFosElastica_Index_ObserversService()
    {
        return $this->services['fos_elastica.index.observers'] = ($this->services['fos_elastica.client.default'] ?? $this->getFosElastica_Client_DefaultService())->getIndex('vl_observers');
    }

    /*
     * Gets the public 'fos_elastica.index.observers.observer' shared service.
     *
     * @return \Elastica\Type
     */
    protected function getFosElastica_Index_Observers_ObserverService()
    {
        return $this->services['fos_elastica.index.observers.observer'] = ($this->services['fos_elastica.index.observers'] ?? $this->getFosElastica_Index_ObserversService())->getType('observer');
    }

    /*
     * Gets the public 'fos_elastica.index.occurrences' shared service.
     *
     * @return \FOS\ElasticaBundle\Elastica\Index
     */
    protected function getFosElastica_Index_OccurrencesService()
    {
        return $this->services['fos_elastica.index.occurrences'] = ($this->services['fos_elastica.client.default'] ?? $this->getFosElastica_Client_DefaultService())->getIndex('cel2_occurrences');
    }

    /*
     * Gets the public 'fos_elastica.index.occurrences.occurrence' shared service.
     *
     * @return \Elastica\Type
     */
    protected function getFosElastica_Index_Occurrences_OccurrenceService()
    {
        return $this->services['fos_elastica.index.occurrences.occurrence'] = ($this->services['fos_elastica.index.occurrences'] ?? $this->getFosElastica_Index_OccurrencesService())->getType('occurrence');
    }

    /*
     * Gets the public 'fos_elastica.index.photos' shared service.
     *
     * @return \FOS\ElasticaBundle\Elastica\Index
     */
    protected function getFosElastica_Index_PhotosService()
    {
        return $this->services['fos_elastica.index.photos'] = ($this->services['fos_elastica.client.default'] ?? $this->getFosElastica_Client_DefaultService())->getIndex('cel2_photos');
    }

    /*
     * Gets the public 'fos_elastica.index.photos.photo' shared service.
     *
     * @return \Elastica\Type
     */
    protected function getFosElastica_Index_Photos_PhotoService()
    {
        return $this->services['fos_elastica.index.photos.photo'] = ($this->services['fos_elastica.index.photos'] ?? $this->getFosElastica_Index_PhotosService())->getType('photo');
    }

    /*
     * Gets the public 'fos_elastica.index.tables' shared service.
     *
     * @return \FOS\ElasticaBundle\Elastica\Index
     */
    protected function getFosElastica_Index_TablesService()
    {
        return $this->services['fos_elastica.index.tables'] = ($this->services['fos_elastica.client.default'] ?? $this->getFosElastica_Client_DefaultService())->getIndex('vl_tables');
    }

    /*
     * Gets the public 'fos_elastica.index.tables.table' shared service.
     *
     * @return \Elastica\Type
     */
    protected function getFosElastica_Index_Tables_TableService()
    {
        return $this->services['fos_elastica.index.tables.table'] = ($this->services['fos_elastica.index.tables'] ?? $this->getFosElastica_Index_TablesService())->getType('table');
    }

    /*
     * Gets the public 'fos_elastica.manager.orm' shared service.
     *
     * @return \FOS\ElasticaBundle\Doctrine\RepositoryManager
     */
    protected function getFosElastica_Manager_OrmService()
    {
        $this->services['fos_elastica.manager.orm'] = $instance = new \FOS\ElasticaBundle\Doctrine\RepositoryManager(($this->services['doctrine'] ?? $this->getDoctrineService()), ($this->services['fos_elastica.repository_manager'] ?? $this->getFosElastica_RepositoryManagerService()));

        $instance->addEntity('App\\Entity\\Occurrence', 'occurrences/occurrence');
        $instance->addEntity('App\\Entity\\Photo', 'photos/photo');
        $instance->addEntity('App\\Entity\\Table', 'tables/table');
        $instance->addEntity('App\\Entity\\Observer', 'observers/observer');
        $instance->addEntity('App\\Entity\\BiblioPhyto', 'biblio_phytos/biblio_phyto');

        return $instance;
    }

    /*
     * Gets the public 'fos_elastica.repository_manager' shared service.
     *
     * @return \FOS\ElasticaBundle\Manager\RepositoryManager
     */
    protected function getFosElastica_RepositoryManagerService()
    {
        $this->services['fos_elastica.repository_manager'] = $instance = new \FOS\ElasticaBundle\Manager\RepositoryManager();

        $instance->addType('occurrences/occurrence', ($this->services['fos_elastica.finder.occurrences.occurrence'] ?? $this->getFosElastica_Finder_Occurrences_OccurrenceService()), 'App\\Elastica\\Repository\\OccurrenceRepository');
        $instance->addType('photos/photo', ($this->services['fos_elastica.finder.photos.photo'] ?? $this->getFosElastica_Finder_Photos_PhotoService()), 'App\\Elastica\\Repository\\PhotoRepository');
        $instance->addType('tables/table', ($this->services['fos_elastica.finder.tables.table'] ?? $this->getFosElastica_Finder_Tables_TableService()));
        $instance->addType('observers/observer', ($this->services['fos_elastica.finder.observers.observer'] ?? $this->getFosElastica_Finder_Observers_ObserverService()));
        $instance->addType('biblio_phytos/biblio_phyto', ($this->services['fos_elastica.finder.biblio_phytos.biblio_phyto'] ?? $this->getFosElastica_Finder_BiblioPhytos_BiblioPhytoService()));

        return $instance;
    }

    /*
     * Gets the public 'http_kernel' shared service.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernel
     */
    protected function getHttpKernelService()
    {
        return $this->services['http_kernel'] = new \Symfony\Component\HttpKernel\HttpKernel(($this->services['event_dispatcher'] ?? $this->getEventDispatcherService()), new \Symfony\Bundle\FrameworkBundle\Controller\ControllerResolver($this, ($this->privates['monolog.logger.request'] ?? $this->getMonolog_Logger_RequestService()), ($this->privates['.legacy_controller_name_converter'] ?? ($this->privates['.legacy_controller_name_converter'] = new \Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser(($this->services['kernel'] ?? $this->get('kernel', 1)), false)))), ($this->services['request_stack'] ?? ($this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack())), new \Symfony\Component\HttpKernel\Controller\ArgumentResolver(($this->privates['argument_metadata_factory'] ?? ($this->privates['argument_metadata_factory'] = new \Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadataFactory())), new RewindableGenerator(function () {
            yield 0 => ($this->privates['argument_resolver.request_attribute'] ?? ($this->privates['argument_resolver.request_attribute'] = new \Symfony\Component\HttpKernel\Controller\ArgumentResolver\RequestAttributeValueResolver()));
            yield 1 => ($this->privates['argument_resolver.request'] ?? ($this->privates['argument_resolver.request'] = new \Symfony\Component\HttpKernel\Controller\ArgumentResolver\RequestValueResolver()));
            yield 2 => ($this->privates['argument_resolver.session'] ?? ($this->privates['argument_resolver.session'] = new \Symfony\Component\HttpKernel\Controller\ArgumentResolver\SessionValueResolver()));
            yield 3 => ($this->privates['security.user_value_resolver'] ?? $this->load('getSecurity_UserValueResolverService.php'));
            yield 4 => ($this->privates['argument_resolver.service'] ?? $this->load('getArgumentResolver_ServiceService.php'));
            yield 5 => ($this->privates['argument_resolver.default'] ?? ($this->privates['argument_resolver.default'] = new \Symfony\Component\HttpKernel\Controller\ArgumentResolver\DefaultValueResolver()));
            yield 6 => ($this->privates['argument_resolver.variadic'] ?? ($this->privates['argument_resolver.variadic'] = new \Symfony\Component\HttpKernel\Controller\ArgumentResolver\VariadicValueResolver()));
        }, 7)));
    }

    /*
     * Gets the public 'liip_imagine.cache.manager' shared service.
     *
     * @return \Liip\ImagineBundle\Imagine\Cache\CacheManager
     */
    protected function getLiipImagine_Cache_ManagerService()
    {
        $this->services['liip_imagine.cache.manager'] = $instance = new \Liip\ImagineBundle\Imagine\Cache\CacheManager(($this->privates['liip_imagine.filter.configuration'] ?? ($this->privates['liip_imagine.filter.configuration'] = new \Liip\ImagineBundle\Imagine\Filter\FilterConfiguration([]))), ($this->services['router'] ?? $this->getRouterService()), ($this->services['liip_imagine.cache.signer'] ?? ($this->services['liip_imagine.cache.signer'] = new \Liip\ImagineBundle\Imagine\Cache\Signer($this->getEnv('APP_SECRET')))), ($this->services['event_dispatcher'] ?? $this->getEventDispatcherService()), 'default');

        $instance->addResolver('default', ($this->services['liip_imagine.cache.resolver.default'] ?? $this->getLiipImagine_Cache_Resolver_DefaultService()));
        $instance->addResolver('no_cache', ($this->services['liip_imagine.cache.resolver.no_cache_web_path'] ?? $this->getLiipImagine_Cache_Resolver_NoCacheWebPathService()));

        return $instance;
    }

    /*
     * Gets the public 'liip_imagine.cache.resolver.default' shared service.
     *
     * @return \Liip\ImagineBundle\Imagine\Cache\Resolver\WebPathResolver
     */
    protected function getLiipImagine_Cache_Resolver_DefaultService()
    {
        return $this->services['liip_imagine.cache.resolver.default'] = new \Liip\ImagineBundle\Imagine\Cache\Resolver\WebPathResolver(($this->services['filesystem'] ?? ($this->services['filesystem'] = new \Symfony\Component\Filesystem\Filesystem())), ($this->privates['router.request_context'] ?? $this->getRouter_RequestContextService()), (\dirname(__DIR__, 4).'/public'), 'media/cache');
    }

    /*
     * Gets the public 'liip_imagine.cache.resolver.no_cache_web_path' shared service.
     *
     * @return \Liip\ImagineBundle\Imagine\Cache\Resolver\NoCacheWebPathResolver
     */
    protected function getLiipImagine_Cache_Resolver_NoCacheWebPathService()
    {
        return $this->services['liip_imagine.cache.resolver.no_cache_web_path'] = new \Liip\ImagineBundle\Imagine\Cache\Resolver\NoCacheWebPathResolver(($this->privates['router.request_context'] ?? $this->getRouter_RequestContextService()));
    }

    /*
     * Gets the public 'liip_imagine.cache.signer' shared service.
     *
     * @return \Liip\ImagineBundle\Imagine\Cache\Signer
     */
    protected function getLiipImagine_Cache_SignerService()
    {
        return $this->services['liip_imagine.cache.signer'] = new \Liip\ImagineBundle\Imagine\Cache\Signer($this->getEnv('APP_SECRET'));
    }

    /*
     * Gets the public 'request_stack' shared service.
     *
     * @return \Symfony\Component\HttpFoundation\RequestStack
     */
    protected function getRequestStackService()
    {
        return $this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack();
    }

    /*
     * Gets the public 'router' shared service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Routing\Router
     */
    protected function getRouterService()
    {
        $a = new \Symfony\Bridge\Monolog\Logger('router');
        $a->pushHandler(($this->privates['monolog.handler.console'] ?? $this->getMonolog_Handler_ConsoleService()));
        $a->pushHandler(($this->privates['monolog.handler.main'] ?? $this->getMonolog_Handler_MainService()));

        $this->services['router'] = $instance = new \Symfony\Bundle\FrameworkBundle\Routing\Router((new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($this->getService, [
            'routing.loader' => ['services', 'routing.loader', 'getRouting_LoaderService.php', true],
        ], [
            'routing.loader' => 'Symfony\\Component\\Config\\Loader\\LoaderInterface',
        ]))->withContext('router.default', $this), 'kernel::loadRoutes', ['cache_dir' => $this->targetDir.'', 'debug' => false, 'generator_class' => 'Symfony\\Component\\Routing\\Generator\\CompiledUrlGenerator', 'generator_dumper_class' => 'Symfony\\Component\\Routing\\Generator\\Dumper\\CompiledUrlGeneratorDumper', 'matcher_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableCompiledUrlMatcher', 'matcher_dumper_class' => 'Symfony\\Component\\Routing\\Matcher\\Dumper\\CompiledUrlMatcherDumper', 'strict_requirements' => NULL, 'resource_type' => 'service'], ($this->privates['router.request_context'] ?? $this->getRouter_RequestContextService()), ($this->privates['parameter_bag'] ?? ($this->privates['parameter_bag'] = new \Symfony\Component\DependencyInjection\ParameterBag\ContainerBag($this))), $a, 'en');

        $instance->setConfigCacheFactory(($this->privates['config_cache_factory'] ?? ($this->privates['config_cache_factory'] = new \Symfony\Component\Config\ResourceCheckerConfigCacheFactory())));

        return $instance;
    }

    /*
     * Gets the public 'security.authorization_checker' shared service.
     *
     * @return \Symfony\Component\Security\Core\Authorization\AuthorizationChecker
     */
    protected function getSecurity_AuthorizationCheckerService()
    {
        return $this->services['security.authorization_checker'] = new \Symfony\Component\Security\Core\Authorization\AuthorizationChecker(($this->services['security.token_storage'] ?? $this->getSecurity_TokenStorageService()), ($this->privates['security.authentication.manager'] ?? $this->getSecurity_Authentication_ManagerService()), ($this->privates['security.access.decision_manager'] ?? $this->getSecurity_Access_DecisionManagerService()), false);
    }

    /*
     * Gets the public 'security.token_storage' shared service.
     *
     * @return \Symfony\Component\Security\Core\Authentication\Token\Storage\UsageTrackingTokenStorage
     */
    protected function getSecurity_TokenStorageService()
    {
        return $this->services['security.token_storage'] = new \Symfony\Component\Security\Core\Authentication\Token\Storage\UsageTrackingTokenStorage(($this->privates['security.untracked_token_storage'] ?? ($this->privates['security.untracked_token_storage'] = new \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage())), new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($this->getService, [
            'session' => ['services', 'session', 'getSessionService.php', true],
        ], [
            'session' => '?',
        ]));
    }

    /*
     * Gets the public 'serializer' shared service.
     *
     * @return \Symfony\Component\Serializer\Serializer
     */
    protected function getSerializerService()
    {
        $a = ($this->privates['api_platform.metadata.property.name_collection_factory.cached'] ?? $this->getApiPlatform_Metadata_Property_NameCollectionFactory_CachedService());
        $b = ($this->privates['api_platform.metadata.property.metadata_factory.cached'] ?? $this->getApiPlatform_Metadata_Property_MetadataFactory_CachedService());
        $c = ($this->privates['api_platform.iri_converter'] ?? $this->getApiPlatform_IriConverterService());
        $d = ($this->privates['api_platform.resource_class_resolver'] ?? $this->getApiPlatform_ResourceClassResolverService());
        $e = ($this->privates['property_accessor'] ?? $this->getPropertyAccessorService());
        $f = ($this->privates['serializer.name_converter.metadata_aware'] ?? $this->getSerializer_NameConverter_MetadataAwareService());
        $g = ($this->privates['serializer.mapping.cache_class_metadata_factory'] ?? $this->getSerializer_Mapping_CacheClassMetadataFactoryService());
        $h = ($this->privates['api_platform.metadata.resource.metadata_factory.cached'] ?? $this->getApiPlatform_Metadata_Resource_MetadataFactory_CachedService());

        $i = new \ApiPlatform\Core\Serializer\ItemNormalizer($a, $b, $c, $d, $e, $f, $g, ($this->privates['api_platform.item_data_provider'] ?? $this->getApiPlatform_ItemDataProviderService()), false, NULL, new RewindableGenerator(function () {
            return new \EmptyIterator();
        }, 0), $h, false);
        $j = ($this->privates['api_platform.router'] ?? $this->getApiPlatform_RouterService());
        $k = ($this->privates['api_platform.subresource_operation_factory.cached'] ?? $this->getApiPlatform_SubresourceOperationFactory_CachedService());
        $l = ($this->privates['api_platform.filter_locator'] ?? $this->getApiPlatform_FilterLocatorService());

        $m = new \ApiPlatform\Core\Swagger\Serializer\ApiGatewayNormalizer(new \ApiPlatform\Core\Swagger\Serializer\DocumentationNormalizer($h, $a, $b, ($this->privates['api_platform.hydra.json_schema.schema_factory'] ?? $this->getApiPlatform_Hydra_JsonSchema_SchemaFactoryService()), ($this->privates['api_platform.json_schema.type_factory'] ?? $this->getApiPlatform_JsonSchema_TypeFactoryService()), new \ApiPlatform\Core\Bridge\Symfony\Routing\RouterOperationPathResolver($j, ($this->privates['api_platform.operation_path_resolver.custom'] ?? $this->getApiPlatform_OperationPathResolver_CustomService()), $k), NULL, $l, NULL, false, 'oauth2', 'application', '/oauth/v2/token', '/oauth/v2/auth', [], $this->parameters['api_platform.swagger.api_keys'], $k, true, 'page', false, 'itemsPerPage', $this->parameters['api_platform.formats'], false, 'pagination', $this->parameters['api_platform.swagger.versions']));
        $n = new \ApiPlatform\Core\JsonApi\Serializer\ReservedAttributeNameConverter($f);
        $o = ($this->privates['api_platform.jsonld.context_builder'] ?? $this->getApiPlatform_Jsonld_ContextBuilderService());
        $p = new \Symfony\Component\Serializer\Normalizer\ObjectNormalizer($g, $f, $e, ($this->privates['property_info.cache'] ?? $this->getPropertyInfo_CacheService()), new \Symfony\Component\Serializer\Mapping\ClassDiscriminatorFromClassMetadata($g), NULL, []);

        return $this->services['serializer'] = new \Symfony\Component\Serializer\Serializer([0 => new \App\Serializer\GeoJsonOccurrenceNormalizer($i), 1 => new \App\Serializer\JsonPatchOccurrenceNormalizer($i), 2 => new \App\Serializer\PdfOccurrenceNormalizer($i), 3 => $m, 4 => new \ApiPlatform\Core\JsonApi\Serializer\ConstraintViolationListNormalizer($b, $n), 5 => new \ApiPlatform\Core\Hydra\Serializer\ConstraintViolationListNormalizer($j, [], $f), 6 => new \ApiPlatform\Core\Problem\Serializer\ConstraintViolationListNormalizer([], $f), 7 => $m, 8 => new \ApiPlatform\Core\JsonApi\Serializer\ErrorNormalizer(false), 9 => new \ApiPlatform\Core\JsonApi\Serializer\EntrypointNormalizer($h, $c, $j), 10 => new \ApiPlatform\Core\Hydra\Serializer\DocumentationNormalizer($h, $a, $b, $d, NULL, $j, $k, $f), 11 => new \ApiPlatform\Core\Hydra\Serializer\EntrypointNormalizer($h, $c, $j), 12 => new \ApiPlatform\Core\Hydra\Serializer\ErrorNormalizer($j, false), 13 => new \ApiPlatform\Core\Hal\Serializer\EntrypointNormalizer($h, $c, $j), 14 => new \ApiPlatform\Core\Problem\Serializer\ErrorNormalizer(false), 15 => new \Symfony\Component\Serializer\Normalizer\ProblemNormalizer(false), 16 => new \ApiPlatform\Core\JsonApi\Serializer\ItemNormalizer($a, $b, $c, $d, $e, $n, $h, [], new RewindableGenerator(function () {
            return new \EmptyIterator();
        }, 0), false), 17 => new \ApiPlatform\Core\JsonLd\Serializer\ItemNormalizer($h, $a, $b, $c, $d, $o, $e, $f, $g, [], new RewindableGenerator(function () {
            return new \EmptyIterator();
        }, 0), false), 18 => new \ApiPlatform\Core\Hal\Serializer\ItemNormalizer($a, $b, $c, $d, $e, $f, $g, NULL, false, [], new RewindableGenerator(function () {
            return new \EmptyIterator();
        }, 0), $h, false), 19 => $i, 20 => new \Symfony\Component\Serializer\Normalizer\JsonSerializableNormalizer(), 21 => new \Symfony\Component\Serializer\Normalizer\DateTimeNormalizer(), 22 => new \Symfony\Component\Serializer\Normalizer\ConstraintViolationListNormalizer([], $f), 23 => new \Symfony\Component\Serializer\Normalizer\DateTimeZoneNormalizer(), 24 => new \Symfony\Component\Serializer\Normalizer\DateIntervalNormalizer(), 25 => new \Symfony\Component\Serializer\Normalizer\DataUriNormalizer(($this->privates['mime_types'] ?? $this->getMimeTypesService())), 26 => new \ApiPlatform\Core\JsonApi\Serializer\CollectionNormalizer($d, 'page'), 27 => new \ApiPlatform\Core\Hydra\Serializer\CollectionFiltersNormalizer(new \ApiPlatform\Core\Hydra\Serializer\PartialCollectionViewNormalizer(new \ApiPlatform\Core\Hydra\Serializer\CollectionNormalizer($o, $d, $c), 'page', 'pagination', $h, $e), $h, $d, $l), 28 => new \ApiPlatform\Core\Hal\Serializer\CollectionNormalizer($d, 'page'), 29 => new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer(), 30 => new \ApiPlatform\Core\JsonApi\Serializer\ObjectNormalizer($p, $c, $d, $h), 31 => new \ApiPlatform\Core\JsonLd\Serializer\ObjectNormalizer($p, $c, $o), 32 => new \ApiPlatform\Core\Hal\Serializer\ObjectNormalizer($p, $c), 33 => $p], [0 => new \App\Serializer\GeoJsonOccurrenceEncoder(), 1 => new \App\Serializer\JsonPatchOccurrenceEncoder(), 2 => new \App\Serializer\PdfOccurrenceEncoder(), 3 => new \App\Serializer\GeoJsonOccurrenceEncoder(), 4 => new \App\Serializer\JsonPatchOccurrenceEncoder(), 5 => new \App\Serializer\PdfOccurrenceEncoder(), 6 => new \Symfony\Component\Serializer\Encoder\XmlEncoder(), 7 => new \Symfony\Component\Serializer\Encoder\JsonEncoder(), 8 => new \Symfony\Component\Serializer\Encoder\YamlEncoder(), 9 => new \Symfony\Component\Serializer\Encoder\CsvEncoder(), 10 => new \ApiPlatform\Core\Serializer\JsonEncoder('jsonapi'), 11 => new \ApiPlatform\Core\Serializer\JsonEncoder('jsonld'), 12 => new \ApiPlatform\Core\Serializer\JsonEncoder('jsonhal'), 13 => new \ApiPlatform\Core\Serializer\JsonEncoder('jsonproblem')]);
    }

    /*
     * Gets the public 'translator' shared service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Translation\Translator
     */
    protected function getTranslatorService()
    {
        $this->services['translator'] = $instance = new \Symfony\Bundle\FrameworkBundle\Translation\Translator(new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($this->getService, [
            'translation.loader.csv' => ['privates', 'translation.loader.csv', 'getTranslation_Loader_CsvService.php', true],
            'translation.loader.dat' => ['privates', 'translation.loader.dat', 'getTranslation_Loader_DatService.php', true],
            'translation.loader.ini' => ['privates', 'translation.loader.ini', 'getTranslation_Loader_IniService.php', true],
            'translation.loader.json' => ['privates', 'translation.loader.json', 'getTranslation_Loader_JsonService.php', true],
            'translation.loader.mo' => ['privates', 'translation.loader.mo', 'getTranslation_Loader_MoService.php', true],
            'translation.loader.php' => ['privates', 'translation.loader.php', 'getTranslation_Loader_PhpService.php', true],
            'translation.loader.po' => ['privates', 'translation.loader.po', 'getTranslation_Loader_PoService.php', true],
            'translation.loader.qt' => ['privates', 'translation.loader.qt', 'getTranslation_Loader_QtService.php', true],
            'translation.loader.res' => ['privates', 'translation.loader.res', 'getTranslation_Loader_ResService.php', true],
            'translation.loader.xliff' => ['privates', 'translation.loader.xliff', 'getTranslation_Loader_XliffService.php', true],
            'translation.loader.yml' => ['privates', 'translation.loader.yml', 'getTranslation_Loader_YmlService.php', true],
        ], [
            'translation.loader.csv' => '?',
            'translation.loader.dat' => '?',
            'translation.loader.ini' => '?',
            'translation.loader.json' => '?',
            'translation.loader.mo' => '?',
            'translation.loader.php' => '?',
            'translation.loader.po' => '?',
            'translation.loader.qt' => '?',
            'translation.loader.res' => '?',
            'translation.loader.xliff' => '?',
            'translation.loader.yml' => '?',
        ]), new \Symfony\Component\Translation\Formatter\MessageFormatter(new \Symfony\Component\Translation\IdentityTranslator()), 'en', ['translation.loader.php' => [0 => 'php'], 'translation.loader.yml' => [0 => 'yaml', 1 => 'yml'], 'translation.loader.xliff' => [0 => 'xlf', 1 => 'xliff'], 'translation.loader.po' => [0 => 'po'], 'translation.loader.mo' => [0 => 'mo'], 'translation.loader.qt' => [0 => 'ts'], 'translation.loader.csv' => [0 => 'csv'], 'translation.loader.res' => [0 => 'res'], 'translation.loader.dat' => [0 => 'dat'], 'translation.loader.ini' => [0 => 'ini'], 'translation.loader.json' => [0 => 'json']], ['cache_dir' => ($this->targetDir.''.'/translations'), 'debug' => false, 'resource_files' => ['af' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.af.xlf')], 'ar' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.ar.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.ar.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.ar.xlf'), 3 => (\dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Resources/translations/VichUploaderBundle.ar.yml')], 'az' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.az.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.az.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.az.xlf')], 'be' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.be.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.be.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.be.xlf')], 'bg' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.bg.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.bg.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.bg.xlf')], 'ca' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.ca.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.ca.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.ca.xlf')], 'cs' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.cs.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.cs.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.cs.xlf'), 3 => (\dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Resources/translations/VichUploaderBundle.cs.yml')], 'cy' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.cy.xlf')], 'da' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.da.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.da.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.da.xlf')], 'de' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.de.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.de.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.de.xlf'), 3 => (\dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Resources/translations/VichUploaderBundle.de.yml')], 'el' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.el.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.el.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.el.xlf')], 'en' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.en.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.en.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.en.xlf'), 3 => (\dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Resources/translations/VichUploaderBundle.en.yml')], 'es' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.es.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.es.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.es.xlf'), 3 => (\dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Resources/translations/VichUploaderBundle.es.yml')], 'et' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.et.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.et.xlf')], 'eu' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.eu.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.eu.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.eu.xlf')], 'fa' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.fa.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.fa.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.fa.xlf')], 'fi' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.fi.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.fi.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Resources/translations/VichUploaderBundle.fi.yml')], 'fr' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.fr.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.fr.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.fr.xlf'), 3 => (\dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Resources/translations/VichUploaderBundle.fr.yml')], 'gl' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.gl.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.gl.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.gl.xlf')], 'he' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.he.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.he.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.he.xlf')], 'hr' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.hr.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.hr.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.hr.xlf')], 'hu' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.hu.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.hu.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.hu.xlf'), 3 => (\dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Resources/translations/VichUploaderBundle.hu.yml')], 'hy' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.hy.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.hy.xlf')], 'id' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.id.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.id.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.id.xlf')], 'it' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.it.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.it.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.it.xlf'), 3 => (\dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Resources/translations/VichUploaderBundle.it.yml')], 'ja' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.ja.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.ja.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.ja.xlf')], 'lb' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.lb.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.lb.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.lb.xlf')], 'lt' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.lt.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.lt.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.lt.xlf')], 'lv' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.lv.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.lv.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.lv.xlf')], 'mn' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.mn.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.mn.xlf')], 'nb' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.nb.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.nb.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.nb.xlf')], 'nl' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.nl.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.nl.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.nl.xlf')], 'nn' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.nn.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.nn.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.nn.xlf')], 'no' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.no.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.no.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.no.xlf')], 'pl' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.pl.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.pl.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.pl.xlf'), 3 => (\dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Resources/translations/VichUploaderBundle.pl.yml')], 'pt' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.pt.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.pt.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Resources/translations/VichUploaderBundle.pt.yml')], 'pt_BR' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.pt_BR.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.pt_BR.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.pt_BR.xlf')], 'ro' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.ro.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.ro.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.ro.xlf')], 'ru' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.ru.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.ru.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.ru.xlf'), 3 => (\dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Resources/translations/VichUploaderBundle.ru.yml')], 'sk' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.sk.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.sk.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.sk.xlf')], 'sl' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.sl.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.sl.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.sl.xlf'), 3 => (\dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Resources/translations/VichUploaderBundle.sl.yml')], 'sq' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.sq.xlf')], 'sr_Cyrl' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.sr_Cyrl.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.sr_Cyrl.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.sr_Cyrl.xlf')], 'sr_Latn' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.sr_Latn.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.sr_Latn.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.sr_Latn.xlf')], 'sv' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.sv.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.sv.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.sv.xlf')], 'th' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.th.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.th.xlf')], 'tl' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.tl.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.tl.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.tl.xlf')], 'tr' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.tr.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.tr.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.tr.xlf'), 3 => (\dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Resources/translations/VichUploaderBundle.tr.yml')], 'uk' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.uk.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.uk.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.uk.xlf'), 3 => (\dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Resources/translations/VichUploaderBundle.uk.yml')], 'vi' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.vi.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.vi.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.vi.xlf')], 'zh_CN' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.zh_CN.xlf'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations/validators.zh_CN.xlf'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.zh_CN.xlf')], 'zh_TW' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations/validators.zh_TW.xlf')], 'pt_PT' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations/security.pt_PT.xlf')]], 'scanned_directories' => [0 => (\dirname(__DIR__, 4).'/vendor/symfony/validator/Resources/translations'), 1 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/translations'), 2 => (\dirname(__DIR__, 4).'/vendor/symfony/security/Core/Resources/translations'), 3 => (\dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Resources/translations'), 4 => (\dirname(__DIR__, 4).'/translations'), 5 => (\dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/translations'), 6 => (\dirname(__DIR__, 4).'/src/Resources/FrameworkBundle/translations'), 7 => (\dirname(__DIR__, 4).'/vendor/symfony/twig-bundle/translations'), 8 => (\dirname(__DIR__, 4).'/src/Resources/TwigBundle/translations'), 9 => (\dirname(__DIR__, 4).'/vendor/symfony/security-bundle/translations'), 10 => (\dirname(__DIR__, 4).'/src/Resources/SecurityBundle/translations'), 11 => (\dirname(__DIR__, 4).'/vendor/nelmio/cors-bundle/translations'), 12 => (\dirname(__DIR__, 4).'/src/Resources/NelmioCorsBundle/translations'), 13 => (\dirname(__DIR__, 4).'/vendor/doctrine/doctrine-bundle/translations'), 14 => (\dirname(__DIR__, 4).'/src/Resources/DoctrineBundle/translations'), 15 => (\dirname(__DIR__, 4).'/vendor/api-platform/core/src/Bridge/Symfony/Bundle/translations'), 16 => (\dirname(__DIR__, 4).'/src/Resources/ApiPlatformBundle/translations'), 17 => (\dirname(__DIR__, 4).'/vendor/friendsofsymfony/elastica-bundle/src/translations'), 18 => (\dirname(__DIR__, 4).'/src/Resources/FOSElasticaBundle/translations'), 19 => (\dirname(__DIR__, 4).'/src/Resources/VichUploaderBundle/translations'), 20 => (\dirname(__DIR__, 4).'/vendor/sensio/framework-extra-bundle/src/translations'), 21 => (\dirname(__DIR__, 4).'/src/Resources/SensioFrameworkExtraBundle/translations'), 22 => (\dirname(__DIR__, 4).'/vendor/symfony/monolog-bundle/translations'), 23 => (\dirname(__DIR__, 4).'/src/Resources/MonologBundle/translations'), 24 => (\dirname(__DIR__, 4).'/vendor/jms/serializer-bundle/translations'), 25 => (\dirname(__DIR__, 4).'/src/Resources/JMSSerializerBundle/translations'), 26 => (\dirname(__DIR__, 4).'/vendor/fresh/vich-uploader-serialization-bundle/translations'), 27 => (\dirname(__DIR__, 4).'/src/Resources/FreshVichUploaderSerializationBundle/translations'), 28 => (\dirname(__DIR__, 4).'/vendor/enqueue/enqueue-bundle/translations'), 29 => (\dirname(__DIR__, 4).'/src/Resources/EnqueueBundle/translations'), 30 => (\dirname(__DIR__, 4).'/vendor/enqueue/elastica-bundle/translations'), 31 => (\dirname(__DIR__, 4).'/src/Resources/EnqueueElasticaBundle/translations'), 32 => (\dirname(__DIR__, 4).'/vendor/liip/imagine-bundle/translations'), 33 => (\dirname(__DIR__, 4).'/src/Resources/LiipImagineBundle/translations'), 34 => (\dirname(__DIR__, 4).'/src/Resources/translations')], 'cache_vary' => ['scanned_directories' => [0 => 'vendor/symfony/validator/Resources/translations', 1 => 'vendor/symfony/form/Resources/translations', 2 => 'vendor/symfony/security/Core/Resources/translations', 3 => 'vendor/vich/uploader-bundle/Resources/translations', 4 => 'translations', 5 => 'vendor/symfony/framework-bundle/translations', 6 => 'src/Resources/FrameworkBundle/translations', 7 => 'vendor/symfony/twig-bundle/translations', 8 => 'src/Resources/TwigBundle/translations', 9 => 'vendor/symfony/security-bundle/translations', 10 => 'src/Resources/SecurityBundle/translations', 11 => 'vendor/nelmio/cors-bundle/translations', 12 => 'src/Resources/NelmioCorsBundle/translations', 13 => 'vendor/doctrine/doctrine-bundle/translations', 14 => 'src/Resources/DoctrineBundle/translations', 15 => 'vendor/api-platform/core/src/Bridge/Symfony/Bundle/translations', 16 => 'src/Resources/ApiPlatformBundle/translations', 17 => 'vendor/friendsofsymfony/elastica-bundle/src/translations', 18 => 'src/Resources/FOSElasticaBundle/translations', 19 => 'src/Resources/VichUploaderBundle/translations', 20 => 'vendor/sensio/framework-extra-bundle/src/translations', 21 => 'src/Resources/SensioFrameworkExtraBundle/translations', 22 => 'vendor/symfony/monolog-bundle/translations', 23 => 'src/Resources/MonologBundle/translations', 24 => 'vendor/jms/serializer-bundle/translations', 25 => 'src/Resources/JMSSerializerBundle/translations', 26 => 'vendor/fresh/vich-uploader-serialization-bundle/translations', 27 => 'src/Resources/FreshVichUploaderSerializationBundle/translations', 28 => 'vendor/enqueue/enqueue-bundle/translations', 29 => 'src/Resources/EnqueueBundle/translations', 30 => 'vendor/enqueue/elastica-bundle/translations', 31 => 'src/Resources/EnqueueElasticaBundle/translations', 32 => 'vendor/liip/imagine-bundle/translations', 33 => 'src/Resources/LiipImagineBundle/translations', 34 => 'src/Resources/translations']]]);

        $instance->setConfigCacheFactory(($this->privates['config_cache_factory'] ?? ($this->privates['config_cache_factory'] = new \Symfony\Component\Config\ResourceCheckerConfigCacheFactory())));
        $instance->setFallbackLocales([0 => 'en']);

        return $instance;
    }

    /*
     * Gets the public 'twig' shared service.
     *
     * @return \Twig\Environment
     */
    protected function getTwigService()
    {
        $a = new \Twig\Loader\FilesystemLoader([], \dirname(__DIR__, 4));
        $a->addPath((\dirname(__DIR__, 4).'/templates'));
        $a->addPath((\dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Resources/views'), 'Framework');
        $a->addPath((\dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Resources/views'), '!Framework');
        $a->addPath((\dirname(__DIR__, 4).'/vendor/symfony/twig-bundle/Resources/views'), 'Twig');
        $a->addPath((\dirname(__DIR__, 4).'/vendor/symfony/twig-bundle/Resources/views'), '!Twig');
        $a->addPath((\dirname(__DIR__, 4).'/vendor/symfony/security-bundle/Resources/views'), 'Security');
        $a->addPath((\dirname(__DIR__, 4).'/vendor/symfony/security-bundle/Resources/views'), '!Security');
        $a->addPath((\dirname(__DIR__, 4).'/vendor/doctrine/doctrine-bundle/Resources/views'), 'Doctrine');
        $a->addPath((\dirname(__DIR__, 4).'/vendor/doctrine/doctrine-bundle/Resources/views'), '!Doctrine');
        $a->addPath((\dirname(__DIR__, 4).'/vendor/api-platform/core/src/Bridge/Symfony/Bundle/Resources/views'), 'ApiPlatform');
        $a->addPath((\dirname(__DIR__, 4).'/vendor/api-platform/core/src/Bridge/Symfony/Bundle/Resources/views'), '!ApiPlatform');
        $a->addPath((\dirname(__DIR__, 4).'/vendor/friendsofsymfony/elastica-bundle/src/Resources/views'), 'FOSElastica');
        $a->addPath((\dirname(__DIR__, 4).'/vendor/friendsofsymfony/elastica-bundle/src/Resources/views'), '!FOSElastica');
        $a->addPath((\dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Resources/views'), 'VichUploader');
        $a->addPath((\dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Resources/views'), '!VichUploader');
        $a->addPath((\dirname(__DIR__, 4).'/vendor/enqueue/enqueue-bundle/Resources/views'), 'Enqueue');
        $a->addPath((\dirname(__DIR__, 4).'/vendor/enqueue/enqueue-bundle/Resources/views'), '!Enqueue');
        $a->addPath((\dirname(__DIR__, 4).'/vendor/liip/imagine-bundle/Resources/views'), 'LiipImagine');
        $a->addPath((\dirname(__DIR__, 4).'/vendor/liip/imagine-bundle/Resources/views'), '!LiipImagine');
        $a->addPath((\dirname(__DIR__, 4).'/templates'));
        $a->addPath((\dirname(__DIR__, 4).'/vendor/symfony/twig-bridge/Resources/views/Form'));

        $this->services['twig'] = $instance = new \Twig\Environment($a, ['debug' => false, 'strict_variables' => false, 'autoescape' => 'name', 'cache' => ($this->targetDir.''.'/twig'), 'charset' => 'UTF-8']);

        $b = ($this->services['request_stack'] ?? ($this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack()));
        $c = new \Symfony\Bridge\Twig\AppVariable();
        $c->setEnvironment('prod');
        $c->setDebug(false);
        if ($this->has('security.token_storage')) {
            $c->setTokenStorage(($this->services['security.token_storage'] ?? $this->getSecurity_TokenStorageService()));
        }
        if ($this->has('request_stack')) {
            $c->setRequestStack($b);
        }

        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\CsrfExtension());
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\TranslationExtension(($this->services['translator'] ?? $this->getTranslatorService())));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\AssetExtension(new \Symfony\Component\Asset\Packages(new \Symfony\Component\Asset\PathPackage('', new \Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy(), new \Symfony\Component\Asset\Context\RequestStackContext($b, '', false)), [])));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\CodeExtension(($this->privates['debug.file_link_formatter'] ?? ($this->privates['debug.file_link_formatter'] = new \Symfony\Component\HttpKernel\Debug\FileLinkFormatter(NULL))), \dirname(__DIR__, 4), 'UTF-8'));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\RoutingExtension(($this->services['router'] ?? $this->getRouterService())));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\YamlExtension());
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\StopwatchExtension(($this->privates['debug.stopwatch'] ?? ($this->privates['debug.stopwatch'] = new \Symfony\Component\Stopwatch\Stopwatch(true))), false));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\ExpressionExtension());
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\HttpKernelExtension());
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\HttpFoundationExtension(new \Symfony\Component\HttpFoundation\UrlHelper($b, ($this->privates['router.request_context'] ?? $this->getRouter_RequestContextService()))));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\WebLinkExtension($b));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\FormExtension([0 => $this, 1 => 'twig.form.renderer']));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\LogoutUrlExtension(($this->privates['security.logout_url_generator'] ?? $this->getSecurity_LogoutUrlGeneratorService())));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\SecurityExtension(($this->services['security.authorization_checker'] ?? $this->getSecurity_AuthorizationCheckerService())));
        $instance->addExtension(new \Doctrine\Bundle\DoctrineBundle\Twig\DoctrineExtension());
        $instance->addExtension(new \Vich\UploaderBundle\Twig\Extension\UploaderExtension(($this->services['vich_uploader.templating.helper.uploader_helper'] ?? $this->getVichUploader_Templating_Helper_UploaderHelperService())));
        $instance->addExtension(new \JMS\Serializer\Twig\SerializerRuntimeExtension());
        $instance->addExtension(new \Liip\ImagineBundle\Templating\FilterExtension(($this->services['liip_imagine.cache.manager'] ?? $this->getLiipImagine_Cache_ManagerService())));
        $instance->addGlobal('app', $c);
        $instance->addRuntimeLoader(new \Twig\RuntimeLoader\ContainerRuntimeLoader(new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($this->getService, [
            'JMS\\Serializer\\Twig\\SerializerRuntimeHelper' => ['services', 'jms_serializer.twig_extension.serializer_runtime_helper', 'getJmsSerializer_TwigExtension_SerializerRuntimeHelperService.php', true],
            'Symfony\\Bridge\\Twig\\Extension\\CsrfRuntime' => ['privates', 'twig.runtime.security_csrf', 'getTwig_Runtime_SecurityCsrfService.php', true],
            'Symfony\\Bridge\\Twig\\Extension\\HttpKernelRuntime' => ['privates', 'twig.runtime.httpkernel', 'getTwig_Runtime_HttpkernelService.php', true],
            'Symfony\\Component\\Form\\FormRenderer' => ['privates', 'twig.form.renderer', 'getTwig_Form_RendererService.php', true],
        ], [
            'JMS\\Serializer\\Twig\\SerializerRuntimeHelper' => '?',
            'Symfony\\Bridge\\Twig\\Extension\\CsrfRuntime' => '?',
            'Symfony\\Bridge\\Twig\\Extension\\HttpKernelRuntime' => '?',
            'Symfony\\Component\\Form\\FormRenderer' => '?',
        ])));
        (new \Symfony\Bundle\TwigBundle\DependencyInjection\Configurator\EnvironmentConfigurator('F j, Y H:i', '%d days', NULL, 0, '.', ','))->configure($instance);

        return $instance;
    }

    /*
     * Gets the public 'validator' shared service.
     *
     * @return \Symfony\Component\Validator\Validator\ValidatorInterface
     */
    protected function getValidatorService()
    {
        return $this->services['validator'] = ($this->privates['validator.builder'] ?? $this->getValidator_BuilderService())->getValidator();
    }

    /*
     * Gets the public 'vich_uploader.templating.helper.uploader_helper' shared service.
     *
     * @return \Vich\UploaderBundle\Templating\Helper\UploaderHelper
     */
    protected function getVichUploader_Templating_Helper_UploaderHelperService()
    {
        return $this->services['vich_uploader.templating.helper.uploader_helper'] = new \Vich\UploaderBundle\Templating\Helper\UploaderHelper(($this->privates['vich_uploader.storage.file_system'] ?? $this->getVichUploader_Storage_FileSystemService()));
    }

    /*
     * Gets the public 'vich_uploader.upload_handler' shared service.
     *
     * @return \Vich\UploaderBundle\Handler\UploadHandler
     */
    protected function getVichUploader_UploadHandlerService()
    {
        $a = ($this->privates['vich_uploader.storage.file_system'] ?? $this->getVichUploader_Storage_FileSystemService());

        return $this->services['vich_uploader.upload_handler'] = new \Vich\UploaderBundle\Handler\UploadHandler(($this->privates['vich_uploader.property_mapping_factory'] ?? $this->getVichUploader_PropertyMappingFactoryService()), $a, new \Vich\UploaderBundle\Injector\FileInjector($a), ($this->services['event_dispatcher'] ?? $this->getEventDispatcherService()));
    }

    /*
     * Gets the private '.legacy_resolve_controller_name_subscriber' shared service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\EventListener\ResolveControllerNameSubscriber
     */
    protected function get_LegacyResolveControllerNameSubscriberService()
    {
        return $this->privates['.legacy_resolve_controller_name_subscriber'] = new \Symfony\Bundle\FrameworkBundle\EventListener\ResolveControllerNameSubscriber(($this->privates['.legacy_controller_name_converter'] ?? ($this->privates['.legacy_controller_name_converter'] = new \Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser(($this->services['kernel'] ?? $this->get('kernel', 1)), false))), false);
    }

    /*
     * Gets the private 'annotations.cached_reader' shared service.
     *
     * @return \Doctrine\Common\Annotations\CachedReader
     */
    protected function getAnnotations_CachedReaderService()
    {
        return $this->privates['annotations.cached_reader'] = new \Doctrine\Common\Annotations\CachedReader(($this->privates['annotations.reader'] ?? $this->getAnnotations_ReaderService()), $this->load('getAnnotations_CacheService.php'), false);
    }

    /*
     * Gets the private 'annotations.reader' shared service.
     *
     * @return \Doctrine\Common\Annotations\AnnotationReader
     */
    protected function getAnnotations_ReaderService()
    {
        $this->privates['annotations.reader'] = $instance = new \Doctrine\Common\Annotations\AnnotationReader();

        $a = new \Doctrine\Common\Annotations\AnnotationRegistry();
        $a->registerUniqueLoader('class_exists');

        $instance->addGlobalIgnoredName('required', $a);

        return $instance;
    }

    /*
     * Gets the private 'api_platform.cache.identifiers_extractor' shared service.
     *
     * @return \Symfony\Component\Cache\Adapter\AdapterInterface
     */
    protected function getApiPlatform_Cache_IdentifiersExtractorService()
    {
        return $this->privates['api_platform.cache.identifiers_extractor'] = \Symfony\Component\Cache\Adapter\AbstractAdapter::createSystemCache('OoOp9bC9VP', 0, $this->getParameter('container.build_id'), ($this->targetDir.''.'/pools'), ($this->privates['monolog.logger.cache'] ?? $this->getMonolog_Logger_CacheService()));
    }

    /*
     * Gets the private 'api_platform.cache.metadata.property' shared service.
     *
     * @return \Symfony\Component\Cache\Adapter\AdapterInterface
     */
    protected function getApiPlatform_Cache_Metadata_PropertyService()
    {
        return $this->privates['api_platform.cache.metadata.property'] = \Symfony\Component\Cache\Adapter\AbstractAdapter::createSystemCache('OeIhYh-unb', 0, $this->getParameter('container.build_id'), ($this->targetDir.''.'/pools'), ($this->privates['monolog.logger.cache'] ?? $this->getMonolog_Logger_CacheService()));
    }

    /*
     * Gets the private 'api_platform.cache.metadata.resource' shared service.
     *
     * @return \Symfony\Component\Cache\Adapter\AdapterInterface
     */
    protected function getApiPlatform_Cache_Metadata_ResourceService()
    {
        return $this->privates['api_platform.cache.metadata.resource'] = \Symfony\Component\Cache\Adapter\AbstractAdapter::createSystemCache('4x8dAynCYN', 0, $this->getParameter('container.build_id'), ($this->targetDir.''.'/pools'), ($this->privates['monolog.logger.cache'] ?? $this->getMonolog_Logger_CacheService()));
    }

    /*
     * Gets the private 'api_platform.cache.route_name_resolver' shared service.
     *
     * @return \Symfony\Component\Cache\Adapter\AdapterInterface
     */
    protected function getApiPlatform_Cache_RouteNameResolverService()
    {
        return $this->privates['api_platform.cache.route_name_resolver'] = \Symfony\Component\Cache\Adapter\AbstractAdapter::createSystemCache('4BKqmH-ZPX', 0, $this->getParameter('container.build_id'), ($this->targetDir.''.'/pools'), ($this->privates['monolog.logger.cache'] ?? $this->getMonolog_Logger_CacheService()));
    }

    /*
     * Gets the private 'api_platform.cache.subresource_operation_factory' shared service.
     *
     * @return \Symfony\Component\Cache\Adapter\AdapterInterface
     */
    protected function getApiPlatform_Cache_SubresourceOperationFactoryService()
    {
        return $this->privates['api_platform.cache.subresource_operation_factory'] = \Symfony\Component\Cache\Adapter\AbstractAdapter::createSystemCache('6hd6l-nkFz', 0, $this->getParameter('container.build_id'), ($this->targetDir.''.'/pools'), ($this->privates['monolog.logger.cache'] ?? $this->getMonolog_Logger_CacheService()));
    }

    /*
     * Gets the private 'api_platform.filter_locator' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    protected function getApiPlatform_FilterLocatorService()
    {
        return $this->privates['api_platform.filter_locator'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($this->getService, [
            'App\\Filter\\Occurrence\\CertaintyFilter' => ['privates', 'App\\Filter\\Occurrence\\CertaintyFilter', 'getCertaintyFilterService.php', true],
            'App\\Filter\\Occurrence\\CountryFilter' => ['privates', 'App\\Filter\\Occurrence\\CountryFilter', 'getCountryFilterService.php', true],
            'App\\Filter\\Occurrence\\CountyFilter' => ['privates', 'App\\Filter\\Occurrence\\CountyFilter', 'getCountyFilterService.php', true],
            'App\\Filter\\Occurrence\\DateObservedDayFilter' => ['privates', 'App\\Filter\\Occurrence\\DateObservedDayFilter', 'getDateObservedDayFilterService.php', true],
            'App\\Filter\\Occurrence\\DateObservedMonthFilter' => ['privates', 'App\\Filter\\Occurrence\\DateObservedMonthFilter', 'getDateObservedMonthFilterService.php', true],
            'App\\Filter\\Occurrence\\DateObservedYearFilter' => ['privates', 'App\\Filter\\Occurrence\\DateObservedYearFilter', 'getDateObservedYearFilterService.php', true],
            'App\\Filter\\Occurrence\\FamilyFilter' => ['privates', 'App\\Filter\\Occurrence\\FamilyFilter', 'getFamilyFilterService.php', true],
            'App\\Filter\\Occurrence\\IdentiplanteScoreFilter' => ['privates', 'App\\Filter\\Occurrence\\IdentiplanteScoreFilter', 'getIdentiplanteScoreFilterService.php', true],
            'App\\Filter\\Occurrence\\IsIdentiplanteValidatedFilter' => ['privates', 'App\\Filter\\Occurrence\\IsIdentiplanteValidatedFilter', 'getIsIdentiplanteValidatedFilterService.php', true],
            'App\\Filter\\Occurrence\\IsPublicFilter' => ['privates', 'App\\Filter\\Occurrence\\IsPublicFilter', 'getIsPublicFilterService.php', true],
            'App\\Filter\\Occurrence\\LocalityFilter' => ['privates', 'App\\Filter\\Occurrence\\LocalityFilter', 'getLocalityFilterService.php', true],
            'App\\Filter\\Occurrence\\ProjectIdFilter' => ['privates', 'App\\Filter\\Occurrence\\ProjectIdFilter', 'getProjectIdFilterService.php', true],
            'App\\Filter\\Occurrence\\TagFilter' => ['privates', 'App\\Filter\\Occurrence\\TagFilter', 'getTagFilterService.php', true],
            'App\\Filter\\Occurrence\\UserSciNameFilter' => ['privates', 'App\\Filter\\Occurrence\\UserSciNameFilter', 'getUserSciNameFilterService.php', true],
            'App\\Filter\\Photo\\CertaintyFilter' => ['privates', 'App\\Filter\\Photo\\CertaintyFilter', 'getCertaintyFilter2Service.php', true],
            'App\\Filter\\Photo\\CountryFilter' => ['privates', 'App\\Filter\\Photo\\CountryFilter', 'getCountryFilter2Service.php', true],
            'App\\Filter\\Photo\\CountyFilter' => ['privates', 'App\\Filter\\Photo\\CountyFilter', 'getCountyFilter2Service.php', true],
            'App\\Filter\\Photo\\DateObservedDayFilter' => ['privates', 'App\\Filter\\Photo\\DateObservedDayFilter', 'getDateObservedDayFilter2Service.php', true],
            'App\\Filter\\Photo\\DateObservedMonthFilter' => ['privates', 'App\\Filter\\Photo\\DateObservedMonthFilter', 'getDateObservedMonthFilter2Service.php', true],
            'App\\Filter\\Photo\\DateObservedYearFilter' => ['privates', 'App\\Filter\\Photo\\DateObservedYearFilter', 'getDateObservedYearFilter2Service.php', true],
            'App\\Filter\\Photo\\DateShotDayFilter' => ['privates', 'App\\Filter\\Photo\\DateShotDayFilter', 'getDateShotDayFilterService.php', true],
            'App\\Filter\\Photo\\DateShotMonthFilter' => ['privates', 'App\\Filter\\Photo\\DateShotMonthFilter', 'getDateShotMonthFilterService.php', true],
            'App\\Filter\\Photo\\DateShotYearFilter' => ['privates', 'App\\Filter\\Photo\\DateShotYearFilter', 'getDateShotYearFilterService.php', true],
            'App\\Filter\\Photo\\FamilyFilter' => ['privates', 'App\\Filter\\Photo\\FamilyFilter', 'getFamilyFilter2Service.php', true],
            'App\\Filter\\Photo\\IsPublicFilter' => ['privates', 'App\\Filter\\Photo\\IsPublicFilter', 'getIsPublicFilter2Service.php', true],
            'App\\Filter\\Photo\\LocalityFilter' => ['privates', 'App\\Filter\\Photo\\LocalityFilter', 'getLocalityFilter2Service.php', true],
            'App\\Filter\\Photo\\ProjectIdFilter' => ['privates', 'App\\Filter\\Photo\\ProjectIdFilter', 'getProjectIdFilter2Service.php', true],
            'App\\Filter\\Photo\\TagFilter' => ['privates', 'App\\Filter\\Photo\\TagFilter', 'getTagFilter2Service.php', true],
            'App\\Filter\\Photo\\UserSciNameFilter' => ['privates', 'App\\Filter\\Photo\\UserSciNameFilter', 'getUserSciNameFilter2Service.php', true],
            'annotated_app_entity_biblio_phyto_api_platform_core_bridge_doctrine_orm_filter_search_filter' => ['privates', 'annotated_app_entity_biblio_phyto_api_platform_core_bridge_doctrine_orm_filter_search_filter', 'getAnnotatedAppEntityBiblioPhytoApiPlatformCoreBridgeDoctrineOrmFilterSearchFilterService.php', true],
            'annotated_app_entity_extended_field_api_platform_core_bridge_doctrine_orm_filter_search_filter' => ['privates', 'annotated_app_entity_extended_field_api_platform_core_bridge_doctrine_orm_filter_search_filter', 'getAnnotatedAppEntityExtendedFieldApiPlatformCoreBridgeDoctrineOrmFilterSearchFilterService.php', true],
            'annotated_app_entity_observer_api_platform_core_bridge_doctrine_orm_filter_search_filter' => ['privates', 'annotated_app_entity_observer_api_platform_core_bridge_doctrine_orm_filter_search_filter', 'getAnnotatedAppEntityObserverApiPlatformCoreBridgeDoctrineOrmFilterSearchFilterService.php', true],
            'annotated_app_entity_user_occurrence_tag_api_platform_core_bridge_doctrine_orm_filter_search_filter' => ['privates', 'annotated_app_entity_user_occurrence_tag_api_platform_core_bridge_doctrine_orm_filter_search_filter', 'getAnnotatedAppEntityUserOccurrenceTagApiPlatformCoreBridgeDoctrineOrmFilterSearchFilterService.php', true],
            'annotated_app_entity_user_profile_cel_api_platform_core_bridge_doctrine_orm_filter_search_filter' => ['privates', 'annotated_app_entity_user_profile_cel_api_platform_core_bridge_doctrine_orm_filter_search_filter', 'getAnnotatedAppEntityUserProfileCelApiPlatformCoreBridgeDoctrineOrmFilterSearchFilterService.php', true],
        ], [
            'App\\Filter\\Occurrence\\CertaintyFilter' => '?',
            'App\\Filter\\Occurrence\\CountryFilter' => '?',
            'App\\Filter\\Occurrence\\CountyFilter' => '?',
            'App\\Filter\\Occurrence\\DateObservedDayFilter' => '?',
            'App\\Filter\\Occurrence\\DateObservedMonthFilter' => '?',
            'App\\Filter\\Occurrence\\DateObservedYearFilter' => '?',
            'App\\Filter\\Occurrence\\FamilyFilter' => '?',
            'App\\Filter\\Occurrence\\IdentiplanteScoreFilter' => '?',
            'App\\Filter\\Occurrence\\IsIdentiplanteValidatedFilter' => '?',
            'App\\Filter\\Occurrence\\IsPublicFilter' => '?',
            'App\\Filter\\Occurrence\\LocalityFilter' => '?',
            'App\\Filter\\Occurrence\\ProjectIdFilter' => '?',
            'App\\Filter\\Occurrence\\TagFilter' => '?',
            'App\\Filter\\Occurrence\\UserSciNameFilter' => '?',
            'App\\Filter\\Photo\\CertaintyFilter' => '?',
            'App\\Filter\\Photo\\CountryFilter' => '?',
            'App\\Filter\\Photo\\CountyFilter' => '?',
            'App\\Filter\\Photo\\DateObservedDayFilter' => '?',
            'App\\Filter\\Photo\\DateObservedMonthFilter' => '?',
            'App\\Filter\\Photo\\DateObservedYearFilter' => '?',
            'App\\Filter\\Photo\\DateShotDayFilter' => '?',
            'App\\Filter\\Photo\\DateShotMonthFilter' => '?',
            'App\\Filter\\Photo\\DateShotYearFilter' => '?',
            'App\\Filter\\Photo\\FamilyFilter' => '?',
            'App\\Filter\\Photo\\IsPublicFilter' => '?',
            'App\\Filter\\Photo\\LocalityFilter' => '?',
            'App\\Filter\\Photo\\ProjectIdFilter' => '?',
            'App\\Filter\\Photo\\TagFilter' => '?',
            'App\\Filter\\Photo\\UserSciNameFilter' => '?',
            'annotated_app_entity_biblio_phyto_api_platform_core_bridge_doctrine_orm_filter_search_filter' => '?',
            'annotated_app_entity_extended_field_api_platform_core_bridge_doctrine_orm_filter_search_filter' => '?',
            'annotated_app_entity_observer_api_platform_core_bridge_doctrine_orm_filter_search_filter' => '?',
            'annotated_app_entity_user_occurrence_tag_api_platform_core_bridge_doctrine_orm_filter_search_filter' => '?',
            'annotated_app_entity_user_profile_cel_api_platform_core_bridge_doctrine_orm_filter_search_filter' => '?',
        ]);
    }

    /*
     * Gets the private 'api_platform.http_cache.listener.response.configure' shared service.
     *
     * @return \ApiPlatform\Core\HttpCache\EventListener\AddHeadersListener
     */
    protected function getApiPlatform_HttpCache_Listener_Response_ConfigureService()
    {
        return $this->privates['api_platform.http_cache.listener.response.configure'] = new \ApiPlatform\Core\HttpCache\EventListener\AddHeadersListener(true, NULL, NULL, $this->parameters['api_platform.http_cache.vary'], NULL, ($this->privates['api_platform.metadata.resource.metadata_factory.cached'] ?? $this->getApiPlatform_Metadata_Resource_MetadataFactory_CachedService()));
    }

    /*
     * Gets the private 'api_platform.hydra.json_schema.schema_factory' shared service.
     *
     * @return \ApiPlatform\Core\Hydra\JsonSchema\SchemaFactory
     */
    protected function getApiPlatform_Hydra_JsonSchema_SchemaFactoryService()
    {
        $a = ($this->privates['api_platform.json_schema.type_factory'] ?? $this->getApiPlatform_JsonSchema_TypeFactoryService());

        if (isset($this->privates['api_platform.hydra.json_schema.schema_factory'])) {
            return $this->privates['api_platform.hydra.json_schema.schema_factory'];
        }

        return $this->privates['api_platform.hydra.json_schema.schema_factory'] = new \ApiPlatform\Core\Hydra\JsonSchema\SchemaFactory(new \ApiPlatform\Core\JsonSchema\SchemaFactory($a, ($this->privates['api_platform.metadata.resource.metadata_factory.cached'] ?? $this->getApiPlatform_Metadata_Resource_MetadataFactory_CachedService()), ($this->privates['api_platform.metadata.property.name_collection_factory.cached'] ?? $this->getApiPlatform_Metadata_Property_NameCollectionFactory_CachedService()), ($this->privates['api_platform.metadata.property.metadata_factory.cached'] ?? $this->getApiPlatform_Metadata_Property_MetadataFactory_CachedService()), ($this->privates['serializer.name_converter.metadata_aware'] ?? $this->getSerializer_NameConverter_MetadataAwareService()), ($this->privates['api_platform.resource_class_resolver'] ?? $this->getApiPlatform_ResourceClassResolverService())));
    }

    /*
     * Gets the private 'api_platform.hydra.listener.response.add_link_header' shared service.
     *
     * @return \ApiPlatform\Core\Hydra\EventListener\AddLinkHeaderListener
     */
    protected function getApiPlatform_Hydra_Listener_Response_AddLinkHeaderService()
    {
        return $this->privates['api_platform.hydra.listener.response.add_link_header'] = new \ApiPlatform\Core\Hydra\EventListener\AddLinkHeaderListener(($this->privates['api_platform.router'] ?? $this->getApiPlatform_RouterService()));
    }

    /*
     * Gets the private 'api_platform.identifier.converter' shared service.
     *
     * @return \ApiPlatform\Core\Identifier\IdentifierConverter
     */
    protected function getApiPlatform_Identifier_ConverterService()
    {
        return $this->privates['api_platform.identifier.converter'] = new \ApiPlatform\Core\Identifier\IdentifierConverter(($this->privates['api_platform.identifiers_extractor.cached'] ?? $this->getApiPlatform_IdentifiersExtractor_CachedService()), ($this->privates['api_platform.metadata.property.metadata_factory.cached'] ?? $this->getApiPlatform_Metadata_Property_MetadataFactory_CachedService()), new RewindableGenerator(function () {
            yield 0 => ($this->privates['api_platform.identifier.integer'] ?? ($this->privates['api_platform.identifier.integer'] = new \ApiPlatform\Core\Identifier\Normalizer\IntegerDenormalizer()));
            yield 1 => ($this->privates['api_platform.identifier.date_normalizer'] ?? ($this->privates['api_platform.identifier.date_normalizer'] = new \ApiPlatform\Core\Identifier\Normalizer\DateTimeIdentifierDenormalizer()));
            yield 2 => ($this->privates['api_platform.identifier.uuid_normalizer'] ?? ($this->privates['api_platform.identifier.uuid_normalizer'] = new \ApiPlatform\Core\Bridge\RamseyUuid\Identifier\Normalizer\UuidNormalizer()));
        }, 3));
    }

    /*
     * Gets the private 'api_platform.identifiers_extractor.cached' shared service.
     *
     * @return \ApiPlatform\Core\Api\CachedIdentifiersExtractor
     */
    protected function getApiPlatform_IdentifiersExtractor_CachedService()
    {
        $a = ($this->privates['property_accessor'] ?? $this->getPropertyAccessorService());
        $b = ($this->privates['api_platform.resource_class_resolver'] ?? $this->getApiPlatform_ResourceClassResolverService());

        return $this->privates['api_platform.identifiers_extractor.cached'] = new \ApiPlatform\Core\Api\CachedIdentifiersExtractor(($this->privates['api_platform.cache.identifiers_extractor'] ?? $this->getApiPlatform_Cache_IdentifiersExtractorService()), new \ApiPlatform\Core\Api\IdentifiersExtractor(($this->privates['api_platform.metadata.property.name_collection_factory.cached'] ?? $this->getApiPlatform_Metadata_Property_NameCollectionFactory_CachedService()), ($this->privates['api_platform.metadata.property.metadata_factory.cached'] ?? $this->getApiPlatform_Metadata_Property_MetadataFactory_CachedService()), $a, $b), $a, $b);
    }

    /*
     * Gets the private 'api_platform.iri_converter' shared service.
     *
     * @return \ApiPlatform\Core\Bridge\Symfony\Routing\IriConverter
     */
    protected function getApiPlatform_IriConverterService()
    {
        $a = ($this->privates['api_platform.router'] ?? $this->getApiPlatform_RouterService());

        return $this->privates['api_platform.iri_converter'] = new \ApiPlatform\Core\Bridge\Symfony\Routing\IriConverter(($this->privates['api_platform.metadata.property.name_collection_factory.cached'] ?? $this->getApiPlatform_Metadata_Property_NameCollectionFactory_CachedService()), ($this->privates['api_platform.metadata.property.metadata_factory.cached'] ?? $this->getApiPlatform_Metadata_Property_MetadataFactory_CachedService()), ($this->privates['api_platform.item_data_provider'] ?? $this->getApiPlatform_ItemDataProviderService()), new \ApiPlatform\Core\Bridge\Symfony\Routing\CachedRouteNameResolver(($this->privates['api_platform.cache.route_name_resolver'] ?? $this->getApiPlatform_Cache_RouteNameResolverService()), new \ApiPlatform\Core\Bridge\Symfony\Routing\RouteNameResolver($a)), $a, ($this->privates['property_accessor'] ?? $this->getPropertyAccessorService()), ($this->privates['api_platform.identifiers_extractor.cached'] ?? $this->getApiPlatform_IdentifiersExtractor_CachedService()), ($this->privates['api_platform.subresource_data_provider'] ?? $this->getApiPlatform_SubresourceDataProviderService()), ($this->privates['api_platform.identifier.converter'] ?? $this->getApiPlatform_Identifier_ConverterService()), ($this->privates['api_platform.resource_class_resolver'] ?? $this->getApiPlatform_ResourceClassResolverService()));
    }

    /*
     * Gets the private 'api_platform.item_data_provider' shared service.
     *
     * @return \ApiPlatform\Core\DataProvider\ChainItemDataProvider
     */
    protected function getApiPlatform_ItemDataProviderService()
    {
        return $this->privates['api_platform.item_data_provider'] = new \ApiPlatform\Core\DataProvider\ChainItemDataProvider(new RewindableGenerator(function () {
            yield 0 => ($this->privates['api_platform.doctrine.orm.default.item_data_provider'] ?? $this->load('getApiPlatform_Doctrine_Orm_Default_ItemDataProviderService.php'));
        }, 1));
    }

    /*
     * Gets the private 'api_platform.json_schema.type_factory' shared service.
     *
     * @return \ApiPlatform\Core\JsonSchema\TypeFactory
     */
    protected function getApiPlatform_JsonSchema_TypeFactoryService()
    {
        $this->privates['api_platform.json_schema.type_factory'] = $instance = new \ApiPlatform\Core\JsonSchema\TypeFactory(($this->privates['api_platform.resource_class_resolver'] ?? $this->getApiPlatform_ResourceClassResolverService()));

        $instance->setSchemaFactory(($this->privates['api_platform.hydra.json_schema.schema_factory'] ?? $this->getApiPlatform_Hydra_JsonSchema_SchemaFactoryService()));

        return $instance;
    }

    /*
     * Gets the private 'api_platform.jsonapi.listener.request.transform_fieldsets_parameters' shared service.
     *
     * @return \ApiPlatform\Core\JsonApi\EventListener\TransformFieldsetsParametersListener
     */
    protected function getApiPlatform_Jsonapi_Listener_Request_TransformFieldsetsParametersService()
    {
        return $this->privates['api_platform.jsonapi.listener.request.transform_fieldsets_parameters'] = new \ApiPlatform\Core\JsonApi\EventListener\TransformFieldsetsParametersListener(($this->privates['api_platform.metadata.resource.metadata_factory.cached'] ?? $this->getApiPlatform_Metadata_Resource_MetadataFactory_CachedService()));
    }

    /*
     * Gets the private 'api_platform.jsonld.context_builder' shared service.
     *
     * @return \ApiPlatform\Core\JsonLd\ContextBuilder
     */
    protected function getApiPlatform_Jsonld_ContextBuilderService()
    {
        return $this->privates['api_platform.jsonld.context_builder'] = new \ApiPlatform\Core\JsonLd\ContextBuilder(($this->privates['api_platform.metadata.resource.name_collection_factory.cached'] ?? $this->getApiPlatform_Metadata_Resource_NameCollectionFactory_CachedService()), ($this->privates['api_platform.metadata.resource.metadata_factory.cached'] ?? $this->getApiPlatform_Metadata_Resource_MetadataFactory_CachedService()), ($this->privates['api_platform.metadata.property.name_collection_factory.cached'] ?? $this->getApiPlatform_Metadata_Property_NameCollectionFactory_CachedService()), ($this->privates['api_platform.metadata.property.metadata_factory.cached'] ?? $this->getApiPlatform_Metadata_Property_MetadataFactory_CachedService()), ($this->privates['api_platform.router'] ?? $this->getApiPlatform_RouterService()));
    }

    /*
     * Gets the private 'api_platform.listener.request.add_format' shared service.
     *
     * @return \ApiPlatform\Core\EventListener\AddFormatListener
     */
    protected function getApiPlatform_Listener_Request_AddFormatService()
    {
        return $this->privates['api_platform.listener.request.add_format'] = new \ApiPlatform\Core\EventListener\AddFormatListener(new \Negotiation\Negotiator(), ($this->privates['api_platform.metadata.resource.metadata_factory.cached'] ?? $this->getApiPlatform_Metadata_Resource_MetadataFactory_CachedService()), $this->parameters['api_platform.formats']);
    }

    /*
     * Gets the private 'api_platform.listener.request.deserialize' shared service.
     *
     * @return \ApiPlatform\Core\EventListener\DeserializeListener
     */
    protected function getApiPlatform_Listener_Request_DeserializeService()
    {
        return $this->privates['api_platform.listener.request.deserialize'] = new \ApiPlatform\Core\EventListener\DeserializeListener(($this->services['serializer'] ?? $this->getSerializerService()), ($this->privates['api_platform.serializer.context_builder.filter'] ?? $this->getApiPlatform_Serializer_ContextBuilder_FilterService()), ($this->privates['api_platform.metadata.resource.metadata_factory.cached'] ?? $this->getApiPlatform_Metadata_Resource_MetadataFactory_CachedService()));
    }

    /*
     * Gets the private 'api_platform.listener.request.read' shared service.
     *
     * @return \ApiPlatform\Core\EventListener\ReadListener
     */
    protected function getApiPlatform_Listener_Request_ReadService()
    {
        return $this->privates['api_platform.listener.request.read'] = new \ApiPlatform\Core\EventListener\ReadListener(new \ApiPlatform\Core\DataProvider\ChainCollectionDataProvider(new RewindableGenerator(function () {
            yield 0 => ($this->privates['App\\DataProvider\\OccurrenceCollectionDataProvider'] ?? $this->load('getOccurrenceCollectionDataProviderService.php'));
            yield 1 => ($this->privates['App\\DataProvider\\PhotoCollectionDataProvider'] ?? $this->load('getPhotoCollectionDataProviderService.php'));
            yield 2 => ($this->privates['App\\DataProvider\\PhotoTagCollectionDataProvider'] ?? $this->load('getPhotoTagCollectionDataProviderService.php'));
            yield 3 => ($this->privates['App\\DataProvider\\UserOccurrenceTagCollectionDataProvider'] ?? $this->load('getUserOccurrenceTagCollectionDataProviderService.php'));
            yield 4 => ($this->privates['api_platform.doctrine.orm.default.collection_data_provider'] ?? $this->load('getApiPlatform_Doctrine_Orm_Default_CollectionDataProviderService.php'));
        }, 5)), ($this->privates['api_platform.item_data_provider'] ?? $this->getApiPlatform_ItemDataProviderService()), ($this->privates['api_platform.subresource_data_provider'] ?? $this->getApiPlatform_SubresourceDataProviderService()), ($this->privates['api_platform.serializer.context_builder.filter'] ?? $this->getApiPlatform_Serializer_ContextBuilder_FilterService()), ($this->privates['api_platform.identifier.converter'] ?? $this->getApiPlatform_Identifier_ConverterService()), ($this->privates['api_platform.metadata.resource.metadata_factory.cached'] ?? $this->getApiPlatform_Metadata_Resource_MetadataFactory_CachedService()));
    }

    /*
     * Gets the private 'api_platform.listener.view.validate_query_parameters' shared service.
     *
     * @return \ApiPlatform\Core\Filter\QueryParameterValidateListener
     */
    protected function getApiPlatform_Listener_View_ValidateQueryParametersService()
    {
        return $this->privates['api_platform.listener.view.validate_query_parameters'] = new \ApiPlatform\Core\Filter\QueryParameterValidateListener(($this->privates['api_platform.metadata.resource.metadata_factory.cached'] ?? $this->getApiPlatform_Metadata_Resource_MetadataFactory_CachedService()), ($this->privates['api_platform.filter_locator'] ?? $this->getApiPlatform_FilterLocatorService()));
    }

    /*
     * Gets the private 'api_platform.metadata.property.metadata_factory.cached' shared service.
     *
     * @return \ApiPlatform\Core\Metadata\Property\Factory\CachedPropertyMetadataFactory
     */
    protected function getApiPlatform_Metadata_Property_MetadataFactory_CachedService()
    {
        $a = ($this->privates['annotations.cached_reader'] ?? $this->getAnnotations_CachedReaderService());

        return $this->privates['api_platform.metadata.property.metadata_factory.cached'] = new \ApiPlatform\Core\Metadata\Property\Factory\CachedPropertyMetadataFactory(($this->privates['api_platform.cache.metadata.property'] ?? $this->getApiPlatform_Cache_Metadata_PropertyService()), new \ApiPlatform\Core\Bridge\Symfony\Validator\Metadata\Property\ValidatorPropertyMetadataFactory(($this->services['validator'] ?? $this->getValidatorService()), new \ApiPlatform\Core\Metadata\Property\Factory\ExtractorPropertyMetadataFactory(($this->privates['api_platform.metadata.extractor.yaml'] ?? ($this->privates['api_platform.metadata.extractor.yaml'] = new \ApiPlatform\Core\Metadata\Extractor\YamlExtractor([], $this))), new \ApiPlatform\Core\Metadata\Property\Factory\AnnotationPropertyMetadataFactory($a, new \ApiPlatform\Core\Metadata\Property\Factory\AnnotationSubresourceMetadataFactory($a, new \ApiPlatform\Core\Metadata\Property\Factory\SerializerPropertyMetadataFactory(($this->privates['api_platform.metadata.resource.metadata_factory.cached'] ?? $this->getApiPlatform_Metadata_Resource_MetadataFactory_CachedService()), ($this->privates['serializer.mapping.cache_class_metadata_factory'] ?? $this->getSerializer_Mapping_CacheClassMetadataFactoryService()), new \ApiPlatform\Core\Bridge\Doctrine\Orm\Metadata\Property\DoctrineOrmPropertyMetadataFactory(($this->services['doctrine'] ?? $this->getDoctrineService()), new \ApiPlatform\Core\Metadata\Property\Factory\InheritedPropertyMetadataFactory(($this->privates['api_platform.metadata.resource.name_collection_factory.cached'] ?? $this->getApiPlatform_Metadata_Resource_NameCollectionFactory_CachedService()), new \ApiPlatform\Core\Bridge\Symfony\PropertyInfo\Metadata\Property\PropertyInfoPropertyMetadataFactory(($this->privates['property_info.cache'] ?? $this->getPropertyInfo_CacheService()), new \ApiPlatform\Core\Metadata\Property\Factory\ExtractorPropertyMetadataFactory(($this->privates['api_platform.metadata.extractor.xml'] ?? ($this->privates['api_platform.metadata.extractor.xml'] = new \ApiPlatform\Core\Metadata\Extractor\XmlExtractor([], $this))))))), ($this->privates['api_platform.resource_class_resolver'] ?? $this->getApiPlatform_ResourceClassResolverService())))))));
    }

    /*
     * Gets the private 'api_platform.metadata.property.name_collection_factory.cached' shared service.
     *
     * @return \ApiPlatform\Core\Metadata\Property\Factory\CachedPropertyNameCollectionFactory
     */
    protected function getApiPlatform_Metadata_Property_NameCollectionFactory_CachedService()
    {
        return $this->privates['api_platform.metadata.property.name_collection_factory.cached'] = new \ApiPlatform\Core\Metadata\Property\Factory\CachedPropertyNameCollectionFactory(($this->privates['api_platform.cache.metadata.property'] ?? $this->getApiPlatform_Cache_Metadata_PropertyService()), new \ApiPlatform\Core\Metadata\Property\Factory\ExtractorPropertyNameCollectionFactory(($this->privates['api_platform.metadata.extractor.yaml'] ?? ($this->privates['api_platform.metadata.extractor.yaml'] = new \ApiPlatform\Core\Metadata\Extractor\YamlExtractor([], $this))), new \ApiPlatform\Core\Metadata\Property\Factory\ExtractorPropertyNameCollectionFactory(($this->privates['api_platform.metadata.extractor.xml'] ?? ($this->privates['api_platform.metadata.extractor.xml'] = new \ApiPlatform\Core\Metadata\Extractor\XmlExtractor([], $this))), new \ApiPlatform\Core\Metadata\Property\Factory\InheritedPropertyNameCollectionFactory(($this->privates['api_platform.metadata.resource.name_collection_factory.cached'] ?? $this->getApiPlatform_Metadata_Resource_NameCollectionFactory_CachedService()), new \ApiPlatform\Core\Bridge\Symfony\PropertyInfo\Metadata\Property\PropertyInfoPropertyNameCollectionFactory(($this->privates['property_info.cache'] ?? $this->getPropertyInfo_CacheService()))))));
    }

    /*
     * Gets the private 'api_platform.metadata.resource.metadata_factory.cached' shared service.
     *
     * @return \ApiPlatform\Core\Metadata\Resource\Factory\CachedResourceMetadataFactory
     */
    protected function getApiPlatform_Metadata_Resource_MetadataFactory_CachedService()
    {
        $a = ($this->privates['annotations.cached_reader'] ?? $this->getAnnotations_CachedReaderService());

        return $this->privates['api_platform.metadata.resource.metadata_factory.cached'] = new \ApiPlatform\Core\Metadata\Resource\Factory\CachedResourceMetadataFactory(($this->privates['api_platform.cache.metadata.resource'] ?? $this->getApiPlatform_Cache_Metadata_ResourceService()), new \ApiPlatform\Core\Metadata\Resource\Factory\FormatsResourceMetadataFactory(new \ApiPlatform\Core\Metadata\Resource\Factory\OperationResourceMetadataFactory(new \ApiPlatform\Core\Metadata\Resource\Factory\AnnotationResourceFilterMetadataFactory($a, new \ApiPlatform\Core\Metadata\Resource\Factory\ShortNameResourceMetadataFactory(new \ApiPlatform\Core\Metadata\Resource\Factory\PhpDocResourceMetadataFactory(new \ApiPlatform\Core\Metadata\Resource\Factory\InputOutputResourceMetadataFactory(new \ApiPlatform\Core\Metadata\Resource\Factory\ExtractorResourceMetadataFactory(($this->privates['api_platform.metadata.extractor.yaml'] ?? ($this->privates['api_platform.metadata.extractor.yaml'] = new \ApiPlatform\Core\Metadata\Extractor\YamlExtractor([], $this))), new \ApiPlatform\Core\Metadata\Resource\Factory\AnnotationResourceMetadataFactory($a, new \ApiPlatform\Core\Metadata\Resource\Factory\ExtractorResourceMetadataFactory(($this->privates['api_platform.metadata.extractor.xml'] ?? ($this->privates['api_platform.metadata.extractor.xml'] = new \ApiPlatform\Core\Metadata\Extractor\XmlExtractor([], $this)))))))))), $this->parameters['api_platform.patch_formats']), $this->parameters['api_platform.formats'], $this->parameters['api_platform.patch_formats']));
    }

    /*
     * Gets the private 'api_platform.metadata.resource.name_collection_factory.cached' shared service.
     *
     * @return \ApiPlatform\Core\Metadata\Resource\Factory\CachedResourceNameCollectionFactory
     */
    protected function getApiPlatform_Metadata_Resource_NameCollectionFactory_CachedService()
    {
        return $this->privates['api_platform.metadata.resource.name_collection_factory.cached'] = new \ApiPlatform\Core\Metadata\Resource\Factory\CachedResourceNameCollectionFactory(($this->privates['api_platform.cache.metadata.resource'] ?? $this->getApiPlatform_Cache_Metadata_ResourceService()), new \ApiPlatform\Core\Metadata\Resource\Factory\ExtractorResourceNameCollectionFactory(($this->privates['api_platform.metadata.extractor.yaml'] ?? ($this->privates['api_platform.metadata.extractor.yaml'] = new \ApiPlatform\Core\Metadata\Extractor\YamlExtractor([], $this))), new \ApiPlatform\Core\Metadata\Resource\Factory\AnnotationResourceNameCollectionFactory(($this->privates['annotations.cached_reader'] ?? $this->getAnnotations_CachedReaderService()), $this->parameters['api_platform.resource_class_directories'], new \ApiPlatform\Core\Metadata\Resource\Factory\ExtractorResourceNameCollectionFactory(($this->privates['api_platform.metadata.extractor.xml'] ?? ($this->privates['api_platform.metadata.extractor.xml'] = new \ApiPlatform\Core\Metadata\Extractor\XmlExtractor([], $this)))))));
    }

    /*
     * Gets the private 'api_platform.operation_path_resolver.custom' shared service.
     *
     * @return \ApiPlatform\Core\PathResolver\CustomOperationPathResolver
     */
    protected function getApiPlatform_OperationPathResolver_CustomService()
    {
        return $this->privates['api_platform.operation_path_resolver.custom'] = new \ApiPlatform\Core\PathResolver\CustomOperationPathResolver(new \ApiPlatform\Core\PathResolver\OperationPathResolver(($this->privates['api_platform.path_segment_name_generator.underscore'] ?? ($this->privates['api_platform.path_segment_name_generator.underscore'] = new \ApiPlatform\Core\Operation\UnderscorePathSegmentNameGenerator()))));
    }

    /*
     * Gets the private 'api_platform.resource_class_resolver' shared service.
     *
     * @return \ApiPlatform\Core\Api\ResourceClassResolver
     */
    protected function getApiPlatform_ResourceClassResolverService()
    {
        return $this->privates['api_platform.resource_class_resolver'] = new \ApiPlatform\Core\Api\ResourceClassResolver(($this->privates['api_platform.metadata.resource.name_collection_factory.cached'] ?? $this->getApiPlatform_Metadata_Resource_NameCollectionFactory_CachedService()));
    }

    /*
     * Gets the private 'api_platform.router' shared service.
     *
     * @return \ApiPlatform\Core\Bridge\Symfony\Routing\Router
     */
    protected function getApiPlatform_RouterService()
    {
        return $this->privates['api_platform.router'] = new \ApiPlatform\Core\Bridge\Symfony\Routing\Router(($this->services['router'] ?? $this->getRouterService()));
    }

    /*
     * Gets the private 'api_platform.security.listener.request.deny_access' shared service.
     *
     * @return \ApiPlatform\Core\Security\EventListener\DenyAccessListener
     */
    protected function getApiPlatform_Security_Listener_Request_DenyAccessService()
    {
        return $this->privates['api_platform.security.listener.request.deny_access'] = new \ApiPlatform\Core\Security\EventListener\DenyAccessListener(($this->privates['api_platform.metadata.resource.metadata_factory.cached'] ?? $this->getApiPlatform_Metadata_Resource_MetadataFactory_CachedService()), new \ApiPlatform\Core\Security\ResourceAccessChecker(($this->privates['security.expression_language'] ?? $this->getSecurity_ExpressionLanguageService()), ($this->privates['security.authentication.trust_resolver'] ?? ($this->privates['security.authentication.trust_resolver'] = new \Symfony\Component\Security\Core\Authentication\AuthenticationTrustResolver(NULL, NULL))), ($this->privates['security.role_hierarchy'] ?? ($this->privates['security.role_hierarchy'] = new \Symfony\Component\Security\Core\Role\RoleHierarchy([]))), ($this->services['security.token_storage'] ?? $this->getSecurity_TokenStorageService()), ($this->services['security.authorization_checker'] ?? $this->getSecurity_AuthorizationCheckerService())));
    }

    /*
     * Gets the private 'api_platform.serializer.context_builder.filter' shared service.
     *
     * @return \ApiPlatform\Core\Serializer\SerializerFilterContextBuilder
     */
    protected function getApiPlatform_Serializer_ContextBuilder_FilterService()
    {
        $a = ($this->privates['api_platform.metadata.resource.metadata_factory.cached'] ?? $this->getApiPlatform_Metadata_Resource_MetadataFactory_CachedService());

        return $this->privates['api_platform.serializer.context_builder.filter'] = new \ApiPlatform\Core\Serializer\SerializerFilterContextBuilder($a, ($this->privates['api_platform.filter_locator'] ?? $this->getApiPlatform_FilterLocatorService()), new \ApiPlatform\Core\Serializer\SerializerContextBuilder($a));
    }

    /*
     * Gets the private 'api_platform.subresource_data_provider' shared service.
     *
     * @return \ApiPlatform\Core\DataProvider\ChainSubresourceDataProvider
     */
    protected function getApiPlatform_SubresourceDataProviderService()
    {
        return $this->privates['api_platform.subresource_data_provider'] = new \ApiPlatform\Core\DataProvider\ChainSubresourceDataProvider(new RewindableGenerator(function () {
            yield 0 => ($this->privates['api_platform.doctrine.orm.default.subresource_data_provider'] ?? $this->load('getApiPlatform_Doctrine_Orm_Default_SubresourceDataProviderService.php'));
        }, 1));
    }

    /*
     * Gets the private 'api_platform.subresource_operation_factory.cached' shared service.
     *
     * @return \ApiPlatform\Core\Operation\Factory\CachedSubresourceOperationFactory
     */
    protected function getApiPlatform_SubresourceOperationFactory_CachedService()
    {
        return $this->privates['api_platform.subresource_operation_factory.cached'] = new \ApiPlatform\Core\Operation\Factory\CachedSubresourceOperationFactory(($this->privates['api_platform.cache.subresource_operation_factory'] ?? $this->getApiPlatform_Cache_SubresourceOperationFactoryService()), new \ApiPlatform\Core\Operation\Factory\SubresourceOperationFactory(($this->privates['api_platform.metadata.resource.metadata_factory.cached'] ?? $this->getApiPlatform_Metadata_Resource_MetadataFactory_CachedService()), ($this->privates['api_platform.metadata.property.name_collection_factory.cached'] ?? $this->getApiPlatform_Metadata_Property_NameCollectionFactory_CachedService()), ($this->privates['api_platform.metadata.property.metadata_factory.cached'] ?? $this->getApiPlatform_Metadata_Property_MetadataFactory_CachedService()), ($this->privates['api_platform.path_segment_name_generator.underscore'] ?? ($this->privates['api_platform.path_segment_name_generator.underscore'] = new \ApiPlatform\Core\Operation\UnderscorePathSegmentNameGenerator()))));
    }

    /*
     * Gets the private 'app.event.listener.xcount.response.listener' shared autowired service.
     *
     * @return \App\EventListener\XcountResponseListener
     */
    protected function getApp_Event_Listener_Xcount_Response_ListenerService()
    {
        return $this->privates['app.event.listener.xcount.response.listener'] = new \App\EventListener\XcountResponseListener(($this->privates['security.helper'] ?? $this->getSecurity_HelperService()), ($this->services['fos_elastica.manager.orm'] ?? $this->getFosElastica_Manager_OrmService()), ($this->services['security.token_storage'] ?? $this->getSecurity_TokenStorageService()));
    }

    /*
     * Gets the private 'cache.property_access' shared service.
     *
     * @return \Symfony\Component\Cache\Adapter\AdapterInterface
     */
    protected function getCache_PropertyAccessService()
    {
        return $this->privates['cache.property_access'] = \Symfony\Component\PropertyAccess\PropertyAccessor::createCache('MpnnRWz32M', 0, $this->getParameter('container.build_id'), ($this->privates['monolog.logger.cache'] ?? $this->getMonolog_Logger_CacheService()));
    }

    /*
     * Gets the private 'cache.property_info' shared service.
     *
     * @return \Symfony\Component\Cache\Adapter\AdapterInterface
     */
    protected function getCache_PropertyInfoService()
    {
        return $this->privates['cache.property_info'] = \Symfony\Component\Cache\Adapter\AbstractAdapter::createSystemCache('YSoVr9sjHF', 0, $this->getParameter('container.build_id'), ($this->targetDir.''.'/pools'), ($this->privates['monolog.logger.cache'] ?? $this->getMonolog_Logger_CacheService()));
    }

    /*
     * Gets the private 'cache.security_expression_language' shared service.
     *
     * @return \Symfony\Component\Cache\Adapter\AdapterInterface
     */
    protected function getCache_SecurityExpressionLanguageService()
    {
        return $this->privates['cache.security_expression_language'] = \Symfony\Component\Cache\Adapter\AbstractAdapter::createSystemCache('B8iERH-SsM', 0, $this->getParameter('container.build_id'), ($this->targetDir.''.'/pools'), ($this->privates['monolog.logger.cache'] ?? $this->getMonolog_Logger_CacheService()));
    }

    /*
     * Gets the private 'cache.serializer' shared service.
     *
     * @return \Symfony\Component\Cache\Adapter\AdapterInterface
     */
    protected function getCache_SerializerService()
    {
        return $this->privates['cache.serializer'] = \Symfony\Component\Cache\Adapter\AbstractAdapter::createSystemCache('G+4cOTEA11', 0, $this->getParameter('container.build_id'), ($this->targetDir.''.'/pools'), ($this->privates['monolog.logger.cache'] ?? $this->getMonolog_Logger_CacheService()));
    }

    /*
     * Gets the private 'cache.validator' shared service.
     *
     * @return \Symfony\Component\Cache\Adapter\AdapterInterface
     */
    protected function getCache_ValidatorService()
    {
        return $this->privates['cache.validator'] = \Symfony\Component\Cache\Adapter\AbstractAdapter::createSystemCache('yESfBPVzI2', 0, $this->getParameter('container.build_id'), ($this->targetDir.''.'/pools'), ($this->privates['monolog.logger.cache'] ?? $this->getMonolog_Logger_CacheService()));
    }

    /*
     * Gets the private 'debug.debug_handlers_listener' shared service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\DebugHandlersListener
     */
    protected function getDebug_DebugHandlersListenerService()
    {
        $a = new \Symfony\Bridge\Monolog\Logger('php');
        $a->pushHandler(($this->privates['monolog.handler.deprecation_filter'] ?? $this->getMonolog_Handler_DeprecationFilterService()));
        $a->pushHandler(($this->privates['monolog.handler.console'] ?? $this->getMonolog_Handler_ConsoleService()));
        $a->pushHandler(($this->privates['monolog.handler.main'] ?? $this->getMonolog_Handler_MainService()));

        return $this->privates['debug.debug_handlers_listener'] = new \Symfony\Component\HttpKernel\EventListener\DebugHandlersListener(NULL, $a, NULL, 0, false, ($this->privates['debug.file_link_formatter'] ?? ($this->privates['debug.file_link_formatter'] = new \Symfony\Component\HttpKernel\Debug\FileLinkFormatter(NULL))), false);
    }

    /*
     * Gets the private 'doctrine.result_cache_pool' shared service.
     *
     * @return \Symfony\Component\Cache\Adapter\FilesystemAdapter
     */
    protected function getDoctrine_ResultCachePoolService()
    {
        $this->privates['doctrine.result_cache_pool'] = $instance = new \Symfony\Component\Cache\Adapter\FilesystemAdapter('ZQT+W8-rlT', 0, ($this->targetDir.''.'/pools'), ($this->privates['cache.default_marshaller'] ?? ($this->privates['cache.default_marshaller'] = new \Symfony\Component\Cache\Marshaller\DefaultMarshaller(NULL))));

        $instance->setLogger(($this->privates['monolog.logger.cache'] ?? $this->getMonolog_Logger_CacheService()));

        return $instance;
    }

    /*
     * Gets the private 'doctrine.system_cache_pool' shared service.
     *
     * @return \Symfony\Component\Cache\Adapter\AdapterInterface
     */
    protected function getDoctrine_SystemCachePoolService()
    {
        return $this->privates['doctrine.system_cache_pool'] = \Symfony\Component\Cache\Adapter\AbstractAdapter::createSystemCache('-SvYn1B6Iw', 0, $this->getParameter('container.build_id'), ($this->targetDir.''.'/pools'), ($this->privates['monolog.logger.cache'] ?? $this->getMonolog_Logger_CacheService()));
    }

    /*
     * Gets the private 'framework_extra_bundle.argument_name_convertor' shared service.
     *
     * @return \Sensio\Bundle\FrameworkExtraBundle\Request\ArgumentNameConverter
     */
    protected function getFrameworkExtraBundle_ArgumentNameConvertorService()
    {
        return $this->privates['framework_extra_bundle.argument_name_convertor'] = new \Sensio\Bundle\FrameworkExtraBundle\Request\ArgumentNameConverter(($this->privates['argument_metadata_factory'] ?? ($this->privates['argument_metadata_factory'] = new \Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadataFactory())));
    }

    /*
     * Gets the private 'framework_extra_bundle.event.is_granted' shared service.
     *
     * @return \Sensio\Bundle\FrameworkExtraBundle\EventListener\IsGrantedListener
     */
    protected function getFrameworkExtraBundle_Event_IsGrantedService()
    {
        return $this->privates['framework_extra_bundle.event.is_granted'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\IsGrantedListener(($this->privates['framework_extra_bundle.argument_name_convertor'] ?? $this->getFrameworkExtraBundle_ArgumentNameConvertorService()), ($this->services['security.authorization_checker'] ?? $this->getSecurity_AuthorizationCheckerService()));
    }

    /*
     * Gets the private 'locale_aware_listener' shared service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\LocaleAwareListener
     */
    protected function getLocaleAwareListenerService()
    {
        return $this->privates['locale_aware_listener'] = new \Symfony\Component\HttpKernel\EventListener\LocaleAwareListener(new RewindableGenerator(function () {
            yield 0 => ($this->services['translator'] ?? $this->getTranslatorService());
        }, 1), ($this->services['request_stack'] ?? ($this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack())));
    }

    /*
     * Gets the private 'locale_listener' shared service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\LocaleListener
     */
    protected function getLocaleListenerService()
    {
        return $this->privates['locale_listener'] = new \Symfony\Component\HttpKernel\EventListener\LocaleListener(($this->services['request_stack'] ?? ($this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack())), 'en', ($this->services['router'] ?? $this->getRouterService()));
    }

    /*
     * Gets the private 'mime_types' shared service.
     *
     * @return \Symfony\Component\Mime\MimeTypes
     */
    protected function getMimeTypesService()
    {
        $this->privates['mime_types'] = $instance = new \Symfony\Component\Mime\MimeTypes();

        $instance->setDefault($instance);

        return $instance;
    }

    /*
     * Gets the private 'monolog.handler.console' shared service.
     *
     * @return \Symfony\Bridge\Monolog\Handler\ConsoleHandler
     */
    protected function getMonolog_Handler_ConsoleService()
    {
        return $this->privates['monolog.handler.console'] = new \Symfony\Bridge\Monolog\Handler\ConsoleHandler(NULL, true, [], []);
    }

    /*
     * Gets the private 'monolog.handler.deprecation' shared service.
     *
     * @return \Monolog\Handler\StreamHandler
     */
    protected function getMonolog_Handler_DeprecationService()
    {
        $this->privates['monolog.handler.deprecation'] = $instance = new \Monolog\Handler\StreamHandler((\dirname(__DIR__, 3).'/log/prod.deprecations.log'), 100, true, NULL, false);

        $instance->pushProcessor(($this->privates['monolog.processor.psr_log_message'] ?? ($this->privates['monolog.processor.psr_log_message'] = new \Monolog\Processor\PsrLogMessageProcessor())));

        return $instance;
    }

    /*
     * Gets the private 'monolog.handler.deprecation_filter' shared service.
     *
     * @return \Monolog\Handler\FilterHandler
     */
    protected function getMonolog_Handler_DeprecationFilterService()
    {
        return $this->privates['monolog.handler.deprecation_filter'] = new \Monolog\Handler\FilterHandler(($this->privates['monolog.handler.deprecation'] ?? $this->getMonolog_Handler_DeprecationService()), 100, 200, true);
    }

    /*
     * Gets the private 'monolog.handler.main' shared service.
     *
     * @return \Monolog\Handler\FingersCrossedHandler
     */
    protected function getMonolog_Handler_MainService()
    {
        $a = new \Monolog\Handler\StreamHandler((\dirname(__DIR__, 3).'/log/prod.log'), 100, true, NULL, false);
        $a->pushProcessor(($this->privates['monolog.processor.psr_log_message'] ?? ($this->privates['monolog.processor.psr_log_message'] = new \Monolog\Processor\PsrLogMessageProcessor())));

        return $this->privates['monolog.handler.main'] = new \Monolog\Handler\FingersCrossedHandler($a, new \Symfony\Bridge\Monolog\Handler\FingersCrossed\NotFoundActivationStrategy(($this->services['request_stack'] ?? ($this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack())), [0 => '^/'], 400), 0, true, true, NULL);
    }

    /*
     * Gets the private 'monolog.logger' shared service.
     *
     * @return \Symfony\Bridge\Monolog\Logger
     */
    protected function getMonolog_LoggerService()
    {
        $this->privates['monolog.logger'] = $instance = new \Symfony\Bridge\Monolog\Logger('app');

        $instance->useMicrosecondTimestamps(true);
        $instance->pushHandler(($this->privates['monolog.handler.console'] ?? $this->getMonolog_Handler_ConsoleService()));
        $instance->pushHandler(($this->privates['monolog.handler.main'] ?? $this->getMonolog_Handler_MainService()));

        return $instance;
    }

    /*
     * Gets the private 'monolog.logger.cache' shared service.
     *
     * @return \Symfony\Bridge\Monolog\Logger
     */
    protected function getMonolog_Logger_CacheService()
    {
        $this->privates['monolog.logger.cache'] = $instance = new \Symfony\Bridge\Monolog\Logger('cache');

        $instance->pushHandler(($this->privates['monolog.handler.console'] ?? $this->getMonolog_Handler_ConsoleService()));
        $instance->pushHandler(($this->privates['monolog.handler.main'] ?? $this->getMonolog_Handler_MainService()));

        return $instance;
    }

    /*
     * Gets the private 'monolog.logger.request' shared service.
     *
     * @return \Symfony\Bridge\Monolog\Logger
     */
    protected function getMonolog_Logger_RequestService()
    {
        $this->privates['monolog.logger.request'] = $instance = new \Symfony\Bridge\Monolog\Logger('request');

        $instance->pushHandler(($this->privates['monolog.handler.console'] ?? $this->getMonolog_Handler_ConsoleService()));
        $instance->pushHandler(($this->privates['monolog.handler.main'] ?? $this->getMonolog_Handler_MainService()));

        return $instance;
    }

    /*
     * Gets the private 'nelmio_cors.cors_listener' shared service.
     *
     * @return \Nelmio\CorsBundle\EventListener\CorsListener
     */
    protected function getNelmioCors_CorsListenerService()
    {
        return $this->privates['nelmio_cors.cors_listener'] = new \Nelmio\CorsBundle\EventListener\CorsListener(new \Nelmio\CorsBundle\Options\Resolver([0 => new \Nelmio\CorsBundle\Options\ConfigProvider($this->parameters['nelmio_cors.map'], $this->getParameter('nelmio_cors.defaults'))]));
    }

    /*
     * Gets the private 'parameter_bag' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ParameterBag\ContainerBag
     */
    protected function getParameterBagService()
    {
        return $this->privates['parameter_bag'] = new \Symfony\Component\DependencyInjection\ParameterBag\ContainerBag($this);
    }

    /*
     * Gets the private 'property_accessor' shared service.
     *
     * @return \Symfony\Component\PropertyAccess\PropertyAccessor
     */
    protected function getPropertyAccessorService()
    {
        return $this->privates['property_accessor'] = new \Symfony\Component\PropertyAccess\PropertyAccessor(false, false, ($this->privates['cache.property_access'] ?? $this->getCache_PropertyAccessService()), true);
    }

    /*
     * Gets the private 'property_info.cache' shared service.
     *
     * @return \Symfony\Component\PropertyInfo\PropertyInfoCacheExtractor
     */
    protected function getPropertyInfo_CacheService()
    {
        return $this->privates['property_info.cache'] = new \Symfony\Component\PropertyInfo\PropertyInfoCacheExtractor(new \Symfony\Component\PropertyInfo\PropertyInfoExtractor(new RewindableGenerator(function () {
            yield 0 => ($this->privates['property_info.serializer_extractor'] ?? $this->load('getPropertyInfo_SerializerExtractorService.php'));
            yield 1 => ($this->privates['property_info.reflection_extractor'] ?? ($this->privates['property_info.reflection_extractor'] = new \Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor()));
            yield 2 => ($this->privates['doctrine.orm.default_entity_manager.property_info_extractor'] ?? $this->load('getDoctrine_Orm_DefaultEntityManager_PropertyInfoExtractorService.php'));
        }, 3), new RewindableGenerator(function () {
            yield 0 => ($this->privates['doctrine.orm.default_entity_manager.property_info_extractor'] ?? $this->load('getDoctrine_Orm_DefaultEntityManager_PropertyInfoExtractorService.php'));
            yield 1 => ($this->privates['property_info.php_doc_extractor'] ?? ($this->privates['property_info.php_doc_extractor'] = new \Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor()));
            yield 2 => ($this->privates['property_info.reflection_extractor'] ?? ($this->privates['property_info.reflection_extractor'] = new \Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor()));
        }, 3), new RewindableGenerator(function () {
            yield 0 => ($this->privates['property_info.php_doc_extractor'] ?? ($this->privates['property_info.php_doc_extractor'] = new \Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor()));
        }, 1), new RewindableGenerator(function () {
            yield 0 => ($this->privates['doctrine.orm.default_entity_manager.property_info_extractor'] ?? $this->load('getDoctrine_Orm_DefaultEntityManager_PropertyInfoExtractorService.php'));
            yield 1 => ($this->privates['property_info.reflection_extractor'] ?? ($this->privates['property_info.reflection_extractor'] = new \Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor()));
        }, 2), new RewindableGenerator(function () {
            yield 0 => ($this->privates['property_info.reflection_extractor'] ?? ($this->privates['property_info.reflection_extractor'] = new \Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor()));
        }, 1)), ($this->privates['cache.property_info'] ?? $this->getCache_PropertyInfoService()));
    }

    /*
     * Gets the private 'router.request_context' shared service.
     *
     * @return \Symfony\Component\Routing\RequestContext
     */
    protected function getRouter_RequestContextService()
    {
        return $this->privates['router.request_context'] = new \Symfony\Component\Routing\RequestContext('', 'GET', 'localhost', 'http', 80, 443);
    }

    /*
     * Gets the private 'router_listener' shared service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\RouterListener
     */
    protected function getRouterListenerService()
    {
        return $this->privates['router_listener'] = new \Symfony\Component\HttpKernel\EventListener\RouterListener(($this->services['router'] ?? $this->getRouterService()), ($this->services['request_stack'] ?? ($this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack())), ($this->privates['router.request_context'] ?? $this->getRouter_RequestContextService()), ($this->privates['monolog.logger.request'] ?? $this->getMonolog_Logger_RequestService()), \dirname(__DIR__, 4), false);
    }

    /*
     * Gets the private 'security.access.decision_manager' shared service.
     *
     * @return \Symfony\Component\Security\Core\Authorization\AccessDecisionManager
     */
    protected function getSecurity_Access_DecisionManagerService()
    {
        return $this->privates['security.access.decision_manager'] = new \Symfony\Component\Security\Core\Authorization\AccessDecisionManager(new RewindableGenerator(function () {
            yield 0 => ($this->privates['security.access.authenticated_voter'] ?? $this->load('getSecurity_Access_AuthenticatedVoterService.php'));
            yield 1 => ($this->privates['security.access.simple_role_voter'] ?? ($this->privates['security.access.simple_role_voter'] = new \Symfony\Component\Security\Core\Authorization\Voter\RoleVoter()));
            yield 2 => ($this->privates['security.access.expression_voter'] ?? $this->load('getSecurity_Access_ExpressionVoterService.php'));
            yield 3 => ($this->privates['App\\Security\\Authorization\\BaseVoter'] ?? ($this->privates['App\\Security\\Authorization\\BaseVoter'] = new \App\Security\Authorization\BaseVoter()));
            yield 4 => ($this->privates['App\\Security\\Authorization\\ExtendedFieldOccurrenceVoter'] ?? ($this->privates['App\\Security\\Authorization\\ExtendedFieldOccurrenceVoter'] = new \App\Security\Authorization\ExtendedFieldOccurrenceVoter()));
            yield 5 => ($this->privates['App\\Security\\Authorization\\OccurrenceUserOccurrenceTagRelationVoter'] ?? ($this->privates['App\\Security\\Authorization\\OccurrenceUserOccurrenceTagRelationVoter'] = new \App\Security\Authorization\OccurrenceUserOccurrenceTagRelationVoter()));
            yield 6 => ($this->privates['App\\Security\\Authorization\\OccurrenceVoter'] ?? ($this->privates['App\\Security\\Authorization\\OccurrenceVoter'] = new \App\Security\Authorization\OccurrenceVoter()));
            yield 7 => ($this->privates['App\\Security\\Authorization\\PhotoPhotoTagRelationVoter'] ?? ($this->privates['App\\Security\\Authorization\\PhotoPhotoTagRelationVoter'] = new \App\Security\Authorization\PhotoPhotoTagRelationVoter()));
            yield 8 => ($this->privates['App\\Security\\Authorization\\PhotoVoter'] ?? ($this->privates['App\\Security\\Authorization\\PhotoVoter'] = new \App\Security\Authorization\PhotoVoter()));
            yield 9 => ($this->privates['security.acccess.occurrence_voter'] ?? ($this->privates['security.acccess.occurrence_voter'] = new \App\Security\Authorization\OccurrenceVoter()));
            yield 10 => ($this->privates['security.acccess.photo_voter'] ?? ($this->privates['security.acccess.photo_voter'] = new \App\Security\Authorization\PhotoVoter()));
            yield 11 => ($this->privates['security.acccess.extended_field_occurrence_voter'] ?? ($this->privates['security.acccess.extended_field_occurrence_voter'] = new \App\Security\Authorization\ExtendedFieldOccurrenceVoter()));
            yield 12 => ($this->privates['security.acccess.occurrence_user_occurrence_tag_relation_voter'] ?? ($this->privates['security.acccess.occurrence_user_occurrence_tag_relation_voter'] = new \App\Security\Authorization\OccurrenceUserOccurrenceTagRelationVoter()));
            yield 13 => ($this->privates['security.acccess.photo_photo_tag_relation_voter'] ?? ($this->privates['security.acccess.photo_photo_tag_relation_voter'] = new \App\Security\Authorization\PhotoPhotoTagRelationVoter()));
            yield 14 => ($this->privates['security.access.base_voter'] ?? ($this->privates['security.access.base_voter'] = new \App\Security\Authorization\BaseVoter()));
        }, 15), 'affirmative', false, true);
    }

    /*
     * Gets the private 'security.authentication.manager' shared service.
     *
     * @return \Symfony\Component\Security\Core\Authentication\AuthenticationProviderManager
     */
    protected function getSecurity_Authentication_ManagerService()
    {
        $this->privates['security.authentication.manager'] = $instance = new \Symfony\Component\Security\Core\Authentication\AuthenticationProviderManager(new RewindableGenerator(function () {
            yield 0 => ($this->privates['security.authentication.provider.guard.main'] ?? $this->load('getSecurity_Authentication_Provider_Guard_MainService.php'));
            yield 1 => ($this->privates['security.authentication.provider.anonymous.main'] ?? ($this->privates['security.authentication.provider.anonymous.main'] = new \Symfony\Component\Security\Core\Authentication\Provider\AnonymousAuthenticationProvider($this->getParameter('container.build_hash'))));
        }, 2), true);

        $instance->setEventDispatcher(($this->services['event_dispatcher'] ?? $this->getEventDispatcherService()));

        return $instance;
    }

    /*
     * Gets the private 'security.expression_language' shared service.
     *
     * @return \Symfony\Component\Security\Core\Authorization\ExpressionLanguage
     */
    protected function getSecurity_ExpressionLanguageService()
    {
        $this->privates['security.expression_language'] = $instance = new \Symfony\Component\Security\Core\Authorization\ExpressionLanguage(($this->privates['cache.security_expression_language'] ?? $this->getCache_SecurityExpressionLanguageService()));

        $instance->registerProvider(($this->privates['api_platform.security.expression_language_provider'] ?? ($this->privates['api_platform.security.expression_language_provider'] = new \ApiPlatform\Core\Security\Core\Authorization\ExpressionLanguageProvider())));

        return $instance;
    }

    /*
     * Gets the private 'security.firewall' shared service.
     *
     * @return \Symfony\Bundle\SecurityBundle\EventListener\FirewallListener
     */
    protected function getSecurity_FirewallService()
    {
        return $this->privates['security.firewall'] = new \Symfony\Bundle\SecurityBundle\EventListener\FirewallListener(new \Symfony\Bundle\SecurityBundle\Security\FirewallMap(new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($this->getService, [
            'security.firewall.map.context.dev' => ['privates', 'security.firewall.map.context.dev', 'getSecurity_Firewall_Map_Context_DevService.php', true],
            'security.firewall.map.context.main' => ['privates', 'security.firewall.map.context.main', 'getSecurity_Firewall_Map_Context_MainService.php', true],
        ], [
            'security.firewall.map.context.dev' => '?',
            'security.firewall.map.context.main' => '?',
        ]), new RewindableGenerator(function () {
            yield 'security.firewall.map.context.dev' => ($this->privates['.security.request_matcher.Iy.T22O'] ?? ($this->privates['.security.request_matcher.Iy.T22O'] = new \Symfony\Component\HttpFoundation\RequestMatcher('^/(_(profiler|wdt)|css|images|js)/')));
            yield 'security.firewall.map.context.main' => NULL;
        }, 2)), ($this->services['event_dispatcher'] ?? $this->getEventDispatcherService()), ($this->privates['security.logout_url_generator'] ?? $this->getSecurity_LogoutUrlGeneratorService()));
    }

    /*
     * Gets the private 'security.helper' shared service.
     *
     * @return \Symfony\Component\Security\Core\Security
     */
    protected function getSecurity_HelperService()
    {
        return $this->privates['security.helper'] = new \Symfony\Component\Security\Core\Security(new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($this->getService, [
            'security.authorization_checker' => ['services', 'security.authorization_checker', 'getSecurity_AuthorizationCheckerService', false],
            'security.token_storage' => ['services', 'security.token_storage', 'getSecurity_TokenStorageService', false],
        ], [
            'security.authorization_checker' => '?',
            'security.token_storage' => '?',
        ]));
    }

    /*
     * Gets the private 'security.logout_url_generator' shared service.
     *
     * @return \Symfony\Component\Security\Http\Logout\LogoutUrlGenerator
     */
    protected function getSecurity_LogoutUrlGeneratorService()
    {
        $this->privates['security.logout_url_generator'] = $instance = new \Symfony\Component\Security\Http\Logout\LogoutUrlGenerator(($this->services['request_stack'] ?? ($this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack())), ($this->services['router'] ?? $this->getRouterService()), ($this->services['security.token_storage'] ?? $this->getSecurity_TokenStorageService()));

        $instance->registerListener('main', '/logout', 'logout', '_csrf_token', NULL, NULL);

        return $instance;
    }

    /*
     * Gets the private 'sensio_framework_extra.controller.listener' shared service.
     *
     * @return \Sensio\Bundle\FrameworkExtraBundle\EventListener\ControllerListener
     */
    protected function getSensioFrameworkExtra_Controller_ListenerService()
    {
        return $this->privates['sensio_framework_extra.controller.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\ControllerListener(($this->privates['annotations.cached_reader'] ?? $this->getAnnotations_CachedReaderService()));
    }

    /*
     * Gets the private 'sensio_framework_extra.converter.listener' shared service.
     *
     * @return \Sensio\Bundle\FrameworkExtraBundle\EventListener\ParamConverterListener
     */
    protected function getSensioFrameworkExtra_Converter_ListenerService()
    {
        $a = new \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterManager();
        $a->add(new \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\DoctrineParamConverter(($this->services['doctrine'] ?? $this->getDoctrineService()), new \Symfony\Component\ExpressionLanguage\ExpressionLanguage()), 0, 'doctrine.orm');
        $a->add(new \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\DateTimeParamConverter(), 0, 'datetime');

        return $this->privates['sensio_framework_extra.converter.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\ParamConverterListener($a, true);
    }

    /*
     * Gets the private 'sensio_framework_extra.security.listener' shared service.
     *
     * @return \Sensio\Bundle\FrameworkExtraBundle\EventListener\SecurityListener
     */
    protected function getSensioFrameworkExtra_Security_ListenerService()
    {
        $a = new \Sensio\Bundle\FrameworkExtraBundle\Security\ExpressionLanguage();
        $a->registerProvider(($this->privates['api_platform.security.expression_language_provider'] ?? ($this->privates['api_platform.security.expression_language_provider'] = new \ApiPlatform\Core\Security\Core\Authorization\ExpressionLanguageProvider())));

        return $this->privates['sensio_framework_extra.security.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\SecurityListener(($this->privates['framework_extra_bundle.argument_name_convertor'] ?? $this->getFrameworkExtraBundle_ArgumentNameConvertorService()), $a, ($this->privates['security.authentication.trust_resolver'] ?? ($this->privates['security.authentication.trust_resolver'] = new \Symfony\Component\Security\Core\Authentication\AuthenticationTrustResolver(NULL, NULL))), ($this->privates['security.role_hierarchy'] ?? ($this->privates['security.role_hierarchy'] = new \Symfony\Component\Security\Core\Role\RoleHierarchy([]))), ($this->services['security.token_storage'] ?? $this->getSecurity_TokenStorageService()), ($this->services['security.authorization_checker'] ?? $this->getSecurity_AuthorizationCheckerService()), ($this->privates['monolog.logger'] ?? $this->getMonolog_LoggerService()));
    }

    /*
     * Gets the private 'sensio_framework_extra.view.listener' shared service.
     *
     * @return \Sensio\Bundle\FrameworkExtraBundle\EventListener\TemplateListener
     */
    protected function getSensioFrameworkExtra_View_ListenerService()
    {
        return $this->privates['sensio_framework_extra.view.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\TemplateListener(new \Sensio\Bundle\FrameworkExtraBundle\Templating\TemplateGuesser(($this->services['kernel'] ?? $this->get('kernel', 1))), ($this->services['twig'] ?? $this->getTwigService()));
    }

    /*
     * Gets the private 'serializer.mapping.cache_class_metadata_factory' shared service.
     *
     * @return \Symfony\Component\Serializer\Mapping\Factory\CacheClassMetadataFactory
     */
    protected function getSerializer_Mapping_CacheClassMetadataFactoryService()
    {
        return $this->privates['serializer.mapping.cache_class_metadata_factory'] = new \Symfony\Component\Serializer\Mapping\Factory\CacheClassMetadataFactory(new \Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory(new \Symfony\Component\Serializer\Mapping\Loader\LoaderChain([0 => new \Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader(($this->privates['annotations.cached_reader'] ?? $this->getAnnotations_CachedReaderService()))]), NULL), \Symfony\Component\Cache\Adapter\PhpArrayAdapter::create(($this->targetDir.''.'/serialization.php'), ($this->privates['cache.serializer'] ?? $this->getCache_SerializerService())));
    }

    /*
     * Gets the private 'serializer.name_converter.metadata_aware' shared service.
     *
     * @return \Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter
     */
    protected function getSerializer_NameConverter_MetadataAwareService()
    {
        return $this->privates['serializer.name_converter.metadata_aware'] = new \Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter(($this->privates['serializer.mapping.cache_class_metadata_factory'] ?? $this->getSerializer_Mapping_CacheClassMetadataFactoryService()));
    }

    /*
     * Gets the private 'session_listener' shared service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\SessionListener
     */
    protected function getSessionListenerService()
    {
        return $this->privates['session_listener'] = new \Symfony\Component\HttpKernel\EventListener\SessionListener(new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($this->getService, [
            'initialized_session' => ['services', 'session', NULL, true],
            'session' => ['services', 'session', 'getSessionService.php', true],
        ], [
            'initialized_session' => '?',
            'session' => '?',
        ]));
    }

    /*
     * Gets the private 'validator.builder' shared service.
     *
     * @return \Symfony\Component\Validator\ValidatorBuilder
     */
    protected function getValidator_BuilderService()
    {
        $this->privates['validator.builder'] = $instance = \Symfony\Component\Validator\Validation::createValidatorBuilder();

        $a = ($this->privates['property_info.cache'] ?? $this->getPropertyInfo_CacheService());

        $instance->setConstraintValidatorFactory(new \Symfony\Component\Validator\ContainerConstraintValidatorFactory(new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($this->getService, [
            'App\\Validator\\NoDuplicateConstraintValidator' => ['privates', 'app.validator.listener.no.duplicate.constraint.validator', 'getApp_Validator_Listener_No_Duplicate_Constraint_ValidatorService.php', true],
            'Symfony\\Bridge\\Doctrine\\Validator\\Constraints\\UniqueEntityValidator' => ['privates', 'doctrine.orm.validator.unique', 'getDoctrine_Orm_Validator_UniqueService.php', true],
            'Symfony\\Component\\Security\\Core\\Validator\\Constraints\\UserPasswordValidator' => ['privates', 'security.validator.user_password', 'getSecurity_Validator_UserPasswordService.php', true],
            'Symfony\\Component\\Validator\\Constraints\\EmailValidator' => ['privates', 'validator.email', 'getValidator_EmailService.php', true],
            'Symfony\\Component\\Validator\\Constraints\\ExpressionValidator' => ['privates', 'validator.expression', 'getValidator_ExpressionService.php', true],
            'Symfony\\Component\\Validator\\Constraints\\NotCompromisedPasswordValidator' => ['privates', 'validator.not_compromised_password', 'getValidator_NotCompromisedPasswordService.php', true],
            'doctrine.orm.validator.unique' => ['privates', 'doctrine.orm.validator.unique', 'getDoctrine_Orm_Validator_UniqueService.php', true],
            'security.validator.user_password' => ['privates', 'security.validator.user_password', 'getSecurity_Validator_UserPasswordService.php', true],
            'validator.expression' => ['privates', 'validator.expression', 'getValidator_ExpressionService.php', true],
        ], [
            'App\\Validator\\NoDuplicateConstraintValidator' => '?',
            'Symfony\\Bridge\\Doctrine\\Validator\\Constraints\\UniqueEntityValidator' => '?',
            'Symfony\\Component\\Security\\Core\\Validator\\Constraints\\UserPasswordValidator' => '?',
            'Symfony\\Component\\Validator\\Constraints\\EmailValidator' => '?',
            'Symfony\\Component\\Validator\\Constraints\\ExpressionValidator' => '?',
            'Symfony\\Component\\Validator\\Constraints\\NotCompromisedPasswordValidator' => '?',
            'doctrine.orm.validator.unique' => '?',
            'security.validator.user_password' => '?',
            'validator.expression' => '?',
        ])));
        $instance->setTranslator(new \Symfony\Component\Validator\Util\LegacyTranslatorProxy(($this->services['translator'] ?? $this->getTranslatorService())));
        $instance->setTranslationDomain('validators');
        $instance->addXmlMappings([0 => (\dirname(__DIR__, 4).'/vendor/symfony/form/Resources/config/validation.xml')]);
        $instance->enableAnnotationMapping(($this->privates['annotations.cached_reader'] ?? $this->getAnnotations_CachedReaderService()));
        $instance->addMethodMapping('loadValidatorMetadata');
        $instance->setMappingCache(\Symfony\Component\Cache\Adapter\PhpArrayAdapter::create(($this->targetDir.''.'/validation.php'), ($this->privates['cache.validator'] ?? $this->getCache_ValidatorService())));
        $instance->addObjectInitializers([0 => new \Symfony\Bridge\Doctrine\Validator\DoctrineInitializer(($this->services['doctrine'] ?? $this->getDoctrineService()))]);
        $instance->addLoader(new \Symfony\Component\Validator\Mapping\Loader\PropertyInfoLoader($a, $a, $a, NULL));
        $instance->addLoader(new \Symfony\Bridge\Doctrine\Validator\DoctrineLoader(($this->services['doctrine.orm.default_entity_manager'] ?? $this->getDoctrine_Orm_DefaultEntityManagerService()), NULL));

        return $instance;
    }

    /*
     * Gets the private 'vich_uploader.metadata_reader' shared service.
     *
     * @return \Vich\UploaderBundle\Metadata\MetadataReader
     */
    protected function getVichUploader_MetadataReaderService()
    {
        $a = new \Metadata\Driver\FileLocator([]);

        $b = new \Metadata\MetadataFactory(new \Metadata\Driver\DriverChain([0 => new \Vich\UploaderBundle\Metadata\Driver\XmlDriver($a), 1 => new \Vich\UploaderBundle\Metadata\Driver\AnnotationDriver(($this->privates['annotations.cached_reader'] ?? $this->getAnnotations_CachedReaderService())), 2 => new \Vich\UploaderBundle\Metadata\Driver\YamlDriver($a)]), 'Metadata\\ClassHierarchyMetadata', false);
        $b->setCache(new \Metadata\Cache\FileCache(($this->targetDir.''.'/vich_uploader')));

        return $this->privates['vich_uploader.metadata_reader'] = new \Vich\UploaderBundle\Metadata\MetadataReader($b);
    }

    /*
     * Gets the private 'vich_uploader.property_mapping_factory' shared service.
     *
     * @return \Vich\UploaderBundle\Mapping\PropertyMappingFactory
     */
    protected function getVichUploader_PropertyMappingFactoryService()
    {
        return $this->privates['vich_uploader.property_mapping_factory'] = new \Vich\UploaderBundle\Mapping\PropertyMappingFactory($this, ($this->privates['vich_uploader.metadata_reader'] ?? $this->getVichUploader_MetadataReaderService()), $this->parameters['vich_uploader.mappings'], '_name');
    }

    /*
     * Gets the private 'vich_uploader.storage.file_system' shared service.
     *
     * @return \Vich\UploaderBundle\Storage\FileSystemStorage
     */
    protected function getVichUploader_Storage_FileSystemService()
    {
        return $this->privates['vich_uploader.storage.file_system'] = new \Vich\UploaderBundle\Storage\FileSystemStorage(($this->privates['vich_uploader.property_mapping_factory'] ?? $this->getVichUploader_PropertyMappingFactoryService()));
    }

    public function getParameter($name)
    {
        $name = (string) $name;
        if (isset($this->buildParameters[$name])) {
            return $this->buildParameters[$name];
        }

        if (!(isset($this->parameters[$name]) || isset($this->loadedDynamicParameters[$name]) || array_key_exists($name, $this->parameters))) {
            throw new InvalidArgumentException(sprintf('The parameter "%s" must be defined.', $name));
        }
        if (isset($this->loadedDynamicParameters[$name])) {
            return $this->loadedDynamicParameters[$name] ? $this->dynamicParameters[$name] : $this->getDynamicParameter($name);
        }

        return $this->parameters[$name];
    }

    public function hasParameter($name): bool
    {
        $name = (string) $name;
        if (isset($this->buildParameters[$name])) {
            return true;
        }

        return isset($this->parameters[$name]) || isset($this->loadedDynamicParameters[$name]) || array_key_exists($name, $this->parameters);
    }

    public function setParameter($name, $value): void
    {
        throw new LogicException('Impossible to call set() on a frozen ParameterBag.');
    }

    public function getParameterBag(): ParameterBagInterface
    {
        if (null === $this->parameterBag) {
            $parameters = $this->parameters;
            foreach ($this->loadedDynamicParameters as $name => $loaded) {
                $parameters[$name] = $loaded ? $this->dynamicParameters[$name] : $this->getDynamicParameter($name);
            }
            foreach ($this->buildParameters as $name => $value) {
                $parameters[$name] = $value;
            }
            $this->parameterBag = new FrozenParameterBag($parameters);
        }

        return $this->parameterBag;
    }

    private $loadedDynamicParameters = [
        'kernel.cache_dir' => false,
        'kernel.secret' => false,
        'session.save_path' => false,
        'validator.mapping.cache.file' => false,
        'serializer.mapping.cache.file' => false,
        'nelmio_cors.defaults' => false,
        'doctrine.orm.proxy_dir' => false,
    ];
    private $dynamicParameters = [];

    private function getDynamicParameter(string $name)
    {
        switch ($name) {
            case 'kernel.cache_dir': $value = $this->targetDir.''; break;
            case 'kernel.secret': $value = $this->getEnv('APP_SECRET'); break;
            case 'session.save_path': $value = ($this->targetDir.''.'/sessions'); break;
            case 'validator.mapping.cache.file': $value = ($this->targetDir.''.'/validation.php'); break;
            case 'serializer.mapping.cache.file': $value = ($this->targetDir.''.'/serialization.php'); break;
            case 'nelmio_cors.defaults': $value = [
                'allow_origin' => [
                    0 => $this->getEnv('CORS_ALLOW_ORIGIN'),
                ],
                'allow_credentials' => false,
                'allow_headers' => [
                    0 => 'content-type',
                    1 => 'authorization',
                    2 => 'x-count',
                ],
                'expose_headers' => [
                    0 => 'Content-Disposition',
                    1 => 'Content-Length',
                    2 => 'Link',
                    3 => 'X-count',
                ],
                'allow_methods' => [
                    0 => 'GET',
                    1 => 'OPTIONS',
                    2 => 'POST',
                    3 => 'PUT',
                    4 => 'PATCH',
                    5 => 'DELETE',
                ],
                'max_age' => 3600,
                'hosts' => [

                ],
                'origin_regex' => true,
                'forced_allow_origin_value' => NULL,
            ]; break;
            case 'doctrine.orm.proxy_dir': $value = ($this->targetDir.''.'/doctrine/orm/Proxies'); break;
            default: throw new InvalidArgumentException(sprintf('The dynamic parameter "%s" must be defined.', $name));
        }
        $this->loadedDynamicParameters[$name] = true;

        return $this->dynamicParameters[$name] = $value;
    }

    protected function getDefaultParameters(): array
    {
        return [
            'kernel.root_dir' => (\dirname(__DIR__, 4).'/src'),
            'kernel.project_dir' => \dirname(__DIR__, 4),
            'kernel.environment' => 'prod',
            'kernel.debug' => false,
            'kernel.name' => 'src',
            'kernel.logs_dir' => (\dirname(__DIR__, 3).'/log'),
            'kernel.bundles' => [
                'FrameworkBundle' => 'Symfony\\Bundle\\FrameworkBundle\\FrameworkBundle',
                'TwigBundle' => 'Symfony\\Bundle\\TwigBundle\\TwigBundle',
                'SecurityBundle' => 'Symfony\\Bundle\\SecurityBundle\\SecurityBundle',
                'NelmioCorsBundle' => 'Nelmio\\CorsBundle\\NelmioCorsBundle',
                'DoctrineBundle' => 'Doctrine\\Bundle\\DoctrineBundle\\DoctrineBundle',
                'ApiPlatformBundle' => 'ApiPlatform\\Core\\Bridge\\Symfony\\Bundle\\ApiPlatformBundle',
                'FOSElasticaBundle' => 'FOS\\ElasticaBundle\\FOSElasticaBundle',
                'VichUploaderBundle' => 'Vich\\UploaderBundle\\VichUploaderBundle',
                'SensioFrameworkExtraBundle' => 'Sensio\\Bundle\\FrameworkExtraBundle\\SensioFrameworkExtraBundle',
                'MonologBundle' => 'Symfony\\Bundle\\MonologBundle\\MonologBundle',
                'JMSSerializerBundle' => 'JMS\\SerializerBundle\\JMSSerializerBundle',
                'FreshVichUploaderSerializationBundle' => 'Fresh\\VichUploaderSerializationBundle\\FreshVichUploaderSerializationBundle',
                'EnqueueBundle' => 'Enqueue\\Bundle\\EnqueueBundle',
                'EnqueueElasticaBundle' => 'Enqueue\\ElasticaBundle\\EnqueueElasticaBundle',
                'LiipImagineBundle' => 'Liip\\ImagineBundle\\LiipImagineBundle',
            ],
            'kernel.bundles_metadata' => [
                'FrameworkBundle' => [
                    'path' => (\dirname(__DIR__, 4).'/vendor/symfony/framework-bundle'),
                    'namespace' => 'Symfony\\Bundle\\FrameworkBundle',
                ],
                'TwigBundle' => [
                    'path' => (\dirname(__DIR__, 4).'/vendor/symfony/twig-bundle'),
                    'namespace' => 'Symfony\\Bundle\\TwigBundle',
                ],
                'SecurityBundle' => [
                    'path' => (\dirname(__DIR__, 4).'/vendor/symfony/security-bundle'),
                    'namespace' => 'Symfony\\Bundle\\SecurityBundle',
                ],
                'NelmioCorsBundle' => [
                    'path' => (\dirname(__DIR__, 4).'/vendor/nelmio/cors-bundle'),
                    'namespace' => 'Nelmio\\CorsBundle',
                ],
                'DoctrineBundle' => [
                    'path' => (\dirname(__DIR__, 4).'/vendor/doctrine/doctrine-bundle'),
                    'namespace' => 'Doctrine\\Bundle\\DoctrineBundle',
                ],
                'ApiPlatformBundle' => [
                    'path' => (\dirname(__DIR__, 4).'/vendor/api-platform/core/src/Bridge/Symfony/Bundle'),
                    'namespace' => 'ApiPlatform\\Core\\Bridge\\Symfony\\Bundle',
                ],
                'FOSElasticaBundle' => [
                    'path' => (\dirname(__DIR__, 4).'/vendor/friendsofsymfony/elastica-bundle/src'),
                    'namespace' => 'FOS\\ElasticaBundle',
                ],
                'VichUploaderBundle' => [
                    'path' => (\dirname(__DIR__, 4).'/vendor/vich/uploader-bundle'),
                    'namespace' => 'Vich\\UploaderBundle',
                ],
                'SensioFrameworkExtraBundle' => [
                    'path' => (\dirname(__DIR__, 4).'/vendor/sensio/framework-extra-bundle/src'),
                    'namespace' => 'Sensio\\Bundle\\FrameworkExtraBundle',
                ],
                'MonologBundle' => [
                    'path' => (\dirname(__DIR__, 4).'/vendor/symfony/monolog-bundle'),
                    'namespace' => 'Symfony\\Bundle\\MonologBundle',
                ],
                'JMSSerializerBundle' => [
                    'path' => (\dirname(__DIR__, 4).'/vendor/jms/serializer-bundle'),
                    'namespace' => 'JMS\\SerializerBundle',
                ],
                'FreshVichUploaderSerializationBundle' => [
                    'path' => (\dirname(__DIR__, 4).'/vendor/fresh/vich-uploader-serialization-bundle'),
                    'namespace' => 'Fresh\\VichUploaderSerializationBundle',
                ],
                'EnqueueBundle' => [
                    'path' => (\dirname(__DIR__, 4).'/vendor/enqueue/enqueue-bundle'),
                    'namespace' => 'Enqueue\\Bundle',
                ],
                'EnqueueElasticaBundle' => [
                    'path' => (\dirname(__DIR__, 4).'/vendor/enqueue/elastica-bundle'),
                    'namespace' => 'Enqueue\\ElasticaBundle',
                ],
                'LiipImagineBundle' => [
                    'path' => (\dirname(__DIR__, 4).'/vendor/liip/imagine-bundle'),
                    'namespace' => 'Liip\\ImagineBundle',
                ],
            ],
            'kernel.charset' => 'UTF-8',
            'kernel.container_class' => 'srcApp_KernelProdContainer',
            'container.autowiring.strict_mode' => true,
            'container.dumper.inline_class_loader' => true,
            'env(DATABASE_URL)' => '',
            'locale' => 'fr',
            'fragment.renderer.hinclude.global_template' => '',
            'fragment.path' => '/_fragment',
            'kernel.http_method_override' => true,
            'kernel.trusted_hosts' => [

            ],
            'kernel.default_locale' => 'en',
            'kernel.error_controller' => 'error_controller',
            'templating.helper.code.file_link_format' => NULL,
            'debug.file_link_format' => NULL,
            'session.metadata.storage_key' => '_sf2_meta',
            'session.storage.options' => [
                'cache_limiter' => '0',
                'cookie_httponly' => true,
                'gc_probability' => 1,
            ],
            'session.metadata.update_threshold' => 0,
            'form.type_extension.csrf.enabled' => true,
            'form.type_extension.csrf.field_name' => '_token',
            'asset.request_context.base_path' => '',
            'asset.request_context.secure' => false,
            'validator.mapping.cache.prefix' => '',
            'validator.translation_domain' => 'validators',
            'translator.logging' => false,
            'translator.default_path' => (\dirname(__DIR__, 4).'/translations'),
            'data_collector.templates' => [

            ],
            'debug.error_handler.throw_at' => 0,
            'router.request_context.host' => 'localhost',
            'router.request_context.scheme' => 'http',
            'router.request_context.base_url' => '',
            'router.resource' => 'kernel::loadRoutes',
            'router.cache_class_prefix' => 'srcApp_KernelProdContainer',
            'request_listener.http_port' => 80,
            'request_listener.https_port' => 443,
            'serializer.mapping.cache.prefix' => '',
            'twig.exception_listener.controller' => 'twig.controller.exception::showAction',
            'twig.form.resources' => [
                0 => '@VichUploader/Form/fields.html.twig',
                1 => 'form_div_layout.html.twig',
                2 => '@LiipImagine/Form/form_div_layout.html.twig',
            ],
            'twig.default_path' => (\dirname(__DIR__, 4).'/templates'),
            'security.authentication.trust_resolver.anonymous_class' => NULL,
            'security.authentication.trust_resolver.rememberme_class' => NULL,
            'security.role_hierarchy.roles' => [

            ],
            'security.access.denied_url' => NULL,
            'security.authentication.manager.erase_credentials' => true,
            'security.authentication.session_strategy.strategy' => 'migrate',
            'security.access.always_authenticate_before_granting' => false,
            'security.authentication.hide_user_not_found' => true,
            'nelmio_cors.map' => [
                '^/api/' => [
                    'allow_origin' => true,
                    'allow_headers' => true,
                    'allow_methods' => [
                        0 => 'POST',
                        1 => 'PUT',
                        2 => 'PATCH',
                        3 => 'GET',
                        4 => 'DELETE',
                    ],
                    'max_age' => 3600,
                ],
            ],
            'nelmio_cors.cors_listener.class' => 'Nelmio\\CorsBundle\\EventListener\\CorsListener',
            'nelmio_cors.options_resolver.class' => 'Nelmio\\CorsBundle\\Options\\Resolver',
            'nelmio_cors.options_provider.config.class' => 'Nelmio\\CorsBundle\\Options\\ConfigProvider',
            'doctrine.dbal.logger.chain.class' => 'Doctrine\\DBAL\\Logging\\LoggerChain',
            'doctrine.dbal.logger.profiling.class' => 'Doctrine\\DBAL\\Logging\\DebugStack',
            'doctrine.dbal.logger.class' => 'Symfony\\Bridge\\Doctrine\\Logger\\DbalLogger',
            'doctrine.dbal.configuration.class' => 'Doctrine\\DBAL\\Configuration',
            'doctrine.data_collector.class' => 'Doctrine\\Bundle\\DoctrineBundle\\DataCollector\\DoctrineDataCollector',
            'doctrine.dbal.connection.event_manager.class' => 'Symfony\\Bridge\\Doctrine\\ContainerAwareEventManager',
            'doctrine.dbal.connection_factory.class' => 'Doctrine\\Bundle\\DoctrineBundle\\ConnectionFactory',
            'doctrine.dbal.events.mysql_session_init.class' => 'Doctrine\\DBAL\\Event\\Listeners\\MysqlSessionInit',
            'doctrine.dbal.events.oracle_session_init.class' => 'Doctrine\\DBAL\\Event\\Listeners\\OracleSessionInit',
            'doctrine.class' => 'Doctrine\\Bundle\\DoctrineBundle\\Registry',
            'doctrine.entity_managers' => [
                'default' => 'doctrine.orm.default_entity_manager',
            ],
            'doctrine.default_entity_manager' => 'default',
            'doctrine.dbal.connection_factory.types' => [
                'taxorepoenum' => [
                    'class' => 'App\\DBAL\\TaxoRepoEnumType',
                ],
                'occurrencetypeenum' => [
                    'class' => 'App\\DBAL\\OccurrenceTypeEnumType',
                ],
                'inputsourceenum' => [
                    'class' => 'App\\DBAL\\InputSourceEnumType',
                ],
                'phenologyenum' => [
                    'class' => 'App\\DBAL\\PhenologyEnumType',
                ],
                'certaintyenum' => [
                    'class' => 'App\\DBAL\\CertaintyEnumType',
                ],
                'publishedlocationenum' => [
                    'class' => 'App\\DBAL\\PublishedLocationEnumType',
                ],
                'locationtypeenum' => [
                    'class' => 'App\\DBAL\\LocationTypeEnumType',
                ],
                'taxorestrictiontypeenum' => [
                    'class' => 'App\\DBAL\\TaxoRestrictionTypeEnumType',
                ],
                'fielddatatypeenum' => [
                    'class' => 'App\\DBAL\\FieldDataTypeEnumType',
                ],
                'languageenum' => [
                    'class' => 'App\\DBAL\\LanguageEnumType',
                ],
                'locationaccuracytypeenum' => [
                    'class' => 'App\\DBAL\\LocationAccuracyEnumType',
                ],
                'vllocationaccuracytypeenum' => [
                    'class' => 'App\\DBAL\\VlLocationAccuracyEnumType',
                ],
                'dateprecisionenum' => [
                    'class' => 'App\\DBAL\\DatePrecisionEnumType',
                ],
            ],
            'doctrine.connections' => [
                'default' => 'doctrine.dbal.default_connection',
            ],
            'doctrine.default_connection' => 'default',
            'doctrine.orm.configuration.class' => 'Doctrine\\ORM\\Configuration',
            'doctrine.orm.entity_manager.class' => 'Doctrine\\ORM\\EntityManager',
            'doctrine.orm.manager_configurator.class' => 'Doctrine\\Bundle\\DoctrineBundle\\ManagerConfigurator',
            'doctrine.orm.cache.array.class' => 'Doctrine\\Common\\Cache\\ArrayCache',
            'doctrine.orm.cache.apc.class' => 'Doctrine\\Common\\Cache\\ApcCache',
            'doctrine.orm.cache.memcache.class' => 'Doctrine\\Common\\Cache\\MemcacheCache',
            'doctrine.orm.cache.memcache_host' => 'localhost',
            'doctrine.orm.cache.memcache_port' => 11211,
            'doctrine.orm.cache.memcache_instance.class' => 'Memcache',
            'doctrine.orm.cache.memcached.class' => 'Doctrine\\Common\\Cache\\MemcachedCache',
            'doctrine.orm.cache.memcached_host' => 'localhost',
            'doctrine.orm.cache.memcached_port' => 11211,
            'doctrine.orm.cache.memcached_instance.class' => 'Memcached',
            'doctrine.orm.cache.redis.class' => 'Doctrine\\Common\\Cache\\RedisCache',
            'doctrine.orm.cache.redis_host' => 'localhost',
            'doctrine.orm.cache.redis_port' => 6379,
            'doctrine.orm.cache.redis_instance.class' => 'Redis',
            'doctrine.orm.cache.xcache.class' => 'Doctrine\\Common\\Cache\\XcacheCache',
            'doctrine.orm.cache.wincache.class' => 'Doctrine\\Common\\Cache\\WinCacheCache',
            'doctrine.orm.cache.zenddata.class' => 'Doctrine\\Common\\Cache\\ZendDataCache',
            'doctrine.orm.metadata.driver_chain.class' => 'Doctrine\\Common\\Persistence\\Mapping\\Driver\\MappingDriverChain',
            'doctrine.orm.metadata.annotation.class' => 'Doctrine\\ORM\\Mapping\\Driver\\AnnotationDriver',
            'doctrine.orm.metadata.xml.class' => 'Doctrine\\ORM\\Mapping\\Driver\\SimplifiedXmlDriver',
            'doctrine.orm.metadata.yml.class' => 'Doctrine\\ORM\\Mapping\\Driver\\SimplifiedYamlDriver',
            'doctrine.orm.metadata.php.class' => 'Doctrine\\ORM\\Mapping\\Driver\\PHPDriver',
            'doctrine.orm.metadata.staticphp.class' => 'Doctrine\\ORM\\Mapping\\Driver\\StaticPHPDriver',
            'doctrine.orm.proxy_cache_warmer.class' => 'Symfony\\Bridge\\Doctrine\\CacheWarmer\\ProxyCacheWarmer',
            'form.type_guesser.doctrine.class' => 'Symfony\\Bridge\\Doctrine\\Form\\DoctrineOrmTypeGuesser',
            'doctrine.orm.validator.unique.class' => 'Symfony\\Bridge\\Doctrine\\Validator\\Constraints\\UniqueEntityValidator',
            'doctrine.orm.validator_initializer.class' => 'Symfony\\Bridge\\Doctrine\\Validator\\DoctrineInitializer',
            'doctrine.orm.security.user.provider.class' => 'Symfony\\Bridge\\Doctrine\\Security\\User\\EntityUserProvider',
            'doctrine.orm.listeners.resolve_target_entity.class' => 'Doctrine\\ORM\\Tools\\ResolveTargetEntityListener',
            'doctrine.orm.listeners.attach_entity_listeners.class' => 'Doctrine\\ORM\\Tools\\AttachEntityListenersListener',
            'doctrine.orm.naming_strategy.default.class' => 'Doctrine\\ORM\\Mapping\\DefaultNamingStrategy',
            'doctrine.orm.naming_strategy.underscore.class' => 'Doctrine\\ORM\\Mapping\\UnderscoreNamingStrategy',
            'doctrine.orm.quote_strategy.default.class' => 'Doctrine\\ORM\\Mapping\\DefaultQuoteStrategy',
            'doctrine.orm.quote_strategy.ansi.class' => 'Doctrine\\ORM\\Mapping\\AnsiQuoteStrategy',
            'doctrine.orm.entity_listener_resolver.class' => 'Doctrine\\Bundle\\DoctrineBundle\\Mapping\\ContainerEntityListenerResolver',
            'doctrine.orm.second_level_cache.default_cache_factory.class' => 'Doctrine\\ORM\\Cache\\DefaultCacheFactory',
            'doctrine.orm.second_level_cache.default_region.class' => 'Doctrine\\ORM\\Cache\\Region\\DefaultRegion',
            'doctrine.orm.second_level_cache.filelock_region.class' => 'Doctrine\\ORM\\Cache\\Region\\FileLockRegion',
            'doctrine.orm.second_level_cache.logger_chain.class' => 'Doctrine\\ORM\\Cache\\Logging\\CacheLoggerChain',
            'doctrine.orm.second_level_cache.logger_statistics.class' => 'Doctrine\\ORM\\Cache\\Logging\\StatisticsCacheLogger',
            'doctrine.orm.second_level_cache.cache_configuration.class' => 'Doctrine\\ORM\\Cache\\CacheConfiguration',
            'doctrine.orm.second_level_cache.regions_configuration.class' => 'Doctrine\\ORM\\Cache\\RegionsConfiguration',
            'doctrine.orm.auto_generate_proxy_classes' => false,
            'doctrine.orm.proxy_namespace' => 'Proxies',
            'api_platform.enable_entrypoint' => true,
            'api_platform.enable_docs' => true,
            'api_platform.title' => '',
            'api_platform.description' => '',
            'api_platform.version' => '0.0.0',
            'api_platform.show_webby' => true,
            'api_platform.exception_to_status' => [
                'App\\Security\\User\\UnloggedAccessException' => 403,
            ],
            'api_platform.formats' => [
                'jsonld' => [
                    0 => 'application/ld+json',
                ],
                'jsonhal' => [
                    0 => 'application/hal+json',
                ],
                'jsonapi' => [
                    0 => 'application/vnd.api+json',
                ],
                'json' => [
                    0 => 'application/json',
                ],
                'xml' => [
                    0 => 'application/xml',
                    1 => 'text/xml',
                ],
                'yaml' => [
                    0 => 'application/x-yaml',
                ],
                'csv' => [
                    0 => 'text/csv',
                ],
                'html' => [
                    0 => 'text/html',
                ],
                'geojson' => [
                    0 => 'application/vnd.geo+json',
                ],
                'jsonpatch' => [
                    0 => 'application/json-patch+json',
                ],
                'pdf' => [
                    0 => 'application/pdf',
                ],
            ],
            'api_platform.patch_formats' => [
                'jsonapi' => [
                    0 => 'application/vnd.api+json',
                ],
            ],
            'api_platform.error_formats' => [
                'jsonproblem' => [
                    0 => 'application/problem+json',
                ],
                'jsonld' => [
                    0 => 'application/ld+json',
                ],
            ],
            'api_platform.allow_plain_identifiers' => false,
            'api_platform.eager_loading.enabled' => true,
            'api_platform.eager_loading.max_joins' => 300,
            'api_platform.eager_loading.fetch_partial' => false,
            'api_platform.eager_loading.force_eager' => true,
            'api_platform.collection.exists_parameter_name' => 'exists',
            'api_platform.collection.order' => 'ASC',
            'api_platform.collection.order_parameter_name' => 'order',
            'api_platform.collection.pagination.enabled' => true,
            'api_platform.collection.pagination.partial' => false,
            'api_platform.collection.pagination.client_enabled' => false,
            'api_platform.collection.pagination.client_items_per_page' => false,
            'api_platform.collection.pagination.client_partial' => false,
            'api_platform.collection.pagination.items_per_page' => 30,
            'api_platform.collection.pagination.maximum_items_per_page' => NULL,
            'api_platform.collection.pagination.page_parameter_name' => 'page',
            'api_platform.collection.pagination.enabled_parameter_name' => 'pagination',
            'api_platform.collection.pagination.items_per_page_parameter_name' => 'itemsPerPage',
            'api_platform.collection.pagination.partial_parameter_name' => 'partial',
            'api_platform.collection.pagination' => [
                'enabled' => true,
                'partial' => false,
                'client_enabled' => false,
                'client_items_per_page' => false,
                'client_partial' => false,
                'items_per_page' => 30,
                'maximum_items_per_page' => NULL,
                'page_parameter_name' => 'page',
                'enabled_parameter_name' => 'pagination',
                'items_per_page_parameter_name' => 'itemsPerPage',
                'partial_parameter_name' => 'partial',
            ],
            'api_platform.http_cache.etag' => true,
            'api_platform.http_cache.max_age' => NULL,
            'api_platform.http_cache.shared_max_age' => NULL,
            'api_platform.http_cache.vary' => [
                0 => 'Accept',
            ],
            'api_platform.http_cache.public' => NULL,
            'api_platform.resource_class_directories' => [
                0 => (\dirname(__DIR__, 4).'/src/Entity'),
                1 => (\dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Entity'),
            ],
            'api_platform.oauth.enabled' => false,
            'api_platform.oauth.clientId' => '',
            'api_platform.oauth.clientSecret' => '',
            'api_platform.oauth.type' => 'oauth2',
            'api_platform.oauth.flow' => 'application',
            'api_platform.oauth.tokenUrl' => '/oauth/v2/token',
            'api_platform.oauth.authorizationUrl' => '/oauth/v2/auth',
            'api_platform.oauth.scopes' => [

            ],
            'api_platform.swagger.versions' => [
                0 => 2,
                1 => 3,
            ],
            'api_platform.enable_swagger_ui' => true,
            'api_platform.enable_re_doc' => true,
            'api_platform.swagger.api_keys' => [
                'apiKey' => [
                    'name' => 'Authorization',
                    'type' => 'header',
                ],
            ],
            'api_platform.graphql.enabled' => false,
            'api_platform.graphql.graphiql.enabled' => false,
            'api_platform.graphql.graphql_playground.enabled' => false,
            'api_platform.graphql.collection.pagination' => [
                'enabled' => true,
            ],
            'api_platform.validator.serialize_payload_fields' => [

            ],
            'api_platform.elasticsearch.enabled' => false,
            'fos_elastica.property_accessor.magicCall' => false,
            'fos_elastica.property_accessor.throwExceptionOnInvalidIndex' => false,
            'fos_elastica.default_index' => 'occurrences',
            'vich_uploader.default_filename_attribute_suffix' => '_name',
            'vich_uploader.mappings' => [
                'media_object' => [
                    'uri_prefix' => '/media',
                    'upload_destination' => (\dirname(__DIR__, 4).'/public/media'),
                    'directory_namer' => [
                        'service' => 'vich_uploader.namer_directory_property',
                        'options' => [
                            'property' => 'vichUploaderDirectoryName',
                            'transliterate' => false,
                        ],
                    ],
                    'namer' => [
                        'service' => 'Vich\\UploaderBundle\\Naming\\OrignameNamer.media_object',
                        'options' => [

                        ],
                    ],
                    'delete_on_remove' => true,
                    'delete_on_update' => true,
                    'inject_on_load' => false,
                    'db_driver' => 'orm',
                ],
            ],
            'vich_uploader.file_injector.class' => 'Vich\\UploaderBundle\\Injector\\FileInjector',
            'monolog.use_microseconds' => true,
            'monolog.swift_mailer.handlers' => [

            ],
            'monolog.handlers_to_channels' => [
                'monolog.handler.deprecation_filter' => [
                    'type' => 'inclusive',
                    'elements' => [
                        0 => 'php',
                    ],
                ],
                'monolog.handler.console' => [
                    'type' => 'exclusive',
                    'elements' => [
                        0 => 'event',
                        1 => 'doctrine',
                    ],
                ],
                'monolog.handler.main' => NULL,
            ],
            'jms_serializer.metadata.file_locator.class' => 'Metadata\\Driver\\FileLocator',
            'jms_serializer.metadata.annotation_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\AnnotationDriver',
            'jms_serializer.metadata.chain_driver.class' => 'Metadata\\Driver\\DriverChain',
            'jms_serializer.metadata.yaml_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\YamlDriver',
            'jms_serializer.metadata.xml_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\XmlDriver',
            'jms_serializer.metadata.php_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\PhpDriver',
            'jms_serializer.metadata.doctrine_type_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\DoctrineTypeDriver',
            'jms_serializer.metadata.doctrine_phpcr_type_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\DoctrinePHPCRTypeDriver',
            'jms_serializer.metadata.lazy_loading_driver.class' => 'Metadata\\Driver\\LazyLoadingDriver',
            'jms_serializer.metadata.metadata_factory.class' => 'Metadata\\MetadataFactory',
            'jms_serializer.metadata.cache.file_cache.class' => 'Metadata\\Cache\\FileCache',
            'jms_serializer.event_dispatcher.class' => 'JMS\\Serializer\\EventDispatcher\\LazyEventDispatcher',
            'jms_serializer.camel_case_naming_strategy.class' => 'JMS\\Serializer\\Naming\\CamelCaseNamingStrategy',
            'jms_serializer.identical_property_naming_strategy.class' => 'JMS\\Serializer\\Naming\\IdenticalPropertyNamingStrategy',
            'jms_serializer.serialized_name_annotation_strategy.class' => 'JMS\\Serializer\\Naming\\SerializedNameAnnotationStrategy',
            'jms_serializer.cache_naming_strategy.class' => 'JMS\\Serializer\\Naming\\CacheNamingStrategy',
            'jms_serializer.doctrine_object_constructor.class' => 'JMS\\Serializer\\Construction\\DoctrineObjectConstructor',
            'jms_serializer.unserialize_object_constructor.class' => 'JMS\\Serializer\\Construction\\UnserializeObjectConstructor',
            'jms_serializer.version_exclusion_strategy.class' => 'JMS\\Serializer\\Exclusion\\VersionExclusionStrategy',
            'jms_serializer.serializer.class' => 'JMS\\Serializer\\Serializer',
            'jms_serializer.twig_extension.class' => 'JMS\\Serializer\\Twig\\SerializerExtension',
            'jms_serializer.twig_runtime_extension.class' => 'JMS\\Serializer\\Twig\\SerializerRuntimeExtension',
            'jms_serializer.twig_runtime_extension_helper.class' => 'JMS\\Serializer\\Twig\\SerializerRuntimeHelper',
            'jms_serializer.templating.helper.class' => 'JMS\\SerializerBundle\\Templating\\SerializerHelper',
            'jms_serializer.json_serialization_visitor.class' => 'JMS\\Serializer\\JsonSerializationVisitor',
            'jms_serializer.json_serialization_visitor.options' => 1088,
            'jms_serializer.json_deserialization_visitor.class' => 'JMS\\Serializer\\JsonDeserializationVisitor',
            'jms_serializer.xml_serialization_visitor.class' => 'JMS\\Serializer\\XmlSerializationVisitor',
            'jms_serializer.xml_deserialization_visitor.class' => 'JMS\\Serializer\\XmlDeserializationVisitor',
            'jms_serializer.xml_deserialization_visitor.doctype_whitelist' => [

            ],
            'jms_serializer.xml_serialization_visitor.format_output' => false,
            'jms_serializer.yaml_serialization_visitor.class' => 'JMS\\Serializer\\YamlSerializationVisitor',
            'jms_serializer.handler_registry.class' => 'JMS\\Serializer\\Handler\\LazyHandlerRegistry',
            'jms_serializer.datetime_handler.class' => 'JMS\\Serializer\\Handler\\DateHandler',
            'jms_serializer.array_collection_handler.class' => 'JMS\\Serializer\\Handler\\ArrayCollectionHandler',
            'jms_serializer.php_collection_handler.class' => 'JMS\\Serializer\\Handler\\PhpCollectionHandler',
            'jms_serializer.form_error_handler.class' => 'JMS\\Serializer\\Handler\\FormErrorHandler',
            'jms_serializer.constraint_violation_handler.class' => 'JMS\\Serializer\\Handler\\ConstraintViolationHandler',
            'jms_serializer.doctrine_proxy_subscriber.class' => 'JMS\\Serializer\\EventDispatcher\\Subscriber\\DoctrineProxySubscriber',
            'jms_serializer.stopwatch_subscriber.class' => 'JMS\\SerializerBundle\\Serializer\\StopwatchEventSubscriber',
            'jms_serializer.configured_context_factory.class' => 'JMS\\SerializerBundle\\ContextFactory\\ConfiguredContextFactory',
            'jms_serializer.expression_evaluator.class' => 'JMS\\Serializer\\Expression\\ExpressionEvaluator',
            'jms_serializer.expression_language.class' => 'Symfony\\Component\\ExpressionLanguage\\ExpressionLanguage',
            'jms_serializer.expression_language.function_provider.class' => 'JMS\\SerializerBundle\\ExpressionLanguage\\BasicSerializerFunctionsProvider',
            'jms_serializer.accessor_strategy.default.class' => 'JMS\\Serializer\\Accessor\\DefaultAccessorStrategy',
            'jms_serializer.accessor_strategy.expression.class' => 'JMS\\Serializer\\Accessor\\ExpressionAccessorStrategy',
            'jms_serializer.cache.cache_warmer.class' => 'JMS\\SerializerBundle\\Cache\\CacheWarmer',
            'enqueue.transport.default.receive_timeout' => 10000,
            'enqueue.client.default.router_processor' => 'enqueue.client.default.router_processor',
            'enqueue.client.default.router_queue_name' => 'default',
            'enqueue.client.default.default_queue_name' => 'default',
            'enqueue.transports' => [
                0 => 'default',
            ],
            'enqueue.clients' => [
                0 => 'default',
            ],
            'enqueue.default_transport' => 'default',
            'enqueue.default_client' => 'default',
            'liip_imagine.resolvers' => [
                'default' => [
                    'web_path' => [
                        'web_root' => (\dirname(__DIR__, 4).'/public'),
                        'cache_prefix' => 'media/cache',
                    ],
                ],
            ],
            'liip_imagine.loaders' => [
                'default' => [
                    'filesystem' => [
                        'locator' => 'filesystem',
                        'data_root' => [
                            0 => (\dirname(__DIR__, 4).'/public'),
                        ],
                        'allow_unresolvable_data_roots' => false,
                        'bundle_resources' => [
                            'enabled' => false,
                            'access_control_type' => 'blacklist',
                            'access_control_list' => [

                            ],
                        ],
                    ],
                ],
            ],
            'liip_imagine.jpegoptim.binary' => '/usr/bin/jpegoptim',
            'liip_imagine.jpegoptim.stripAll' => true,
            'liip_imagine.jpegoptim.max' => NULL,
            'liip_imagine.jpegoptim.progressive' => true,
            'liip_imagine.jpegoptim.tempDir' => NULL,
            'liip_imagine.optipng.binary' => '/usr/bin/optipng',
            'liip_imagine.optipng.level' => 7,
            'liip_imagine.optipng.stripAll' => true,
            'liip_imagine.optipng.tempDir' => NULL,
            'liip_imagine.pngquant.binary' => '/usr/bin/pngquant',
            'liip_imagine.mozjpeg.binary' => '/opt/mozjpeg/bin/cjpeg',
            'liip_imagine.driver_service' => 'liip_imagine.gd',
            'liip_imagine.cache.resolver.default' => 'default',
            'liip_imagine.default_image' => NULL,
            'liip_imagine.filter_sets' => [

            ],
            'liip_imagine.binary.loader.default' => 'default',
            'liip_imagine.controller.filter_action' => 'Liip\\ImagineBundle\\Controller\\ImagineController::filterAction',
            'liip_imagine.controller.filter_runtime_action' => 'Liip\\ImagineBundle\\Controller\\ImagineController::filterRuntimeAction',
            'console.command.ids' => [
                0 => 'console.command.public_alias.api_platform.json_schema.json_schema_generate_command',
                1 => 'console.command.public_alias.api_platform.swagger.command.swagger_command',
            ],
        ];
    }
}
