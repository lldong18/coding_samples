<?php

namespace Sample\JustSmallProject\Model;

use Sample\JustSmallProject\Model\Address;
use Sample\JustSmallProject\Model\Height;
use Sample\JustSmallProject\Model\Weight;
use Sample\JustSmallProject\Model\Email;

/**
 * @covers \Sample\JustSmallProject\Model\Member
 *
 * @uses \Sample\JustSmallProject\Model\Address
 * @uses \Sample\JustSmallProject\Model\Height
 * @uses \Sample\JustSmallProject\Model\Weight
 * @uses \Sample\JustSmallProject\Model\Email
 *
 * @author Jason Liu <lldong18@hotmail.com>
 */
final class MemberTest extends \PHPUnit_Framework_TestCase
{
	
    /**
     * @var ModelMember
     */
    private $SUT;

    protected function setUp()
    {
        parent::setUp();

        $this->SUT = new Member(
            'kovacek.keara',
            'et',
            new Address('Canada', 'Ontario', 'Hamilton', 'H4Y 5E1'),
            new \DateTime('1993-04-11'),
            'Undecided',
            new Height('4\' 5"'),
            new Weight('150 lbs'),
            'Slim',
            'Other',
            new Email('kovacek.keara@email.com')  
        );
    }
    
    /**
     * @test
     */
    public function it_should_get_the_address_object()
    {
	    $address = new Address('Canada', 'Ontario', 'Hamilton', 'H4Y 5E1');
	    $this->assertEquals($address, $this->SUT->getAddress()); 
    }

    /**
     * @test
     */
    public function it_should_get_the_address_details()
    {    	
        $this->assertSame('Hamilton', $this->SUT->getAddress()->getCity());
	    $this->assertSame('Canada', $this->SUT->getAddress()->getCountry());
	    $this->assertSame('H4Y 5E1', $this->SUT->getAddress()->getPostalCode());
	    $this->assertSame('Ontario', $this->SUT->getAddress()->getProvince()); 
    }
        
    /**
     * @test
     */
    public function it_should_get_the_member_values()
    {
        $this->assertSame('Slim', $this->SUT->getBodyType());
        $this->assertEquals('1993-04-11', date_format($this->SUT->getDateOfBirth(), 'Y-m-d'));
        $this->assertEquals('kovacek.keara@email.com', $this->SUT->getEmail());
        $this->assertSame('Other', $this->SUT->getEthnicity());
        $this->assertEquals('4\' 5"', $this->SUT->getHeight());
        $this->assertSame('Undecided', $this->SUT->getLimits());
        $this->assertSame('et', $this->SUT->getPassword());
        $this->assertSame('kovacek.keara', $this->SUT->getUsername());
        $this->assertEquals('150 lbs', $this->SUT->getWeight());
        $this->assertSame(23, $this->SUT->getAge());
    } 
}
