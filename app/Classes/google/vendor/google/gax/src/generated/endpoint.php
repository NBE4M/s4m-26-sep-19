<?php
// DO NOT EDIT! Generated by Protobuf-PHP protoc plugin 1.0
// Source: google/api/endpoint.proto
//   Date: 2016-11-23 22:55:01

namespace google\api {

  class Endpoint extends \DrSlump\Protobuf\Message {

    /**  @var string */
    public $name = null;
    
    /**  @var string[]  */
    public $aliases = array();
    
    /**  @var string[]  */
    public $apis = array();
    
    /**  @var string[]  */
    public $features = array();
    
    /**  @var boolean */
    public $allow_cors = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'google.api.Endpoint');

      // OPTIONAL STRING name = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "name";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // REPEATED STRING aliases = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "aliases";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_REPEATED;
      $descriptor->addField($f);

      // REPEATED STRING apis = 3
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 3;
      $f->name      = "apis";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_REPEATED;
      $descriptor->addField($f);

      // REPEATED STRING features = 4
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 4;
      $f->name      = "features";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_REPEATED;
      $descriptor->addField($f);

      // OPTIONAL BOOL allow_cors = 5
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 5;
      $f->name      = "allow_cors";
      $f->type      = \DrSlump\Protobuf::TYPE_BOOL;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <name> has a value
     *
     * @return boolean
     */
    public function hasName(){
      return $this->_has(1);
    }
    
    /**
     * Clear <name> value
     *
     * @return \google\api\Endpoint
     */
    public function clearName(){
      return $this->_clear(1);
    }
    
    /**
     * Get <name> value
     *
     * @return string
     */
    public function getName(){
      return $this->_get(1);
    }
    
    /**
     * Set <name> value
     *
     * @param string $value
     * @return \google\api\Endpoint
     */
    public function setName( $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <aliases> has a value
     *
     * @return boolean
     */
    public function hasAliases(){
      return $this->_has(2);
    }
    
    /**
     * Clear <aliases> value
     *
     * @return \google\api\Endpoint
     */
    public function clearAliases(){
      return $this->_clear(2);
    }
    
    /**
     * Get <aliases> value
     *
     * @param int $idx
     * @return string
     */
    public function getAliases($idx = NULL){
      return $this->_get(2, $idx);
    }
    
    /**
     * Set <aliases> value
     *
     * @param string $value
     * @return \google\api\Endpoint
     */
    public function setAliases( $value, $idx = NULL){
      return $this->_set(2, $value, $idx);
    }
    
    /**
     * Get all elements of <aliases>
     *
     * @return string[]
     */
    public function getAliasesList(){
     return $this->_get(2);
    }
    
    /**
     * Add a new element to <aliases>
     *
     * @param string $value
     * @return \google\api\Endpoint
     */
    public function addAliases( $value){
     return $this->_add(2, $value);
    }
    
    /**
     * Check if <apis> has a value
     *
     * @return boolean
     */
    public function hasApis(){
      return $this->_has(3);
    }
    
    /**
     * Clear <apis> value
     *
     * @return \google\api\Endpoint
     */
    public function clearApis(){
      return $this->_clear(3);
    }
    
    /**
     * Get <apis> value
     *
     * @param int $idx
     * @return string
     */
    public function getApis($idx = NULL){
      return $this->_get(3, $idx);
    }
    
    /**
     * Set <apis> value
     *
     * @param string $value
     * @return \google\api\Endpoint
     */
    public function setApis( $value, $idx = NULL){
      return $this->_set(3, $value, $idx);
    }
    
    /**
     * Get all elements of <apis>
     *
     * @return string[]
     */
    public function getApisList(){
     return $this->_get(3);
    }
    
    /**
     * Add a new element to <apis>
     *
     * @param string $value
     * @return \google\api\Endpoint
     */
    public function addApis( $value){
     return $this->_add(3, $value);
    }
    
    /**
     * Check if <features> has a value
     *
     * @return boolean
     */
    public function hasFeatures(){
      return $this->_has(4);
    }
    
    /**
     * Clear <features> value
     *
     * @return \google\api\Endpoint
     */
    public function clearFeatures(){
      return $this->_clear(4);
    }
    
    /**
     * Get <features> value
     *
     * @param int $idx
     * @return string
     */
    public function getFeatures($idx = NULL){
      return $this->_get(4, $idx);
    }
    
    /**
     * Set <features> value
     *
     * @param string $value
     * @return \google\api\Endpoint
     */
    public function setFeatures( $value, $idx = NULL){
      return $this->_set(4, $value, $idx);
    }
    
    /**
     * Get all elements of <features>
     *
     * @return string[]
     */
    public function getFeaturesList(){
     return $this->_get(4);
    }
    
    /**
     * Add a new element to <features>
     *
     * @param string $value
     * @return \google\api\Endpoint
     */
    public function addFeatures( $value){
     return $this->_add(4, $value);
    }
    
    /**
     * Check if <allow_cors> has a value
     *
     * @return boolean
     */
    public function hasAllowCors(){
      return $this->_has(5);
    }
    
    /**
     * Clear <allow_cors> value
     *
     * @return \google\api\Endpoint
     */
    public function clearAllowCors(){
      return $this->_clear(5);
    }
    
    /**
     * Get <allow_cors> value
     *
     * @return boolean
     */
    public function getAllowCors(){
      return $this->_get(5);
    }
    
    /**
     * Set <allow_cors> value
     *
     * @param boolean $value
     * @return \google\api\Endpoint
     */
    public function setAllowCors( $value){
      return $this->_set(5, $value);
    }
  }
}

