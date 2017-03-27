@extends('backend.layouts.Template1')
@section('contentWrapper')
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            General Form Elements
            <small>Preview</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">General Elements</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content" id="formDemo">
          <div class="row">
            
            <div class="col-md-12">
                <common-table :data-selector="pageConfig.attrs_table"  ></common-table>
            </div>
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
@stop

@section('javascript')
<script>
require(['initialize'], function(EVue) {
    var $ = require('jQuery'),
        Vue = require('Vue'),
        Utils = require('Utils');
    
    var d = {!!$formConfig!!}; 
    var vmForm = new EVue({
        'el' : '#formDemo',
        'data' : {
            'pageConfig' : d ,
        },
        'methods' : {
            
        }
    });
})
</script>
@stop

