<?php
declare(strict_types=1);

namespace App\Model\Entity;


use Cake\ORM\Entity;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;


/**
 * Post Entity
 *
 * @property int $id
 * @property string $user_id
 * @property string $name
 * @property string|null $slug
 * @property string $body
 * @property string|null $more
 * @property bool $show_in_main_page
 * @property bool $visible
 * @property int $pos
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \CakeDC\Users\Model\Entity\User $user
 */
class Post extends Entity
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
        'user_id' => true,
        'name' => true,
        'slug' => true,
        'body' => true,
        'more' => true,
        'show_in_main_page' => true,
        'visible' => true,
        'pos' => true,
        'filename' => true,
        'thumbnail' => true,
        'ext' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
    ];
}
