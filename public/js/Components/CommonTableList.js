define(['Vue','Utils'],function(Vue,Utils) {
    var $ = require("jQuery");
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
        </template>\
        <template v-if="tableConfig.attrs.operation">\
          <th>操作</th>\
        </template>\
      </tr>\
      <template v-for="(item,key) in tableConfig.data.list">\
        <tr>\
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
                <template v-for="(item,key2) in tableConfig.attrs.operations">\
                  <a v-if="key2 == \'update\'" :data-row="key" @click.prevent="updateRecord" class="btn btn-primary btn-xs">U</a>\
                  <a v-if="key2 == \'delete\'" :data-row="key" @click.prevent="deleteRecord" class="btn btn-danger btn-xs">D</a>\
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
            console.log(this.dataSelector);
            return {
                tableConfig: this.dataSelector, 
            };
        },
        'methods' : {
            'defaultValue':function(v,d){
                return v?v:d;
            },
            'updateRecord' : function(e){
                var row = e.target.getAttribute('data-row');
                var val = $(this.$el).find('[name=row-'+row+']').val();
//                var val = document.getElementsByName('row-' + row)[0].getAttribute('value');
                // this.tableConfig.attrs.uri
                var redirect = '/attrs/create/' + val ;
                window.location.href = redirect;
            },
            'deleteRecord' : function(e){
                console.log(arguments);
            }
        },
        'mounted' : function(){
            var this$1 = this;
            Utils.ajax({
                'url' : this.tableConfig.attrs.uri,
                'method' : "GET",
//                'async' : false,
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
