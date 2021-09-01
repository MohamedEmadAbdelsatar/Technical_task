<!DOCTYPE html>
<html>
    <head>
        <title>Exam Page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <style>
            li{
                display: inline;
                margin-right: 50px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <center><h2>Exam Page</h2></center>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <center><h3>Subject: {{$exam->name}}</h2></center>
                </div>
            </div>
            @php $main_question = 1; $index=1; @endphp
            @foreach($questions as $question)
                @if($loop->index == 0 || $loop->index % 3 == 0 )
                    <p><b><span class="order">{{$main_question}} </span> Question</b></p>
                    @php $main_question++; $order=1; @endphp
                @endif
                <p>{{$order}}. {{$question->body}}</p>
                <ul>
                    @foreach($question->answers as $answer)
                        <li style="padding-top:0px;font-size:18px;"><span><input type="radio" name="{{$main_question}}{{$order}}"></span> {{$answer->body}}</li>
                    @endforeach
                </ul>
                @php $order++ @endphp
            @endforeach
        </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function(){
                var orders = $('.order')
                $.each(orders, function(index){
                    var string = ordinal_suffix_of(parseInt($(this).text()));
                    $(this).html(string)
                })

            });
            var special = ['zeroth','first', 'second', 'third', 'fourth', 'fifth', 'sixth', 'seventh', 'eighth', 'ninth', 'tenth', 'eleventh', 'twelfth', 'thirteenth', 'fourteenth', 'fifteenth', 'sixteenth', 'seventeenth', 'eighteenth', 'nineteenth'];
            var deca = ['twent', 'thirt', 'fort', 'fift', 'sixt', 'sevent', 'eight', 'ninet'];
            function ordinal_suffix_of(n) {
                if (n < 20) return special[n];
                if (n%10 === 0) return deca[Math.floor(n/10)-2] + 'ieth';
                return deca[Math.floor(n/10)-2] + 'y-' + special[n%10];
            }
        </script>
    </body>
</html>
