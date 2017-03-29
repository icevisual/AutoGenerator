@extends('backend.layouts.Template1')
@section('contentWrapper')
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            {{$layout['content-header']}}
            <small>{{$layout['content-header-small']}}</small>
          </h1>
          <ol class="breadcrumb hide">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">General Elements</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content" id="formDemo">
@foreach($layout['content'] as $row)
          <div class="row">
@foreach($row as $col)
            <div class="{{$col['col-class']}}">
@foreach($col['dcontent'] as $com)
              <{{$com['ele']}} :data-selector="pageConfig.{{$com['selector']}}"  ></{{$com['ele']}}>
@endforeach
            </div><!--/.col (right) -->
@endforeach
          </div>   <!-- /.row -->
@endforeach
        </section><!-- /.content -->
@stop


@section('javascript')
<script>
require(['initialize'], function(EVue) {
    var $ = require('jQuery'),
        Vue = require('Vue'),
        Utils = require('Utils');
    
    var d = {!!$formConfig!!}; 
    var pageConfig = d;
    if(undefined !== d['code'] && undefined !== d['data']){
        if(!Utils.apiReqSuccess(d)){
            return alert(Utils.apiReqMsg(d));
        }
        pageConfig = Utils.apiReqData(d);
    }

    var vmForm = new EVue({
        'el' : '#formDemo',
        'data' : {
            'pageConfig' : pageConfig ,
        },
        'methods' : {
            
        }
    });
})
</script>
@stop