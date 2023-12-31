<?php
declare(strict_types=1);

/**
 * A class to contain test cases and run them with shared fixtures
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         2.0.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace Cake\TestSuite;

use Cake\Filesystem\Filesystem;
use PHPUnit\Framework\TestSuite as BaseTestSuite;
use SplFileInfo;
use function Cake\Core\deprecationWarning;

/**
 * A class to contain test cases and run them with shared fixtures
 */
class TestSuite extends BaseTestSuite
{
    /**
     * Adds all the files in a directory to the test suite. Does not recursive through directories.
     *
     * @param string $directory The directory to add tests from.
     * @return void
     */
    public function addTestDirectory(string $directory = '.'): void
    {
        deprecationWarning('4.5.0 - TestSuite is deprecated as PHPunit is removing support for testsuites.');
        $fs = new Filesystem();
        $files = $fs->find($directory, '/\.php$/');
        foreach ($files as $file => $fileInfo) {
            $this->addTestFile($file);
        }
    }

    /**
     * Recursively adds all the files in a directory to the test suite.
     *
     * @param string $directory The directory subtree to add tests from.
     * @return void
     */
    public function addTestDirectoryRecursive(string $directory = '.'): void
    {
        deprecationWarning('4.5.0 - TestSuite is deprecated as PHPunit is removing support for testsuites.');
        $fs = new Filesystem();
        $files = $fs->findRecursive($directory, function (SplFileInfo $current) {
            $file = $current->getFilename();
            if ($file[0] === '.' || !preg_match('/\.php$/', $file)) {
                return false;
            }

            return true;
        });
        foreach ($files as $file => $fileInfo) {
            $this->addTestFile($file);
        }
    }
}
