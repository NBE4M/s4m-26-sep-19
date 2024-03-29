<?php
// DO NOT EDIT! Generated by Protobuf-PHP protoc plugin 1.0
// Source: google/api/auth.proto
//   Date: 2016-11-23 22:55:01

namespace google\api {

  class Authentication extends \DrSlump\Protobuf\Message {

    /**  @var \google\api\AuthenticationRule[]  */
    public $rules = array();
    
    /**  @var \google\api\AuthProvider[]  */
    public $providers = array();
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'google.api.Authentication');

      // REPEATED MESSAGE rules = 3
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 3;
      $f->name      = "rules";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_REPEATED;
      $f->reference = '\google\api\AuthenticationRule';
      $descriptor->addField($f);

      // REPEATED MESSAGE providers = 4
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 4;
      $f->name      = "providers";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_REPEATED;
      $f->reference = '\google\api\AuthProvider';
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <rules> has a value
     *
     * @return boolean
     */
    public function hasRules(){
      return $this->_has(3);
    }
    
    /**
     * Clear <rules> value
     *
     * @return \google\api\Authentication
     */
    public function clearRules(){
      return $this->_clear(3);
    }
    
    /**
     * Get <rules> value
     *
     * @param int $idx
     * @return \google\api\AuthenticationRule
     */
    public function getRules($idx = NULL){
      return $this->_get(3, $idx);
    }
    
    /**
     * Set <rules> value
     *
     * @param \google\api\AuthenticationRule $value
     * @return \google\api\Authentication
     */
    public function setRules(\google\api\AuthenticationRule $value, $idx = NULL){
      return $this->_set(3, $value, $idx);
    }
    
    /**
     * Get all elements of <rules>
     *
     * @return \google\api\AuthenticationRule[]
     */
    public function getRulesList(){
     return $this->_get(3);
    }
    
    /**
     * Add a new element to <rules>
     *
     * @param \google\api\AuthenticationRule $value
     * @return \google\api\Authentication
     */
    public function addRules(\google\api\AuthenticationRule $value){
     return $this->_add(3, $value);
    }
    
    /**
     * Check if <providers> has a value
     *
     * @return boolean
     */
    public function hasProviders(){
      return $this->_has(4);
    }
    
    /**
     * Clear <providers> value
     *
     * @return \google\api\Authentication
     */
    public function clearProviders(){
      return $this->_clear(4);
    }
    
    /**
     * Get <providers> value
     *
     * @param int $idx
     * @return \google\api\AuthProvider
     */
    public function getProviders($idx = NULL){
      return $this->_get(4, $idx);
    }
    
    /**
     * Set <providers> value
     *
     * @param \google\api\AuthProvider $value
     * @return \google\api\Authentication
     */
    public function setProviders(\google\api\AuthProvider $value, $idx = NULL){
      return $this->_set(4, $value, $idx);
    }
    
    /**
     * Get all elements of <providers>
     *
     * @return \google\api\AuthProvider[]
     */
    public function getProvidersList(){
     return $this->_get(4);
    }
    
    /**
     * Add a new element to <providers>
     *
     * @param \google\api\AuthProvider $value
     * @return \google\api\Authentication
     */
    public function addProviders(\google\api\AuthProvider $value){
     return $this->_add(4, $value);
    }
  }
}

namespace google\api {

  class AuthenticationRule extends \DrSlump\Protobuf\Message {

    /**  @var string */
    public $selector = null;
    
    /**  @var \google\api\OAuthRequirements */
    public $oauth = null;
    
    /**  @var boolean */
    public $allow_without_credential = null;
    
    /**  @var \google\api\AuthRequirement[]  */
    public $requirements = array();
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'google.api.AuthenticationRule');

      // OPTIONAL STRING selector = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "selector";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL MESSAGE oauth = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "oauth";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\google\api\OAuthRequirements';
      $descriptor->addField($f);

