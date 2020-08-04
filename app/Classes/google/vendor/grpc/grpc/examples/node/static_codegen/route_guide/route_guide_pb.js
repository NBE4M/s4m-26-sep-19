/**
 * @fileoverview
 * @enhanceable
 * @public
 */
// GENERATED CODE -- DO NOT EDIT!

var jspb = require('google-protobuf');
var goog = jspb;
var global = Function('return this')();

goog.exportSymbol('proto.routeguide.Feature', null, global);
goog.exportSymbol('proto.routeguide.Point', null, global);
goog.exportSymbol('proto.routeguide.Rectangle', null, global);
goog.exportSymbol('proto.routeguide.RouteNote', null, global);
goog.exportSymbol('proto.routeguide.RouteSummary', null, global);

/**
 * Generated by JsPbCodeGenerator.
 * @param {Array=} opt_data Optional initial data array, typically from a
 * server response, or constructed directly in Javascript. The array is used
 * in place and becomes part of the constructed object. It is not cloned.
 * If no data is provided, the constructed object will be empty, but still
 * valid.
 * @extends {jspb.Message}
 * @constructor
 */
proto.routeguide.Point = function(opt_data) {
  jspb.Message.initialize(this, opt_data, 0, -1, null, null);
};
goog.inherits(proto.routeguide.Point, jspb.Message);
if (goog.DEBUG && !COMPILED) {
  proto.routeguide.Point.displayName = 'proto.routeguide.Point';
}


if (jspb.Message.GENERATE_TO_OBJECT) {
/**
 * Creates an object representation of this proto suitable for use in Soy templates.
 * Field names that are reserved in JavaScript and will be renamed to pb_name.
 * To access a reserved field use, foo.pb_<name>, eg, foo.pb_default.
 * For the list of reserved names please see:
 *     com.google.apps.jspb.JsClassTemplate.JS_RESERVED_WORDS.
 * @param {boolean=} opt_includeInstance Whether to include the JSPB instance
 *     for transitional soy proto support: http://goto/soy-param-migration
 * @return {!Object}
 */
proto.routeguide.Point.prototype.toObject = function(opt_includeInstance) {
  return proto.routeguide.Point.toObject(opt_includeInstance, this);
};


/**
 * Static version of the {@see toObject} method.
 * @param {boolean|undefined} includeInstance Whether to include the JSPB
 *     instance for transitional soy proto support:
 *     http://goto/soy-param-migration
 * @param {!proto.routeguide.Point} msg The msg instance to transform.
 * @return {!Object}
 */
proto.routeguide.Point.toObject = function(includeInstance, msg) {
  var f, obj = {
    latitude: msg.getLatitude(),
    longitude: msg.getLongitude()
  };

  if (includeInstance) {
    obj.$jspbMessageInstance = msg;
  }
  return obj;
};
}


/**
 * Deserializes binary data (in protobuf wire format).
 * @param {jspb.ByteSource} bytes The bytes to deserialize.
 * @return {!proto.routeguide.Point}
 */
proto.routeguide.Point.deserializeBinary = function(bytes) {
  var reader = new jspb.BinaryReader(bytes);
  var msg = new proto.routeguide.Point;
  return proto.routeguide.Point.deserializeBinaryFromReader(msg, reader);
};


/**
 * Deserializes binary data (in protobuf wire format) from the
 * given reader into the given message object.
 * @param {!proto.routeguide.Point} msg The message object to deserialize into.
 * @param {!jspb.BinaryReader} reader The BinaryReader to use.
 * @return {!proto.routeguide.Point}
 */
proto.routeguide.Point.deserializeBinaryFromReader = function(msg, reader) {
  while (reader.nextField()) {
    if (reader.isEndGroup()) {
      break;
    }
    var field = reader.getFieldNumber();
    switch (field) {
    case 1:
      var value = /** @type {number} */ (reader.readInt32());
      msg.setLatitude(value);
      break;
    case 2:
      var value = /** @type {number} */ (reader.readInt32());
      msg.setLongitude(value);
      break;
    default:
      reader.skipField();
      break;
    }
  }
  return msg;
};


