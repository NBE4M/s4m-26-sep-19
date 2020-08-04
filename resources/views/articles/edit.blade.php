@extends('layouts/master')

@section('title', 'Edit Article - S4MCMS')
@section('content')
 <style> .none { display:none; } </style>
<div class="panel retracted">
    <div class="panel-content filler">
        <div class="panel-logo"></div>
        <div class="panel-header">
            <h1><small>Edit Article</small></h1>

        </div>

        <div class="panel-header">
            <!--<h1><small>Page Navigation Shortcuts</small></h1>-->
        </div>

        <script>
            $(document).ready(function(){
                     $('#draftSubmit').click(function(){
                         if ($('#imagetitle').val()=='') {
                                            alert('please fill Photo title');
                                            $('#imagetitle').focus()
                                            return false;
                                        }
                        $("#validation_form").validate().cancelSubmit = true;
                      });
                       $('#dumpSubmit').click(function(){
                        $("#validation_form").validate().cancelSubmit = true;
                      });
             
                    $('#saveSubmit').click(doClick);
                    $('#pageSubmit').click(doClick);
                    $('#publishSubmit').click(doClick);
                    $('#saveSchedule').click(doClick);
                    $('#scheduleSubmit').click(doClick);
                    //$('#dumpSubmit').click(doClick);
                    //$('#pageSubmit','#dumpSubmit','#publishSubmit').click(function() {}

                            function doClickSchedule(){
                            $("#validation_form").validate({
                            errorElement: "span",
                                    errorClass: "error",
                                    //$("#pageSubmit").onclick: true,
                                    onclick: true,
                                    rules: {
                                    "req1": {
                                    required: true,
                                            date: true
                                    },
                                            "date": {
                                            date: true
                                            },
                                            "time": {
                                            time: true
                                            }
                                    }
                            });
                            }
//                    
                              function doClick(){ 
                                
                                        var checkvalid=1;
                                      if(!this.form.checkbox.checked)
                                            {
                                            $('#pmsg').show();
                                            return false;
                                            }
                                        if ($('#imagetitle').val()=='') {
                                            alert('please fill Photo title');
                                            $('#imagetitle').focus()
                                            return false;
                                        }
                                        if ($('#slug_url').val()=='') {
                                            alert('please fill slug');
                                            $('#imagetitle').focus()
                                            return false;
                                        }
                                         var taglist = $('#Taglist').val();
                                        if(taglist=='') {
                                           alert('plaese select Tags');
                                           $('#Taglist').focus();
                                                return false;
                                            }
                                        //alert(1);
                                    //$('.btn-success').click(function() {}
                                    var as = CKEDITOR.instances.maxi.getData();
                                   $('.error.elrte-error').remove();
                                   $('.error.author-error').remove();
                                   $('.error.noborder').remove();
                                    if(as.length==0){
                                       // alert(1);
                                        $('.elrte-wrapper').after('<span class="error elrte-error" style="display:block;" >Article description is required. </span>');
                                        checkvalid=0;
                                    }                                    
                                    if (($('#simpleSelectAuthor').val() != '') && ($('#simpleSelectAuthor').val() != '1') && $('#author').val() == '') {
                                            //alert('Please Select Author Name');
                                            $('#author').after('<span class="error author-error">Author name is required.</span>');
                                            $('#author').siblings('ul').addClass('error');
                                           checkvalid=0;
                                    }                                   
                                     $("#validation_form").validate({
                                    errorElement: "span",
                                            errorClass: "error",
                                            //$("#pageSubmit").onclick: true,
                                            onclick: true,
                                            invalidHandler: function(event, validator) {
                         
                                                    for (var i in validator.errorMap) { ///alert(i);

                                                            if($('#'+i).hasClass('formattedelement')){
                                                                $('#'+i).siblings('.formattedelement').addClass('error');

                                                        }

                                                }
                                             },
                                            rules: {
                                            "req": {
                                            required: true
                                            },
                                                    "category1": {
                                                    required: true
                                                    },
                                                    "channel_sel":{
                                                    required: true
                                                    },
                                                    "authortype":{
                                                    required: true
                                                    },
                                                    "title":{
                                                    required: true,
                                                    rangelength: [10, 90]
                                                    },
                                                    "summary":{
                                                    required: true,
                                                    rangelength: [50, 200]
                                                    },
                                                     "description":{
                                                    required: true,
                                                    },
                                                    
                                                     
                                                   
                                                 
                                            }
                                    });
                                    
                                    
                                            if(!$("#validation_form").valid())
                                                checkvalid=0;
                                            if(checkvalid==0){
                                                $('#submitsection').prepend('<div class="error noborder">An error has occured. Please check the above form.</div>');
                                                return false;
                                            }   
                                           // else
                                                // $("#fileupload").submit();

                                    }
                    });</script>

        <script type="text/javascript">
                    $(function () {
                    $("#jstree").jstree({
                    "json_data" : {
                    "data" : [
                    {
                    "data" : {
                    "title" : "Author Detail",
                            "attr" : { "href" : "#Author-Detail" }
                    }
                    },
                    {
                    "data" : {
                    "title" : "Channel",
                            "attr" : { "href" : "#Channel" }
                    }
                    },
                    {
                    "data" : {
                    "title" : "Article-Details",
                            "attr" : { "href" : "#Article-Details" }
                    }
                    },
                    {
                            "data" : {
                            "title" : "Social Details",
                                    "attr" : { "href" : "#social-media-detail" }
                            }
                    },
                    {
                            "data" : {
                            "title" : "Meta Details",
                                    "attr" : { "href" : "#meta-detail" }
                            }
                    },
                    {
                    "data" : {
                    "title" : "Topics And Location",
                            "attr" : { "href" : "#topics-location" }
                    }
                    },
                    {
                    "data" : {
                    "title" : "Categories",
                            "attr" : { "href" : "#categories" }
                    }
                    },
                    {
                    "data" : {
                    "title" : "Tags",
                            "attr" : { "href" : "#tags" }
                    }
                    },
                    {
                    "data" : {
                    "title" : "Photos And Videos",
                            "attr" : { "href" : "#photos-videos" }
                    }
                    },
 @if(in_array('12',Session::get('user_rights')) && $article->status!='P' )
                            {
                            "data" : {
                            "title" : "Schedule for Upload",
                                    "attr" : { "href" : "#schedule-for-upload" }
                            }
                            },
@endif


                    ]
                    },
                            "plugins" : [ "themes", "json_data", "ui" ]
                    })
                            .bind("click.jstree", function (event) {
                            var node = $(event.target).closest("li");
                                    document.location.href = node.find('a').attr("href");
                                    return false;
                            })
                            .delegate("a", "click", function (event, data) { event.preventDefault(); });
                    });</script>
        <div class="sidebarMenuHolder">
            <div class="JStree">
                <div class="Jstree_shadow_top"></div>
                <div id="jstree"></div>
                <div class="Jstree_shadow_bottom"></div>
            </div>
        </div>
    </div>
    <div class="panel-slider">
        <div class="panel-slider-center">
            <div class="panel-slider-arrow"></div>
        </div>
    </div>
