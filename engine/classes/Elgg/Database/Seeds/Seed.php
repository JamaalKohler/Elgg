<?php

namespace Elgg\Database\Seeds;

use Elgg\Traits\Cli\Progressing;
use Elgg\Traits\Seeding;

/**
 * Abstract seed
 *
 * Plugins should extend this class to create their own seeders,
 * add use 'seeds','database' event to add their seed to the sequence.
 */
abstract class Seed implements Seedable {

	use Seeding;
	use Progressing {
		advance as private progressAdvance;
	}
	
	/**
	 * @var int Max number of items to be created by the seed
	 */
	protected int $limit;

	/**
	 * @var bool Create new entities
	 */
	protected bool $create = false;
	
	/**
	 * @var int Number of seeded entities
	 */
	protected int $seeded_counter = 0;
	
	/**
	 * Seed constructor.
	 *
	 * @param array $options seeding options
	 *                       - limit: Number of item to seed
	 *                       - create: create new entities (default: false)
	 *                       - create_since: lower bound creation time (default: now)
	 *                       - create_until: upper bound creation time (default: now)
	 */
	public function __construct(array $options = []) {
		$limit = (int) elgg_extract('limit', $options);
		if ($limit > 0) {
			$this->limit = $limit;
		} else {
			$this->limit = static::getDefaultLimit();
		}
		
		$this->create = (bool) elgg_extract('create', $options, $this->create);
		$this->setCreateSince(elgg_extract('create_since', $options, 'now'));
		$this->setCreateUntil(elgg_extract('create_until', $options, 'now'));
	}
	
	/**
	 * Register this class for seeding
	 *
	 * @param \Elgg\Event $event 'seeds', 'database'
	 *
	 * @return array
	 */
	final public static function register(\Elgg\Event $event) {
		$seeds = $event->getValue();
		
		$seeds[] = static::class;
		
		return $seeds;
	}
	
	/**
	 * Get the count of the seeded entities
	 *
	 * @return int
	 */
	final public function getCount(): int {
		if ($this->create) {
			return $this->seeded_counter;
		}
		
		$defaults = [
			'metadata_names' => '__faker',
		];
		$options = array_merge($defaults, $this->getCountOptions());
		
		return elgg_count_entities($options);
	}
	
	/**
	 * Advance progressbar
	 *
	 * @param int $step Step
	 *
	 * @return void
	 */
	public function advance(int $step = 1): void {
		$this->seeded_counter += $step;
		
		$this->progressAdvance($step);
	}
	
	/**
	 * Get the default number of content to seed
	 *
	 * @return int
	 */
	public static function getDefaultLimit(): int {
		return max(elgg_get_config('default_limit'), 20);
	}

	/**
	 * Populate database
	 *
	 * @return mixed
	 */
	abstract public function seed();

	/**
	 * Removed seeded rows from database
	 *
	 * @return mixed
	 */
	abstract public function unseed();

	/**
	 * Get the (un)seeding type of this handler
	 *
	 * @return string
	 */
	abstract public static function getType(): string;
	
	/**
	 * Get options for elgg_count_entities()
	 *
	 * @return array
	 * @see self::getCount()
	 */
	abstract protected function getCountOptions(): array;
}