/**
 * Class method variant: serializes the given message to binary data
 * (in protobuf wire format), writing to the given BinaryWriter.
 * @param {!proto.routeguide.Point} message
 * @param {!jspb.BinaryWriter} writer
 */
proto.routeguide.Point.serializeBinaryToWriter = function(message, writer) {
  message.serializeBinaryToWriter(writer);
};


/**
 * Serializes the message to binary data (in protobuf wire format).
 * @return {!Uint8Array}
 */
proto.routeguide.Point.prototype.serializeBinary = function() {
  var writer = new jspb.BinaryWriter();
  this.serializeBinaryToWriter(writer);
  return writer.getResultBuffer();
};


/**
 * Serializes the message to binary data (in protobuf wire format),
 * writing to the given BinaryWriter.
 * @param {!jspb.BinaryWriter} writer
 */
proto.routeguide.Point.prototype.serializeBinaryToWriter = function (writer) {
  var f = undefined;
  f = this.getLatitude();
  if (f !== 0) {
    writer.writeInt32(
      1,
      f
    );
  }
  f = this.getLongitude();
  if (f !== 0) {
    writer.writeInt32(
      2,
      f
    );
  }
};


/**
 * Creates a deep clone of this proto. No data is shared with the original.
 * @return {!proto.routeguide.Point} The clone.
 */
proto.routeguide.Point.prototype.cloneMessage = function() {
  return /** @type {!proto.routeguide.Point} */ (jspb.Message.cloneMessage(this));
};


/**
 * optional int32 latitude = 1;
 * @return {number}
 */
proto.routeguide.Point.prototype.getLatitude = function() {
  return /** @type {number} */ (jspb.Message.getFieldProto3(this, 1, 0));
};


/** @param {number} value  */
proto.routeguide.Point.prototype.setLatitude = function(value) {
  jspb.Message.setField(this, 1, value);
};


/**
 * optional int32 longitude = 2;
 * @return {number}
 */
proto.routeguide.Point.prototype.getLongitude = function() {
  return /** @type {number} */ (jspb.Message.getFieldProto3(this, 2, 0));
};


/** @param {number} value  */
proto.routeguide.Point.prototype.setLongitude = function(value) {
  jspb.Message.setField(this, 2, value);
};



/**
 * Generated by JsPbCodeGenerator.
 * @param {Array=} opt_data Optional initial data array, typically from a
 * server response, or constructed directly in Javascript. The array is used
 * in place and becomes part of the constructed object. It is not cloned.
 * If no data is provided, the constructed object will be empty, but still
 * valid.
 * @extends {jspb.Message}
 * @constructor
 */
proto.routeguide.Rectangle = function(opt_data) {
  jspb.Message.initialize(this, opt_data, 0, -1, null, null);
};
goog.inherits(proto.routeguide.Rectangle, jspb.Message);
if (goog.DEBUG && !COMPILED) {
  proto.routeguide.Rectangle.displayName = 'proto.routeguide.Rectangle';
}


if (jspb.Message.GENERATE_TO_OBJECT) {
/**
 * Creates an object representation of this proto suitable for use in Soy templates.
 * Field names that are reserved in JavaScript and will be renamed to pb_name.
 * To access a reserved field use, foo.pb_<name>, eg, foo.pb_default.
 * For the list of reserved names please see:
 *     com.google.apps.jspb.JsClassTemplate.JS_RESERVED_WORDS.
 * @param {boolean=} opt_includeInstance Whether to include the JSPB instance
 *     for transitional soy proto support: http://goto/soy-param-migration
 * @return {!Object}
 */
proto.routeguide.Rectangle.prototype.toObject = function(opt_includeInstance) {
  return proto.routeguide.Rectangle.toObject(opt_includeInstance, this);
};


/**
 * Static version of the {@see toObject} method.
 * @param {boolean|undefined} includeInstance Whether to include the JSPB
 *     instance for transitional soy proto support:
 *     http://goto/soy-param-migration
 * @param {!proto.routeguide.Rectangle} msg The msg instance to transform.
 * @return {!Object}
 */
proto.routeguide.Rectangle.toObject = function(includeInstance, msg) {
  var f, obj = {
    lo: (f = msg.getLo()) && proto.routeguide.Point.toObject(includeInstance, f),
    hi: (f = msg.getHi()) && proto.routeguide.Point.toObject(includeInstance, f)
  };

  if (includeInstance) {
    obj.$jspbMessageInstance = msg;
  }
  return obj;
};
}


