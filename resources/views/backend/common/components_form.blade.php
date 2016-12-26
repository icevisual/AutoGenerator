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
                        <common-table :data-selector="pageConfig.component_attrs_table" @tableremove="tableremove" ></common-table>
                    
                    
                        <div class="box">
                            <div class="box-header with-border">
                              <h3 class="box-title">Bordered Table</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                              <table class="table table-bordered">
                                <tr>
                                  <th style="width: 10px">#</th>
                                  <th>Task</th>
                                  <th>Progress</th>
                                  <th style="width: 40px">Label</th>
                                </tr>
                                <tr>
                                  <td>1.</td>
                                  <td>Update software</td>
                                  <td>
                                    <div class="progress progress-xs">
                                      <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                    </div>
                                  </td>
                                  <td><span class="badge bg-red">55%</span></td>
                                </tr>
                                <tr>
                                  <td>2.</td>
                                  <td>Clean database</td>
                                  <td>
                                    <div class="progress progress-xs">
                                      <div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
                                    </div>
                                  </td>
                                  <td><span class="badge bg-yellow">70%</span></td>
                                </tr>
                                <tr>
                                  <td>3.</td>
                                  <td>Cron job running</td>
                                  <td>
                                    <div class="progress progress-xs progress-striped active">
                                      <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
                                    </div>
                                  </td>
                                  <td><span class="badge bg-light-blue">30%</span></td>
                                </tr>
                                <tr>
                                  <td>4.</td>
                                  <td>Fix and squish bugs</td>
                                  <td>
                                  
                                  <div class="input-group input-group-sm">
                    <input type="text" class="form-control">
                    <span class="input-group-btn">
                      <button class="btn btn-info btn-flat" type="button">Go!</button>
                    </span>
                  </div>
                                  
                                  </td>
                                  <td><span class="badge bg-green">90%</span></td>
                                </tr>
                              </table>
                            </div><!-- /.box-body -->
                            <div class="box-footer clearfix">
                              <ul class="pagination pagination-sm no-margin pull-right">
                                <li><a href="#">&laquo;</a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">&raquo;</a></li>
                              </ul>
                            </div>
                          </div><!-- /.box -->
                    
                    </div>
                    
                    <div class="col-md-6">
                        <common-table :data-selector="pageConfig.component_attrs_table"  ></common-table>
                    </div>
                </div>
            </div><!--/.col (right) -->
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
@stop