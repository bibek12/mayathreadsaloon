@extends('layouts.app')
@section('main-content')
<section class="content-header">
    <h1>
        {{trans('adminlte_lang::message.home') }}
        <small>{{ trans('adminlte_lang::message.price') }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</a></li>
        <li class="active">{{ trans('adminlte_lang::message.price') }}</li>
    </ol>
</section>
    <div class="container-fluid spark-screen">
        <div class="row">
             <div class="col-md-12 ">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Price List</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
    <div class="col-md-12 ">
       
        <div class="panel panel-default">
            <div class="panel-heading">
                <ul>
                    <li><i class="fa fa-file-text-o"></i> All the current price list</li>
                    <a href="#" class="add-price-Modal"><li>Add a price</li></a>
                </ul>
            </div>

            <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover" id="priceTable" style="visibility: hidden;">
                        <thead>
                            <tr>
                                <th valign="middle">ID</th>
                                <th>Title</th>
                                <th>Cost </th>
                                <th>Active?</th>
                                <th>Last updated</th>
                                <th>Actions</th>
                            </tr>
                            {{ csrf_field() }}
                        </thead>
                        <tbody>
                            @foreach($prices as $price)
                                <tr class="item{{$price->id}} @if($price->is_active) warning @endif">
                                    <td>{{$price->id}}</td>
                                    <td>{{$price->title}}</td>
                                    <td>{{$price->cost}}</td>
                                    <td class="text-center"><input type="checkbox" class="is_active_price" data-id="{{$price->id}}" @if ( $price->is_active ) checked @endif></td>
                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $price->updated_at)->diffForHumans() }}</td>
                                    <td>
                                        <!-- show modal -->
                                        <button class="price-show-modal btn btn-success" data-id="{{$price->id}}" data-title="{{$price->title}}" data-cost="{{$price->cost}}"  >
                                        <span class="glyphicon glyphicon-eye-open"></span> </button>
                                        <button class="price-edit-modal btn btn-info" data-id="{{$price->id}}" data-title="{{$price->title}}" data-cost="{{$price->cost}}" >
                                        <span class="glyphicon glyphicon-edit"></span> </button>
                                        <button class="price-delete-modal btn btn-danger" data-id="{{$price->id}}" data-title="{{$price->title}}" data-cost="{{$price->cost}}"  >
                                        <span class="glyphicon glyphicon-trash"></span> </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div><!-- /.panel-body -->
        </div><!-- /.panel panel-default -->
    </div><!-- /.col-md-8 -->
</div>
</div>
</div>
</div>
</div>
    <!-- Modal form to add a class -->
    <div id="add-price-Modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" id="price-form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">price Title:</label>
                            <div class="col-sm-10">
                              <input type="text" name="title" class="form-control text" id="title" placeholder="price title" autofocus/>
                              <small>Min: 2, Max: 320, only text</small>
                                <p class="errorTitle text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Cost:</label>
                            <div class="col-sm-10">
                                 <input type="number" name="cost" class="form-control" id="cost" />
                                <p class="errorCost text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                         
                 </form>
                    <div class="price-modal-footer">
                        <button type="button" class="btn btn-success add" data-dismiss="modal">
                            <span id="" class='glyphicon glyphicon-check'></span> Add
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal form to show a class -->
    <div id="price-show-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_show" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">price title:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title_show" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Cost:</label>
                            <div class="col-sm-10">
                                <input type="number"  id="cost_show" class="form-control" disabled="" />
                            </div>
                        </div>
                        
                        

                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal form to edit a form -->
    <div id="price-edit-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" id="price-edit-form" >
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID:</label>
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" id="id_edit" name="price_id" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">Title</label>
                            <div class="col-sm-10">
                        <input type="text" class="form-control" id="title_edit" name="price_name"  autofocus>
                                <p class="errorTitle text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                     
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content"> Cost:</label>
                            <div class="col-sm-10">
                                <input type="number"  class="form-control" id="cost_edit" name="price_phone" />
                                <p class="errorCost text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                         

                        
                    </form>
                    <div class="price-edit-modal-footer">
                        <button type="button" class="btn btn-primary edit" data-dismiss="modal">
                            <span class='glyphicon glyphicon-check'></span> Edit
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal form to delete a form -->
    <div id="price-delete-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <h3 class="text-center">Are you sure you want to delete the following class?</h3>
                    <br />
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_delete" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Title:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title_delete" disabled>
                            </div>
                        </div>
                    </form>
                    <div class="price-delete-modal-footer">
                        <button type="button" class="btn btn-danger delete" data-dismiss="modal">
                            <span id="" class='glyphicon glyphicon-trash'></span> Delete
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
@endsection

             
            

            