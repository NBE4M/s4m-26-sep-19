<?php
// DO NOT EDIT! Generated by Protobuf-PHP protoc plugin 1.0
// Source: google/logging/v2/logging_metrics.proto
//   Date: 2016-12-21 17:12:40

namespace google\logging\v2\LogMetric {

  class ApiVersion extends \DrSlump\Protobuf\Enum {
    const V2 = 0;
    const V1 = 1;
  }
}
namespace google\logging\v2 {

  class LogMetric extends \DrSlump\Protobuf\Message {

    /**  @var string */
    public $name = null;
    
    /**  @var string */
    public $description = null;
    
    /**  @var string */
    public $filter = null;
    
    /**  @var int - \google\logging\v2\LogMetric\ApiVersion */
    public $version = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'google.logging.v2.LogMetric');

      // OPTIONAL STRING name = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "name";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL STRING description = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "description";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL STRING filter = 3
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 3;
      $f->name      = "filter";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL ENUM version = 4
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 4;
      $f->name      = "version";
      $f->type      = \DrSlump\Protobuf::TYPE_ENUM;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\google\logging\v2\LogMetric\ApiVersion';
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
     * @return \google\logging\v2\LogMetric
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
     * @return \google\logging\v2\LogMetric
     */
    public function setName( $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <description> has a value
     *
     * @return boolean
     */
    public function hasDescription(){
      return $this->_has(2);
    }
    
    /**
     * Clear <description> value
     *
     * @return \google\logging\v2\LogMetric
     */
    public function clearDescription(){
      return $this->_clear(2);
    }
    
    /**
     * Get <description> value
     *
     * @return string
     */
    public function getDescription(){
      return $this->_get(2);
    }
    
    /**
     * Set <description> value
     *
     * @param string $value
     * @return \google\logging\v2\LogMetric
     */
    public function setDescription( $value){
      return $this->_set(2, $value);
    }
    
    /**
     * Check if <filter> has a value
     *
     * @return boolean
     */
    public function hasFilter(){
      return $this->_has(3);
    }
    
    /**
     * Clear <filter> value
     *
     * @return \google\logging\v2\LogMetric
     */
    public function clearFilter(){
      return $this->_clear(3);
    }
    
    /**
     * Get <filter> value
     *
     * @return string
     */
    public function getFilter(){
      return $this->_get(3);
    }
    
    /**
     * Set <filter> value
     *
     * @param string $value
     * @return \google\logging\v2\LogMetric
     */
    public function setFilter( $value){
      return $this->_set(3, $value);
    }
    
    /**
     * Check if <version> has a value
     *
     * @return boolean
     */
    public function hasVersion(){
      return $this->_has(4);
    }
    
    /**
     * Clear <version> value
     *
     * @return \google\logging\v2\LogMetric
     */
    public function clearVersion(){
      return $this->_clear(4);
    }
    
    /**
     * Get <version> value
     *
     * @return int - \google\logging\v2\LogMetric\ApiVersion
     */
    public function getVersion(){
      return $this->_get(4);
    }
    
    /**
     * Set <version> value
     *
     * @param int - \google\logging\v2\LogMetric\ApiVersion $value
     * @return \google\logging\v2\LogMetric
     */
    public function setVersion( $value){
      return $this->_set(4, $value);
    }
  }
}

namespace google\logging\v2 {

  class ListLogMetricsRequest extends \DrSlump\Protobuf\Message {

    /**  @var string */
    public $parent = null;
    
    /**  @var string */
    public $page_token = null;
    
    /**  @var int */
    public $page_size = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'google.logging.v2.ListLogMetricsRequest');

      // OPTIONAL STRING parent = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "parent";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL STRING page_token = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "page_token";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL INT32 page_size = 3
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 3;
      $f->name      = "page_size";
      $f->type      = \DrSlump\Protobuf::TYPE_INT32;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <parent> has a value
     *
     * @return boolean
     */
    public function hasParent(){
      return $this->_has(1);
    }
    
    /**
     * Clear <parent> value
     *
     * @return \google\logging\v2\ListLogMetricsRequest
     */
    public function clearParent(){
      return $this->_clear(1);
    }
    
