define(['Vue','Utils'],function(Vue,Utils) {
    var $ = require("jQuery");
    
    
    /**
    {
        "attrs": {
            "caption": "属性表",
            "RESTful" : true,
            "ajax" : true,// 用 Ajax 获取数据
            "uris" : {
                "query" : { // 列表接口
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
                    "method" : "DELETE"
                }
            },
            "rownum" : true, // 显示行号
            "hidden" : { // 隐藏的属性
                "id" : true
            },
            "operation" : true, // 是否有操作按钮
            "operations" : {
                "update" : true, // 预设 更新 和 删除 按钮
                "delete" : true,
                "addbind" : { // 其他按钮  table + {key} 的事件
                    "color" : "btn-success",
                    "text" : "+"
                }
            },
            "header": [// 表头
                {
                    "name": "属性名中",
                    "width":"200px" // 列宽
                },
                "属性名英",
                "数据类型"
            ]
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
          <template v-for="(item1,key1) in item">\
            <td v-if="tableConfig.attrs.hidden[key1]" class="hide">\
              <input type="hidden" :name="\'row-\' + key" :value="item1">\
            </td>\
            <td v-else>{{item1}}</td>\
          </template>\
          <template v-if="tableConfig.attrs.operation">\
            <td>\
              <div class="tools">\
                <template v-for="(item2,key2) in tableConfig.attrs.operations">\
                  <a v-if="key2 == \'update\'" :data-row="key" :data-id="item.id" @click.prevent="updateRecord" class="btn btn-primary btn-xs">U</a>\
                  <a v-else-if="key2 == \'delete\'" :data-row="key" :data-id="item.id" @click.prevent="deleteRecord" class="btn btn-danger btn-xs">D</a>\
                  <a v-else :data-row="key" :data-event="key2" :data-id="item.id" @click.prevent="btnclick" :class="item2.color" class="btn btn-xs">{{item2.text}}</a>\
                </template>\
              </div>\
            </td>\
          </template>\
        </tr>\
      </template>\
      </tbody>\
    </table>\
  </div><!-- /.box-body -->\
  <div class="box-footer clearfix">\
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
            return {
                tableConfig: this.dataSelector, 
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
            'updateRecord' : function(e){
                var row = e.target.getAttribute('data-row');
                var val = $(this.$el).find('[name=row-' + row + ']').val();
                var reqPa = this.parseAjaxParam(this.tableConfig.attrs.uris.update,{'id':val});
                var redirect = reqPa.url;
                window.location.href = redirect;
            },
            'deleteRecord' : function(e){
                // TODO confirm
                if(confirm('是否确定删除？')){
                    var row = e.target.getAttribute('data-row');
                    var val = $(this.$el).find('[name=row-'+row+']').val();
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
            'btnclick' : function(e){
                var emitEventType = e.target.getAttribute("data-event");
                this.$emit('table' + emitEventType,e);
            }
        },
        'mounted' : function(){
            var this$1 = this;
            var reqPa = this.parseAjaxParam(this.tableConfig.attrs.uris.query);
            var redirect = reqPa.url;
            this.tableConfig.attrs.ajax && !this$1.tableConfig.data.list.length && Utils.ajax({
                'url' : reqPa.url,
                'method' : reqPa.method,
//                'async' : false,
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
    });
    return Vue;
});
