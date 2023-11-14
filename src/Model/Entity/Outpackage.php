<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Outpackage Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $date
 * @property float $price
 * @property string $title
 * @property string $body
 *
 * @property \App\Model\Entity\Sheet[] $sheets
 */
class Outpackage extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'date' => true,
        'price' => true,
        'title' => true,
        'body' => true,
        'sheets' => true,
    ];
}