    /**
     * Get <parent> value
     *
     * @return string
     */
    public function getParent(){
      return $this->_get(1);
    }
    
    /**
     * Set <parent> value
     *
     * @param string $value
     * @return \google\logging\v2\ListLogMetricsRequest
     */
    public function setParent( $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <page_token> has a value
     *
     * @return boolean
     */
    public function hasPageToken(){
      return $this->_has(2);
    }
    
    /**
     * Clear <page_token> value
     *
     * @return \google\logging\v2\ListLogMetricsRequest
     */
    public function clearPageToken(){
      return $this->_clear(2);
    }
    
    /**
     * Get <page_token> value
     *
     * @return string
     */
    public function getPageToken(){
      return $this->_get(2);
    }
    
    /**
     * Set <page_token> value
     *
     * @param string $value
     * @return \google\logging\v2\ListLogMetricsRequest
     */
    public function setPageToken( $value){
      return $this->_set(2, $value);
    }
    
    /**
     * Check if <page_size> has a value
     *
     * @return boolean
     */
    public function hasPageSize(){
      return $this->_has(3);
    }
    
    /**
     * Clear <page_size> value
     *
     * @return \google\logging\v2\ListLogMetricsRequest
     */
    public function clearPageSize(){
      return $this->_clear(3);
    }
    
    /**
     * Get <page_size> value
     *
     * @return int
     */
    public function getPageSize(){
      return $this->_get(3);
    }
    
    /**
     * Set <page_size> value
     *
     * @param int $value
     * @return \google\logging\v2\ListLogMetricsRequest
     */
    public function setPageSize( $value){
      return $this->_set(3, $value);
    }
  }
}

namespace google\logging\v2 {

  class ListLogMetricsResponse extends \DrSlump\Protobuf\Message {

    /**  @var \google\logging\v2\LogMetric[]  */
    public $metrics = array();
    
    /**  @var string */
    public $next_page_token = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'google.logging.v2.ListLogMetricsResponse');

      // REPEATED MESSAGE metrics = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "metrics";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_REPEATED;
      $f->reference = '\google\logging\v2\LogMetric';
      $descriptor->addField($f);

      // OPTIONAL STRING next_page_token = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "next_page_token";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <metrics> has a value
     *
     * @return boolean
     */
    public function hasMetrics(){
      return $this->_has(1);
    }
    
    /**
     * Clear <metrics> value
     *
     * @return \google\logging\v2\ListLogMetricsResponse
     */
    public function clearMetrics(){
      return $this->_clear(1);
    }
    
    /**
     * Get <metrics> value
     *
     * @param int $idx
     * @return \google\logging\v2\LogMetric
     */
    public function getMetrics($idx = NULL){
      return $this->_get(1, $idx);
    }
    
    /**
     * Set <metrics> value
     *
     * @param \google\logging\v2\LogMetric $value
     * @return \google\logging\v2\ListLogMetricsResponse
     */
    public function setMetrics(\google\logging\v2\LogMetric $value, $idx = NULL){
      return $this->_set(1, $value, $idx);
    }
    
    /**
     * Get all elements of <metrics>
     *
     * @return \google\logging\v2\LogMetric[]
     */
    public function getMetricsList(){
     return $this->_get(1);
    }
    
    /**
     * Add a new element to <metrics>
     *
     * @param \google\logging\v2\LogMetric $value
     * @return \google\logging\v2\ListLogMetricsResponse
     */
    public function addMetrics(\google\logging\v2\LogMetric $value){
     return $this->_add(1, $value);
    }
    
    /**
     * Check if <next_page_token> has a value
     *
     * @return boolean
     */
    public function hasNextPageToken(){
      return $this->_has(2);
    }
    
    /**
     * Clear <next_page_token> value
     *
     * @return \google\logging\v2\ListLogMetricsResponse
     */
    public function clearNextPageToken(){
      return $this->_clear(2);
    }
    
    /**
     * Get <next_page_token> value
     *
     * @return string
     */
    public function getNextPageToken(){
      return $this->_get(2);
    }
    
