<?php
// DO NOT EDIT! Generated by Protobuf-PHP protoc plugin 1.0
// Source: google/type/timeofday.proto
//   Date: 2016-11-23 22:55:01

namespace google\type {

  class TimeOfDay extends \DrSlump\Protobuf\Message {

    /**  @var int */
    public $hours = null;
    
    /**  @var int */
    public $minutes = null;
    
    /**  @var int */
    public $seconds = null;
    
    /**  @var int */
    public $nanos = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'google.type.TimeOfDay');

      // OPTIONAL INT32 hours = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "hours";
      $f->type      = \DrSlump\Protobuf::TYPE_INT32;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL INT32 minutes = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "minutes";
      $f->type      = \DrSlump\Protobuf::TYPE_INT32;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL INT32 seconds = 3
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 3;
      $f->name      = "seconds";
      $f->type      = \DrSlump\Protobuf::TYPE_INT32;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL INT32 nanos = 4
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 4;
      $f->name      = "nanos";
      $f->type      = \DrSlump\Protobuf::TYPE_INT32;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <hours> has a value
     *
     * @return boolean
     */
    public function hasHours(){
      return $this->_has(1);
    }
    
    /**
     * Clear <hours> value
     *
     * @return \google\type\TimeOfDay
     */
    public function clearHours(){
      return $this->_clear(1);
    }
    
    /**
     * Get <hours> value
     *
     * @return int
     */
    public function getHours(){
      return $this->_get(1);
    }
    
    /**
     * Set <hours> value
     *
     * @param int $value
     * @return \google\type\TimeOfDay
     */
    public function setHours( $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <minutes> has a value
     *
     * @return boolean
     */
    public function hasMinutes(){
      return $this->_has(2);
    }
    
    /**
     * Clear <minutes> value
     *
     * @return \google\type\TimeOfDay
     */
    public function clearMinutes(){
      return $this->_clear(2);
    }
    
    /**
     * Get <minutes> value
     *
     * @return int
     */
    public function getMinutes(){
      return $this->_get(2);
    }
    
    /**
     * Set <minutes> value
     *
     * @param int $value
     * @return \google\type\TimeOfDay
     */
    public function setMinutes( $value){
      return $this->_set(2, $value);
    }
    
    /**
     * Check if <seconds> has a value
     *
     * @return boolean
     */
    public function hasSeconds(){
      return $this->_has(3);
    }
    
    /**
     * Clear <seconds> value
     *
     * @return \google\type\TimeOfDay
     */
    public function clearSeconds(){
      return $this->_clear(3);
    }
    
    /**
     * Get <seconds> value
     *
     * @return int
     */
    public function getSeconds(){
      return $this->_get(3);
    }
    
    /**
     * Set <seconds> value
     *
     * @param int $value
     * @return \google\type\TimeOfDay
     */
    public function setSeconds( $value){
      return $this->_set(3, $value);
    }
    
    /**
     * Check if <nanos> has a value
     *
     * @return boolean
     */
    public function hasNanos(){
      return $this->_has(4);
    }
    
    /**
     * Clear <nanos> value
     *
     * @return \google\type\TimeOfDay
     */
    public function clearNanos(){
      return $this->_clear(4);
    }
    
    /**
     * Get <nanos> value
     *
     * @return int
     */
    public function getNanos(){
      return $this->_get(4);
    }
    
    /**
     * Set <nanos> value
     *
     * @param int $value
     * @return \google\type\TimeOfDay
     */
    public function setNanos( $value){
      return $this->_set(4, $value);
    }
  }
}

