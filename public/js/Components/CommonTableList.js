define(['Vue'],function(Vue,$) {
    Vue.component('common-table',{
        template : '\
<div class="box">\
  <div class="box-header with-border">\
    <h3 class="box-title">{{tableConfig.attrs.caption}}</h3>\
  </div><!-- /.box-header -->\
  <div class="box-body">\
    <table class="table table-bordered">\
      <tbody>\
      <tr>\
        <template v-for="(item,key) in tableConfig.attrs.header">\
          <th :style="\'width:\' + item.width + \';\'">{{item.name}}</th>\
        </tmplate>\
      </tr>\
      <template v-for="(item,key) in tableConfig.list">\
        <tr>\
          <td>{{key + 1}}</td>\
          <template v-for="(item1,key1) in item">\
            <td>{{item1}}</td>\
          </tmplate>\
        </tr>\
      </tmplate>\
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
            }
        },
    });
    return Vue;
});
