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
      <template v-for="(item,key) in formConfig.attrs.buttons">\
        <template v-if="key > 0">\
            <button v-if="\'submit\' == item" type="submit" class="btn btn-info pull-right" :data-event="item" v-on:click.prevent="btnclick">Submit</button>\
            <button v-else type="submit" style="margin-right:5px;" class="btn btn-default pull-right" :data-event="item" v-on:click.prevent="btnclick">{{item}}</button>\
        </template>\
        <template v-else>\
            <button v-if="\'submit\' == item" type="submit" class="btn btn-info pull-right" :data-event="item" v-on:click.prevent="btnclick">Submit</button>\
            <button v-else type="submit" class="btn btn-default pull-right" :data-event="item" v-on:click.prevent="btnclick">{{item}}</button>\
        </template>\
      </template>\
    </div><!-- /.box-footer -->\
  </form>\
</div><!-- /.box -->\
',
        'props' : ['caption','dataSelector'],
        'data' : function () {
            
            var btnDefault = {
                'cancel' : true,
                'submit' : true,
            };
            var btnDefault = ['submit','cancel'];
            if(!this.dataSelector.attrs['buttons']){
                this.dataSelector.attrs['buttons'] = btnDefault;
            }
            return {
                formConfig: this.dataSelector, 
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
            'btnclick' : function(e){
                var emitEventType = e.target.getAttribute("data-event");
                if('submit' == emitEventType){
                    this.$emit('formsubmit',this.doFormValidate(this.$el,this.$data));
                }else{
                    this.$emit('form' + emitEventType,[]);
                }
            },
            'defaultValue':function(v,d){
                return v?v:d;
            }
        },
    });
    return Vue;
});
