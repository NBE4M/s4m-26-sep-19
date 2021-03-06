<?php
// DO NOT EDIT! Generated by Protobuf-PHP protoc plugin @package_version@
// Source: repeated.proto
//   Date: 2011-10-04 14:32:26

namespace tests\Repeated {

  class Nested extends \DrSlump\Protobuf\Message {

    /**  @var int */
    public $id = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'tests.Repeated.Nested');

      // OPTIONAL INT32 id = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "id";
      $f->type      = \DrSlump\Protobuf::TYPE_INT32;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <id> has a value
     *
     * @return boolean
     */
    public function hasId(){
      return $this->_has(1);
    }
    
    /**
     * Clear <id> value
     *
     * @return \tests\Repeated\Nested
     */
    public function clearId(){
      return $this->_clear(1);
    }
    
    /**
     * Get <id> value
     *
     * @return int
     */
    public function getId(){
      return $this->_get(1);
    }
    
    /**
     * Set <id> value
     *
     * @param int $value
     * @return \tests\Repeated\Nested
     */
    public function setId( $value){
      return $this->_set(1, $value);
    }
  }
}

namespace tests {

  class Repeated extends \DrSlump\Protobuf\Message {

    /**  @var string[]  */
    public $string = array();
    
    /**  @var int[]  */
    public $int = array();
    
    /**  @var \tests\Repeated\Nested[]  */
    public $nested = array();
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'tests.Repeated');

      // REPEATED STRING string = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "string";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_REPEATED;
      $descriptor->addField($f);

      // REPEATED INT32 int = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "int";
      $f->type      = \DrSlump\Protobuf::TYPE_INT32;
      $f->rule      = \DrSlump\Protobuf::RULE_REPEATED;
      $descriptor->addField($f);

      // REPEATED MESSAGE nested = 3
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 3;
      $f->name      = "nested";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_REPEATED;
      $f->reference = '\tests\Repeated\Nested';
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <string> has a value
     *
     * @return boolean
     */
    public function hasString(){
      return $this->_has(1);
    }
    
    /**
     * Clear <string> value
     *
     * @return \tests\Repeated
     */
    public function clearString(){
      return $this->_clear(1);
    }
    
    /**
     * Get <string> value
     *
     * @param int $idx
     * @return string
     */
    public function getString($idx = NULL){
      return $this->_get(1, $idx);
    }
    
    /**
     * Set <string> value
     *
     * @param string $value
     * @return \tests\Repeated
     */
    public function setString( $value, $idx = NULL){
      return $this->_set(1, $value, $idx);
    }
    
    /**
     * Get all elements of <string>
     *
     * @return string[]
     */
    public function getStringList(){
     return $this->_get(1);
    }
    
    /**
     * Add a new element to <string>
     *
     * @param string $value
     * @return \tests\Repeated
     */
    public function addString( $value){
     return $this->_add(1, $value);
    }
    
    /**
     * Check if <int> has a value
     *
     * @return boolean
     */
    public function hasInt(){
      return $this->_has(2);
    }
    
    /**
     * Clear <int> value
     *
     * @return \tests\Repeated
     */
    public function clearInt(){
      return $this->_clear(2);
    }
    
    /**
     * Get <int> value
     *
     * @param int $idx
     * @return int
     */
    public function getInt($idx = NULL){
      return $this->_get(2, $idx);
    }
    
    /**
     * Set <int> value
     *
     * @param int $value
     * @return \tests\Repeated
     */
    public function setInt( $value, $idx = NULL){
      return $this->_set(2, $value, $idx);
    }
    
    /**
     * Get all elements of <int>
     *
     * @return int[]
     */
    public function getIntList(){
     return $this->_get(2);
    }
    
    /**
     * Add a new element to <int>
     *
     * @param int $value
     * @return \tests\Repeated
     */
    public function addInt( $value){
     return $this->_add(2, $value);
    }
    
    /**
     * Check if <nested> has a value
     *
     * @return boolean
     */
    public function hasNested(){
      return $this->_has(3);
    }
    
    /**
     * Clear <nested> value
     *
     * @return \tests\Repeated
     */
    public function clearNested(){
      return $this->_clear(3);
    }
    
    /**
     * Get <nested> value
     *
     * @param int $idx
     * @return \tests\Repeated\Nested
     */
    public function getNested($idx = NULL){
      return $this->_get(3, $idx);
    }
    
    /**
     * Set <nested> value
     *
     * @param \tests\Repeated\Nested $value
     * @return \tests\Repeated
     */
    public function setNested(\tests\Repeated\Nested $value, $idx = NULL){
      return $this->_set(3, $value, $idx);
    }
    
    /**
     * Get all elements of <nested>
     *
     * @return \tests\Repeated\Nested[]
     */
    public function getNestedList(){
     return $this->_get(3);
    }
    
    /**
     * Add a new element to <nested>
     *
     * @param \tests\Repeated\Nested $value
     * @return \tests\Repeated
     */
    public function addNested(\tests\Repeated\Nested $value){
     return $this->_add(3, $value);
    }
  }
}

