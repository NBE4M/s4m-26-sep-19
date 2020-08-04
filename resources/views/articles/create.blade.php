@extends('layouts/master')

@section('title', 'Create Articles - S4M-CMS')

@section('content')
<style> .none { display:none; } </style>
<div class="panel retracted">
    <div class="panel-content filler">
        <div class="panel-logo"></div>
        <div class="panel-header">
            <h1><small>Create Article</small></h1>
        </div>
        <div class="panel-header">
 <!--<h1><small>Page Navigation Shortcuts</small></h1>-->
        </div>
        <script>
            $(document).ready(function(){
				$('#draftSubmit').click(function(){
				var authortype = $("#authortype option:selected").val();
				var category = $("#category1 option:selected").val();
				var author = $("#author").val();
				var artititle = $("#artititle").val();
                
				var summary = $("#summary").val();
				var maxi = CKEDITOR.instances.maxi.getData();
				$("#fileupload").validate().cancelSubmit = true;
                if ($('#featureCheckBox').is(":checked")) {
                    alert('Feature Box only active when you published article!');
                    return false;                
                } 
				if(authortype=='') {
				alert('plaese select Post As');
				$("#authortype").focus();
				return false;

			}
            if(author=='') {
                alert('plaese select Author Name');
                $("#author").focus();
                return false;
            }
            if(category=='') {
                alert('plaese select Category');
                $("#category1").focus();
                return false;
            }
             if(artititle=='') {
                alert('plaese Add Title');
                $("#artititle").focus();
                return false;
            }
            if(summary=='') {
                alert('plaese Add Summary');
                $("#summary").focus();
                return false;
            }
            if(maxi=='') {
                alert('plaese Add description');
                $("#maxi").focus();
                return false;
            }
            
            });
                    $('#pageSubmit').click(doClick);
                    $('#pageSubmit').click(function(){
                       if ($('#featureCheckBox').is(":checked")) {
                            alert('Feature Box only active when you published article!'); 
                            return false;               
                        }  
                    });
                    $('#saveSchedule').click(doClick);
                    $('#publishSubmit').click(doClick);
                                    function doClick(){
										if(!this.form.checkbox.checked)
                                            {
                                            $('#pmsg').show();
                                            return false;
                                            }	

                                        var taglist = $('#Taglist').val();
                                        if(taglist=='') {
                                           alert('plaese select Tags');
                                           $('#Taglist').focus();
                                                return false;
                                            }
                                          
                                          var id = $(this).attr("id");
                                            if (id =='saveSchedule') {
                                            if ($('#datepicker').val()=='') {
                                            alert('please Select Date');
                                            $('#datepicker').focus()
                                            return false;
                                            }
                                            if ($('#timeEntry').val()=='') {
                                            alert('please Select Time');
                                            $('#timeEntry').focus()
                                            return false;
                                            }
                                            }
                                        if ($('#imagetitle').val()=='') {
                                            alert('please fill Photo title');
                                            $('#imagetitle').focus()
                                            return false;
                                        }
                                            var checkvalid = 1;
                                            var as = CKEDITOR.instances.maxi.getData();
                                            $('.error.elrte-error').remove();
                                            $('.error.author-error').remove();
                                            $('.error.noborder').remove();
                                            $('#maxi').parent('div').removeClass('error');
                                            if (as.length == 0){
                                            $('#maxi').parent('div').addClass('error');
                                            $('.elrte-wrapper').after('<span class="error elrte-error" style="display:block;" >Article description is required. </span>');
                                            checkvalid = 0;
                                    }

                                    

                                    if (($('#authortype').val() != '') && ($('#authortype').val() != '1') && $('#author').val() == '') {
                                    //alert('Please Select Author Name');
                                    $('#author').after('<span class="error author-error">Author name is required.</span>');
                                            $('#author').siblings('div').addClass('error');
                                            checkvalid = 0;
                                    }


                                    $("#fileupload").validate({
                                    errorElement: "span",
                                            errorClass: "error",
                                            onclick: true,
                                            invalidHandler: function(event, validator) {

                                            for (var i in validator.errorMap) {

                                            if ($('#' + i).hasClass('formattedelement')){
                                            $('#' + i).siblings('.formattedelement').addClass('error');
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
										if (!$("#fileupload").valid())
                                            checkvalid = 0;                                       
										if (checkvalid = 0){
                                            
										$('#submitsection').prepend('<div class="error noborder">An error has occured. Please check the above form.</div>');

										return false;
										}


                                    }
                            $('select.formattedelement').change(function(){
                            if ($(this).val().trim() != '')
                                    $(this).siblings('.formattedelement').removeClass('error');
                                    $(this).siblings('span.error').remove();
                            });
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
                                    @if (in_array('12', Session::get('user_rights')))
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
                <a href="{{url('/cms/dashboard')}}">
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
        <h2><small>New Article</small></h2>
        <h3>
           
            <small>{{ isset($userTup->name) ? $userTup->name:'' }}</small>
            
        </h3>
    </header>
    {!! Form::open(array('url'=>'cms/article/','class'=> 'form-horizontal','id'=>'fileupload','enctype'=>'multipart/form-data')) !!}
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


    <div class="container-fluid">
        <div class="form-legend" id="Author-Detail">Author Detail

        </div>
        <div id="Simple_Select_Box" class="control-group row-fluid">
            <div class="span2">
                <label class="control-label" for="simpleSelectBox">Post As</label>
            </div>
            <div class="span10">
                {!! Form::select('authortype',$p1->toArray(),null,
                                   ['class' => 'form-control formattedelement','id' =>'authortype' ]) !!}
            </div>
            <script>
                      $().ready(function(){
                        $("#authortype").select2({
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
                <div id="existing" class="tab-pane fade active in">

                    <div id="Simple_Select_Box" class="control-group row-fluid">
                        <div class="span2">
                            <label class="control-label" for="simpleSelectBox">Author Name</label>
                        </div>

                        <div class="span10">

                        </div>

                        <div class="span10">

                            <div class="controls">
                                <input type="text" class="valid" name="author" id="author"/>
                            </div>
                            <script>

                                       $().ready(function() {
                                        $("#author").tokenInput(function(){
                                           return "{{url('api/article/authordd')}}?option=" + $("#authortype").val();
                                        },
                                        {
                                        theme: "facebook",
                                                searchDelay: 300,
                                                minChars: 3,
                                                preventDuplicates: true,
                                                tokenLimit:3,
                                        });
                                        });                            </script>


                        </div>


                    </div>



                    <script type="text/javascript">

                                        $(document).ready(function(){

                                $("#authortype").change(function(){
                                $("#author").tokenInput("clear");
                                        $(this).find("option:selected").each(function(){



                                if ($(this).attr("value") == "1"){

                                $("#tabarea").hide();
                                } else {
                                $("#tabarea").show();
                                }
                                if ($(this).attr("value") == "6"){
                                $("#tabarea").show();
                                        $('#event_top_div').show();
                                        $('#event_bottom_div').hide();
                                }
                                else{
                                $('#event_top_div').hide();
                                        $('#event_bottom_div').show();
                                }
                                });
                                }).change();
                                        $("#event_id_author").change(function(){
                                $("#author").tokenInput("clear");
                                });
                                });                        </script>

                </div>

                <div id="new" class="tab-pane fade entypo ">

                </div>
                <script>
                                    // magic.js
                                    $(document).ready(function() {
                            $(".uniformRadio").uniform({
                            radioClass: 'uniformRadio'
                            });
                                   var token = $('input[name=_token]');
                                    $("#addabut").click(function(){
                            if (validateAuthorData()){

                            var formData = new FormData();
                                    formData.append('photo', photo.files[0]);
                                    formData.append('name', $('input[name=Name]').val());
                                    formData.append('author_type', $('input[name=author_type]:checked').val());
                                    formData.append('email', $('input[name=email]').val());
                                    formData.append('bio', $('textarea[id=Bio]').val());
                                    formData.append('mobile', $('input[name=mobile]').val());
                                    formData.append('twitter', $('input[name=twitter]').val());
                                    formData.append('column_id', $('select[name=column_id]').val());

                                    $.ajax({
                                    type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)

                                            url         : '{{url('')}}/article/addAuthor', // the url where we want to POST
                                            data        :  formData,
                                            enctype     : 'multipart/form-data',
                                            dataType    : 'json', // what type of data do we expect back from the server
                                            contentType :  false,
                                            processData :  false,
                                            beforeSend  :function(data){
                                            $('#addabut').hide();
                                                    $('#addabut').siblings('img').show();
                                            },
                                            success     :  function(data){
                                            if (data.status == 'success'){
                                            alert('Author saved');
                                                    $("#new input[type='text']").val('');
                                                    $("#new input[type='email']").val('');
                                                    $('#new textarea').val('');
                                                    $('input[name=photo]').remove();
                                                    $('.authorimagespn').append('<input type="file" name="photo" id="photo">');
                                                    $('#iconsTab').find('li').eq(0).find('a').trigger('click')
                                            } else{
                                            $('#addabut').before(errorMessage(data.msg));
                                            }
                                            },
                                            complete    :function(data){
                                            $('#addabut').show();
                                                    $('#addabut').siblings('img').hide();
                                            },
                                            //encode      : true,
                                            headers: {
                                            'X-CSRF-TOKEN': token.val()
                                            }
                                    });
                            }



                            });
                                    // alert()
                                    $('input[name=author_type]').click(function(){
                            if ($('input[name=author_type]:checked').val() == 4){
                            $("#ch-reporter").show();
                            } else{
                            $("#ch-reporter").hide();
                            }
                            });
                                    // check status on document ready
                                    if ($('input[name=author_type]:checked').val() == 4){
                            $("#ch-reporter").show();
                            } else{
                            $("#ch-reporter").hide();
                            }

                            });
                                    function validateAuthorData(){
                                    var valid = 1;
                                            $('.author_error').remove();
                                            $('#new input').removeClass('error');
                                            $('#new textarea').removeClass('error');
                                            if ($('input[name=Name]').val().trim() == 0){
                                    valid = 0;
                                            $('input[name=Name]').addClass('error');
                                            $('input[name=Name]').after(errorMessage('Please enter name'));
                                    }
                                    if ($('textarea[name=Bio]').val().trim() == 0){
                                    valid = 0;
                                            $('textarea[name=Bio]').addClass('error');
                                            $('textarea[name=Bio]').after(errorMessage('Please enter bio'));
                                    }
                                    if ($('input[name=email]').val().trim() == 0){
                                    valid = 0;
                                            $('input[name=email]').addClass('error');
                                            $('input[name=email]').after(errorMessage('Please enter email'));
                                    } else{

                                    if (!(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i.test($('input[name=email]').val()))){
                                    valid = 0;
                                            $('input[name=email]').addClass('error');
                                            $('input[name=email]').after(errorMessage('Please enter vaild email'));
                                    }
                                    }
                                    if ($('input[name=mobile]').val().trim() == 0){
                                    valid = 0;
                                            $('input[name=mobile]').addClass('error');
                                            $('input[name=mobile]').after(errorMessage('Please enter mobile'));
                                    } else {
                                    var regex = /^(\d{1,3}[- ]?)?\d{10}$/;
                                            if (!regex.test($('input[name=mobile]').val())){
                                    valid = 0;
                                            $('input[name=mobile]').addClass('error');
                                            $('input[name=mobile]').after(errorMessage('Please enter valid mobile'));
                                    }
                                    }
                                    if ($('input[name=photo]').val().trim() == 0){
                                    valid = 0;
                                            $('input[name=photo]').addClass('error');
                                            $('.authorimagespn').after(errorMessage('Please select photo'));
                                    }
                                    //alert(valid);
                                    if (valid == 0)
                                            return false;
                                            else
                                            return true;
                                    }
                            function errorMessage($msg){
                            return '<span class="error author_error">' + $msg + '</span>';
                            }
                </script>
            </div>
        </div>
    </div>
    <!-- end container1 -->
 


     
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
                    <textarea  name="title" rows="2" class="no-resize  title_range valid" id="artititle">{{ old('title') }}</textarea>
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
                    <textarea  name="summary" rows="4" class="" id="summary">{{ old('summary') }}</textarea>
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
                    <textarea name="description" id="maxi" rows="2" class="auto-resize required formattedtextareat">{{ old('description') }}</textarea>
                    <span for="description" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                   <!--  <script>

                                        elRTE.prototype.options.panels.web2pyPanel = [
                                                'pastetext', 'bold', 'italic', 'underline', 'justifyleft', 'justifyright',
                                                'justifycenter', 'justifyfull', 'forecolor', 'hilitecolor', 'fontsize', 'link',
                                                'image', 'insertorderedlist', 'insertunorderedlist'];
                                        elRTE.prototype.options.denyTags = ['div'];    
                                        elRTE.prototype.options.toolbars.web2pyToolbar = ['web2pyPanel', 'tables'];
                                        $('#maxi').elrte({
                                        lang: "en",
                                        styleWithCSS: false,
                                        height: 200,
                                        toolbar: 'web2pyToolbar'
                                });
                                        $(document).ready(function() {

                                $("#canonical").addClass("none");
                                        $(':radio[id=ifno]').change(function() {
                                $("#canonical").addClass("none");
                                });
                                        $(':radio[id=ifyes]').change(function() {
                                $("#canonical").removeClass("none");
                                });
                                });</script> -->
<script type="text/javascript"> 
var editor = CKEDITOR.replace( 'maxi' );
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
                <div class="controls">
                    <input type="text" id="slug_url" class="reqired" value="{{ old('slug') }}" name="slug" required="">
                    <input type="hidden"  value="{{ old('cat_name') }}" name="cat_name" id="cat_name">
                    
                </div>
            </div>
        </div>
      <!--Text Area - No Resize begin--> 
    </div>
    <!-- End Create Url -->
  
   <!--Simple Select Box begin-->
       
    <div class="container-fluid">

        <div class="form-legend" id="categories">Categories</div>

        <!--Select Box with Filter Search begin-->
        <div  class="control-group row-fluid">
            <div class="span2">
                <label class="control-label" for="selectBoxFilter">Categories</label>
            </div>
            <div class="span10">
                <div class="controls">
                    <select name="category1" id="category1" class="formattedelement">
                        <option  value="">Please Select</option>
                        @foreach($category as $key )
                        <option value="{{ $key->category_id }}">{{ $key->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <script>
                                $(document).ready(function(){
                        $("#category1").select2();
                                $('#category1').change(function(){
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
                        <option value="{{ $key->id }}">{{ $key->title }}</option>
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

        <div class="control-group row-fluid" id="Multiple_Select_Box_with_Filter_Search">
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

                        $.ajax({
                        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                                url         : '{{url("/article/addTag")}}', // the url where we want to POST
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
//                                        alert('Tag Saved');
//                                        $("#Taglist").tokenInput("add", [{"id":"2","name":"Coal Scam"},{"id":"4","name":"Cuisine"},{"id":"7","name":"Education"},{"id":"15","name":"Election"},{"id":"208","name":"testtag1"},{"id":"1","name":"Modi"},{"id":"207","name":"tagtest"},{"id":"210","name":"ankita"}]);
//                                         //$("#Taglist").tokenInput("add", {id: 9992, name: "test22"});
                                },
                                headers: {
                                'X-CSRF-TOKEN': token.val()
                                }
                        })
                        });
                                $("#Taglist").tokenInput("{{url('tags/get/Json')}}", {
                        theme: "facebook",
                                searchDelay: 300,
                                minChars: 4,
                                preventDuplicates: true,
                        });
                        });</script>
        </div>
        <!--Select Box with Filter Search end-->
    </div>
    <!-- Upload container1 -->
      
    <!-- Upload container1 -->




    <div class="container-fluid">

        <div class="form-legend" id="photos-videos">Photos
        </div>

        <!--Tabs begin-->

        <div  class="control-group row-fluid span-inset">
            <ul class="nav nav-tabs" id="myTab">

                <li class="dropdown active"><a data-toggle="tab" href="#dropdown1">Photo</a></li>
              <!--   <li><a data-toggle="tab" href="#tab-example1">Video</a></li> -->
            </ul>
            <div class="tab-content">
                <div id="dropdown1" class="tab-pane fade active in">
                    <div class="related_image " >
                        <div>
                            Browse recent related images : <input type="text" name="related_image_search" id="related_image_search" />
                            <button class="btn btn-success" onclick="searchRelated()" id="related_image_button"  name="status" type="button" style="margin-bottom:0px !important;">Search</button>
                            <button class="btn btn-success" onclick="kk()" id="related_image_button"  name="status" type="button" style="margin-bottom:0px !important;">Search High Resolution</button>

                        </div>
                        <div class="relaed_image_box_outer hide" >
                            <img src="{{ asset('images/photon/preloader/76.gif')}}" class="loader-img-related-content hide" alt="loader" />
                            <div class="relaed_image_box">

                            </div>
                            <div class="related-img-selection-done"  >
                                <button class="btn btn-success hide related_action_button" onclick="relatedImagenewSelected()" id="related_selected_button" name="related_selected" type="button" >Start Upload</button>
                                <button class="btn btn-success hide related_action_button" onclick="relatedImageSelected()" id="related_selected_button" name="related_selected" type="button" >Upload</button>
                                <button class="btn btn-danger delete related_action_button" onclick="closeRelated()" type="button"><i class="glyphicon glyphicon-trash"></i><span>Close</span>
                                </button>
                                <img src="{{ asset('images/photon/preloader/76.gif')}}" class="loader-img-selected hide" alt="loader" />
                            </div>
                        </div>
                    </div>

                    <div class="control-group row-fluid">
                        <div class="span2">
                            <label class="control-label" for="inputField">
                                Upload Photos<a href="javascript:;" class="bootstrap-tooltip" data-placement="top" data-original-title="Here You can add  single photos by Drag and Drop or Simply By clicking and selecting  photos (Size: {{config('constants.dimension_article')}}) (File Size <= {{config('constants.maxfilesize').' '.config('constants.filesizein')}})."><i class="icon-photon info-circle"></i></a>
                            </label>
                        </div>
                        <div class="span11 row-fluid" >
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
                            <input type="hidden" id="uploadedImages" name="uploadedImages">

                        </div>

                    </div>

                </div>

            </div>
        </div>
        <!-- Uploaded Image and Video Ids -->

<!--        <input type="hidden" id="uploadedVideos" name="uploadedVideos[]">-->

        <!-- <label class="checkbox" >
            <input type="checkbox" name="hide_image" class="uniformCheckbox" value="1">
            <a href="javascript:;">Do Not Show Images On Landing Page</a>
        </label> -->

    </div><!--end container-->
    <script>
                                        // magic.js
                                        $.fn.MessageBox = function (msg)
                                        {
                                        var formData = new FormData();
                                                formData.append('photoId', msg);
                                                var token = $('input[name=_token]');
                                                var rowID = 'row' + msg;
                                                var div = document.getElementById(rowID);
                                                div.style.visibility = "hidden";
                                                div.style.display = "none";
                                                // process the form
                                                $.ajax({
                                                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                                                        url         : '{{url('')}}/article/delPhotos', // the url where we want to POST
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

                                                // log data to the console so we can see
                                                console.log(data);
                                                        //alert('Author Saved');
                                                        // here we will handle errors and validation messages
                                                });
                                        };
                                        $(document).ready(function() {
                                //var csrf_token = $('meta[name="csrf-token"]').attr('content');
                                var token = $('input[name=_token]');
                                        $("#addphotobutton").click(function(){
                                //$("#addAuthorForm").on('click',function(event){}
                                //  alert('Yay!');

                                // get the form data
                                // there are many ways to get this data using jQuery (you can use the class or id also)
                                var formData = new FormData();
                                        formData.append('albumphoto', albumPhoto.files[0]);
                                        formData.append('title', $('input[name=photoTitle]').val());
                                        formData.append('description', $('textarea[name=photoDesc]').val());
                                        formData.append('source', $('input[name=photoSource]').val());
                                        formData.append('sourceurl', $('input[name=photoSourceURL]').val());
                                        formData.append('active', $('input[name=photoEnabled]:checked').val());
                                        formData.append('channel_id', $('select[name=channel_sel]').val());
                                        formData.append('owner', 'article');
                                        // process the form
                                        $.ajax({
                                        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                                                //method      : 'POST',
                                                url         : '{{url('')}}/article/addPhotos', // the url where we want to POST
                                                //files       :  true,
                                                data        :  formData,
                                                enctype     : 'multipart/form-data',
                                                dataType    : 'json', // what type of data do we expect back from the server
                                                contentType :  false,
                                                processData :  false,
                                                success     :  function(respText){
                                                theResponse = respText;
                                                        alert(theResponse);
                                                        //Assign returned ID to hidden array element
                                                        alert($('#uploadedImages').val());
                                                        var isthere = $('#uploadedImages').val();
                                                        var arrP = isthere.split(',');
                                                        arrP.push(theResponse);
                                                        var newval = arrP.join(',');
                                                        $('#uploadedImages').val(newval);
                                                        /*
                                                         $("#Taglist").append($('<option>', {
                                                         value: element.tags_id,
                                                         text: element.tag
                                                         }));
                                                         */
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
                                });
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
                                });</script>

    @if(in_array('12',Session::get('user_rights')))

    <div class="container-fluid">

        <div class="form-legend" id="schedule-for-upload">Schedule For Upload</div>

        <div  class="control-group row-fluid">
            <div class="span2">
                <label class="control-label" for="datepicker">
                    Date Picker<a href="javascript:;" class="bootstrap-tooltip" data-placement="top" data-original-title="Click to choose date."><i class="icon-photon info-circle"></i></a>
                </label>
            </div>
            <div class="span10">
                <div class="controls">
                    <input type="text" name="datepicked" id="datepicker" class="span2" />
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
                        <input type="text" name="timepicked" id="timeEntry" class="span2" />
                        <span class="input-group-addon">
                        <i class="glyphicon glyphicon-time"></i>
                        </span>
                   
                </div>
            </div>
        </div>
					<script>
					$(function(){
					$("#datepicker").datepicker({
					minDate: 0,
					dateFormat: "yy-mm-dd"
					});
					$.timeEntry.setDefaults({show24Hours: true});
					$('#timeEntry').timeEntry().change();
					});</script>
    </div>

    @endif
   

    <div class="container-fluid">

        <div class="control-group row-fluid">
            <div class="span12 span-inset">
                 @if(in_array('12',Session::get('user_rights')))
                 <!-- <label class="checkbox">
                    <input type="checkbox" name="post_fb"  class="uniformCheckbox" value="fbpost">
                           <a href="#" target="_blank">Facebook</a>
                </label>

                 <label class="checkbox" >
                    <input type="checkbox" name="post_tw"  class="uniformCheckbox" value="twpost">
                           <a href="#" target="_blank">Twiter</a>
                 </label>
 -->
<!-- 
                   @if($whatsup->cn < '3')
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
                    <input type="checkbox" name="for_homepage" class="uniformCheckbox" value="checkbox1" checked >
                    <a href="#" target="_blank">Publish to Home Page</a>
                </label> -->

               <!--  <label class="checkbox" >
                    <input type="radio" name="important" class="uniformCheckbox" value="e">
                    <a href="#" target="_blank">Editor Pick</a>

                </label> -->
                <label class="checkbox" >
                    <input type="checkbox" name="important" class="uniformCheckbox" id="featureCheckBox" value="f">
                    <a href="#" target="_blank">Feature</a>
                </label>
                <!-- <label class="checkbox" style="display: none;">
                <input type="checkbox" id="uploadimg" class="uniformCheckbox" name="checkbox" />
                <a href="javascript:;">Upload </a>
                </label> -->
                <!-- <label class="checkbox" >
                    <input type="checkbox" name="pinit" class="uniformCheckbox" value="1">
                    <a href="#" target="_blank">Pin it</a>
                </label> -->
                 @endif
                <!-- <label class="checkbox" >
                    <input type="radio" name="newstype" class="uniformCheckbox" value="3">
                    <a href="#" target="_blank">Interview</a>
                     
                </label> -->
                <!-- <label class="checkbox" >
                   <input type="radio" name="newstype" class="uniformCheckbox" value="7">
                   <a href="#" target="_blank">Guest Coloum</a>
                    
               </label> -->
              
               <label class="checkbox" style="display: none;">
                <input type="checkbox" id="uploadimg" class="uniformCheckbox" name="checkbox" />
                <a href="javascript:;">Upload </a>
                </label>

            </div>
        </div>

        <div class="control-group row-fluid" id="submitsection">
            <p id="pmsg" style="color: red;display: none;">You must upload image first.</p>
            <div class="span12 span-inset">
                <button type="submit" name="status" value="S" id="draftSubmit" class="btn btn-default">Draft</button><img src="{{ asset('images/photon/preloader/76.gif')}}" alt="loader" style="width:5%; display:none;"/>
                <button type="submit" name="status" value="N" id="pageSubmit" name="N" class="btn btn-warning">Submit</button><img src="{{ asset('images/photon/preloader/76.gif')}}" alt="loader" style="width:5%; display:none;"/> 
                @if(in_array('12',Session::get('user_rights')))
                <button type="submit" name="status" value="P" id="publishSubmit" class="btn btn-success">Publish</button><img src="{{ asset('images/photon/preloader/76.gif')}}" alt="loader" style="width:5%; display:none;"/>
                 <button type="submit" name="status" value="SD" id="saveSchedule" class="btn btn-success">Schedule</button><img src="{{ asset('images/photon/preloader/76.gif')}}" alt="loader" style="width:5%; display:none;"/>
                @endif

            </div>
        </div>
    </div>
    <!--	end container-->
    {!! Form::close() !!}
    <script>
                                        function editImageDetail(){
                                        BootstrapDialog.show({
                                        message: $('<div class="shekhartest"></div>').load('http://localhost:8080/login.html')
                                        });
                                        }
    </script>
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
                                $('#fileupload').fileupload({
                                    required: true, 
                                    maxNumberOfFiles: 1,
                                // Uncomment the following to send cross-domain cookies:
                                //xhrFields: {withCredentials: true},
                                url: '<?php echo url('article/image/upload') ?>',
                                        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
                                        maxFileSize: 10000000,
                                        required: true, 

                                });
                                        $('.authorimagespn').append('<input type="file" name="photo" id="photo">');
                                });
                                        $('#fileupload').bind('fileuploaddone', function (e, data) {
                               // console.log(data);
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
                                        $('#fileupload').bind('fileuploaddestroyed', function (e, data) {
                                // console.log(data);
                                         var file = getArg(data.url, 'file');
                                        var images = $('#uploadedImages').val().split(',');
                                        images.splice(images.indexOf(file), 1);
                                        $('#uploadedImages').val(images.join());
                                         
                                        //$('#imagesname').val($('#imagesname').val().replace(','+));

                                });
                                        function getArg(url, name){
                                        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(url);
                                        console.log(results);
                                                if (results == null){
                                        return null;
                                        }
                                        else{
                                        return results[1] || 0;
                                        }
                                        }


</script>


<script type="text/javascript">
    var slug = function(str) {
    var $slug = '';
    var trimmed = $.trim(str);
    $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
    replace(/-+/g, '-').
    replace(/^-|-$/g, '');
    return $slug.toLowerCase();
}
</script>



<script type="text/javascript">
    $(document).ready(function() {
        $('#id').click( function(){

        var post_url = 'll';
     $.ajax({
        url: "<?php echo url('article/image/upload1') ?>",
            data:'&post_url='+$("#social_mediafburl").val(),
            type: "POST",
            success:function(data){

            },
            error:function (){

            }
    });
  });
    });
</script>
 <script>
    $().ready(function(){
        $(".uniformCheckbox").uniform();
    });
</script>
<style type="text/css">
    .radio, .checkbox {
    min-height: 30px;
    line-height: 30px;
    padding-left: 10px;
    float: left;    margin-top: 0px !important;}
    .error{
        top: 0px!important;
    }
</style>
 <script type="text/javascript">
     jQuery(document).ready(function($){
    $('[type="checkbox"][name="[post_tw]"]').change(function(){
      $('select.select').toggle(this.checked);
    });
});
 </script>
 <script>
     $("#pdf-file").validate({ 
    onfocusout: function(e) {
        this.element(e);
    },
    rules:{
        resume:{
            required:true,
            extension: "docx|rtf|doc|pdf"
        }
    },
    resume:{
        required:"input type is required",                  
        extension:"select valied input file format"
    }
});
 </script>

 <style type="text/css">
     #cke_Upload{
        display: none !important;
     }
     #cke_45{
        display: none;
     }
 </style>
@stop
