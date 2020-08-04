<?php
// DO NOT EDIT! Generated by Protobuf-PHP protoc plugin 1.0
// Source: google/spanner/v1/transaction.proto
//   Date: 2016-12-14 20:33:11

namespace google\spanner\v1\TransactionOptions {

  class ReadWrite extends \DrSlump\Protobuf\Message {


    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'google.spanner.v1.TransactionOptions.ReadWrite');

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }
  }
}

namespace google\spanner\v1\TransactionOptions {

  class ReadOnly extends \DrSlump\Protobuf\Message {

    /**  @var boolean */
    public $strong = null;
    
    /**  @var \google\protobuf\Timestamp */
    public $min_read_timestamp = null;
    
    /**  @var \google\protobuf\Duration */
    public $max_staleness = null;
    
    /**  @var \google\protobuf\Timestamp */
    public $read_timestamp = null;
    
    /**  @var \google\protobuf\Duration */
    public $exact_staleness = null;
    
    /**  @var boolean */
    public $return_read_timestamp = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'google.spanner.v1.TransactionOptions.ReadOnly');

      // OPTIONAL BOOL strong = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "strong";
      $f->type      = \DrSlump\Protobuf::TYPE_BOOL;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL MESSAGE min_read_timestamp = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "min_read_timestamp";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\google\protobuf\Timestamp';
      $descriptor->addField($f);

      // OPTIONAL MESSAGE max_staleness = 3
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 3;
      $f->name      = "max_staleness";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\google\protobuf\Duration';
      $descriptor->addField($f);

      // OPTIONAL MESSAGE read_timestamp = 4
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 4;
      $f->name      = "read_timestamp";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\google\protobuf\Timestamp';
      $descriptor->addField($f);

      // OPTIONAL MESSAGE exact_staleness = 5
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 5;
      $f->name      = "exact_staleness";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\google\protobuf\Duration';
      $descriptor->addField($f);

      // OPTIONAL BOOL return_read_timestamp = 6
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 6;
      $f->name      = "return_read_timestamp";
      $f->type      = \DrSlump\Protobuf::TYPE_BOOL;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <strong> has a value
     *
     * @return boolean
     */
    public function hasStrong(){
      return $this->_has(1);
    }
    
    /**
     * Clear <strong> value
     *
     * @return \google\spanner\v1\TransactionOptions\ReadOnly
     */
    public function clearStrong(){
      return $this->_clear(1);
    }
    
    /**
     * Get <strong> value
     *
     * @return boolean
     */
    public function getStrong(){
      return $this->_get(1);
    }
    
