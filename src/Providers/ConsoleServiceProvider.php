<?php
namespace Caffeinated\Modules\Providers;

use Illuminate\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
{
	/**
	* @var bool $defer Indicates if loading of the provider is deferred.
	*/
	protected $defer = false;

	/**
	 * Boot the service provider.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerMakeCommand();
		$this->registerEnableCommand();
		$this->registerDisableCommand();
		$this->registerMakeMigrationCommand();
		$this->registerMakeRequestCommand();
		$this->registerMigrateCommand();
		$this->registerMigrateRefreshCommand();
		$this->registerMigrateResetCommand();
		$this->registerMigrateRollbackCommand();
		$this->registerSeedCommand();
		$this->registerListCommand();
		$this->registerMakeControllerCommand();

		$this->commands([
			'modules.make',
			'modules.enable',
			'modules.disable',
			'modules.makeMigration',
			'modules.makeRequest',
			'modules.migrate',
			'modules.migrateRefresh',
			'modules.migrateReset',
			'modules.migrateRollback',
			'modules.seed',
			'modules.list',
			'modules.makeController',
		]);
	}

	/**
	 * Register the "module:enable" console command.
	 *
	 * @return Console\ModuleEnableCommand
	 */
	protected function registerEnableCommand()
	{
		$this->app->singleton('modules.enable', function() {
			return new \Caffeinated\Modules\Console\Commands\ModuleEnableCommand;
		});
	}

	/**
	 * Register the "module:disable" console command.
	 *
	 * @return Console\ModuleDisableCommand
	 */
	protected function registerDisableCommand()
	{
		$this->app->singleton('modules.disable', function() {
			return new \Caffeinated\Modules\Console\Commands\ModuleDisableCommand;
		});
	}

	/**
	 * Register the "module:make" console command.
	 *
	 * @return Console\ModuleMakeCommand
	 */
	protected function registerMakeCommand()
	{
		$this->app->singleton('modules.make', function($app) {
			$handler = new \Caffeinated\Modules\Console\Handlers\ModuleMakeHandler($app['modules'], $app['files']);

			return new \Caffeinated\Modules\Console\Commands\ModuleMakeCommand($handler);
		});
	}

	/**
	 * Register the "module:make:migration" console command.
	 *
	 * @return Console\ModuleMakeMigrationCommand
	 */
	protected function registerMakeMigrationCommand()
	{
		$this->app->singleton('modules.makeMigration', function($app) {
			$handler = new \Caffeinated\Modules\Console\Handlers\ModuleMakeMigrationHandler($app['modules'], $app['files']);

			return new \Caffeinated\Modules\Console\Commands\ModuleMakeMigrationCommand($handler);
		});
	}

	/**
	 * Register the "module:make:request" console command.
	 *
	 * @return Console\ModuleMakeRequestCommand
	 */
	protected function registerMakeRequestCommand()
	{
		$this->app->singleton('modules.makeRequest', function($app) {
			$handler = new \Caffeinated\Modules\Console\Handlers\ModuleMakeRequestHandler($app['modules'], $app['files']);

			return new \Caffeinated\Modules\Console\Commands\ModuleMakeRequestCommand($handler);
		});
	}

	/**
	 * Register the "module:migrate" console command.
	 *
	 * @return Console\ModuleMigrateCommand
	 */
	protected function registerMigrateCommand()
	{
		$this->app->singleton('modules.migrate', function($app) {
			return new \Caffeinated\Modules\Console\Commands\ModuleMigrateCommand($app['migrator'], $app['modules']);
		});
	}

	/**
	 * Register the "module:migrate:refresh" console command.
	 *
	 * @return Console\ModuleMigrateRefreshCommand
	 */
	protected function registerMigrateRefreshCommand()
	{
		$this->app->singleton('modules.migrateRefresh', function() {
			return new \Caffeinated\Modules\Console\Commands\ModuleMigrateRefreshCommand;
		});
	}

	/**
	 * Register the "module:migrate:reset" console command.
	 *
	 * @return Console\ModuleMigrateResetCommand
	 */
	protected function registerMigrateResetCommand()
	{
		$this->app->singleton('modules.migrateReset', function($app) {
			return new \Caffeinated\Modules\Console\Commands\ModuleMigrateResetCommand($app['modules'], $app['files'], $app['migrator']);
		});
	}

	/**
	 * Register the "module:migrate:rollback" console command.
	 *
	 * @return Console\ModuleMigrateRollbackCommand
	 */
	protected function registerMigrateRollbackCommand()
	{
		$this->app->singleton('modules.migrateRollback', function($app) {
			return new \Caffeinated\Modules\Console\Commands\ModuleMigrateRollbackCommand($app['modules']);
		});
	}

	/**
	 * Register the "module:seed" console command.
	 *
	 * @return Console\ModuleSeedCommand
	 */
	protected function registerSeedCommand()
	{
		$this->app->singleton('modules.seed', function($app) {
			return new \Caffeinated\Modules\Console\Commands\ModuleSeedCommand($app['modules']);
		});
	}

	/**
	 * Register the "module:list" console command.
	 *
	 * @return Console\ModuleListCommand
	 */
	protected function registerListCommand()
	{
		$this->app->singleton('modules.list', function($app) {
			return new \Caffeinated\Modules\Console\Commands\ModuleListCommand($app['modules']);
		});
	}

	/**
	 * Register the "module:make:controller" console command.
	 *
	 * @return Console\ModuleMakeControllerCommand
	 */
	protected function registerMakeControllerCommand()
	{
		$this->app->singleton('modules.makeController', function($app) {
			$handler = new \Caffeinated\Modules\Console\Handlers\ModuleMakeControllerHandler($app['modules'], $app['files']);

			return new \Caffeinated\Modules\Console\Commands\ModuleMakeControllerCommand($handler);
		});
	}

}