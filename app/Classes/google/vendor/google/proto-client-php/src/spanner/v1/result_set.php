<?php
// DO NOT EDIT! Generated by Protobuf-PHP protoc plugin 1.0
// Source: google/spanner/v1/result_set.proto
//   Date: 2016-12-14 20:33:12

namespace google\spanner\v1 {

  class ResultSet extends \DrSlump\Protobuf\Message {

    /**  @var \google\spanner\v1\ResultSetMetadata */
    public $metadata = null;
    
    /**  @var \google\protobuf\ListValue[]  */
    public $rows = array();
    
    /**  @var \google\spanner\v1\ResultSetStats */
    public $stats = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'google.spanner.v1.ResultSet');

      // OPTIONAL MESSAGE metadata = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "metadata";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\google\spanner\v1\ResultSetMetadata';
      $descriptor->addField($f);

      // REPEATED MESSAGE rows = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "rows";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_REPEATED;
      $f->reference = '\google\protobuf\ListValue';
      $descriptor->addField($f);

      // OPTIONAL MESSAGE stats = 3
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 3;
      $f->name      = "stats";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\google\spanner\v1\ResultSetStats';
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <metadata> has a value
     *
     * @return boolean
     */
    public function hasMetadata(){
      return $this->_has(1);
    }
    
    /**
     * Clear <metadata> value
     *
     * @return \google\spanner\v1\ResultSet
     */
    public function clearMetadata(){
      return $this->_clear(1);
    }
    
    /**
     * Get <metadata> value
     *
     * @return \google\spanner\v1\ResultSetMetadata
     */
    public function getMetadata(){
      return $this->_get(1);
    }
    
    /**
     * Set <metadata> value
     *
     * @param \google\spanner\v1\ResultSetMetadata $value
     * @return \google\spanner\v1\ResultSet
     */
    public function setMetadata(\google\spanner\v1\ResultSetMetadata $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <rows> has a value
     *
     * @return boolean
     */
    public function hasRows(){
      return $this->_has(2);
    }
    
    /**
     * Clear <rows> value
     *
     * @return \google\spanner\v1\ResultSet
     */
    public function clearRows(){
      return $this->_clear(2);
    }
    
    /**
     * Get <rows> value
     *
     * @param int $idx
     * @return \google\protobuf\ListValue
     */
    public function getRows($idx = NULL){
      return $this->_get(2, $idx);
    }
    
    /**
     * Set <rows> value
     *
     * @param \google\protobuf\ListValue $value
     * @return \google\spanner\v1\ResultSet
     */
    public function setRows(\google\protobuf\ListValue $value, $idx = NULL){
      return $this->_set(2, $value, $idx);
    }
    
    /**
     * Get all elements of <rows>
     *
     * @return \google\protobuf\ListValue[]
     */
    public function getRowsList(){
     return $this->_get(2);
    }
    
    /**
     * Add a new element to <rows>
     *
     * @param \google\protobuf\ListValue $value
     * @return \google\spanner\v1\ResultSet
     */
    public function addRows(\google\protobuf\ListValue $value){
     return $this->_add(2, $value);
    }
    
    /**
     * Check if <stats> has a value
     *
     * @return boolean
     */
    public function hasStats(){
      return $this->_has(3);
    }
    
    /**
     * Clear <stats> value
     *
     * @return \google\spanner\v1\ResultSet
     */
    public function clearStats(){
      return $this->_clear(3);
    }
    
    /**
     * Get <stats> value
     *
     * @return \google\spanner\v1\ResultSetStats
     */
    public function getStats(){
      return $this->_get(3);
    }
    
    /**
     * Set <stats> value
     *
     * @param \google\spanner\v1\ResultSetStats $value
     * @return \google\spanner\v1\ResultSet
     */
    public function setStats(\google\spanner\v1\ResultSetStats $value){
      return $this->_set(3, $value);
    }
  }
}

namespace google\spanner\v1 {

  class PartialResultSet extends \DrSlump\Protobuf\Message {

    /**  @var \google\spanner\v1\ResultSetMetadata */
    public $metadata = null;
    
    /**  @var \google\protobuf\Value[]  */
    public $values = array();
    
    /**  @var boolean */
    public $chunked_value = null;
    
    /**  @var string */
    public $resume_token = null;
    
    /**  @var \google\spanner\v1\ResultSetStats */
    public $stats = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'google.spanner.v1.PartialResultSet');

