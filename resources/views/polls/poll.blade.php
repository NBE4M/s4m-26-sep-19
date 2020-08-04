@extends('layouts/master')

@section('title', 'Polls - S4MCMS')

@section('content')
 
<div class="panel">
    <div class="panel-content filler">
        <div class="panel-logo"></div>
        <div class="panel-header">
            <h1><small>Polls</small></h1>
        </div>
        



        <script>
            $().ready(function () {
                $(".uniformRadio").uniform({
                    radioClass: 'uniformRadio'
                });

            });
        </script>
        <br><br>
        <div class="panel-header">
            <h1><small>Page Navigation Shortcuts</small></h1>
        </div>
        <script type="text/javascript">
            $(function () {
                $("#jstree").jstree({
                    "json_data": {
                        "data": [
                            {
                                "data": {
                                    "title": "Poll list",
                                    "attr": {"href": "#tableSortableResMed_wrapper"}
                                }
                            },
                        ]
                    },
                    "plugins": ["themes", "json_data", "ui"]
                })
                        .bind("click.jstree", function (event) {
                            var node = $(event.target).closest("li");
                            document.location.href = node.find('a').attr("href");
                            return false;
                        })
                        .delegate("a", "click", function (event, data) {
                            event.preventDefault();
                        });
            });
        </script>
        <div class="sidebarMenuHolder">
            <div class="JStree">
                <div class="Jstree_shadow_top"></div>
                <div id="jstree"></div>
                <div class="Jstree_shadow_bottom"></div>
            </div>
        </div>    </div>
    <div class="panel-slider">
        <div class="panel-slider-center">
            <div class="panel-slider-arrow"></div>
        </div>
    </div>
</div>
<div class="main-content">
    <div class="breadcrumb-container">
        <ul class="xbreadcrumbs">
            <li>
                <a href="dashboard.html">
                    <i class="icon-photon home"></i>
                </a>
            </li>
            <li class="current">
                <a href="javascript:;">Poll list</a>
            </li>
        </ul>
    </div>           <header>
        <i class="icon-big-notepad"></i>
        <h2><small>Poll list</small></h2>

    </header>

    <div class="container-fluid">

        <div class="">

        @if(empty($article_data[0]) )
        <form name="frmaddarticle" action="{{url('admin/polls')}}" method="post" class="form-horizontal">
            
        @else
        <form name="frmaddarticle" action="{{url('admin/polls').'/'.$article_data[0]->id}}" method="post" class="form-horizontal">
            {{ method_field('PUT') }}

        @endif

                {{csrf_field()}}

                @if(Session::has('alertmessage'))

                    <div class="alert {{Session::get('alert-class')}}">

                        {!!Form::button('X',['class'=>'close','data-dismiss'=>'alert'])!!}

                        {!!Form::label('msg',Session::get('alertmessage'),['class'=>'label'])!!}

                    </div>

                @endif
<input type="hidden" name="poll_id" id="poll_id" value="{{(empty($article_data[0]->id)) ? '' : $article_data[0]->id}}"/>
                <div class="col-md-10 ">

                    <div class="container-fluid">

                        <div class="box-header with-border ">

                            <h3 class="box-title">&nbsp;</h3>

                        </div>

                        <div class="box-body row-fluid">

                            <div class="form-group">

                                <div class="col-md-3" >

                                    {!!Form::label('title','Poll Title')!!}

                                    <span class="red">*</span>  

                                </div>
                                @if(isset($article_data[0]->id))
                                <div class="col-md-9">
                                {!!Form::text('title',$article_data[0]->title,['class'=>'form-control input-sm'])!!}
                        
                                    @if ($errors->has('title'))

                                        <span class="help-error">

                                            <strong>{{ $errors->first('title')}}</strong>

                                        </span>
                                    @endif    
                                </div>
                                
                                @else
                                <div class="col-md-9">
                                {!!Form::text('title',old('title'),['class'=>'form-control input-sm'])!!}

                                    @if ($errors->has('title'))

                                        <span class="help-error">

                                            <strong>{{ $errors->first('title')}}</strong>

                                        </span>

                                    @endif

                                </div>
                            @endif    
                            </div>

                            <div class="form-group">

                                <div class="col-md-3" >

                                    {!!Form::label('Slug','Poll Question')!!}

                                    <span class="red">*</span>  

                                </div>
                                @if(isset($article_data[0]->id))
                                <div class="col-md-9">
                                {!!Form::text('question',$article_data[0]->question,['class'=>'form-control input-sm'])!!}
                        
                                    @if ($errors->has('question'))

                                        <span class="help-error">

                                            <strong>{{ $errors->first('question')}}</strong>

                                        </span>
                                    @endif    
                                </div>
                                
                                @else
                                <div class="col-md-9">
                                {!!Form::text('question',old('question'),['class'=>'form-control input-sm'])!!}

                                    @if ($errors->has('question'))

                                        <span class="help-error">

                                            <strong>{{ $errors->first('question')}}</strong>

                                        </span>

                                    @endif

                                </div>
                            @endif    


                            </div>
  
<script>
$(document).ready(function(){
    
     var max_fields      = 20; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
    // alert('sssssssssss');
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class=""> <div><input class="form-control input-sm" type="text" name="answer[]"/><a href="#" class="remove_field">Remove</a></div></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
    
});
</script>
                            <div class="form-group input_fields_wrap">

                                <div class="col-md-3">
                                    {!!Form::label('answer','Answers')!!}                                       
                                </div>
                                <div class="col-md-9">
                                <div class="col-md-12">
                                
                                
                                
                                @if(count($answer) > 0)
                                
                                @foreach($answer as $key)
                                <div class="">
                                {!!Form::text("answer[$key->id]",$key->answer,['class'=>'form-control input-sm'])!!}
                                <a href="{{url('/').'/polls/answer/'.$key->id.'/remove'}}">Remove</a>
                            </div>
                                @endforeach
                                    @else

                                        <div class="">
                            {!!Form::text('answer[]',old('answer'),['class'=>'form-control input-sm'])!!}</div>

                                    @endif                      
                                </div>
                                

                            </div>
<br>
<br>
<br>
                             

                            <div class="form-group">

                                <div class="col-md-9 col-md-push-3">

                             
                                <input type="button" value="Add More Answer" class="btn btn-primary btn-flat add_field_button" />
                                @if(!empty($article_data[0]->id))

                                    <button type="submit" class="btn btn-primary btn-flat" >Update</button>

                                @else

                                    <button type="submit" class="btn btn-primary btn-flat" >Save</button>

                                @endif
 <a class="btn btn-primary btn-md btn-flat" id='addarticle' onclick="window.location='{{url('/admin/polls')}}'">Cancel</a>
                                 
                                    
                                    

                                </div>

                            </div>                      

                        </div>

                    </div>

                </div>

            </form>
        </div>

        <div class="">

        </div>

        <div class="">

            <!-- modal for replace related articles -->

            <div id="relarticle_modal" class="modal fade" role="dialog">

              <div class="modal-dialog">

                <div class="modal-content">

                  <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Select Article to Replace:</h4>

                  </div>

                  <div class="modal-body" id='relarticle_modal_body'>

                    

                  </div>

                </div>

              </div>

            </div>

        </div>

    </div>
</div>
@stop