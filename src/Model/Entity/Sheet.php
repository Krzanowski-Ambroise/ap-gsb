<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sheet Entity
 *
 * @property int $id
 * @property string|null $user_id
 * @property int $state_id
 * @property bool $sheetvalidated
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \CakeDC\Users\Model\Entity\User $user
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\Outpackage[] $outpackages
 * @property \App\Model\Entity\Package[] $packages
 */
class Sheet extends Entity
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
        'user_id' => true,
        'state_id' => true,
        'sheetvalidated' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'state' => true,
        'outpackages' => true,
        'packages' => true,
    ];
}
