@extends('admin.layouts.master')

@section('title')
    Posts
@stop

@section('style')

@stop

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <a href="{{route('posts')}}"> <span class="fa fa-code-fork"></span> Posts</a>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-code-fork"></i> Admin Panel</a></li>
                <li class="active"> Posts</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content" style=" padding-bottom: 100%;">
            <div class="page-header">
                <a href="{{route('post.new')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> New Post</a>
            </div>
            <div class="col-md-12">

            <table class="table">
                <tr class="text-primary text-capitalize">
                    <td>ID</td>
                    <td>Title</td>
                    <td>Contents</td>
                    <td>Author</td>
                    <td>Actions</td>

                </tr>
                @foreach($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td class="col-md-3">{{$post->title}}</td>
                        <td>
                            {!! str_limit(strip_tags($post->content), 300) !!}

                        </td>
                        <td><a href="{{route('user.posts', ['user'=>$post->user->name])}}">{{$post->user->name}}</a></td>
                        <td>
                            <a href="{{route('edit.post',['slug'=>$post->slug])}}"><i class="fa fa-edit"></i></a>
                            <a href="#" data-toggle="modal" data-target="#d{{$post->id}}" class="text-danger"><i class="fa fa-trash"></i></a>
                            <!-- Delete Modal -->
                            <div class="modal fade" id="d{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <form method="post" action="{{route('post.delete')}}">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-warning"></i> confirm delete post</h4>
                                            </div>
                                            <div class="modal-body text-danger">
                                                <input type="hidden" name="id" value="{{$post->id}}">
                                                Are you sure want to delete this post title of <b>"{{$post->title}}"</b>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Confirm</button>
                                            </div>

                                        </div>
                                        {{csrf_field()}}
                                    </form>
                                </div>
                            </div>
                        </td>

                    </tr>
                    @endforeach
            </table>
                <div class="text-center">{{$posts->links()}}</div>
            </div>

        </section>
        @if(Session('info'))
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <div class="tem alert alert-success navbar-fixed-bottom"><span class="glyphicon glyphicon-ok-circle"></span> {{Session('info')}}</div>
                </div>
            </div>
        @endif

        @if(Session('err'))
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <div class="tem alert alert-danger navbar-fixed-bottom"><span class="glyphicon glyphicon-remove-circle"></span> {{Session('err')}}</div>
                </div>
            </div>
        @endif

    </div>
@stop

@section('script')




@stop