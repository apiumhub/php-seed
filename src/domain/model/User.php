<?php
/**
 * Created by IntelliJ IDEA.
 * User: christian
 * Date: 23/06/15
 * Time: 16:49
 */

namespace domain\model;


/**
 * @Entity
 * @Table(name="users")
 */
class User
{
    /**
     * @var integer
     *
     * @Id
     * @Column(name="id", type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var string
     * @Column(type="string", length=64)
     */
    protected $name;
    /**
     * @var string
     * @Column(type="string", length=255)
     */
    protected $age;
    /**
     * @var string
     * @Column(type="string", length=255)
     */
    protected $userId;

    /**
     * User constructor.
     *
     * @param string $name
     * @param string $age
     */
    public function __construct($name, $age)
    {
        $this->userId = uniqid();
        $this->name = $name;
        $this->age = $age;
    }

    /**
     * @param $name
     * @param $age
     *
     * @return User
     */
    public static function create($name, $age)
    {
        return new User($name, $age);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function toInspectionString()
    {
        return "$this->name - $this->age";
    }

    public function toJSON()
    {
        $json = array();
        foreach ($this as $key => $value) {
            $json[$key] = $value;
        }
        return json_encode($json);
    }

}