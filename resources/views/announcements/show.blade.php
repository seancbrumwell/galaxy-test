@extends('announcements.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Announcement</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('announcements.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title</strong>
                {{ $announcement->subject }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Author</strong>
                {{ $announcement->author->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Body:</strong>
                <x-markdown>
                {{ $announcement->body }}
                </x-markdown>
            </div>
        </div>
    </div>
@endsection