    /**
     * Set <next_page_token> value
     *
     * @param string $value
     * @return \google\logging\v2\ListLogMetricsResponse
     */
    public function setNextPageToken( $value){
      return $this->_set(2, $value);
    }
  }
}

namespace google\logging\v2 {

  class GetLogMetricRequest extends \DrSlump\Protobuf\Message {

    /**  @var string */
    public $metric_name = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'google.logging.v2.GetLogMetricRequest');

      // OPTIONAL STRING metric_name = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "metric_name";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <metric_name> has a value
     *
     * @return boolean
     */
    public function hasMetricName(){
      return $this->_has(1);
    }
    
    /**
     * Clear <metric_name> value
     *
     * @return \google\logging\v2\GetLogMetricRequest
     */
    public function clearMetricName(){
      return $this->_clear(1);
    }
    
    /**
     * Get <metric_name> value
     *
     * @return string
     */
    public function getMetricName(){
      return $this->_get(1);
    }
    
    /**
     * Set <metric_name> value
     *
     * @param string $value
     * @return \google\logging\v2\GetLogMetricRequest
     */
    public function setMetricName( $value){
      return $this->_set(1, $value);
    }
  }
}

namespace google\logging\v2 {

  class CreateLogMetricRequest extends \DrSlump\Protobuf\Message {

    /**  @var string */
    public $parent = null;
    
    /**  @var \google\logging\v2\LogMetric */
    public $metric = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'google.logging.v2.CreateLogMetricRequest');

      // OPTIONAL STRING parent = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "parent";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL MESSAGE metric = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "metric";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\google\logging\v2\LogMetric';
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <parent> has a value
     *
     * @return boolean
     */
    public function hasParent(){
      return $this->_has(1);
    }
    
    /**
     * Clear <parent> value
     *
     * @return \google\logging\v2\CreateLogMetricRequest
     */
    public function clearParent(){
      return $this->_clear(1);
    }
    
    /**
     * Get <parent> value
     *
     * @return string
     */
    public function getParent(){
      return $this->_get(1);
    }
    
    /**
     * Set <parent> value
     *
     * @param string $value
     * @return \google\logging\v2\CreateLogMetricRequest
     */
    public function setParent( $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <metric> has a value
     *
     * @return boolean
     */
    public function hasMetric(){
      return $this->_has(2);
    }
    
    /**
     * Clear <metric> value
     *
     * @return \google\logging\v2\CreateLogMetricRequest
     */
    public function clearMetric(){
      return $this->_clear(2);
    }
    
    /**
     * Get <metric> value
     *
     * @return \google\logging\v2\LogMetric
     */
    public function getMetric(){
      return $this->_get(2);
    }
    
    /**
     * Set <metric> value
     *
     * @param \google\logging\v2\LogMetric $value
     * @return \google\logging\v2\CreateLogMetricRequest
     */
    public function setMetric(\google\logging\v2\LogMetric $value){
      return $this->_set(2, $value);
    }
  }
}

namespace google\logging\v2 {

  class UpdateLogMetricRequest extends \DrSlump\Protobuf\Message {

    /**  @var string */
    public $metric_name = null;
    
    /**  @var \google\logging\v2\LogMetric */
    public $metric = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'google.logging.v2.UpdateLogMetricRequest');

      // OPTIONAL STRING metric_name = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "metric_name";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL MESSAGE metric = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "metric";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\google\logging\v2\LogMetric';
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <metric_name> has a value
     *
     * @return boolean
     */
    public function hasMetricName(){
      return $this->_has(1);
    }
    
    /**
     * Clear <metric_name> value
     *
     * @return \google\logging\v2\UpdateLogMetricRequest
     */
    public function clearMetricName(){
      return $this->_clear(1);
    }
    
    /**
     * Get <metric_name> value
     *
     * @return string
     */
    public function getMetricName(){
      return $this->_get(1);
    }
    
