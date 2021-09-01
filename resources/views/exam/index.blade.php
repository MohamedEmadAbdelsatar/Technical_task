@extends('adminlte::page')

@section('title', 'Exam')

@section('content_header')
    <h1>Exam</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create Exam</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('exams.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 form-inline">
                                <label for="name">Name:</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-10">
                                <label for="questions">Questions:</label>
                                <select name="questions[]" id="questions" multiple="multiple" class="js-multiple" style="width:90%;">
                                    <optgroup label="Difficulty: Easy">
                                        @foreach ($questions as $question)
                                            @if($question->level == '1')
                                                <option value="{{$question->id}}">{{$question->body}}</option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Difficulty: Normal">
                                        @foreach ($questions as $question)
                                            @if($question->level == '2')
                                                <option value="{{$question->id}}">{{$question->body}}</option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Difficulty: Hard">
                                        @foreach ($questions as $question)
                                            @if($question->level == '3')
                                                <option value="{{$question->id}}">{{$question->body}}</option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table id="example1" class="table table-bordered table-striped table-hover dataTable dtr-inline">
                <thead>
                    <tr>
                        <td>Index</td>
                        <td>Name</td>
                        <td>Options</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($exams as $exam)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$exam->name}}</td>
                            <td>
                                <a href="{{route('exams.word',$exam->id)}}"><i class="far fa-file-word" style="font-size: 22px;" title="print"></i></a>
                                - <a href="{{route('exams.show', $exam->id)}}"><i class="fas fa-envelope-open-text" style="font-size: 20px;" title="show"></i></a>
                                - <button type="button" class="btn btn-danger delete-one" title="مسح" data-url="{{route('exams.destroy', $exam->id)}}" style="background-color: transparent;color: red;border: 0px;padding:0px;"><i class="far fa-edit" style="font-size: 20px;"></i></button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop



@section('js')
    <script>
        $(document).ready(function() {
            $('.js-multiple').select2();
            $('#example1').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@stop
