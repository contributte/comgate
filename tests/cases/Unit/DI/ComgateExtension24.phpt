<?php declare(strict_types = 1);

namespace Tests\Cases\Unit\DI;

use Contributte\Comgate\DI\ComgateExtension24;
use Contributte\Comgate\Http\HttpClient;
use Nette\DI\Compiler;
use Nette\DI\Container;
use Nette\DI\ContainerLoader;
use Nette\Schema\Schema;
use Tester\Assert;
use Tester\Environment;

require_once __DIR__ . '/../../../bootstrap.php';

if (class_exists(Schema::class)) {
	Environment::skip('Nette 2.4 required');
}

if (version_compare(PHP_VERSION, '8.1') >= 0) {
	Environment::skip('PHP <8.1 required');
}

test(function (): void {
	$loader = new ContainerLoader(TEMP_DIR, true);
	$class = @$loader->load(function (Compiler $compiler): void {
		$compiler->addExtension('comgate', new ComgateExtension24())
			->addConfig([
				'comgate' => [
					'merchant' => '123456',
					'secret' => 'top',
					'test' => true,
				],
			]);
	}, 1);

	/** @var Container $container */
	$container = new $class();

	Assert::type(HttpClient::class, $container->getService('comgate.http.client'));
});
