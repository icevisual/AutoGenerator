define(['Vue','Utils'],function(Vue,Utils) {
    var $ = require("jQuery");
    
    
    /**
    {
        "attrs": {
            "caption" : "属性表",// 列表的名称
            "RESTful" : true,   // 是否以 RESTful 分割处理接口，当前未使用 
            "ajax" : true,      // 是否自动用 Ajax 获取数据（调用 uris.query）
            "rownum" : true,    // 是否显示行号
            "pagination" : true,// 是否显示分页
            "operation" : true, // 是否渲染每行的操作按钮
            "data" : {
                "id" : 1
            },
            "uris" : {
                "query" : { // 预设列表接口
                    "url" : "/api/attrs",
                    "param" : [],
                    "method" : "GET"
                },
                "update" : {
                    "url" : "/attr/{id}",
                    "param" : ["id"],
                    "method" : "GET"
                },
                "delete" : {
                    "url" : "/api/{id}",
                    "param" : ["id"],
                    "method" : "DELETE",
                    "success" : {//成功后的动作
                        "redirect" : "/table",
                        "reload" : true,
                        "alert" : "OK"
                    }
                }
            },
            "hidden" : { // 隐藏的属性,需要判断是否为隐藏，所有要Object
                "id" : true
            },
            "headerTools" : [{//  列表头部的按钮
                "name" : "Submit",      // 按钮显示的标题
                "class" : "btn-info",   // 按钮的颜色
                "event" : "submit"      // 按钮触发的时间
            }],
            "advancedColumn" : {// 高级列渲染,需要判断是否为高级渲染，所有要Object
                "default_value" : { // 行-输入框
                    "type" : "input"
                }
            },
            "operations" : [{// 预设 更新 和 删除 按钮
                "class" : "btn-info",
                "name" : "U",
                "event" : "update"
            },{
                "class" : "btn-danger",
                "name" : "D",
                "event" : "delete"
            },{ // 其他按钮  table + {key} 的事件
                "class" : "btn-success",
                "name" : "+",
                "event" : "addbind"
            },{
                "name" : "DEPLOY",
                "class" : "btn-info",
                "event" : "redirect", // 预设 redirect 事件 ，已 uri 指向的地址做跳转
                "uri" : "deploy"
            }],
            "header": {// 表头和列表项,Key 用于指定对应的列表属性 Key
                "attr_name" : {
                    "name": "属性名中",
                    "width":"200px" // 列宽
                },
                "attr_type" : "属性名中",
                "data_type" : "数据类型"
            }
        },
        "data": {
            "total": 2, // 分页信息
            "current_page": 1,
            "last_page": 1,
            "per_page": 10,
            "list" : []
        }
    }
    **/
    Vue.component('common-table',{
        template : '\
<div class="box box-info">\
  <div class="box-header with-border">\
    <h3 class="box-title">{{tableConfig.attrs.caption}}</h3>\
      <div v-if="tableConfig.attrs.headerTools" class="pull-right box-tools">\
      <template v-for="(item,key) in tableConfig.attrs.headerTools">\
        <a v-if="0"></a>\
        <a v-else class="btn btn-sm" :data-position="\'headerTools\'" :data-key="key" :class="item.class" :data-event="item.event" v-on:click.prevent="btnclick">{{item.name}}</a>\
      </template>\
      </div>\
  </div><!-- /.box-header -->\
  <div class="box-body">\
    <table class="table table-bordered">\
      <tbody>\
      <tr>\
        <th v-if="tableConfig.attrs.rownum" style="width:10px;">#</th>\
        <template v-for="(item,key) in tableConfig.attrs.header">\
          <th v-if="\'string\' == typeof item">{{item}}</th>\
          <th v-else :style="\'width:\' + item.width + \';\'">{{item.name}}</th>\
        </template>\
        <template v-if="tableConfig.attrs.operation">\
          <th>操作</th>\
        </template>\
      </tr>\
      <template v-for="(item,key) in tableConfig.data.list">\
        <tr :data-id="item.id">\
          <td v-if="tableConfig.attrs.rownum">{{key + 1}}</td>\
          <template v-for="(item1,key1) in tableConfig.attrs.header">\
            <td v-if="tableConfig.attrs.hidden[key1]" class="hide">\
              <input type="hidden" :name="\'row-\' + key + \'-\' + key1" :value="item1">\
            </td>\
            <td v-else-if="tableConfig.attrs.advancedColumn && tableConfig.attrs.advancedColumn[key1]">\
              <template v-if="tableConfig.attrs.advancedColumn[key1].type == \'input\'">\
              <div class="input-group-sm">\
                <input type="text" v-model="item[key1]" class="form-control" :name="\'row-\' + key" :value="item1">\
              </div>\
              </template>\
            </td>\
            <td v-else>{{item[key1]}}</td>\
          </template>\
          <template v-if="tableConfig.attrs.operation">\
            <td>\
              <div class="tools">\
                <template v-for="(item2,key2) in tableConfig.attrs.operations">\
                  <template v-if="item2">\
                    <a v-if="0"></a>\
                    <a v-else :data-row="key" :data-key="key2" :data-position="\'operations\'" :data-event="item2.event" :data-id="item.id" @click.prevent="btnclick" :class="item2.class" class="btn btn-xs">{{item2.name}}</a>\
                  </template>\
                </template>\
              </div>\
            </td>\
          </template>\
        </tr>\
      </template>\
      </tbody>\
    </table>\
  </div><!-- /.box-body -->\
  <div v-if="tableConfig.attrs.pagination" class="box-footer clearfix">\
    <ul class="pagination pagination-sm no-margin pull-right">\
      <li><a href="#">&laquo;</a></li>\
      <li><a href="#">1</a></li>\
      <li><a href="#">2</a></li>\
      <li><a href="#">3</a></li>\
      <li><a href="#">&raquo;</a></li>\
    </ul>\
  </div>\
</div><!-- /.box -->\
',
        'props' : ['dataSelector'],
        'data' : function () {
            // 初始化 默认按钮配置
            var defaultBtnConfig = {
                "update" : {
                    "name" : "U",
                    "class" : "btn-primary",
                    "event" : "update"
                },
                "delete" : {
                    "name" : "D",
                    "class" : "btn-danger",
                    "event" : "delete"
                }
            };
            var inputData = this.dataSelector;
            // 按钮位置
            var btnPositionSet = ['headerTools','operations'];
            for(var i in btnPositionSet){
                for(var key in inputData['attrs'][btnPositionSet[i]]){
                    if(undefined !== defaultBtnConfig[key]){
                        if(true === inputData['attrs'][btnPositionSet[i]][key]){
                            // 设置了预设按钮，则将按钮配置设置为默认按钮配置
                            inputData['attrs'][btnPositionSet[i]][key] = defaultBtnConfig[key];
                        }
                    }
                }
            }
            return {
                tableConfig: inputData, 
            };
        },
        'methods' : {
            'parseAjaxParam' : function(cfg,params){
                var url = cfg.url;
                for(var i in cfg.param){
                    url = url.replace('{' + cfg.param[i] + '}',params[cfg.param[i]]);
                }
                return {
                    'url' : url,
                    'method' : cfg.method
                };
            },
            'defaultValue':function(v,d){
                return v?v:d;
            },
            'redirectWithUri' : function(uri,data){
                var reqPa = this.parseAjaxParam(uri,data);
                var redirect = reqPa.url;
                window.location.href = redirect;
            },
            'updateRecord' : function(e){
                var row = e.target.getAttribute('data-row');
                var val = e.target.getAttribute('data-id');
//                var val = $(this.$el).find('[name=row-' + row + ']').val();
                return this.redirectWithUri(this.tableConfig.attrs.uris.update,{'id':val});
                var reqPa = this.parseAjaxParam(this.tableConfig.attrs.uris.update,{'id':val});
                var redirect = reqPa.url;
                window.location.href = redirect;
            },
            'deleteRecord' : function(e){
                // TODO confirm
                if(confirm('是否确定删除？')){
                    var row = e.target.getAttribute('data-row');
                    var val = $(this.$el).find('[name=row-'+row+'-id]').val();
                    var reqPa = this.parseAjaxParam(this.tableConfig.attrs.uris.delete,{'id':val});
                    Utils.ajax({
                        'url' : reqPa.url ,
                        'method' : reqPa.method,
                        'success' : function(d){
                            if(Utils.apiReqSuccess(d)){
                                window.location.reload();
                            }else{
                                alert(Utils.apiReqMsg(d));
                            }
                        },
                        'error' : function(d){
                            console.log(arguments);
                        }
                    });
                }
            },
            'redirectTo' : function(e){
                var key         = e.target.getAttribute('data-key');
                var position    = e.target.getAttribute('data-position');
                var uriKey      = this.tableConfig.attrs[position][key].uri;
                var val         = e.target.getAttribute('data-id');
                if(!val){
                    val = this.tableConfig.attrs.data.id;
                }
                return this.redirectWithUri(this.tableConfig.attrs.uris[uriKey],{'id':val});
            },
            'isAutoHanding' : function(eventType){
                var eventMap = {
                    'redirect' : true,
                    'update' : true,
                    'delete' : true
                };
                return undefined !== eventMap[eventType];
            },
            'autoProcess' : function(eventType,e){
                switch(eventType){
                    case 'redirect':
                        return this.redirectTo(e);
                        break;
                    case 'update':
                        return this.updateRecord(e);
                        break;
                    case 'delete':
                        return this.deleteRecord(e);
                        break;
                    default:;
                }
            },
            'btnclick' : function(e){
                var eventPrefix = 'table';
                var emitEventType = e.target.getAttribute("data-event");
                var btnKey = e.target.getAttribute("data-key");
                console.log('emitEventType',emitEventType);
                if(this.isAutoHanding(emitEventType)){
                    this.autoProcess(emitEventType,e);
                }else{
                    this.$emit(eventPrefix + emitEventType,e);
                }
            },
        },
        'mounted' : function(){
            var this$1 = this;
            if(this.tableConfig.attrs.ajax){
                var reqPa = this.parseAjaxParam(this.tableConfig.attrs.uris.query);
                !this$1.tableConfig.data.list.length && Utils.ajax({
                    'url' : reqPa.url,
                    'method' : reqPa.method,
//                    'async' : false,
                    'success' : function(d){
                        if(Utils.apiReqSuccess(d)){
                            this$1.tableConfig.data = Utils.apiReqData(d);
                        }else{
                            alert(Utils.apiReqMsg(d));
                        }
                    },
                    'error' : function(d){
                        console.log(arguments);
                    }
                });
            }
        }
    });
    return Vue;
});