</div>
<div class="main-content retracted">
    <div class="breadcrumb-container">
        <ul class="xbreadcrumbs">
            <li>
                <a href="dashboard.html">
                    <i class="icon-photon home"></i>
                </a>
            </li>
            <li>
                <a href="#">Articles</a>
                <ul class="breadcrumb-sub-nav">
                    <li>
                        <a href="new-articles.html">New Article</a>
                    </li>
                    <li>
                        <a href="scheduled-articles.html">Scheduled Articles</a>
                    </li>
                    <li>
                        <a href="published-articles.html">Published Article</a>
                    </li>
                    <li>
                        <a href="saved-articles.html">Saved Articles</a>
                    </li>
                    <li>
                        <a href="feature-box-management.html">Feature Box Management</a>
                    </li>
                    <li>
                        <a href="campaign-managemnet.html">Campaign Managemnet</a>
                    </li>
                    <li>
                        <a href="#">Tips</a>
                    </li>
                    <li>
                        <a href="#">Reports</a>
                    </li>
                    <li>
                        <a href="#">Help</a>
                    </li>
                </ul>
            </li>
            <li class="current">
                <a href="javascript:;">Edit Article</a>
            </li>
        </ul>
    </div>            <header>
        <i class="icon-big-notepad"></i>
        <h2><small>Article: {{ $article->article_id }}</small></h2>
        <h3><small>{{ $userTup->name }}</small></h3>
    </header>
    {!! Form::open(array('url'=>'article/update/','class'=> 'form-horizontal','id'=>'validation_form')) !!}
    {!! csrf_field() !!}
    <div class="container-fluid" id="notificationdiv"  @if((!Session::has('message')) && (!Session::has('error')))style="display: none" @endif >

             <div class="form-legend" id="Notifications">Notifications</div>

            <!--Notifications begin-->
            <div class="control-group row-fluid" >
                <div class="span12 span-inset">
                    @if (Session::has('message'))
                    <div class="alert alert-success alert-block" style="">
                        <i class="icon-alert icon-alert-info"></i>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>This is Success Notification</strong>
                        <span>{{ Session::get('message') }}</span>
                    </div>
                    @endif

                    @if (Session::has('error'))
                    <div class="alert alert-error alert-block">
                        <i class="icon-alert icon-alert-info"></i>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>This is Error Notification</strong>
                        <span>{{ Session::get('error') }}</span>
                    </div>
                    @endif
                </div>
            </div>
            <!--Notifications end-->

        </div>
    <input type="hidden" name="id" value="{{$article->article_id}}">
    <div class="container-fluid">
        <div class="form-legend" id="Author-Detail">Author Detail

        </div>
        <div id="Simple_Select_Box" class="control-group row-fluid">
            <div class="span2">
                <label class="control-label" for="simpleSelectBox">Post As</label>
            </div>
            <div class="span10">
                <div class="controls">
                    <select style="display: none;" name="authortype" id="simpleSelectAuthor" class="form-control formattedelement">
                        <option value="">Please Select</option>
                        @foreach($postAs as $postas1)
                        @if($postas1->author_type_id == $article->author_type)
                        <option selected value="{{ $postas1->author_type_id }}">{{ $postas1->label }}</option>
                        @else
                        <option value="{{ $postas1->author_type_id }}">{{ $postas1->label }}</option>
                        @endif
                        @endforeach
                    </select>
                    <input type="hidden" name="url" value="{{$article->url}}">
                </div>
            </div>
            <script>
                        $().ready(function(){
                $("#simpleSelectAuthor").select2({
                dropdownCssClass: 'noSearch'
                });
                });</script>
        </div>


        <div class="bs-docs-example" id="tabarea">
            <ul class="nav nav-tabs" id="iconsTab">
                <li class="active"><a data-toggle="tab" href="#existing">Choose From Existing</a></li>
                <!-- Add Author Section Only if Rights -->
              
                {{-- @if(count(array_diff(array('9','44','45'), Session::get('user_rights'))) != count(array('9','44','45')))
                <li class=""><a data-toggle="tab" href="#new">Add A New Author</a></li>
                @endif
                --}}
            </ul>
            <div class="tab-content">
                <div id="existing" class="tab-pane fade  active in">

                    <div id="Simple_Select_Box" class="control-group row-fluid">
                        <div class="span2">
                            <label class="control-label" for="simpleSelectBox">Author Name</label>
                        </div>
                        <div class="span10">

                            <div class="controls">
                                <input type="text" class="valid" name="author" id="author"/>
                            </div>
                            <script>
   
                                   $().ready(function() {
                                        $("#author").tokenInput(function(){
                                              return "{{url('api/article/authordd')}}?option="+$("#simpleSelectAuthor").val(); 
                                        },
                                            {
                                                theme: "facebook",
                                                searchDelay: 300,
                                                minChars: 3,
                                                preventDuplicates: true,
                                                tokenLimit:3,
                                                 prePopulate: <?php echo $authors ?>,
                                        });
                                   });                            
                            </script>


                        </div>
                        
                    
                    </div>

    

                    <script type="text/javascript">

                                $(document).ready(function(){
                                    
                        $("#simpleSelectAuthor").change(function(){
                        $(this).find("option:selected").each(function(){
                            //return false
                        if ($(this).attr("value") == "1"){
                            
                        $("#tabarea").hide();
                        }else{
                             $("#tabarea").show();
                        }
                        
                         if ($(this).attr("value") == "6"){
                                       $('#event_top_div').show();
                                       $('#event_bottom_div').hide();
                                       
                                }
                                else{
                                    $('#event_top_div').hide();
                                    $('#event_bottom_div').show();
                                }
                                
                        });
                        }).change();
                        
                        
                         $("#simpleSelectAuthor").change(function(){
                             if ($(this).attr("value") != "1"){
                               $("#author").tokenInput("clear"); 
                           }
                          }); 
                                
                        });</script>

                </div>

                <div id="new" class="tab-pane fade entypo ">
                    <!--<form name="addAuthorForm" method="post" enctype="multipart/form-data" id="addAuthorForm">-->
                    <div class="control-group row-fluid">
                        <div class="span2">
                            <label class="control-label" >&nbsp;</label>
                        </div>
                        <div class="span2">
                            <label class="radio">
                                <input type="radio" id="author_type" name="author_type" class="uniformRadio" value="4">
                                Columnist
                            </label>
                        </div>
                        <div class="span2">
                            <label class="radio">
                                <input  type="radio" id="author_type"  name="author_type" class="uniformRadio" value="3">
                                Guest Author
                            </label>
                        </div>
                        <div class="span2">
                            <label class="radio">
                                <input  type="radio" id="author_type" name="author_type" class="uniformRadio" value="2" checked>
                                BW Reporter
                            </label>
                        </div>

                        <script>
                                    $().ready(function(){
                            $(".uniformRadio").uniform({
                            radioClass: 'uniformRadio'
                            });
                            });</script>

                    </div>

                    <div class="control-group row-fluid">
                        <div class="span2">
                            <label class="control-label" for="inputField">Name</label>
                        </div>
                        <div class="span10">
                            <div class="controls">
                                <input id="inputField" id="name" name="Name" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="control-group row-fluid">
                        <div class="span2">
                            <label class="control-label" for="inputField">Bio</label>
                        </div>
                        <div class="span10">
                            <div class="controls">
                                <textarea  rows="3" id="Bio" class="" name="Bio"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="control-group row-fluid">
                        <div class="span2">
                            <label class="control-label" for="inputField">Email</label>
                        </div>
                        <div class="span10">
                            <div class="controls">
                                <input id="inputField" name="email" type="email">
                            </div>
                        </div>
                    </div>
                    <div class="control-group row-fluid">
                        <div class="span2">
                            <label class="control-label" for="inputField">Mobile</label>
                        </div>
                        <div class="span10">
                            <div class="controls">
                                <input id="inputField" name="mobile" type="number">
                            </div>
                        </div>
                    </div>
                    <div id="File_Upload" class="control-group row-fluid">
                        <div class="span2">
                            <label class="control-label">Photo</label>
                        </div>
                        <div class="span10">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="input-append">
                                    <div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div><span class="btn btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span><input type="file" name="photo" id="photo"></span><a href="javascript:;" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="control-group row-fluid">
                        <div class="span2">
                            <label class="control-label" for="inputField">Twitter</label>
                        </div>
                        <div class="span10">
                            <div class="controls">
                                <input id="inputField" name="twitter" type="text">
                            </div>
                        </div>
                    </div>

                    <div  class="control-group row-fluid" id="ch-reporter">
                        <div class="span2">
                            <label class="control-label" for="selectBoxFilter">Choose Column</label>
                        </div>
                        <div class="span10">
                            <div class="controls">
                                <select name="column_id" id="selectBoxFilter221">
                                    <option value="" >Please Select</option>
                                   
                                </select>
                            </div>
                        </div>
                        <script>
                                    $().ready(function(){
                            $("#selectBoxFilter221").select2();
                            });</script>
                    </div>

                    <div class="control-group row-fluid">
                        <div class="span12 span-inset">
                            <button class="btn btn-warning pull-right" id="addabut" type="button" style="display:block;">Add</button>
                        </div>
                    </div>
                    <!--</form>-->
                </div>
            </div>
        </div>
    </div><!-- end container1 -->

    <div class="container-fluid">
        <div class="form-legend" id="Article-Details">Article Details

        </div>
        <!--Text Area - No Resize begin-->
        <div  class="control-group row-fluid">
            <div class="span2">
                <label class="control-label" for="title">Title (90 Characters)</label>
            </div>
            <div class="span10">
                <div class="controls">
                    <textarea  name="title" id="artititle" rows="4" class="no-resize required title_range valid">{{$article->title}}</textarea>
                    <span for="title" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                </div>
            </div>
        </div>
        <!--Text Area - No Resize end-->

        <!--Text Area Resizable begin-->
        <div id="Text_Area_Resizable" class="control-group row-fluid">
            <div class="span2">
                <label class="control-label">Summary (200 Characters)</label>
            </div>
            <div class="span10">
                <div class="controls">
                    <textarea  name="summary" rows="4" class="" id="summary">{{$article->summary}}</textarea>
                </div>
            </div>
        </div>
        <!--Text Area Resizable end-->

        <!--WYSIWYG Editor - Full Options-->
        <div id="WYSIWYG_Editor_-_Full_Options" class="control-group row-fluid">
            <div class="span2">
                <label class="control-label" for="description">Description</label>
            </div>
            <div class="span10">
                <div class="controls elrte-wrapper">
                    <textarea name="description" id="maxi" rows="2" class="auto-resize required valid">{{$article->description}}</textarea>
                    <span for="description" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                   <!--  <script>
                     elRTE.prototype.options.panels.web2pyPanel = [
                            'pastetext','bold', 'italic','underline','justifyleft', 'justifyright',
                           'justifycenter', 'justifyfull','forecolor','hilitecolor','fontsize','link',
                           'image', 'insertorderedlist', 'insertunorderedlist'];
                        elRTE.prototype.options.denyTags = ['div'];
                        elRTE.prototype.options.toolbars.web2pyToolbar = ['web2pyPanel','tables'];
                                $('#maxi').elrte({
                        lang: "en",
                                styleWithCSS: false,
                                height: 200,
                                toolbar: 'web2pyToolbar'
                        });
                                            
                      $(document).ready(function() { 
                                      @if($article->canonical_options==0)  
                                      $("#canonical").addClass("none");
                                      @endif
                                    $(':radio[id=ifno]').change(function() {
                                        $("#canonical").addClass("none");
                                    });
                                    $(':radio[id=ifyes]').change(function() {
                                        $("#canonical").removeClass("none");
                                        
                                    });
                                 });  
                    </script> -->
                    <script type="text/javascript"> 
                    var editor = CKEDITOR.replace('maxi');
                    </script>  
                </div>
            </div>
        </div>

        <!--WYSIWYG Editor - Full Options end-->

    </div><!-- end container1 -->
   <!-- Create English Url -->
        <div class="container-fluid">
      <div class="form-legend" id="meta-detail">Meta Detail</div>
      <div  class="control-group row-fluid">
            <div class="span2">
                <label class="control-label " for="title">Url</label>
            </div>
            <div class="span10">
                @if($article->status == 'P')
                <div class="controls">
                    <input type="text" class="reqired" id="slug_url" value="{{$article->url}}" name="url"  readonly="true">
                    <input type="hidden"  value="{{ old('cat_name') }}" name="cat_name" id="cat_name">
                </div>    
                @else
                <div class="controls">
                    <input type="text" class="reqired" id="slug_url" value="{{$article->url}}" name="url"  >
                    <input type="hidden"  value="{{ old('cat_name') }}" name="cat_name" id="cat_name">
                </div>
                @endif    
                
            </div>
        </div>
      <!--Text Area - No Resize begin--> 
    </div>
    <!-- End Create Url -->
  


    <div class="container-fluid">

        <div class="form-legend" id="categories">Categories</div>

        <!--Select Box with Filter Search begin-->
        <div  class="control-group row-fluid">
            <div class="span2">
                <label class="control-label" for="selectBoxFilter">Categories</label>
            </div>
            <div class="span10">
                <div class="controls">
                    <select name="category1" readonly id="selectBoxFilter2" class="formattedelement">
                        @foreach($category as $key )
                        @if($article->category_id == $key->category_id)
                        <option selected value="{{ $key->category_id }}">{{ $key->name }}</option>
                        @else
                         <option value="{{ $key->category_id }}">{{ $key->name }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <script>
                        $(document).ready(function(){
                $("#selectBoxFilter2").select2();
                        $('#selectBoxFilter2').change(function(){
                $.get("{{ url('article/dropdown1')}}",
                { option: $(this).attr("value") + '&level=_two' },
                        function(data) {
                        var selectBoxFilter3 = $('#selectBoxFilter3');
                                selectBoxFilter3.empty();
                                selectBoxFilter3.append("<option selected='' value=''>Please Select</option>");
                                $.each(data, function(index, element) {
                                selectBoxFilter3.append("<option value='" + element + "'>" + index + "</option>");
                                });
                                $("#selectBoxFilter3").select2();
                                $('#selectBoxFilter4').html("<option value=''>Please Select</option>");
                                $('#selectBoxFilter4').select2();
                                $('#selectBoxFilter5').html("<option value=''>Please Select</option>");
                                $('#selectBoxFilter5').select2();
                        });
                        if($(this).attr("value")=='{{config('constants.ee_rating_cateogy_id')}}'){
                            $('#start_rating_div').show();
                        }else{
                            $('#start_rating_div').hide();
                        }
                });
                });</script>
        </div>
        
        <!--Select Box with Filter Search end-->

    </div>

     <div class="container-fluid">

        <div class="form-legend" id="categories">Gallery Album</div>

        <!--Select Box with Filter Search begin-->
        <div  class="control-group row-fluid">
            <div class="span2">
                <label class="control-label" for="selectBoxFilter">Album</label>
            </div>
            <div class="span10">
                <div class="controls">
                    <select name="albumid" id="albumid" class="formattedelement">
                        <option  value="">Please Select</option>
                        @foreach($album as $key )
                        @if($article->album_id == $key->id)
                        <option selected value="{{ $key->id }}">{{ $key->title }}</option>
                        @else
                         <option value="{{ $key->id }}">{{ $key->title }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
             <script>
                                $(document).ready(function(){
                        $("#albumid").select2();
                                $('#albumid').change(function(){
                        $.get("{{ url('article/dropdown1')}}",
                        { option: $(this).attr("value") + '&level=_two' },
                                function(data) {
                                var selectBoxFilter3 = $('#selectBoxFilter3');
                                        selectBoxFilter3.empty();
                                        selectBoxFilter3.append("<option value=''>Please Select</option>");
                                        $.each(data, function(index, element) {
                                        selectBoxFilter3.append("<option value='" + element + "'>" + index + "</option>");
                                        });
                                        $("#selectBoxFilter3").select2();
                                        $('#selectBoxFilter4').html("<option value=''>Please Select</option>");
                                        $('#selectBoxFilter4').select2();
                                        $('#selectBoxFilter5').html("<option value=''>Please Select</option>");
                                        $('#selectBoxFilter5').select2();
                                });
                                if ($(this).attr("value") == '{{config('constants.ee_rating_cateogy_id')}}'){
                        $('#start_rating_div').show();
                        } else{
                        $('#start_rating_div').hide();
                        }
                        });
                        });</script>
        </div>
    </div>

    <div class="container-fluid">

        <div class="form-legend" id="tags">Tags</div>
        <!--Select Box with Filter Search begin-->

        <div  class="control-group row-fluid" id="Multiple_Select_Box_with_Filter_Search">
            <div class="control-group row-fluid">
                <div class="span2">
                    <label for="multiFilter" class="control-label">Tags</label>
                </div>
                <div class="span10">
                    <div class="controls">
                        <input type="text" class="valid" name="Taglist" id="Taglist"/>
                    </div>
                </div>
            </div>
            <div class="control-group row-fluid">
                <div class="span2">
                    <label class="control-label" for="add tags">Add New Tags<br>(Separated by Coma. No spaces)</label>
                </div>
                <div class="span10">
                    <div class="controls">
                        <input type="text" name="addtags" class="valid"><span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                    </div>
                </div>
                <div class="span12 span-inset">

                    <div style="float:right; width:11%; margin-bottom:5px;"><button type="button" class="btn btn-primary" id="attachTag" style="display:block;">Attach</button>
                        <img src="{{ asset('images/photon/preloader/76.gif') }}" alt="loader" style="width:50%; display:block; margin-left:15px;display:none;"></div>
                </div>
            </div>
            <!-- Add Tag to Tags Table - Ajax request -->
            <script>
                        $().ready(function() {
                var token = $('input[name=_token]');
                        // process the form
                $("#attachTag").click(function(){
                if ($('input[name=addtags]').val().trim().length == 0){
                alert('Please enter tage'); return false;
                }
                //alert(token.val());
                // process the form
                $.ajax({
                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                        url         : '/article/addTag', // the url where we want to POST
                        data        :   { tag : $('input[name=addtags]').val() },
                        dataType    : 'json', // what type of data do we expect back from the server
                        encode      : true,
                        beforeSend  :function(data){
                        $('#attachTag').hide();
                                $('#attachTag').siblings('img').show();
                        },
                        complete    :function(data){
                        $('#attachTag').show();
                                $('#attachTag').siblings('img').hide();
                        },
                        success     :  function(data){
                        $.each(data, function(key, val){

                        $("#Taglist").tokenInput("add", val);
                        });
                                $('input[name=addtags]').val('');
                                // alert('Tag Saved');
                        },
                        headers: {
                        'X-CSRF-TOKEN': token.val()
                        }
                })

                });
                        $("#Taglist").tokenInput("/tags/get/Json", {
                          theme: "facebook",
                        searchDelay: 300,
                        minChars: 4,
                        preventDuplicates: true,
                        prePopulate: <?php echo $tags ?>,
                });
                });</script>
        </div>
        <!--Select Box with Filter Search end-->
    </div>





    <div class="container-fluid">

        <div class="form-legend" id="photos-videos">Photos</div>

        <!--Tabs begin-->
        <div  class="control-group row-fluid span-inset">
            <ul class="nav nav-tabs" id="myTab">
                <li class="dropdown active"><a data-toggle="tab" href="#dropdown1">Photo</a></li>
            </ul>
            <div class="tab-content">
                
                <div id="dropdown1" class="tab-pane fade active in">
                    
                    <div class="related_image " >
                        <div>
                            Browse recent related images : <input type="text" name="related_image_search" id="related_image_search" />
                            <button class="btn btn-success" onclick="searchRelated()" id="related_image_button"  name="status" type="button" style="margin-bottom:0px !important;">Search</button>
                            
                        </div>
                        <div class="relaed_image_box_outer hide" >
                            <img src="{{ asset('images/photon/preloader/76.gif')}}" class="loader-img-related-content hide" alt="loader" />
                            <div class="relaed_image_box">

                            </div>
                            <div class="related-img-selection-done"  >
                                <button class="btn btn-success hide related_action_button" onclick="relatedImageSelected()" id="related_selected_button" name="related_selected" type="button" >Upload</button>
                                <button class="btn btn-danger delete related_action_button" onclick="closeRelated()" type="button"><i class="glyphicon glyphicon-trash"></i><span>Close</span>
                                    </button>
                                <img src="{{ asset('images/photon/preloader/76.gif')}}" class="loader-img-selected hide" alt="loader" />
                            </div>
                        </div>
                    </div>
                    <!--Sortable Responsive Media Table begin-->
                        <div class="row-fluid">
                            <div class="span12">
                                @if(count($photos)>0)
                                <table class="table table-striped table-responsive uploaded-image-list" id="tableSortableResMed">
                                    <thead class="cf sorthead">
                                        <tr>
                                            <th>Image</th>
                                            <th>Title / Photo By </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($photos as $photo)
                                         <input type="hidden" id="uploadedimg" name="uploadedimg" value="{{$photo->photopath}}" />
                                         <input type="hidden" id="uploadedtitle" name="uploadedtitle" value="{{$photo->title}}" />
                                        <tr id="row_{{$photo->photo_id}}" title="{{$photo->photopath}}">
                                            <td>
                                                <img width="150px" src="{{ config('constants.storagepath').$photo->photopath}}" alt="article" />
                                            </td>
                                            <td>{{$photo->title}}  /  {{$photo->photo_by}} </td>
<!--                                            <td>{{ $photo->title }}</td>-->
                                    <input type="hidden" name="deleteImagel" id="{{ $photo->photo_id }}">
<!--                                    <td class="center">{{ $photo->source }}</td>
                                    <td class="center">{{ $photo->source_url }}</td>-->
                                    <td class="center"><button type="button" onclick="$(this).MessageBox({{ $photo->photo_id }})" name="{{ $photo->photo_id }}" id="deleteImage" class="btn btn-mini btn-danger">Dump</button>
                                        <button type="button" onclick="editImageDetail({{ $photo->photo_id }},'article')" name="image{{ $photo->photo_id }}" id="deleteImage" class="btn btn-mini btn-edit">Edit</button>
                                        <img  src="{{ asset('images/photon/preloader/76.gif') }}" alt="loader" style="width:20%; display:block; margin-left:15px;display:none;"/></td>
                                    </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                @endif
                            </div>
                        </div>
                        <!--Sortable Responsive Media Table end-->
                           <div class="control-group row-fluid">
                        <div class="span2">
                            <label class="control-label" for="inputField">
                                Upload Photos<a href="javascript:;" class="bootstrap-tooltip" data-placement="top" data-original-title="Here You can add multiple photos by Drag and Drop or Simply By clicking and selecting  photos (Size: {{config('constants.dimension_article')}}) (File Size <= {{config('constants.maxfilesize').' '.config('constants.filesizein')}}  )."><i class="icon-photon info-circle"></i></a>
                            </label>
                        </div>
                        <div class="span9 row-fluid" >
                            <div class=" fileupload-buttonbar">
                                <div class="col-lg-7">
                                    <!-- The fileinput-button span is used to style the file input field as button -->
                                    <span class="btn btn-success fileinput-button">
                                        <i class="glyphicon glyphicon-plus"></i>
                                        <span>Add files...</span>
                                        <input type="file" name="files" id="articleimage" />
                                    </span>
                                    <button type="submit" class="btn btn-primary start">
                                        <i class="glyphicon glyphicon-upload"></i>
                                        <span>Start upload</span>
                                    </button>
                                    <button type="reset" class="btn btn-warning cancel">
                                        <i class="glyphicon glyphicon-ban-circle"></i>
                                        <span>Cancel upload</span>
                                    </button>
                                    <button type="button" class="btn btn-danger delete">
                                        <i class="glyphicon glyphicon-trash"></i>
                                        <span>Delete</span>
                                    </button>
                                    <input type="checkbox" class="toggle">
                                     <div style="float:right;">       
                                        <a href="javascript:void(0);" style="font-size:12px;" onClick="cropImage('{{url('/photo/crop')}}?dimension={{config('constants.dimension_article')}}')">Need to crop images? Click here</a>
                                        <br>
                                        <a href="javascript:void(0);" style="font-size:12px;" onClick="cropImage('{{url('/photo/resize/crop')}}?dimension={{config('constants.dimension_article')}}')">Need to resize images? Click here</a>
                                    </div>
                                    <!-- The global file processing state -->
                                    <span class="fileupload-process"></span>
                                </div>
                                <!-- The global progress state -->
                                <div class="col-lg-5 fileupload-progress fade">
                                    <!-- The global progress bar -->
                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                    </div>
                                    <!-- The extended global progress state -->
                                    <div class="progress-extended">&nbsp;</div>
                                </div>
                            </div>
                            <!-- The table listing the files available for upload/download -->
                            <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                        </div>

                    </div>
                </div>
             

                
            </div>
            <label class="checkbox" >
                               <input type="checkbox" name="hide_image" @if($article->hide_image) checked="checked" @endif class="uniformCheckbox2" value="1">
                                      <a href="javascript:;">Do Not Show Images On Landing Page</a>
                  </label>
        </div>
        <!-- Uploaded Image and Video Ids -->
        <input type="hidden" id="uploadedImages" name="uploadedImages" />
    </div><!--end container-->
    <script>
                // magic.js
                $.fn.MessageBox = function (msg)
                {
                var formData = new FormData();
                        formData.append('photoId', msg);
                        var token = $('input[name=_token]');
                        var rowID = 'row_' + msg;
                        var div = document.getElementById(rowID);
                        div.style.visibility = "hidden";
                        div.style.display = "none";
                        // process the form
                        $.ajax({
                        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                                url         : '/article/delPhotos', // the url where we want to POST
                                data        :  formData,
                                dataType    : 'json', // what type of data do we expect back from the server
                                contentType :  false,
                                processData :  false,
                                headers: {
                                'X-CSRF-TOKEN': token.val()
                                }
                        })
                        // using the done promise callback
                        .done(function(data) {
                            $('#uploadimg').prop('checked', false); // Unchecks it
                            location.reload();
                        // log data to the console so we can see
                        console.log(data);
                                //alert('Author Saved');
                                // here we will handle errors and validation messages
                        });
                };
                $(document).ready(function() {
        //var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var token = $('input[name=_token]');
                // process the form - For Add Image in Album
        /*        $("#addvideobutton").click(function(){
        // get the form data
        //alert($('input[name=videoid]').val());
        var formData = new FormData();
                formData.append('v_id', $('input[name=videoid]').val());
                formData.append('title', $('input[name=videoTitle]').val());
                formData.append('code', $('textarea[name=videoCode]').val());
                formData.append('source', $('input[name=videoSource]').val());
                formData.append('url', $('input[name=videoURL]').val());
                formData.append('channel_id', $('select[name=channel_sel]').val());
                formData.append('owner', 'article');
                // process the form
                $.ajax({
                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                        //method      : 'POST',
                        url         : '/article/addVideos', // the url where we want to POST
                        //files       :  true,
                        data        :  formData,
                        dataType    : 'json', // what type of data do we expect back from the server
                        contentType :  false,
                        processData :  false,
                        success     :  function(respText){
                        theResponse = respText;
                                alert(theResponse);
                                //Assign returned ID to hidden array element
                                $('#uploadedVideos').val(theResponse);
                                //alert($('#uploadedVideos').val());
                        },
                        headers: {
                        'X-CSRF-TOKEN': token.val()
                        }
                })
                // using the done promise callback
                .done(function(data) {

                // log data to the console so we can see
                console.log(data);
                        // here we will handle errors and validation messages
                });
                // stop the form from submitting the normal way and refreshing the page
                //event.preventDefault();
        }); */
                // process the form - For Add Image in Album
                $.fn.addPhotoFunc = function (add_id, index){
                //$.fn.function.addPhotoFunc = function(){}
                //$("#addphotobutton").click(function(){}
                //$("#addAuthorForm").on('click',function(event){}
//                     alert('Yay 0 !');
                alert(index);
                        alert(add_id);
                        var albumPhoto = "albumPhoto" + index;
                        var photoTitle = "photoTitle" + index;
                        var photoDesc = "photoDesc" + index;
                        var photoSource = "photoSource" + index;
                        var photoSourceURL = "photoSourceURL" + index;
                        var photoEnabled = "photoEnabled" + index;
                        var pID = add_id;
                        //alert(albumPhoto2.files.length);

                        // get the form data
                        // there are many ways to get this data using jQuery (you can use the class or id also)
                        var formData = new FormData();
                        if (index == 1)
                {formData.append('albumphoto', albumPhoto1.files[0]); }
                else if (index == 2)
                {formData.append('albumphoto', albumPhoto2.files[0]); }
                else if (index == 3)
                {formData.append('albumphoto', albumPhoto3.files[0]); }
                else if (index == 4)
                {formData.append('albumphoto', albumPhoto4.files[0]); }

                //formData.append('albumphoto', $('+albumPhoto+').files[0]);
                formData.append('title', $('input[name=' + photoTitle + ']').val());
                        formData.append('description', $('textarea[name=' + photoDesc + ']').val());
                        formData.append('source', $('input[name=' + photoSource + ']').val());
                        formData.append('sourceurl', $('input[name=' + photoSourceURL + ']').val());
                        formData.append('active', $('input[name=' + photoEnabled + ']:checked').val());
                        formData.append('channel_id', $('select[name=channel_sel]').val());
                        formData.append('p_id', pID);
                        formData.append('owner', 'article');
                        // process the form
                        $.ajax({
                        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                                //method      : 'POST',
                                url         : '/article/addPhotos', // the url where we want to POST
                                //files       :  true,
                                data        :  formData,
                                enctype     : 'multipart/form-data',
                                dataType    : 'json', // what type of data do we expect back from the server
                                contentType :  false,
                                processData :  false,
                                success     :  function(respText){
                                theResponse = respText;
                                        //Assign returned ID to hidden array element
                                        alert($('#uploadedImages').val());
                                        var isthere = $('#uploadedImages').val();
                                        var arrP = isthere.split(',');
                                        arrP.push(theResponse);
                                        var newval = arrP.join(',');
                                        $('#uploadedImages').val(newval);
                                        //alert($('#uploadedImages').val());
                                },
                                //encode      : true,
                                headers: {
                                'X-CSRF-TOKEN': token.val()
                                }
                        })
                        // using the done promise callback
                        .done(function(data) {

                        // log data to the console so we can see
                        console.log(data);
                                //alert('Author Saved');
                                // here we will handle errors and validation messages
                        });
                        // stop the form from submitting the normal way and refreshing the page
                        //event.preventDefault();
                }//);

        });
            
    
    $(document).ready(function() {              
     $("#videocode").addClass("none");                  
   $(':radio[id=videoid]').change(function() {
      
   $("#videocode").removeClass("none");
   $("#embedcodevideodetails").addClass("none");


});
$(':radio[id=embedcodevideo]').change(function() {
    
   $("#embedcodevideodetails").removeClass("none");
   $("#videocode").addClass("none");

});
  });   
    
    
    </script>
        <!--start container-->
     {{--@if(in_array('12',Session::get('user_rights')) && $article->status!='P')--}}
     @if(in_array('12',Session::get('user_rights')))
    
    <div class="container-fluid hidden" >

        <div class="form-legend" id="schedule-for-upload">Schedule For Upload</div>

        <div  class="control-group row-fluid">
            <div class="span2">
                <label class="control-label" for="datepicker">
                    Date Picker<a href="javascript:;" class="bootstrap-tooltip" data-placement="top" data-original-title="Click to choose date."><i class="icon-photon info-circle"></i></a>
                </label>
            </div>
            <div class="span10">
                <div class="controls">
                    <input type="text"  name="datepicked" id="datepicker" class="span3 req1" value="{{  $article->publish_date }}" />
                </div>
            </div>
        </div>

        <div id="Time_Picker" class="control-group row-fluid">
            <div class="span2">
                <label class="control-label" for="timeEntry">
                    Time Picker<a href="javascript:;" class="bootstrap-tooltip" data-placement="top" data-original-title="Enter time."><i class="icon-photon info-circle"></i></a>
                </label>
            </div>
            <div class="span10">
                <div class="controls">
                    <input type="text" name="timepicked" id="timeEntry" class="span2" value="{{ $article->publish_time }}"/>
                </div>
            </div>
        </div>
        
        <script>
                    $(function(){
 
                    $("#datepicker").datepicker({
            minDate: 0,
            dateFormat: "yy-mm-dd"
        });
//                            $("#datepickerInline").datepicker();
//                            $("#datepickerMulti").datepicker({
//                            numberOfMonths: 3,
//                            minDate: 0,
//                            showButtonPanel: true
//                    });
                            $.timeEntry.setDefaults({show24Hours: true,showSeconds: true});   
                            $('#timeEntry').timeEntry().change();
                            //$('#timeEntry').timeEntry({minTime: '-0 +1m'}).change();
                    });</script>
    </div>
    @endif
    <!--start container-->
     {{--@if(in_array('12',Session::get('user_rights')) && $article->status!='P')--}}
     @if(in_array('12',Session::get('user_rights')))
    
    <div class="container-fluid ">

        <div class="form-legend" id="schedule-for-upload">Schedule For Upload</div>

        <div  class="control-group row-fluid">
            <div class="span2">
                <label class="control-label" for="datepicker">
                    Date Picker<a href="javascript:;" class="bootstrap-tooltip" data-placement="top" data-original-title="Click to choose date."><i class="icon-photon info-circle"></i></a>
                </label>
            </div>
            <div class="span10">
                <div class="controls">
                    <input type="text"  name="datepicked" id="datepicker" class="span3 req1" value="{{  $article->publish_date }}" />
                </div>
            </div>
        </div>

        <div id="Time_Picker" class="control-group row-fluid">
            <div class="span2">
                <label class="control-label" for="timeEntry">
                    Time Picker<a href="javascript:;" class="bootstrap-tooltip" data-placement="top" data-original-title="Enter time."><i class="icon-photon info-circle"></i></a>
                </label>
            </div>
            <div class="span10">
                <div class="controls">
                    <input type="text" name="timepicked" id="timeEntry" class="span2" value="{{ $article->publish_time }}"/>
                </div>
            </div>
        </div>
        
        <script>
                    $(function(){
 
                    $("#datepicker").datepicker({
            minDate: 0,
            dateFormat: "yy-mm-dd"
        });
//                            $("#datepickerInline").datepicker();
//                            $("#datepickerMulti").datepicker({
//                            numberOfMonths: 3,
//                            minDate: 0,
//                            showButtonPanel: true
//                    });
                            $.timeEntry.setDefaults({show24Hours: true,showSeconds: true});   
                            $('#timeEntry').timeEntry().change();
                            //$('#timeEntry').timeEntry({minTime: '-0 +1m'}).change();
                    });</script>
    </div>
    @endif
    <div class="container-fluid">

        <div class="control-group row-fluid">
            <div class="span12 span-inset">
                 @if($article->status=='P')
                <!-- <label class="checkbox" >
                    <input type="checkbox" name="for_homepage" class="uniformCheckbox" value="checkbox1" @if($article->for_homepage == 1) checked @endif>
                           <a href="#" target="_blank">Publish this to Home Page</a>
                </label> -->
                <script>
                            $().ready(function(){
                    $(".uniformCheckbox").uniform();
                    });</script>
                <script>
                            $().ready(function(){
                    $(".uniformCheckbox2").uniform();
                    });</script>
 <!-- <label class="checkbox" >
                    <input type="radio" name="important" class="uniformCheckbox" value="l" @if($article->web_exclusive != 1 && $article->important != 1) checked @endif>
                    <a href="#" target="_blank">Latest News</a>
                </label>
                <label class="checkbox" >
                    <input type="radio" name="important" class="uniformCheckbox" value="e" @if($article->important == 1) checked @endif>
                    <a href="#" target="_blank">Editor Pick</a>

                </label> -->
                <label class="checkbox" >
                    <input type="checkbox" name="important" class="uniformCheckbox" value="f" @if($article->web_exclusive == 1) checked @endif>
                    <a href="#" target="_blank">Feature</a>
                </label>
                

                  <!-- <label class="checkbox" >
                    <input type="checkbox" name="pinit" class="uniformCheckbox" value="pinit" @if($article->is_pinned == 1) checked @endif>
                           <a href="#" target="_blank"> Pin It</a>
                </label> -->
                 @endif
                  @if($article->status=='N')
                 <!-- <label class="checkbox" >
                    <input type="checkbox" name="post_fb"  class="uniformCheckbox" value="fbpost" >
                           <a href="#" target="_blank">Facebook</a>
                </label>
                 <label class="checkbox" >
                    <input type="checkbox" name="post_tw"  class="uniformCheckbox" value="twpost">
                           <a href="#" target="_blank">Twiter</a>
                 </label> -->

            <!--          @if($whatsup->cn < '3')
               @if($whtasuptime < date('H:i:s'))
               <label class="checkbox" >
               <input type="checkbox" name="post_whatsup"  class="uniformCheckbox" value="1" >
               <a href="#" target="_blank">Whatsapp</a>
               </label>
               @else
               <label class="checkbox" >
               <a href="javascript:;" class="bootstrap-tooltip" data-placement="top" data-original-title="Next WhatsApp Post after {{$whtasuptime}}"><img style="width: 30px;margin-left: -27px;" src="data:image/png;base64,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"></a>
               </label>
               @endif
                            @else
               <label class="checkbox" >
               <label class="checkbox" >
               <a href="javascript:;" class="bootstrap-tooltip" data-placement="top" data-original-title="You have done your max limit post on whatsApp"><img style="width: 30px;margin-left: -27px;" src="data:image/png;base64,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"></a>
               </label>
               </label>
                            @endif -->

                
                <!-- <label class="checkbox" >
                    <input type="checkbox" name="for_homepage" class="uniformCheckbox" value="checkbox1" @if($article->for_homepage == 1) checked @endif>
                           <a href="#" target="_blank">Publish to Home Page</a>
                </label> -->
                <script>
                            $().ready(function(){
                    $(".uniformCheckbox").uniform();
                    });</script>
                <script>
                            $().ready(function(){
                    $(".uniformCheckbox2").uniform();
                    });</script>
                <!-- <label class="checkbox" >
                    <input type="radio" name="important" class="uniformCheckbox" value="l" @if($article->web_exclusive != 1 && $article->important != 1) checked @endif>
                    <a href="#" target="_blank">Latest News</a>
                </label> -->
                <!-- <label class="checkbox" >
                    <input type="radio" name="important" class="uniformCheckbox" value="e" @if($article->important == 1) checked @endif>
                    <a href="#" target="_blank">Editor Pick</a>

                </label> -->
                <label class="checkbox" >
                    <input type="checkbox" name="important" class="uniformCheckbox" value="f" @if($article->web_exclusive == 1) checked @endif>
                    <a href="#" target="_blank">Feature</a>
                </label>
                  <!-- <label class="checkbox" >
                    <input type="checkbox" name="pinit" class="uniformCheckbox" value="pinit" @if($article->is_pinned == 1) checked @endif>
                           <a href="#" target="_blank"> Pin It</a>
                            
                </label> -->
                   @endif
                  <!-- <label class="checkbox" >
                    <input type="radio" name="newstype" class="uniformCheckbox" value="3" @if($article->news_type == 3) checked @endif>
                           <a href="#" target="_blank"> Interview</a>
                           
                </label> -->
                <!-- <label class="checkbox" >
                    <input type="radio" name="newstype" class="uniformCheckbox" value="7" @if($article->news_type == 7) checked @endif>
                           <a href="#" target="_blank"> Guest Coloum</a>
                           
                </label> -->
                 <label class="checkbox" style="display: none;">
                <input type="checkbox" id="uploadimg" class="uniformCheckbox2" name="checkbox"  @if(count($photos)>0) checked @endif/>
                <a href="javascript:;">Upload </a>
                </label>
            </div>
        </div>



        <div class="control-group row-fluid" id="submitsection">
            <p id="pmsg" style="color: red;display: none;">You must upload image first.</p>
            <div class="span12 span-inset">
                <!--<button type="submit" name="status" value="S" id="draftSubmit" class="btn btn-default">Draft</button><img src="{{ asset('images/photon/preloader/76.gif')}}" alt="loader" style="width:5%; display:none;"/>-->
                <!--<button type="submit" name="status" value="N" id="pageSubmit" name="N" class="btn btn-warning">Submit</button><img src="{{ asset('images/photon/preloader/76.gif')}}" alt="loader" style="width:5%; display:none;"/>-->
            @if($article->status !='D')
                @if($article->status=='S' )
                <button type="submit" name="status" value="SV" id="draftSubmit" class="btn btn-info">Save</button>
                @else
                @if($article->status !='SD')
                <button type="submit" name="status" value="SV" id="saveSubmit" class="btn btn-info">Save</button>
                @else
                @endif
               @endif
                @if($article->status=='S' )
                <button class="btn btn-warning" id="pageSubmit" value="N" name="status" type="submit">Submit</button>
                @endif
                 @if(in_array('12',Session::get('user_rights')))
                <button class="btn btn-primary" id="scheduleSubmit" value="SD" name="status" type="submit">Schedule</button>
                @endif
            @endif
                @if(in_array('12',Session::get('user_rights')))
                @if($article->status!='P' )
                <button type="submit" name="status" value="P" id="publishSubmit" class="btn btn-success">Publish</button><img src="{{ asset('images/photon/preloader/76.gif')}}" alt="loader" style="width:5%; display:none;"/>
                @endif
                @endif
                @if(in_array('13',Session::get('user_rights')))
                @if($article->status!='D')
                <!-- <button type="submit" name="status" value="D" id="dumpSubmit" class="btn btn-danger">Dump</button><img src="{{ asset('images/photon/preloader/76.gif')}}" alt="loader" style="width:5%; display:none;"/> -->
                @endif
                @endif
                
            </div>
        </div>
    </div>
    <!--    end container-->
    {!! Form::close() !!}

</div>
<!--</body>
</html> -->

<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
    <td colspan="4">            
    <table width="100%">
    <tr>  
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
</tr>
       

        <tr>
        <td colspan="1">Title</td>
        <td colspan="3"><input type="text" id="imagetitle" name="imagetitle[{%=file.name%}]"/></td>    
        </tr>
    
    </table>   
    </td>   
    </tr>
{% } %}
</script>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<!--<script src="http:js/vendor/jquery.ui.widget.js"></script>-->
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="http://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- blueimp Gallery script -->
<script src="http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<!-- <script type="text/javascript" src="{{ elixir('output/fileuploadJS.js') }}"></script> -->
<script type="text/javascript" src="{{ asset('cms/js/tmpl.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('cms/js/load-image.all.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('cms/js/jquery.iframe-transport.js') }}"></script>
<script type="text/javascript" src="{{ asset('cms/js/jquery.fileupload.js') }}"></script>
<script type="text/javascript" src="{{ asset('cms/js/jquery.fileupload-process.js') }}"></script>
<script type="text/javascript" src="{{ asset('cms/js/jquery.fileupload-image.js') }}"></script>
<script type="text/javascript" src="{{ asset('cms/js/jquery.fileupload-audio.js') }}"></script>
<script type="text/javascript" src="{{ asset('cms/js/jquery.fileupload-video.js') }}"></script>
<script type="text/javascript" src="{{ asset('cms/js/jquery.fileupload-validate.js') }}"></script>
<script type="text/javascript" src="{{ asset('cms/js/jquery.fileupload-ui.js') }}"></script>
<script>
    $(document).ready(function(){
$('#validation_form').fileupload({
     maxNumberOfFiles: 1,
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: '<?php echo url('article/image/upload') ?>',
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 10000000
    });
     });
     $('#validation_form').bind('fileuploaddone', function (e, data) {
    //console.log(e);
     var dataa = JSON.parse(data.jqXHR.responseText);
                                        //console.log(dataa['files']['0']['name']);
                                        $.each(dataa['files'], function(index, element) {
                                         $( "#uploadimg" ).prop( "checked", true );
                                            $('#pmsg').hide();
                                        if ($('#uploadedImages').val().trim())
                                                $('#uploadedImages').val($('#uploadedImages').val() + ',' + element.name);
                                                
                                                else
                                                $('#uploadedImages').val(element.name);
                                            
                                        });
                                });
     
    $('#validation_form').bind('fileuploaddestroyed', function (e, data) {
    // console.log(data);
     var file=getArg(data.url,'file');
     var images= $('#uploadedImages').val().split(',');
     images.splice(images.indexOf(file),1);
     $('#uploadedImages').val(images.join());
      //$('#imagesname').val($('#imagesname').val().replace(','+));
     
    });
    

function getArg(url,name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(url);
    if (results==null){
       return null;
    }
    else{
       return results[1] || 0;
    }
}


</script>
<script>
//alert(1);
  var token = $('input[name=_token]');
  $("#tableSortableResMed tbody").sortable({
      appendTo: "parent",
      helper: "clone",
      update: function (event, ui) {
      
        var data = $(this).sortable('serialize');
        //alert(data);    
        // POST to server using $.post or $.ajax
                $.ajax({
                    data: data,
                    type: 'POST',
                    url: '{{ url("/article/sort/".$article->article_id)}}',
                    headers: {
                                'X-CSRF-TOKEN': token.val()
                             }
                });
        
    }
  }).disableSelection();

</script>

<style type="text/css">
    .radio input[type="radio"], .checkbox input[type="checkbox"] {
        opacity: 1 !important;

    }
    .radio, .checkbox {
    min-height: 30px;
    line-height: 30px;
    padding-left: 10px;
    float: left;
        margin-top: 0px !important;}
          #cke_45{
        display: none;
     }
</style>
@stop
