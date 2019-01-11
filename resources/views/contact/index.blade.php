@extends('layouts.app')
@section('main-content')
<section class="content-header">
    <h1>
        {{trans('adminlte_lang::message.home') }}
        <small>{{ trans('adminlte_lang::message.contact') }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</a></li>
        <li class="active">{{ trans('adminlte_lang::message.contact') }}</li>
    </ol>
</section>
    <div class="container-fluid spark-screen">
        <div class="row">
             <div class="col-md-12 ">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Contact</h3>

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
                    <li><i class="fa fa-file-text-o"></i> All the current contact Contents</li>
                    <a href="#" class="add-contact-Modal"><li>Add a contact</li></a>
                </ul>
            </div>

            <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover" id="contactTable" style="visibility: hidden;">
                        <thead>
                            <tr>
                                <th valign="middle">ID</th>
                                <th>Name</th>
                                <th>Phone </th>
                                <th>Address </th>
                                <th>Email </th>
                                <th>Facebook </th>
                                <th>Twitter </th>
                                <th>Active?</th>
                                <th>Last updated</th>
                                <th>Actions</th>
                            </tr>
                            {{ csrf_field() }}
                        </thead>
                        <tbody>
                            @foreach($contacts as $contact)
                                <tr class="item{{$contact->id}} @if($contact->is_active) warning @endif">
                                    <td>{{$contact->id}}</td>
                                    <td>{{$contact->contact_name}}</td>
                                    <td>{{$contact->contact_phone}}</td>
                                    <td>{{$contact->contact_address}}</td>
                                    <td>{{$contact->contact_email}}</td>
                                    <td>{{$contact->contact_facebook}}</td>
                                    <td>{{$contact->contact_twitter}}</td>
                                    <td class="text-center"><input type="checkbox" class="is_active_contact" data-id="{{$contact->id}}" @if ( $contact->is_active ) checked @endif></td>
                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $contact->updated_at)->diffForHumans() }}</td>
                                    <td>
                                        <!-- show modal -->
                                        <button class="contact-show-modal btn btn-success" data-id="{{$contact->id}}" data-contact_name="{{$contact->contact_name}}" data-contact_phone="{{$contact->contact_phone}}"  data-contact_email="{{$contact->contact_email}}" data-contact_facebook="{{$contact->contact_facebook}}" 
                                        data-contact_address="{{$contact->contact_address}}" data-contact_twitter="{{$contact->contact_twitter}}">
                                        <span class="glyphicon glyphicon-eye-open"></span> </button>
                                        <button class="contact-edit-modal btn btn-info" data-id="{{$contact->id}}" data-contact_name="{{$contact->contact_name}}" data-contact_phone="{{$contact->contact_phone}}"  data-contact_email="{{$contact->contact_email}}" data-contact_facebook="{{$contact->contact_facebook}}"
                                        data-contact_address="{{$contact->contact_address}}"  data-contact_twitter="{{$contact->contact_twitter}}">
                                        <span class="glyphicon glyphicon-edit"></span> </button>
                                        <button class="contact-delete-modal btn btn-danger" data-id="{{$contact->id}}" data-contact_name="{{$contact->contact_name}}" data-contact_phone="{{$contact->contact_phone}}"  data-contact_email="{{$contact->contact_email}}" data-contact_facebook="{{$contact->contact_facebook}}"  
                                        data-contact_address="{{$contact->contact_address}}"
                                            data-contact_twitter="{{$contact->contact_twitter}}" >
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
    <div id="add-contact-Modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" id="contact-form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Contact Name:</label>
                            <div class="col-sm-10">
                              <input type="text" name="contact_name" class="form-control" id="contact_name" placeholder="contact Name" autofocus/>
                                <small></small>
                                <p class="errorName text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Contact Phone:</label>
                            <div class="col-sm-10">
                                 <input type="text" name="contact_phone" class="form-control" id="contact_phone" placeholder="contact Phone" />
                                <small>Min: 2, Max: 32, only text</small>
                                <p class="errorPhone text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Contact Address:</label>
                            <div class="col-sm-10">
                                 <input type="text" name="contact_address" class="form-control" id="contact_address" placeholder="contact Address" />
                                <small>Min: 2, Max: 32, only text</small>
                                <p class="errorAddress text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Contact Email:</label>
                            <div class="col-sm-10">
                                 <input type="text" name="contact_email" class="form-control" id="contact_email" placeholder="contact Email" />
                                <small>Min: 2, Max: 32, only text</small>
                                <p class="errorEmail text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Contact Facebook:</label>
                            <div class="col-sm-10">
                                 <input type="text" name="contact_facebook" class="form-control" id="contact_facebook" placeholder="contact Facebook" />
                                <small>Min: 2, Max: 32, only text</small>
                                <p class="errorFacebook text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Contact Twitter:</label>
                            <div class="col-sm-10">
                                 <input type="text" name="contact_twitter" class="form-control" id="contact_twitter" placeholder="contact Title" />
                                <small>Min: 2, Max: 32, only text</small>
                                <p class="errorTwitter text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                         <!-- 
                          
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Image:</label>
                            <div class="col-sm-10">
                                 <input type="file" class="form-control" name="contact_image" id="contact_image" />
                                <small>Select jpg or JPEG or png file</small>
                                <p class="errorTitle text-center alert alert-danger hidden"></p>
                            </div>
                        </div> -->
                 </form>
                    <div class="contact-modal-footer">
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
    <div id="contact-show-modal" class="modal fade" role="dialog">
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
                            <label class="control-label col-sm-2" for="title">contact Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="contact_name_show" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">contact Phone:</label>
                            <div class="col-sm-10">
                                <input type="text"  id="contact_phone_show" class="form-control" disabled="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">contact Address:</label>
                            <div class="col-sm-10">
                                <input type="text"  id="contact_address_show" class="form-control" disabled="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">contact Email:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="contact_email_show" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">contact Facebook:</label>
                            <div class="col-sm-10">
                                <input type="text"  id="contact_facebook_show" class="form-control" disabled="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">contact Twitter:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="contact_twitter_show" disabled>
                            </div>
                        </div>
                        
                       <!--  <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Image:</label>
                            <div class="col-sm-10">
                                <img src="" alt="No Image" style="height: 150px; width:200px;" />
                            </div>
                        </div> -->
                        

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
    <div id="contact-edit-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" id="contact-edit-form" >
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID:</label>
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" id="id_edit" name="contact_id" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">Contact Name</label>
                            <div class="col-sm-10">
                        <input type="text" class="form-control" id="contact_name_edit" name="contact_name"  autofocus>
                                <p class="errorName text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">Contact Address</label>
                            <div class="col-sm-10">
                        <input type="text" class="form-control" id="contact_address_edit" name="contact_address"  autofocus>
                                <p class="errorAddress text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                       <!--  <div class="form-group">
                            <label class="control-label col-sm-2" for="content">contact Image:</label>
                            <div class="col-sm-10">
                                <img src="" alt="No Image" style="height: 150px;width:150px;">
                                <input type="file"  class="form-control" id="contact_image_edit" name="contact_image" />
                                <p class="errorContent text-center alert alert-danger hidden"></p>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Contact Phone:</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" id="contact_phone_edit" name="contact_phone" />
                                <p class="errorPhone text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Contact Email:</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" id="contact_email_edit" name="contact_email" />
                                <p class="errorEmail text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Contact Facebook:</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" id="contact_facebook_edit" name="contact_facebook" />
                                <p class="errorFacebook text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Contact Twitter:</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" id="contact_twitter_edit" name="contact_twitter" />
                                <p class="errorTwitter text-center alert alert-danger hidden"></p>
                            </div>
                        </div>

                        
                    </form>
                    <div class="contact-edit-modal-footer">
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
    <div id="contact-delete-modal" class="modal fade" role="dialog">
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
                            <label class="control-label col-sm-2" for="title">Contact Name:</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="contact_name_delete" disabled>
                            </div>
                        </div>
                    </form>
                    <div class="contact-delete-modal-footer">
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

             
            

            