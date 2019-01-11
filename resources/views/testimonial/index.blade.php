@extends('layouts.app')
@section('main-content')
<section class="content-header">
    <h1>
        {{trans('adminlte_lang::message.home') }}
        <small>{{ trans('adminlte_lang::message.testimonial') }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</a></li>
        <li class="active">{{ trans('adminlte_lang::message.testimonial') }}</li>
    </ol>
</section>
    <div class="container-fluid spark-screen">
        <div class="row">
             <div class="col-md-12 ">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">What People Say</h3>

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
                    <li><i class="fa fa-file-text-o"></i> All the testimonials Contents</li>
                    <a href="#" class="add-testimonial-Modal"><li>Add a testimonial</li></a>
                </ul>
            </div>

            <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover" id="testimonialTable" style="visibility: hidden;">
                        <thead>
                            <tr>
                                <th valign="middle">ID</th>
                                <th>Name</th>
                                <th>Profreesion</th>
                                <th>Content</th>
                                <th>Image </th>
                                <th>Active?</th>
                                <th>Last updated</th>
                                <th>Actions</th>
                            </tr>
                            {{ csrf_field() }}
                        </thead>
                        <tbody>
                            @foreach($testimonials as $testimonial)
                                <tr class="item{{$testimonial->id}} @if($testimonial->is_active) warning @endif">
                                    <td>{{$testimonial->id}}</td>
                                    <td>{{$testimonial->testimonial_name}}</td>
                                    <td>{{$testimonial->testimonial_post}}</td>
                                    <td>{{$testimonial->testimonial_content}}</td>
                                    <td><img width=100 height=100 src="public/assets/testimonial/{{$testimonial->testimonial_image}}" /></td>
                                    <td class="text-center"><input type="checkbox" class="is_active_testimonial" data-id="{{$testimonial->id}}" @if ( $testimonial->is_active ) checked @endif></td>
                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $testimonial->updated_at)->diffForHumans() }}</td>
                                    <td>
                                        <!-- show modal -->
                                        <button class="testimonial-show-modal btn btn-success" data-id="{{$testimonial->id}}" data-testimonial_name="{{$testimonial->testimonial_name}}" data-testimonial_post="{{$testimonial->testimonial_post}}"data-testimonial_content="{{$testimonial->testimonial_content}}"  data-testimonial_image="{{$testimonial->testimonial_image}}">
                                        <span class="glyphicon glyphicon-eye-open"></span> </button>
                                        <button class="testimonial-edit-modal btn btn-info" data-id="{{$testimonial->id}}" data-testimonial_name="{{$testimonial->testimonial_name}}" data-testimonial_post="{{$testimonial->testimonial_post}}" data-testimonial_content="{{$testimonial->testimonial_content}}"  data-testimonial_image="{{$testimonial->testimonial_image}}">
                                        <span class="glyphicon glyphicon-edit"></span> </button>
                                        <button class="testimonial-delete-modal btn btn-danger" data-id="{{$testimonial->id}}" data-testimonial_name="{{$testimonial->testimonial_name}}" data-testimonial_post="{{$testimonial->testimonial_post}}" data-testimonial_content="{{$testimonial->testimonial_content}}" data-testimonial_image="{{$testimonial->testimonial_image}}" >
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
    <div id="add-testimonial-Modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" id="testimonial-form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">testimonial Name:</label>
                            <div class="col-sm-10">
                              <input type="text" name="testimonial_name" class="form-control" id="testimonial_name" placeholder="testimonial Name" autofocus/>
                              <small>Min: 2, Max: 32, only text</small>
                                <p class="errorName text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">testimonial post:</label>
                            <div class="col-sm-10">
                              <input type="text" name="testimonial_post" class="form-control" id="testimonial_post" placeholder="testimonial Post" autofocus/>
                              <small>Min: 2, Max: 32, only text</small>
                                <p class="errorPost text-center alert alert-danger hidden"></p>
                            </div>
                        </div>

                          <div class="form-group">
                            <label class="control-label col-sm-2" for="content">testimonial Content:</label>
                            <div class="col-sm-10">
                                 <textarea rows="5" name="testimonial_content" class="form-control" id="testimonial_content" placeholder="testimonial Content"></textarea>
                                <small>Min: 2, Max: 32, only text</small>
                                <p class="errorContent text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                         
                          
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Image:</label>
                            <div class="col-sm-10">
                                 <input type="file" class="form-control" name="testimonial_image" id="testimonial_image" />
                                <small>Select jpg or JPEG or png file</small>
                                <p class="errorImage text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label class="control-label col-sm-2" for="content">testimonial Cost:</label>
                            <div class="col-sm-10">
                                 <input type="text" name="testimonial_content" class="form-control" id="testimonial_content" placeholder="testimonial Content" />
                                <small>Min: 2, Max: 32, only text</small>
                                <p class="errorTitle text-center alert alert-danger hidden"></p>
                            </div>
                        </div> -->
                 </form>
                    <div class="testimonial-modal-footer">
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
    <div id="testimonial-show-modal" class="modal fade" role="dialog">
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
                            <label class="control-label col-sm-2" for="title">testimonial Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="testimonial_name_show" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">testimonial Post:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="testimonial_post_show" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">testimonial Content:</label>
                            <div class="col-sm-10">
                                <input type="text"  id="testimonial_content_show" class="form-control" disabled="" />
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
    <div id="testimonial-edit-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" id="testimonial-edit-form" >
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID:</label>
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" id="id_edit" name="testimonial_id" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">testimonial Name</label>
                            <div class="col-sm-10">
                        <input type="text" class="form-control" id="testimonial_name_edit" name="testimonial_name"  autofocus>
                                <p class="errorName text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">testimonial Image:</label>
                            <div class="col-sm-10">
                                <img src="" alt="No Image" style="height: 150px;width:150px;">
                                <input type="file"  class="form-control" id="testimonial_image_edit" name="testimonial_image" />
                                <p class="errorImage text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">testimonial Post:</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" id="testimonial_post_edit" name="testimonial_post" />
                                <p class="errorPost text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">testimonial Content:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="testimonial_content_edit" name="testimonial_content" rows="5">
                                </textarea>
                                <p class="errorContent text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        
                    </form>
                    <div class="testimonial-edit-modal-footer">
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
    <div id="testimonial-delete-modal" class="modal fade" role="dialog">
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
                            <label class="control-label col-sm-2" for="title">testimonial Name:</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="testimonial_name_delete" disabled>
                            </div>
                        </div>
                    </form>
                    <div class="testimonial-delete-modal-footer">
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

             
            

            