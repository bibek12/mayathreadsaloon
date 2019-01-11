@extends('layouts.app')
@section('main-content')
<section class="content-header">
    <h1>
        {{trans('adminlte_lang::message.home') }}
        <small>{{ trans('adminlte_lang::message.about') }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</a></li>
        <li class="active">{{ trans('adminlte_lang::message.about') }}</li>
    </ol>
</section>
    <div class="container-fluid spark-screen">
        <div class="row">
             <div class="col-md-12 ">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">About</h3>

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
                    <li><i class="fa fa-file-text-o"></i> All the current About Contents</li>
                    <a href="#" class="add-about-Modal"><li>Add a about</li></a>
                </ul>
            </div>

            <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover" id="aboutTable" style="visibility: hidden;">
                        <thead>
                            <tr>
                                <th valign="middle">ID</th>
                                <th>Title</th>
                                <th>Content </th>
                                <th>Image </th>
                                <th>Active?</th>
                                <th>Last updated</th>
                                <th>Actions</th>
                            </tr>
                            {{ csrf_field() }}
                        </thead>
                        <tbody>
                            @foreach($abouts as $about)
                                <tr class="item{{$about->id}} @if($about->is_active) warning @endif">
                                    <td>{{$about->id}}</td>
                                    <td>{{$about->title}}</td>
                                    <td>{{$about->content}}</td>
                                    <td><img width=100 height=100 src="public/assets/about/{{$about->image}}" /></td>
                                    <td class="text-center"><input type="checkbox" class="is_active_about" data-id="{{$about->id}}" @if ( $about->is_active ) checked @endif></td>
                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $about->updated_at)->diffForHumans() }}</td>
                                    <td>
                                        <!-- show modal -->
                                        <button class="about-show-modal btn btn-success" data-id="{{$about->id}}" data-title="{{$about->title}}" data-content="{{$about->content}}"  data-image="{{$about->image}}">
                                        <span class="glyphicon glyphicon-eye-open"></span> </button>
                                        <button class="about-edit-modal btn btn-info" data-id="{{$about->id}}" data-title="{{$about->title}}" data-content="{{$about->content}}" data-image="{{$about->image}}">
                                        <span class="glyphicon glyphicon-edit"></span> </button>
                                        <button class="about-delete-modal btn btn-danger" data-id="{{$about->id}}" data-title="{{$about->title}}" >
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
    <div id="add-about-Modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" id="about-form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Title:</label>
                            <div class="col-sm-10">
                              <input type="text" name="title" class="form-control" id="title" placeholder="Title" autofocus/>
                              <small>Min: 2, Max: 500, only text</small>
                                <p class="errorTitle text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Content:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Content" name="content" id="content" rows="6">
                                </textarea>
                                <small>Min: 2, Max: 500, only text</small>
                                <p class="errorContent text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                         
                          
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Image:</label>
                            <div class="col-sm-10">
                                 <input type="file" class="form-control" name="image" id="image" />
                                <small>Select jpg or JPEG or png file</small>
                                <p class="errorImage text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                 </form>
                    <div class="about-modal-footer">
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
    <div id="about-show-modal" class="modal fade" role="dialog">
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
                            <label class="control-label col-sm-2" for="title">Title:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title_show" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Content:</label>
                            <div class="col-sm-10">
                                <textarea id="content_show" class="form-control" disabled="" rows="5" ></textarea> 
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
    <div id="about-edit-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" id="about-edit-form" >
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID:</label>
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" id="id_edit" name="about_id" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">Title</label>
                            <div class="col-sm-10">
                        <input type="text" class="form-control" id="title_edit" name="title"  autofocus>
                                <p class="errorTitle text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Logo:</label>
                            <div class="col-sm-10">
                                <img src="" alt="No Image" style="height: 150px;width:150px;">
                                <input type="file"  class="form-control" id="image_edit" name="image" />
                                <p class="errorLogo text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Content:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="content_edit" name="content" rows="5"></textarea>
                                <p class="errorContent text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        
                    </form>
                    <div class="about-edit-modal-footer">
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
    <div id="about-delete-modal" class="modal fade" role="dialog">
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
                                <input type="name" class="form-control" id="title_delete" disabled>
                            </div>
                        </div>
                    </form>
                    <div class="about-delete-modal-footer">
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

             
            

            