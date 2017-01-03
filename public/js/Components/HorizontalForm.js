define(['Vue','jQuery','Utils'],function(Vue,$,Utils) {
    /**
    {
        "attrs": {
            "caption" : "新建组件属性",
            "formColor" : "box-warning",
            "buttons": {
                "preinstall": {
                    "submit": true,
                    "cancel": true
                },
                "others" : [{
                    "class" : "btn-info",
                    "event" : "other",
                    "name"  : "other"
                }]
            },
            "action" : { // form 属性
                "uri" : "/api/attr",
                "method" : "POST",
                "success" : {// form 提交成功 
                    "redirect" : "/attrs" // 成功跳转
                }
            }
        },
        "fields": {
            "attr_name_cn": {
                "name": "属性名字中", // 字段文本
                "type": "input",  // 类型 input select
                "validate" : {
                    "rules" : "sometimes",
                    "messages" : 
                },
                "attrs": { // 属性
                    "type": "text",
                    "default": "asdda",
                    "placeholder": "属性名字中"
                },
                "value": ""
            },
            "attr_name_cn": {
                "name": "属性名字中",
                "type": "input",
                "hidden" : true,
                "value": ""
            },
            "attr_type": {
                "name": "属性类别",
                "type": "select",
                "value": "string",
                "data": [
                    {
                        "value": "string",
                        "text": "string"
                    },
                    {
                        "value": "integer",
                        "text": "integer"
                    }
                ]
            }
        }
    }
    **/
    Vue.component('horizontal-form',{
        template : '\
<!-- Horizontal Form -->\
<div class="box box-info" :class="defaultValue(formConfig.attrs.formColor,\'box-primary\')" >\
  <div class="box-header with-border">\
    <h3 class="box-title">{{formConfig.attrs.caption}}</h3>\
  </div><!-- /.box-header -->\
  <!-- form start -->\
  <form class="form-horizontal" :action="formConfig.attrs.action.uri" :method="formConfig.attrs.action.method">\
    <div class="box-body">\
       <template v-for="(item,index) in formConfig.fields" >\
        <template v-if="item.hidden">\
          <input v-model="item.value" type="hidden" :name="index" >\
        </template>\
        <div v-else class="form-group">\
          <label class="col-sm-2 control-label">{{item.name}}</label>\
          <div class="col-sm-10">\
              <template v-if="\'input\' == item.type">\
                <input v-if="\'password\' == item.attrs.type" type="password" v-model="item.value" :placeholder="item.attrs.placeholder" :name="index" class="form-control" >\
                <input v-else-if="\'hidden\' == item.attrs.type" type="hidden" v-model="item.value" :placeholder="item.attrs.placeholder" :name="index" class="form-control" >\
                <input v-else type="text" v-model="item.value" :placeholder="item.attrs.placeholder" :name="index" class="form-control" >\
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
      <template v-for="(item,key,index) in formConfig.attrs.buttons.preinstall">\
         <button v-if="\'submit\' == key && item" type="submit" class="btn btn-info pull-right" :class="index > 0 ? \'margin-r-5\':\'\'" :data-event="key" v-on:click.prevent="doFormSubmit">Submit</button>\
         <button v-if="\'cancel\' == key && item" class="btn btn-default pull-right" :class="index > 0 ? \'margin-r-5\':\'\'" :data-event="key" v-on:click.prevent="btnclick">Cancel</button>\
      </template>\
      <template v-for="(item,key) in formConfig.attrs.buttons.others">\
         <button class="btn pull-right margin-r-5" :class="item.class" :data-event="item.event" v-on:click.prevent="btnclick">{{item.name}}</button>\
      </template>\
    </div><!-- /.box-footer -->\
  </form>\
</div><!-- /.box -->\
',
        'props' : ['dataSelector'],
        'data' : function () {
            var btnDefault = {
                'preinstall' : {
                    'submit' : true,
                    'cancel' : true,
                },
                'others' : []
            };
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
                    var _validate = fields[key]['validate'];
                    var _is_required = true;
                    if(undefined !== _validate){
                        var _rules = _validate['rules'];
                        var _rulesArray = [];
                        if(typeof _rules == 'string'){
                            _rulesArray = _rules.split('|');
                        }else{
                            _rulesArray = _rules;
                        }
                        if(_rulesArray[0] == 'sometimes'){
                            _is_required = false;
                        }
                    }
                    var _valField = _form.find(fields[key].type + '[name='+key+']');
                    if(_is_required && !_valField.val()){
                        _valField.focus();
                        return false;
                    }
                    ret[key] = _valField.val();
                }
                return ret;
            },
            'doFormSubmit' : function(){
                var formValidateRet = this.doFormValidate(this.$el,this.$data);
                if(formValidateRet !== false){
                    var this$1 = this;
                    $.ajax({
                        'url' : this.formConfig.attrs.action.uri,
                        'method' : this.formConfig.attrs.action.method,
                        'data' : formValidateRet,
                        'dataType' : 'json',
                        'success' : function(d){
                            if(Utils.apiReqSuccess(d)){
                                window.location.href = this$1.formConfig.attrs.action.success.redirect
                            }else{
                                alert(Utils.apiReqMsg(d));
                            }
                        },
                        'error' : function(d){
                            console.log(d);
                        }
                    });
                }
            },
            'btnclick' : function(e){
                var eventPrefix = 'form';
                var emitEventType = e.target.getAttribute("data-event");
                if('submit' == emitEventType){
                    this.$emit(eventPrefix + 'submit',this.doFormValidate(this.$el,this.$data),this.$data);
                }else{
                    this.$emit(eventPrefix + emitEventType,e);
                }
            },
            'defaultValue' : function(v,d){
                return v?v:d;
            }
        },
    });
    return Vue;
});
