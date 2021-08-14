<!-- Container -->
<div class="container mt-xl-50 mt-sm-30 mt-15">
    <!-- Title -->
    <div class="hk-pg-header align-items-top">
        <div>
            <h2 class="hk-pg-title font-weight-600 mb-10">Olá, <?=getUser()->name?></h2>
            <p>Aqui você acompanha todos os dados do sistema</p>
        </div>
       <!-- <div class="d-flex">
           <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15"><span class="icon-label"><i class="fa fa-envelope-o"></i> </span><span class="btn-text">Email </span></button>
           <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15"><span class="icon-label"><i class="fa fa-print"></i> </span><span class="btn-text">Print </span></button>
           <button class="btn btn-sm btn-danger btn-wth-icon icon-wthot-bg mb-15"><span class="icon-label"><i class="fa fa-download"></i> </span><span class="btn-text">Export </span></button>
       </div> -->
    </div>
    <!-- /Title -->
    <!-- Row -->

    <div class="row">
        <div class="col-xl-12">
            <div class="hk-row">
                <div class="col-lg-12">
                   <div class="hk-row">
                       <div class="col-lg-4">
                           <div class="card card-sm">
                               <div class="card-body pa-0">
                                   <div class="pa-15 mb-10">
                                       <span class="d-block font-14 font-weight-500 text-dark">Total de Empresas</span>
                                       <div class="d-flex align-items-center justify-content-between">
                                           <div class="display-5 font-weight-400 text-dark"><?=$total_stores['total'];?></div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-4">
                           <div class="card card-sm">
                               <div class="card-body pa-0">
                                   <div class="pa-15 mb-10">
                                       <span class="d-block font-14 font-weight-500 text-dark">Total em assinaturas</span>
                                       <div class="d-flex align-items-center justify-content-between">
                                           <div class="display-5 font-weight-400 text-dark">R$ 0,00</div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-4">
                           <div class="card card-sm">
                               <div class="card-body pa-0">
                                   <div class="pa-15 mb-10">
                                       <span class="d-block font-14 font-weight-500 text-dark">Time on Site</span>
                                       <div class="d-flex align-items-center justify-content-between">
                                           <div class="display-5 font-weight-400 text-dark">2m 15s</div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>


                   <div class="hk-row">
                       <div class="col-md-12">
                           <div class="card">
                               <div class="card-header card-header-action">
                                   <h6>Total Sales</h6>
                                   <div class="d-flex align-items-center card-action-wrap">
                                       <div class="inline-block dropdown">
                                           <a class="dropdown-toggle no-caret" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="ion ion-ios-more"></i></a>
                                           <div class="dropdown-menu dropdown-menu-right">
                                               <a class="dropdown-item" href="#">Action</a>
                                               <a class="dropdown-item" href="#">Another action</a>
                                               <a class="dropdown-item" href="#">Something else here</a>
                                               <div class="dropdown-divider"></div>
                                               <a class="dropdown-item" href="#">Separated link</a>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="card-body">
                                   <div class="d-flex align-items-start justify-content-between mb-15">
                                       <div class="display-6 text-dark">$40,630.59</div>
                                       <div class="font-16 text-green font-weight-500">
                                           <i class="ion ion-md-arrow-up mr-5"></i>
                                           <span>5.12%</span>
                                       </div>
                                   </div>
                                   <div id="e_chart_2" class="echart" style="height:190px;"></div>
                                   <div class="hk-legend-wrap mt-10">
                                       <div class="hk-legend">
                                           <span class="d-10 bg-red rounded-circle d-inline-block"></span><span>Today</span>
                                       </div>
                                       <div class="hk-legend">
                                           <span class="d-10 bg-red-light-4 rounded-circle d-inline-block"></span><span>Yesterday</span>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                </div>
            </div>
        </div>
       <div class="col-lg-4">
           <div class="card card-sm">
               <div class="card-body">
                   <div class="hk-legend-wrap mb-10">
                       <div class="hk-legend">
                           <span class="d-10 bg-red rounded-circle d-inline-block"></span><span>Today</span>
                       </div>
                       <div class="hk-legend">
                           <span class="d-10 bg-red-light-4 rounded-circle d-inline-block"></span><span>Yesterday</span>
                       </div>
                   </div>
                   <div id="e_chart_1" class="echart" style="height:155px;"></div>
                   <div class="row mt-20">
                       <div class="col-4">
                           <span class="d-block text-capitalize">Previous</span>
                           <span class="d-block font-weight-600 font-13">79.82</span>
                       </div>
                       <div class="col-4">
                           <span class="d-block text-capitalize">% Change</span>
                           <span class="d-block font-weight-600 font-13">+14.29</span>
                       </div>
                       <div class="col-4">
                           <span class="d-block text-capitalize">Trend</span>
                           <span class="block">
													<i class="zmdi zmdi-trending-down text-danger font-20"></i>
												</span>
                       </div>
                   </div>
               </div>
           </div>
       </div>
    </div>
    <!-- /Row -->
</div>
<!-- /Container -->