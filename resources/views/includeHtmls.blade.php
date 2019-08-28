{{--    <script>--}}
{{--        function keyPressed(evt){--}}
{{--            evt = evt || window.event;--}}
{{--            var key = evt.keyCode || evt.which;--}}
{{--            return String.fromCharCode(key); --}}
{{--        }--}}

{{--        document.onkeypress = function(evt) {--}}
{{--            var str = keyPressed(evt);--}}
{{--            --}}
{{--            if(str == '1')--}}
{{--            window.location.href = "http://localhost:8000";--}}
{{--        };--}}
{{--    </script>--}}
    @php
        $timeInitial = 0;
        $timeFinaly = 0;
    @endphp
    @foreach($bannersItens as $itemBanner)

            @php
                $nameItem = explode('.blade.php', $itemBanner['filename']);
                $name = $nameItem[0];
                $timeFinaly = $timeFinaly + $itemBanner['seconds'];
                $html = \Illuminate\Support\Facades\Storage::get($itemBanner['filename']);

            @endphp
            <div id={{$name}} style="display:none">
                @php
                    echo $html;
                @endphp
            </div>

    @endforeach

    @php
        $timeInitial = 100;
        $timeFinaly = 0;
    @endphp
    @foreach($bannersItens as $itemBanner)
        @php
            $nameItem = explode('.blade.php', $itemBanner['filename']);
            $name = $nameItem[0];
            $timeFinaly = $timeFinaly + $itemBanner['seconds'];
        @endphp

        <script>
            setTimeout( function() {
                $("#{{$name}}").show()
            },  {{$timeInitial}});
            setTimeout( function() {
                $("#{{$name}}").hide()
            },  {{ $timeFinaly }} );
        </script>

        @php
            $timeInitial = $timeInitial + $itemBanner['seconds'];
        @endphp
    @endforeach

    <script>
        setTimeout( function(){
            window.location.reload()
            }, {{ $timeFinaly}});
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>


