@extends('adminlte::page')

@section('title', 'Question Page')

@section('content_header')
    <h1>Question Page</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Question Details</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>Question</td>
                            <td>{{$question->body}}</td>
                        </tr>
                        <tr>
                            <td>Difficulty</td>
                            <td>
                                @if($question->level == '1')
                                    {{'Easy'}}
                                @elseif($question->level == '2')
                                    {{'normal'}}
                                @else
                                    {{'hard'}}
                                @endif
                            </td>
                        </tr>
                    </table>
                    <br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>index</td>
                                <td>Answer</td>
                                <td>Right Answer</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($question->answers as $answer)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$answer->body}}</td>
                                    <td>
                                        @if($answer->right)
                                            <span style='font-size:20px;'>&#10004;</span>
                                        @else
                                            <span style='font-size:20px;'>&#10006;</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
