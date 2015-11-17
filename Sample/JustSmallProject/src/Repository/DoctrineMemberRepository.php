<?php

namespace Sample\JustSmallProject\Repository;

use Sample\JustSmallProject\Model\Address;
use Sample\JustSmallProject\Model\Email;
use Sample\JustSmallProject\Model\Height;
use Sample\JustSmallProject\Model\Member;
use Sample\JustSmallProject\Model\Weight;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Connection;
use PDO;

/**
 * @author Jason Liu <lldong18@hotmail.com>
 */
final class DoctrineMemberRepository extends DoctrineRepository implements MemberRepository
{
    const CLASS_NAME = __CLASS__;
    const TABLE_NAME = 'members';
    const ALIAS = 'member';
    private $connection ;

    /**
     * Constructor.
     *
     * @param object $connection
     */
    public function __construct(Connection $connection)
    {
        parent::__construct($connection);
        $this->connection = parent::getConnection();
    }

    /**
     * @param Member $member
     *
     * @return int Affected rows
     */
    public function add($member)
    {
        $member = $this->extractData($member) ;
        $exist = $this->findByUsername($member['username']);
        
        if ($exist) {
            return 0; 
        } else {
            $qb = $this->connection;
            $qb->beginTransaction();
            $smtp = $qb->prepare('INSERT INTO  '.$this->getTableName().' (' . implode(', ', array_keys($member)) . ')  VALUES (' . implode(', ', array_fill(0, count($member), '?')) . ')');
            $stmt = $smtp->execute(array_values($member));
            $qb->commit();
            return 1;       	
        }
    }

    /**
     * @param Member $member
     *
     * @return int Affected rows
     */
    public function update($member)
    {
        $member = $this->extractData($member) ;
        $qb = $this->connection;
        $qb->beginTransaction();       
        
        $data = array($member['password'],$member['country'],$member['province'],$member['city'],$member['postal_code'],$member['date_of_birth'],$member['limits'],$member['height'],$member['weight'],$member['body_type'],$member['ethnicity'],$member['email'],$member['username']);
        
        $smtp = $qb->prepare('UPDATE '.$this->getTableName().' SET password = ?,
                                country = ?, 
                                province = ?, 
                                city = ?, 
                                postal_code = ?, 
                                date_of_birth = ?, 
                                limits = ?, 
                                height = ?, 
                                weight = ?, 
                                body_type = ?, 
                                ethnicity = ?, 
                                email = ? 
                                WHERE username =?');
        $stmt = $smtp->execute($data);
        $qb->commit();

        return 1;
    }

    /**
     * @param Member $member
     *
     * @return int
     */
    public function remove($member)
    {
        $member=$this->extractData($member);
        $foo =  $this->findByUsername($member['username']);
        if (sizeof($foo)) {      
            $qb = $this->connection;
            $qb->beginTransaction();
            $data[]=$member['username'];
            $smtp = $qb->prepare('DELETE FROM '.$this->getTableName().'  WHERE username =?');
            $stmt = $smtp->execute($data);
            $qb->commit();
            $result = 1;
        } else {    
            $result = 0;
        }

        return $result;
    }

    /**
     * @param string $username
     *
     * @return Member|null
     */
    public function findByUsername($username)
    {
        $qb = $this->createQueryBuilder();
        $qb->select($this->getAlias().'.*')
           ->from($this->getTableName(), $this->getAlias())
           ->where($this->getAlias().'.username = ?')
           ->setParameter(0,$username)
           ->setMaxResults(1);
           
        $stmt = $qb->execute();
        $member = array();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!empty($result)) {
            $member = $this->hydrate($result);
            return $member;
        } else {
            return null;
        }
    }

    /**
     * @param string $keyword
     * @param int $first
     * @param int $max
     *
     * @return Member[]
     */
    public function search($keyword, $first = 0, $max = null)
    {
        $qb = $this->createQueryBuilder();
        $qb->select($this->getAlias().'.*')
           ->from($this->getTableName(), $this->getAlias())
           ->where($this->getAlias().'.username  LIKE ?')
           ->setParameter(0,'%'.$keyword.'%');
        $qb = $this->setLimit($qb, $first, $max);
        $stmt = $qb->execute();

        $members = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $members[] = $this->hydrate($row);
        }

        return $members;
    }

    /**
     * @param string $keyword
     *
     * @return int
     */
    public function getSearchCount($keyword)
    {
        $qb = $this->createQueryBuilder();
        $qb->select('count(*) as amount')
           ->from($this->getTableName(), $this->getAlias())
           ->where($this->getAlias().'.username  LIKE ?')
           ->setParameter(0,'%'.$keyword.'%');
        $stmt = $qb->execute();
        $result =$stmt->fetch();
        $amount = $result['amount'];
        if ($amount == 1) {
            return 1;
        } elseif ($amount > 1){
            return  $amount;
        } else {
            return 0;
        }
    }

    /**
     * Not like getSearchCount($keyword), try another query way
     * 
     * @return int
     */
    public function count()
    {
        $sql = 'SELECT count(*) as amount FROM '.$this->getTableName();
        $stmt = $this->connection->query($sql);
        $result = $stmt->fetch();

        return $result['amount'];
    }

    /**
     * @param int $first
     * @param int $max
     *
     * @return object
     */
    public function findAll($first = 0, $max = null)
    {
        $qb = $this->getBaseQuery($first, $max);
        $stmt = $qb->execute();
        $members = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $members[] = $this->hydrate($row);
        }

        return $members;
    }

    /**
     * @param array $row
     *
     * @return Member
     */
    protected function hydrate(array $row)
    {
        date_default_timezone_set('America/Los_Angeles');
        return new Member(
        $row['username'],
        $row['password'],
        new Address($row['country'], $row['province'], $row['city'], $row['postal_code']),
        new \DateTime($row['date_of_birth']),
        $row['limits'],
        new Height($row['height']),
        new Weight($row['weight']),
        $row['body_type'],
        $row['ethnicity'],
        new Email($row['email'])
        );
    }

    /**
     * @return string
     */
    protected function getTableName()
    {
        return self::TABLE_NAME;
    }

    /**
     * @return string
     */
    protected function getAlias()
    {
        return self::ALIAS;
    }

    /**
     * @param Member $member
     *
     * @return array
     */
    private function extractData($member)
    {
        return [
            'username' => $member->getUsername(),
            'password' => $member->getPassword(),
            'country' => $member->getAddress()->getCountry(),
            'province' => $member->getAddress()->getProvince(),
            'city' => $member->getAddress()->getCity(),
            'postal_code' => $member->getAddress()->getPostalCode(),
            'date_of_birth' => date_format($member->getDateOfBirth(), 'Y-m-d'),
            'limits' => $member->getLimits(),
            'height' => $member->getHeight(),
            'weight' => $member->getWeight(),
            'body_type' => $member->getBodyType(),
            'ethnicity' => $member->getEthnicity(),
            'email' => $member->getEmail(),
        ];
    }

    /**
     * @return array
     */
    private function getDataTypes()
    {
        return [
        Type::STRING,
        Type::STRING,
        Type::STRING,
        Type::STRING,
        Type::STRING,
        Type::STRING,
        Type::DATE,
        Type::STRING,
        Type::STRING,
        Type::STRING,
        Type::STRING,
        Type::STRING,
        Type::STRING,
        ];
    }
}
