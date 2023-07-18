@extends('announcements.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Test Application</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('announcements.create') }}"> Create New Announcement</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>Posted</th>
            <th>Subject</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($announcements as $announcement)
        <tr>
            <td>{{ $announcement->posted_date }}</td>
            <td>{{ $announcement->subject }}</td>
            <td>
                <form action="{{ route('announcements.destroy',$announcement->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('announcements.show',$announcement->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('announcements.edit',$announcement->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $announcements->links() !!}
      
@endsection