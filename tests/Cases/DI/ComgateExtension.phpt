<?php declare(strict_types = 1);

namespace Tests\Cases\Unit\DI;

use Contributte\Comgate\DI\ComgateExtension;
use Contributte\Comgate\Http\HttpClient;
use Contributte\Tester\Toolkit;
use Contributte\Tester\Utils\ContainerBuilder;
use Nette\DI\Compiler;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

Toolkit::test(function (): void {
	$container = ContainerBuilder::of()
		->withCompiler(function (Compiler $compiler): void {
			$compiler->addExtension('comgate', new ComgateExtension())
				->addConfig([
					'comgate' => [
						'merchant' => '123456',
						'secret' => 'top',
						'test' => true,
					],
				]);
		})->build();

	Assert::type(HttpClient::class, $container->getService('comgate.http.client'));
});
