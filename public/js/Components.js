define(['Vue','jQuery'],function(Vue,$) {
    Vue.component('common-form',{
        template : '\
<!-- general form elements -->\
<div class="box box-primary">\
  <div class="box-header with-border">\
    <h3 class="box-title">{{caption}}</h3>\
  </div><!-- /.box-header -->\
  <!-- form start -->\
  <form role="form">\
    <div class="box-body">\
      <template v-for="(item,index) in formConfig" >\
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
        'props' : ['caption'],
        'data' : function () {
            return {
                formConfig: this.$parent.formConfig, 
            };
        },
        'methods' : {
            'doFormValidate' : function(formSelector,inputData){
                var _form = $(formSelector);
                var fields = inputData.formConfig;
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
        },
    });
    return Vue;
});
