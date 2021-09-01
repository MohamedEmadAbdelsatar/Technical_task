@extends('adminlte::page')

@section('title', 'Question Bank')

@section('content_header')
    <h1>Question Bank</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create Question</h3>
                </div>
                <form action="{{route('questions.update', $question->id)}}" method="post">
                    @csrf
                    <input name="_method" type="hidden" value="PUT">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="body">Question:</label>
                                <input type="text" id="body" name="body" class="form-control" required value="{{$question->body}}">
                            </div>
                            <div class="col-md-3">
                                <label for="level">Difficulty</label>
                                <select name="level" id="level" class="form-control">
                                    <option value="1" @if($question->level == '1') selected @endif>Easy</option>
                                    <option value="2" @if($question->level == '2') selected @endif>Normal</option>
                                    <option value="3" @if($question->level == '3') selected @endif>Hard</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="right">Select Right Answer</label>
                                <select name="right" id="right" class="form-control">
                                    <option value="1"
                                        @foreach ($question->answers as $key => $answer)
                                            @if($key == 0)
                                                @if($answer->right) selected @endif
                                            @endif
                                        @endforeach
                                    >First Answer</option>
                                    <option value="2"
                                        @foreach ($question->answers as $key => $answer)
                                            @if($key == 1)
                                                @if($answer->right) selected @endif
                                            @endif
                                        @endforeach
                                    >Second Answer</option>
                                    <option value="3"
                                        @foreach ($question->answers as $key => $answer)
                                            @if($key == 2)
                                                @if($answer->right) selected @endif
                                            @endif
                                        @endforeach
                                        >Third Answer</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <h4>Answers</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="answer_1">First Answer</label>
                                <input type="text" name="answers[]" id="answer_1" class="form-control" required value="@foreach($question->answers as $key => $answer) @if($key == 0) {{$answer->body}} @endif @endforeach">
                            </div>
                            <div class="col-md-4">
                                <label for="answer_2">First Answer</label>
                                <input type="text" name="answers[]" id="answer_2" class="form-control" required value="@foreach ($question->answers as $key => $answer)@if($key == 1){{$answer->body}}@endif @endforeach">
                            </div>
                            <div class="col-md-4">
                                <label for="answer_3">First Answer</label>
                                <input type="text" name="answers[]" id="answer_3" class="form-control" required value="@foreach ($question->answers as $key => $answer)@if($key == 2){{$answer->body}} @endif @endforeach">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop



@section('js')
    <script src="https://kit.fontawesome.com/06e86d86b9.js" crossorigin="anonymous"></script>
    <script>
        $('#example1', '#example2', '#example3').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        $('body').on('click', '.delete-one', function () {
                let url = $(this).data('url');
                Swal.fire({
                    title: "Are You Sure?",
                    text: "Do You Want to Delete this Question?",
                    type: "question",
                    showCancelButton: !0,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Delete!",
                    cancelButtonText: "Cancel",
                }).then(function (t) {
                    if (t.value) {
                        let formElement = document.createElement('form');
                        formElement.setAttribute('action', url);
                        formElement.setAttribute('method', 'post');
                        formElement.setAttribute('class', 'd-none');

                        let tokenElement = document.createElement('input');
                        tokenElement.setAttribute('name', '_token');
                        tokenElement.setAttribute('value', '{{ csrf_token() }}');
                        tokenElement.setAttribute('type', 'hidden');

                        formElement.append(tokenElement);

                        let methodElement = document.createElement('input');
                        methodElement.setAttribute('name', '_method');
                        methodElement.setAttribute('value', 'DELETE');
                        methodElement.setAttribute('type', 'hidden');

                        formElement.append(methodElement);

                        $("body").append(formElement);

                        formElement.submit();
                    }
                });
            });
    </script>
@stop