/**
 * Deserializes binary data (in protobuf wire format).
 * @param {jspb.ByteSource} bytes The bytes to deserialize.
 * @return {!proto.routeguide.Rectangle}
 */
proto.routeguide.Rectangle.deserializeBinary = function(bytes) {
  var reader = new jspb.BinaryReader(bytes);
  var msg = new proto.routeguide.Rectangle;
  return proto.routeguide.Rectangle.deserializeBinaryFromReader(msg, reader);
};


/**
 * Deserializes binary data (in protobuf wire format) from the
 * given reader into the given message object.
 * @param {!proto.routeguide.Rectangle} msg The message object to deserialize into.
 * @param {!jspb.BinaryReader} reader The BinaryReader to use.
 * @return {!proto.routeguide.Rectangle}
 */
proto.routeguide.Rectangle.deserializeBinaryFromReader = function(msg, reader) {
  while (reader.nextField()) {
    if (reader.isEndGroup()) {
      break;
    }
    var field = reader.getFieldNumber();
    switch (field) {
    case 1:
      var value = new proto.routeguide.Point;
      reader.readMessage(value,proto.routeguide.Point.deserializeBinaryFromReader);
      msg.setLo(value);
      break;
    case 2:
      var value = new proto.routeguide.Point;
      reader.readMessage(value,proto.routeguide.Point.deserializeBinaryFromReader);
      msg.setHi(value);
      break;
    default:
      reader.skipField();
      break;
    }
  }
  return msg;
};


/**
 * Class method variant: serializes the given message to binary data
 * (in protobuf wire format), writing to the given BinaryWriter.
 * @param {!proto.routeguide.Rectangle} message
 * @param {!jspb.BinaryWriter} writer
 */
proto.routeguide.Rectangle.serializeBinaryToWriter = function(message, writer) {
  message.serializeBinaryToWriter(writer);
};


/**
 * Serializes the message to binary data (in protobuf wire format).
 * @return {!Uint8Array}
 */
proto.routeguide.Rectangle.prototype.serializeBinary = function() {
  var writer = new jspb.BinaryWriter();
  this.serializeBinaryToWriter(writer);
  return writer.getResultBuffer();
};


/**
 * Serializes the message to binary data (in protobuf wire format),
 * writing to the given BinaryWriter.
 * @param {!jspb.BinaryWriter} writer
 */
proto.routeguide.Rectangle.prototype.serializeBinaryToWriter = function (writer) {
  var f = undefined;
  f = this.getLo();
  if (f != null) {
    writer.writeMessage(
      1,
      f,
      proto.routeguide.Point.serializeBinaryToWriter
    );
  }
  f = this.getHi();
  if (f != null) {
    writer.writeMessage(
      2,
      f,
      proto.routeguide.Point.serializeBinaryToWriter
    );
  }
};


/**
 * Creates a deep clone of this proto. No data is shared with the original.
 * @return {!proto.routeguide.Rectangle} The clone.
 */
proto.routeguide.Rectangle.prototype.cloneMessage = function() {
  return /** @type {!proto.routeguide.Rectangle} */ (jspb.Message.cloneMessage(this));
};


/**
 * optional Point lo = 1;
 * @return {proto.routeguide.Point}
 */
proto.routeguide.Rectangle.prototype.getLo = function() {
  return /** @type{proto.routeguide.Point} */ (
    jspb.Message.getWrapperField(this, proto.routeguide.Point, 1));
};


/** @param {proto.routeguide.Point|undefined} value  */
proto.routeguide.Rectangle.prototype.setLo = function(value) {
  jspb.Message.setWrapperField(this, 1, value);
};