    /**
     * Set <strong> value
     *
     * @param boolean $value
     * @return \google\spanner\v1\TransactionOptions\ReadOnly
     */
    public function setStrong( $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <min_read_timestamp> has a value
     *
     * @return boolean
     */
    public function hasMinReadTimestamp(){
      return $this->_has(2);
    }
    
    /**
     * Clear <min_read_timestamp> value
     *
     * @return \google\spanner\v1\TransactionOptions\ReadOnly
     */
    public function clearMinReadTimestamp(){
      return $this->_clear(2);
    }
    
    /**
     * Get <min_read_timestamp> value
     *
     * @return \google\protobuf\Timestamp
     */
    public function getMinReadTimestamp(){
      return $this->_get(2);
    }
    
    /**
     * Set <min_read_timestamp> value
     *
     * @param \google\protobuf\Timestamp $value
     * @return \google\spanner\v1\TransactionOptions\ReadOnly
     */
    public function setMinReadTimestamp(\google\protobuf\Timestamp $value){
      return $this->_set(2, $value);
    }
    
    /**
     * Check if <max_staleness> has a value
     *
     * @return boolean
     */
    public function hasMaxStaleness(){
      return $this->_has(3);
    }
    
    /**
     * Clear <max_staleness> value
     *
     * @return \google\spanner\v1\TransactionOptions\ReadOnly
     */
    public function clearMaxStaleness(){
      return $this->_clear(3);
    }
    
    /**
     * Get <max_staleness> value
     *
     * @return \google\protobuf\Duration
     */
    public function getMaxStaleness(){
      return $this->_get(3);
    }
    
    /**
     * Set <max_staleness> value
     *
     * @param \google\protobuf\Duration $value
     * @return \google\spanner\v1\TransactionOptions\ReadOnly
     */
    public function setMaxStaleness(\google\protobuf\Duration $value){
      return $this->_set(3, $value);
    }
    
    /**
     * Check if <read_timestamp> has a value
     *
     * @return boolean
     */
    public function hasReadTimestamp(){
      return $this->_has(4);
    }
    
    /**
     * Clear <read_timestamp> value
     *
     * @return \google\spanner\v1\TransactionOptions\ReadOnly
     */
    public function clearReadTimestamp(){
      return $this->_clear(4);
    }
    
    /**
     * Get <read_timestamp> value
     *
     * @return \google\protobuf\Timestamp
     */
    public function getReadTimestamp(){
      return $this->_get(4);
    }
    
    /**
     * Set <read_timestamp> value
     *
     * @param \google\protobuf\Timestamp $value
     * @return \google\spanner\v1\TransactionOptions\ReadOnly
     */
    public function setReadTimestamp(\google\protobuf\Timestamp $value){
      return $this->_set(4, $value);
    }
    
    /**
     * Check if <exact_staleness> has a value
     *
     * @return boolean
     */
    public function hasExactStaleness(){
      return $this->_has(5);
    }
    
    /**
     * Clear <exact_staleness> value
     *
     * @return \google\spanner\v1\TransactionOptions\ReadOnly
     */
    public function clearExactStaleness(){
      return $this->_clear(5);
    }
    
    /**
     * Get <exact_staleness> value
     *
     * @return \google\protobuf\Duration
     */
    public function getExactStaleness(){
      return $this->_get(5);
    }
    
    /**
     * Set <exact_staleness> value
     *
     * @param \google\protobuf\Duration $value
     * @return \google\spanner\v1\TransactionOptions\ReadOnly
     */
    public function setExactStaleness(\google\protobuf\Duration $value){
      return $this->_set(5, $value);
    }
    
    /**
     * Check if <return_read_timestamp> has a value
     *
     * @return boolean
     */
    public function hasReturnReadTimestamp(){
      return $this->_has(6);
    }
    
    /**
     * Clear <return_read_timestamp> value
     *
     * @return \google\spanner\v1\TransactionOptions\ReadOnly
     */
    public function clearReturnReadTimestamp(){
      return $this->_clear(6);
    }
    
    /**
     * Get <return_read_timestamp> value
     *
     * @return boolean
     */
    public function getReturnReadTimestamp(){
      return $this->_get(6);
    }
    
    /**
     * Set <return_read_timestamp> value
     *
     * @param boolean $value
     * @return \google\spanner\v1\TransactionOptions\ReadOnly
     */
    public function setReturnReadTimestamp( $value){
      return $this->_set(6, $value);
    }
  }
}

namespace google\spanner\v1 {

  class TransactionOptions extends \DrSlump\Protobuf\Message {

    /**  @var \google\spanner\v1\TransactionOptions\ReadWrite */
    public $read_write = null;
    
    /**  @var \google\spanner\v1\TransactionOptions\ReadOnly */
    public $read_only = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'google.spanner.v1.TransactionOptions');

      // OPTIONAL MESSAGE read_write = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "read_write";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\google\spanner\v1\TransactionOptions\ReadWrite';
      $descriptor->addField($f);

      // OPTIONAL MESSAGE read_only = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "read_only";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\google\spanner\v1\TransactionOptions\ReadOnly';
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <read_write> has a value
     *
     * @return boolean
     */
    public function hasReadWrite(){
      return $this->_has(1);
    }
    
    /**
     * Clear <read_write> value
     *
     * @return \google\spanner\v1\TransactionOptions
     */
    public function clearReadWrite(){
      return $this->_clear(1);
    }
    
    /**
     * Get <read_write> value
     *
     * @return \google\spanner\v1\TransactionOptions\ReadWrite
     */
    public function getReadWrite(){
      return $this->_get(1);
    }
    
    /**
     * Set <read_write> value
     *
     * @param \google\spanner\v1\TransactionOptions\ReadWrite $value
     * @return \google\spanner\v1\TransactionOptions
     */
    public function setReadWrite(\google\spanner\v1\TransactionOptions\ReadWrite $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <read_only> has a value
     *
     * @return boolean
     */
    public function hasReadOnly(){
      return $this->_has(2);
    }
    
    /**
     * Clear <read_only> value
     *
     * @return \google\spanner\v1\TransactionOptions
     */
    public function clearReadOnly(){
      return $this->_clear(2);
    }
    
    /**
     * Get <read_only> value
     *
     * @return \google\spanner\v1\TransactionOptions\ReadOnly
     */
    public function getReadOnly(){
      return $this->_get(2);
    }
    
    /**
     * Set <read_only> value
     *
     * @param \google\spanner\v1\TransactionOptions\ReadOnly $value
     * @return \google\spanner\v1\TransactionOptions
     */
    public function setReadOnly(\google\spanner\v1\TransactionOptions\ReadOnly $value){
      return $this->_set(2, $value);
    }
  }
}

