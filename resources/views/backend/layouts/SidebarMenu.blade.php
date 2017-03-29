          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" id="sidebar-menu-vue">
            <template v-for="item in sidebar">
                <li class="header">@{{item.group}}</li>
                <template v-for="item1 in item.menus">
                    <li class="treeview" :class="item1.active ? 'active' : ''"> 
                      <a href="#">
                        <i :class="item1.icon" class="fa"></i> <span>@{{item1.title}}</span> <i class="fa fa-angle-left pull-right"></i>
                      </a>
                      <ul class="treeview-menu">
                        <template v-for="item2 in item1.submenus">
                            <li :class="item2.active ? 'active' : ''"><a :href="item2.href"><i :class="item2.icon" class="fa"></i> @{{item2.title}}</a></li>
                        </template>
                      </ul>
                    </li>
                </template>
            </template>
          </ul>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          