proto.routeguide.Rectangle.prototype.clearLo = function() {
  this.setLo(undefined);
};


/**
 * optional Point hi = 2;
 * @return {proto.routeguide.Point}
 */
proto.routeguide.Rectangle.prototype.getHi = function() {
  return /** @type{proto.routeguide.Point} */ (
    jspb.Message.getWrapperField(this, proto.routeguide.Point, 2));
};


/** @param {proto.routeguide.Point|undefined} value  */
proto.routeguide.Rectangle.prototype.setHi = function(value) {
  jspb.Message.setWrapperField(this, 2, value);
};


proto.routeguide.Rectangle.prototype.clearHi = function() {
  this.setHi(undefined);
};



/**
 * Generated by JsPbCodeGenerator.
 * @param {Array=} opt_data Optional initial data array, typically from a
 * server response, or constructed directly in Javascript. The array is used
 * in place and becomes part of the constructed object. It is not cloned.
 * If no data is provided, the constructed object will be empty, but still
 * valid.
 * @extends {jspb.Message}
 * @constructor
 */
proto.routeguide.Feature = function(opt_data) {
  jspb.Message.initialize(this, opt_data, 0, -1, null, null);
};
goog.inherits(proto.routeguide.Feature, jspb.Message);
if (goog.DEBUG && !COMPILED) {
  proto.routeguide.Feature.displayName = 'proto.routeguide.Feature';
}


if (jspb.Message.GENERATE_TO_OBJECT) {
/**
 * Creates an object representation of this proto suitable for use in Soy templates.
 * Field names that are reserved in JavaScript and will be renamed to pb_name.
 * To access a reserved field use, foo.pb_<name>, eg, foo.pb_default.
 * For the list of reserved names please see:
 *     com.google.apps.jspb.JsClassTemplate.JS_RESERVED_WORDS.
 * @param {boolean=} opt_includeInstance Whether to include the JSPB instance
 *     for transitional soy proto support: http://goto/soy-param-migration
 * @return {!Object}
 */
proto.routeguide.Feature.prototype.toObject = function(opt_includeInstance) {
  return proto.routeguide.Feature.toObject(opt_includeInstance, this);
};


/**
 * Static version of the {@see toObject} method.
 * @param {boolean|undefined} includeInstance Whether to include the JSPB
 *     instance for transitional soy proto support:
 *     http://goto/soy-param-migration
 * @param {!proto.routeguide.Feature} msg The msg instance to transform.
 * @return {!Object}
 */
proto.routeguide.Feature.toObject = function(includeInstance, msg) {
  var f, obj = {
    name: msg.getName(),
    location: (f = msg.getLocation()) && proto.routeguide.Point.toObject(includeInstance, f)
  };

  if (includeInstance) {
    obj.$jspbMessageInstance = msg;
  }
  return obj;
};
}


/**
 * Deserializes binary data (in protobuf wire format).
 * @param {jspb.ByteSource} bytes The bytes to deserialize.
 * @return {!proto.routeguide.Feature}
 */
proto.routeguide.Feature.deserializeBinary = function(bytes) {
  var reader = new jspb.BinaryReader(bytes);
  var msg = new proto.routeguide.Feature;
  return proto.routeguide.Feature.deserializeBinaryFromReader(msg, reader);
};


/**
 * Deserializes binary data (in protobuf wire format) from the
 * given reader into the given message object.
 * @param {!proto.routeguide.Feature} msg The message object to deserialize into.
 * @param {!jspb.BinaryReader} reader The BinaryReader to use.
 * @return {!proto.routeguide.Feature}
 */
proto.routeguide.Feature.deserializeBinaryFromReader = function(msg, reader) {
  while (reader.nextField()) {
    if (reader.isEndGroup()) {
      break;
    }
    var field = reader.getFieldNumber();
    switch (field) {
    case 1:
      var value = /** @type {string} */ (reader.readString());
      msg.setName(value);
      break;
    case 2:
      var value = new proto.routeguide.Point;
      reader.readMessage(value,proto.routeguide.Point.deserializeBinaryFromReader);
      msg.setLocation(value);
      break;
    default:
      reader.skipField();
      break;
    }
  }
  return msg;
};


