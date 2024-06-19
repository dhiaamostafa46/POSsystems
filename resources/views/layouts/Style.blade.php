@if (LaravelLocalization::getCurrentLocaleDirection() =="rtl")
 <style>
  .select2-container .select2-selection--single {
        height: 40px !important;

     }
    .dt-print-view{
        direction: rtl;
    }
    .active-page{
      background-color: #4c7e82 !important;
      color: white !important;
    }

    .active-sub-page{
      color: white !important;
    }
  </style>
  <style>
    #example4_filter{
        float:  left !important;
    }
    #example2_filter{
      float:  left !important;
    }
    .nav .nav-treeview{
      padding-right:15px;
    }
    select.decorated option:hover {
      box-shadow: 0 0 10px 100px #1882A8 inset;
    }
    table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td{
      padding: 5px !important;
    }
    #RepotAllDataTable_filter{
        float:  left !important;
    }
    @media (min-width: 576px){
        .floatmleft{
        float: left !important;
    }
    }

    .btnAddsys{
        float: left;
    }

    .text-menu{
    margin-top:auto;
    text-align:right;
  }


  /*        ******************************************************************                   */
  .main-tree
  {
    text-align: right
  }
  #BorderleftAccount
  {
    border-right: 1px black solid;
  }
  .tree-item{

    margin-right: 40px;
  }

  </style>
@else

<style>

.text-menu{
    margin-top:auto;

  }

.select2-container .select2-selection--single {
        height: 40px !important;

     }

.btnAddsys{
    float: right;
    }

.nav-sidebar .nav-link>p>.left {
    position: absolute;
    right:  1rem;
    top: 0.7rem;
}

[class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link {
    color: #4f4f4f;
}
.active-page {
    background-color: #4c7e82 !important;
    color: white !important;
}

.nav .nav-treeview {
    padding-left: 15px;
}

@media (min-width: 576px){
       .floatmleft{
        float: right !important;
    }
}












  /*        ******************************************************************                   */
  .main-tree
  {
    text-align: left;
  }
  #BorderleftAccount
  {
    border-left: 1px black solid;
  }
  .tree-item{
    margin-left: 20px;
  
  }

</style>

@endif