    /**
     * Set <metric_name> value
     *
     * @param string $value
     * @return \google\logging\v2\UpdateLogMetricRequest
     */
    public function setMetricName( $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <metric> has a value
     *
     * @return boolean
     */
    public function hasMetric(){
      return $this->_has(2);
    }
    
    /**
     * Clear <metric> value
     *
     * @return \google\logging\v2\UpdateLogMetricRequest
     */
    public function clearMetric(){
      return $this->_clear(2);
    }
    
    /**
     * Get <metric> value
     *
     * @return \google\logging\v2\LogMetric
     */
    public function getMetric(){
      return $this->_get(2);
    }
    
    /**
     * Set <metric> value
     *
     * @param \google\logging\v2\LogMetric $value
     * @return \google\logging\v2\UpdateLogMetricRequest
     */
    public function setMetric(\google\logging\v2\LogMetric $value){
      return $this->_set(2, $value);
    }
  }
}

namespace google\logging\v2 {

  class DeleteLogMetricRequest extends \DrSlump\Protobuf\Message {

    /**  @var string */
    public $metric_name = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'google.logging.v2.DeleteLogMetricRequest');

      // OPTIONAL STRING metric_name = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "metric_name";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <metric_name> has a value
     *
     * @return boolean
     */
    public function hasMetricName(){
      return $this->_has(1);
    }
    
    /**
     * Clear <metric_name> value
     *
     * @return \google\logging\v2\DeleteLogMetricRequest
     */
    public function clearMetricName(){
      return $this->_clear(1);
    }
    
    /**
     * Get <metric_name> value
     *
     * @return string
     */
    public function getMetricName(){
      return $this->_get(1);
    }
    
    /**
     * Set <metric_name> value
     *
     * @param string $value
     * @return \google\logging\v2\DeleteLogMetricRequest
     */
    public function setMetricName( $value){
      return $this->_set(1, $value);
    }
  }
}

namespace google\logging\v2 {

  class MetricsServiceV2GrpcClient extends \Grpc\BaseStub {

    public function __construct($hostname, $opts) {
      parent::__construct($hostname, $opts);
    }
    /**
     * @param google\logging\v2\ListLogMetricsRequest $input
     */
    public function ListLogMetrics(\google\logging\v2\ListLogMetricsRequest $argument, $metadata = array(), $options = array()) {
      return $this->_simpleRequest('/google.logging.v2.MetricsServiceV2/ListLogMetrics', $argument, '\google\logging\v2\ListLogMetricsResponse::deserialize', $metadata, $options);
    }
    /**
     * @param google\logging\v2\GetLogMetricRequest $input
     */
    public function GetLogMetric(\google\logging\v2\GetLogMetricRequest $argument, $metadata = array(), $options = array()) {
      return $this->_simpleRequest('/google.logging.v2.MetricsServiceV2/GetLogMetric', $argument, '\google\logging\v2\LogMetric::deserialize', $metadata, $options);
    }
    /**
     * @param google\logging\v2\CreateLogMetricRequest $input
     */
    public function CreateLogMetric(\google\logging\v2\CreateLogMetricRequest $argument, $metadata = array(), $options = array()) {
      return $this->_simpleRequest('/google.logging.v2.MetricsServiceV2/CreateLogMetric', $argument, '\google\logging\v2\LogMetric::deserialize', $metadata, $options);
    }
    /**
     * @param google\logging\v2\UpdateLogMetricRequest $input
     */
    public function UpdateLogMetric(\google\logging\v2\UpdateLogMetricRequest $argument, $metadata = array(), $options = array()) {
      return $this->_simpleRequest('/google.logging.v2.MetricsServiceV2/UpdateLogMetric', $argument, '\google\logging\v2\LogMetric::deserialize', $metadata, $options);
    }
    /**
     * @param google\logging\v2\DeleteLogMetricRequest $input
     */
    public function DeleteLogMetric(\google\logging\v2\DeleteLogMetricRequest $argument, $metadata = array(), $options = array()) {
      return $this->_simpleRequest('/google.logging.v2.MetricsServiceV2/DeleteLogMetric', $argument, '\google\protobuf\EmptyC::deserialize', $metadata, $options);
    }
  }
}
