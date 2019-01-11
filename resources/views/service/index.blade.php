@extends('layouts.app')
@section('main-content')
<section class="content-header">
    <h1>
        {{trans('adminlte_lang::message.home') }}
        <small>{{ trans('adminlte_lang::message.service') }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</a></li>
        <li class="active">{{ trans('adminlte_lang::message.service') }}</li>
    </ol>
</section>
    <div class="container-fluid spark-screen">
        <div class="row">
             <div class="col-md-12 ">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Service</h3>

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
                    <li><i class="fa fa-file-text-o"></i> All the current service Contents</li>
                    <a href="#" class="add-service-Modal"><li>Add a service</li></a>
                </ul>
            </div>

            <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover" id="serviceTable" style="visibility: hidden;">
                        <thead>
                            <tr>
                                <th valign="middle">ID</th>
                                <th>Name</th>
                                <th>Content </th>
                                <th>Image </th>
                                <th>Active?</th>
                                <th>Last updated</th>
                                <th>Actions</th>
                            </tr>
                            {{ csrf_field() }}
                        </thead>
                        <tbody>
                            @foreach($services as $service)
                                <tr class="item{{$service->id}} @if($service->is_active) warning @endif">
                                    <td>{{$service->id}}</td>
                                    <td>{{$service->service_name}}</td>
                                    <td>{{$service->service_content}}</td>
                                    <td><img width=100 height=100 src=" /assets/service/{{$service->service_image}}" /></td>
                                    <td class="text-center"><input type="checkbox" class="is_active_service" data-id="{{$service->id}}" @if ( $service->is_active ) checked @endif></td>
                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $service->updated_at)->diffForHumans() }}</td>
                                    <td>
                                        <!-- show modal -->
                                        <button class="service-show-modal btn btn-success" data-id="{{$service->id}}" data-service_name="{{$service->service_name}}" data-service_content="{{$service->service_content}}"  data-service_image="{{$service->service_image}}">
                                        <span class="glyphicon glyphicon-eye-open"></span> </button>
                                        <button class="service-edit-modal btn btn-info" data-id="{{$service->id}}" data-service_name="{{$service->service_name}}"  data-service_content="{{$service->service_content}}"  data-service_image="{{$service->service_image}}">
                                        <span class="glyphicon glyphicon-edit"></span> </button>
                                        <button class="service-delete-modal btn btn-danger" data-id="{{$service->id}}" data-service_name="{{$service->service_name}}"  data-service_content="{{$service->service_content}}" data-service_image="{{$service->service_image}}" >
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
    <div id="add-service-Modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" id="service-form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">Service Name:</label>
                            <div class="col-sm-10">
                              <input type="text" name="service_name" class="form-control" id="service_name" placeholder="service Name" autofocus/>
                              <small>Min: 2, Max: 32, only text</small>
                                <p class="errorName text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Service Content:</label>
                            <div class="col-sm-10">
                                 <textarea name="service_content" class="form-control" id="service_content" placeholder="Service Content" rows="5"></textarea>
                                <small>Min: 2, Max: 32, only text</small>
                                <p class="errorContent text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                         
                          
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Image:</label>
                            <div class="col-sm-10">
                                 <input type="file" class="form-control" name="service_image" id="service_image" />
                                <small>Select jpg or JPEG or png file</small>
                                <p class="errorImage text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Service Cost:</label>
                            <div class="col-sm-10">
                                 <input type="text" name="service_content" class="form-control" id="service_content" placeholder="Service Content" />
                                <small>Min: 2, Max: 32, only text</small>
                                <p class="errorTitle text-center alert alert-danger hidden"></p>
                            </div>
                        </div> -->
                 </form>
                    <div class="service-modal-footer">
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
    <div id="service-show-modal" class="modal fade" role="dialog">
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
                            <label class="control-label col-sm-2" for="title">Service Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="service_name_show" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Service Content:</label>
                            <div class="col-sm-10">
                                <textarea id="service_content_show" class="form-control" disabled="" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Image:</label>
                            <div class="col-sm-10">
                                <img src="" alt="No Image" style="height: 150px; width:200px;" />
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
    <div id="service-edit-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" id="service-edit-form" >
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID:</label>
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" id="id_edit" name="service_id" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">Service Name</label>
                            <div class="col-sm-10">
                        <input type="text" class="form-control" id="service_name_edit" name="service_name"  autofocus>
                                <p class="errorName text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Service Image:</label>
                            <div class="col-sm-10">
                                <img src="" alt="No Image" style="height: 150px;width:150px;">
                                <input type="file"  class="form-control" id="service_image_edit" name="service_image" />
                                <p class="errorImage text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Service Content:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="service_content_edit" name="service_content" rows="5"></textarea>
                                <p class="errorContent text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        
                    </form>
                    <div class="service-edit-modal-footer">
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
    <div id="service-delete-modal" class="modal fade" role="dialog">
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
                            <label class="control-label col-sm-2" for="title">Service Name:</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="service_name_delete" disabled>
                            </div>
                        </div>
                    </form>
                    <div class="service-delete-modal-footer">
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

             
            

            