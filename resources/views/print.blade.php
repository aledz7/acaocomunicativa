<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{$news->title}}</title>
	<style type="text/css">
		html{
			margin: 0px;
			padding: 0px;
			font-family: sans-serif;
		}
	</style>
</head>
<body style="padding-top:8em; padding-bottom:14em; padding-left:4em; padding-right:4em; background-image: url('img/print-bg.jpg');background-size: 100%">
	<div style="margin: 0px 100px">
		<div style="margin-bottom: 30px 0px;text-align: center">
			<img src="{{config('app.url')}}/storage/{{$news->cover}}" alt="" style="width:200px; ">
		</div>
		<div style="font-weight: bold">
			{{$news->title}}
		</div>
		<div style="margin: 20px 0px; ">
			{{$news->short_text}}
		</div>
		<div style="font-size: 14px color:#ccc">
			{!! $news->text !!}
		</div>
	</div>
</body>
</html>