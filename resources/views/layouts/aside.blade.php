<aside class="main-sidebar sidebar-dark-primary elevation-4  no-print">
    <!-- Brand Logo -->
    <a href="#" class="brand-link bg-white">
        <img src="{{ asset('dist/img/logo.png') }}" alt="Evix System" style="opacity: .8;width:100%">
        <span class="brand-text font-weight-light"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/users/' . auth()->user()->img) }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <!--   ***********************************************   Dashboard   **************************************************************  -->
                <!--   ***********************************************   Dashboard   **************************************************************  -->
                <!--   ***********************************************   Dashboard   **************************************************************  -->
                <!--   ***********************************************   Dashboard   **************************************************************  -->
                <!--   ***********************************************   Dashboard   **************************************************************  -->
                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'homePage')->first()->id))
                    <li class="nav-item">
                        <a href="{{ route('admin.index') }}"
                            class="nav-link @if (session('page') == 'index') active-page @endif">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                {{ trans('admin.Dashboard') }}
                            </p>
                        </a>
                    </li>
                @endif









                <!--   ***********************************************  Operations Management   **************************************************************  -->
                <!--   ***********************************************  Operations Management   **************************************************************  -->
                <!--   ***********************************************  Operations Management   **************************************************************  -->
                <!--   ***********************************************  Operations Management   **************************************************************  -->
                <!--   ***********************************************  Operations Management   **************************************************************  -->
                @if (auth()->user()->organization->PackageList->where('end', '>', date('Y-m-d'))->contains('code', $package->where('nameEn', 'table')->first()->nameEn) ||
                        auth()->user()->organization->PackageList->where('end', '>', date('Y-m-d'))->contains('code', $package->where('nameEn', 'Respitewaste')->first()->nameEn) ||
                        auth()->user()->organization->PackageList->where('end', '>', date('Y-m-d'))->contains('code', $package->where('nameEn', 'stores')->first()->nameEn) ||
                        auth()->user()->organization->PackageList->where('end', '>', date('Y-m-d'))->contains('code', $package->where('nameEn', 'pos')->first()->nameEn)||
                        auth()->user()->organization->PackageList->where('end', '>', date('Y-m-d'))->contains('code', $package->where('nameEn', 'accounting')->first()->nameEn)
                        )

                    @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'productsCategory')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'productsList')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'itemsUnit')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'itemsUnit')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'tbls')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'drivethrus')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'kitchens')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'volume')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'Productcomponents')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'Storepage')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'convertStorepage')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'convertStorepage')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'Damagedinventory')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'billsDebit')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'purchasesList')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'suppliersList')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'Saleswindow')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'AllWaiterOrders')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'TodayOrders')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'WaiterPOS')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'WaiterOrders')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'billsList')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'OfferPricepage')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'billsCred')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'customersList')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'getItemsInvoice')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'createReceivePayments')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'createDeliverPayments')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'outcomesList')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'outcomesCreate')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'outcomesType')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'getItemsInvoice')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'createReceivePayments')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'pageAccountingGuide')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'pagecostcenters')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'pageJournal')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'pageEasyjournals')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'pageOpeningBalances')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'pageRoutAccount')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'VirtualAccount')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'ReportAlLPage')->first()->id))

                        <li class="nav-item @if (session('page') == 'products') menu-open @endif">
                            <a href="#" class="nav-link @if (session('page') == 'products') active-page @endif">
                                @prepend('scripts')
                                @endprepend
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    {{ trans('admin.OperationsManagement') }}


                                    <i class="fas fa-angle-right left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">


                                <!--   ***********************************************  Basicdata   **************************************************************  -->
                                <!--   ***********************************************  Basicdata   **************************************************************  -->
                                <!--   ***********************************************  Basicdata   **************************************************************  -->
                                <!--   ***********************************************  Basicdata   **************************************************************  -->
                                <!--   ***********************************************  Basicdata   **************************************************************  -->
                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'productsCategory')->first()->id) ||
                                        auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'productsList')->first()->id) ||
                                        auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'itemsUnit')->first()->id) ||
                                        auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'itemsUnit')->first()->id) ||
                                        auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'tbls')->first()->id) ||
                                        auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'drivethrus')->first()->id) ||
                                        auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'kitchens')->first()->id) ||
                                        auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'volume')->first()->id) ||
                                        auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'Productcomponents')->first()->id))

                                    <li class="nav-item @if (session('page') == 'products') menu-open @endif">
                                        <a href="#"
                                            class="nav-link @if (session('page') == 'products') active-page @endif">
                                            <i class="nav-icon fas fa-book"></i>
                                            <p>
                                                {{ trans('admin.Basicdata') }}


                                                <i class="fas fa-angle-right left"></i>
                                            </p>
                                        </a>

                                        <ul class="nav nav-treeview">
                                            @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'productsCategory')->first()->id))
                                                <li class="nav-item">
                                                    <a href="{{ route('prodcategories.index') }}"
                                                        class="nav-link @if (session('sub-page') == 'productsCategory') active-sub-page @endif">
                                                        <i class="fa fa-cubes	nav-icon"></i>
                                                        <p> {{ trans('admin.productsCategory') }}</p>


                                                    </a>
                                                </li>
                                            @endif
                                            @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'productsList')->first()->id))
                                                <li class="nav-item">
                                                    <a href="{{ route('products.index') }}"
                                                        class="nav-link @if (session('sub-page') == 'productsList') active-sub-page @endif">
                                                        <i class="fa fa-list nav-icon"></i>
                                                        <p> {{ trans('admin.listproducts') }}</p>
                                                    </a>
                                                </li>
                                            @endif



                                            @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'itemsUnit')->first()->id))
                                                <li class="nav-item">
                                                    <a href="{{ route('units.index') }}"
                                                        class="nav-link @if (session('sub-page') == 'itemsUnit') active-sub-page @endif">
                                                        <i class="fa fa-cube nav-icon"></i>
                                                        <p> {{ trans('admin.units') }} </p>
                                                    </a>
                                                </li>
                                            @endif

                                            @if (auth()->user()->organization->PackageList->where('end', '>', date('Y-m-d'))->contains('code', $package->where('nameEn', 'table')->first()->nameEn))
                                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'tbls')->first()->id) &&
                                                        auth()->user()->organization->activity == 2)
                                                    <li class="nav-item">
                                                        <a href="{{ route('tbls.index') }}"
                                                            class="nav-link @if (session('sub-page') == 'tbls') active-sub-page @endif">
                                                            <i class="fa fa-table nav-icon"></i>
                                                            <p> {{ trans('admin.tbls') }}</p>
                                                        </a>
                                                    </li>
                                                @endif

                                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'drivethrus')->first()->id) &&
                                                        auth()->user()->organization->activity == 2)
                                                    <li class="nav-item">
                                                        <a href="{{ route('drivethrus.index') }}"
                                                            class="nav-link @if (session('sub-page') == 'drivethrus') active-sub-page @endif">
                                                            <i class="fa fa-car nav-icon"></i>
                                                            <p> {{ trans('admin.drivethrus') }} </p>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'kitchens')->first()->id) &&
                                                        auth()->user()->organization->activity == 2)
                                                    <li class="nav-item">
                                                        <a href="{{ route('kitchens.index') }}"
                                                            class="nav-link @if (session('sub-page') == 'kitchens') active-sub-page @endif">
                                                            <i class="fa fa-coffee nav-icon"></i>
                                                            <p> {{ trans('admin.kitchens') }}</p>
                                                        </a>
                                                    </li>
                                                @endif
                                            @endif

                                            @if (auth()->user()->organization->PackageList->where('end', '>', date('Y-m-d'))->contains('code', $package->where('nameEn', 'Respitewaste')->first()->nameEn))
                                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'volume')->first()->id) &&
                                                        auth()->user()->organization->activity == 2)
                                                    <li class="nav-item">
                                                        <a href="{{ route('Volume.index') }}"
                                                            class="nav-link @if (session('sub-page') == 'Volume') active-sub-page @endif">
                                                            <i class="fa fa-table nav-icon"></i>
                                                            <p> {{ trans('admin.Volume') }} </p>
                                                        </a>
                                                    </li>
                                                @endif
                                            @endif

                                            @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'Productcomponents')->first()->id) &&
                                                    auth()->user()->organization->activity == 1)
                                                <li class="nav-item">
                                                    <a href="{{ route('Volume.index') }}"
                                                        class="nav-link @if (session('sub-page') == 'Volume') active-sub-page @endif">
                                                        <i class="fa fa-table nav-icon"></i>
                                                        <p> {{ trans('admin.Productcomponents') }} </p>
                                                    </a>
                                                </li>
                                            @endif


                                        </ul>
                                    </li>
                                @endif

                                <!--   ***********************************************  Stores   **************************************************************  -->
                                <!--   ***********************************************  Stores   **************************************************************  -->
                                <!--   ***********************************************  Stores   **************************************************************  -->
                                <!--   ***********************************************  Stores   **************************************************************  -->
                                <!--   ***********************************************  Stores   **************************************************************  -->
                                @if (auth()->user()->organization->PackageList->where('end', '>', date('Y-m-d'))->contains('code', $package->where('nameEn', 'stores')->first()->nameEn))
                                    @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'Storepage')->first()->id) ||
                                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'convertStorepage')->first()->id) ||
                                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'convertStorepage')->first()->id) ||
                                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'Damagedinventory')->first()->id))
                                        <li class="nav-item @if (session('page') == 'Stores') menu-open @endif">
                                            <a href="#"
                                                class="nav-link @if (session('page') == 'Stores') active-page @endif">
                                                <i class="nav-icon fas fa-book"></i>
                                                <p>
                                                    {{ trans('admin.Stock') }}

                                                    <i class="fas fa-angle-right left"></i>
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'Storepage')->first()->id))
                                                    <li class="nav-item">
                                                        <a href="{{ route('depotStore.index') }}"
                                                            class="nav-link @if (session('sub-page') == 'itemsStock') active-sub-page @endif">
                                                            <i class="fa fa-box nav-icon"></i>
                                                            <p> {{ trans('admin.Repository') }} </p>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="{{ route('StockDepot.index') }}"
                                                            class="nav-link @if (session('sub-page') == 'openStore') active-sub-page @endif">
                                                            <i class="fa fa-box nav-icon"></i>
                                                            <p> {{ trans('admin.StockDepot') }} </p>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'convertStorepage')->first()->id))
                                                    <li class="nav-item">
                                                        <a href="{{ route('StoreConversion.index') }}"
                                                            class="nav-link @if (session('sub-page') == 'StoreConversion') active-sub-page @endif">
                                                            <i class="fa fa-box nav-icon"></i>
                                                            <p> {{ trans('admin.Outgoingtransfer') }} </p>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'convertStorepage')->first()->id))
                                                    <li class="nav-item">
                                                        <a href="{{ route('Intransfers.index') }}"
                                                            class="nav-link @if (session('sub-page') == 'Intransfers') active-sub-page @endif">
                                                            <i class="fa fa-box nav-icon"></i>
                                                            <p> {{ trans('admin.Incomingtransfer') }} </p>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'Damagedinventory')->first()->id))
                                                    <li class="nav-item">
                                                        <a href="{{ route('Tainted.index') }}"
                                                            class="nav-link @if (session('sub-page') == 'TaintedStore') active-sub-page @endif">
                                                            <i class="fa fa-box nav-icon"></i>
                                                            <p> {{ trans('admin.Tainted') }}</p>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'Damagedinventory')->first()->id))
                                                    <li class="nav-item">
                                                        <a href="{{ route('Arrangement.index') }}"
                                                            class="nav-link @if (session('sub-page') == 'ArrangementStore') active-sub-page @endif">
                                                            <i class="fa fa-box nav-icon"></i>
                                                            <p> {{ trans('admin.Arrangement') }} </p>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'Damagedinventory')->first()->id) &&
                                                        auth()->user()->organization->activity == 2)
                                                    <li class="nav-item">
                                                        <a href="{{ route('Manufactur.index') }}"
                                                            class="nav-link @if (session('sub-page') == 'Manufactur') active-sub-page @endif">
                                                            <i class="fa fa-box nav-icon"></i>
                                                            <p> {{ trans('admin.Manufactur') }} </p>
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </li>
                                    @endif
                                @endif


                                <!--   ***********************************************  purchases   **************************************************************  -->
                                <!--   ***********************************************  purchases   **************************************************************  -->
                                <!--   ***********************************************  purchases   **************************************************************  -->
                                <!--   ***********************************************  purchases   **************************************************************  -->
                                <!--   ***********************************************  purchases   **************************************************************  -->
                                @if (auth()->user()->organization->PackageList->where('end', '>', date('Y-m-d'))->contains('code', $package->where('nameEn', 'pos')->first()->nameEn))
                                    @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'billsDebit')->first()->id) ||
                                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'purchasesList')->first()->id) ||
                                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'suppliersList')->first()->id))

                                        <li class="nav-item @if (session('page') == 'purchases') menu-open @endif">
                                            <a href="#"
                                                class="nav-link @if (session('page') == 'purchases') active-page @endif">
                                                <i class="nav-icon fa fa-cart-arrow-down"></i>
                                                <p>
                                                    {{ trans('admin.purchases') }}
                                                    <i class="fas fa-angle-right left"></i>
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">


                                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'purchasesList')->first()->id))
                                                    <li class="nav-item">
                                                        <a href="{{ route('purchases.index') }}"
                                                            class="nav-link @if (session('sub-page') == 'purchasesList') active-sub-page @endif">
                                                            <i class="fa fa-list nav-icon"></i>
                                                            <p> {{ trans('admin.Listpurchases') }} </p>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'billsDebit')->first()->id))
                                                    <li class="nav-item">
                                                        <a href="{{ route('debitorders.index') }}"
                                                            class="nav-link @if (session('sub-page') == 'billsDebit') active-sub-page @endif">
                                                            <i class="fa fa-tag nav-icon"></i>
                                                            <p> {{ trans('admin.PurchasesReturns') }} </p>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'suppliersList')->first()->id))
                                                    <li class="nav-item">
                                                        <a href="{{ route('suppliers.index') }}"
                                                            class="nav-link @if (session('sub-page') == 'suppliersList') active-sub-page @endif">
                                                            <i class="fa fa-user-secret nav-icon"></i>
                                                            <p> {{ trans('admin.suppliers') }} </p>
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </li>
                                    @endif
                                @endif

                                <!--   ***********************************************  Sales   **************************************************************  -->
                                <!--   ***********************************************  Sales   **************************************************************  -->
                                <!--   ***********************************************  Sales   **************************************************************  -->
                                <!--   ***********************************************  Sales   **************************************************************  -->
                                <!--   ***********************************************  Sales   **************************************************************  -->
                                @if (auth()->user()->organization->PackageList->where('end', '>', date('Y-m-d'))->contains('code', $package->where('nameEn', 'pos')->first()->nameEn))
                                    @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'Saleswindow')->first()->id) ||
                                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'AllWaiterOrders')->first()->id) ||
                                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'TodayOrders')->first()->id) ||
                                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'WaiterPOS')->first()->id) ||
                                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'WaiterOrders')->first()->id) ||
                                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'billsList')->first()->id) ||
                                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'OfferPricepage')->first()->id) ||
                                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'billsCred')->first()->id) ||
                                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'customersList')->first()->id))

                                        @if (auth()->user()->organization->activity !== 3)
                                            <li class="nav-item @if (session('page') == 'orders') menu-open @endif">
                                                <a href="#"
                                                    class="nav-link @if (session('page') == 'orders') active-page @endif">
                                                    <i class="nav-icon fa fa-cart-plus"></i>
                                                    <p>
                                                        {{ trans('admin.Sales') }}
                                                        <i class="fas fa-angle-right left"></i>
                                                    </p>
                                                </a>
                                                <ul class="nav nav-treeview">

                                                    @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'Saleswindow')->first()->id))
                                                        <li class="nav-item">
                                                            <a onclick="startDuration();"
                                                                class="nav-link @if (session('sub-page') == 'billsCreate') active-sub-page @endif">
                                                                <i class="fa fa-desktop nav-icon"></i>
                                                                <p> {{ trans('admin.PointofSale') }} </p>
                                                            </a>
                                                        </li>
                                                    @endif

                                                    @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'AllWaiterOrders')->first()->id) &&
                                                            auth()->user()->organization->activity == 2)
                                                        <li class="nav-item">
                                                            <a href="{{ route('Nadal.today') }}"
                                                                class="nav-link @if (session('sub-page') == 'Nadaltoday') active-sub-page @endif">
                                                                <i class="fa fa-list nav-icon"></i>
                                                                <p> {{ trans('admin.NadalOrders') }} </p>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'TodayOrders')->first()->id) &&
                                                            auth()->user()->organization->activity == 2)
                                                        <li class="nav-item">
                                                            <a href="{{ route('orders.today') }}"
                                                                class="nav-link @if (session('sub-page') == 'ordersToday') active-sub-page @endif">
                                                                <i class="fa fa-list nav-icon"></i>
                                                                <p> {{ trans('admin.todayOrder') }} </p>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'WaiterPOS')->first()->id) &&
                                                            auth()->user()->organization->activity == 2)
                                                        <li class="nav-item">
                                                            <a onclick="startNadelDuration();"
                                                                class="nav-link @if (session('sub-page') == 'NadalCreate') active-sub-page @endif">
                                                                <i class="fa fa-list nav-icon"></i>
                                                                <p> {{ trans('admin.PointofSaleNadel') }}</p>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'WaiterOrders')->first()->id) &&
                                                            auth()->user()->organization->activity == 2)
                                                        <li class="nav-item">
                                                            <a href="{{ route('Nadal.index') }}"
                                                                class="nav-link @if (session('sub-page') == 'Nadalbllls') active-sub-page @endif">
                                                                <i class="fa fa-list nav-icon"></i>
                                                                <p> {{ trans('admin.NadalOrder') }} </p>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'billsList')->first()->id))
                                                        <li class="nav-item">
                                                            <a href="{{ route('orders.index') }}"
                                                                class="nav-link @if (session('sub-page') == 'billsList') active-sub-page @endif">
                                                                <i class="fa fa-list nav-icon"></i>
                                                                <p> {{ trans('admin.ListOrder') }} </p>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'billsList')->first()->id))
                                                        <li class="nav-item">
                                                            <a href="{{ route('OrderInvoices.index') }}"
                                                                class="nav-link @if (session('sub-page') == 'Salesinvoice') active-sub-page @endif">
                                                                <i class="fa fa-list nav-icon"></i>
                                                                <p> {{ trans('admin.ListOrderSale') }} </p>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'OfferPricepage')->first()->id) &&
                                                            auth()->user()->organization->activity == 1)
                                                        <li class="nav-item">
                                                            <a href="{{ route('OfferPrice.index') }}"
                                                                class="nav-link @if (session('sub-page') == 'OfferPrice') active-sub-page @endif">
                                                                <i class="fa fa-list nav-icon"></i>
                                                                <p> {{ trans('admin.priceoffer') }} </p>
                                                            </a>
                                                        </li>
                                                    @endif

                                                    @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'billsCred')->first()->id))
                                                        <li class="nav-item">
                                                            <a href="{{ route('credorders.index') }}"
                                                                class="nav-link @if (session('sub-page') == 'billsCred') active-sub-page @endif">
                                                                <i class="fa fa-tag nav-icon"></i>
                                                                <p> {{ trans('admin.SalesReturns') }} </p>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'customersList')->first()->id))
                                                        <li class="nav-item">
                                                            <a href="{{ route('customers.index') }}"
                                                                class="nav-link @if (session('sub-page') == 'customersList') active-sub-page @endif">
                                                                <i class="fa fa-users nav-icon"></i>
                                                                <p> {{ trans('admin.customers') }} </p>
                                                            </a>
                                                        </li>
                                                    @endif

                                                </ul>
                                            </li>
                                        @endif
                                    @endif
                                @endif
                                <!--   ***********************************************  Treasurysandbanks   **************************************************************  -->
                                <!--   ***********************************************  Treasurysandbanks   **************************************************************  -->
                                <!--   ***********************************************  Treasurysandbanks   **************************************************************  -->
                                <!--   ***********************************************  Treasurysandbanks   **************************************************************  -->
                                <!--   ***********************************************  Treasurysandbanks   **************************************************************  -->
                                @if (auth()->user()->organization->PackageList->where('end', '>', date('Y-m-d'))->contains('code', $package->where('nameEn', 'accounting')->first()->nameEn))
                                    @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'getItemsInvoice')->first()->id) ||
                                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'createReceivePayments')->first()->id) ||
                                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'createDeliverPayments')->first()->id) ||
                                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'outcomesList')->first()->id) ||
                                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'outcomesCreate')->first()->id) ||
                                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'outcomesType')->first()->id) ||
                                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'getItemsInvoice')->first()->id) ||
                                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'createReceivePayments')->first()->id))
                                        @if (auth()->user()->organization->activity !== 3)
                                            <li class="nav-item @if (session('page') == 'invoices') menu-open @endif">
                                                <a href="#"
                                                    class="nav-link @if (session('page') == 'invoices') active-page @endif">
                                                    <i class="nav-icon fas fa-copy"></i>
                                                    <p>
                                                        {{ trans('admin.Treasurysandbanks') }}
                                                        <i class="fas fa-angle-right left"></i>
                                                    </p>
                                                </a>
                                                <ul class="nav nav-treeview">
                                                    @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'createReceivePayments')->first()->id))
                                                        <li class="nav-item">
                                                            <a href="{{ route('Sinadat.indexReceive') }}"
                                                                class="nav-link @if (session('sub-page') == 'createReceivePayments') active-sub-page @endif">
                                                                <i class="fa fa-file nav-icon"></i>
                                                                <p> {{ trans('admin.sinadatbonds') }} </p>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'createDeliverPayments')->first()->id))
                                                        <li class="nav-item">
                                                            <a href="{{ route('Sinadat.indexDeliver') }}"
                                                                class="nav-link @if (session('sub-page') == 'createDeliverPayments') active-sub-page @endif">
                                                                <i class="fa fa-file nav-icon"></i>
                                                                <p> {{ trans('admin.sinadatCashing') }} </p>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    <li
                                                        class="nav-item @if (session('page') == 'outcomes') menu-open @endif">
                                                        <a href="#"
                                                            class="nav-link @if (session('page') == 'outcomes') active-page @endif">
                                                            <i class="nav-icon fas fa-book"></i>
                                                            <p>
                                                                {{ trans('admin.Outcomes') }}
                                                                <i class="fas fa-angle-right left"></i>
                                                            </p>
                                                        </a>
                                                        <ul class="nav nav-treeview">
                                                            @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'outcomesList')->first()->id))
                                                                <li class="nav-item">
                                                                    <a href="{{ route('Expenses.index') }}"
                                                                        class="nav-link @if (session('sub-page') == 'outcomesList') active-sub-page @endif">
                                                                        <i class="fa fa-list nav-icon"></i>
                                                                        <p> {{ trans('admin.ListOutcomes') }} </p>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            {{-- @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'outcomesCreate')->first()->id))
                                                                <li class="nav-item">
                                                                    <a href="{{ route('outcomes.create') }}"
                                                                        class="nav-link @if (session('sub-page') == 'outcomesCreate') active-sub-page @endif">
                                                                        <i class="fa fa-credit-card	nav-icon"></i>
                                                                        <p> {{ trans('admin.AddOutcomes') }} </p>
                                                                    </a>
                                                                </li>
                                                            @endif --}}
                                                            @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'outcomesType')->first()->id))
                                                                <li class="nav-item">
                                                                    <a href="{{ route('outcomeCategories.index') }}"
                                                                        class="nav-link @if (session('sub-page') == 'outcomesType') active-sub-page @endif">
                                                                        <i class="fa fa-book nav-icon"></i>
                                                                        <p> {{ trans('admin.outcomeCategories') }} </p>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </li>
                                                    @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'getItemsInvoice')->first()->id))
                                                        <li class="nav-item">
                                                            <a href="{{ route('Treasury.index') }}"
                                                                class="nav-link @if (session('sub-page') == 'getItemsInvoice') active-sub-page @endif">
                                                                <i class="fa fa-file nav-icon"></i>
                                                                <p> {{ trans('admin.Treasury') }}</p>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'createReceivePayments')->first()->id))
                                                        <li class="nav-item">
                                                            <a href="{{ route('Bank.index') }}"
                                                                class="nav-link @if (session('sub-page') == 'createReceivePayments') active-sub-page @endif">
                                                                <i class="fa fa-file nav-icon"></i>
                                                                <p> {{ trans('admin.Bank') }} </p>
                                                            </a>
                                                        </li>
                                                    @endif

                                                </ul>
                                            </li>
                                        @endif
                                    @endif
                                @endif




                                <!--   ***********************************************  bank   **************************************************************  -->
                                <!--   ***********************************************  bank   **************************************************************  -->
                                <!--   ***********************************************  bank   **************************************************************  -->
                                <!--   ***********************************************  bank   **************************************************************  -->
                                <!--   ***********************************************  bank   **************************************************************  -->
                                @if (auth()->user()->organization->PackageList->where('end', '>', date('Y-m-d'))->contains('code', $package->where('nameEn', 'accounting')->first()->nameEn))
                                    @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'pageAccountingGuide')->first()->id) ||
                                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'pagecostcenters')->first()->id) ||
                                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'pageJournal')->first()->id) ||
                                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'pageEasyjournals')->first()->id) ||
                                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'pageOpeningBalances')->first()->id) ||
                                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'pageRoutAccount')->first()->id) ||
                                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'VirtualAccount')->first()->id))
                                        <li class="nav-item @if (session('page') == 'AccountingGuide') menu-open @endif">
                                            <a href="#"
                                                class="nav-link @if (session('page') == 'AccountingGuide') active-page @endif">

                                                <i class="fa fa-folder"></i>
                                                <p>
                                                    {{ trans('admin.accounts') }}
                                                    <i class="fas fa-angle-right left"></i>
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'pageAccountingGuide')->first()->id))
                                                    <li class="nav-item">
                                                        <a href="{{ route('AccountingGuide.index') }}"
                                                            class="nav-link @if (session('sub-page') == 'pageAccountingGuide') active-sub-page @endif">
                                                            <i class="fa fa-folder-open"></i>
                                                            <p> {{ trans('admin.calculationguide') }} </p>
                                                        </a>
                                                    </li>
                                                @endif

                                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'pagecostcenters')->first()->id))
                                                    <li class="nav-item">
                                                        <a href="{{ route('costcenters.index') }}"
                                                            class="nav-link @if (session('sub-page') == 'pagecostcenters') active-sub-page @endif">
                                                            <i class="fa fa-folder-open"></i>
                                                            <p> {{ trans('admin.costcenters') }} </p>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'pageJournal')->first()->id))
                                                    <li class="nav-item">
                                                        <a href="{{ route('journals.index') }}"
                                                            class="nav-link @if (session('sub-page') == 'pageJournal') active-sub-page @endif">
                                                            <i class="fa fa-folder-open"></i>
                                                            <p> {{ trans('admin.journals') }} </p>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'pageEasyjournals')->first()->id))
                                                    <li class="nav-item">
                                                        <a href="{{ route('Easyjournals.index') }}"
                                                            class="nav-link @if (session('sub-page') == 'pageEasyjournals') active-sub-page @endif">
                                                            <i class="fa fa-folder-open"></i>
                                                            <p> {{ trans('admin.Easyjournals') }}</p>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'pageOpeningBalances')->first()->id))
                                                    <li class="nav-item">
                                                        <a href="{{ route('OpeningBalances.index') }}"
                                                            class="nav-link @if (session('sub-page') == 'pageOpeningBalances') active-sub-page @endif">
                                                            <i class="fa fa-folder-open"></i>
                                                            <p> {{ trans('admin.OpeningBalances') }} </p>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'pageRoutAccount')->first()->id))
                                                    <li class="nav-item">
                                                        <a href="{{ route('RoutAccount.index') }}"
                                                            class="nav-link @if (session('sub-page') == 'pageRoutAccount') active-sub-page @endif">
                                                            <i class="fa fa-folder-open"></i>
                                                            <p> {{ trans('admin.RoutAccount') }}</p>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'VirtualAccount')->first()->id))
                                                    <li class="nav-item">
                                                        <a href="{{ route('VirtualAccounts.index') }}"
                                                            class="nav-link @if (session('sub-page') == 'VirtualAccount') active-sub-page @endif">
                                                            <i class="fa fa-folder-open"></i>
                                                            <p> {{ trans('admin.VirtualAccounts') }} </p>
                                                        </a>
                                                    </li>
                                                @endif

                                            </ul>
                                        </li>
                                    @endif
                                @endif
                                <!--   ***********************************************  Reports   **************************************************************  -->
                                <!--   ***********************************************  Reports   **************************************************************  -->
                                <!--   ***********************************************  Reports   **************************************************************  -->
                                <!--   ***********************************************  Reports   **************************************************************  -->
                                <!--   ***********************************************  Reports   **************************************************************  -->
                                @if (auth()->user()->organization->PackageList->where('end', '>', date('Y-m-d'))->contains('code', $package->where('nameEn', 'pos')->first()->nameEn) ||
                                        auth()->user()->organization->PackageList->where('end', '>', date('Y-m-d'))->contains('code', $package->where('nameEn', 'accounting')->first()->nameEn) ||
                                        auth()->user()->organization->PackageList->where('end', '>', date('Y-m-d'))->contains('code', $package->where('nameEn', 'stores')->first()->nameEn))
                                    @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'ReportAlLPage')->first()->id))
                                        <li class="nav-item">
                                            <a href="{{ route('ReportAll.index') }}"
                                                class="nav-link @if (session('page') == 'Report') active-page @endif">
                                                <i class="nav-icon fas fa-chart-pie"></i>
                                                <p>
                                                    {{ trans('admin.Reports') }}
                                                </p>
                                            </a>
                                        </li>
                                    @endif
                                @endif



                            </ul>
                        </li>


                    @endif
                @endif


                <!--   ***********************************************  HR   **************************************************************  -->
                <!--   ***********************************************  HR   **************************************************************  -->
                <!--   ***********************************************  HR   **************************************************************  -->
                <!--   ***********************************************  HR   **************************************************************  -->
                <!--   ***********************************************  HR   **************************************************************  -->
                {{-- //  @dd(auth()->user()->organization->PackageList  ) --}}
                @if (auth()->user()->organization->PackageList->where('end', '>', date('Y-m-d'))->contains('code', $package->where('nameEn', 'HR')->first()->nameEn))
                    @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'employees')->first()->id))

                        <li class="nav-item @if (session('page') == 'HR') menu-open @endif">
                            <a href="#"
                                class="nav-link @if (session('page') == 'HR') active-page @endif">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                    {{ trans('admin.HR') }}
                                    <i class="fas fa-angle-right left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'EmployeesAttendance')->first()->id))
                                    <li class="nav-item">
                                        <a href="{{ route('employees.index') }}"
                                            class="nav-link @if (session('sub-page') == 'employees') active-sub-page @endif">
                                            <i class="fa fa-bookmark nav-icon"></i>
                                            <p> {{ trans('admin.employees') }} </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('employees.salaries') }}"
                                            class="nav-link @if (session('sub-page') == 'salaries') active-sub-page @endif">
                                            <i class="fa fa-bookmark nav-icon"></i>
                                            <p> {{ trans('admin.Salaries') }} </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('employees.payrolls') }}"
                                            class="nav-link @if (session('sub-page') == 'payrolls') active-sub-page @endif">
                                            <i class="fa fa-bookmark nav-icon"></i>
                                            <p> {{ trans('admin.payrolls') }} </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('Task.index') }}"
                                            class="nav-link @if (session('sub-page') == 'Task') active-sub-page @endif">
                                            <i class="fa fa-bookmark nav-icon"></i>
                                            <p>{{ trans('admin.Task') }} </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('notices.index') }}"
                                            class="nav-link @if (session('sub-page') == 'notics') active-sub-page @endif">
                                            <i class="fa fa-bookmark nav-icon"></i>
                                            <p>{{ trans('admin.notice') }} </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('employees.documents') }}"
                                            class="nav-link @if (session('sub-page') == 'documents') active-sub-page @endif">
                                            <i class="fa fa-bookmark nav-icon"></i>
                                            <p>{{ trans('admin.documents') }} </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('employees.contracts') }}"
                                            class="nav-link @if (session('sub-page') == 'contracts') active-sub-page @endif">
                                            <i class="fa fa-bookmark nav-icon"></i>
                                            <p> {{ trans('admin.contracts') }} </p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route('penalties.index') }}"
                                            class="nav-link @if (session('sub-page') == 'payrolls') active-sub-page @endif">
                                            <i class="fa fa-bookmark nav-icon"></i>
                                            <p> {{ trans('admin.Punishmentsandpenalties') }} </p>
                                        </a>
                                    </li>
                                @endif
                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'EmployeesAttendance')->first()->id))
                                    <li class="nav-item">
                                        <a href="{{ route('attendance.index') }}"
                                            class="nav-link @if (session('sub-page') == 'attendances') active-sub-page @endif">
                                            <i class="fa fa-bookmark nav-icon"></i>
                                            <p> {{ trans('admin.Attendances') }} </p>
                                        </a>
                                    </li>
                                @endif
                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'empAttendIndex')->first()->id) &&
                                        !auth()->user()->empID == 0)
                                    <li class="nav-item">
                                        <a href="{{ route('Task.empindex') }}"
                                            class="nav-link @if (session('sub-page') == 'Task') active-sub-page @endif">
                                            <i class="fa fa-bookmark nav-icon"></i>
                                            <p>{{ trans('admin.Task') }} </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('attendance.empAttendance') }}"
                                            class="nav-link @if (session('sub-page') == 'employees') active-sub-page @endif">
                                            <i class="fa fa-bookmark nav-icon"></i>
                                            <p> {{ trans('admin.audience') }} </p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route('holydays.empIndex') }}"
                                            class="nav-link @if (session('sub-page') == 'employees') active-sub-page @endif">
                                            <i class="fa fa-bookmark nav-icon"></i>
                                            <p> {{ trans('admin.Leaverequests') }} </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('absenceRequests.empAbsence') }}"
                                            class="nav-link @if (session('sub-page') == 'employees') active-sub-page @endif">
                                            <i class="fa fa-bookmark nav-icon"></i>
                                            <p> {{ trans('admin.Permissionrequests') }} </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('advances.empIndex') }}"
                                            class="nav-link @if (session('sub-page') == 'employees') active-sub-page @endif">
                                            <i class="fa fa-bookmark nav-icon"></i>
                                            <p> {{ trans('admin.Salafis') }} </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('castodies.custodiesByID', auth()->user()->empID) }}"
                                            class="nav-link @if (session('sub-page') == 'empCastody') active-sub-page @endif">
                                            <i class="fa fa-bookmark nav-icon"></i>
                                            <p>{{ trans('admin.custodies') }} </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('castodies.empcustRequests') }}"
                                            class="nav-link @if (session('sub-page') == 'empCustReturn') active-sub-page @endif">
                                            <i class="fa fa-bookmark nav-icon"></i>
                                            <p> {{ trans('admin.Covenantdeliveryrequests') }} </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('custodies.moveableCustodByID', auth()->user()->empID) }}"
                                            class="nav-link @if (session('sub-page') == 'empMoveableCust') active-sub-page @endif">
                                            <i class="fa fa-bookmark nav-icon"></i>
                                            <p> {{ trans('admin.MobileCovenant(vehicles)') }} </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('notics.empIndex') }}"
                                            class="nav-link @if (session('sub-page') == 'payrolls') active-sub-page @endif">
                                            <i class="fa fa-bookmark nav-icon"></i>
                                            <p>{{ trans('admin.notice') }} </p>
                                        </a>
                                    </li>
                                @endif
                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'EmployeesAttendance')->first()->id))
                                    <li class="nav-item @if (session('sub-second-page') == 'custodies') menu-open @endif">
                                        <a href="#"
                                            class="nav-link @if (session('sub-page') == 'custodies') active-sub-page @endif">
                                            <i class="fa fa-bookmark nav-icon"></i>
                                            <p> {{ trans('admin.custodies') }}

                                                <i class="fas fa-angle-right left"></i>
                                            </p>
                                        </a>

                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="{{ route('castodies.index') }}"
                                                    class="nav-link @if (session('sub-page') == 'custodies') active-sub-page @endif">
                                                    <i class="fa fa-bookmark nav-icon"></i>
                                                    <p> {{ trans('admin.Staffera') }} </p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('castodies.movableCastodies') }}"
                                                    class="nav-link @if (session('sub-page') == 'movableCastodies') active-sub-page @endif">
                                                    <i class="fa fa-bookmark nav-icon"></i>
                                                    <p> {{ trans('admin.MobileCovenant') }} </p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('castodies.custReturnReq') }}"
                                                    class="nav-link @if (session('sub-page') == 'custRequest') active-sub-page @endif">
                                                    <i class="fa fa-bookmark nav-icon"></i>
                                                    <p> {{ trans('admin.Covenantdeliveryrequests') }} </p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item @if (session('sub-second-page') == 'assets') menu-open @endif">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-bookmark nav-icon"></i>
                                            <p> {{ trans('admin.Assets') }}

                                                <i class="fas fa-angle-right left"></i>
                                            </p>
                                        </a>

                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="{{ route('cars.index') }}"
                                                    class="nav-link @if (session('sub-page') == 'cars') active-sub-page @endif">
                                                    <i class="fa fa-bookmark nav-icon"></i>
                                                    <p> {{ trans('admin.Vehicles') }}</p>
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="{{ route('assetses.index') }}"
                                                    class="nav-link @if (session('sub-page') == 'assets') active-sub-page @endif">
                                                    <i class="fa fa-bookmark nav-icon"></i>
                                                    <p> {{ trans('admin.Otherassets') }} </p>
                                                </a>
                                            </li>

                                        </ul>
                                    </li>
                                    <li class="nav-item @if (session('page') == 'Requests') menu-open @endif">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-bookmark nav-icon"></i>
                                            <p>
                                                {{ trans('admin.Requests') }}
                                                <i class="fas fa-angle-right left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="{{ route('holydays.index') }}"
                                                    class="nav-link @if (session('sub-page') == 'holidayRequests') active-sub-page @endif">
                                                    <i class="fa fa-bookmark nav-icon"></i>
                                                    <p> {{ trans('admin.Leaverequests') }} </p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('absenceRequests.index') }}"
                                                    class="nav-link @if (session('sub-page') == 'absenceRequests') active-sub-page @endif">
                                                    <i class="fa fa-bookmark nav-icon"></i>
                                                    <p> {{ trans('admin.Permissionrequests') }} </p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('advances.index') }}"
                                                    class="nav-link @if (session('sub-page') == 'custodies') active-sub-page @endif">
                                                    <i class="fa fa-bookmark nav-icon"></i>
                                                    <p>{{ trans('admin.Salafis') }} </p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>


                                    <li class="nav-item @if (session('sub-second-page') == 'HRSettings') menu-open @endif">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa fa-cogs"></i>
                                            <p>
                                                {{ trans('admin.Settings') }}
                                                <i class="fas fa-angle-right left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="{{ route('employees.departments') }}"
                                                    class="nav-link @if (session('sub-page') == 'departments') active-sub-page @endif">
                                                    <i class="fa fa-list nav-icon"></i>
                                                    <p> {{ trans('admin.departments') }} </p>
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="{{ route('employees.jobs') }}"
                                                    class="nav-link @if (session('sub-page') == 'jobs') active-sub-page @endif">
                                                    <i class="fa fa-list nav-icon"></i>
                                                    <p> {{ trans('admin.jobs') }} </p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('employees.allowances') }}"
                                                    class="nav-link @if (session('sub-page') == 'allowances') active-sub-page @endif">
                                                    <i class="fa fa-list nav-icon"></i>
                                                    <p> {{ trans('admin.allowances') }} </p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('attendance.shifts') }}"
                                                    class="nav-link @if (session('sub-page') == 'shifts') active-sub-page @endif">
                                                    <i class="fa fa-list nav-icon"></i>

                                                    <p> {{ trans('admin.shifts') }} </p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('notics.types') }}"
                                                    class="nav-link @if (session('sub-page') == 'shifts') active-sub-page @endif">
                                                    <i class="fa fa-list nav-icon"></i>
                                                    <p> {{ trans('admin.noticeType') }} </p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('Decmentype.index') }}"
                                                    class="nav-link @if (session('sub-page') == 'Decmentype') active-sub-page @endif">
                                                    <i class="fa fa-list nav-icon"></i>
                                                    <p> {{ trans('admin.typedecument') }} </p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('assetses.types') }}"
                                                    class="nav-link @if (session('sub-page') == 'assetsTypes') active-sub-page @endif">
                                                    <i class="fa fa-list nav-icon"></i>
                                                    <p> {{ trans('admin.Typesofassets') }} </p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('holydays.types') }}"
                                                    class="nav-link @if (session('sub-page') == 'shifts') active-sub-page @endif">
                                                    <i class="fa fa-bookmark nav-icon"></i>
                                                    <p> {{ trans('admin.Typesofleave') }} </p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'EmployeesAttendance')->first()->id))
                                @endif
                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'EmployeesAttendance')->first()->id))
                                @endif

                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'EmployeesAttendance')->first()->id))
                                @endif
                            </ul>
                        </li>
                    @endif
                @endif



                <!--   ***********************************************  Usersand permissions   **************************************************************  -->
                <!--   ***********************************************  Usersand permissions   **************************************************************  -->
                <!--   ***********************************************  Usersand permissions   **************************************************************  -->
                <!--   ***********************************************  Usersand permissions   **************************************************************  -->
                <!--   ***********************************************  Usersand permissions   **************************************************************  -->
                <!--   ***********************************************  Usersand permissions   **************************************************************  -->
                @if (auth()->user()->organization->PackageList->where('end', '>', date('Y-m-d'))->contains('code', $package->where('nameEn', 'Users')->first()->nameEn) ||
                        auth()->user()->organization->PackageList->where('end', '>', date('Y-m-d'))->contains('code', $package->where('nameEn', 'Roles')->first()->nameEn))
                    @if (auth()->user()->empID == 0)
                        @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'usersList')->first()->id) ||
                                auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'permissionsEdit')->first()->id))
                            <li class="nav-item @if (session('page') == 'Profile') menu-open @endif">
                                <a href="#"
                                    class="nav-link @if (session('page') == 'Profile') active-page @endif">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        {{ trans('admin.Usersandpermissions') }}

                                        <i class="fas fa-angle-right left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    {{-- @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'salesReport')->first()->id)) --}}
                                    @if (auth()->user()->organization->PackageList->where('end', '>', date('Y-m-d'))->contains('code', $package->where('nameEn', 'Users')->first()->nameEn))
                                        @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'usersList')->first()->id))
                                            <li class="nav-item">
                                                <a href="{{ route('users.index') }}"
                                                    class="nav-link @if (session('page') == 'users') active-page @endif">
                                                    <i class="nav-icon fas fa-users"></i>
                                                    <p>
                                                        {{ trans('admin.Users') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                    @if (auth()->user()->organization->PackageList->where('end', '>', date('Y-m-d'))->contains('code', $package->where('nameEn', 'Roles')->first()->nameEn))
                                        @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'permissionsEdit')->first()->id))
                                            <li class="nav-item">
                                                <a href="{{ route('roles.index') }}"
                                                    class="nav-link @if (session('page') == 'roles') active-page @endif">
                                                    <i class="nav-icon fas fa-address-book"></i>
                                                    <p>
                                                        {{ trans('admin.roles') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endif
                                    @endif

                                    {{-- @endif --}}
                                </ul>
                            </li>
                        @endif
                    @endif
                @endif




                <!--   ***********************************************  Shopping    **************************************************************  -->
                <!--   ***********************************************  Shopping    **************************************************************  -->
                <!--   ***********************************************  Shopping    **************************************************************  -->
                <!--   ***********************************************  Shopping    **************************************************************  -->
                <!--   ***********************************************  Shopping    **************************************************************  -->

                @if (auth()->user()->organization->PackageList->where('end', '>', date('Y-m-d'))->contains('code', $package->where('nameEn', 'Online')->first()->nameEn))
                    @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'outcomesList')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'outcomesCreate')->first()->id) ||
                            auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'outcomesType')->first()->id))
                        <li class="nav-item @if (session('page') == 'outcomes1') menu-open @endif">
                            <a href="#"
                                class="nav-link @if (session('page') == 'outcomes1') active-page @endif">
                                <i class="nav-icon fas  fa-link"></i>
                                <p>
                                    {{ trans('admin.Shopping') }}
                                    <i class="fas fa-angle-right left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'organizationView')->first()->id))
                                    <li class="nav-item">
                                        <a type="button" onclick="getLink();" href="#"
                                            class="nav-link @if (session('page') == 'organizations') active-page @endif">
                                            <i class="nav-icon fas fa-info"></i>
                                            <p>
                                                {{ trans('admin.LinkShopping') }}

                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('banners.index') }}"
                                            class="nav-link @if (session('page') == 'banners') active-page @endif">
                                            <i class="nav-icon fas fa-info"></i>
                                            <p>
                                                {{ trans('admin.Ads') }}
                                            </p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                @endif

                <!--   ***********************************************  Settings    **************************************************************  -->
                <!--   ***********************************************  Settings    **************************************************************  -->
                <!--   ***********************************************  Settings    **************************************************************  -->
                <!--   ***********************************************  Settings    **************************************************************  -->
                <!--   ***********************************************  Settings    **************************************************************  -->
                <!--   ***********************************************  Settings    **************************************************************  -->
                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'outcomesList')->first()->id) ||
                        auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'outcomesCreate')->first()->id) ||
                        auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'outcomesType')->first()->id))
                    <li class="nav-item @if (session('page') == 'outcomes1') menu-open @endif">
                        <a href="#" class="nav-link @if (session('page') == 'outcomes1') active-page @endif">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                {{ trans('admin.Settings') }}
                                <i class="fas fa-angle-right left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'organizationView')->first()->id))
                                <li class="nav-item">
                                    <a href="{{ route('organizations.index') }}"
                                        class="nav-link @if (session('page') == 'organizations') active-page @endif">
                                        <i class="nav-icon fas fa-info"></i>
                                        <p>
                                            {{ trans('admin.Facilityinformation') }}
                                            @if (empty(auth()->user()->organization->CR))
                                                <span class="badge badge-danger">ناقصة</span>
                                            @endif
                                        </p>
                                    </a>
                                </li>

                                @if ( auth()->user()->organization->PackageList->where('end', '>', date('Y-m-d'))->contains('code', $package->where('nameEn', 'pos')->first()->nameEn)||
                                      auth()->user()->organization->PackageList->where('end', '>', date('Y-m-d'))->contains('code', $package->where('nameEn', 'accounting')->first()->nameEn))
                                    <li class="nav-item">
                                        <a href="{{ route('Sitting.index') }}"
                                            class="nav-link @if (session('page') == 'generalSitting') active-page @endif">
                                            <i class="nav-icon fas fa-info"></i>
                                            <p>
                                                {{ trans('admin.generalSitting') }}
                                            </p>
                                        </a>
                                    </li>
                                @endif

                            @endif
                        </ul>
                    </li>
                @endif

                <!--   ***********************************************  technical support    **************************************************************  -->
                <!--   ***********************************************  technical support    **************************************************************  -->
                <!--   ***********************************************  technical support    **************************************************************  -->
                <!--   ***********************************************  technical support    **************************************************************  -->
                <!--   ***********************************************  technical support    **************************************************************  -->
                <!--   ***********************************************  technical support    **************************************************************  -->

                @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'outcomesList')->first()->id) ||
                        auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'outcomesCreate')->first()->id) ||
                        auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'outcomesType')->first()->id))
                    <li class="nav-item @if (session('page') == 'outcomes') menu-open @endif">
                        <a href="#" class="nav-link @if (session('page') == 'outcomes') active-page @endif">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                {{ trans('admin.technicalsupport') }}
                                <i class="fas fa-angle-right left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'outcomesList')->first()->id))
                                <li class="nav-item">
                                    <a href="{{ route('tickets.create') }}"
                                        class="nav-link @if (session('sub-page') == 'outcomesList') active-sub-page @endif">
                                        <i class="fa fa-list nav-icon"></i>
                                        <p> {{ trans('admin.TicketsCreate') }} </p>
                                    </a>
                                </li>
                            @endif
                            @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'outcomesCreate')->first()->id))
                                <li class="nav-item">
                                    <a href="{{ route('tickets.index') }}"
                                        class="nav-link @if (session('sub-page') == 'outcomesCreate') active-sub-page @endif">
                                        <i class="fa fa-credit-card	nav-icon"></i>
                                        <p> {{ trans('admin.Tickets') }} </p>
                                    </a>
                                </li>
                            @endif
                             <li class="nav-item">
                                <a href="{{ route('Explanations') }}"
                                    class="nav-link @if (session('sub-page') == 'outcomesCreate') active-sub-page @endif">
                                    <i class="fa fa-credit-card	nav-icon"></i>
                                    <p> {{ trans('admin.Explanations') }} </p>
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                @endif

                <!--   ***********************************************  Introductionpages     **************************************************************  -->
                <!--   ***********************************************  Introductionpages     **************************************************************  -->
                <!--   ***********************************************  Introductionpages     **************************************************************  -->
                <!--   ***********************************************  Introductionpages     **************************************************************  -->
                <!--   ***********************************************  Introductionpages     **************************************************************  -->
                <!--   ***********************************************  Introductionpages     **************************************************************  -->
                @if (auth()->user()->organization->PackageList->where('end', '>', date('Y-m-d'))->contains('code', $package->where('nameEn', 'Profile')->first()->nameEn))
                    @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'organizationView')->first()->id))
                        <li class="nav-item @if (session('page') == 'Profile') menu-open @endif">
                            <a href="#"
                                class="nav-link @if (session('page') == 'Profile') active-page @endif">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    {{ trans('admin.Introductionpages') }}
                                    <i class="fas fa-angle-right left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                {{-- @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'salesReport')->first()->id)) --}}
                                <li class="nav-item">
                                    <a href="{{ route('ProfileInfCompany.index') }}"
                                        class="nav-link @if (session('sub-page') == 'ProfileInfCompany') active-sub-page @endif">
                                        <i class="fa fa-asterisk nav-icon"></i>
                                        <p> {{ trans('admin.ProfileInfCompany') }} </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('ProfileInfCompany.ServicesIndex') }}"
                                        class="nav-link @if (session('sub-page') == 'ProfileInfServices') active-sub-page @endif">
                                        <i class="fa fa-asterisk nav-icon"></i>
                                        <p> {{ trans('admin.ProfileInfServices') }} </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('ProfileInfCompany.ContactIndex') }}"
                                        class="nav-link @if (session('sub-page') == 'ProfileInfContact') active-sub-page @endif">
                                        <i class="fa fa-asterisk nav-icon"></i>
                                        <p> {{ trans('admin.ProfileInfContact') }} </p>
                                    </a>
                                </li>
                                {{-- @endif --}}
                            </ul>
                        </li>
                    @endif
                @endif

                <!--   ***********************************************  PageCatagouey     **************************************************************  -->
                <!--   ***********************************************  PageCatagouey     **************************************************************  -->
                <!--   ***********************************************  PageCatagouey     **************************************************************  -->
                <!--   ***********************************************  PageCatagouey     **************************************************************  -->
                <!--   ***********************************************  PageCatagouey     **************************************************************  -->
                <!--   ***********************************************  PageCatagouey     **************************************************************  -->


                @if (auth()->user()->isadmin == 1)
                    <li class="nav-item">
                        <a href="{{ route('pagecategories.index') }}"
                            class="nav-link @if (session('page') == 'pagecategories') active-page @endif">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                {{ trans('admin.PageCatagouey') }}
                            </p>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->isadmin == 1)
                    <li class="nav-item">
                        <a href="{{ route('pages.index') }}"
                            class="nav-link @if (session('page') == 'pages') active-page @endif">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                {{ trans('admin.Page') }}
                            </p>
                        </a>
                    </li>
                @endif


                <li class="nav-item @if (session('page') == 'Profile') menu-open @endif">
                    <a href="#" class="nav-link @if (session('page') == 'Profile') active-page @endif">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            الباقات والإشتراكات
                            <i class="fas fa-angle-right left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'salesReport')->first()->id)) --}}
                        <li class="nav-item">
                            <a href="{{ route('subsPakages.index') }}"
                                class="nav-link @if (session('sub-page') == 'ProfileInfCompany') active-sub-page @endif">
                                <i class="fa fa-asterisk nav-icon"></i>
                                <p>الإشتراك الحالي </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('subsPakages.packages') }}"
                                class="nav-link @if (session('page') == 'generalSitting') active-page @endif">
                                <i class="nav-icon fas fa-info"></i>
                                <p>
                                    {{ trans('admin.Packages') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('subsPack.paynow') }}"
                                class="nav-link @if (session('page') == 'pages') active-page @endif">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    إدفع الأن
                                </p>
                            </a>
                        </li>
                        {{-- @endif --}}
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<script>
    if (document.getElementById('success').value) {
        Swal.fire(
            'نجاح',
            '<h6  style="color:white">' + document.getElementById('success').value + '</h6>',
            'success'
        )
        document.getElementById('success').value = "";
    }
</script>
