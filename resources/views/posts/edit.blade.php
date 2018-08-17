@extends('admin.layouts.master')

@section('title')
     Edit Posts
@stop

@section('style')

@stop

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <a href="{{route('edit.post',['slug'=>$post->slug])}}"><span class="fa fa-backward"></span> Edit Post</a>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-edit"></i> Admin Panel</a></li>
                <li class="active">Edit Post</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content" style=" padding-bottom: 100%;">
            <div class="page-header">
                <a href="{{route('posts')}}" class="btn btn-primary"><i class="fa fa-backward"></i> Back</a>
            </div>
            <div class="col-md-8 col-md-offset-2">

                <form method="post" action="{{route('post.update')}}">
                    <input type="hidden" name="id" value="{{$post->id}}">
                    <div class="form-group @if($errors->has('title')) has-error @endif">
                        @if($errors->has('title')) <span class="help-block">{{$errors->first('title')}}</span> @endif
                        <label for="title" class="control-label">Title</label>
                        <input value="{{$post->title}}" type="text" name="title" id="title" class="form-control">
                    </div>
                    <div class="form-group @if($errors->has('title')) has-error @endif">
                        @if($errors->has('content')) <span class="help-block">{{$errors->first('content')}}</span> @endif
                        <label for="content" class="control-label">Content</label>
                        <textarea style="min-height: 300px"  name="content" id="content" class="form-control">
                            {!! $post->content !!}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg">Save Change</button>
                    </div>
                    {{csrf_field()}}
                </form>

            </div>

        </section>
        @if(Session('info'))
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <div class="tem alert alert-success navbar-fixed-bottom"><span class="glyphicon glyphicon-ok-circle"></span> {{Session('info')}}</div>
                </div>
            </div>
        @endif

    </div>
@stop

@section('script')




@stop