      // OPTIONAL MESSAGE metadata = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "metadata";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\google\spanner\v1\ResultSetMetadata';
      $descriptor->addField($f);

      // REPEATED MESSAGE values = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "values";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_REPEATED;
      $f->reference = '\google\protobuf\Value';
      $descriptor->addField($f);

      // OPTIONAL BOOL chunked_value = 3
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 3;
      $f->name      = "chunked_value";
      $f->type      = \DrSlump\Protobuf::TYPE_BOOL;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL BYTES resume_token = 4
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 4;
      $f->name      = "resume_token";
      $f->type      = \DrSlump\Protobuf::TYPE_BYTES;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL MESSAGE stats = 5
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 5;
      $f->name      = "stats";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\google\spanner\v1\ResultSetStats';
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <metadata> has a value
     *
     * @return boolean
     */
    public function hasMetadata(){
      return $this->_has(1);
    }
    
    /**
     * Clear <metadata> value
     *
     * @return \google\spanner\v1\PartialResultSet
     */
    public function clearMetadata(){
      return $this->_clear(1);
    }
    
    /**
     * Get <metadata> value
     *
     * @return \google\spanner\v1\ResultSetMetadata
     */
    public function getMetadata(){
      return $this->_get(1);
    }
    
    /**
     * Set <metadata> value
     *
     * @param \google\spanner\v1\ResultSetMetadata $value
     * @return \google\spanner\v1\PartialResultSet
     */
    public function setMetadata(\google\spanner\v1\ResultSetMetadata $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <values> has a value
     *
     * @return boolean
     */
    public function hasValues(){
      return $this->_has(2);
    }
    
    /**
     * Clear <values> value
     *
     * @return \google\spanner\v1\PartialResultSet
     */
    public function clearValues(){
      return $this->_clear(2);
    }
    
    /**
     * Get <values> value
     *
     * @param int $idx
     * @return \google\protobuf\Value
     */
    public function getValues($idx = NULL){
      return $this->_get(2, $idx);
    }
    
    /**
     * Set <values> value
     *
     * @param \google\protobuf\Value $value
     * @return \google\spanner\v1\PartialResultSet
     */
    public function setValues(\google\protobuf\Value $value, $idx = NULL){
      return $this->_set(2, $value, $idx);
    }
    
    /**
     * Get all elements of <values>
     *
     * @return \google\protobuf\Value[]
     */
    public function getValuesList(){
     return $this->_get(2);
    }
    
    /**
     * Add a new element to <values>
     *
     * @param \google\protobuf\Value $value
     * @return \google\spanner\v1\PartialResultSet
     */
    public function addValues(\google\protobuf\Value $value){
     return $this->_add(2, $value);
    }
    
    /**
     * Check if <chunked_value> has a value
     *
     * @return boolean
     */
    public function hasChunkedValue(){
      return $this->_has(3);
    }
    
    /**
     * Clear <chunked_value> value
     *
     * @return \google\spanner\v1\PartialResultSet
     */
    public function clearChunkedValue(){
      return $this->_clear(3);
    }
    
    /**
     * Get <chunked_value> value
     *
     * @return boolean
     */
    public function getChunkedValue(){
      return $this->_get(3);
    }
    
    /**
     * Set <chunked_value> value
     *
     * @param boolean $value
     * @return \google\spanner\v1\PartialResultSet
     */
    public function setChunkedValue( $value){
      return $this->_set(3, $value);
    }
    
    /**
     * Check if <resume_token> has a value
     *
     * @return boolean
     */
    public function hasResumeToken(){
      return $this->_has(4);
    }
    
    /**
     * Clear <resume_token> value
     *
     * @return \google\spanner\v1\PartialResultSet
     */
    public function clearResumeToken(){
      return $this->_clear(4);
    }
    
    /**
     * Get <resume_token> value
     *
     * @return string
     */
    public function getResumeToken(){
      return $this->_get(4);
    }
    
    /**
     * Set <resume_token> value
     *
     * @param string $value
     * @return \google\spanner\v1\PartialResultSet
     */
    public function setResumeToken( $value){
      return $this->_set(4, $value);
    }
    
    /**
     * Check if <stats> has a value
     *
     * @return boolean
     */
    public function hasStats(){
      return $this->_has(5);
    }
    
    /**
     * Clear <stats> value
     *
     * @return \google\spanner\v1\PartialResultSet
     */
    public function clearStats(){
      return $this->_clear(5);
    }
    
    /**
     * Get <stats> value
     *
     * @return \google\spanner\v1\ResultSetStats
     */
    public function getStats(){
      return $this->_get(5);
    }
    
    /**
     * Set <stats> value
     *
     * @param \google\spanner\v1\ResultSetStats $value
     * @return \google\spanner\v1\PartialResultSet
     */
    public function setStats(\google\spanner\v1\ResultSetStats $value){
      return $this->_set(5, $value);
    }
  }
}

