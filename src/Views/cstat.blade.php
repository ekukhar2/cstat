<!DOCTYPE html>
<html>
<head>
    <title>Cstat Package</title>
</head>
<body>
@if (Route::has('login'))
    <div class="top-right links">
        @if (Auth::check())
            {{ Auth::user()->name }} <a href="{{ url('/') }}">Home</a>
        @else
            <a href="{{ url('/') }}">Home</a>
        @endif
    </div>
@endif
<style type="text/css">
    /*canvas { border: 1px solid black; }*/
</style>
<h3>
Графік статистики за останніх 30 днів по загальним та унікальним відвідувачам<br>
Дата реєстрації: {!! $datas['counterinitialdata'] !!}
</h3>
<canvas id="tutorial" width="620" height="350"></canvas>
<script type="text/javascript">
    function draw() {
        var last30DaysArray={!! $datas['last30Days'] !!};
        var AllDaysArray={!! $datas['alldays'] !!};
        var UniDaysArray={!! $datas['unidays'] !!};
        //console.log(AllDaysArray.x1);
        var canvas = document.getElementById('tutorial');
        if (canvas.getContext) {
            var ctx = canvas.getContext('2d');
            //ctx.fillStyle = 'rgba(229,242,248, 0.3)';
            //ctx.fillRect(0, 0, 620, 350);
            ctx.font = '12px serif';
            //ctx.fillText('Hello world', 10, 50);

            //глініі координат
            ctx.beginPath();
            ctx.moveTo(20, 0);
            ctx.lineTo(20, 300);
            ctx.lineTo(600, 300);
            ctx.stroke();

            //штрих-лінії по горизонталі + дні
            var c=0;
            var day='';
            ctx.beginPath();
            for(i=20;i<610;i+=20)
            {
                ctx.moveTo(i, 310);
                ctx.lineTo(i, 300);
                if(last30DaysArray[c]==undefined)day='';
                else day=last30DaysArray[c];
                ctx.fillText(day, (i-5), 320);
                c++;
            }
            ctx.stroke();

            //вертикальна градація осі y + цифри
            var z=0;
            var k={!! $datas['k'] !!} // коефіцієнт
            ctx.beginPath();
            for(i=300;i>=0;i-=50)
            {
                ctx.fillText(z, 0, (i+10));
                ctx.moveTo(18,i);
                ctx.lineTo(600,i);
                z+=50*k;
            }
            ctx.strokeStyle = 'rgb(137,178,208)';
            ctx.stroke();


            ctx.fillStyle = 'rgb(223,25,67)';
            //загальні відвідувачі
            ctx.beginPath();
            var nn=AllDaysArray.x1.length;
            ctx.moveTo(AllDaysArray.x1[0],AllDaysArray.y1[0]);
            for(i=0;i<nn;i++)
            {
                ctx.fillText(AllDaysArray.alldays[i], AllDaysArray.x1[i], AllDaysArray.y1[i]);
                ctx.lineTo(AllDaysArray.x1[i],AllDaysArray.y1[i]);
                ctx.lineTo(AllDaysArray.x2[i],AllDaysArray.y2[i]);
            }
            ctx.fillText(AllDaysArray.alldays[nn], AllDaysArray.x2[nn-1], AllDaysArray.y2[nn-1]);
            ctx.strokeStyle = 'rgb(223,25,67)';
            ctx.stroke();
            //console.log(AllDaysArray.x2[nn-1]);

            //унікальні відвідувачі
            ctx.fillStyle = 'rgb(0,140,0)';
            ctx.beginPath();
            ctx.moveTo(UniDaysArray.x1[0],UniDaysArray.y1[0]);
            for(i=0;i<nn;i++)
            {
                ctx.fillText(UniDaysArray.unidays[i], UniDaysArray.x1[i], UniDaysArray.y1[i]);
                ctx.lineTo(UniDaysArray.x1[i],UniDaysArray.y1[i]);
                ctx.lineTo(UniDaysArray.x2[i],UniDaysArray.y2[i]);
            }
            ctx.fillText(UniDaysArray.unidays[nn], UniDaysArray.x2[nn-1], UniDaysArray.y2[nn-1]);
            ctx.strokeStyle = 'rgb(65,140,107)';
            ctx.stroke();
        }
    }
    draw();
</script>
<h3>Відвідуваність по сторінкам: </h3>
<table width="600" border="1" cellpadding="0" cellspacing="0"  class="table_zam">
    <tr><th align="center">Назва</th><th align="center">За сьогодні</th><th align="center">За вчора</th><th align="center">Всього</th></tr>
    @foreach($datas['counterdatas'] as $data)
        @if($data->id=='alluser')
            <tr><td align="left">Переглянуто сторінок</td><td align="center">{{$data->today}}</td><td align="center">{{$data->tomorrow}}</td><td align="center">{{$data->alld}}</td></tr>
        @endif
        @if($data->id=='uniuser')
            <tr><td align="left">Заходів на сайт</td><td align="center">{{$data->today}}</td><td align="center">{{$data->tomorrow}}</td><td align="center">{{$data->alld}}</td></tr>
        @endif
    @endforeach
    @foreach($datas['counterdatas'] as $data)
        @if($data->id=='alluser' or $data->id=='uniuser') @continue @endif
        <tr><td align="left">{{$data->id}}</td><td align="center">{{$data->today}}</td><td align="center">{{$data->tomorrow}}</td><td align="center">{{$data->alld}}</td></tr>
    @endforeach
</table>
<h3>Відвідувачі онлайн: </h3>
<table width="600" border="1" cellpadding="0" cellspacing="0"  class="table_zam">
    <tr><td align="center"><strong>Назва сервера</strong></td><td  align="center"><strong>Назва сторінки</strong></td><td  align="center"><strong>Час заходу</strong></td><td  align="center"><strong>Ip:</strong></td></tr>
    @foreach($datas['counterinsite'] as $data)
        <tr><td align="center">{{gethostbyaddr($data->remote)}}</td><td align="center">{{$data->self}}</td><td align="center">{{$data->created_at}}</td><td align="center">{{$data->remote}}</td></tr>
    @endforeach
</table>
<h3>Відвідувачі за годину: </h3>
<table width="600" border="1" cellpadding="0" cellspacing="0"  class="table_zam">
    <tr><td align="center"><strong>Назва сервера</strong></td><td  align="center"><strong>Назва сторінки</strong></td><td  align="center"><strong>Час заходу</strong></td><td  align="center"><strong>Ip:</strong></td></tr>
    @foreach($datas['countervisitors'] as $data)
        <tr><td align="center">{{gethostbyaddr($data->remote)}}</td><td align="center">{{$data->self}}</td><td align="center">{{\Carbon\Carbon::createFromTimestamp($data->id)->toDateTimeString()}}</td><td align="center">{{$data->remote}}</td></tr>
    @endforeach
</table>
</body>
</html>