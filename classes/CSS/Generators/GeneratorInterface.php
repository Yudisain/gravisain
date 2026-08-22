<?php
/**
 * CSS Generator Interface
 *
 * @package Gravisain\CSS\Generators
 */

declare(strict_types=1);

namespace Gravisain\CSS\Generators;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Gravisain\CSS\Builder;

/**
 * GeneratorInterface
 *
 * Contract for all dynamic CSS generators.
 */
interface GeneratorInterface {

	/**
	 * Generate and append dynamic CSS rules to the Builder instance.
	 *
	 * @param Builder $builder Dynamic CSS Builder instance.
	 * @return void
	 */
	public function generate( Builder $builder ): void;
}