/**
 * Class method variant: serializes the given message to binary data
 * (in protobuf wire format), writing to the given BinaryWriter.
 * @param {!proto.routeguide.Feature} message
 * @param {!jspb.BinaryWriter} writer
 */
proto.routeguide.Feature.serializeBinaryToWriter = function(message, writer) {
  message.serializeBinaryToWriter(writer);
};


/**
 * Serializes the message to binary data (in protobuf wire format).
 * @return {!Uint8Array}
 */
proto.routeguide.Feature.prototype.serializeBinary = function() {
  var writer = new jspb.BinaryWriter();
  this.serializeBinaryToWriter(writer);
  return writer.getResultBuffer();
};


/**
 * Serializes the message to binary data (in protobuf wire format),
 * writing to the given BinaryWriter.
 * @param {!jspb.BinaryWriter} writer
 */
proto.routeguide.Feature.prototype.serializeBinaryToWriter = function (writer) {
  var f = undefined;
  f = this.getName();
  if (f.length > 0) {
    writer.writeString(
      1,
      f
    );
  }
  f = this.getLocation();
  if (f != null) {
    writer.writeMessage(
      2,
      f,
      proto.routeguide.Point.serializeBinaryToWriter
    );
  }
};


/**
 * Creates a deep clone of this proto. No data is shared with the original.
 * @return {!proto.routeguide.Feature} The clone.
 */
proto.routeguide.Feature.prototype.cloneMessage = function() {
  return /** @type {!proto.routeguide.Feature} */ (jspb.Message.cloneMessage(this));
};


/**
 * optional string name = 1;
 * @return {string}
 */
proto.routeguide.Feature.prototype.getName = function() {
  return /** @type {string} */ (jspb.Message.getFieldProto3(this, 1, ""));
};


/** @param {string} value  */
proto.routeguide.Feature.prototype.setName = function(value) {
  jspb.Message.setField(this, 1, value);
};


/**
 * optional Point location = 2;
 * @return {proto.routeguide.Point}
 */
proto.routeguide.Feature.prototype.getLocation = function() {
  return /** @type{proto.routeguide.Point} */ (
    jspb.Message.getWrapperField(this, proto.routeguide.Point, 2));
};


/** @param {proto.routeguide.Point|undefined} value  */
proto.routeguide.Feature.prototype.setLocation = function(value) {
  jspb.Message.setWrapperField(this, 2, value);
};


proto.routeguide.Feature.prototype.clearLocation = function() {
  this.setLocation(undefined);
};



/**
 * Generated by JsPbCodeGenerator.
 * @param {Array=} opt_data Optional initial data array, typically from a
 * server response, or constructed directly in Javascript. The array is used
 * in place and becomes part of the constructed object. It is not cloned.
 * If no data is provided, the constructed object will be empty, but still
 * valid.
 * @extends {jspb.Message}
 * @constructor
 */
proto.routeguide.RouteNote = function(opt_data) {
  jspb.Message.initialize(this, opt_data, 0, -1, null, null);
};
goog.inherits(proto.routeguide.RouteNote, jspb.Message);
if (goog.DEBUG && !COMPILED) {
  proto.routeguide.RouteNote.displayName = 'proto.routeguide.RouteNote';
}


