<?php
// DO NOT EDIT! Generated by Protobuf-PHP protoc plugin 1.0
// Source: google/protobuf/field_mask.proto
//   Date: 2016-07-18 20:27:54

namespace google\protobuf {

  class FieldMask extends \DrSlump\Protobuf\Message {

    /**  @var string[]  */
    public $paths = array();
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'google.protobuf.FieldMask');

      // REPEATED STRING paths = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "paths";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_REPEATED;
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <paths> has a value
     *
     * @return boolean
     */
    public function hasPaths(){
      return $this->_has(1);
    }
    
    /**
     * Clear <paths> value
     *
     * @return \google\protobuf\FieldMask
     */
    public function clearPaths(){
      return $this->_clear(1);
    }
    
    /**
     * Get <paths> value
     *
     * @param int $idx
     * @return string
     */
    public function getPaths($idx = NULL){
      return $this->_get(1, $idx);
    }
    
    /**
     * Set <paths> value
     *
     * @param string $value
     * @return \google\protobuf\FieldMask
     */
    public function setPaths( $value, $idx = NULL){
      return $this->_set(1, $value, $idx);
    }
    
    /**
     * Get all elements of <paths>
     *
     * @return string[]
     */
    public function getPathsList(){
     return $this->_get(1);
    }
    
    /**
     * Add a new element to <paths>
     *
     * @param string $value
     * @return \google\protobuf\FieldMask
     */
    public function addPaths( $value){
     return $this->_add(1, $value);
    }
  }
}