namespace google\spanner\v1 {

  class Transaction extends \DrSlump\Protobuf\Message {

    /**  @var string */
    public $id = null;
    
    /**  @var \google\protobuf\Timestamp */
    public $read_timestamp = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'google.spanner.v1.Transaction');

      // OPTIONAL BYTES id = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "id";
      $f->type      = \DrSlump\Protobuf::TYPE_BYTES;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL MESSAGE read_timestamp = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "read_timestamp";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\google\protobuf\Timestamp';
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
     * @return \google\spanner\v1\Transaction
     */
    public function clearId(){
      return $this->_clear(1);
    }
    
    /**
     * Get <id> value
     *
     * @return string
     */
    public function getId(){
      return $this->_get(1);
    }
    
    /**
     * Set <id> value
     *
     * @param string $value
     * @return \google\spanner\v1\Transaction
     */
    public function setId( $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <read_timestamp> has a value
     *
     * @return boolean
     */
    public function hasReadTimestamp(){
      return $this->_has(2);
    }
    
    /**
     * Clear <read_timestamp> value
     *
     * @return \google\spanner\v1\Transaction
     */
    public function clearReadTimestamp(){
      return $this->_clear(2);
    }
    
    /**
     * Get <read_timestamp> value
     *
     * @return \google\protobuf\Timestamp
     */
    public function getReadTimestamp(){
      return $this->_get(2);
    }
    
    /**
     * Set <read_timestamp> value
     *
     * @param \google\protobuf\Timestamp $value
     * @return \google\spanner\v1\Transaction
     */
    public function setReadTimestamp(\google\protobuf\Timestamp $value){
      return $this->_set(2, $value);
    }
  }
}

namespace google\spanner\v1 {

  class TransactionSelector extends \DrSlump\Protobuf\Message {

    /**  @var \google\spanner\v1\TransactionOptions */
    public $single_use = null;
    
    /**  @var string */
    public $id = null;
    
    /**  @var \google\spanner\v1\TransactionOptions */
    public $begin = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'google.spanner.v1.TransactionSelector');

      // OPTIONAL MESSAGE single_use = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "single_use";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\google\spanner\v1\TransactionOptions';
      $descriptor->addField($f);

      // OPTIONAL BYTES id = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "id";
      $f->type      = \DrSlump\Protobuf::TYPE_BYTES;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL MESSAGE begin = 3
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 3;
      $f->name      = "begin";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\google\spanner\v1\TransactionOptions';
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <single_use> has a value
     *
     * @return boolean
     */
    public function hasSingleUse(){
      return $this->_has(1);
    }
    
    /**
     * Clear <single_use> value
     *
     * @return \google\spanner\v1\TransactionSelector
     */
    public function clearSingleUse(){
      return $this->_clear(1);
    }
    
    /**
     * Get <single_use> value
     *
     * @return \google\spanner\v1\TransactionOptions
     */
    public function getSingleUse(){
      return $this->_get(1);
    }
    
    /**
     * Set <single_use> value
     *
     * @param \google\spanner\v1\TransactionOptions $value
     * @return \google\spanner\v1\TransactionSelector
     */
    public function setSingleUse(\google\spanner\v1\TransactionOptions $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <id> has a value
     *
     * @return boolean
     */
    public function hasId(){
      return $this->_has(2);
    }
    
    /**
     * Clear <id> value
     *
     * @return \google\spanner\v1\TransactionSelector
     */
    public function clearId(){
      return $this->_clear(2);
    }
    
    /**
     * Get <id> value
     *
     * @return string
     */
    public function getId(){
      return $this->_get(2);
    }
    
    /**
     * Set <id> value
     *
     * @param string $value
     * @return \google\spanner\v1\TransactionSelector
     */
    public function setId( $value){
      return $this->_set(2, $value);
    }
    
    /**
     * Check if <begin> has a value
     *
     * @return boolean
     */
    public function hasBegin(){
      return $this->_has(3);
    }
    
    /**
     * Clear <begin> value
     *
     * @return \google\spanner\v1\TransactionSelector
     */
    public function clearBegin(){
      return $this->_clear(3);
    }
    
    /**
     * Get <begin> value
     *
     * @return \google\spanner\v1\TransactionOptions
     */
    public function getBegin(){
      return $this->_get(3);
    }
    
    /**
     * Set <begin> value
     *
     * @param \google\spanner\v1\TransactionOptions $value
     * @return \google\spanner\v1\TransactionSelector
     */
    public function setBegin(\google\spanner\v1\TransactionOptions $value){
      return $this->_set(3, $value);
    }
  }
}