if (jspb.Message.GENERATE_TO_OBJECT) {
/**
 * Creates an object representation of this proto suitable for use in Soy templates.
 * Field names that are reserved in JavaScript and will be renamed to pb_name.
 * To access a reserved field use, foo.pb_<name>, eg, foo.pb_default.
 * For the list of reserved names please see:
 *     com.google.apps.jspb.JsClassTemplate.JS_RESERVED_WORDS.
 * @param {boolean=} opt_includeInstance Whether to include the JSPB instance
 *     for transitional soy proto support: http://goto/soy-param-migration
 * @return {!Object}
 */
proto.routeguide.RouteNote.prototype.toObject = function(opt_includeInstance) {
  return proto.routeguide.RouteNote.toObject(opt_includeInstance, this);
};


/**
 * Static version of the {@see toObject} method.
 * @param {boolean|undefined} includeInstance Whether to include the JSPB
 *     instance for transitional soy proto support:
 *     http://goto/soy-param-migration
 * @param {!proto.routeguide.RouteNote} msg The msg instance to transform.
 * @return {!Object}
 */
proto.routeguide.RouteNote.toObject = function(includeInstance, msg) {
  var f, obj = {
    location: (f = msg.getLocation()) && proto.routeguide.Point.toObject(includeInstance, f),
    message: msg.getMessage()
  };

  if (includeInstance) {
    obj.$jspbMessageInstance = msg;
  }
  return obj;
};
}


/**
 * Deserializes binary data (in protobuf wire format).
 * @param {jspb.ByteSource} bytes The bytes to deserialize.
 * @return {!proto.routeguide.RouteNote}
 */
proto.routeguide.RouteNote.deserializeBinary = function(bytes) {
  var reader = new jspb.BinaryReader(bytes);
  var msg = new proto.routeguide.RouteNote;
  return proto.routeguide.RouteNote.deserializeBinaryFromReader(msg, reader);
};


/**
 * Deserializes binary data (in protobuf wire format) from the
 * given reader into the given message object.
 * @param {!proto.routeguide.RouteNote} msg The message object to deserialize into.
 * @param {!jspb.BinaryReader} reader The BinaryReader to use.
 * @return {!proto.routeguide.RouteNote}
 */
proto.routeguide.RouteNote.deserializeBinaryFromReader = function(msg, reader) {
  while (reader.nextField()) {
    if (reader.isEndGroup()) {
      break;
    }
    var field = reader.getFieldNumber();
    switch (field) {
    case 1:
      var value = new proto.routeguide.Point;
      reader.readMessage(value,proto.routeguide.Point.deserializeBinaryFromReader);
      msg.setLocation(value);
      break;
    case 2:
      var value = /** @type {string} */ (reader.readString());
      msg.setMessage(value);
      break;
    default:
      reader.skipField();
      break;
    }
  }
  return msg;
};


/**
 * Class method variant: serializes the given message to binary data
 * (in protobuf wire format), writing to the given BinaryWriter.
 * @param {!proto.routeguide.RouteNote} message
 * @param {!jspb.BinaryWriter} writer
 */
proto.routeguide.RouteNote.serializeBinaryToWriter = function(message, writer) {
  message.serializeBinaryToWriter(writer);
};


/**
 * Serializes the message to binary data (in protobuf wire format).
 * @return {!Uint8Array}
 */
proto.routeguide.RouteNote.prototype.serializeBinary = function() {
  var writer = new jspb.BinaryWriter();
  this.serializeBinaryToWriter(writer);
  return writer.getResultBuffer();
};


/**
 * Serializes the message to binary data (in protobuf wire format),
 * writing to the given BinaryWriter.
 * @param {!jspb.BinaryWriter} writer
 */
proto.routeguide.RouteNote.prototype.serializeBinaryToWriter = function (writer) {
  var f = undefined;
  f = this.getLocation();
  if (f != null) {
    writer.writeMessage(
      1,
      f,
      proto.routeguide.Point.serializeBinaryToWriter
    );
  }
  f = this.getMessage();
  if (f.length > 0) {
    writer.writeString(
      2,
      f
    );
  }
};


/**
 * Creates a deep clone of this proto. No data is shared with the original.
 * @return {!proto.routeguide.RouteNote} The clone.
 */
proto.routeguide.RouteNote.prototype.cloneMessage = function() {
  return /** @type {!proto.routeguide.RouteNote} */ (jspb.Message.cloneMessage(this));
};


/**
 * optional Point location = 1;
 * @return {proto.routeguide.Point}
 */
proto.routeguide.RouteNote.prototype.getLocation = function() {
  return /** @type{proto.routeguide.Point} */ (
    jspb.Message.getWrapperField(this, proto.routeguide.Point, 1));
};


