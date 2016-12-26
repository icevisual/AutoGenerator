@extends('backend.layouts.template1')
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
            <!-- left column -->
            <div class="col-md-6">
              <horizontal-form :data-selector="pageConfig.component_form" @formsubmit="submitComponent" ></horizontal-form>
              
<!--               <horizontal-form :data-selector="pageConfig.attr_bind_form"  @formnewattr="NewAttrBtn" @formsubmit="bindNewAttr" ></horizontal-form> -->
            </div><!--/.col (left) -->
              
            <div class="col-md-6">
              <horizontal-form :data-selector="pageConfig.attr_form"   @formcancel="cancelAddNewAttr"   @formsubmit="addNewAttr" ></horizontal-form>
            
            </div><!--/.col (right) -->
            
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <common-table :data-selector="pageConfig.component_attrs_table"  ></common-table>
                    </div>
                    
                    <div class="col-md-6">
                        <common-table :data-selector="pageConfig.component_attrs_table"  ></common-table>
                    </div>
                </div>
            </div><!--/.col (right) -->
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
@stop