@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('acacha-profile_lang::message.settings') }}
@endsection

@section('contentheader_title')
    {{ trans('acacha-profile_lang::message.settings') }}
@endsection

@section('main-content')

    <editable :model=" {{ editable_model($user->contact()) }}">
        <editable-field name="address" content="{{ $user->contact()->address or '' }}"></editable-field>
    </editable>

    <editable model-class="Acacha\Contact\Models\Contact" :id="1" table="contacts">
        <editable-field name="address" content="{{ $user->contact()->address or '' }}"></editable-field>
    </editable>

    <editable model-class="App\User" :model=" {{ editable_model($user->contact()) }}">
        <editable-field name="email" content="{{ $user->contact()->email or '' }}"></editable-field>
    </editable>
    <editable-field :field="{{ editable_field($user,'firstname') }}" content="{{ $user->contact()->firstname or '' }}" refresh></editable-field>

    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle"
                         src="{{ Gravatar::get($user->email) }}" alt="User profile picture">

                    <h3 class="profile-username text-center">{{ $user->name }}</h3>

                    <p class="text-muted text-center">{{ $user->position or "" }}</p>

                    <p class="text-muted text-center">{{ $user->email or "" }}</p>

                    <p class="text-muted text-center">{{ trans('acacha-profile_lang::message.membersince') }} {{ lcfirst($user->created_at->diffForHumans())}}</p>

                    @if ( config('profile.showSocialNetworkData'))
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>{{ trans('acacha-profile_lang::message.followers') }}</b>
                                <a class="pull-right">{{ $user->social->followers or 0}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{ trans('acacha-profile_lang::message.following') }}</b>
                                <a class="pull-right">{{ $user->social->following or 0}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{ trans('acacha-profile_lang::message.friends') }}</b>
                                <a class="pull-right">{{ $user->social->friends or 0}}</a>
                            </li>
                        </ul>

                        <a href="#" class="btn btn-primary btn-block"><b>{{ trans('acacha-profile_lang::message.follow') }}</b></a>
                    @endif


                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- About Me Box -->
            @if ( config('profile.showAboutMe'))
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('acacha-profile_lang::message.aboutme') }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-book margin-r-5"></i> {{ trans('acacha-profile_lang::message.education') }}</strong>

                    <p class="text-muted">
                        {{ $user->personal->education or ""}}
                    </p>

                    <hr>

                    <strong><i class="fa fa-map-marker margin-r-5"></i> {{ trans('acacha-profile_lang::message.location') }}</strong>

                    <p class="text-muted">{{ $user->contact()->location or '' }}</p>

                    <hr>

                    <strong><i class="fa fa-pencil margin-r-5"></i> {{ trans('acacha-profile_lang::message.skills') }}</strong>

                    <p>
                        <!-- TODO -->
                        <span class="label label-danger">UI Design</span>
                        <span class="label label-success">Coding</span>
                        <span class="label label-info">Javascript</span>
                        <span class="label label-warning">PHP</span>
                        <span class="label label-primary">Node.js</span>
                    </p>

                    <hr>

                    <strong><i class="fa fa-file-text-o margin-r-5"></i> {{ trans('acacha-profile_lang::message.notes') }}</strong>

                    <p>{{ $user->personal->notes or ""}}</p>
                </div>
                <!-- /.box-body -->
            </div>
            @endif
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#personaldata" data-toggle="tab" aria-expanded="false">{{ trans('acacha-profile_lang::message.personaldata') }}</a></li>
                    <li class=""><a href="#security" data-toggle="tab" aria-expanded="false">{{ trans('acacha-profile_lang::message.security') }}</a></li>
                    <li class=""><a href="#api" data-toggle="tab" aria-expanded="false">{{ trans('acacha-profile_lang::message.api') }}</a></li>
                    <li class=""><a href="#curriculum" data-toggle="tab" aria-expanded="false">{{ trans('acacha-profile_lang::message.curriculum') }}</a></li>
                    <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">{{ trans('acacha-profile_lang::message.settingsmenu') }}</a></li>

                    @if ( config('profile.showTimeline'))
                        <li class=""><a href="#timeline" data-toggle="tab" aria-expanded="false">{{ trans('acacha-profile_lang::message.timeline') }}</a></li>
                    @endif
                    @if ( config('profile.showActivity'))
                        <li class=""><a href="#activity" data-toggle="tab" aria-expanded="true">{{ trans('acacha-profile_lang::message.activity') }}</a></li>
                    @endif
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="personaldata">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label"><b>{{ trans('acacha-profile_lang::message.fullname') }}</b>:</label>

                                <div class="col-sm-10">
                                    {{ $user->name }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label"><b>{{ trans('acacha-profile_lang::message.usernameEmail') }}</b>:</label>

                                <div class="col-sm-10">
                                    {{ $user->email }}
                                </div>
                            </div>
                            <div class="form-group">


                                <label for="inputName" class="col-sm-2 control-label"><b>{{ trans('acacha-profile_lang::message.firstname') }}</b>:</label>

                                <div class="col-sm-10">
                                    {{--<editable-field table="users">{{ $user->contact()->firstname or '' }}</editable-field>--}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label"><b>{{ trans('acacha-profile_lang::message.middlename') }}</b>:</label>

                                <div class="col-sm-10">
                                    <label class="control-label">{{ $user->contact()->middlename or '' }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label"><b>{{ trans('acacha-profile_lang::message.lastname') }}</b>:</label>

                                <div class="col-sm-10">
                                    <label class="control-label">{{ $user->contact()->lastname or '' }}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label"><b>{{ trans('acacha-profile_lang::message.address') }}</b>:</label>

                                <div class="col-sm-10">
                                    <label class="control-label">{{ $user->contact()->address or '' }}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label"><b>{{ trans('acacha-profile_lang::message.postalcode') }}</b>:</label>

                                <div class="col-sm-10">
                                    <label class="control-label">{{ $user->contact()->postalcode or '' }}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputCity" class="col-sm-2 control-label"><b>{{ trans('acacha-profile_lang::message.city') }}</b>:</label>

                                <div class="col-sm-10">
                                    <label class="control-label">{{ $user->contact()->city or '' }}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPhoneNumber" class="col-sm-2 control-label"><b>{{ trans('acacha-profile_lang::message.phonenumber') }}</b>:</label>

                                <div class="col-sm-10">
                                    <label class="control-label">{{ $user->contact()->phonenumber or '' }}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputMobile" class="col-sm-2 control-label"><b>{{ trans('acacha-profile_lang::message.mobile') }}</b>:</label>

                                <div class="col-sm-10">
                                    <label class="control-label">{{ $user->contact()->mobile or '' }}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label"><b>{{ trans('acacha-profile_lang::message.email') }}</b>:</label>

                                <div class="col-sm-10">
                                    {{ $user->contact()->email or '' }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputDateofbirth" class="col-sm-2 control-label"><b>{{ trans('acacha-profile_lang::message.dateofbirth') }}</b>:</label>

                                <div class="col-sm-10">
                                    {{ $user->contact()->dateofbirth or '' }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputGender" class="col-sm-2 control-label"><b>{{ trans('acacha-profile_lang::message.gender') }}</b>:</label>

                                <div class="col-sm-10">
                                    {{ $user->contact()->gender or '' }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputMaritalStatus" class="col-sm-2 control-label"><b>{{ trans('acacha-profile_lang::message.maritalstatus') }}</b>:</label>

                                <div class="col-sm-10">
                                    {{ $user->contact()->maritalstatus or '' }}
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="tab-pane" id="security">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label"><b>Current password</b>:</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputName" placeholder="Em">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label"><b>Password</b>:</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputName" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label"><b>Confirm password</b>:</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="api">
                        <passport-clients></passport-clients>
                        <passport-authorized-clients></passport-authorized-clients>
                        <passport-personal-access-tokens></passport-personal-access-tokens>
                    </div>
                    <div class="tab-pane" id="curriculum">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label"><b>Experience</b>:</label>

                                <div class="col-sm-10">
                                    <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSkills" class="col-sm-2 control-label"><b>Skills</b>:</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="settings">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label"><b>TODO</b>:</label>

                                <div class="col-sm-10">
                                    <input type="todo" class="form-control" id="inputName" placeholder="Name">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if ( config('profile.showActivity'))
                        <div class="tab-pane" id="activity">
                        <!-- Post -->
                        <div class="post">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                        <span class="username">
                          <a href="#">Jonathan Burke Jr.</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                                <span class="description">Shared publicly - 7:30 PM today</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                                Lorem ipsum represents a long-held tradition for designers,
                                typographers and the like. Some people hate it and argue for
                                its demise, but others ignore the hate as they create awesome
                                tools to help create filler text for everyone from bacon lovers
                                to Charlie Sheen fans.
                            </p>
                            <ul class="list-inline">
                                <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                                <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                                </li>
                                <li class="pull-right">
                                    <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                                        (5)</a></li>
                            </ul>

                            <input class="form-control input-sm" type="text" placeholder="Type a comment">
                        </div>
                        <!-- /.post -->

                        <!-- Post -->
                        <div class="post clearfix">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">Sarah Ross</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                                <span class="description">Sent you a message - 3 days ago</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                                Lorem ipsum represents a long-held tradition for designers,
                                typographers and the like. Some people hate it and argue for
                                its demise, but others ignore the hate as they create awesome
                                tools to help create filler text for everyone from bacon lovers
                                to Charlie Sheen fans.
                            </p>

                            <form class="form-horizontal">
                                <div class="form-group margin-bottom-none">
                                    <div class="col-sm-9">
                                        <input class="form-control input-sm" placeholder="Response">
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.post -->

                        <!-- Post -->
                        <div class="post">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="../../dist/img/user6-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">Adam Jones</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                                <span class="description">Posted 5 photos - 5 days ago</span>
                            </div>
                            <!-- /.user-block -->
                            <div class="row margin-bottom">
                                <div class="col-sm-6">
                                    <img class="img-responsive" src="../../dist/img/photo1.png" alt="Photo">
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <img class="img-responsive" src="../../dist/img/photo2.png" alt="Photo">
                                            <br>
                                            <img class="img-responsive" src="../../dist/img/photo3.jpg" alt="Photo">
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-6">
                                            <img class="img-responsive" src="../../dist/img/photo4.jpg" alt="Photo">
                                            <br>
                                            <img class="img-responsive" src="../../dist/img/photo1.png" alt="Photo">
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <ul class="list-inline">
                                <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                                <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                                </li>
                                <li class="pull-right">
                                    <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                                        (5)</a></li>
                            </ul>

                            <input class="form-control input-sm" type="text" placeholder="Type a comment">
                        </div>
                        <!-- /.post -->
                    </div>
                    @endif
                    @if ( config('profile.showTimeline'))
                        <div class="tab-pane" id="timeline">
                        <!-- The timeline -->
                        <ul class="timeline timeline-inverse">
                            <!-- timeline time label -->
                            <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-envelope bg-blue"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                    <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                    <div class="timeline-body">
                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                        quora plaxo ideeli hulu weebly balihoo...
                                    </div>
                                    <div class="timeline-footer">
                                        <a class="btn btn-primary btn-xs">Read more</a>
                                        <a class="btn btn-danger btn-xs">Delete</a>
                                    </div>
                                </div>
                            </li>
                            <!-- END timeline item -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-user bg-aqua"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                                    <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                                    </h3>
                                </div>
                            </li>
                            <!-- END timeline item -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-comments bg-yellow"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                                    <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                    <div class="timeline-body">
                                        Take me to your leader!
                                        Switzerland is small and neutral!
                                        We are more like Germany, ambitious and misunderstood!
                                    </div>
                                    <div class="timeline-footer">
                                        <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                                    </div>
                                </div>
                            </li>
                            <!-- END timeline item -->
                            <!-- timeline time label -->
                            <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-camera bg-purple"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                                    <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                    <div class="timeline-body">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                    </div>
                                </div>
                            </li>
                            <!-- END timeline item -->
                            <li>
                                <i class="fa fa-clock-o bg-gray"></i>
                            </li>
                        </ul>
                    </div>
                    @endif
                    <!-- /.tab-pane -->


                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
@endsection