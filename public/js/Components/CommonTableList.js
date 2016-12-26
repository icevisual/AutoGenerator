define(['Vue','Utils'],function(Vue,Utils) {
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
          <th :style="\'width:\' + item.width + \';\'">{{item.name}}</th>\
        </tmplate>\
      </tr>\
      <template v-for="(item,key) in tableConfig.data.list">\
        <tr>\
          <td v-if="tableConfig.attrs.rownum">{{key + 1}}</td>\
          <template v-for="(item1,key1) in item">\
            <td>{{item1}}</td>\
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
            console.log(this.dataSelector);
            return {
                tableConfig: this.dataSelector, 
            };
        },
        'methods' : {
            'defaultValue':function(v,d){
                return v?v:d;
            },
        },
        'mounted' : function(){
            var this$1 = this;
            Utils.ajax({
                'url' : this.tableConfig.attrs.uri,
                'method' : "GET",
                'success' : function(d){
                    console.log(d);
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
