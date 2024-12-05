<?php

namespace ToxyTech\Api\Providers;

use ToxyTech\Api\Facades\ApiHelper;
use ToxyTech\Api\Http\Middleware\ForceJsonResponseMiddleware;
use ToxyTech\Base\Facades\DashboardMenu;
use ToxyTech\Base\Facades\PanelSectionManager;
use ToxyTech\Base\PanelSections\PanelSectionItem;
use ToxyTech\Base\Supports\ServiceProvider;
use ToxyTech\Base\Traits\LoadAndPublishDataTrait;
use ToxyTech\Setting\PanelSections\SettingCommonPanelSection;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use ReflectionClass;

class ApiServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register(): void
    {
        if (class_exists('ApiHelper')) {
            AliasLoader::getInstance()->alias('ApiHelper', ApiHelper::class);
        }
    }

    public function boot(): void
    {
        $this
            ->setNamespace('packages/api')
            ->loadRoutes()
            ->loadAndPublishConfigurations(['api', 'permissions'])
            ->loadAndPublishTranslations()
            ->loadMigrations()
            ->loadAndPublishViews();

        if (ApiHelper::enabled()) {
            $this->loadRoutes(['api']);
        }

        $this->app['events']->listen(RouteMatched::class, function () {
            if (ApiHelper::enabled()) {
                $this->app['router']->pushMiddlewareToGroup('api', ForceJsonResponseMiddleware::class);
            }

            if (version_compare('7.0.0', get_core_version(), '>=')) {
                DashboardMenu::registerItem([
                    'id' => 'cms-packages-api',
                    'priority' => 9999,
                    'parent_id' => 'cms-core-settings',
                    'name' => 'packages/api::api.settings',
                    'icon' => null,
                    'url' => route('api.settings'),
                    'permissions' => ['api.settings'],
                ]);
            } else {
                PanelSectionManager::default()
                    ->registerItem(
                        SettingCommonPanelSection::class,
                        fn () => PanelSectionItem::make('settings.common.api')
                            ->setTitle(trans('packages/api::api.settings'))
                            ->withDescription(trans('packages/api::api.settings_description'))
                            ->withIcon('ti ti-api')
                            ->withPriority(110)
                            ->withRoute('api.settings')
                    );
            }
        });

        $this->app->booted(function () {
            config([
                'scribe.routes.0.match.prefixes' => ['api/*'],
                'scribe.routes.0.apply.headers' => [
                    'Authorization' => 'Bearer {token}',
                    'Api-Version' => 'v1',
                ],
            ]);
        });
    }

    protected function getPath(string $path = null): string
    {
        return __DIR__ . '/../..' . ($path ? '/' . ltrim($path, '/') : '');
    }
}