namespace google\spanner\v1 {

  class ResultSetMetadata extends \DrSlump\Protobuf\Message {

    /**  @var \google\spanner\v1\StructType */
    public $row_type = null;
    
    /**  @var \google\spanner\v1\Transaction */
    public $transaction = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'google.spanner.v1.ResultSetMetadata');

      // OPTIONAL MESSAGE row_type = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "row_type";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\google\spanner\v1\StructType';
      $descriptor->addField($f);

      // OPTIONAL MESSAGE transaction = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "transaction";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\google\spanner\v1\Transaction';
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <row_type> has a value
     *
     * @return boolean
     */
    public function hasRowType(){
      return $this->_has(1);
    }
    
    /**
     * Clear <row_type> value
     *
     * @return \google\spanner\v1\ResultSetMetadata
     */
    public function clearRowType(){
      return $this->_clear(1);
    }
    
    /**
     * Get <row_type> value
     *
     * @return \google\spanner\v1\StructType
     */
    public function getRowType(){
      return $this->_get(1);
    }
    
    /**
     * Set <row_type> value
     *
     * @param \google\spanner\v1\StructType $value
     * @return \google\spanner\v1\ResultSetMetadata
     */
    public function setRowType(\google\spanner\v1\StructType $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <transaction> has a value
     *
     * @return boolean
     */
    public function hasTransaction(){
      return $this->_has(2);
    }
    
    /**
     * Clear <transaction> value
     *
     * @return \google\spanner\v1\ResultSetMetadata
     */
    public function clearTransaction(){
      return $this->_clear(2);
    }
    
    /**
     * Get <transaction> value
     *
     * @return \google\spanner\v1\Transaction
     */
    public function getTransaction(){
      return $this->_get(2);
    }
    
    /**
     * Set <transaction> value
     *
     * @param \google\spanner\v1\Transaction $value
     * @return \google\spanner\v1\ResultSetMetadata
     */
    public function setTransaction(\google\spanner\v1\Transaction $value){
      return $this->_set(2, $value);
    }
  }
}

namespace google\spanner\v1 {

  class ResultSetStats extends \DrSlump\Protobuf\Message {

    /**  @var \google\spanner\v1\QueryPlan */
    public $query_plan = null;
    
    /**  @var \google\protobuf\Struct */
    public $query_stats = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'google.spanner.v1.ResultSetStats');

      // OPTIONAL MESSAGE query_plan = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "query_plan";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\google\spanner\v1\QueryPlan';
      $descriptor->addField($f);

      // OPTIONAL MESSAGE query_stats = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "query_stats";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\google\protobuf\Struct';
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <query_plan> has a value
     *
     * @return boolean
     */
    public function hasQueryPlan(){
      return $this->_has(1);
    }
    
    /**
     * Clear <query_plan> value
     *
     * @return \google\spanner\v1\ResultSetStats
     */
    public function clearQueryPlan(){
      return $this->_clear(1);
    }
    
    /**
     * Get <query_plan> value
     *
     * @return \google\spanner\v1\QueryPlan
     */
    public function getQueryPlan(){
      return $this->_get(1);
    }
    
    /**
     * Set <query_plan> value
     *
     * @param \google\spanner\v1\QueryPlan $value
     * @return \google\spanner\v1\ResultSetStats
     */
    public function setQueryPlan(\google\spanner\v1\QueryPlan $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <query_stats> has a value
     *
     * @return boolean
     */
    public function hasQueryStats(){
      return $this->_has(2);
    }
    
    /**
     * Clear <query_stats> value
     *
     * @return \google\spanner\v1\ResultSetStats
     */
    public function clearQueryStats(){
      return $this->_clear(2);
    }
    
    /**
     * Get <query_stats> value
     *
     * @return \google\protobuf\Struct
     */
    public function getQueryStats(){
      return $this->_get(2);
    }
    
    /**
     * Set <query_stats> value
     *
     * @param \google\protobuf\Struct $value
     * @return \google\spanner\v1\ResultSetStats
     */
    public function setQueryStats(\google\protobuf\Struct $value){
      return $this->_set(2, $value);
    }
  }
}

