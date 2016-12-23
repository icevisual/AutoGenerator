define(['Vue','jQuery'],function(Vue,$) {
    
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
            <div class="progress progress-xs progress-striped active">
              <div class="progress-bar progress-bar-success" style="width: 90%"></div>
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
    
    Vue.component('common-form',{
        template : '\
<!-- general form elements -->\
<div class="box" :class="defaultValue(formConfig.attrs.formColor,\'box-primary\')" >\
  <div class="box-header with-border">\
    <h3 class="box-title">{{formConfig.attrs.caption}}</h3>\
  </div><!-- /.box-header -->\
  <!-- form start -->\
  <form role="form">\
    <div class="box-body">\
      <template v-for="(item,index) in formConfig.fields" >\
        <div class="form-group">\
          <label>{{item.name}}</label>\
          <template v-if="\'input\' == item.type">\
              <input v-model="item.value" :type="item.attrs.type" :placeholder="item.attrs.placeholder" :name="index" class="form-control" >\
          </template>\
          <template v-if="\'select\' == item.type">\
              <select v-model="item.value" :name="index" class="form-control">\
                  <option v-for="option in item.data" :value="option.value" >{{ option.text }}</option>\
              </select>\
          </template>\
        </div>\
      </template>\
    </div><!-- /.box-body -->\
    <div class="box-footer">\
      <button type="submit" class="btn btn-primary" v-on:click.prevent="btnclick" >Submit</button>\
    </div>\
  </form>\
</div><!-- /.box -->\
',
        'props' : ['caption','dataSelector'],
        'data' : function () {
            return {
                formConfig: this.dataSelector, 
            };
            console.log(this.dataSelector);
            return {
                formConfig: this.$parent[this.dataSelector], 
            };
        },
        'methods' : {
            'doFormValidate' : function(formSelector,inputData){
                var _form = $(formSelector);
                var fields = inputData.formConfig.fields;
                var ret = {};
                for(var key in fields){
                    var _valField = _form.find(fields[key].type + '[name='+key+']');
                    if(!_valField.val()){
                        _valField.focus();
                        return false;
                    }
                    ret[key] = _valField.val();
                }
                return ret;
            },
            'btnclick' : function(){
                this.$emit('btnclick',this.doFormValidate(this.$el,this.$data));
            },
            'defaultValue':function(v,d){
                return v?v:d;
            }
        },
    });
    return Vue;
});
