<?php

namespace Launchpad\PHPStan;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\RuleErrorBuilder;
use PHPStan\Type\ObjectType;

class PerformanceRule implements \PHPStan\Rules\Rule
{

	public function getNodeType(): string
	{
		return \PhpParser\Node\Expr\MethodCall::class;
	}

	public function processNode(Node $node, Scope $scope): array
	{
		if( ! $node instanceof \PhpParser\Node\Expr\MethodCall) {
			return [];
		}

		if('get' !== (string) $node->name) {
			return [];
		}

		if('define' !== $scope->getFunctionName()) {
			return [];
		}

		if( ! $scope->isInClass() ) {
			return [];
		}

		var_dump($scope->getNamespace());
		var_dump($scope->getClassReflection()->getParentClass());
		if( ! $scope->getClassReflection()->isSubclassOf('\Launchpad\Dependencies\LaunchpadCore\Container\AbstractServiceProvider') ) {
			return [];
		}

		$type = $scope->getType($node->var);


		if( (new ObjectType('\Launchpad\Dependencies\League\Container\DefinitionContainerInterface'))->isSuperTypeOf($type)->no() ) {
			return [];
		}

		return [
			RuleErrorBuilder::message(
				'Method get on the container should not be called inside a provider define method for performances issues.'
			)
							->identifier('launchpad.container.performance.get')
							->build(),
		];
	}

}