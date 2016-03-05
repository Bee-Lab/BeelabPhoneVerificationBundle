<?php

namespace Beelab\PhoneVerificationBundle\Tests\Manager;

use Beelab\PhoneVerificationBundle\Test\PhoneStub;
use Beelab\PhoneVerificationBundle\Manager\PhoneManager;
use PHPUnit_Framework_TestCase;

/**
 * @group unit
 */
class PhoneManagerTest extends PHPUnit_Framework_TestCase
{
    protected $manager;
    protected $em;
    protected $repository;

    protected function setUp()
    {
        $class = 'Beelab\PhoneVerificationBundle\Test\PhoneStub';
        $this->em = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $this->repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')->disableOriginalConstructor()
            ->getMock();
        $this->em->expects($this->any())->method('getRepository')->with($class)
            ->will($this->returnValue($this->repository));

        $this->manager = new PhoneManager($this->em, $class);
    }

    public function testFind()
    {
        $phone = new PhoneStub(1234567);
        $this->repository->expects($this->any())->method('__call')->with('findOneByNumber', ['1234567'])
            ->will($this->returnValue($phone));

        $this->assertEquals($phone, $this->manager->find('1234567'));
    }

    // TODO we cannot test verify OK, maybe we need to refactor Phone to inject a random code generator...
    public function testVerifyFailure()
    {
        $phone = new PhoneStub(1234567);
        $this->repository->expects($this->any())->method('__call')->with('findOneByNumber', ['1234567'])
            ->will($this->returnValue($phone));

        $this->assertFalse($this->manager->verify(1234567, 987));
    }

    public function testSave()
    {
        $phone = new PhoneStub(1234567);
        $this->em->expects($this->once())->method('flush');

        $this->manager->save($phone);
        $this->assertTrue($phone->isVerified());
    }

    public function testCreate()
    {
        $phone = new PhoneStub(1234567);
        $this->repository->expects($this->any())->method('__call')->with('findOneByNumber', ['1234567'])
            ->will($this->returnValue($phone));

        $this->assertEquals($phone, $this->manager->create('1234567'));
    }
}