      // OPTIONAL BOOL allow_without_credential = 5
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 5;
      $f->name      = "allow_without_credential";
      $f->type      = \DrSlump\Protobuf::TYPE_BOOL;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // REPEATED MESSAGE requirements = 7
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 7;
      $f->name      = "requirements";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_REPEATED;
      $f->reference = '\google\api\AuthRequirement';
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <selector> has a value
     *
     * @return boolean
     */
    public function hasSelector(){
      return $this->_has(1);
    }
    
    /**
     * Clear <selector> value
     *
     * @return \google\api\AuthenticationRule
     */
    public function clearSelector(){
      return $this->_clear(1);
    }
    
    /**
     * Get <selector> value
     *
     * @return string
     */
    public function getSelector(){
      return $this->_get(1);
    }
    
    /**
     * Set <selector> value
     *
     * @param string $value
     * @return \google\api\AuthenticationRule
     */
    public function setSelector( $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <oauth> has a value
     *
     * @return boolean
     */
    public function hasOauth(){
      return $this->_has(2);
    }
    
    /**
     * Clear <oauth> value
     *
     * @return \google\api\AuthenticationRule
     */
    public function clearOauth(){
      return $this->_clear(2);
    }
    
    /**
     * Get <oauth> value
     *
     * @return \google\api\OAuthRequirements
     */
    public function getOauth(){
      return $this->_get(2);
    }
    
    /**
     * Set <oauth> value
     *
     * @param \google\api\OAuthRequirements $value
     * @return \google\api\AuthenticationRule
     */
    public function setOauth(\google\api\OAuthRequirements $value){
      return $this->_set(2, $value);
    }
    
    /**
     * Check if <allow_without_credential> has a value
     *
     * @return boolean
     */
    public function hasAllowWithoutCredential(){
      return $this->_has(5);
    }
    
    /**
     * Clear <allow_without_credential> value
     *
     * @return \google\api\AuthenticationRule
     */
    public function clearAllowWithoutCredential(){
      return $this->_clear(5);
    }
    
    /**
     * Get <allow_without_credential> value
     *
     * @return boolean
     */
    public function getAllowWithoutCredential(){
      return $this->_get(5);
    }
    
    /**
     * Set <allow_without_credential> value
     *
     * @param boolean $value
     * @return \google\api\AuthenticationRule
     */
    public function setAllowWithoutCredential( $value){
      return $this->_set(5, $value);
    }
    
    /**
     * Check if <requirements> has a value
     *
     * @return boolean
     */
    public function hasRequirements(){
      return $this->_has(7);
    }
    
    /**
     * Clear <requirements> value
     *
     * @return \google\api\AuthenticationRule
     */
    public function clearRequirements(){
      return $this->_clear(7);
    }
    
    /**
     * Get <requirements> value
     *
     * @param int $idx
     * @return \google\api\AuthRequirement
     */
    public function getRequirements($idx = NULL){
      return $this->_get(7, $idx);
    }
    
    /**
     * Set <requirements> value
     *
     * @param \google\api\AuthRequirement $value
     * @return \google\api\AuthenticationRule
     */
    public function setRequirements(\google\api\AuthRequirement $value, $idx = NULL){
      return $this->_set(7, $value, $idx);
    }
    
    /**
     * Get all elements of <requirements>
     *
     * @return \google\api\AuthRequirement[]
     */
    public function getRequirementsList(){
     return $this->_get(7);
    }
    
    /**
     * Add a new element to <requirements>
     *
     * @param \google\api\AuthRequirement $value
     * @return \google\api\AuthenticationRule
     */
    public function addRequirements(\google\api\AuthRequirement $value){
     return $this->_add(7, $value);
    }
  }
}

namespace google\api {

  class AuthProvider extends \DrSlump\Protobuf\Message {

    /**  @var string */
    public $id = null;
    
    /**  @var string */
    public $issuer = null;
    
    /**  @var string */
    public $jwks_uri = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'google.api.AuthProvider');

