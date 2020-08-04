@extends('layouts.sidebar')
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <link rel="shortcut icon" src="{{ asset('images/favicon.ico') }}" />
        <link rel="apple-touch-icon" src="{{ asset('images/iosicon.png') }}" />
        <link rel="stylesheet" href="{{ asset('build/output/final.css') }}" rel="stylesheet" media="all" />
        <link rel="stylesheet" type="text/css" href="{{ asset('cms/css/token-input-facebook.css') }}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{ asset('cms/css/dev.css') }}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{ asset('cms/css/jquery.fileupload.css') }}" media="all" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script type="text/javascript" src="{{ asset('cms/js/bootstrap/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/bootstrap/bootstrap-dialog.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/modernizr.custom.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/jquery.pnotify.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/less-1.3.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/xbreadcrumbs.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/jquery.maskedinput-1.3.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/jquery.autotab-1.1b.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/charCount.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/jquery.textareaCounter.js') }}"></script>
    <!-- <script type="text/javascript" src="{{ asset('cms/js/plugins/elrte.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/elrte.en.js') }}"></script> -->
        <script type="text/javascript" src="{{ asset('cms/js/plugins/select2.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/jquery-picklist.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/jquery.validate.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/jquery.validate.file.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/additional-methods.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/jquery.form.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/jquery.metadata.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/jquery.mockjax.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/jquery.uniform.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/jquery.tagsinput.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/jquery.rating.pack.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/farbtastic.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/jquery.timeentry.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/jquery.dataTables.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/jquery.jstree.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/dataTables.bootstrap.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/jquery.mousewheel.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/jquery.mCustomScrollbar.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/jquery.flot.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/jquery.flot.stack.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/jquery.flot.pie.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/jquery.flot.resize.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/raphael.2.1.0.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/justgage.1.0.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/jquery.qrcode.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/jquery.clock.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/jquery.countdown.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/jquery.jqtweet.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/jquery.cookie.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/bootstrap-fileupload.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/prettify/prettify.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/bootstrapSwitch.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/plugins/mfupload.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/common.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/jquery.tokeninput.js') }}"></script>
        <script type="text/javascript" src="{{ asset('cms/js/custom.js') }}"></script>
        <script src="{{url('')}}/cms/ckeditor/ckeditor.js"></script> 
        <!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>   -->
    </head>
    <body class="body-dashboard light-version">
        <div class="btn-toolbar btn-mobile-menus">
            <button class="btn btn-main-menu"></button>
            <button class="btn btn-user-menu"><i class="icon-logo"></i></button>
        </div>
        @if ($errors->any())
    <div class="alert alert-danger alert-dismissable custom-success-box" style="width:96%;margin-left: auto; text-align: center;position: absolute;z-index: 11">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <ul class="unstyled">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        @section('sidebar')
        @show
        <div class="container">
          @yield('content')
      </div>
      <div class="dashboard-watermark"></div>
    </body>
</html>
