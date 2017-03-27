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
            <div class="col-md-6">
              <horizontal-form :data-selector="pageConfig.table_form"  @formvalidate="submitTable"></horizontal-form>
              <common-table :data-selector="pageConfig.table" @tableremove="RemoveField" @tablemodify="UpdateField"></common-table>
            </div><!--/.col (left) -->
            <div class="col-md-6">
              <horizontal-form :data-selector="pageConfig.column_form" @formvalidate="AddColumn"></horizontal-form>
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
@stop