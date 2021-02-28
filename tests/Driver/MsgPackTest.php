<?php

namespace Queryflatfile\Test;

/**
 * @group driver
 */
class MsgPackTest extends \PHPUnit\Framework\TestCase
{
    const DIR_TEST = 'tests/msgpack';

    /**
     * @var DriverInterface
     */
    protected $driver;

    public static function tearDownAfterClass()
    {
        if (count(scandir(self::DIR_TEST)) == 2) {
            rmdir(self::DIR_TEST);
        }
    }

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        if (!extension_loaded('msgpack')) {
            $this->markTestSkipped(
                'The msgpack extension is not available.'
            );
        }
        $this->driver = new \Queryflatfile\Driver\MsgPack();
    }

    public function testCreate()
    {
        $output = $this->driver->create(self::DIR_TEST, 'driver_test', [ 'key_test' => 'value_test' ]);

        self::assertTrue($output);
        self::assertFileExists('tests/msgpack/driver_test.msg');
    }

    public function testNoCreate()
    {
        $output = $this->driver->create(self::DIR_TEST, 'driver_test', [ 'key_test' => 'value_test' ]);

        self::assertFalse($output);
    }

    public function testRead()
    {
        $data = $this->driver->read(self::DIR_TEST, 'driver_test');

        self::assertArraySubset($data, [ 'key_test' => 'value_test' ]);
    }

    /**
     * @expectedException \Queryflatfile\Exception\Driver\FileNotFoundException
     */
    public function testReadException()
    {
        $this->driver->read(self::DIR_TEST, 'driver_test_error');
    }

    public function testSave()
    {
        $data                 = $this->driver->read(self::DIR_TEST, 'driver_test');
        $data[ 'key_test_2' ] = 'value_test_2';

        $output = $this->driver->save(self::DIR_TEST, 'driver_test', $data);

        $newJson = $this->driver->read(self::DIR_TEST, 'driver_test');

        self::assertTrue($output);
        self::assertArraySubset($newJson, $data);
    }

    /**
     * @expectedException \Queryflatfile\Exception\Driver\FileNotFoundException
     */
    public function testSaveException()
    {
        $this->driver->save(self::DIR_TEST, 'driver_test_error', []);
    }

    public function testHas()
    {
        $has    = $this->driver->has(self::DIR_TEST, 'driver_test');
        $notHas = $this->driver->has(self::DIR_TEST, 'driver_test_not_found');

        self::assertTrue($has);
        self::assertFalse($notHas);
    }

    public function testDelete()
    {
        $output = $this->driver->delete(self::DIR_TEST, 'driver_test');

        self::assertTrue($output);
        self::assertFileNotExists('tests/msgpack/driver_test.msg');
    }
}