      // OPTIONAL STRING id = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "id";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL STRING issuer = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "issuer";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL STRING jwks_uri = 3
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 3;
      $f->name      = "jwks_uri";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
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
     * @return \google\api\AuthProvider
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
     * @return \google\api\AuthProvider
     */
    public function setId( $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <issuer> has a value
     *
     * @return boolean
     */
    public function hasIssuer(){
      return $this->_has(2);
    }
    
    /**
     * Clear <issuer> value
     *
     * @return \google\api\AuthProvider
     */
    public function clearIssuer(){
      return $this->_clear(2);
    }
    
    /**
     * Get <issuer> value
     *
     * @return string
     */
    public function getIssuer(){
      return $this->_get(2);
    }
    
    /**
     * Set <issuer> value
     *
     * @param string $value
     * @return \google\api\AuthProvider
     */
    public function setIssuer( $value){
      return $this->_set(2, $value);
    }
    
    /**
     * Check if <jwks_uri> has a value
     *
     * @return boolean
     */
    public function hasJwksUri(){
      return $this->_has(3);
    }
    
    /**
     * Clear <jwks_uri> value
     *
     * @return \google\api\AuthProvider
     */
    public function clearJwksUri(){
      return $this->_clear(3);
    }
    
    /**
     * Get <jwks_uri> value
     *
     * @return string
     */
    public function getJwksUri(){
      return $this->_get(3);
    }
    
    /**
     * Set <jwks_uri> value
     *
     * @param string $value
     * @return \google\api\AuthProvider
     */
    public function setJwksUri( $value){
      return $this->_set(3, $value);
    }
  }
}

namespace google\api {

  class OAuthRequirements extends \DrSlump\Protobuf\Message {

    /**  @var string */
    public $canonical_scopes = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'google.api.OAuthRequirements');

      // OPTIONAL STRING canonical_scopes = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "canonical_scopes";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <canonical_scopes> has a value
     *
     * @return boolean
     */
    public function hasCanonicalScopes(){
      return $this->_has(1);
    }
    
    /**
     * Clear <canonical_scopes> value
     *
     * @return \google\api\OAuthRequirements
     */
    public function clearCanonicalScopes(){
      return $this->_clear(1);
    }
    
    /**
     * Get <canonical_scopes> value
     *
     * @return string
     */
    public function getCanonicalScopes(){
      return $this->_get(1);
    }
    
    /**
     * Set <canonical_scopes> value
     *
     * @param string $value
     * @return \google\api\OAuthRequirements
     */
    public function setCanonicalScopes( $value){
      return $this->_set(1, $value);
    }
  }
}

namespace google\api {

  class AuthRequirement extends \DrSlump\Protobuf\Message {

    /**  @var string */
    public $provider_id = null;
    
    /**  @var string */
    public $audiences = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'google.api.AuthRequirement');

      // OPTIONAL STRING provider_id = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "provider_id";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL STRING audiences = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "audiences";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <provider_id> has a value
     *
     * @return boolean
     */
    public function hasProviderId(){
      return $this->_has(1);
    }
    
    /**
     * Clear <provider_id> value
     *
     * @return \google\api\AuthRequirement
     */
    public function clearProviderId(){
      return $this->_clear(1);
    }
    
    /**
     * Get <provider_id> value
     *
     * @return string
     */
    public function getProviderId(){
      return $this->_get(1);
    }
    
    /**
     * Set <provider_id> value
     *
     * @param string $value
     * @return \google\api\AuthRequirement
     */
    public function setProviderId( $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <audiences> has a value
     *
     * @return boolean
     */
    public function hasAudiences(){
      return $this->_has(2);
    }
    
    /**
     * Clear <audiences> value
     *
     * @return \google\api\AuthRequirement
     */
    public function clearAudiences(){
      return $this->_clear(2);
    }
    
    /**
     * Get <audiences> value
     *
     * @return string
     */
    public function getAudiences(){
      return $this->_get(2);
    }
    
    /**
     * Set <audiences> value
     *
     * @param string $value
     * @return \google\api\AuthRequirement
     */
    public function setAudiences( $value){
      return $this->_set(2, $value);
    }
  }
}

