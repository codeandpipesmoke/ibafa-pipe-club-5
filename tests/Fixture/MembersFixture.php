<?php
declare(strict_types=1);

namespace App\Test\Fixture;


use Cake\TestSuite\Fixture\TestFixture;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;


/**
 * MembersFixture
 */
class MembersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 'cea4d01c-e418-42ef-a8ad-2c7d28d9a1d0',
                'name' => 'Lorem ipsum dolor sit amet',
                'about_title' => 'Lorem ipsum dolor sit amet',
                'about' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'link_facebook' => 'Lorem ipsum dolor sit amet',
                'link_twitter' => 'Lorem ipsum dolor sit amet',
                'link_instagram' => 'Lorem ipsum dolor sit amet',
                'link_linkedin' => 'Lorem ipsum dolor sit amet',
                'visible' => 1,
                'pos' => 1,
                'created' => '2025-03-03 09:21:14',
                'modified' => '2025-03-03 09:21:14',
            ],
        ];
        parent::init();
    }
}