/** @param {proto.routeguide.Point|undefined} value  */
proto.routeguide.RouteNote.prototype.setLocation = function(value) {
  jspb.Message.setWrapperField(this, 1, value);
};


proto.routeguide.RouteNote.prototype.clearLocation = function() {
  this.setLocation(undefined);
};


/**
 * optional string message = 2;
 * @return {string}
 */
proto.routeguide.RouteNote.prototype.getMessage = function() {
  return /** @type {string} */ (jspb.Message.getFieldProto3(this, 2, ""));
};


/** @param {string} value  */
proto.routeguide.RouteNote.prototype.setMessage = function(value) {
  jspb.Message.setField(this, 2, value);
};



/**
 * Generated by JsPbCodeGenerator.
 * @param {Array=} opt_data Optional initial data array, typically from a
 * server response, or constructed directly in Javascript. The array is used
 * in place and becomes part of the constructed object. It is not cloned.
 * If no data is provided, the constructed object will be empty, but still
 * valid.
 * @extends {jspb.Message}
 * @constructor
 */
proto.routeguide.RouteSummary = function(opt_data) {
  jspb.Message.initialize(this, opt_data, 0, -1, null, null);
};
goog.inherits(proto.routeguide.RouteSummary, jspb.Message);
if (goog.DEBUG && !COMPILED) {
  proto.routeguide.RouteSummary.displayName = 'proto.routeguide.RouteSummary';
}


if (jspb.Message.GENERATE_TO_OBJECT) {
/**
 * Creates an object representation of this proto suitable for use in Soy templates.
 * Field names that are reserved in JavaScript and will be renamed to pb_name.
 * To access a reserved field use, foo.pb_<name>, eg, foo.pb_default.
 * For the list of reserved names please see:
 *     com.google.apps.jspb.JsClassTemplate.JS_RESERVED_WORDS.
 * @param {boolean=} opt_includeInstance Whether to include the JSPB instance
 *     for transitional soy proto support: http://goto/soy-param-migration
 * @return {!Object}
 */
proto.routeguide.RouteSummary.prototype.toObject = function(opt_includeInstance) {
  return proto.routeguide.RouteSummary.toObject(opt_includeInstance, this);
};


/**
 * Static version of the {@see toObject} method.
 * @param {boolean|undefined} includeInstance Whether to include the JSPB
 *     instance for transitional soy proto support:
 *     http://goto/soy-param-migration
 * @param {!proto.routeguide.RouteSummary} msg The msg instance to transform.
 * @return {!Object}
 */
proto.routeguide.RouteSummary.toObject = function(includeInstance, msg) {
  var f, obj = {
    pointCount: msg.getPointCount(),
    featureCount: msg.getFeatureCount(),
    distance: msg.getDistance(),
    elapsedTime: msg.getElapsedTime()
  };

  if (includeInstance) {
    obj.$jspbMessageInstance = msg;
  }
  return obj;
};
}


/**
 * Deserializes binary data (in protobuf wire format).
 * @param {jspb.ByteSource} bytes The bytes to deserialize.
 * @return {!proto.routeguide.RouteSummary}
 */
proto.routeguide.RouteSummary.deserializeBinary = function(bytes) {
  var reader = new jspb.BinaryReader(bytes);
  var msg = new proto.routeguide.RouteSummary;
  return proto.routeguide.RouteSummary.deserializeBinaryFromReader(msg, reader);
};


/**
 * Deserializes binary data (in protobuf wire format) from the
 * given reader into the given message object.
 * @param {!proto.routeguide.RouteSummary} msg The message object to deserialize into.
 * @param {!jspb.BinaryReader} reader The BinaryReader to use.
 * @return {!proto.routeguide.RouteSummary}
 */
