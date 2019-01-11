@extends('layouts.app')
@section('main-content')
<section class="content-header">
    <h1>
        {{trans('adminlte_lang::message.home') }}
        <small>{{ trans('adminlte_lang::message.banner') }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</a></li>
        <li class="active">{{ trans('adminlte_lang::message.banner') }}</li>
    </ol>
</section>
    <div class="container-fluid spark-screen">
        <div class="row">
             <div class="col-md-12 ">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Banner</h3>

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
                    <li><i class="fa fa-file-text-o"></i> All the current banner Contents</li>
                    <a href="#" class="add-banner-Modal"><li>Add a banner</li></a>
                </ul>
            </div>

            <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover" id="bannerTable" style="visibility: hidden;">
                        <thead>
                            <tr>
                                <th valign="middle">ID</th>
                                <th>Title</th>
                                <th>Content </th>
                                <th>Moto </th>
                                <th>Image </th>
                                <th>Active?</th>
                                <th>Last updated</th>
                                <th>Actions</th>
                            </tr>
                            {{ csrf_field() }}
                        </thead>
                        <tbody>
                            @foreach($banners as $banner)
                                <tr class="item{{$banner->id}} @if($banner->is_active) warning @endif">
                                    <td>{{$banner->id}}</td>
                                    <td>{{$banner->banner_name}}</td>
                                    <td>{{$banner->banner_content}}</td>
                                    <td>{{$banner->banner_moto}}</td>
                                    <td><img width=100 height=100 src="/assets/banner/{{$banner->banner_image}}" /></td>
                                    <td class="text-center"><input type="checkbox" class="is_active_banner" data-id="{{$banner->id}}" @if ( $banner->is_active ) checked @endif></td>
                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $banner->updated_at)->diffForHumans() }}</td>
                                    <td>
                                        <!-- show modal -->
                                        <button class="banner-show-modal btn btn-success" data-id="{{$banner->id}}" data-banner_name="{{$banner->banner_name}}" data-banner_content="{{$banner->banner_content}}" data-banner_moto="{{$banner->banner_moto}}" data-banner_image="{{$banner->banner_image}}">
                                        <span class="glyphicon glyphicon-eye-open"></span> </button>
                                        <button class="banner-edit-modal btn btn-info" data-id="{{$banner->id}}" data-banner_name="{{$banner->banner_name}}" data-banner_content="{{$banner->banner_content}}" data-banner_moto="{{$banner->banner_moto}}"  data-banner_image="{{$banner->banner_image}}">
                                        <span class="glyphicon glyphicon-edit"></span> </button>
                                        <button class="banner-delete-modal btn btn-danger" data-id="{{$banner->id}}" data-banner_name="{{$banner->banner_name}}" data-banner_moto="{{$banner->banner_moto}}" data-banner_content="{{$banner->banner_content}}"  data-banner_image="{{$banner->banner_image}}" >
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
    <div id="add-banner-Modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" id="banner-form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Banner Name:</label>
                            <div class="col-sm-10">
                              <input type="text" name="banner_name" class="form-control" id="banner_name" placeholder="banner Name" autofocus/>
                                <small></small>
                                <p class="errorBannername text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Banner Content:</label>
                            <div class="col-sm-10">
                                 
                                 <textarea name="banner_content" class="form-control" id="banner_content" placeholder="banner content" rows="5" ></textarea>
                                <small>Min: 2, Max: 320, only text</small>
                                <p class="errorBannercontent text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Banner Moto:</label>
                            <div class="col-sm-10">
                                 <textarea name="banner_moto" class="form-control required" id="banner_moto" placeholder="banner moto" required >
                                 </textarea>
                                <small>Min: 2, Max: 50, only text</small>
                                <p class="errorBannermoto text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                         
                          
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Image:</label>
                            <div class="col-sm-10">
                                 <input type="file" class="form-control" name="banner_image" id="banner_image" />
                                <small>Select jpg or JPEG or png file</small>
                                <p class="errorBannerimage text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                 </form>
                    <div class="banner-modal-footer">
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
    <div id="banner-show-modal" class="modal fade" role="dialog">
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
                            <label class="control-label col-sm-2" for="title"> Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="banner_name_show" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content"> content:</label>
                            <div class="col-sm-10">
                                <textarea  id="banner_content_show" class="form-control" disabled="" rows="5" ></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content"> moto:</label>
                            <div class="col-sm-10">
                                <input type="text"  id="banner_moto_show" class="form-control" disabled="" />
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
    <div id="banner-edit-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" id="banner-edit-form" >
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID:</label>
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" id="id_edit" name="banner_id" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name"> Name</label>
                            <div class="col-sm-10">
                        <input type="text" class="form-control" id="banner_name_edit" name="banner_name"  autofocus>
                                <p class="errorName text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content"> Image:</label>
                            <div class="col-sm-10">
                                <img src="" alt="No Image" style="height: 150px;width:150px;">
                                <input type="file"  class="form-control" id="banner_image_edit" name="banner_image" />
                                <p class="errorImage text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content"> content:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="banner_content_edit" name="banner_content" rows="5" required>
                                </textarea> 
                                <p class="errorContent text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content"> moto:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="banner_moto_edit" name="banner_moto" rows="3" required></textarea>
                                <p class="errorMoto text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        
                    </form>
                    <div class="banner-edit-modal-footer">
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
    <div id="banner-delete-modal" class="modal fade" role="dialog">
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
                            <label class="control-label col-sm-2" for="title">banner Name:</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="banner_name_delete" disabled>
                            </div>
                        </div>
                    </form>
                    <div class="banner-delete-modal-footer">
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

             
            

            