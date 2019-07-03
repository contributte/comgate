<?php declare(strict_types = 1);

namespace Tests\Cases\Unit\DI;

use Contributte\Comgate\DI\ComgateExtension;
use Contributte\Comgate\Http\HttpClient;
use Nette\DI\Compiler;
use Nette\DI\Container;
use Nette\DI\ContainerLoader;
use Tester\Assert;

require_once __DIR__ . '/../../../bootstrap.php';

test(function (): void {
	$loader = new ContainerLoader(TEMP_DIR, true);
	$class = $loader->load(function (Compiler $compiler): void {
		$compiler->addExtension('comgate', new ComgateExtension())
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
