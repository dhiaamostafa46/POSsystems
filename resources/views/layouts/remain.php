 



          @if(
            auth()->user()->role->permissions->contains('pageID', $pages->where('code','getItemsInvoice')->first()->id) ||
            auth()->user()->role->permissions->contains('pageID', $pages->where('code','createReceivePayments')->first()->id) ||
            auth()->user()->role->permissions->contains('pageID', $pages->where('code','createDeliverPayments')->first()->id)
            )
            @if(auth()->user()->organization->activity  ===3)
            <li class="nav-item @if(session('page')=='invoices') menu-open @endif">
              <a href="#" class="nav-link @if(session('page')=='invoices') active-page @endif">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  السندات
                  <i class="fas fa-angle-right left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','getItemsInvoice')->first()->id))
                <li class="nav-item">
                  <a href="#" onclick="createInvoice();" class="nav-link @if(session('sub-page')=='getItemsInvoice') active-sub-page @endif">
                    <i class="fa fa-file nav-icon"></i>
                    <p>نموذج استلام بضاعة</p>
                  </a>
                </li>
                @endif
              
              </ul>
            </li>
              @endif
            @endif



          @if(
          auth()->user()->role->permissions->contains('pageID', $pages->where('code','customersList')->first()->id) ||
          auth()->user()->role->permissions->contains('pageID', $pages->where('code','suppliersList')->first()->id)
          )
          <li class="nav-item @if(session('page')=='customers' || session('page')=='suppliers') menu-open @endif">
            <a href="#" class="nav-link @if(session('page')=='customers' || session('page')=='suppliers') active-page @endif">
              <i class="nav-icon fas fa-users"></i>
              <p>
                العملاء والموردين
                <i class="fas fa-angle-right left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','customersList')->first()->id))
              <li class="nav-item">
                <a href="{{route('customers.index')}}" class="nav-link @if(session('sub-page')=='customersList') active-sub-page @endif">
                  <i class="fa fa-users nav-icon"></i>
                  <p>قائمة العملاء</p>
                </a>
              </li>
              @endif
              @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','suppliersList')->first()->id))
              <li class="nav-item">
                <a href="{{route('suppliers.index')}}" class="nav-link @if(session('sub-page')=='suppliersList') active-sub-page @endif">
                  <i class="fa fa-user-secret nav-icon"></i>
                  <p>قائمة الموردين</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif

          <li class="nav-header text-white">الموارد البشرية والحسابات</li>
          @if(
          auth()->user()->role->permissions->contains('pageID', $pages->where('code','outcomesList')->first()->id) ||
          auth()->user()->role->permissions->contains('pageID', $pages->where('code','outcomesCreate')->first()->id) ||
          auth()->user()->role->permissions->contains('pageID', $pages->where('code','outcomesType')->first()->id))
          <li class="nav-item @if(session('page')=='outcomes') menu-open @endif">
            <a href="#" class="nav-link @if(session('page')=='outcomes') active-page @endif">
              <i class="nav-icon fas fa-book"></i>
              <p>
                المصروفات
                <i class="fas fa-angle-right left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','outcomesList')->first()->id))
              <li class="nav-item">
                <a href="{{route('outcomes.index')}}" class="nav-link @if(session('sub-page')=='outcomesList') active-sub-page @endif">
                  <i class="fa fa-list nav-icon"></i>
                  <p>سجل المصروفات</p>
                </a>
              </li>
              @endif
              @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','outcomesCreate')->first()->id))
              <li class="nav-item">
                <a href="{{route('outcomes.create')}}" class="nav-link @if(session('sub-page')=='outcomesCreate') active-sub-page @endif">
                  <i class="fa fa-credit-card	nav-icon"></i>
                  <p>اضافة مصروف</p>
                </a>
              </li>
              @endif
              @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','outcomesType')->first()->id))
              <li class="nav-item">
                <a href="{{route('outcomeCategories.index')}}" class="nav-link @if(session('sub-page')=='outcomesType') active-sub-page @endif">
                  <i class="fa fa-book nav-icon"></i>
                  <p>بنود المصروفات</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif



         
           @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','ReportAlLPage')->first()->id))
          <li class="nav-item">
            <a href="{{route('ReportAll.index')}}" class="nav-link @if(session('page')=='Report') active-page @endif">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                التقارير
              </p>
            </a>
          </li>
          @endif
         