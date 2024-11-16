<?php

namespace Launchpad\PHPStan\Queue;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

class BaseAPIRule implements Rule {

	/**
	 * @inheritDoc
	 */
	public function getNodeType(): string {
		return \PhpParser\Node\Expr\FuncCall::class;
	}

	/**
	 * @inheritDoc
	 */
	public function processNode( Node $node, Scope $scope ): array {
		$name = (string) $node->name;

		if( ! in_array($name, [
			'as_enqueue_async_action',
			'as_has_scheduled_action',
			'as_schedule_single_action',
			'as_unschedule_action',
			'as_unschedule_all_actions',
			'as_next_scheduled_action',
			'as_get_scheduled_actions',
		], true)) {
			return [];
		}

		return [
			RuleErrorBuilder::message(
				'Use Launchpad module to manipulate Action Scheduler jobs.'
			)
			->addTip('composer require wp-launchpad/action-scheduler-take-off')
			->identifier('launchpad.hooks.actionScheduler.module')
			->build(),
		];
	}
}