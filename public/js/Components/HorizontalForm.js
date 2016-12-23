define(['Vue','jQuery'],function(Vue,$) {
    
    Vue.component('horizontal-form',{
        template : '\
<!-- Horizontal Form -->\
<div class="box box-info" :class="defaultValue(formConfig.attrs.formColor,\'box-primary\')" >\
  <div class="box-header with-border">\
    <h3 class="box-title">{{formConfig.attrs.caption}}</h3>\
  </div><!-- /.box-header -->\
  <!-- form start -->\
  <form class="form-horizontal">\
    <div class="box-body">\
       <template v-for="(item,index) in formConfig.fields" >\
        <div class="form-group">\
          <label class="col-sm-2 control-label">{{item.name}}</label>\
          <div class="col-sm-10">\
              <template v-if="\'input\' == item.type">\
                  <input v-model="item.value" :type="item.attrs.type" :placeholder="item.attrs.placeholder" :name="index" class="form-control" >\
              </template>\
              <template v-if="\'select\' == item.type">\
                  <select v-model="item.value" :name="index" class="form-control">\
                      <option v-for="option in item.data" :value="option.value" >{{ option.text }}</option>\
                  </select>\
              </template>\
          </div>\
        </div>\
      </template>\
    </div><!-- /.box-body -->\
    <div class="box-footer">\
      <button type="submit" class="btn btn-default">Cancel</button>\
      <button type="submit" class="btn btn-info pull-right" v-on:click.prevent="btnclick"  >Submit</button>\
    </div><!-- /.box-footer -->\
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
