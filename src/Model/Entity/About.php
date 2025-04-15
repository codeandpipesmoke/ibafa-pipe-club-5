<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * About Entity
 *
 * @property int $id
 * @property string $title
 * @property string $subtitle
 * @property string $title_1
 * @property string $text_1
 * @property string $title_2
 * @property string $text_2
 * @property string $title_3
 * @property string $text_3
 * @property string $title_4
 * @property string $text_4
 * @property int $visible
 * @property int $pos
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 */
class About extends Entity
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
    protected array $_accessible = [
        'title' => true,
        'subtitle' => true,
        'title_1' => true,
        'text_1' => true,
        'title_2' => true,
        'text_2' => true,
        'title_3' => true,
        'text_3' => true,
        'title_4' => true,
        'text_4' => true,
        'visible' => true,
        'google_map_url' => true,
        'pos' => true,
        'created' => true,
        'modified' => true,
    ];
}