proto.routeguide.RouteSummary.deserializeBinaryFromReader = function(msg, reader) {
  while (reader.nextField()) {
    if (reader.isEndGroup()) {
      break;
    }
    var field = reader.getFieldNumber();
    switch (field) {
    case 1:
      var value = /** @type {number} */ (reader.readInt32());
      msg.setPointCount(value);
      break;
    case 2:
      var value = /** @type {number} */ (reader.readInt32());
      msg.setFeatureCount(value);
      break;
    case 3:
      var value = /** @type {number} */ (reader.readInt32());
      msg.setDistance(value);
      break;
    case 4:
      var value = /** @type {number} */ (reader.readInt32());
      msg.setElapsedTime(value);
      break;
    default:
      reader.skipField();
      break;
    }
  }
  return msg;
};


/**
 * Class method variant: serializes the given message to binary data
 * (in protobuf wire format), writing to the given BinaryWriter.
 * @param {!proto.routeguide.RouteSummary} message
 * @param {!jspb.BinaryWriter} writer
 */
proto.routeguide.RouteSummary.serializeBinaryToWriter = function(message, writer) {
  message.serializeBinaryToWriter(writer);
};


/**
 * Serializes the message to binary data (in protobuf wire format).
 * @return {!Uint8Array}
 */
proto.routeguide.RouteSummary.prototype.serializeBinary = function() {
  var writer = new jspb.BinaryWriter();
  this.serializeBinaryToWriter(writer);
  return writer.getResultBuffer();
};


/**
 * Serializes the message to binary data (in protobuf wire format),
 * writing to the given BinaryWriter.
 * @param {!jspb.BinaryWriter} writer
 */
proto.routeguide.RouteSummary.prototype.serializeBinaryToWriter = function (writer) {
  var f = undefined;
  f = this.getPointCount();
  if (f !== 0) {
    writer.writeInt32(
      1,
      f
    );
  }
  f = this.getFeatureCount();
  if (f !== 0) {
    writer.writeInt32(
      2,
      f
    );
  }
  f = this.getDistance();
  if (f !== 0) {
    writer.writeInt32(
      3,
      f
    );
  }
  f = this.getElapsedTime();
  if (f !== 0) {
    writer.writeInt32(
      4,
      f
    );
  }
};


/**
 * Creates a deep clone of this proto. No data is shared with the original.
 * @return {!proto.routeguide.RouteSummary} The clone.
 */
proto.routeguide.RouteSummary.prototype.cloneMessage = function() {
  return /** @type {!proto.routeguide.RouteSummary} */ (jspb.Message.cloneMessage(this));
};


/**
 * optional int32 point_count = 1;
 * @return {number}
 */
proto.routeguide.RouteSummary.prototype.getPointCount = function() {
  return /** @type {number} */ (jspb.Message.getFieldProto3(this, 1, 0));
};


/** @param {number} value  */
proto.routeguide.RouteSummary.prototype.setPointCount = function(value) {
  jspb.Message.setField(this, 1, value);
};


/**
 * optional int32 feature_count = 2;
 * @return {number}
 */
proto.routeguide.RouteSummary.prototype.getFeatureCount = function() {
  return /** @type {number} */ (jspb.Message.getFieldProto3(this, 2, 0));
};


/** @param {number} value  */
proto.routeguide.RouteSummary.prototype.setFeatureCount = function(value) {
  jspb.Message.setField(this, 2, value);
};


/**
 * optional int32 distance = 3;
 * @return {number}
 */
proto.routeguide.RouteSummary.prototype.getDistance = function() {
  return /** @type {number} */ (jspb.Message.getFieldProto3(this, 3, 0));
};


/** @param {number} value  */
proto.routeguide.RouteSummary.prototype.setDistance = function(value) {
  jspb.Message.setField(this, 3, value);
};


/**
 * optional int32 elapsed_time = 4;
 * @return {number}
 */
proto.routeguide.RouteSummary.prototype.getElapsedTime = function() {
  return /** @type {number} */ (jspb.Message.getFieldProto3(this, 4, 0));
};


/** @param {number} value  */
proto.routeguide.RouteSummary.prototype.setElapsedTime = function(value) {
  jspb.Message.setField(this, 4, value);
};


goog.object.extend(exports, proto.routeguide);
